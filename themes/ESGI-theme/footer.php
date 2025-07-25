<footer class="site-footer">
    <div class="container">        <div class="row align-items-start">
            <div class="col-md-6 d-flex align-items-start">
                <div class="footer-logo">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '" class="site-logo">';
                        echo '<img src="' . get_template_directory_uri() . '/src/images/svg/logo.svg" alt="' . get_bloginfo('name') . '" />';
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-contacts">
                    <div class="contact-item">
                        <p class="contact-title"><?php echo get_theme_mod('footer_contact_title', 'Manager'); ?></p>
                        <p class="contact-phone"><?php echo get_theme_mod('footer_contact_phone', '+33 1 53 31 25 23'); ?></p>
                        <p class="contact-email"><?php echo get_theme_mod('footer_contact_email', 'info@esgi.com'); ?></p>
                    </div>
                    <div class="contact-item">
                        <p class="contact-title"><?php echo get_theme_mod('footer_ceo_title', 'CEO'); ?></p>
                        <p class="contact-phone"><?php echo get_theme_mod('footer_ceo_phone', '+33 1 53 31 25 25'); ?></p>
                        <p class="contact-email"><?php echo get_theme_mod('footer_ceo_email', 'ceo@company.com'); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row footer-bottom">
            <div class="col-md-6">
                <p class="copyright"><?php echo get_theme_mod('footer_copyright', '2022 Figma Template by ESGI'); ?></p>
            </div>            <div class="col-md-6">
                <div class="social-links">
                    <a href="<?php echo esc_url(get_theme_mod('linkedin_url', '#')); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo esgi_getIcon('linkedin'); ?>
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('facebook_url', '#')); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo esgi_getIcon('facebook'); ?>
                    </a>
                </div>
            </div>
        </div>    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>