<?php
/**
 * Plugin Name: CF7 Radio Slider
 * Plugin URI: https://example.com/cf7-radio-slider
 * Description: Display Contact Form 7 radio buttons as a carousel slider.
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cf7-radio-slider
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue scripts and styles
function cf7rs_enqueue_scripts() {
    if (!is_admin()) {
        // Slick carousel
        wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
        wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
        wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
        
        // Plugin styles and scripts
        wp_enqueue_style('cf7rs-style', plugin_dir_url(__FILE__) . 'css/cf7rs-style.css');
        wp_enqueue_script('cf7rs-script', plugin_dir_url(__FILE__) . 'js/cf7rs-script.js', array('jquery', 'slick-js'), '1.0.0', true);

        // Localize AJAX data for frontend script
        wp_localize_script('cf7rs-script', 'cf7rs_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('cf7rs_nonce'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'cf7rs_enqueue_scripts');

// AJAX handler: return featured image URL for a post matching the given title in category "Standalone"
add_action('wp_ajax_cf7rs_get_image', 'cf7rs_get_image');
add_action('wp_ajax_nopriv_cf7rs_get_image', 'cf7rs_get_image');

function cf7rs_get_image() {
    // Check nonce
    if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'cf7rs_nonce')) {
        wp_send_json_error('invalid_nonce');
    }

    if (empty($_POST['title'])) {
        wp_send_json_error('no_title');
    }

    $title = sanitize_text_field(wp_unslash($_POST['title']));

    // Find a post with this exact title
    $post = get_page_by_title($title, OBJECT, 'post');
    if (!$post) {
        wp_send_json_error('not_found');
    }

    // Ensure post is in category 'Standalone' (by name)
    if (!has_category('Standalone', $post->ID)) {
        wp_send_json_error('not_in_category');
    }

    $thumb = get_the_post_thumbnail_url($post->ID, 'medium');

    // Get post title
    $post_title = get_the_title($post->ID);

    // Try to find a block with class 'standalone_excerpt' in the post content
    $excerpt_html = '';
    if (function_exists('parse_blocks')) {
        $blocks = parse_blocks($post->post_content);
        $found_block = null;
        $iterator = function($blocks) use (&$iterator, &$found_block) {
            foreach ($blocks as $block) {
                if (!empty($block['attrs']) && !empty($block['attrs']['className']) && strpos($block['attrs']['className'], 'standalone_excerpt') !== false) {
                    $found_block = $block;
                    return true;
                }
                // Some blocks may have innerBlocks
                if (!empty($block['innerBlocks'])) {
                    if ($iterator($block['innerBlocks'])) {
                        return true;
                    }
                }
            }
            return false;
        };

        $iterator($blocks);

        if ($found_block) {
            if (function_exists('render_block')) {
                $excerpt_html = render_block($found_block);
            } elseif (!empty($found_block['innerHTML'])) {
                $excerpt_html = $found_block['innerHTML'];
            }
        }
    }

    $response = array('title' => $post_title);
    if ($thumb) {
        $response['url'] = esc_url_raw($thumb);
    }
    if ($excerpt_html) {
        $response['excerpt_html'] = wp_kses_post($excerpt_html);
    }

    wp_send_json_success($response);
}
