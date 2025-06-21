<?php

if (!defined('ABSPATH')) {
    exit;
}

// meta boxes for posts and custom post types
add_action('add_meta_boxes', 'esgi_add_custom_meta_boxes');
function esgi_add_custom_meta_boxes()
{
    // for regular posts
    add_meta_box(
        'esgi_post_custom_fields',
        __('Additional Post Information', 'ESGI'),
        'esgi_post_custom_fields_callback',
        'post',
        'normal',
        'high'
    );

    // for members
    add_meta_box(
        'esgi_member_custom_fields',
        __('Member Information', 'ESGI'),
        'esgi_member_custom_fields_callback',
        'member',
        'normal',
        'high'
    );

    // for clients
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

// for members
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

// for clients
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
    // check user permission to edit post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // save post custom field
    if (isset($_POST['esgi_post_custom_fields_nonce']) && wp_verify_nonce($_POST['esgi_post_custom_fields_nonce'], 'esgi_post_custom_fields_nonce')) {
        esgi_save_post_fields($post_id);
    }

    // save member custom field
    if (isset($_POST['esgi_member_custom_fields_nonce']) && wp_verify_nonce($_POST['esgi_member_custom_fields_nonce'], 'esgi_member_custom_fields_nonce')) {
        esgi_save_member_fields($post_id);
    }

    // save client custom field
    if (isset($_POST['esgi_client_custom_fields_nonce']) && wp_verify_nonce($_POST['esgi_client_custom_fields_nonce'], 'esgi_client_custom_fields_nonce')) {
        esgi_save_client_fields($post_id);
    }
}

// save post fields
function esgi_save_post_fields($post_id)
{
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

// save member fields
function esgi_save_member_fields($post_id)
{
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

// save client fields
function esgi_save_client_fields($post_id)
{
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
