<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled') ? 'dark' : ''; ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <meta name="HandheldFriendly" content="true" />
    <title><?= get_bloginfo('name') ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>    <header class="site-header">
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
                    }                    ?>                </div>

                <button class="mobile-menu-toggle" aria-label="Toggle menu">
                    <div class="open-icon">
                        <?php echo esgi_getIcon('menu'); ?>
                    </div>
                    <div class="close-icon">
                        <?php echo esgi_getIcon('close'); ?>
                    </div>
                </button>
            </div>
        </div>          <!-- menu dropdown -->
        <div class="mobile-navigation">
            <div class="mobile-nav-content">
                <div class="container">
                    <div class="mobile-nav-header">                        <div class="mobile-logo-section">
                            <div class="mobile-logo">
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
                       
                        </div>
                        <button class="mobile-menu-close" aria-label="Close menu">
                            <?php echo esgi_getIcon('close'); ?>
                        </button>
                    </div>
                </div>               
                 <div class="container">
                    <div class="mobile-nav-bottom">
                        <button class="search-button" aria-label="Search">
                            Or try Search
                        </button>
                        
                        <nav class="mobile-nav-menu">
                            <?php
                            if (has_nav_menu('primary_menu')) {
                                wp_nav_menu([
                                    'container' => false,
                                    'theme_location' => 'primary_menu',
                                    'menu_class' => 'mobile-menu-list'
                                ]);
                            } else {
                            // fallback menu if no menu is set
                            echo '<ul class="mobile-menu-list">';
                            echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/about-us')) . '">About Us</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/services')) . '">Services</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/partners')) . '">Partners</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/blog')) . '">Blog</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/contacts')) . '">Contacts</a></li>';
                            echo '</ul>';                        } 
                        ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>