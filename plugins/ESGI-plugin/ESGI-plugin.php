<?php
/*
Plugin Name: Plugin ESGI
Plugin URI: https:esgi.fr
Description: Ajout d'un lien de duplication des articles et pages
Author: ESGI
Version: 1.0
*/

add_filter('post_row_actions', 'esgi_displayDuplicateLink', 10, 2);
function esgi_displayDuplicateLink($actions, $post)
{
    if (!current_user_can('edit_posts')) {
        return $actions;
    }
    $url = wp_nonce_url(
        add_query_arg(
            [
                'action' => 'esgi_duplicate_post',
                'post' => $post->ID,
            ],
            'admin.php'
        )
    );
    $actions['duplicate'] = '<a href="' . $url . '">' . __('Duplicate', 'ESGI') . '</a>';
    return $actions;
}

add_action('admin_action_esgi_duplicate_post', 'esgi_duplicate_post');
function esgi_duplicate_post()
{

    if (isset($_GET['post']) || check_admin_referer()) {
        // crée un post à partir de l'id présent dans l'url
        $original_post = get_post($_GET['post']);
        // Récupérer les clés de l'objet orignal pour les mettre dans tableau d'arguments
        $args = get_object_vars($original_post);

        unset($args['ID']);
        $args['post_status'] = 'draft';
        $args['post_title'] .= ' - DUPLICATE';

        $new_post_id = wp_insert_post($args);

        // ajout du post thumbnail
        $original_thumbnail_id = get_post_thumbnail_id($original_post);
        set_post_thumbnail($new_post_id, $original_thumbnail_id);
    }

    wp_safe_redirect(
        add_query_arg(
            ['post_type' => 'post'],
            admin_url('edit.php')
        )
    );
}

function esgi_register_project_post_type() {
	register_post_type('project',
		array(
			'labels'      => array(
				'name'          => __('Projects', 'ESGI'),
                'singular_name' => __('Project', 'ESGI'),
                'menu_name'     => __('Projects', 'ESGI'),
                'add_new'       => __('Add New', 'ESGI'),
                'add_new_item'  => __('Add New Project', 'ESGI'),
                'edit_item'     => __('Edit Project', 'ESGI'),
                'view_item'     => __('View Project', 'ESGI'),
                'search_items'  => __('Search Projects', 'ESGI'),
			),
			'public'      => true,
			'has_archive' => true,
            'menu_icon'   => 'dashicons-portfolio',
            'supports'    => array('title', 'editor', 'thumbnail', 'excerpt'),
            'rewrite'     => array('slug' => 'projects'),
            'show_in_rest'=> true, // Active l'éditeur Gutenberg
		)
	);
}
add_action('init', 'esgi_register_project_post_type');

function esgi_register_skill_taxonomy() {
    $labels = array(
        'name'              => _x('Skills', 'taxonomy general name', 'ESGI'),
        'singular_name'     => _x('Skill', 'taxonomy singular name', 'ESGI'),
        'search_items'      => __('Search Skills', 'ESGI'),
        'all_items'         => __('All Skills', 'ESGI'),
        'parent_item'       => __('Parent Skill', 'ESGI'),
        'parent_item_colon' => __('Parent Skill:', 'ESGI'),
        'edit_item'         => __('Edit Skill', 'ESGI'),
        'update_item'       => __('Update Skill', 'ESGI'),
        'add_new_item'      => __('Add New Skill', 'ESGI'),
        'new_item_name'     => __('New Skill Name', 'ESGI'),
        'menu_name'         => __('Skills', 'ESGI'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'skill'),
        'show_in_rest'      => true, // Permet l'utilisation dans l'éditeur Gutenberg
    );

    register_taxonomy('skill', array('project'), $args);
}
add_action('init', 'esgi_register_skill_taxonomy');

