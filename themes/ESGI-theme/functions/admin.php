<?php


// no direct access
if (!defined('ABSPATH')) {
    exit;
}

//custom columns for member posts list

add_filter('manage_member_posts_columns', 'esgi_member_columns');
function esgi_member_columns($columns)
{
    $columns['position'] = __('Position', 'ESGI');
    $columns['department'] = __('Department', 'ESGI');
    return $columns;
}

//display content for member custom columns

add_action('manage_member_posts_custom_column', 'esgi_member_column_content', 10, 2);
function esgi_member_column_content($column, $post_id)
{
    switch ($column) {
        case 'position':
            echo esc_html(get_post_meta($post_id, '_esgi_member_position', true));
            break;
        case 'department':
            echo esc_html(get_post_meta($post_id, '_esgi_member_department', true));
            break;
    }
}

//custom columns for client posts list
add_filter('manage_client_posts_columns', 'esgi_client_columns');
function esgi_client_columns($columns)
{
    $columns['company'] = __('Company', 'ESGI');
    $columns['industry'] = __('Industry', 'ESGI');
    return $columns;
}

//display content for client custom columns
add_action('manage_client_posts_custom_column', 'esgi_client_column_content', 10, 2);
function esgi_client_column_content($column, $post_id)
{
    switch ($column) {
        case 'company':
            echo esc_html(get_post_meta($post_id, '_esgi_client_company_name', true));
            break;
        case 'industry':
            echo esc_html(get_post_meta($post_id, '_esgi_client_industry', true));
            break;
    }
}

//custom meta box styles
add_action('admin_head', 'esgi_admin_styles');
function esgi_admin_styles()
{
    echo '<style>
        .form-table th {
            width: 150px;
        }
        .form-table td input[type="text"],
        .form-table td input[type="email"],
        .form-table td input[type="url"],
        .form-table td input[type="tel"],
        .form-table td textarea {
            width: 100%;
            max-width: 400px;
        }
        .form-table td input[type="number"],
        .form-table td input[type="date"] {
            width: 200px;
        }
    </style>';
}
