<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('template_redirect', 'esgi_redirect_home_urls');
function esgi_redirect_home_urls()
{
    // visiting /home redirect to /
    if (is_page('home') && !is_front_page()) {
        wp_redirect(home_url('/'), 301);
        exit;
    }

    // if theres a /home page that shouldnt be front page, redirect
    $home_page = get_page_by_path('home');
    if ($home_page && is_page($home_page->ID) && !is_front_page()) {
        wp_redirect(home_url('/'), 301);
        exit;
    }
}

// consistent URL structure in menus
add_filter('wp_nav_menu_objects', 'esgi_fix_home_menu_urls', 10, 2);
function esgi_fix_home_menu_urls($items, $args)
{
    foreach ($items as $item) {
        // convert /home url to homepage url
        if ($item->url === home_url('/home') || $item->url === home_url('/home/')) {
            $item->url = home_url('/');
        }
    }
    return $items;
}

// consistent homepage url handling in cp
add_action('init', 'esgi_setup_homepage_redirects');
function esgi_setup_homepage_redirects()
{
    // remove any /home page from being set as front page
    if (get_option('page_on_front')) {
        $front_page = get_post(get_option('page_on_front'));
        if ($front_page && $front_page->post_name === 'home') {
            // If a page named 'home' is set as front page, keep it but verify url consistency
            add_filter('home_url', 'esgi_clean_home_url', 10, 4);
        }
    }
}

// clean home url to always be the base url
function esgi_clean_home_url($url, $path, $orig_scheme, $blog_id)
{
    if ($path === '/home' || $path === '/home/') {
        return untrailingslashit($url);
    }
    return $url;
}

// Handle canonical url for homepage consistency
add_action('wp_head', 'esgi_homepage_canonical');
function esgi_homepage_canonical()
{
    if (is_front_page() || is_home()) {
        echo '<link rel="canonical" href="' . esc_url(home_url('/')) . '" />' . "\n";
    }
}

// current menu item highlighting for front page and blog-related pages
add_filter('nav_menu_css_class', 'esgi_fix_nav_current_class', 10, 2);
function esgi_fix_nav_current_class($classes, $item)
{
    // remove existing current class
    $classes = array_diff($classes, array('current_page_item', 'current-menu-item', 'current_page_parent', 'current-menu-parent'));    // check if we are on front page and this menu item links to homepage (but not on search pages)
    if ((is_front_page() || is_home()) && !is_search() && ($item->url == home_url('/') || $item->url == home_url())) {
        $classes[] = 'current-menu-item';
        $classes[] = 'current_page_item';
    }// if we are on a single post page, category, tag, archive, or search page and this menu item links to the blog page
    elseif ((is_single() || is_category() || is_tag() || is_date() || is_author() || is_archive() || is_search()) && 
            ($item->url == home_url('/blog') || $item->url == home_url('/blog/'))) {
        $classes[] = 'current-menu-item';
        $classes[] = 'current_page_item';
        $classes[] = 'current_page_parent';
    }    // other pages, wp handle it normally but verify consistency (excluding front page, home, and search pages)
    elseif (!is_front_page() && !is_home() && !is_search()) {
        global $wp;
        $current_url = home_url($wp->request);

        if ($item->url == $current_url || $item->url == $current_url . '/') {
            $classes[] = 'current-menu-item';
            $classes[] = 'current_page_item';
        }
    }

    return $classes;
}
