<section class="identity-card">
    <?= get_custom_logo() ?>
    <h1> <?= get_bloginfo('name') ?></h1>
    <h2> <?= get_bloginfo('description') ?></h2>
    <?php
    $url_twitter = get_theme_mod('url_twitter', '');
    $url_facebook = get_theme_mod('url_facebook', '');
    $url_google = get_theme_mod('url_google', '');
    $url_linkedin = get_theme_mod('url_linkedin', '');
    
    // Display only if at least one social URL is available
    if (!empty($url_twitter) || !empty($url_facebook) || !empty($url_google) || !empty($url_linkedin)) : 
    ?>
    <footer>
        <ul>
            <?php if (!empty($url_twitter)) : ?>
                <li>
                    <a href="<?= esc_url($url_twitter) ?>"><?= esgi_getIcon('twitter') ?></a>
                </li>
            <?php endif; ?>
            
            <?php if (!empty($url_facebook)) : ?>
                <li>
                    <a href="<?= esc_url($url_facebook) ?>"><?= esgi_getIcon('facebook') ?></a>
                </li>
            <?php endif; ?>
            
            <?php if (!empty($url_google)) : ?>
                <li>
                    <a href="<?= esc_url($url_google) ?>"><?= esgi_getIcon('google') ?></a>
                </li>
            <?php endif; ?>
            
            <?php if (!empty($url_linkedin)) : ?>
                <li>
                    <a href="<?= esc_url($url_linkedin) ?>"><?= esgi_getIcon('linkedin') ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </footer>
    <?php endif; ?>
</section>