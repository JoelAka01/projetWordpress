<?php
get_header();

// pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// 6 posts per page
$blog_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged,
    'post_status' => 'publish'
));

?>

<main class="blog-page">
    <div class="container">
        <h1>Blog.</h1>
        
        <!-- sidebar -->
        <div class="post-sidebar">
            <!-- search -->
            <div class="search-section">
                <h2>Search</h2>
                <form class="search-form" role="search" method="get" action="<?php echo home_url('/'); ?>">
                    <input type="search" placeholder="Type to search" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit">
                        <img src="<?php echo get_template_directory_uri(); ?>/src/images/svg/search.svg" alt="Search">
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
                        <h3><a href="<?php echo get_permalink($recent_id); ?>"><?php echo esc_html($recent['post_title']); ?></a></h3>
                        <div class="post-date"><?php echo get_the_date('F j, Y', $recent_id); ?></div>
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
                        foreach($tags_list as $tag) {
                            echo '<a href="' . get_tag_link($tag->term_id) . '">' . esc_html($tag->name) . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- main content area -->
        <div class="blog-content">
            <?php if ($blog_posts->have_posts()) : ?>
                <div class="posts-grid">
                    <?php 
                    while ($blog_posts->have_posts()) : 
                        $blog_posts->the_post();
                        
                        // Get post data
                        $categories = get_the_category();
                        $category_name = !empty($categories) ? esc_html($categories[0]->name) : '';
                        $category_name = esgi_translate_category_name($category_name);
                        $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
                        
                        // Get post image
                        $main_image_url = esgi_get_post_main_image_url(get_the_ID(), 'large');
                        if (!$main_image_url) {
                            $main_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        }
                        if (!$main_image_url) {
                            $main_image_url = get_template_directory_uri() . '/src/images/png/no-image.jpg';
                        }
                    ?>
                    <article class="blog-post-item">
                        <div class="post-image">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($main_image_url); ?>" alt="<?php the_title_attribute(); ?>">
                            </a>
                            <?php if ($category_name) : ?>
                                <div class="post-category">
                                    <a href="<?php echo esc_url($category_link); ?>"><?php echo $category_name; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="post-content">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="post-excerpt">
                                <?php 
                                $excerpt = get_the_excerpt();
                                echo esgi_truncate_text($excerpt, 120, '...');
                                ?>
                            </div>
                            <div class="post-date"><?php echo get_the_date('F j, Y'); ?></div>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>
                
                <!-- pagination -->
                <?php if ($blog_posts->max_num_pages > 1) : ?>
                <div class="pagination-wrapper">
                    <div class="pagination">
                        <?php
                        // previous page link
                        if ($paged > 1) {
                            echo '<a href="' . get_pagenum_link($paged - 1) . '" class="page-link prev">←</a>';
                        }
                        
                        // page numbers
                        for ($i = 1; $i <= $blog_posts->max_num_pages; $i++) {
                            if ($i == $paged) {
                                echo '<span class="page-link current">' . $i . '</span>';
                            } else {
                                echo '<a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>';
                            }
                        }
                        
                        // next page link
                        if ($paged < $blog_posts->max_num_pages) {
                            echo '<a href="' . get_pagenum_link($paged + 1) . '" class="page-link next">→</a>';
                        }
                        ?>
                    </div>
                </div>
                <?php endif; ?>
                
            <?php else : ?>
                <div class="no-posts">
                    <h2>No posts found</h2>
                    <p>Sorry, no posts were found. Please try again later.</p>
                </div>            <?php endif; ?>
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
                        <img src="<?php echo get_template_directory_uri(); ?>/src/images/svg/search.svg" alt="Search">
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
                        <h3><a href="<?php echo get_permalink($recent_id); ?>"><?php echo esc_html($recent['post_title']); ?></a></h3>
                        <div class="post-date"><?php echo get_the_date('F j, Y', $recent_id); ?></div>
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
                        foreach($tags_list as $tag) {
                            echo '<a href="' . get_tag_link($tag->term_id) . '">' . esc_html($tag->name) . '</a>';
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