<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
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
            <div class="col-md-4">
                <div class="footer-contact">
                    <p class="contact-title"><?php echo get_theme_mod('footer_contact_title', 'Manager'); ?></p>
                    <p class="contact-phone"><?php echo get_theme_mod('footer_contact_phone', '+33 1 53 31 25 23'); ?></p>
                    <p class="contact-email"><?php echo get_theme_mod('footer_contact_email', 'info@esgi.com'); ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-contact">
                    <p class="contact-title"><?php echo get_theme_mod('footer_ceo_title', 'CEO'); ?></p>
                    <p class="contact-phone"><?php echo get_theme_mod('footer_ceo_phone', '+33 1 53 31 25 24'); ?></p>
                    <p class="contact-email"><?php echo get_theme_mod('footer_ceo_email', 'ceo@esgi.com'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="row footer-bottom">
            <div class="col-md-6">
                <p class="copyright"><?php echo get_theme_mod('footer_copyright', '© ' . date('Y') . ' - Event Template for ESGI'); ?></p>
            </div>
            <div class="col-md-6">
                <div class="social-links">
                    <?php if (get_theme_mod('linkedin_url')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('linkedin_url')); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo esgi_getIcon('linkedin'); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('facebook_url')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('facebook_url')); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo esgi_getIcon('facebook'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- mobile menu -->
<div class="mobile-menu-overlay"></div>

<script>
    // mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
        const mainNavigation = document.querySelector('.main-navigation');
        
        if (mobileMenuToggle && mainNavigation) {
            mobileMenuToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                mainNavigation.classList.toggle('active');
                document.body.classList.toggle('menu-open');
                if (mobileMenuOverlay) {
                    mobileMenuOverlay.classList.toggle('active');
                }
            });
            
            if (mobileMenuOverlay) {
                mobileMenuOverlay.addEventListener('click', function() {
                    mobileMenuToggle.classList.remove('active');
                    mainNavigation.classList.remove('active');
                    document.body.classList.remove('menu-open');
                    this.classList.remove('active');
                });
            }
        }
    });
</script>

<?php wp_footer(); ?>
</body>

</html>