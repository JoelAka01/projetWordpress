<?php
// register custom page templates
function esgi_add_page_template_to_dropdown($templates)
{
    $templates['page-about.php'] = __('About Us Page', 'ESGI');
    $templates['page-services.php'] = __('Services Page', 'ESGI');
    $templates['page-partners.php'] = __('Partners Page', 'ESGI');

    return $templates;
}
add_filter('theme_page_templates', 'esgi_add_page_template_to_dropdown');
