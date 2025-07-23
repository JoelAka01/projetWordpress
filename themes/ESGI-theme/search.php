<?php

get_header();

$search_query = get_search_query();

// Pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// 6 posts per page
$search_posts = new WP_Query([
    'post_type'      => ['post', 'page', 'member', 'client'],
    's'              => $search_query,
    'posts_per_page' => 6,
    'paged'          => $paged,
    'post_status'    => 'publish'
]);
?>

<main class="search-page">
    <div class="container">
        <header class="search-header">
            <h1 class="search-title">
                <?php printf('Search results for: <span class="search-term">%s</span>', esc_html($search_query)); ?>
            </h1>
        </header>        <?php if ($search_posts->have_posts()) : ?>
            <div class="search-results-grid">
                <?php while ($search_posts->have_posts()) : $search_posts->the_post(); ?>
                    <article class="search-post-item">
                        <div class="post-content">
                            <h2>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="post-meta">
                                <?php 
                                $post_type = get_post_type();                                if (get_post_type() == 'post') {
                                    // Get categories
                                    $categories = get_the_category();
                                    $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                    $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '';
                                    
                                    // traduit "non classé" to "Uncategorized"
                                    if (strtolower($category_name) === 'non classé' || strtolower($category_name) === 'non classe') {
                                        $category_name = 'Uncategorized';
                                    }
                                      // capitalize first letter of month
                                    $date = get_the_date('F j, Y');
                                    $date = ucfirst($date); 
                                    
                                    if ($category_link) {
                                        echo '<span class="post-category"><a href="' . esc_url($category_link) . '">' . esc_html($category_name) . '</a></span>';
                                    } else {
                                        echo '<span class="post-category">' . esc_html($category_name) . '</span>';
                                    }
                                    echo '<span class="meta-separator">, </span>';
                                    echo '<span class="post-date">' . esc_html($date) . '</span>';
                                } else {
                                    $type_label = 'Page';
                                    switch($post_type) {
                                        case 'member':
                                            $type_label = 'Team Member';
                                            break;
                                        case 'client':
                                            $type_label = 'Client';
                                            break;
                                        case 'page':
                                            $type_label = 'Page';
                                            break;
                                        default:
                                            $type_label = 'Content';
                                            break;
                                    }
                                    echo '<span class="post-type">' . esc_html($type_label) . '</span>';
                                }
                                ?>
                            </div>
                            
                            <div class="post-excerpt">
                                <?php 
                                $content = '';
                                if (has_excerpt()) {
                                    $content = get_the_excerpt();
                                } else {
                                    $content = get_the_content();
                                }
                                // Remove html tags and get plain text
                                $content = strip_tags($content);
                                // Remove extra whitespace and normalize line breaks
                                $content = preg_replace('/\s+/', ' ', $content);
                                $content = trim($content);
                                
                                // Split into sentences and get first 3 lines worth
                                $sentences = explode('.', $content);
                                $first_sentences = array_slice($sentences, 0, 3);
                                $trimmed_content = implode('. ', $first_sentences);
                                
                                // If we have content and it doesnt end with a period, add one
                                if (!empty($trimmed_content) && !str_ends_with($trimmed_content, '.')) {
                                    $trimmed_content .= '.';
                                }
                                
                                // If there are more sentences, add ellipsis
                                if (count($sentences) > 3) {
                                    $trimmed_content .= '..';
                                }
                                
                                echo esc_html($trimmed_content);
                                ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php 
            // Pagination
            $total_pages = $search_posts->max_num_pages;
            if ($total_pages > 1) : ?>
                <div class="pagination-wrapper">
                    <div class="pagination">
                        <?php
                        $ellipsis = '<span class="page-link ellipsis">...</span>';

                        // Always show first 2 pages
                        for ($i = 1; $i <= 2; $i++) {
                            if ($i == $paged) {
                                echo '<span class="page-link current">' . $i . '</span>';
                            } else {
                                echo '<a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>';
                            }
                        }

                        // Ellipsis if needed
                        if ($paged > 5) {
                            echo $ellipsis;
                        }

                        // Determine middle range
                        $start = max(3, $paged - 1);
                        $end = min($total_pages - 2, $paged + 1);

                        // If current page is near start
                        if ($paged <= 4) {
                            $start = 3;
                            $end = 5;
                        }

                        // If current page is near end
                        if ($paged >= $total_pages - 3) {
                            $start = $total_pages - 4;
                            $end = $total_pages - 2;
                        }

                        // Middle pages
                        for ($i = $start; $i <= $end; $i++) {
                            if ($i <= 2 || $i >= $total_pages - 1) continue;
                            if ($i == $paged) {
                                echo '<span class="page-link current">' . $i . '</span>';
                            } else {
                                echo '<a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>';
                            }
                        }

                        // Ellipsis before last 2 if needed
                        if ($paged < $total_pages - 3) {
                            echo $ellipsis;
                        }

                        // Last 2 pages
                        for ($i = $total_pages - 1; $i <= $total_pages; $i++) {
                            if ($i == $paged) {
                                echo '<span class="page-link current">' . $i . '</span>';
                            } else {
                                echo '<a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <div class="no-results">
                <h2>No results found</h2>
                <p><?php printf('Sorry, no results were found for "%s". Please try a different search term.', esc_html($search_query)); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
wp_reset_postdata();
get_footer();