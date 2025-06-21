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
