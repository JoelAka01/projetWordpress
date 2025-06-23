<?php
if (!defined('ABSPATH')) {
    exit;
}

// partners management

// Add admin menu
add_action('admin_menu', 'esgi_partners_admin_menu');
function esgi_partners_admin_menu() {
    add_theme_page(
        'Partners Management',
        'Partners',
        'manage_options',
        'esgi-partners',
        'esgi_partners_admin_page'
    );
}

// Admin page content
function esgi_partners_admin_page() {
    // Handle form submission
    if (isset($_POST['save_partners']) && wp_verify_nonce($_POST['partners_nonce'], 'save_partners')) {
        esgi_save_partners_data();
    }
    
    $partners = get_option('esgi_partners', []);
    ?>
    <div class="wrap">
        <h1>Partners Management</h1>
        <p>Add, edit, or remove partner logos and information.</p>
        
        <form method="post" action="" id="partners-form">
            <?php wp_nonce_field('save_partners', 'partners_nonce'); ?>
            
            <div id="partners-container">
                <?php if (!empty($partners)) : ?>
                    <?php foreach ($partners as $index => $partner) : ?>
                        <?php esgi_render_partner_row($index, $partner); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="partner-actions" style="margin: 20px 0;">
                <button type="button" id="add-partner" class="button button-secondary">
                    <span class="dashicons dashicons-plus-alt"></span> Add New Partner
                </button>
                
                <button type="submit" name="save_partners" class="button button-primary">
                    <span class="dashicons dashicons-yes"></span> Save All Partners
                </button>
            </div>
        </form>
    </div>
    
    <style>
        .partner-row {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            padding: 20px;
            position: relative;
        }
        
        .partner-row h3 {
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        .partner-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }
        
        .partner-image-field {
            grid-column: 1 / -1;
        }
        
        .partner-image-preview {
            max-width: 150px;
            max-height: 80px;
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 5px;
        }
        
        .remove-partner {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #dc3232;
            text-decoration: none;
            font-size: 16px;
        }
        
        .remove-partner:hover {
            color: #a00;
        }
        
        .partner-actions {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        
        .dashicons {
            vertical-align: middle;
        }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        let partnerIndex = <?php echo count($partners); ?>;
        
        // Add new partner
        $('#add-partner').on('click', function() {
            const newPartnerHtml = `
                <div class="partner-row">
                    <h3>Partner ${partnerIndex + 1}</h3>
                    <a href="#" class="remove-partner" title="Remove Partner">
                        <span class="dashicons dashicons-trash"></span>
                    </a>
                    
                    <div class="partner-fields">
                        <div>
                            <label for="partner_name_${partnerIndex}"><strong>Partner Name</strong></label>
                            <input type="text" 
                                   name="partners[${partnerIndex}][name]" 
                                   id="partner_name_${partnerIndex}"
                                   class="regular-text" 
                                   placeholder="Enter partner name">
                        </div>
                        
                        <div>
                            <label for="partner_url_${partnerIndex}"><strong>Partner URL</strong></label>
                            <input type="url" 
                                   name="partners[${partnerIndex}][url]" 
                                   id="partner_url_${partnerIndex}"
                                   class="regular-text" 
                                   placeholder="https://partner-website.com">
                        </div>
                        
                        <div class="partner-image-field">
                            <label><strong>Partner Logo</strong></label>
                            <div>
                                <input type="hidden" 
                                       name="partners[${partnerIndex}][logo]" 
                                       id="partner_logo_${partnerIndex}" 
                                       value="">
                                <button type="button" 
                                        class="button upload-logo-btn" 
                                        data-index="${partnerIndex}">
                                    Select Logo
                                </button>
                                <button type="button" 
                                        class="button remove-logo-btn" 
                                        data-index="${partnerIndex}" 
                                        style="display: none;">
                                    Remove Logo
                                </button>
                                <div class="logo-preview" id="logo_preview_${partnerIndex}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            $('#partners-container').append(newPartnerHtml);
            partnerIndex++;
            updatePartnerNumbers();
        });
        
        // Remove partner
        $(document).on('click', '.remove-partner', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to remove this partner?')) {
                $(this).closest('.partner-row').remove();
                updatePartnerNumbers();
            }
        });
        
        // Update partner numbers
        function updatePartnerNumbers() {
            $('.partner-row').each(function(index) {
                $(this).find('h3').text('Partner ' + (index + 1));
            });
        }
        
        // Media uploader
        $(document).on('click', '.upload-logo-btn', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const index = button.data('index');
            
            const mediaUploader = wp.media({
                title: 'Select Partner Logo',
                button: {
                    text: 'Use this logo'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });
            
            mediaUploader.on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#partner_logo_' + index).val(attachment.url);
                $('#logo_preview_' + index).html('<img src="' + attachment.url + '" class="partner-image-preview">');
                button.siblings('.remove-logo-btn').show();
            });
            
            mediaUploader.open();
        });
        
        // Remove logo
        $(document).on('click', '.remove-logo-btn', function(e) {
            e.preventDefault();
            const index = $(this).data('index');
            $('#partner_logo_' + index).val('');
            $('#logo_preview_' + index).empty();
            $(this).hide();
        });
    });
    </script>
    <?php
}

// Render individual partner row
function esgi_render_partner_row($index, $partner = []) {
    $name = isset($partner['name']) ? $partner['name'] : '';
    $url = isset($partner['url']) ? $partner['url'] : '';
    $logo = isset($partner['logo']) ? $partner['logo'] : '';
    ?>
    <div class="partner-row">
        <h3>Partner <?php echo $index + 1; ?></h3>
        <a href="#" class="remove-partner" title="Remove Partner">
            <span class="dashicons dashicons-trash"></span>
        </a>
        
        <div class="partner-fields">
            <div>
                <label for="partner_name_<?php echo $index; ?>"><strong>Partner Name</strong></label>
                <input type="text" 
                       name="partners[<?php echo $index; ?>][name]" 
                       id="partner_name_<?php echo $index; ?>"
                       class="regular-text" 
                       value="<?php echo esc_attr($name); ?>"
                       placeholder="Enter partner name">
            </div>
            
            <div>
                <label for="partner_url_<?php echo $index; ?>"><strong>Partner URL</strong></label>
                <input type="url" 
                       name="partners[<?php echo $index; ?>][url]" 
                       id="partner_url_<?php echo $index; ?>"
                       class="regular-text" 
                       value="<?php echo esc_attr($url); ?>"
                       placeholder="https://partner-website.com">
            </div>
            
            <div class="partner-image-field">
                <label><strong>Partner Logo</strong></label>
                <div>
                    <input type="hidden" 
                           name="partners[<?php echo $index; ?>][logo]" 
                           id="partner_logo_<?php echo $index; ?>" 
                           value="<?php echo esc_attr($logo); ?>">
                    <button type="button" 
                            class="button upload-logo-btn" 
                            data-index="<?php echo $index; ?>">
                        Select Logo
                    </button>
                    <button type="button" 
                            class="button remove-logo-btn" 
                            data-index="<?php echo $index; ?>" 
                            style="<?php echo $logo ? 'display: inline-block;' : 'display: none;'; ?>">
                        Remove Logo
                    </button>
                    <div class="logo-preview" id="logo_preview_<?php echo $index; ?>">
                        <?php if ($logo) : ?>
                            <img src="<?php echo esc_url($logo); ?>" class="partner-image-preview">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// Save partners data
function esgi_save_partners_data() {
    if (isset($_POST['partners']) && is_array($_POST['partners'])) {
        $partners = [];
        
        foreach ($_POST['partners'] as $partner_data) {
            // Only save partners that have at least a name or logo
            if (!empty($partner_data['name']) || !empty($partner_data['logo'])) {
                $partners[] = [
                    'name' => sanitize_text_field($partner_data['name']),
                    'url' => esc_url_raw($partner_data['url']),
                    'logo' => esc_url_raw($partner_data['logo'])
                ];
            }
        }
        
        update_option('esgi_partners', $partners);
        
        echo '<div class="notice notice-success"><p>Partners updated successfully!</p></div>';
    } else {
        // If no partners submitted, save empty array
        update_option('esgi_partners', []);
        echo '<div class="notice notice-success"><p>Partners cleared successfully!</p></div>';
    }
}

// Enqueue admin scripts
add_action('admin_enqueue_scripts', 'esgi_partners_admin_scripts');
function esgi_partners_admin_scripts($hook) {
    if ($hook !== 'appearance_page_esgi-partners') {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_script('jquery');
}

// notice about full partner management
add_action('admin_notices', 'esgi_partners_admin_notice');
function esgi_partners_admin_notice() {
    $screen = get_current_screen();
    
    // Show notice on theme pages and dashboard
    if ($screen && (strpos($screen->id, 'themes') !== false || $screen->id === 'dashboard')) {
        // Only show if user hasn't dismissed it
        if (!get_user_meta(get_current_user_id(), 'esgi_partners_notice_dismissed', true)) {
            ?>
            <div class="notice notice-info is-dismissible" id="esgi-partners-notice">
                <h3>New Partner Management Available!</h3>
                <p>Your ESGI theme can handle flexible partners numbers!</p>
                <ul style="margin-left: 20px;">
                    <li>Add unlimited partners!!!</li>
                </ul>
                <p>
                    <a href="<?php echo admin_url('themes.php?page=esgi-partners'); ?>" class="button button-primary">
                        Manage Partners →
                    </a>
                    <button type="button" class="button" onclick="esgiDismissNotice()">Dismiss</button>
                </p>
            </div>
            
            <script>
            function esgiDismissNotice() {
                jQuery.post(ajaxurl, {
                    action: 'esgi_dismiss_partners_notice',
                    nonce: '<?php echo wp_create_nonce('esgi_dismiss_notice'); ?>'
                });
                jQuery('#esgi-partners-notice').fadeOut();
            }
            
            // Auto dismiss when close button is clicked
            jQuery(document).on('click', '#esgi-partners-notice .notice-dismiss', function() {
                esgiDismissNotice();
            });
            </script>
            <?php
        }
    }
}

// Handle notice dismissal
add_action('wp_ajax_esgi_dismiss_partners_notice', 'esgi_dismiss_partners_notice');
function esgi_dismiss_partners_notice() {
    if (wp_verify_nonce($_POST['nonce'], 'esgi_dismiss_notice')) {
        update_user_meta(get_current_user_id(), 'esgi_partners_notice_dismissed', true);
        wp_die();
    }
}

// Helper function to get partners for frontend
function esgi_get_partners() {
    $partners = get_option('esgi_partners', []);
    
    // If no dynamic partners exist, fall back to customizer settings for backward compatibility
    if (empty($partners)) {
        $legacy_partners = [];
        for ($i = 1; $i <= 6; $i++) {
            $partner_logo = get_theme_mod('partner_logo_' . $i);
            $partner_name = get_theme_mod('partner_name_' . $i, '');
            $partner_url = get_theme_mod('partner_url_' . $i, '');
            
            if ($partner_logo || $partner_name) {
                $legacy_partners[] = [
                    'name' => $partner_name,
                    'url' => $partner_url,
                    'logo' => $partner_logo
                ];
            }
        }
        return $legacy_partners;
    }
    
    return $partners;
}

// migration helper to move customizer partners to new system
add_action('init', 'esgi_migrate_customizer_partners');
function esgi_migrate_customizer_partners() {
    // Only run migration if new system has no partners and customizer has partners
    $existing_partners = get_option('esgi_partners', []);
    $migration_done = get_option('esgi_partners_migration_done', false);
    
    if (empty($existing_partners) && !$migration_done) {
        $migrated_partners = [];
        
        // Check if any customizer partners exist
        for ($i = 1; $i <= 6; $i++) {
            $partner_logo = get_theme_mod('partner_logo_' . $i);
            $partner_name = get_theme_mod('partner_name_' . $i, '');
            $partner_url = get_theme_mod('partner_url_' . $i, '');
            
            if ($partner_logo || $partner_name) {
                $migrated_partners[] = [
                    'name' => $partner_name,
                    'url' => $partner_url,
                    'logo' => $partner_logo
                ];
            }
        }
        
        // Save migrated partners if any exist
        if (!empty($migrated_partners)) {
            update_option('esgi_partners', $migrated_partners);
        }
        
        // Mark migration as done
        update_option('esgi_partners_migration_done', true);
    }
}
