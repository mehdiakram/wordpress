<?php

// register custom post type to work with
add_action( 'init', 'royal_create_Notice_post_type' );
function royal_create_Notice_post_type() {
	// Notice custom post type
	// set up labels
	$labels = array(
 		'name' => 'Notice',
    	'singular_name' => 'Notice',
    	'add_new' => 'Add New Notice',
    	'add_new_item' => 'Add New Notice',
    	'edit_item' => 'Edit Notice',
    	'new_item' => 'New Notice',
    	'all_items' => 'All Notice',
    	'view_item' => 'View Notice',
    	'search_items' => 'Search Notice',
    	'not_found' =>  'No Notice Found',
    	'not_found_in_trash' => 'No Notice found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Notice',
    );
	register_post_type( 'notice', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => get_stylesheet_directory_uri() . '/images/notice.png',		
		'supports' => array( 'title', 'editor'),		
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}
// custom Type Post============================================================






?>