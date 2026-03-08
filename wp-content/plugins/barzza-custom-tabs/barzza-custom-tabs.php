<?php
/**
 * Plugin Name: Barzza Custom Tabs
 * Plugin URI: https://barzza.com
 * Description: Create dynamic tabs from posts with custom HTML content
 * Version: 1.0.0
 * Author: Barzza
 * Author URI: https://barzza.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: barzza-custom-tabs
 * Domain Path: /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Trim .description blocks and append a "See more" link when needed.
 * Outputs both full and trimmed content; CSS controls visibility based on screen width.
 *
 * @param string $content Post content HTML.
 * @param int    $word_limit Number of words to keep in excerpt.
 * @param string $post_url Post permalink for the "See more" link.
 * @return string
 */
function barzza_trim_description_blocks( $content, $word_limit = 10, $post_url = '' ) {
	$pattern = '#<div\b([^>]*\bclass=(["\'])[^"\']*\bdescription\b[^"\']*\2[^>]*)>(.*?)</div>#is';

	return preg_replace_callback(
		$pattern,
		function( $matches ) use ( $word_limit, $post_url ) {
			$inner_html = trim( $matches[3] );
			$plain_text = trim( wp_strip_all_tags( $inner_html ) );

			if ( '' === $plain_text ) {
				return $matches[0];
			}

			$excerpt = wp_trim_words( $plain_text, (int) $word_limit, '...' );

			// If no trimming needed or no URL, return original
			if ( $excerpt === $plain_text || '' === $post_url ) {
				return $matches[0];
			}

			// Output both full and trimmed versions; CSS will handle responsive display
			return '<div' . $matches[1] . '>'
				. '<span class="barzza-description-full">' . $inner_html . '</span>'
				. '<span class="barzza-description-excerpt">' . esc_html( $excerpt ) . ' <a href="' . esc_url( $post_url ) . '" class="barzza-see-more">' . esc_html__( 'See more', 'barzza-custom-tabs' ) . '</a></span>'
				. '</div>';
		},
		$content
	);
}

/**
 * Shortcode: [barzza_tabs]
 * Usage: Place this shortcode where you want the tabs to appear
 * Default queries posts from 'standalone' category
 * Optional: [barzza_tabs category="standalone" orderby="title"]
 */
function barzza_render_tabs_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'category' => 'standalone', // Category slug
			'orderby'  => 'title',       // title, date, menu_order
			'order'    => 'ASC',         // ASC, DESC
		),
		$atts,
		'barzza_tabs'
	);

	// Query posts from the specified category
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => -1,
		'orderby'        => sanitize_text_field( $atts['orderby'] ),
		'order'          => sanitize_text_field( $atts['order'] ),
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $atts['category'] ),
			),
		),
	);

	$tabs = get_posts( $args );

	if ( empty( $tabs ) ) {
		return '<p>No tabs available.</p>';
	}

	ob_start();
	?>
	<div class="barzza-tabs-wrapper">
		<div class="barzza-tabs-nav">
			<?php foreach ( $tabs as $index => $tab ) : ?>
				<button 
					class="barzza-tab-button <?php echo 0 === $index ? 'active' : ''; ?>" 
					data-tab-id="barzza-tab-<?php echo esc_attr( $tab->ID ); ?>"
					aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
					aria-controls="barzza-tab-content-<?php echo esc_attr( $tab->ID ); ?>"
				>
					<?php echo esc_html( $tab->post_title ); ?>
				</button>
			<?php endforeach; ?>
		</div>

		<div class="barzza-tabs-content">
			<?php foreach ( $tabs as $index => $tab ) : ?>
				<div 
					id="barzza-tab-content-<?php echo esc_attr( $tab->ID ); ?>" 
					class="barzza-tab-content <?php echo 0 === $index ? 'active' : ''; ?>"
					role="tabpanel"
					aria-labelledby="barzza-tab-<?php echo esc_attr( $tab->ID ); ?>"
				>
					<?php 
					$content = $tab->post_content;
					$content = barzza_trim_description_blocks( $content, 10, get_permalink( $tab->ID ) );
					$tag_list = get_the_term_list( $tab->ID, 'post_tag', '<span class="barzza-tag"></span>' );
					$tags_html = $tag_list ? '<div class="barzza-post-tags">' . $tag_list . '</div>' : '';
					$replacement = '<h3 class="barzza-tab-title">' . esc_html( $tab->post_title ) . '</h3>' . $tags_html . '<div class="content';
					$content = preg_replace(
						'/<div\s+class="content/',
						$replacement,
						$content,
						1
					);
					echo $content;
					?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'barzza_tabs', 'barzza_render_tabs_shortcode' );

/**
 * Enqueue styles and scripts
 */
function barzza_enqueue_tabs_assets() {
	wp_enqueue_style(
		'barzza-tabs-style',
		plugin_dir_url( __FILE__ ) . 'assets/css/tabs.css',
		array(),
		'1.0.1'
	);

	wp_enqueue_script(
		'barzza-tabs-script',
		plugin_dir_url( __FILE__ ) . 'assets/js/tabs.js',
		array( 'jquery' ),
		'1.0.2',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'barzza_enqueue_tabs_assets' );
