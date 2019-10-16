<?php

// register custom post type to work with
add_action( 'init', 'royal_create_students_comment_post_type' );
function royal_create_students_comment_post_type() {
	// Students Comment custom post type
	// set up labels
	$labels = array(
 		'name' => 'Students Comment',
    	'singular_name' => 'Students Comment',
    	'add_new' => 'Add New Students Comment',
    	'add_new_item' => 'Add New Students Comment',
    	'edit_item' => 'Edit Students Comment',
    	'new_item' => 'New Students Comment',
    	'all_items' => 'All Students Comment',
    	'view_item' => 'View Students Comment',
    	'search_items' => 'Search Students Comment',
    	'not_found' =>  'No Students Comment Found',
    	'not_found_in_trash' => 'No Students Comment found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Students Comment',
    );
	register_post_type( 'studentscomment', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => get_stylesheet_directory_uri() . '/images/comment.png',		
		'supports' => array( 'title', 'editor',  'thumbnail' ),		
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}

// custom Type Post============================================================




?>