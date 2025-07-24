<?php
/**
 * Plugin Name: ESGI Plugin
 * Version: 1.0.0
 * Description: Plugin permettant d'ajouter un lien "Dupliquer" dans la liste des posts WordPress
 * Author: jkd
 * Author URI: https://www.esgi.fr/
 * Text Domain: esgi-plugin
 */

// Exit if accessed directly
/**
 * It ensures the plugin file can't be accessed directly via a browser or URL. 
 * If someone tries to navigate directly to the plugin file
 * (e.g., https://example.com/wp-content/plugins/ESGI-plugin/ESGI-plugin.php),the script will terminate immediately.
 * WordPress Environment Check: The constant ABSPATH is only defined when the script is loaded through
 * the WordPress system. This check confirms the code is running within WordPress's execution environment.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add duplicate link to post and page row actions
 */
function esgi_displayDuplicateLink($actions, $post) {
    // Check if current user can edit posts
    if (current_user_can('edit_posts')) {
        // Create the duplicate link URL
        $url = wp_nonce_url(
            add_query_arg(
                [
                    'action' => 'esgi_duplicate_post',
                    'post' => $post->ID,
                ],
                'admin.php'
            ),
            basename(__FILE__)
        );

        // Add the duplicate link to actions array
        $actions['duplicate'] = '<a href="' . esc_url($url) . '">' . __('Dupliquer', 'esgi-plugin') . '</a>';
    }
    
    return $actions;
}

// Add our action to both posts and pages row actions
add_filter('post_row_actions', 'esgi_displayDuplicateLink', 10, 2);
add_filter('page_row_actions', 'esgi_displayDuplicateLink', 10, 2);

/**
 * Duplicate post function
 */
function esgi_duplicate_post() {
    // Check if post ID exists in URL
    if (empty($_GET['post'])) {
        wp_die(__('No post to duplicate has been supplied!', 'esgi-plugin'));
    }

    // Verify nonce
    check_admin_referer(basename(__FILE__));

    // Get the original post ID
    $post_id = absint($_GET['post']);
    
    // Get the original post object
    $post = get_post($post_id);
    
    if (!$post) {
        wp_die(__('Post creation failed, could not find original post.', 'esgi-plugin'));
    }
    
    // Create new post array from the original post
    $args = [
        'comment_status' => $post->comment_status,
        'ping_status'    => $post->ping_status,
        'post_author'    => get_current_user_id(),
        'post_content'   => $post->post_content,
        'post_excerpt'   => $post->post_excerpt,
        'post_name'      => $post->post_name,
        'post_parent'    => $post->post_parent,
        'post_password'  => $post->post_password,
        'post_status'    => 'draft', // Always set as draft first
        'post_title'     => $post->post_title,
        'post_type'      => $post->post_type,
        'to_ping'        => $post->to_ping,
        'menu_order'     => $post->menu_order
    ];
    
    // Insert the new post
    $new_post_id = wp_insert_post($args);
    
    if ($new_post_id) {
        // Get all taxonomies of the original post
        $taxonomies = get_object_taxonomies($post->post_type);
        
        // Copy taxonomies
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_post_terms($post_id, $taxonomy, ['fields' => 'slugs']);
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }
        
        // Copy post meta (except those that shouldn't be copied)
        $post_meta = get_post_meta($post_id);
        
        if ($post_meta) {
            foreach ($post_meta as $meta_key => $meta_values) {
                // Skip meta values that should not be duplicated
                if (in_array($meta_key, ['_edit_lock', '_edit_last'])) {
                    continue;
                }
                
                foreach ($meta_values as $meta_value) {
                    add_post_meta($new_post_id, $meta_key, maybe_unserialize($meta_value));
                }
            }
        }
        
        // Redirect to admin posts list with a success message
        wp_safe_redirect(
            add_query_arg(
                [
                    'saved' => 1,
                    'esgi_duplicate' => $new_post_id
                ],
                admin_url('edit.php?post_type=' . $post->post_type)
            )
        );
        exit;
    } else {
        wp_die(__('Post duplication failed.', 'esgi-plugin'));
    }
}

// Hook into admin action
add_action('admin_action_esgi_duplicate_post', 'esgi_duplicate_post');

/**
 * Display success notice after duplication
 */
function esgi_admin_notices() {
    // Check if we need to display a success notice
    if (isset($_GET['saved']) && $_GET['saved'] == 1 && isset($_GET['esgi_duplicate'])) {
        $post_id = absint($_GET['esgi_duplicate']);
        $post_type = get_post_type($post_id);
        $post_type_obj = get_post_type_object($post_type);
        
        $message = sprintf(
            __('%s dupliqué avec succès.', 'esgi-plugin'),
            $post_type_obj ? $post_type_obj->labels->singular_name : __('Post', 'esgi-plugin')
        );
        
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($message) . '</p></div>';
    }
}

// Hook for displaying admin notices
add_action('admin_notices', 'esgi_admin_notices');