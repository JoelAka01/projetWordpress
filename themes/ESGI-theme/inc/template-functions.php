<?php
// register custom page templates
function esgi_add_page_template_to_dropdown($templates)
{
    $templates['page-about.php'] = __('About Us Page', 'ESGI');
    $templates['page-services.php'] = __('Services Page', 'ESGI');
    $templates['page-partners.php'] = __('Partners Page', 'ESGI');

    return $templates;
}
add_filter('theme_page_templates', 'esgi_add_page_template_to_dropdown');

// register custom post types
add_action('init', 'esgi_register_custom_post_types');
function esgi_register_custom_post_types()
{
    // register member post type
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

    // register client post type
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

// custom meta boxes for posts and custom post types
add_action('add_meta_boxes', 'esgi_add_custom_meta_boxes');
function esgi_add_custom_meta_boxes()
{
    // meta box for regular posts
    add_meta_box(
        'esgi_post_custom_fields',
        __('Additional Post Information', 'ESGI'),
        'esgi_post_custom_fields_callback',
        'post',
        'normal',
        'high'
    );

    // meta box for members
    add_meta_box(
        'esgi_member_custom_fields',
        __('Member Information', 'ESGI'),
        'esgi_member_custom_fields_callback',
        'member',
        'normal',
        'high'
    );

    // meta box for clients
    add_meta_box(
        'esgi_client_custom_fields',
        __('Client Information', 'ESGI'),
        'esgi_client_custom_fields_callback',
        'client',
        'normal',
        'high'
    );
}

// custom fields for regular posts
function esgi_post_custom_fields_callback($post)
{
    wp_nonce_field('esgi_post_custom_fields_nonce', 'esgi_post_custom_fields_nonce');
    
    $subtitle = get_post_meta($post->ID, '_esgi_post_subtitle', true);
    $featured_quote = get_post_meta($post->ID, '_esgi_post_featured_quote', true);
    $reading_time = get_post_meta($post->ID, '_esgi_post_reading_time', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="esgi_post_subtitle">' . __('Subtitle', 'ESGI') . '</label></th>';
    echo '<td><input type="text" id="esgi_post_subtitle" name="esgi_post_subtitle" value="' . esc_attr($subtitle) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_post_featured_quote">' . __('Featured Quote', 'ESGI') . '</label></th>';
    echo '<td><textarea id="esgi_post_featured_quote" name="esgi_post_featured_quote" rows="3" class="large-text">' . esc_textarea($featured_quote) . '</textarea></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_post_reading_time">' . __('Reading Time (minutes)', 'ESGI') . '</label></th>';
    echo '<td><input type="number" id="esgi_post_reading_time" name="esgi_post_reading_time" value="' . esc_attr($reading_time) . '" min="1" max="60" /></td>';
    echo '</tr>';
    echo '</table>';
}

// custom fields for members
function esgi_member_custom_fields_callback($post)
{
    wp_nonce_field('esgi_member_custom_fields_nonce', 'esgi_member_custom_fields_nonce');
    
    $position = get_post_meta($post->ID, '_esgi_member_position', true);
    $department = get_post_meta($post->ID, '_esgi_member_department', true);
    $linkedin = get_post_meta($post->ID, '_esgi_member_linkedin', true);
    $twitter = get_post_meta($post->ID, '_esgi_member_twitter', true);
    $email = get_post_meta($post->ID, '_esgi_member_email', true);
    $phone = get_post_meta($post->ID, '_esgi_member_phone', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="esgi_member_position">' . __('Position', 'ESGI') . '</label></th>';
    echo '<td><input type="text" id="esgi_member_position" name="esgi_member_position" value="' . esc_attr($position) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_member_department">' . __('Department', 'ESGI') . '</label></th>';
    echo '<td><input type="text" id="esgi_member_department" name="esgi_member_department" value="' . esc_attr($department) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_member_email">' . __('Email', 'ESGI') . '</label></th>';
    echo '<td><input type="email" id="esgi_member_email" name="esgi_member_email" value="' . esc_attr($email) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_member_phone">' . __('Phone', 'ESGI') . '</label></th>';
    echo '<td><input type="tel" id="esgi_member_phone" name="esgi_member_phone" value="' . esc_attr($phone) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_member_linkedin">' . __('LinkedIn URL', 'ESGI') . '</label></th>';
    echo '<td><input type="url" id="esgi_member_linkedin" name="esgi_member_linkedin" value="' . esc_attr($linkedin) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_member_twitter">' . __('Twitter URL', 'ESGI') . '</label></th>';
    echo '<td><input type="url" id="esgi_member_twitter" name="esgi_member_twitter" value="' . esc_attr($twitter) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '</table>';
}

// custom fields for clients
function esgi_client_custom_fields_callback($post)
{
    wp_nonce_field('esgi_client_custom_fields_nonce', 'esgi_client_custom_fields_nonce');
    
    $company_name = get_post_meta($post->ID, '_esgi_client_company_name', true);
    $industry = get_post_meta($post->ID, '_esgi_client_industry', true);
    $website = get_post_meta($post->ID, '_esgi_client_website', true);
    $project_start = get_post_meta($post->ID, '_esgi_client_project_start', true);
    $project_end = get_post_meta($post->ID, '_esgi_client_project_end', true);
    $testimonial = get_post_meta($post->ID, '_esgi_client_testimonial', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="esgi_client_company_name">' . __('Company Name', 'ESGI') . '</label></th>';
    echo '<td><input type="text" id="esgi_client_company_name" name="esgi_client_company_name" value="' . esc_attr($company_name) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_client_industry">' . __('Industry', 'ESGI') . '</label></th>';
    echo '<td><input type="text" id="esgi_client_industry" name="esgi_client_industry" value="' . esc_attr($industry) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_client_website">' . __('Website', 'ESGI') . '</label></th>';
    echo '<td><input type="url" id="esgi_client_website" name="esgi_client_website" value="' . esc_attr($website) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_client_project_start">' . __('Project Start Date', 'ESGI') . '</label></th>';
    echo '<td><input type="date" id="esgi_client_project_start" name="esgi_client_project_start" value="' . esc_attr($project_start) . '" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_client_project_end">' . __('Project End Date', 'ESGI') . '</label></th>';
    echo '<td><input type="date" id="esgi_client_project_end" name="esgi_client_project_end" value="' . esc_attr($project_end) . '" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="esgi_client_testimonial">' . __('Client Testimonial', 'ESGI') . '</label></th>';
    echo '<td><textarea id="esgi_client_testimonial" name="esgi_client_testimonial" rows="4" class="large-text">' . esc_textarea($testimonial) . '</textarea></td>';
    echo '</tr>';
    echo '</table>';
}

// save custom fields
add_action('save_post', 'esgi_save_custom_fields');
function esgi_save_custom_fields($post_id)
{
    // check if user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // save post custom fields
    if (isset($_POST['esgi_post_custom_fields_nonce']) && wp_verify_nonce($_POST['esgi_post_custom_fields_nonce'], 'esgi_post_custom_fields_nonce')) {
        if (isset($_POST['esgi_post_subtitle'])) {
            update_post_meta($post_id, '_esgi_post_subtitle', sanitize_text_field($_POST['esgi_post_subtitle']));
        }
        if (isset($_POST['esgi_post_featured_quote'])) {
            update_post_meta($post_id, '_esgi_post_featured_quote', sanitize_textarea_field($_POST['esgi_post_featured_quote']));
        }
        if (isset($_POST['esgi_post_reading_time'])) {
            update_post_meta($post_id, '_esgi_post_reading_time', intval($_POST['esgi_post_reading_time']));
        }
    }

    // save member custom fields
    if (isset($_POST['esgi_member_custom_fields_nonce']) && wp_verify_nonce($_POST['esgi_member_custom_fields_nonce'], 'esgi_member_custom_fields_nonce')) {
        $member_fields = array(
            'esgi_member_position' => 'sanitize_text_field',
            'esgi_member_department' => 'sanitize_text_field',
            'esgi_member_email' => 'sanitize_email',
            'esgi_member_phone' => 'sanitize_text_field',
            'esgi_member_linkedin' => 'esc_url_raw',
            'esgi_member_twitter' => 'esc_url_raw',
        );

        foreach ($member_fields as $field => $sanitize_func) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, $sanitize_func($_POST[$field]));
            }
        }
    }

    // save client custom fields
    if (isset($_POST['esgi_client_custom_fields_nonce']) && wp_verify_nonce($_POST['esgi_client_custom_fields_nonce'], 'esgi_client_custom_fields_nonce')) {
        $client_fields = array(
            'esgi_client_company_name' => 'sanitize_text_field',
            'esgi_client_industry' => 'sanitize_text_field',
            'esgi_client_website' => 'esc_url_raw',
            'esgi_client_project_start' => 'sanitize_text_field',
            'esgi_client_project_end' => 'sanitize_text_field',
            'esgi_client_testimonial' => 'sanitize_textarea_field',
        );

        foreach ($client_fields as $field => $sanitize_func) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, $sanitize_func($_POST[$field]));
            }
        }
    }
}

