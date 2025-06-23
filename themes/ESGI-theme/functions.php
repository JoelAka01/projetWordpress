<?php


// no direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('ESGI_THEME_VERSION', '1.0.0');
define('ESGI_THEME_DIR', get_template_directory());
define('ESGI_THEME_URL', get_template_directory_uri());
define('ESGI_FUNCTIONS_DIR', ESGI_THEME_DIR . '/functions');

/**
 * - setup.php: theme setup and support
 * - assets.php: styles and scripts enqueuing  
 * - icons.php: svg icon helper functions
 * - customizer.php: wp customizer settings
 * - post-types.php: custom post types registration
 * - meta-boxes.php: meta boxes and custom fields
 * - admin.php: admin interface customizations
 * - helpers.php: helper functions for retrieving data
 * - url-handling.php: url rewriting and redirects
 */

$function_files = [
    'setup.php',
    'assets.php', 
    'icons.php',
    'customizer.php',
    'post-types.php',
    'meta-boxes.php',
    'admin.php',
    'helpers.php',
    'url-handling.php',
    'partners-admin.php',
];

foreach ($function_files as $file) {
    $file_path = ESGI_FUNCTIONS_DIR . '/' . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    } else {
        error_log('ESGI Theme: Missing function file - ' . $file_path);
    }
}

