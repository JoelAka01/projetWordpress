<?php
if (!defined('ABSPATH')) {
    exit;
}

// register navigation menu
add_action('after_setup_theme', 'esgi_register_nav_menu', 0);
function esgi_register_nav_menu()
{
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'ESGI'),
        'footer_menu'  => __('Footer Menu', 'ESGI'),
        'post_footer_menu' => __('Post Footer Menu', 'ESGI'),
    ));
}

// theme support for features
add_action('after_setup_theme', 'esgi_add_theme_support', 0);
function esgi_add_theme_support()
{
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

// custom title filter (disabled)
function esgi_custom_title($title)
{
    return strtoupper($title);
}
// add_filter('the_title', 'esgi_custom_title', 10, 1);
