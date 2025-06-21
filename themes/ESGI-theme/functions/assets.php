<?php

if (!defined('ABSPATH')) {
    exit;
}

//enqueue theme styles and scripts
add_action('wp_enqueue_scripts', 'esgi_enqueue_assets', 10);
function esgi_enqueue_assets()
{
    // Main style versioning based on file modification time
    wp_enqueue_style(
        'main', 
        get_stylesheet_uri(), 
        array(), 
        filemtime(get_stylesheet_directory() . '/style.css')
    );
    
    // google fonts - Overpass
    wp_enqueue_style(
        'google-fonts', 
        'https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&display=swap', 
        array(), 
        null
    );
    
    // menu js
    wp_enqueue_script(
        'esgi-menu', 
        get_template_directory_uri() . '/src/js/menu.js', 
        array(), 
        filemtime(get_template_directory() . '/src/js/menu.js'), 
        true
    );
}
