<?php get_header(); ?>

<main class="home-page">
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo get_theme_mod('hero_title', 'A really professional structure<br>for all your events!'); ?></h1>
                </div>
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
        <!-- ceneter aboutus section -->
        <div class="row">
            <div class="col-12">
                <div class="about-intro text-center">
                    <h2><?php echo get_theme_mod('about_title', 'About Us'); ?></h2>
                    <p><?php echo get_theme_mod('about_description', 'Specializing in the creation of exceptional events for private and corporate clients, we design, plan and manage every project from conception to execution.'); ?></p>
                </div>
            </div>
        </div> <!-- image on left content sections on right -->
        <div class="row who-are-we">
            <div class="col-12 col-md-6">
                <div class="aboutus-image-wrapper">
                    <div class="who-are-we-image">
                        <?php
                        $who_image = get_theme_mod('who_are_we_image');
                        if ($who_image) {
                            echo '<img src="' . esc_url($who_image) . '" alt="Who are we" class="img-fluid">';
                        } else {
                            // display default who are we image from theme
                            echo '<img src="' . get_template_directory_uri() . '/src/images/png/2.png" alt="Who are we" class="img-fluid">';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="content-sections">
                    <div class="content-item">
                        <h2><?php echo get_theme_mod('who_are_we_title', 'Who are we?'); ?></h2>
                        <p><?php echo get_theme_mod('who_are_we_content', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suspendisse eu commodo est, at commodo magna.'); ?></p>
                    </div>

                    <div class="content-item">
                        <h2><?php echo get_theme_mod('vision_title', 'Our vision'); ?></h2>
                        <p><?php echo get_theme_mod('vision_content', 'Nullam faucibus interdum massa. Duis eget felis mollis, pulvinar velit sit amet, consequat tortor. Suspendisse commodo magna eros, ut turpis massa porta pharetra. Fusce vehicula aliquot amet non ultricies.'); ?></p>
                    </div>

                    <div class="content-item">
                        <h2><?php echo get_theme_mod('mission_title', 'Our mission'); ?></h2>
                        <p><?php echo get_theme_mod('mission_content', 'Vivamus et viverra neque, ut pharetra ipsum. Aliquam eget <br> consequat libero, quis cursus tortor. Aliquam suscipit eros sit amet <br> velit malesuada dapibus. Fusce in vehicula tellus. Donec quis lorem ut <br> magna tincidunt egestas. '); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="services-section">
        <!-- "our services" title on the left -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="services-title"><?php echo get_theme_mod('services_title', 'Our Services'); ?></h2>
                </div>
            </div>
        </div> <!-- main content row -->
        <div class="row services-content" style="display:flex;flex-wrap:nowrap;gap:0;padding:0;margin:0;width:100vw;margin-left:calc(-50vw + 50%);">
            <!-- 1st square: left image -->
            <div class="service-square d-flex align-items-center justify-content-center" style="height:25vw;padding:0;flex:1 1 0;min-width:0;">
                <div class="service-image-left w-100 h-100"> <?php
                                                                $service_1 = esgi_get_service_data(1);
                                                                if (!empty($service_1['image'])) {
                                                                    echo '<img src="' . esc_url($service_1['image']) . '" alt="' . esc_attr($service_1['title']) . '" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">';
                                                                } else {
                                                                    echo '<img src="' . get_template_directory_uri() . '/src/images/png/12.png" alt="' . esc_attr($service_1['title']) . '" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">';
                                                                }
                                                                ?>
                </div>
            </div>
            <!-- 2nd square: right image -->
            <div class="service-square d-flex align-items-center justify-content-center" style="height:25vw;padding:0;flex:1 1 0;min-width:0;">
                <div class="service-image-right w-100 h-100"> <?php
                                                                $service_2 = esgi_get_service_data(2);
                                                                if (!empty($service_2['image'])) {
                                                                    echo '<img src="' . esc_url($service_2['image']) . '" alt="' . esc_attr($service_2['title']) . '" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">';
                                                                } else {
                                                                    echo '<img src="' . get_template_directory_uri() . '/src/images/png/5.png" alt="' . esc_attr($service_2['title']) . '" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">';
                                                                }
                                                                ?>
                </div>
            </div>
            <!-- 3rd square: text -->
            <div class="service-square d-flex align-items-center justify-content-center" style="height:25vw;padding:0;flex:1 1 0;min-width:0;">
                <div class="private-parties-wrapper w-100 h-100 d-flex align-items-center justify-content-center" style="background:#fff;">
                    <h3 class="private-parties-title" style="margin:0;">Private Parties</h3>
                </div>
            </div>
            <!-- 4th square: right image -->
            <div class="service-square d-flex align-items-center justify-content-center" style="height:25vw;padding:0;flex:1 1 0;min-width:0;">
                <div class="featured-image-wrapper w-100 h-100"> <?php
                                                                    $service_3 = esgi_get_service_data(3);
                                                                    if (!empty($service_3['image'])) {
                                                                        echo '<img src="' . esc_url($service_3['image']) . '" alt="' . esc_attr($service_3['title']) . '" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">';
                                                                    } else {
                                                                        echo '<img src="' . get_template_directory_uri() . '/src/images/png/3.png" alt="' . esc_attr($service_3['title']) . '" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">';
                                                                    }
                                                                    ?>
                </div>
            </div>
        </div>
    </section>


    <section class="partners-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2><?php echo get_theme_mod('partners_title', 'Our Partners'); ?></h2>
                </div>
            </div>
            <div class="row partners-list">
                <?php
                // dynamic partners
                $partners = esgi_get_partners();

                if (!empty($partners)) :
                    foreach ($partners as $index => $partner) :
                        $partner_name = !empty($partner['name']) ? $partner['name'] : 'Partner ' . ($index + 1);
                        $partner_url = !empty($partner['url']) ? $partner['url'] : '#';
                        $partner_logo = !empty($partner['logo']) ? $partner['logo'] : '';

                        // Skip if no logo and no name
                        if (empty($partner_logo) && empty($partner['name'])) {
                            continue;
                        }

                        // Fallback default logo if no custom logo
                        if (empty($partner_logo)) {
                            $default_logo_number = ($index % 6) + 1; // cycle 1-6
                            $partner_logo = get_template_directory_uri() . '/src/images/svg/partner-' . $default_logo_number . '.svg';
                        }
                ?>
                        <div class="col-6 col-md-2 partner-item">
                            <?php if ($partner_url && $partner_url !== '#') : ?>
                                <a href="<?php echo esc_url($partner_url); ?>" target="_blank" rel="noopener">
                                <?php endif; ?>
                                <img src="<?php echo esc_url($partner_logo); ?>" alt="<?php echo esc_attr($partner_name); ?>" class="img-fluid">
                                <?php if ($partner_url && $partner_url !== '#') : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php
                    endforeach;
                else :
                    // fallback display default partner logos if no partners are configured
                    for ($i = 1; $i <= 6; $i++) :
                        $default_logo = get_template_directory_uri() . '/src/images/svg/partner-' . $i . '.svg';
                    ?>
                        <div class="col-6 col-md-2 partner-item">
                            <img src="<?php echo esc_url($default_logo); ?>" alt="Partner <?php echo $i; ?>" class="img-fluid">
                        </div>
                <?php
                    endfor;
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>