<?php
// no direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register customizer settings and controls
add_action('customize_register', 'esgi_customize_register');
function esgi_customize_register($wp_customize)
{
    // General settings
    $wp_customize->add_section('esgi_general', [
        'title' => __('General Settings', 'ESGI'),
        'priority' => 1,
        'capability' => 'edit_theme_options',
    ]);

    // main color setting
    $wp_customize->add_setting('main_color', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '#3f51b5',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_color', [
        'label' => __('Main Color', 'ESGI'),
        'section' => 'esgi_general',
        'priority' => 1,
    ]));

    // social media link
    esgi_add_social_media_settings($wp_customize);

    // Hero
    esgi_add_hero_section($wp_customize);

    // About  
    esgi_add_about_section($wp_customize);

    // Services
    esgi_add_services_section($wp_customize);

    // Partners
    esgi_add_partners_section($wp_customize);

    // Footer
    esgi_add_footer_section($wp_customize);

    // additional aettings
    esgi_add_additional_settings($wp_customize);
}

// social media settings
function esgi_add_social_media_settings($wp_customize)
{
    $social_networks = [
        'linkedin' => ['LinkedIn', 'https://linkedin.com'],
        'facebook' => ['Facebook', 'https://facebook.com'],
        'twitter' => ['Twitter', ''],
        'google' => ['Google', ''],
    ];

    foreach ($social_networks as $network => $data) {
        $wp_customize->add_setting($network . '_url', [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => $data[1],
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control($network . '_url', [
            'label' => sprintf(__('%s URL', 'ESGI'), $data[0]),
            'section' => 'esgi_general',
            'type' => 'url',
            'priority' => 3,
        ]);

        // url_ prefixed versions for backward
        $wp_customize->add_setting('url_' . $network, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => $data[1],
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control('url_' . $network, [
            'label' => sprintf(__('URL %s', 'ESGI'), $data[0]),
            'section' => 'esgi_general',
            'type' => 'url',
            'priority' => 4,
        ]);
    }
}

// hero settings
function esgi_add_hero_section($wp_customize)
{
    $wp_customize->add_section('esgi_hero', [
        'title' => __('Hero Section', 'ESGI'),
        'priority' => 2,
        'capability' => 'edit_theme_options',
    ]);

    $wp_customize->add_setting('hero_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'A really professional structure for all your events!',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('hero_title', [
        'label' => __('Hero Title', 'ESGI'),
        'section' => 'esgi_hero',
        'type' => 'text',
        'priority' => 1,
    ]);

    $wp_customize->add_setting('hero_image', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', [
        'label' => __('Hero Image', 'ESGI'),
        'section' => 'esgi_hero',
        'priority' => 2,
    ]));
}

// about section settings
function esgi_add_about_section($wp_customize)
{
    $wp_customize->add_section('esgi_about', [
        'title' => __('About Section', 'ESGI'),
        'priority' => 3,
        'capability' => 'edit_theme_options',
    ]);

    // About fields
    $about_fields = [
        'about_title' => ['About Us', 'text', 'About Title'],
        'about_description' => ['Specializing in the creation of exceptional events for private and corporate clients, we design, plan and manage every project from conception to execution.', 'textarea', 'About Description'],
        'who_are_we_title' => ['Who are we?', 'text', 'Who Are We Title'],
        'who_are_we_content' => ['Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suspendisse eu commodo est, at commodo magna.', 'textarea', 'Who Are We Content'],
        'vision_title' => ['Our vision', 'text', 'Vision Title'],
        'vision_content' => ['Nullam faucibus interdum massa. Duis eget felis mollis, pulvinar velit sit amet, consequat tortor. Suspendisse commodo magna eros, ut turpis massa porta pharetra. Fusce vehicula aliquot amet non ultricies.', 'textarea', 'Vision Content'],
        'mission_title' => ['Our mission', 'text', 'Mission Title'],
        'mission_content' => ['Vivamus ac dictum neque, at elementum ipsum. Aliquam eget convallis diam, quis cursus tortor. Aliquam suscipit eros ut amet velit malesuada eleifum. Fusce in venenatis nulla. Donec quis lorem ut magna tincidunt egestas.', 'textarea', 'Mission Content'],
    ];

    $priority = 1;
    foreach ($about_fields as $field => $data) {
        $wp_customize->add_setting($field, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => $data[0],
            'transport' => 'refresh',
            'sanitize_callback' => $data[1] === 'textarea' ? 'wp_kses_post' : 'sanitize_text_field',
        ]);

        $wp_customize->add_control($field, [
            'label' => __($data[2], 'ESGI'),
            'section' => 'esgi_about',
            'type' => $data[1],
            'priority' => $priority++,
        ]);    }

    // about image
    $wp_customize->add_setting('who_are_we_image', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'who_are_we_image', [
        'label' => __('About Image', 'ESGI'),
        'section' => 'esgi_about',
        'priority' => $priority++,
    ]));
}

