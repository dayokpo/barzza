<?php
/**
 * Plugin Name: Barzza Accordin Slider
 * Description: Full-width accordion style image slider with 90% open panel.
 * Version: 1.0
 * Author: Cedrick
 */

if (!defined('ABSPATH')) exit;

class Accordion_Image_Slider {

    public function __construct() {
        add_shortcode('accordion_slider', [$this, 'render_slider']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets() {
        wp_enqueue_style(
            'accordion-slider-style',
            plugin_dir_url(__FILE__) . 'assets/css/style.css'
        );

        wp_enqueue_script(
            'accordion-slider-script',
            plugin_dir_url(__FILE__) . 'assets/js/script.js',
            [],
            false,
            true
        );
    }

    public function render_slider($atts) {
        $assets_path = plugin_dir_url(__FILE__) . 'assets/img/';
        $images = [
            $assets_path . 'barzza-beach-front-house.jpg',
            $assets_path . 'barzza-featured-house.jpg',
            $assets_path . 'barzza-pool-view-house.jpg',
            $assets_path . 'barzza-house.jpg',
        ];

        ob_start(); ?>
        <div class="accordion-slider">
            <?php foreach ($images as $image): ?>
                <div class="accordion-panel" style="background-image:url('<?php echo esc_url($image); ?>')"></div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

new Accordion_Image_Slider();
