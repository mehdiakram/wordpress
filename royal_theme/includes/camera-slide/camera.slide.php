<?php

// register custom post type to work with
add_action( 'init', 'royal_create_slides_post_type' );
function royal_create_slides_post_type() {
	// slides custom post type
	// set up labels
	$labels = array(
 		'name' => 'Slides',
    	'singular_name' => 'Slide',
    	'add_new' => 'Add New Slide',
    	'add_new_item' => 'Add New Slide',
    	'edit_item' => 'Edit Slide',
    	'new_item' => 'New Slide',
    	'all_items' => 'All Slide',
    	'view_item' => 'View Slide',
    	'search_items' => 'Search Slide',
    	'not_found' =>  'No Slide Found',
    	'not_found_in_trash' => 'No Slide found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Slides',
    );
	register_post_type( 'slides', array(
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
		'capability_type' => 'post',
		)
	);
}



/* Rename Featured Image */
add_action('do_meta_boxes', 'change_royal_slides_image_box');
function change_royal_slides_image_box()
{
    remove_meta_box( 'postimagediv', 'slides', 'slides' );
    add_meta_box('postimagediv', __('Set Slides Image (Width : 980px X Height : 300px)'), 'post_thumbnail_meta_box', 'slides', 'normal', 'high');
}


// custom Type Post============================================================



?>