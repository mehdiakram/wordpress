<?php

// register custom post type to work with
add_action( 'init', 'royal_create_slides_post_type' );

function royal_create_slides_post_type() {

    $labels = array( 
        'name' => _x( 'Slides', 'slide' ),
        'singular_name' => _x( 'slide', 'slide' ),
        'add_new' => _x( 'Add New Slide', 'slide' ),
        'add_new_item' => _x( 'Add New slide', 'slide' ),
        'edit_item' => _x( 'Edit slide', 'slide' ),
        'new_item' => _x( 'New slide', 'slide' ),
        'view_item' => _x( 'View slide', 'slide' ),
        'search_items' => _x( 'Search slides', 'slide' ),
        'not_found' => _x( 'No slides found', 'slide' ),
        'not_found_in_trash' => _x( 'No slides found in Trash', 'slide' ),
        'parent_item_colon' => _x( 'Parent slide:', 'slide' ),
        'menu_name' => _x( 'Slides', 'slide' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => 'dashicons-images-alt2',		
		'supports' => array( 'title', 'thumbnail'),		
		'exclude_from_search' => false,
        'can_export' => true,

        // map_meta_cap will allow us to remap the existing capabilities with new capabilities to match the new custom post type
        'map_meta_cap' => true,
        // capabilities are what we are customising so lets remap them
        'capabilities' => array(
            'edit_post' => 'edit_slide',
            'edit_posts' => 'edit_slides',
            'edit_others_posts' => 'edit_other_slides',
            'publish_posts' => 'publish_slides',
            'edit_publish_posts' => 'edit_publish_slides',
            'read_post' => 'read_slides',
            'read_private_posts' => 'read_private_slides',
            'delete_post' => 'delete_slide'
        ),
        // capability_type defines how to make words plural, by default the
        // second word has an 's' added to it and for 'slide' that's fine
        // however when it comes to words like gallery the plural would become
        // galleries so it's worth adding your own regardless of the plural.
        'capability_type' => array('slide', 'slides'),
    );
    register_post_type( 'slides', $args );
}


function manage_slide_capabilities() {
    // gets the role to add capabilities to
    $admin = get_role( 'administrator' );
    $editor = get_role( 'editor' );
    $author = get_role( 'author' );
	// replicate all the remapped capabilites from the custom post type slide
    $caps = array(
    	'edit_slide',
    	'edit_slides',
    	'edit_other_slides',
    	'publish_slides',
    	'edit_published_slides',
    	'read_slides',
    	'read_private_slides',
    	'delete_slide'
    );
    // give all the capabilities to the administrator
    foreach ($caps as $cap) {
	    $admin->add_cap( $cap );
    }
	// remove all the capabilities to the author
    foreach ($caps as $cap) {
	    $author->remove_cap( $cap );
    }	

    // limited the capabilities to the editor or a custom role 	
    $editor->add_cap( 'edit_slide' );
    $editor->add_cap( 'edit_slides' );
    $editor->add_cap( 'read_slides' );
}
add_action( 'admin_init', 'manage_slide_capabilities');



/* Rename Featured Image */
add_action('do_meta_boxes', 'change_royal_slides_image_box');
function change_royal_slides_image_box()
{
    remove_meta_box( 'postimagediv', 'slides', 'slides' );
    add_meta_box('postimagediv', __('Set Slides Image (Width : 1600px X Height : 680px)'), 'post_thumbnail_meta_box', 'slides', 'normal', 'high');
}


// custom Type Post============================================================



?>