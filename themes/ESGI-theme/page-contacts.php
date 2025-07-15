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
                <h1 class="page-title"><?php the_title(); ?>.</h1>
                <p class="subtitle">A desire for a big big party or a very select congress? Contact us.</p>    
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="contacts-info text-end">
            <div class="row d-flex justify-content-end ">
                <div class="col-md-3">
                    <div class="contact-item">
                        <h3><?php echo get_theme_mod('footer_location_title', 'Location'); ?></h3>
                        <p><?php echo get_theme_mod('footer_location_address', '242 Rue du Faubourg Saint-Antoine <br> 75020 Paris FRANCE'); ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-item">
                        <h3><?php echo get_theme_mod('footer_ceo_title', 'CEO'); ?></h3>
                        <p><?php echo get_theme_mod('footer_ceo_phone', '+33 1 53 31 25 25'); ?></p>
                        <p><?php echo get_theme_mod('footer_ceo_email', 'ceo@company.com'); ?></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="contact-item">
                        <h3><?php echo get_theme_mod('footer_contact_title', 'Manager'); ?></h3>
                        <p><?php echo get_theme_mod('footer_contact_phone', '+33 1 53 31 25 23'); ?></p>
                        <p><?php echo get_theme_mod('footer_contact_email', 'info@esgi.com'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                        <?php
                        $hero_image = get_theme_mod('hero_image');
                        if ($hero_image) {
                            echo '<img src="' . esc_url($hero_image) . '" alt="Hero Image" class="img-fluid">';
                        } else {
                            // display default hero image from theme
                            echo '<img src="' . get_template_directory_uri() . '/src/images/png/10.png" alt="Hero Image" class="img-fluid-contact">';
                        }
                        ?>
            </div>
        </div>
    <div class="wirteus-section">
        <div class="container">
            <h2> Write us here</h2>
                <p class="subtitle">Gol Don't be shy</p>    
            <div class="contact-form-contain">
                
                <form method="get" class="contact-form row" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="text" class="contact-field col-12" placeholder="Subject"  name="name" />
                    <div class="middle">
                        <input type="email" class="contact-field"  placeholder="Email" name="email" />
                        <input type="number" class="contact-field"  placeholder="Phone no." name="phone" />
                    </div>

                    <textarea class="contact-field col-12" placeholder="Message" name="message"></textarea>
                    <button type="submit" class="contact-submit">Submit </button>
                </form>

            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
