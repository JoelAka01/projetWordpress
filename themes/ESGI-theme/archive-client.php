<?php
// Archive template for clients
get_header();
?>

<main class="archive-page clients-archive">
    <div class="container">
        <div class="archive-header">
            <h1>Our Clients</h1>
            <p>Discover the amazing companies we've had the privilege to work with.</p>
        </div>

        <div class="clients-grid">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    $company_name = esgi_get_client_field('company_name');
                    $industry = esgi_get_client_field('industry');
                    $website = esgi_get_client_field('website');
                    $project_start = esgi_get_client_field('project_start');
                    $testimonial = esgi_get_client_field('testimonial');
                    ?>
                    
                    <div class="client-card">
                        <div class="client-image">
                            <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('medium');
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/src/images/png/1.png" alt="' . get_the_title() . '">';
                            }
                            ?>
                        </div>
                        
                        <div class="client-info">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            
                            <?php if ($company_name) : ?>
                            <div class="client-company"><?php echo esc_html($company_name); ?></div>
                            <?php endif; ?>
                            
                            <?php if ($industry) : ?>
                            <div class="client-industry"><?php echo esc_html($industry); ?></div>
                            <?php endif; ?>
                            
                            <?php if ($project_start) : ?>
                            <div class="project-date">Project started: <?php echo esc_html(wp_date('F Y', strtotime($project_start))); ?></div>
                            <?php endif; ?>
                            
                            <div class="client-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <?php if ($testimonial) : ?>
                            <div class="client-testimonial-preview">
                                <blockquote>
                                    <p>"<?php echo esc_html(wp_trim_words($testimonial, 20, '...')); ?>"</p>
                                </blockquote>
                            </div>
                            <?php endif; ?>
                            
                            <div class="client-actions">
                                <a href="<?php the_permalink(); ?>" class="view-case-study">View Case Study</a>
                                
                                <?php if ($website) : ?>
                                <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener" class="visit-website">
                                    Visit Website
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
                <div class="no-clients">
                    <h2>No client case studies found</h2>
                    <p>We're working on showcasing our client success stories. Check back soon!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
