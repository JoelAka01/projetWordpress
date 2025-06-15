<?php
// Enregistrer les emplacements de menu
add_action('after_setup_theme', 'esgi_register_nav_menu', 0);
function esgi_register_nav_menu()
{
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'ESGI'),
        'footer_menu'  => __('Footer Menu', 'ESGI'),
        'post_footer_menu' => __('Post Footer Menu', 'ESGI'),
    ));
}

add_action('wp_enqueue_scripts', 'esgi_enqueue_assets', 10);
function esgi_enqueue_assets()
{
    // main style file with versioning based on file modification time
    wp_enqueue_style('main', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));
    
    // google fonts - inter
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
}

add_action('after_setup_theme', 'esgi_add_theme_support', 0);
function esgi_add_theme_support()
{
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

// Ajout d'un filtre sur les titres
//add_filter('the_title', 'esgi_custom_title', 10, 1);
function esgi_custom_title($title)
{
    return strtoupper($title);
}

// Fonction helper pour l'affichage des svg

function esgi_getIcon($name)
{
    $markups = [
        'twitter' => '<svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M18 1.6875C17.325 2.025 16.65 2.1375 15.8625 2.25C16.65 1.8 17.2125 1.125 17.4375 0.225C16.7625 0.675 15.975 0.9 15.075 1.125C14.4 0.45 13.3875 0 12.375 0C10.4625 0 8.775 1.6875 8.775 3.7125C8.775 4.05 8.775 4.275 8.8875 4.5C5.85 4.3875 3.0375 2.925 1.2375 0.675C0.9 1.2375 0.7875 1.8 0.7875 2.5875C0.7875 3.825 1.4625 4.95 2.475 5.625C1.9125 5.625 1.35 5.4 0.7875 5.175C0.7875 6.975 2.025 8.4375 3.7125 8.775C3.375 8.8875 3.0375 8.8875 2.7 8.8875C2.475 8.8875 2.25 8.8875 2.025 8.775C2.475 10.2375 3.825 11.3625 5.5125 11.3625C4.275 12.375 2.7 12.9375 0.9 12.9375C0.5625 12.9375 0.3375 12.9375 0 12.9375C1.6875 13.95 3.6 14.625 5.625 14.625C12.375 14.625 16.0875 9 16.0875 4.1625C16.0875 4.05 16.0875 3.825 16.0875 3.7125C16.875 3.15 17.55 2.475 18 1.6875Z" fill="#1A1A1A"/>
</svg>',
        'facebook' => '<svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3.4008 18L3.375 10.125H0V6.75H3.375V4.5C3.375 1.4634 5.25545 0 7.9643 0C9.26187 0 10.3771 0.0966038 10.7021 0.139781V3.3132L8.82333 3.31406C7.35011 3.31406 7.06485 4.01411 7.06485 5.04139V6.75H11.25L10.125 10.125H7.06484V18H3.4008Z" fill="#1A1A1A"/>
</svg>',
        'google' => '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path id="Vector" d="M9.12143 7.71429V10.8H14.3929C14.1357 12.0857 12.85 14.6571 9.25 14.6571C6.16429 14.6571 3.72143 12.0857 3.72143 9C3.72143 5.91429 6.29286 3.34286 9.25 3.34286C11.05 3.34286 12.2071 4.11429 12.85 4.75714L15.2929 2.44286C13.75 0.9 11.6929 0 9.25 0C4.23572 0 0.25 3.98571 0.25 9C0.25 14.0143 4.23572 18 9.25 18C14.3929 18 17.8643 14.4 17.8643 9.25714C17.8643 8.61428 17.8643 8.22857 17.7357 7.71429H9.12143Z" fill="#1A1A1A"/>
</svg>',
        'linkedin' => '<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.9698 0H1.64687C1.19966 0 0.864258 0.335404 0.864258 0.782609V17.2174C0.864258 17.5528 1.19966 17.8882 1.64687 17.8882H18.0816C18.5289 17.8882 18.8643 17.5528 18.8643 17.1056V0.782609C18.7525 0.335404 18.4171 0 17.9698 0ZM3.54749 15.205V6.70807H6.23072V15.205H3.54749ZM4.8891 5.59006C3.99469 5.59006 3.32389 4.80745 3.32389 4.02484C3.32389 3.13043 3.99469 2.45963 4.8891 2.45963C5.78351 2.45963 6.45432 3.13043 6.45432 4.02484C6.34252 4.80745 5.67171 5.59006 4.8891 5.59006ZM16.0692 15.205H13.386V11.0683C13.386 10.0621 13.386 8.8323 12.0444 8.8323C10.7028 8.8323 10.4792 9.95031 10.4792 11.0683V15.3168H7.79593V6.70807H10.3674V7.82609C10.7028 7.15528 11.5972 6.48447 12.827 6.48447C15.5102 6.48447 15.9574 8.27329 15.9574 10.5093V15.205H16.0692Z" fill="#1A1A1A"/>
</svg>'
    ];
    return $markups[$name] ?? '';
}



// Parametres custom du thème (via le custom manager de WP)

add_action('customize_register', 'esgi_customize_register');
function esgi_customize_register($wp_customize)
{
    // // Ajout d'une section : General Settings
    $wp_customize->add_section('esgi_general', [
        'title' => __('General Settings', 'ESGI'),
        'priority' => 1,
        'capability' => 'edit_theme_options',
    ]);

    // Ajout d'un setting : Colors
    $wp_customize->add_setting('main_color', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '#3f51b5',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_color', [
        'label' => __('Main Color', 'ESGI'),
        'section' => 'esgi_general',
        'priority' => 1,    ]));
    
    // social media links
    $wp_customize->add_setting('linkedin_url', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'https://linkedin.com',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    
    $wp_customize->add_control('linkedin_url', [
        'label' => __('LinkedIn URL', 'ESGI'),
        'section' => 'esgi_general',
        'type' => 'url',
        'priority' => 3,
    ]);
      $wp_customize->add_setting('facebook_url', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'https://facebook.com',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    
    $wp_customize->add_control('facebook_url', [
        'label' => __('Facebook URL', 'ESGI'),
        'section' => 'esgi_general',
        'type' => 'url',
        'priority' => 4,
    ]);
    
    // hero
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
    
    // about
    $wp_customize->add_section('esgi_about', [
        'title' => __('About Section', 'ESGI'),
        'priority' => 3,
        'capability' => 'edit_theme_options',
    ]);
    
    $wp_customize->add_setting('about_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'About Us',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('about_title', [
        'label' => __('About Title', 'ESGI'),
        'section' => 'esgi_about',
        'type' => 'text',
        'priority' => 1,
    ]);
    
    $wp_customize->add_setting('about_description', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Specializing in the creation of exceptional events for private and corporate clients, we design, plan and manage every project from conception to execution.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    
    $wp_customize->add_control('about_description', [
        'label' => __('About Description', 'ESGI'),
        'section' => 'esgi_about',
        'type' => 'textarea',
        'priority' => 2,
    ]);
    
    $wp_customize->add_setting('about_image', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image', [
        'label' => __('About Image', 'ESGI'),
        'section' => 'esgi_about',
        'priority' => 3,
    ]));
    
    // who are we ?
    $wp_customize->add_setting('who_are_we_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Who are we?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('who_are_we_title', [
        'label' => __('Who Are We Title', 'ESGI'),
        'section' => 'esgi_about',
        'type' => 'text',
        'priority' => 4,
    ]);
    
    $wp_customize->add_setting('who_are_we_content', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suspendisse eu commodo est, at commodo magna.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    
    $wp_customize->add_control('who_are_we_content', [
        'label' => __('Who Are We Content', 'ESGI'),
        'section' => 'esgi_about',
        'type' => 'textarea',
        'priority' => 5,
    ]);
    
    $wp_customize->add_setting('who_are_we_image', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
    ]);
      $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'who_are_we_image', [
        'label' => __('Who Are We Image', 'ESGI'),
        'section' => 'esgi_about',
        'priority' => 6,
    ]));
    
    // vision
    $wp_customize->add_setting('vision_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Our vision',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('vision_title', [
        'label' => __('Vision Title', 'ESGI'),
        'section' => 'esgi_about',
        'type' => 'text',
        'priority' => 7,
    ]);
    
    $wp_customize->add_setting('vision_content', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Nullam faucibus interdum massa. Duis eget felis mollis, pulvinar velit sit amet, consequat tortor. Suspendisse commodo magna eros, ut turpis massa porta pharetra. Fusce vehicula aliquot amet non ultricies.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    
    $wp_customize->add_control('vision_content', [
        'label' => __('Vision Content', 'ESGI'),
        'section' => 'esgi_about',
        'type' => 'textarea',
        'priority' => 8,
    ]);
    
    // mission
    $wp_customize->add_setting('mission_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Our mission',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('mission_title', [
        'label' => __('Mission Title', 'ESGI'),
        'section' => 'esgi_about',
        'type' => 'text',
        'priority' => 9,
    ]);
    
    $wp_customize->add_setting('mission_content', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Vivamus ac dictum neque, at elementum ipsum. Aliquam eget convallis diam, quis cursus tortor. Aliquam suscipit eros ut amet velit malesuada eleifum. Fusce in venenatis nulla. Donec quis lorem ut magna tincidunt egestas.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    
    $wp_customize->add_control('mission_content', [
        'label' => __('Mission Content', 'ESGI'),
        'section' => 'esgi_about',
        'type' => 'textarea',
        'priority' => 10,
    ]);
    
    // services
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
    
    // settings for 3 service
    for ($i = 1; $i <= 3; $i++) {
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
            'priority' => $i * 3 - 1,
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
            'priority' => $i * 3,
        ]);
        
        $wp_customize->add_setting('service_image_' . $i, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        ]);
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'service_image_' . $i, [
            'label' => sprintf(__('Service %d Image', 'ESGI'), $i),
            'section' => 'esgi_services',
            'priority' => $i * 3 + 1,
        ]));
    }
    
    // partners
    $wp_customize->add_section('esgi_partners', [
        'title' => __('Partners Section', 'ESGI'),
        'priority' => 5,
        'capability' => 'edit_theme_options',
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
    
    // settings for 6 partners
    for ($i = 1; $i <= 6; $i++) {
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
            'priority' => $i * 3 - 1,
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
            'priority' => $i * 3,
        ]);
        
        $wp_customize->add_setting('partner_logo_' . $i, [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        ]);
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'partner_logo_' . $i, [
            'label' => sprintf(__('Partner %d Logo', 'ESGI'), $i),
            'section' => 'esgi_partners',
            'priority' => $i * 3 + 1,
        ]));
    }
    
    // footer
    $wp_customize->add_section('esgi_footer', [
        'title' => __('Footer Section', 'ESGI'),
        'priority' => 6,
        'capability' => 'edit_theme_options',
    ]);
    
    $wp_customize->add_setting('footer_contact_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'Manager',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('footer_contact_title', [
        'label' => __('Contact Title', 'ESGI'),
        'section' => 'esgi_footer',
        'type' => 'text',
        'priority' => 1,
    ]);
    
    $wp_customize->add_setting('footer_contact_phone', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '+33 1 53 31 25 23',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('footer_contact_phone', [
        'label' => __('Contact Phone', 'ESGI'),
        'section' => 'esgi_footer',
        'type' => 'text',
        'priority' => 2,
    ]);
    
    $wp_customize->add_setting('footer_contact_email', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'info@esgi.com',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_email',
    ]);
    
    $wp_customize->add_control('footer_contact_email', [
        'label' => __('Contact Email', 'ESGI'),
        'section' => 'esgi_footer',
        'type' => 'email',
        'priority' => 3,
    ]);
    
    $wp_customize->add_setting('footer_ceo_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'CEO',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('footer_ceo_title', [
        'label' => __('CEO Title', 'ESGI'),
        'section' => 'esgi_footer',
        'type' => 'text',
        'priority' => 4,
    ]);
      $wp_customize->add_setting('footer_ceo_phone', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '+33 1 53 31 25 25',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('footer_ceo_phone', [
        'label' => __('CEO Phone', 'ESGI'),
        'section' => 'esgi_footer',
        'type' => 'text',
        'priority' => 5,
    ]);
      $wp_customize->add_setting('footer_ceo_email', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'ceo@company.com',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_email',
    ]);
    
    $wp_customize->add_control('footer_ceo_email', [
        'label' => __('CEO Email', 'ESGI'),
        'section' => 'esgi_footer',
        'type' => 'email',
        'priority' => 6,
    ]);
      $wp_customize->add_setting('footer_copyright', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '2022 Figma Template by ESGI',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    
    $wp_customize->add_control('footer_copyright', [
        'label' => __('Copyright Text', 'ESGI'),
        'section' => 'esgi_footer',
        'type' => 'text',        'priority' => 7,
    ]);

    // Ajout d'un setting pour la recherche dans le footer
    $wp_customize->add_setting('has_footer_search', [
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => false,
        'transport' => 'refresh', // or postMessage
        'sanitize_callback' => 'sanitize_bool_value',
    ]);

    // Ajout d'un control pour la recherche dans le footer
    $wp_customize->add_control(
        'has_footer_search',
        [
            'type' => 'checkbox',
            'priority' => 3, // Within the section.
            'section' => 'esgi_param', // Required, core or custom.
            'label' => __('Recherche dans le footer', 'ESGI'),
            'description' => __('Afficher le formulaire de recherche dans le footer', 'ESGI'),
        ]
    );
    
    // Ajout des settings pour les urls des reseaux sociaux
    
    // Twitter
    $wp_customize->add_setting('url_twitter', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    
    $wp_customize->add_control(
        'url_twitter',
        [
            'type' => 'url',
            'priority' => 4,
            'section' => 'esgi_param',
            'label' => __('URL Twitter', 'ESGI'),
            'description' => __('URL vers votre profil Twitter', 'ESGI'),
        ]
    );
    
    // Facebook
    $wp_customize->add_setting('url_facebook', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    
    $wp_customize->add_control(
        'url_facebook',
        [
            'type' => 'url',
            'priority' => 5,
            'section' => 'esgi_param',
            'label' => __('URL Facebook', 'ESGI'),
            'description' => __('URL vers votre profil Facebook', 'ESGI'),
        ]
    );
    
    // Google
    $wp_customize->add_setting('url_google', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    
    $wp_customize->add_control(
        'url_google',
        [
            'type' => 'url',
            'priority' => 6,
            'section' => 'esgi_param',
            'label' => __('URL Google', 'ESGI'),
            'description' => __('URL vers votre profil Google', 'ESGI'),
        ]
    );
    
    // LinkedIn
    $wp_customize->add_setting('url_linkedin', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    
    $wp_customize->add_control(
        'url_linkedin',
        [
            'type' => 'url',
            'priority' => 7,
            'section' => 'esgi_param',
            'label' => __('URL LinkedIn', 'ESGI'),
            'description' => __('URL vers votre profil LinkedIn', 'ESGI'),
        ]
    );
    
    // Ajout d'un setting pour les titres en majuscules
    $wp_customize->add_setting('uppercase_title', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_bool_value',
    ]);
    
    // Ajout d'un control pour les titres en majuscules
    $wp_customize->add_control(        'uppercase_title',
        [
            'type' => 'checkbox',
            'priority' => 8,
            'section' => 'esgi_param',
            'label' => __('Titres en majuscules', 'ESGI'),
            'description' => __('Afficher tous les titres en majuscules', 'ESGI'),
        ]
    );

}

// helpers for customizer
function sanitize_bool_value($value)
{
    return (bool) $value;
}



// Prise en compte de la couleur principale custom
add_action('wp_head', 'esgi_wp_head', 99);
function esgi_wp_head()
{
    $main_color = get_theme_mod('main_color', '#3f51b5');
    echo '<style>:root{ --main-color: ' . $main_color . '}</style>';
}


// Prise en compte du mode dark
add_filter('body_class', 'esgi_body_class');
function esgi_body_class($classes)
{
    if (get_theme_mod('dark_mode', false)) {
        $classes[] = 'dark';
    }
    return $classes;
}

// Afficher les titres en majuscules
add_action('init', 'esgi_maybe_add_title_filter');
function esgi_maybe_add_title_filter()
{
    if (get_theme_mod('uppercase_title', false)) {
        add_filter('the_title', 'esgi_custom_title', 10, 1);
    }
}

// include template functions
require get_template_directory() . '/inc/template-functions.php';
