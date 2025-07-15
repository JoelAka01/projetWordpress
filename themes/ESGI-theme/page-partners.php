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
                <?php the_content(); ?>
            </div>
        </div>

        <section class="partners-section">
            <div class="row">
                <div class="col-12">
                    <h2><?php echo get_theme_mod('partners_title', 'Our Partners.'); ?></h2>
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
        </section>
    </div>
</main>

<?php get_footer(); ?>
