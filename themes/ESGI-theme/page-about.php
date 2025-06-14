<?php
/**
 * Template Name: About Us Page
 */
get_header();
?>

<main class="about-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <?php the_content(); ?>
                <div class="about-description">
                    <p><?php echo get_theme_mod('about_description', 'Specializing in the creation of exceptional events for private and corporate clients, we design, plan and manage every project from conception to execution.'); ?></p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="about-image">
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full');
                    } else {
                        $about_image = get_theme_mod('about_image');
                        if ($about_image) {
                            echo '<img src="' . esc_url($about_image) . '" alt="About Us">';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <section class="who-are-we">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="who-are-we-image">
                        <?php 
                        $who_image = get_theme_mod('who_are_we_image');
                        if ($who_image) {
                            echo '<img src="' . esc_url($who_image) . '" alt="Who are we">';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <h2><?php echo get_theme_mod('who_are_we_title', 'Who are we?'); ?></h2>
                    <div class="who-are-we-content">
                        <?php echo wpautop(get_theme_mod('who_are_we_content', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suspendisse eu commodo est, at commodo magna.')); ?>
                    </div>
                    
                    <h2><?php echo get_theme_mod('vision_title', 'Our vision'); ?></h2>
                    <div class="vision-content">
                        <?php echo wpautop(get_theme_mod('vision_content', 'Nullam faucibus interdum massa. Duis eget felis mollis, pulvinar velit sit amet, consequat tortor. Suspendisse commodo magna eros, ut turpis massa porta pharetra. Fusce vehicula aliquot amet non ultricies.')); ?>
                    </div>
                    
                    <h2><?php echo get_theme_mod('mission_title', 'Our mission'); ?></h2>
                    <div class="mission-content">
                        <?php echo wpautop(get_theme_mod('mission_content', 'Vivamus ac dictum neque, at elementum ipsum. Aliquam eget convallis diam, quis cursus tortor. Aliquam suscipit eros ut amet velit malesuada eleifum. Fusce in venenatis nulla. Donec quis lorem ut magna tincidunt egestas.')); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
