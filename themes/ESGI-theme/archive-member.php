<?php
// Archive template for members
get_header();
?>

<main class="archive-page members-archive">
    <div class="container">
        <div class="archive-header">
            <h1>Our Team Members</h1>
            <p>Meet the talented individuals who make our company great.</p>
        </div>

        <div class="members-grid">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    $position = esgi_get_member_field('position');
                    $department = esgi_get_member_field('department');
                    $email = esgi_get_member_field('email');
                    $linkedin = esgi_get_member_field('linkedin');
                    ?>
                    
                    <div class="member-card">                        <div class="member-image">
                            <?php 
                            // First try to get the custom main image
                            $main_image = esgi_get_post_main_image(null, 'medium');
                            if ($main_image) {
                                echo $main_image;
                            } elseif (has_post_thumbnail()) {
                                // Fallback to featured image if no main image is set
                                the_post_thumbnail('medium');
                            }
                            // If neither main image nor featured image exist, don't display any image
                            ?>
                        </div>
                        
                        <div class="member-info">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            
                            <?php if ($position) : ?>
                            <div class="member-position"><?php echo esc_html($position); ?></div>
                            <?php endif; ?>
                            
                            <?php if ($department) : ?>
                            <div class="member-department"><?php echo esc_html($department); ?></div>
                            <?php endif; ?>
                            
                            <div class="member-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <div class="member-actions">
                                <a href="<?php the_permalink(); ?>" class="view-profile">View Profile</a>
                                
                                <?php if ($email) : ?>
                                <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-member">
                                    Contact
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($linkedin) : ?>
                                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" class="linkedin-link">
                                    <?php echo esgi_getIcon('linkedin'); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                <?php endwhile; ?>
                
                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                    ));
                    ?>
                </div>
                
            <?php else : ?>
                <div class="no-members">
                    <h2>No team members found</h2>
                    <p>We're currently building our team. Check back soon!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
