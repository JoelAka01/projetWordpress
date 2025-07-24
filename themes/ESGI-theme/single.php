<?php

// Template d'un article seul
get_header();

// Dans un template d'article seul, WP crée une variable $post : utilisons-la !

// get post categories
$categories = get_the_category();
$category_name = !empty($categories) ? esc_html($categories[0]->name) : '';
// translate category name if need
$category_name = esgi_translate_category_name($category_name);
$category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';

// get post tags
$tags = get_the_tags();
// Sort tags by term_id to maintain creation order
if ($tags) {
    usort($tags, function($a, $b) {
        return $a->term_id - $b->term_id;
    });
}

// get custom fields
$subtitle = esgi_get_post_subtitle();
$featured_quote = esgi_get_post_featured_quote();
$reading_time = esgi_get_post_reading_time();

?>

<main class="post">
    <div class="container">
        <h1><?php the_title(); ?>.</h1>
        <?php if ($subtitle) : ?>
        <div class="post-subtitle">
            <p><?php echo esc_html($subtitle); ?></p>
        </div>
        <?php endif; ?>
        
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
            </div>            <!-- recent posts -->
            <div class="recent-posts">
                <h2>Recent posts</h2>
                <?php
                // max posts in the recent posts area
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 4,
                    'post_status' => 'publish'
                ));
                  foreach($recent_posts as $recent) {
                    // try to get the custom main image
                    $main_image_url = esgi_get_post_main_image_url($recent['ID'], 'thumbnail');
                    if (!$main_image_url) {
                        // Fallback to featured image if no main image is set
                        $main_image_url = get_the_post_thumbnail_url($recent['ID'], 'thumbnail');
                    }
                    // If no main image nor featured image exist, use default no-image.jpg
                    if (!$main_image_url) {
                        $main_image_url = get_template_directory_uri() . '/src/images/png/no-image.jpg';
                    }
                ?>
                <div class="post-item">
                    <img src="<?php echo $main_image_url; ?>" alt="<?php echo $recent['post_title']; ?>">
                    <div class="post-info">
                        <h3><a href="<?php echo get_permalink($recent['ID']); ?>"><?php echo $recent['post_title']; ?></a></h3>
                        <span class="post-date"><?php echo ucfirst(wp_date('j M, Y', strtotime($recent['post_date']))); ?></span>
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
                        'title_li' => '',
                        'show_count' => false,
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
                    $tags_list = get_tags(array('number' => 10, 'orderby' => 'term_id', 'order' => 'ASC'));
                    if ($tags_list) {
                        foreach($tags_list as $tag) {
                            echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                        }
                    }
                    ?>
                </div>
            </div>        </div>
          <!-- main content area -->
        <div class="post-content">
            <div class="post-thumbnail">
                <?php 
                // First try to get the custom main image
                $main_image = esgi_get_post_main_image();
                if ($main_image) {
                    echo $main_image;
                } elseif (has_post_thumbnail()) {
                    // Fallback to featured image if no main image is set
                    the_post_thumbnail('large');
                }
                // If neither main image nor featured image exist, dont display any image
                ?>
            </div>
              <div class="post-meta-info">
                <?php if (!empty($categories)) : ?>
                <div class="post-category">
                    <a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a>
                </div>
                <?php endif; ?>                <div class="post-date">
                    <?php echo ucfirst(wp_date('j M, Y', strtotime($post->post_date))); ?>
                </div>
                <?php if ($reading_time) : ?>
                <div class="reading-time">
                    <?php echo esc_html($reading_time); ?> min read
                </div>
                <?php endif; ?>
            </div>
              <div class="post-body">
                <?php the_content(); ?>
            </div>
            
            <?php if ($featured_quote) : ?>
            <div class="post-featured-quote">
                <blockquote>
                    <p>"<?php echo esc_html($featured_quote); ?>"</p>
                </blockquote>
            </div>
            <?php endif; ?>
            
            <?php if ($tags) : ?>
            <div class="post-tags">
                <div class="tag-list">
                    <?php
                    foreach($tags as $tag) {
                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                    }
                    ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- comments -->
            <div class="comments-section">
                <h2>Comments (<?php echo get_comments_number(); ?>)</h2>
                <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comment-list">
                    <?php
                    $comments = get_comments(array(
                        'post_id' => get_the_ID(),
                        'status' => 'approve'
                    ));
                    
                    foreach($comments as $comment) {
                    ?>
                    <div class="comment">
                        <div class="comment-author"><?php echo $comment->comment_author; ?></div>
                        <div class="comment-content"><?php echo $comment->comment_content; ?></div>                        <a href="#leave-reply" class="reply-button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg>
                            Reply
                        </a>
                    </div>
                    <?php } ?>
                </div>
                <?php endif; ?>
            </div>            <!-- reply form -->
            <div class="reply-form" id="leave-reply">
                <h3>Leave a reply</h3>
                <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="commentform">
                    <div class="form-group">
                        <input id="author" name="author" type="text" placeholder="Full name" required>
                    </div>
                    <div class="form-group">
                        <textarea id="comment" name="comment" placeholder="Message" required></textarea>
                    </div>
                    <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
                    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                    <button type="submit" class="submit-button">Submit</button>
                </form>            </div>
            
            <!-- separator line for mobile view -->
            <div class="mobile-sidebar-separator"></div>
            
            <!-- mobile only sidebar after reply form -->
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
                    // max posts in the recent posts area
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => 4,
                        'post_status' => 'publish'
                    ));
                    foreach($recent_posts as $recent) {
                        // try to get the custom main image
                        $main_image_url = esgi_get_post_main_image_url($recent['ID'], 'thumbnail');
                        if (!$main_image_url) {
                            // fallback to featured image
                            $thumbnail_id = get_post_thumbnail_id($recent['ID']);
                            if ($thumbnail_id) {
                                $main_image_url = wp_get_attachment_image_url($thumbnail_id, 'thumbnail');
                            }
                        }
                        // fallback to default image
                        if (!$main_image_url) {
                            $main_image_url = get_template_directory_uri() . '/src/images/png/no-image.jpg';
                        }
                    ?>
                    <div class="post-item">
                        <img src="<?php echo $main_image_url; ?>" alt="<?php echo $recent['post_title']; ?>">
                        <div class="post-info">
                            <h3><a href="<?php echo get_permalink($recent['ID']); ?>"><?php echo $recent['post_title']; ?></a></h3>
                            <div class="post-date"><?php echo ucfirst(wp_date('j M, Y', strtotime($recent['post_date']))); ?></div>
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
                        $tags_list = get_tags(array('number' => 10, 'orderby' => 'term_id', 'order' => 'ASC'));
                        if ($tags_list) {
                            foreach($tags_list as $tag) {
                                echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <!-- menu post footer -->
            <div class="post-footer-menu">
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'post_footer_menu',
                    'menu_class' => 'post-footer-nav',
                    'container' => 'nav',
                    'container_class' => 'post-footer-navigation',
                    'fallback_cb' => false,
                )); 
                ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();


