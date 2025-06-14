<?php
/**
 * Template Name: Partners Page
 */
get_header();
?>

<main class="partners-page">
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

        <div class="partners-list">
            <div class="row">
                <?php
                // Display up to 6 partners
                for ($i = 1; $i <= 6; $i++) :
                    $partner_logo = get_theme_mod('partner_logo_' . $i);
                    $partner_name = get_theme_mod('partner_name_' . $i, 'Partner ' . $i);
                    $partner_url = get_theme_mod('partner_url_' . $i, '#');
                    
                    if ($partner_logo) :
                ?>
                <div class="col-6 col-md-2 partner-item">
                    <div class="partner-logo">
                        <?php if ($partner_url) : ?>
                        <a href="<?php echo esc_url($partner_url); ?>" target="_blank" rel="noopener">
                        <?php endif; ?>
                            <img src="<?php echo esc_url($partner_logo); ?>" alt="<?php echo esc_attr($partner_name); ?>">
                        <?php if ($partner_url) : ?>
                        </a>
                        <?php endif; ?>
                    </div>
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
