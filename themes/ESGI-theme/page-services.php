<?php

/**
 * Template for Services page (page-services.php)
 * This template will be automatically used for une page avec le slug 'services'
 */
get_header();
?>

<main class="services-page">
    <!-- Services Hero Section -->
    <section class="services-section">
        <!-- "our services" title on the left -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="services-title"><?php echo get_theme_mod('services_title', 'Our Services.'); ?></h&>
                </div>
            </div>
        </div>
        <!-- main content row -->
        <div class="row services-content" style="display:flex;flex-wrap:nowrap;gap:0;padding:0;margin:0;width:100vw;margin-left:calc(-50vw + 50%);">
            <!-- 1st square: left image -->
            <div class="service-square d-flex align-items-center justify-content-center" style="height:25vw;padding:0;flex:1 1 0;min-width:0;">
                <div class="service-image-left w-100 h-100">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/images/png/12.png" alt="Service Image 1" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">
                </div>
            </div>
            <!-- 2nd square: right image -->
            <div class="service-square d-flex align-items-center justify-content-center" style="height:25vw;padding:0;flex:1 1 0;min-width:0;">
                <div class="service-image-right w-100 h-100">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/images/png/5.png" alt="Service Image 2" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">
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
                <div class="featured-image-wrapper w-100 h-100">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/images/png/3.png" alt="Private Parties Featured" class="img-fluid" style="width:100%;height:100%;object-fit:cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- Corporate Parties Section -->
    <section class="service-section corporate-parties">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="service-content-wrapper">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="service-text">
                                    <h2 class="service-title">Corp. Parties</h2>
                                    <p class="service-description">
                                        <?php echo get_theme_mod(
                                            'corporate_parties_description',
                                            'Specializing in the creation of exceptional events for private and corporate clients, we design, plan and manage every project from conception to execution.'
                                        ); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <!-- This space can be used for additional content if needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Large Event Image Section -->
    <section class="large-event-section">
        <div class="container-fluid p-0">
            <div class="large-event-image">
                <img src="<?php echo get_theme_mod('large_event_image', get_template_directory_uri() . '/src/images/png/9.png'); ?>"
                    alt="Large Event" class="img-fluid w-100">
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>