<?php
/*
Template Name: About Us Page
*/

get_header(); ?>

<main class="about-page">
    <div class="container">
        <section class="hero-section">
            <div class="row">
                <div class="col-12">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </section>

        <section class="about-content">
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
                            echo '<img src="' . get_template_directory_uri() . '/src/images/png/2.png" alt="Who are we" class="img-fluid">';
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

        <?php
        // Display page content if any
        if (have_posts()) :
            while (have_posts()) : the_post();
                if (get_the_content()) :
        ?>
        <section class="page-content">
            <div class="row">
                <div class="col-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
        <?php
                endif;
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