// helpers to get custom fields
function esgi_get_post_subtitle($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_esgi_post_subtitle', true);
}

function esgi_get_post_featured_quote($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_esgi_post_featured_quote', true);
}

function esgi_get_post_reading_time($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_esgi_post_reading_time', true);
}

function esgi_get_member_field($field, $post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_esgi_member_' . $field, true);
}

function esgi_get_client_field($field, $post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_esgi_client_' . $field, true);
}

// custom columns to admin list views
add_filter('manage_member_posts_columns', 'esgi_member_columns');
function esgi_member_columns($columns)
{
    $columns['position'] = __('Position', 'ESGI');
    $columns['department'] = __('Department', 'ESGI');
    return $columns;
}

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

add_filter('manage_client_posts_columns', 'esgi_client_columns');
function esgi_client_columns($columns)
{
    $columns['company'] = __('Company', 'ESGI');
    $columns['industry'] = __('Industry', 'ESGI');
    return $columns;
}

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

// Flush rewrite rules on theme activation to ensure custom post types work
add_action('after_switch_theme', 'esgi_flush_rewrite_rules');
function esgi_flush_rewrite_rules()
{
    esgi_register_custom_post_types();
    flush_rewrite_rules();
}

// custom post types to main query on archive pages
add_action('pre_get_posts', 'esgi_include_custom_post_types_in_search');
function esgi_include_custom_post_types_in_search($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search()) {
            $query->set('post_type', array('post', 'member', 'client'));
        }
    }
}

// custom meta box styles
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
