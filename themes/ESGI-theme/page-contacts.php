<?php
/**
 * Template Name: Contacts Page
 */
get_header();
?>

<main class="contacts-page">
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

        <div class="contacts-info">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-item">
                        <h3><?php echo get_theme_mod('footer_contact_title', 'Manager'); ?></h3>
                        <p><strong>Phone:</strong> <?php echo get_theme_mod('footer_contact_phone', '+33 1 53 31 25 23'); ?></p>
                        <p><strong>Email:</strong> <?php echo get_theme_mod('footer_contact_email', 'info@esgi.com'); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-item">
                        <h3><?php echo get_theme_mod('footer_ceo_title', 'CEO'); ?></h3>
                        <p><strong>Phone:</strong> <?php echo get_theme_mod('footer_ceo_phone', '+33 1 53 31 25 25'); ?></p>
                        <p><strong>Email:</strong> <?php echo get_theme_mod('footer_ceo_email', 'ceo@company.com'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
