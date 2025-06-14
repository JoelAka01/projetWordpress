<?php
/**
 * Template Name: Services Page
 */
get_header();
?>

<main class="services-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="services-list">
            <div class="row">
                <?php
                // get services from theme customizer
                for ($i = 1; $i <= 3; $i++) :
                    $service_image = get_theme_mod('service_image_' . $i);
                    $service_title = get_theme_mod('service_title_' . $i, 'Service ' . $i);
                    $service_desc = get_theme_mod('service_description_' . $i, 'Description for service ' . $i);
                    
                    if ($service_image || $service_title) :
                ?>
                <div class="col-12 col-md-4 service-item">
                    <?php if ($service_image) : ?>
                    <div class="service-image">
                        <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_title); ?>">
                    </div>
                    <?php endif; ?>
                    
                    <h3 class="service-title"><?php echo esc_html($service_title); ?></h3>
                    
                    <?php if ($service_desc) : ?>
                    <div class="service-description">
                        <?php echo wpautop(esc_html($service_desc)); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php 
                    endif;
                endfor;
                ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
