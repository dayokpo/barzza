<?php
/**
 * Plugin Name: Carousel Slider
 * Plugin URI: https://example.com/carousel-slider
 * Description: A custom plugin to create carousel sliders.
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: carousel-slider
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue scripts and styles
function crs_enqueue_scripts() {
    if (!is_admin()) {
        wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
        wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
        wp_enqueue_style('crs-style', plugin_dir_url(__FILE__) . 'css/crs-style.css');
        wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
        wp_enqueue_script('crs-script', plugin_dir_url(__FILE__) . 'js/crs-script.js', array('jquery', 'slick-js'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'crs_enqueue_scripts');

// Enqueue admin scripts
function crs_admin_enqueue_scripts($hook) {
    if ($hook === 'toplevel_page_carousel-slider') {
        wp_enqueue_editor();
    }
}
add_action('admin_enqueue_scripts', 'crs_admin_enqueue_scripts');

// Add admin menu
function crs_add_admin_menu() {
    add_menu_page(
        'Carousel Sliders',
        'Carousel Sliders',
        'manage_options',
        'carousel-slider',
        'crs_admin_page',
        'dashicons-images-alt2',
        30
    );
}
add_action('admin_menu', 'crs_add_admin_menu');

// Admin page callback
function crs_admin_page() {
    if (isset($_GET['delete']) && wp_verify_nonce($_GET['_wpnonce'], 'delete_slider')) {
        $sliders = get_option('crs_sliders', array());
        $delete_name = sanitize_text_field($_GET['delete']);
        if (isset($sliders[$delete_name])) {
            unset($sliders[$delete_name]);
            update_option('crs_sliders', $sliders);
            wp_redirect(admin_url('admin.php?page=carousel-slider'));
            exit;
        }
    }
    if (isset($_POST['crs_save_slider'])) {
        crs_save_slider();
    }
    crs_display_admin_page();
}

// Custom sanitization function that preserves value attributes on input elements
function crs_sanitize_slide_content($content) {
    $allowed_html = wp_kses_allowed_html('post');
    
    // Allow input elements with value, name, type, id, and data-* attributes
    $allowed_html['input'] = array(
        'type' => true,
        'name' => true,
        'value' => true,
        'id' => true,
        'class' => true,
        'checked' => true,
        'disabled' => true,
    );
    
    // Allow data-* attributes
    $allowed_html['input']['data-*'] = true;
    
    return wp_kses($content, $allowed_html);
}

// Save slider
function crs_save_slider() {
    if (!wp_verify_nonce($_POST['crs_nonce'], 'crs_save_slider')) {
        return;
    }

    $sliders = get_option('crs_sliders', array());

    $slider_name = sanitize_text_field($_POST['slider_name']);
    $slides = array();

    if (isset($_POST['slide_content'])) {
        foreach ($_POST['slide_content'] as $key => $content) {
            if (!empty($content)) {
                $slides[] = array(
                    'content' => crs_sanitize_slide_content($content)
                );
            }
        }
    }

    $sliders[$slider_name] = $slides;
    update_option('crs_sliders', $sliders);

    wp_redirect(admin_url('admin.php?page=carousel-slider&saved=1'));
    exit;
}

// Display admin page
function crs_display_admin_page() {
    $sliders = get_option('crs_sliders', array());
    $editing = isset($_GET['edit']) ? sanitize_text_field($_GET['edit']) : '';
    $adding = isset($_GET['add']) && $_GET['add'] === 'new';
    $current_slider = $editing && isset($sliders[$editing]) ? $sliders[$editing] : array();
    $current_name = $editing;
    $show_form = $editing || $adding;
    if (isset($_GET['saved'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Slider successfully saved.</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Carousel Sliders</h1>
        <?php if (!$show_form) : ?>
            <a href="<?php echo admin_url('admin.php?page=carousel-slider&add=new'); ?>" class="button button-primary">Add New Slider</a>
            <?php if (!empty($sliders)) : ?>
            <table class="wp-list-table widefat fixed striped" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Shortcode</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sliders as $name => $slides) : ?>
                    <tr>
                        <td><?php echo esc_html($name); ?></td>
                        <td><code>[carousel_slider name="<?php echo esc_attr($name); ?>"]</code></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=carousel-slider&edit=' . urlencode($name)); ?>">Edit</a> |
                            <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=carousel-slider&delete=' . urlencode($name)), 'delete_slider'); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        <?php else : ?>
            <a href="<?php echo admin_url('admin.php?page=carousel-slider'); ?>" class="button">← Back to Sliders</a>
            <h2><?php echo $editing ? 'Edit Slider' : 'Add New Slider'; ?></h2>
        <form method="post">
            <?php wp_nonce_field('crs_save_slider', 'crs_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Slider Name</th>
                    <td><input type="text" name="slider_name" value="<?php echo esc_attr($current_name); ?>" required /></td>
                </tr>
            </table>
            <h3>Slides</h3>
            <div id="slides-container">
                <?php if (!empty($current_slider)) : ?>
                    <?php foreach ($current_slider as $index => $slide) : ?>
                        <div class="slide-row">
                            <?php
                            $editor_id = 'slide_content_' . $index;
                            wp_editor($slide['content'], $editor_id, array('textarea_name' => 'slide_content[]', 'editor_height' => 200));
                            ?>
                            <button type="button" class="remove-slide">Remove</button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button type="button" id="add-slide">Add Slide</button>
            <br><br>
            <input type="submit" name="crs_save_slider" class="button button-primary" value="Save Slider" />
        </form>
        <?php endif; ?>
    </div>
    <?php if ($show_form) : ?>
    <script>
    jQuery(document).ready(function($) {
        var slideIndex = <?php echo count($current_slider); ?>;
        $('#add-slide').click(function() {
            var editorId = 'slide_content_' + slideIndex;
            var slideHtml = '<div class="slide-row">' +
                '<textarea id="' + editorId + '" name="slide_content[]"></textarea>' +
                '<button type="button" class="remove-slide">Remove</button>' +
                '</div>';
            $('#slides-container').append(slideHtml);
            wp.editor.initialize(editorId, {
                tinymce: {
                    wpautop: true,
                    plugins: 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
                    toolbar1: 'bold italic underline strikethrough | bullist numlist | blockquote hr wp_more | alignleft aligncenter alignright | link unlink | fullscreen | wp_adv',
                    toolbar2: 'formatselect alignjustify forecolor | pastetext removeformat charmap | outdent indent | undo redo | wp_help'
                },
                quicktags: true,
                mediaButtons: true,
                textarea_name: 'slide_content[]'
            });
            slideIndex++;
        });
        $(document).on('click', '.remove-slide', function() {
            $(this).parent().remove();
        });
    });
    </script>
    <?php endif; ?>
    <?php
}

// Shortcode
add_shortcode('carousel_slider', 'crs_carousel_shortcode');

function crs_carousel_shortcode($atts) {
    $atts = shortcode_atts(array(
        'name' => '',
    ), $atts);

    $name = $atts['name'];
    if (empty($name)) {
        return 'Slider name not specified.';
    }

    $sliders = get_option('crs_sliders', array());
    if (!isset($sliders[$name])) {
        return 'Slider not found.';
    }

    $slides = $sliders[$name];
    if (empty($slides)) {
        return 'No slides in this slider.';
    }

    $html = '<div class="crs-carousel" data-name="' . esc_attr($name) . '">';
    foreach ($slides as $slide) {
        $html .= '<div class="crs-slide">';
        $html .= crs_sanitize_slide_content($slide['content']);
        $html .= '</div>';
    }
    $html .= '</div>';

    return $html;
}
