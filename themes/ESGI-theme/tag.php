<?php
get_header();

// pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Get current tag
$tag = get_queried_object();

// 6 posts per page for tag
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged,
    'post_status' => 'publish',
    'tag_id' => $tag->term_id
);

$tag_posts = new WP_Query($args);
?>

<main class="blog-page tag-archive">
    <div class="container">
        <h1>Tag: <?php echo esc_html($tag->name); ?>.</h1>
        <p class="archive-description">Posts tagged with "<?php echo esc_html($tag->name); ?>"</p>
        
        <!-- sidebar -->
        <div class="post-sidebar">
            <!-- search -->
            <div class="search-section">
                <h2>Search</h2>
                <form class="search-form" role="search" method="get" action="<?php echo home_url('/'); ?>">
                    <input type="search" placeholder="Type to search" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit">
                        <img src="<?php echo get_template_directory_uri(); ?>/src/images/svg/search.svg" alt="Search" width="16" height="16">
                    </button>
                </form>
            </div>
            
            <!-- recent posts -->
            <div class="recent-posts">
                <h2>Recent posts</h2>
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 4,
                    'post_status' => 'publish'
                ));
                foreach($recent_posts as $recent) {
                    $recent_id = $recent['ID'];
                    $main_image_url = esgi_get_post_main_image_url($recent_id, 'thumbnail');
                    if (!$main_image_url) {
                        $main_image_url = get_the_post_thumbnail_url($recent_id, 'thumbnail');
                    }
                    if (!$main_image_url) {
                        $main_image_url = get_template_directory_uri() . '/src/images/png/no-image.jpg';
                    }
                ?>
                <div class="post-item">
                    <img src="<?php echo esc_url($main_image_url); ?>" alt="<?php echo esc_attr($recent['post_title']); ?>">
                    <div class="post-info">
                        <h3><a href="<?php echo get_permalink($recent['ID']); ?>"><?php echo esc_html($recent['post_title']); ?></a></h3>
                        <div class="post-date"><?php echo get_the_date('F j, Y', $recent['ID']); ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            
            <!-- archives -->
            <div class="archives">
                <h2>Archives</h2>
                <ul>
                    <?php wp_get_archives(array('type' => 'monthly', 'limit' => 5)); ?>
                </ul>
            </div>
            
            <!-- categories -->
            <div class="categories">
                <h2>Categories</h2>
                <ul>
                    <?php 
                    esgi_list_categories(array(
                        'number' => 5
                    )); 
                    ?>
                </ul>
            </div>
            
            <!-- tags -->
            <div class="tags-sidebar">
                <h2>Tags</h2>
                <div class="tag-list">
                    <?php
                    $tags_list = get_tags(array('number' => 10));
                    if ($tags_list) {
                        foreach($tags_list as $tag_item) {
                            echo '<a href="' . get_tag_link($tag_item->term_id) . '">' . esc_html($tag_item->name) . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- main content area -->
        <div class="blog-content">
            <?php if ($tag_posts->have_posts()) : ?>
                <div class="posts-grid">
                    <?php 
                    while ($tag_posts->have_posts()) : 
                        $tag_posts->the_post();
                        
                        // Get post data
                        $main_image_url = esgi_get_post_main_image_url(get_the_ID(), 'medium');
                        if (!$main_image_url) {
                            $main_image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        }
                        if (!$main_image_url) {
                            $main_image_url = get_template_directory_uri() . '/src/images/png/no-image.jpg';
                        }
                        
                        $categories = get_the_category();
                        $first_category = !empty($categories) ? $categories[0] : null;
                        $category_name_display = $first_category ? esgi_translate_category_name($first_category->name) : '';
                        
                        $reading_time = esgi_get_post_reading_time();
                    ?>                    <article class="blog-post-item">
                        <div class="post-image">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($main_image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            </a>
                            <?php if ($first_category) : ?>
                            <div class="post-category">
                                <a href="<?php echo get_category_link($first_category->term_id); ?>"><?php echo esc_html($category_name_display); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="post-content">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            
                            <div class="post-excerpt">
                                <?php 
                                $excerpt = get_the_excerpt();
                                echo esc_html(esgi_truncate_text($excerpt, 120));
                                ?>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>
                
                <!-- pagination -->
                <?php 
                $total_pages = $tag_posts->max_num_pages;
                if ($total_pages > 1) : 
                ?>
                <div class="pagination-wrapper">
                    <div class="pagination">
                        <?php
                        $paged = max(1, get_query_var('paged'));
                        
                        if ($total_pages > 1) {
                            $ellipsis = '<span class="page-link ellipsis">...</span>';

                            // always show first 2 pages
                            for ($i = 1; $i <= 2; $i++) {
                                if ($i == $paged) {
                                    echo '<span class="page-link current">' . $i . '</span>';
                                } else {
                                    echo '<a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>';
                                }
                            }

                            // ellipsis if needed
                            if ($paged > 5) {
                                echo $ellipsis;
                            }

                            // determine middle range
                            $start = max(3, $paged - 1);
                            $end = min($total_pages - 2, $paged + 1);

                            // if current page is near start
                            if ($paged <= 4) {
                                $start = 3;
                                $end = 5;
                            }

                            // if current page is near end
                            if ($paged >= $total_pages - 3) {
                                $start = $total_pages - 4;
                                $end = $total_pages - 2;
                            }

                            // middle pages
                            for ($i = $start; $i <= $end; $i++) {
                                if ($i <= 2 || $i >= $total_pages - 1) continue; // avoid duplicating first/last two pages
                                if ($i == $paged) {
                                    echo '<span class="page-link current">' . $i . '</span>';
                                } else {
                                    echo '<a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>';
                                }
                            }

                            // ellipsis before last 2 if needed
                            if ($paged < $total_pages - 3) {
                                echo $ellipsis;
                            }

                            // last 2 pages
                            for ($i = $total_pages - 1; $i <= $total_pages; $i++) {
                                if ($i == $paged) {
                                    echo '<span class="page-link current">' . $i . '</span>';
                                } else {
                                    echo '<a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php endif; ?>
                
            <?php else : ?>
                <div class="no-posts">
                    <h2>No posts found</h2>
                    <p>Sorry, no posts were found with this tag. Please try again later.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- separator line for mobile view -->
        <div class="mobile-sidebar-separator"></div>
        
        <!-- mobile only sidebar after content -->
        <div class="post-sidebar-mobile">
            <!-- search -->
            <div class="search-section">
                <h2>Search</h2>
                <form class="search-form" role="search" method="get" action="<?php echo home_url('/'); ?>">
                    <input type="search" placeholder="Type to search" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit">
                        <img src="<?php echo get_template_directory_uri(); ?>/src/images/svg/search.svg" alt="Search" width="16" height="16">
                    </button>
                </form>
            </div>
            
            <!-- recent posts -->
            <div class="recent-posts">
                <h2>Recent posts</h2>
                <?php
                $recent_posts_mobile = wp_get_recent_posts(array(
                    'numberposts' => 4,
                    'post_status' => 'publish'
                ));
                foreach($recent_posts_mobile as $recent) {
                    $recent_id = $recent['ID'];
                    $main_image_url = esgi_get_post_main_image_url($recent_id, 'thumbnail');
                    if (!$main_image_url) {
                        $main_image_url = get_the_post_thumbnail_url($recent_id, 'thumbnail');
                    }
                    if (!$main_image_url) {
                        $main_image_url = get_template_directory_uri() . '/src/images/png/no-image.jpg';
                    }
                ?>
                <div class="post-item">
                    <img src="<?php echo esc_url($main_image_url); ?>" alt="<?php echo esc_attr($recent['post_title']); ?>">
                    <div class="post-info">
                        <h3><a href="<?php echo get_permalink($recent['ID']); ?>"><?php echo esc_html($recent['post_title']); ?></a></h3>
                        <div class="post-date"><?php echo get_the_date('F j, Y', $recent['ID']); ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            
            <!-- archives -->
            <div class="archives">
                <h2>Archives</h2>
                <ul>
                    <?php wp_get_archives(array('type' => 'monthly', 'limit' => 5)); ?>
                </ul>
            </div>
            
            <!-- categories -->
            <div class="categories">
                <h2>Categories</h2>
                <ul>
                    <?php 
                    esgi_list_categories(array(
                        'number' => 5
                    )); 
                    ?>
                </ul>
            </div>
            
            <!-- tags -->
            <div class="tags-sidebar">
                <h2>Tags</h2>
                <div class="tag-list">
                    <?php
                    $tags_list = get_tags(array('number' => 10));
                    if ($tags_list) {
                        foreach($tags_list as $tag_item) {
                            echo '<a href="' . get_tag_link($tag_item->term_id) . '">' . esc_html($tag_item->name) . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
wp_reset_postdata();
get_footer();
?>
