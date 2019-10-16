<?php

// custom Type Post===========================================================

// register custom post type to work with
add_action( 'init', 'royal_create_post_type_products' );
function royal_create_post_type_products() {
	// Products custom post type
	// set up labels
	$labels = array(
 		'name' => 'Product',
    	'singular_name' => 'Product',
    	'add_new' => 'Add New Product',
    	'add_new_item' => 'Add New Product',
    	'edit_item' => 'Edit Product',
    	'new_item' => 'New Product',
    	'all_items' => 'All Products',
    	'view_item' => 'View Products',
    	'search_items' => 'Search Products',
    	'not_found' =>  'No Product Found',
    	'not_found_in_trash' => 'No Product found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Product',
    );
	register_post_type( 'product', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => 'dashicons-cart',
		'supports' => array( 'title', 'editor',  'thumbnail' ),		
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}

// register two taxonomies to go with the post type
add_action( 'init', 'rt_create_product_taxonomies', 0 );
function rt_create_product_taxonomies() {

	// Products Category taxonomy
	$labels = array(
		'name'              => _x( 'Products Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'Products Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Products Category' ),
		'all_items'         => __( 'All Products Category' ),
		'parent_item'       => __( 'Parent Products Category' ),
		'parent_item_colon' => __( 'Parent Products Category:' ),
		'edit_item'         => __( 'Edit Products Category' ),
		'update_item'       => __( 'Update Products Category' ),
		'add_new_item'      => __( 'Add New Products Category' ),
		'new_item_name'     => __( 'New Products Category' ),
		'menu_name'         => __( 'Departments' ),
	);
	register_taxonomy( 'pro_cat', 'product', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true	
	) );
	

	
	
	
}





?>