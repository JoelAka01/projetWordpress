<?php

if (!defined('ABSPATH')) {
    exit;
}

// register custom post types
add_action('init', 'esgi_register_custom_post_types');
function esgi_register_custom_post_types()
{
    esgi_register_member_post_type();
    esgi_register_client_post_type();
}

// register member post type
function esgi_register_member_post_type()
{
    register_post_type('member', array(
        'labels' => array(
            'name' => __('Members', 'ESGI'),
            'singular_name' => __('Member', 'ESGI'),
            'add_new' => __('Add New Member', 'ESGI'),
            'add_new_item' => __('Add New Member', 'ESGI'),
            'edit_item' => __('Edit Member', 'ESGI'),
            'new_item' => __('New Member', 'ESGI'),
            'view_item' => __('View Member', 'ESGI'),
            'search_items' => __('Search Members', 'ESGI'),
            'not_found' => __('No members found', 'ESGI'),
            'not_found_in_trash' => __('No members found in trash', 'ESGI'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'members'),
        'show_in_rest' => true,
    ));
}

// register client post type
function esgi_register_client_post_type()
{
    register_post_type('client', array(
        'labels' => array(
            'name' => __('Clients', 'ESGI'),
            'singular_name' => __('Client', 'ESGI'),
            'add_new' => __('Add New Client', 'ESGI'),
            'add_new_item' => __('Add New Client', 'ESGI'),
            'edit_item' => __('Edit Client', 'ESGI'),
            'new_item' => __('New Client', 'ESGI'),
            'view_item' => __('View Client', 'ESGI'),
            'search_items' => __('Search Clients', 'ESGI'),
            'not_found' => __('No clients found', 'ESGI'),
            'not_found_in_trash' => __('No clients found in trash', 'ESGI'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-building',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'clients'),
        'show_in_rest' => true,
    ));
}

// register custom page templates
add_filter('theme_page_templates', 'esgi_add_page_template_to_dropdown');
function esgi_add_page_template_to_dropdown($templates)
{
    $templates['page-about.php'] = __('About Us Page', 'ESGI');
    $templates['page-services.php'] = __('Services Page', 'ESGI');
    $templates['page-partners.php'] = __('Partners Page', 'ESGI');

    return $templates;
}

// include custom post types in search results
add_action('pre_get_posts', 'esgi_include_custom_post_types_in_search');
function esgi_include_custom_post_types_in_search($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search()) {
            $query->set('post_type', array('post', 'member', 'client'));
        }
    }
}

// Remove rewrite rules on theme activation to ensure custom post types work
add_action('after_switch_theme', 'esgi_flush_rewrite_rules');
function esgi_flush_rewrite_rules()
{
    esgi_register_custom_post_types();
    flush_rewrite_rules();
}
