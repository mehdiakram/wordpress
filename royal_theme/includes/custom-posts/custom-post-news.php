<?php

// register custom post type to work with
add_action( 'init', 'royal_create_News_post_type' );
function royal_create_News_post_type() {
	// News custom post type
	// set up labels
	$labels = array(
 		'name' => 'News & Events',
    	'singular_name' => 'News & Events',
    	'add_new' => 'Add New News & Events',
    	'add_new_item' => 'Add New News & Events',
    	'edit_item' => 'Edit News & Events',
    	'new_item' => 'New News & Events',
    	'all_items' => 'All News & Events',
    	'view_item' => 'View News & Events',
    	'search_items' => 'Search News & Events',
    	'not_found' =>  'No News & Events Found',
    	'not_found_in_trash' => 'No News & Events found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'News & Events',
    );
	register_post_type( 'news', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => 'dashicons-rss',		
		'supports' => array( 'title', 'editor', 'custom-fields'),		
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}

// register two taxonomies to go with the post type
add_action( 'init', 'royal_news_category_create_taxonomies', 0 );
function royal_news_category_create_taxonomies() {
	// News & Events Category taxonomy
	$labels = array(
		'name'              => _x( 'News & Events Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'News & Events Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search News & Events Category' ),
		'all_items'         => __( 'All News & Events Category' ),
		'parent_item'       => __( 'Parent News & Events Category' ),
		'parent_item_colon' => __( 'Parent News & Events Category:' ),
		'edit_item'         => __( 'Edit News & Events Category' ),
		'update_item'       => __( 'Update News & Events Category' ),
		'add_new_item'      => __( 'Add New News & Events Category' ),
		'new_item_name'     => __( 'New News & Events Category' ),
		'menu_name'         => __( 'News & Events Category' ),
	);
	register_taxonomy( 'newscategory', 'news', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true	
	) );
}

// custom Type Post============================================================






?>