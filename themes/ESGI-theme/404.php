<?php
get_header();
?>
<!-- error-404 page not found -->
<main id="primary" class="site-main page">
    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('404 Page introuvable', 'wp-2025-iw1'); ?></h1>
        </header>

        <div class="page-content">
            <p class="error-message"><?php esc_html_e('Essayez de faire une recherche', 'wp-2025-iw1'); ?></p>

            <div class="search-form-container">
                <?php get_search_form(); ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();