<?php get_header(); ?>

<main class="home-page">
    <div class="container">        <section class="hero-section">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo get_theme_mod('hero_title', 'A really professional structure<br>for all your events!'); ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="hero-image-wrapper">
                        <div class="hero-image">
                            <?php
                            $hero_image = get_theme_mod('hero_image');
                            if ($hero_image) {
                                echo '<img src="' . esc_url($hero_image) . '" alt="Hero Image" class="img-fluid">';
                            } else {
                                // display default hero image from theme
                                echo '<img src="' . get_template_directory_uri() . '/src/images/png/1.png" alt="Hero Image" class="img-fluid">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="row">
                <div class="col-md-6">
                    <h2><?php echo get_theme_mod('about_title', 'About Us'); ?></h2>
                    <p><?php echo get_theme_mod('about_description', 'Specializing in the creation of exceptional events for private and corporate clients, we design, plan and manage every project from conception to execution.'); ?></p>
                </div>
                <div class="col-md-6">
                    <div class="about-image">
                        <?php
                        $about_image = get_theme_mod('about_image');
                        if ($about_image) {
                            echo '<img src="' . esc_url($about_image) . '" alt="About Us" class="img-fluid">';
                        } else {
                            // display default about image from theme
                            echo '<img src="' . get_template_directory_uri() . '/src/images/png/2.png" alt="About Us" class="img-fluid">';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row who-are-we">
                <div class="col-md-6">
                    <div class="who-are-we-image">
                        <?php
                        $who_image = get_theme_mod('who_are_we_image');
                        if ($who_image) {
                            echo '<img src="' . esc_url($who_image) . '" alt="Who are we" class="img-fluid">';
                        } else {
                            // display default who are we image from theme
                            echo '<img src="' . get_template_directory_uri() . '/src/images/png/3.png" alt="Who are we" class="img-fluid">';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2><?php echo get_theme_mod('who_are_we_title', 'Who are we?'); ?></h2>
                    <p><?php echo get_theme_mod('who_are_we_content', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suspendisse eu commodo est, at commodo magna.'); ?></p>
                    
                    <h2><?php echo get_theme_mod('vision_title', 'Our vision'); ?></h2>
                    <p><?php echo get_theme_mod('vision_content', 'Nullam faucibus interdum massa. Duis eget felis mollis, pulvinar velit sit amet, consequat tortor. Suspendisse commodo magna eros, ut turpis massa porta pharetra. Fusce vehicula aliquot amet non ultricies.'); ?></p>
                    
                    <h2><?php echo get_theme_mod('mission_title', 'Our mission'); ?></h2>
                    <p><?php echo get_theme_mod('mission_content', 'Vivamus ac dictum neque, at elementum ipsum. Aliquam eget convallis diam, quis cursus tortor. Aliquam suscipit eros ut amet velit malesuada eleifum. Fusce in venenatis nulla. Donec quis lorem ut magna tincidunt egestas.'); ?></p>
                </div>
            </div>
        </section>

        <section class="services-section">
            <div class="row">
                <div class="col-12">
                    <h2><?php echo get_theme_mod('services_title', 'Our Services'); ?></h2>
                </div>
            </div>
            <div class="row services-list">
                <?php
                // display service boxes from theme customizer
                for ($i = 1; $i <= 3; $i++) :
                    $service_image = get_theme_mod('service_image_' . $i);
                    $service_title = get_theme_mod('service_title_' . $i, 'Service ' . $i);
                    
                    $default_image = get_template_directory_uri() . '/src/images/png/' . ($i + 3) . '.png';
                ?>
                <div class="col-md-4 service-item">
                    <div class="service-image">
                        <?php if ($service_image) : ?>
                            <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_title); ?>" class="img-fluid">
                        <?php else : ?>
                            <img src="<?php echo esc_url($default_image); ?>" alt="<?php echo esc_attr($service_title); ?>" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <h3><?php echo esc_html($service_title); ?></h3>
                </div>
                <?php endfor; ?>
            </div>
        </section>

        <section class="partners-section">
            <div class="row">
                <div class="col-12">
                    <h2><?php echo get_theme_mod('partners_title', 'Our Partners'); ?></h2>
                </div>
            </div>
            <div class="row partners-list">
                <?php
                // display up to 6 partner logos
                for ($i = 1; $i <= 6; $i++) :
                    $partner_logo = get_theme_mod('partner_logo_' . $i);
                    $partner_name = get_theme_mod('partner_name_' . $i, 'Partner ' . $i);
                    $partner_url = get_theme_mod('partner_url_' . $i, '#');
                    
                    $default_logo = get_template_directory_uri() . '/src/images/svg/partner-' . $i . '.svg';
                ?>
                <div class="col-6 col-md-2 partner-item">
                    <?php if ($partner_url) : ?>
                    <a href="<?php echo esc_url($partner_url); ?>" target="_blank" rel="noopener">
                    <?php endif; ?>
                        <?php if ($partner_logo) : ?>
                            <img src="<?php echo esc_url($partner_logo); ?>" alt="<?php echo esc_attr($partner_name); ?>" class="img-fluid">
                        <?php else : ?>
                            <img src="<?php echo esc_url($default_logo); ?>" alt="<?php echo esc_attr($partner_name); ?>" class="img-fluid">
                        <?php endif; ?>
                    <?php if ($partner_url) : ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endfor; ?>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>