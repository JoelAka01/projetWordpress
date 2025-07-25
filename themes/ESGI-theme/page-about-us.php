<?php get_header(); ?>

<main class="home-page">
    <section class="hero-section">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo get_theme_mod('hero_title', 'About us.'); ?></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="hero-image-wrapper-secondary">
                    <div class="hero-image">
                        <?php
                        $about_hero_image_2 = get_theme_mod('about_hero_image_2');
                        if ($about_hero_image_2) {
                            echo '<img src="' . esc_url($about_hero_image_2) . '" alt="Hero Image" class="img-fluid">';
                        } else {
                            // display default hero image from theme
                            echo '<img src="' . get_template_directory_uri() . '/src/images/png/4.png" alt="Hero Image" class="img-fluid">';
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
                    <h2><?php echo get_theme_mod('about_title', 'Sky’s the limit'); ?></h2>
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


    <section class="teams-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="teams-title"><?php echo get_theme_mod('teams_title', 'Our Team'); ?></h2>
                </div>
            </div>
            <div class="teams-container">
                <div class="row">
                    <?php
                    $defaults = [
                        ['5.png', 'Sales Manager', '+33 1 53 31 25 23', 'sales@company.com'],
                        ['6.png', 'Event planner', '+33 1 53 31 25 24', 'plan@company.com'],
                        ['7.png', 'Designer', '+33 1 53 31 25 20', 'design@company.com'],
                        ['8.png', 'CEO', '+33 1 53 31 25 25', 'ceo@company.com'],
                    ];
                    for ($i = 1; $i <= 4; $i++) :
                        $img = get_theme_mod('team_member_image_' . $i);
                        $role = get_theme_mod('team_member_role_' . $i, $defaults[$i-1][1]);
                        $phone = get_theme_mod('team_member_phone_' . $i, $defaults[$i-1][2]);
                        $email = get_theme_mod('team_member_email_' . $i, $defaults[$i-1][3]);
                        $img_src = $img ? esc_url($img) : get_template_directory_uri() . '/src/images/png/' . $defaults[$i-1][0];
                    ?>
                        <div class="team-member">
                            <img
                                src="<?php echo $img_src; ?>"
                                alt="<?php echo esc_attr($role); ?>"
                                class="team-img">
                            <div class="team-role"><?php echo esc_html($role); ?></div>
                            <div class="team-contact"><?php echo esc_html($phone); ?></div>
                            <div class="team-contact"><?php echo esc_html($email); ?></div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>



</main>

<?php get_footer(); ?>