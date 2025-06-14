<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled') ? 'dark' : ''; ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= get_bloginfo('name') ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '" class="site-logo">';
                        echo '<img src="' . get_template_directory_uri() . '/src/images/svg/logo.svg" alt="' . get_bloginfo('name') . '" />';
                        echo '</a>';
                    }
                    ?>
                </div>
                
                <button class="mobile-menu-toggle" aria-label="Toggle Menu">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/images/svg/menu.svg" alt="Menu" class="open-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/images/svg/close.svg" alt="Close" class="close-icon">
                </button>
                
                <div class="main-navigation">
                    <?php
                    if (has_nav_menu('primary_menu')) {
                        wp_nav_menu([
                            'container' => 'nav',
                            'container_class' => 'main-nav',
                            'theme_location' => 'primary_menu'
                        ]);                    }
                    ?>
                </div>
            </div>
        </div>
    </header>