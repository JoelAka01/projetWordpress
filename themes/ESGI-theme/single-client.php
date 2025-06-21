<?php
// Template for single client
get_header();

// get client custom fields
$company_name = esgi_get_client_field('company_name');
$industry = esgi_get_client_field('industry');
$website = esgi_get_client_field('website');
$project_start = esgi_get_client_field('project_start');
$project_end = esgi_get_client_field('project_end');
$testimonial = esgi_get_client_field('testimonial');

?>

<main class="post client-single">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        
        <!-- sidebar -->
        <div class="post-sidebar">
            <!-- client info -->
            <div class="client-info">
                <h2>Client Information</h2>
                
                <?php if ($company_name) : ?>
                <div class="client-detail">
                    <strong>Company:</strong> <?php echo esc_html($company_name); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($industry) : ?>
                <div class="client-detail">
                    <strong>Industry:</strong> <?php echo esc_html($industry); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($website) : ?>
                <div class="client-detail">
                    <strong>Website:</strong> <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener"><?php echo esc_html($website); ?></a>
                </div>
                <?php endif; ?>
                
                <?php if ($project_start) : ?>
                <div class="client-detail">
                    <strong>Project Started:</strong> <?php echo esc_html(wp_date('j F Y', strtotime($project_start))); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($project_end) : ?>
                <div class="client-detail">
                    <strong>Project Completed:</strong> <?php echo esc_html(wp_date('j F Y', strtotime($project_end))); ?>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- other clients -->
            <div class="other-clients">
                <h2>Other Clients</h2>
                <?php
                $other_clients = get_posts(array(
                    'post_type' => 'client',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'post_status' => 'publish'
                ));
                  foreach($other_clients as $client) {
                    $client_company = get_post_meta($client->ID, '_esgi_client_company_name', true);
                    // First try to get the custom main image
                    $thumb_url = esgi_get_post_main_image_url($client->ID, 'thumbnail');
                    if (!$thumb_url) {
                        // Fallback to featured image if no main image is set
                        $thumb_url = get_the_post_thumbnail_url($client->ID, 'thumbnail');
                    }
                    // If neither main image nor featured image exist, don't display any image
                ?>
                <div class="post-item">
                    <?php if ($thumb_url) : ?>
                    <img src="<?php echo $thumb_url; ?>" alt="<?php echo $client->post_title; ?>">
                    <?php endif; ?>
                    <div class="post-info">
                        <h3><a href="<?php echo get_permalink($client->ID); ?>"><?php echo $client->post_title; ?></a></h3>
                        <?php if ($client_company) : ?>
                        <span class="client-company"><?php echo esc_html($client_company); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        
        <!-- main content area -->
        <div class="post-content">            <div class="post-thumbnail">
                <?php 
                // First try to get the custom main image
                $main_image = esgi_get_post_main_image();
                if ($main_image) {
                    echo $main_image;
                } elseif (has_post_thumbnail()) {
                    // Fallback to featured image if no main image is set
                    the_post_thumbnail('large');
                }
                // If neither main image nor featured image exist, don't display any image
                ?>
            </div>
            
            <div class="post-meta-info">
                <?php if ($company_name) : ?>
                <div class="post-category">
                    <span><?php echo esc_html($company_name); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($industry) : ?>
                <div class="post-date">
                    <?php echo esc_html($industry); ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="post-body">
                <?php the_content(); ?>
            </div>
            
            <?php if ($testimonial) : ?>
            <div class="client-testimonial">
                <h3>Client Testimonial</h3>
                <blockquote>
                    <p>"<?php echo esc_html($testimonial); ?>"</p>
                    <?php if ($company_name) : ?>
                    <cite>— <?php echo esc_html($company_name); ?></cite>
                    <?php endif; ?>
                </blockquote>
            </div>
            <?php endif; ?>
            
            <!-- client navigation -->
            <div class="client-navigation">
                <?php
                $prev_client = get_previous_post(false, '', 'client');
                $next_client = get_next_post(false, '', 'client');
                ?>
                
                <?php if ($prev_client) : ?>
                <div class="nav-previous">
                    <a href="<?php echo get_permalink($prev_client); ?>">
                        <span>&larr; Previous Client</span>
                        <strong><?php echo esc_html($prev_client->post_title); ?></strong>
                    </a>
                </div>
                <?php endif; ?>
                
                <?php if ($next_client) : ?>
                <div class="nav-next">
                    <a href="<?php echo get_permalink($next_client); ?>">
                        <span>Next Client &rarr;</span>
                        <strong><?php echo esc_html($next_client->post_title); ?></strong>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
