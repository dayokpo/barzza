<?php
/**
 * Plugin Name: CF7 Inquiries
 * Plugin URI: https://example.com/cf7-inquiries
 * Description: Capture and display all Contact Form 7 submissions.
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cf7-inquiries
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CF7_INQUIRIES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CF7_INQUIRIES_PLUGIN_URL', plugin_dir_url(__FILE__));

// Create database table on plugin activation
register_activation_hook(__FILE__, 'cf7_inquiries_activate');

function cf7_inquiries_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf7_inquiries';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        form_id bigint(20) NOT NULL,
        form_name varchar(255) NOT NULL,
        data longtext NOT NULL,
        email varchar(255),
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY form_id (form_id),
        KEY submitted_at (submitted_at)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Hook into CF7 submission
add_action('wpcf7_before_send_mail', 'cf7_inquiries_capture_submission', 10, 1);

function cf7_inquiries_capture_submission($contact_form) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf7_inquiries';
    
    $form_id = $contact_form->get_id();
    $form_name = $contact_form->get_title();
    
    // Get posted data from CF7
    $submission = WPCF7_Submission::get_instance();
    
    if ($submission) {
        $posted_data = $submission->get_posted_data();
        
        // Try to extract email from common field names
        $email = '';
        $email_fields = array('email', 'your-email', 'email-address', 'your-email-address', '_wpcf7_email');
        
        foreach ($email_fields as $field) {
            if (!empty($posted_data[$field])) {
                $email = is_array($posted_data[$field]) ? $posted_data[$field][0] : $posted_data[$field];
                break;
            }
        }
        
        // Store in database
        $wpdb->insert(
            $table_name,
            array(
                'form_id' => $form_id,
                'form_name' => $form_name,
                'data' => json_encode($posted_data),
                'email' => sanitize_email($email),
            ),
            array('%d', '%s', '%s', '%s')
        );
    }
}

// Add admin menu
add_action('admin_menu', 'cf7_inquiries_add_admin_menu');

function cf7_inquiries_add_admin_menu() {
    add_menu_page(
        'CF7 Inquiries',
        'CF7 Inquiries',
        'manage_options',
        'cf7-inquiries',
        'cf7_inquiries_admin_page',
        'dashicons-email-alt',
        25
    );
}

// Admin page content
function cf7_inquiries_admin_page() {
    // Handle delete action
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        if (!wp_verify_nonce($_GET['_wpnonce'], 'delete_inquiry')) {
            wp_die('Security check failed');
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'cf7_inquiries';
        $inquiry_id = intval($_GET['id']);
        
        $wpdb->delete($table_name, array('id' => $inquiry_id), array('%d'));
        wp_redirect(admin_url('admin.php?page=cf7-inquiries&deleted=1'));
        exit;
    }
    
    // Handle delete all action
    if (isset($_POST['action']) && $_POST['action'] === 'delete_all' && isset($_POST['cf7_inquiries_nonce'])) {
        if (!wp_verify_nonce($_POST['cf7_inquiries_nonce'], 'cf7_inquiries_delete_all')) {
            wp_die('Security check failed');
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'cf7_inquiries';
        $wpdb->query("TRUNCATE TABLE $table_name");
        wp_redirect(admin_url('admin.php?page=cf7-inquiries&deleted_all=1'));
        exit;
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf7_inquiries';
    
    // Get filter values
    $form_filter = isset($_GET['form_id']) ? intval($_GET['form_id']) : 0;
    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
    
    // Build query
    $query = "SELECT * FROM $table_name WHERE 1=1";
    $count_query = "SELECT COUNT(*) FROM $table_name WHERE 1=1";
    
    if ($form_filter) {
        $query .= $wpdb->prepare(" AND form_id = %d", $form_filter);
        $count_query .= $wpdb->prepare(" AND form_id = %d", $form_filter);
    }
    
    if ($search) {
        $query .= $wpdb->prepare(" AND (email LIKE %s OR data LIKE %s)", '%' . $wpdb->esc_like($search) . '%', '%' . $wpdb->esc_like($search) . '%');
        $count_query .= $wpdb->prepare(" AND (email LIKE %s OR data LIKE %s)", '%' . $wpdb->esc_like($search) . '%', '%' . $wpdb->esc_like($search) . '%');
    }
    
    // Pagination
    $items_per_page = 20;
    $page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $offset = ($page - 1) * $items_per_page;
    
    $total_items = $wpdb->get_var($count_query);
    $total_pages = ceil($total_items / $items_per_page);
    
    $query .= " ORDER BY submitted_at DESC LIMIT $offset, $items_per_page";
    $inquiries = $wpdb->get_results($query);
    
    // Get unique forms for filter dropdown
    $forms = $wpdb->get_results("SELECT DISTINCT form_id, form_name FROM $table_name ORDER BY form_name");
    
    ?>
    <div class="wrap">
        <h1>Contact Form 7 Inquiries</h1>
        
        <?php if (isset($_GET['deleted'])) : ?>
            <div class="notice notice-success is-dismissible"><p>Inquiry deleted successfully.</p></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['deleted_all'])) : ?>
            <div class="notice notice-success is-dismissible"><p>All inquiries deleted successfully.</p></div>
        <?php endif; ?>
        
        <form method="get" style="margin-bottom: 20px;">
            <input type="hidden" name="page" value="cf7-inquiries">
            <div style="display: flex; gap: 10px; align-items: center;">
                <select name="form_id">
                    <option value="">All Forms</option>
                    <?php foreach ($forms as $form) : ?>
                        <option value="<?php echo esc_attr($form->form_id); ?>" <?php selected($form_filter, $form->form_id); ?>>
                            <?php echo esc_html($form->form_name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <input type="text" name="s" placeholder="Search by email or content..." value="<?php echo esc_attr($search); ?>" style="min-width: 250px;">
                
                <button type="submit" class="button">Search</button>
                <a href="<?php echo esc_url(admin_url('admin.php?page=cf7-inquiries')); ?>" class="button">Reset</a>
            </div>
        </form>
        
        <?php if ($inquiries) : ?>
            <p>Total: <strong><?php echo esc_html($total_items); ?></strong> inquiries</p>
            
            <div style="margin-bottom: 20px;">
                <form method="post" style="display: inline;">
                    <?php wp_nonce_field('cf7_inquiries_delete_all', 'cf7_inquiries_nonce'); ?>
                    <input type="hidden" name="action" value="delete_all">
                    <button type="submit" class="button button-secondary" onclick="return confirm('Delete all inquiries? This cannot be undone.');">Delete All</button>
                </form>
            </div>
            
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Form</th>
                        <th>Email</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inquiry) : ?>
                        <tr>
                            <td><?php echo esc_html($inquiry->id); ?></td>
                            <td><?php echo esc_html($inquiry->form_name); ?></td>
                            <td><?php echo esc_html($inquiry->email ?: 'N/A'); ?></td>
                            <td><?php echo esc_html(date('M d, Y H:i', strtotime($inquiry->submitted_at))); ?></td>
                            <td>
                                <a href="<?php echo esc_url(admin_url('admin.php?page=cf7-inquiries&action=view&id=' . $inquiry->id)); ?>" class="button button-small">View</a>
                                <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=cf7-inquiries&action=delete&id=' . $inquiry->id), 'delete_inquiry')); ?>" class="button button-small button-link-delete" onclick="return confirm('Delete this inquiry?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <?php if ($total_pages > 1) : ?>
                <div class="tablenav">
                    <div class="tablenav-pages">
                        <?php
                        $base_url = add_query_arg(array('paged' => '%#%'));
                        echo paginate_links(array(
                            'base' => $base_url,
                            'format' => '',
                            'prev_text' => __('&laquo; Previous'),
                            'next_text' => __('Next &raquo;'),
                            'total' => $total_pages,
                            'current' => $page,
                            'add_args' => array('s' => $search, 'form_id' => $form_filter),
                        ));
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <p>No inquiries found.</p>
        <?php endif; ?>
    </div>
    <?php
    
    // Handle view action
    if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
        $inquiry_id = intval($_GET['id']);
        $inquiry = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $inquiry_id));
        
        if ($inquiry) {
            $data = json_decode($inquiry->data, true);
            ?>
            <div style="margin-top: 40px; border-top: 1px solid #ddd; padding-top: 20px;">
                <h2>Inquiry Details (ID: <?php echo esc_html($inquiry->id); ?>)</h2>
                <p><strong>Form:</strong> <?php echo esc_html($inquiry->form_name); ?></p>
                <p><strong>Submitted:</strong> <?php echo esc_html(date('M d, Y H:i:s', strtotime($inquiry->submitted_at))); ?></p>
                <h3>Data</h3>
                <table class="wp-list-table widefat fixed">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $field => $value) : ?>
                            <tr>
                                <td><strong><?php echo esc_html(ucwords(str_replace('-', ' ', $field))); ?></strong></td>
                                <td>
                                    <?php
                                    if (is_array($value)) {
                                        echo esc_html(implode(', ', $value));
                                    } else {
                                        echo esc_html($value);
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
    }
}
