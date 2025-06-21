<?php
// Template for single member
get_header();

// get member custom fields
$position = esgi_get_member_field('position');
$department = esgi_get_member_field('department');
$email = esgi_get_member_field('email');
$phone = esgi_get_member_field('phone');
$linkedin = esgi_get_member_field('linkedin');
$twitter = esgi_get_member_field('twitter');

?>

<main class="post member-single">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        
        <!-- sidebar -->
        <div class="post-sidebar">
            <!-- member info -->
            <div class="member-info">
                <h2>Member Information</h2>
                
                <?php if ($position) : ?>
                <div class="member-detail">
                    <strong>Position:</strong> <?php echo esc_html($position); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($department) : ?>
                <div class="member-detail">
                    <strong>Department:</strong> <?php echo esc_html($department); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($email) : ?>
                <div class="member-detail">
                    <strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                </div>
                <?php endif; ?>
                
                <?php if ($phone) : ?>
                <div class="member-detail">
                    <strong>Phone:</strong> <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                </div>
                <?php endif; ?>
                
                <?php if ($linkedin || $twitter) : ?>
                <div class="member-social">
                    <h3>Social Links</h3>
                    <?php if ($linkedin) : ?>
                    <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener">
                        <?php echo esgi_getIcon('linkedin'); ?>
                        LinkedIn
                    </a>
                    <?php endif; ?>
                    
                    <?php if ($twitter) : ?>
                    <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener">
                        <?php echo esgi_getIcon('twitter'); ?>
                        Twitter
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- other members -->
            <div class="other-members">
                <h2>Other Members</h2>
                <?php
                $other_members = get_posts(array(
                    'post_type' => 'member',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'post_status' => 'publish'                ));
                
                foreach($other_members as $member) {
                    $member_position = get_post_meta($member->ID, '_esgi_member_position', true);
                    // First try to get the custom main image
                    $thumb_url = esgi_get_post_main_image_url($member->ID, 'thumbnail');
                    if (!$thumb_url) {
                        // Fallback to featured image if no main image is set
                        $thumb_url = get_the_post_thumbnail_url($member->ID, 'thumbnail');
                    }
                    // If neither main image nor featured image exist, don't display any image
                ?>
                <div class="post-item">
                    <?php if ($thumb_url) : ?>
                    <img src="<?php echo $thumb_url; ?>" alt="<?php echo $member->post_title; ?>">
                    <?php endif; ?>
                    <div class="post-info">
                        <h3><a href="<?php echo get_permalink($member->ID); ?>"><?php echo $member->post_title; ?></a></h3>
                        <?php if ($member_position) : ?>
                        <span class="member-position"><?php echo esc_html($member_position); ?></span>
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
                <?php if ($position) : ?>
                <div class="post-category">
                    <span><?php echo esc_html($position); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($department) : ?>
                <div class="post-date">
                    <?php echo esc_html($department); ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="post-body">
                <?php the_content(); ?>
            </div>
            
            <!-- member navigation -->
            <div class="member-navigation">
                <?php
                $prev_member = get_previous_post(false, '', 'member');
                $next_member = get_next_post(false, '', 'member');
                ?>
                
                <?php if ($prev_member) : ?>
                <div class="nav-previous">
                    <a href="<?php echo get_permalink($prev_member); ?>">
                        <span>&larr; Previous Member</span>
                        <strong><?php echo esc_html($prev_member->post_title); ?></strong>
                    </a>
                </div>
                <?php endif; ?>
                
                <?php if ($next_member) : ?>
                <div class="nav-next">
                    <a href="<?php echo get_permalink($next_member); ?>">
                        <span>Next Member &rarr;</span>
                        <strong><?php echo esc_html($next_member->post_title); ?></strong>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