//services settings
function esgi_add_services_section($wp_customize)
{
    $wp_customize->add_section('esgi_services', [
        'title' => __('Services Section', 'ESGI'),
        'priority' => 4,
        'capability' => 'edit_theme_options',
    ]);

    $wp_customize->add_setting('services_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Our Services',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('services_title', [
        'label' => __('Services Section Title', 'ESGI'),
        'section' => 'esgi_services',
        'type' => 'text',
        'priority' => 1,
    ]);

    // settings for 3 services
    for ($i = 1; $i <= 3; $i++) {
        $priority = $i * 3 - 1;

        $wp_customize->add_setting('service_title_' . $i, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => 'Service ' . $i,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control('service_title_' . $i, [
            'label' => sprintf(__('Service %d Title', 'ESGI'), $i),
            'section' => 'esgi_services',
            'type' => 'text',
            'priority' => $priority,
        ]);

        $wp_customize->add_setting('service_description_' . $i, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => 'Description for service ' . $i,
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_kses_post',
        ]);

        $wp_customize->add_control('service_description_' . $i, [
            'label' => sprintf(__('Service %d Description', 'ESGI'), $i),
            'section' => 'esgi_services',
            'type' => 'textarea',
            'priority' => $priority + 1,
        ]);

        $wp_customize->add_setting('service_image_' . $i, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'service_image_' . $i, [
            'label' => sprintf(__('Service %d Image', 'ESGI'), $i),
            'section' => 'esgi_services',
            'priority' => $priority + 2,
        ]));
    }
}

