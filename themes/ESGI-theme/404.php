<?php
get_header();
?>
<!-- error-404 page not found -->
<main id="primary" class="site-main page">
    <section class="error-404 not-found">
        <div class="error-content">
            <h1 class="error-title">404 Error.</h1>
            <p class="error-message">The page you were looking for couldn't be found.<br>Maybe try a search?</p>
            
            <div class="search-form-container">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" class="search-field" placeholder="Type something to search..." value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="search-submit">
                        <img src="<?php echo get_template_directory_uri(); ?>/src/images/svg/search.svg" alt="Search" />
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();