<?php

if (!defined('ABSPATH')) {
    exit;
}

// Get post subtitle
function esgi_get_post_subtitle($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_esgi_post_subtitle', true);
}

// get post featured quote
function esgi_get_post_featured_quote($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_esgi_post_featured_quote', true);
}

// get post reading time
function esgi_get_post_reading_time($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_esgi_post_reading_time', true);
}

// get post main image
function esgi_get_post_main_image($post_id = null, $size = 'large')
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    $image_id = get_post_meta($post_id, '_esgi_post_main_image', true);
    if ($image_id) {
        return wp_get_attachment_image($image_id, $size);
    }
    return false;
}

// get post main image url
function esgi_get_post_main_image_url($post_id = null, $size = 'large')
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    $image_id = get_post_meta($post_id, '_esgi_post_main_image', true);
    if ($image_id) {
        return wp_get_attachment_image_url($image_id, $size);
    }
    return false;
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


function esgi_get_member_fields($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return array(
        'position' => esgi_get_member_field('position', $post_id),
        'department' => esgi_get_member_field('department', $post_id),
        'email' => esgi_get_member_field('email', $post_id),
        'phone' => esgi_get_member_field('phone', $post_id),
        'linkedin' => esgi_get_member_field('linkedin', $post_id),
        'twitter' => esgi_get_member_field('twitter', $post_id),
    );
}


function esgi_get_client_fields($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return array(
        'company_name' => esgi_get_client_field('company_name', $post_id),
        'industry' => esgi_get_client_field('industry', $post_id),
        'website' => esgi_get_client_field('website', $post_id),
        'project_start' => esgi_get_client_field('project_start', $post_id),
        'project_end' => esgi_get_client_field('project_end', $post_id),
        'testimonial' => esgi_get_client_field('testimonial', $post_id),
    );
}


function esgi_format_date($date, $format = 'F j, Y')
{
    if (empty($date)) {
        return '';
    }
    
    $timestamp = strtotime($date);
    return $timestamp ? date_i18n($format, $timestamp) : '';
}


function esgi_get_social_urls()
{
    return array(
        'twitter' => get_theme_mod('url_twitter', ''),
        'facebook' => get_theme_mod('url_facebook', ''),
        'google' => get_theme_mod('url_google', ''),
        'linkedin' => get_theme_mod('url_linkedin', ''),
    );
}

// Check if any social media url are configed
function esgi_has_social_urls()
{
    $urls = esgi_get_social_urls();
    return !empty(array_filter($urls));
}


function esgi_get_service_data($service_number)
{
    return array(
        'title' => get_theme_mod('service_title_' . $service_number, 'Service ' . $service_number),
        'description' => get_theme_mod('service_description_' . $service_number, 'Description for service ' . $service_number),
        'image' => get_theme_mod('service_image_' . $service_number, ''),
    );
}


function esgi_get_partner_data($partner_number)
{
    return array(
        'name' => get_theme_mod('partner_name_' . $partner_number, 'Partner ' . $partner_number),
        'url' => get_theme_mod('partner_url_' . $partner_number, ''),
        'logo' => get_theme_mod('partner_logo_' . $partner_number, ''),
    );
}

// truncate text to a specific length
function esgi_truncate_text($text, $length = 100, $suffix = '...')
{
    if (strlen($text) <= $length) {
        return $text;
    }
    
    return substr($text, 0, $length) . $suffix;
}

// translate category names to match mockup
function esgi_translate_category_name($category_name)
{
    if ($category_name === 'Non classé') {
        return 'Uncategorized';
    }
    return $category_name;
}

// custom categories list with translation
function esgi_list_categories($args = array())
{
    $defaults = array(
        'title_li' => '',
        'show_count' => false,
        'number' => 5,
        'echo' => false
    );
    
    $args = wp_parse_args($args, $defaults);
    $categories_html = wp_list_categories($args);
    
    // Replace fr category names with eng ones
    $categories_html = str_replace('Non classé', 'Uncategorized', $categories_html);
    
    echo $categories_html;
}

// Get about section image ( who_are_we_image setting)
function esgi_get_about_image_data()
{
    $image_setting = get_theme_mod('who_are_we_image');
    return [
        'url' => $image_setting,
        'has_custom' => !empty($image_setting),
        'default' => get_template_directory_uri() . '/src/images/png/2.png'
    ];
}

// Get hero section image
function esgi_get_hero_image_data()
{
    $hero_image = get_theme_mod('hero_image');
    return [
        'url' => $hero_image,
        'has_custom' => !empty($hero_image),
        'default' => get_template_directory_uri() . '/src/images/png/1.png'
    ];
}
