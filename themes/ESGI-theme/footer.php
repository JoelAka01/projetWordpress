<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (get_theme_mod('has_footer_search', false)) : ?>
                    <?php get_search_form(); ?>
                <?php endif; ?>
                © ESGI
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>