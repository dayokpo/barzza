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
					<?php echo ( $tab->post_content ); ?>
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
		'1.0.0'
	);

	wp_enqueue_script(
		'barzza-tabs-script',
		plugin_dir_url( __FILE__ ) . 'assets/js/tabs.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'barzza_enqueue_tabs_assets' );
