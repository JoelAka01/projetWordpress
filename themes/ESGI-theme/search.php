<?php

get_header();

$search_query = get_search_query();
?>

<main id="primary" class="site-main page">
    <header class="page-header">
        <h1 class="page-title">
            <?php printf(esc_html__('Résultats de la recherche pour "%s"', 'wp-2025-iw1'), '<span>' . esc_html($search_query) . '</span>'); ?>
        </h1>
    </header>

    <div class="search-results-container">
        <?php
        // Get all pages that match the search keyword
        $pages_query = new WP_Query([
            'post_type'      => 'page',
            's'              => $search_query,
            'posts_per_page' => -1,
        ]);

        // Get all posts that match the search keyword
        $posts_query = new WP_Query([
            'post_type'      => 'post',
            's'              => $search_query,
            'posts_per_page' => -1,
        ]);

        // Display pages results if any found
        if ($pages_query->have_posts()) : 
            $pages_count = $pages_query->found_posts;
        ?>
            <section class="search-results-section">
                <h2 class="search-results-type-title">
                    <?php echo esc_html(sprintf(_n('%s page trouvée', '%s pages trouvées', $pages_count, 'wp-2025-iw1'), number_format_i18n($pages_count))); ?>
                </h2>
                <ul class="search-results-list">
                    <?php while ($pages_query->have_posts()) : $pages_query->the_post(); ?>
                        <li class="search-result-item">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        <?php
        wp_reset_postdata();
        endif;

        // Display posts results if any found
        if ($posts_query->have_posts()) : 
            $posts_count = $posts_query->found_posts;
        ?>
            <section class="search-results-section">
                <h2 class="search-results-type-title">
                    <?php echo esc_html(sprintf(_n('%s article trouvé', '%s articles trouvés', $posts_count, 'wp-2025-iw1'), number_format_i18n($posts_count))); ?>
                </h2>
                <ul class="search-results-list">
                    <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
                        <li class="search-result-item">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        <?php
        wp_reset_postdata();
        endif;

        // If no results found
        if (!$pages_query->have_posts() && !$posts_query->have_posts()) :
        ?>
            <div class="no-results">
                <p><?php esc_html_e('Aucun résultat trouvé pour votre recherche.', 'wp-2025-iw1'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();