// partners section settings
function esgi_add_partners_section($wp_customize)
{
    $wp_customize->add_section('esgi_partners', [
        'title' => __('Partners Section', 'ESGI'),
        'priority' => 5,
        'capability' => 'edit_theme_options',
        'description' => __('Note: For full management with unlimited partners, go to Appearance > Partners in your admin dashboard.', 'ESGI'),
    ]);

    $wp_customize->add_setting('partners_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Our Partners',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('partners_title', [
        'label' => __('Partners Section Title', 'ESGI'),
        'section' => 'esgi_partners',
        'type' => 'text',
        'priority' => 1,
    ]);

    // Add notice about new admin page
    $wp_customize->add_setting('partners_admin_notice', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => '__return_false',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'partners_admin_notice', [
        'label' => __('New Partner Management', 'ESGI'),
        'section' => 'esgi_partners',
        'type' => 'hidden',
        'description' => __('<strong>Upgrade Available!</strong><br>We\'ve added a new partner management system that allows unlimited partners with better organization.<br><br><a href="' . admin_url('themes.php?page=esgi-partners') . '" target="_blank">Go to Partners Management →</a>', 'ESGI'),
        'priority' => 2,
    ]));

    // settings for 6 partners (legacy support)
    for ($i = 1; $i <= 6; $i++) {
        $priority = $i * 3 + 2;

        $wp_customize->add_setting('partner_name_' . $i, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => 'Partner ' . $i,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control('partner_name_' . $i, [
            'label' => sprintf(__('Partner %d Name', 'ESGI'), $i),
            'section' => 'esgi_partners',
            'type' => 'text',
            'priority' => $priority,
        ]);

        $wp_customize->add_setting('partner_url_' . $i, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control('partner_url_' . $i, [
            'label' => sprintf(__('Partner %d URL', 'ESGI'), $i),
            'section' => 'esgi_partners',
            'type' => 'url',
            'priority' => $priority + 1,
        ]);

        $wp_customize->add_setting('partner_logo_' . $i, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'partner_logo_' . $i, [
            'label' => sprintf(__('Partner %d Logo', 'ESGI'), $i),
            'section' => 'esgi_partners',
            'priority' => $priority + 2,
        ]));
    }
}

//footer settings
function esgi_add_footer_section($wp_customize)
{
    $wp_customize->add_section('esgi_footer', [
        'title' => __('Footer Section', 'ESGI'),
        'priority' => 6,
        'capability' => 'edit_theme_options',
    ]);

    $footer_fields = [
        'footer_contact_title' => ['Manager', 'text', 'Contact Title'],
        'footer_contact_phone' => ['+33 1 53 31 25 23', 'text', 'Contact Phone'],
        'footer_contact_email' => ['info@esgi.com', 'email', 'Contact Email'],
        'footer_ceo_title' => ['CEO', 'text', 'CEO Title'],
        'footer_ceo_phone' => ['+33 1 53 31 25 25', 'text', 'CEO Phone'],
        'footer_ceo_email' => ['ceo@company.com', 'email', 'CEO Email'],
        'footer_copyright' => ['2022 Figma Template by ESGI', 'text', 'Copyright Text'],
    ];

    $priority = 1;
    foreach ($footer_fields as $field => $data) {
        $sanitize_callback = $data[1] === 'email' ? 'sanitize_email' : 'sanitize_text_field';
        
        $wp_customize->add_setting($field, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => $data[0],
            'transport' => 'refresh',
            'sanitize_callback' => $sanitize_callback,
        ]);

        $wp_customize->add_control($field, [
            'label' => __($data[2], 'ESGI'),
            'section' => 'esgi_footer',
            'type' => $data[1],
            'priority' => $priority++,
        ]);
    }
}

//settings
function esgi_add_additional_settings($wp_customize)
{
    // additional parameters
    $wp_customize->add_section('esgi_param', [
        'title' => __('Additional Settings', 'ESGI'),
        'priority' => 7,
        'capability' => 'edit_theme_options',
    ]);

    // footer search setting
    $wp_customize->add_setting('has_footer_search', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'esgi_sanitize_bool_value',
    ]);

    $wp_customize->add_control('has_footer_search', [
        'type' => 'checkbox',
        'section' => 'esgi_param',
        'label' => __('Footer Search', 'ESGI'),
        'description' => __('Display search form in footer', 'ESGI'),
        'priority' => 1,
    ]);

    // uppercase titles setting
    $wp_customize->add_setting('uppercase_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'esgi_sanitize_bool_value',
    ]);

    $wp_customize->add_control('uppercase_title', [
        'type' => 'checkbox',
        'section' => 'esgi_param',
        'label' => __('Uppercase Titles', 'ESGI'),
        'description' => __('Display all titles in uppercase', 'ESGI'),
        'priority' => 2,
    ]);
}

// validate boolean values
function esgi_sanitize_bool_value($value)
{
    return (bool) $value;
}

//custom css in head based on customizer settings
add_action('wp_head', 'esgi_customizer_css', 99);
function esgi_customizer_css()
{
    $main_color = get_theme_mod('main_color', '#3f51b5');
    echo '<style>:root{ --main-color: ' . esc_attr($main_color) . '}</style>';
}

//body classes based on customizer settings
add_filter('body_class', 'esgi_customizer_body_class');
function esgi_customizer_body_class($classes)
{
    if (get_theme_mod('dark_mode', false)) {
        $classes[] = 'dark';
    }
    return $classes;
}

//title filter for uppercase
add_action('init', 'esgi_maybe_add_title_filter');
function esgi_maybe_add_title_filter()
{
    if (get_theme_mod('uppercase_title', false)) {
        add_filter('the_title', 'esgi_custom_title', 10, 1);
    }
}
