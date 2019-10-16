<?php

// custom Type Post===========================================================

// register custom post type to work with
add_action( 'init', 'royal_create_portfolio_post_type' );
function royal_create_portfolio_post_type() {
	// Portfolio custom post type
	// set up labels
	$labels = array(
 		'name' => 'Portfolio',
    	'singular_name' => 'Portfolio',
    	'add_new' => 'Add New',
    	'add_new_item' => 'Add New Portfolio',
    	'edit_item' => 'Edit Portfolio',
		'update_item'  => 'Update Portfolio',
    	'new_item' => 'New Portfolio',
    	'all_items' => 'All Portfolio',
    	'view_item' => 'View Portfolio',
    	'search_items' => 'Search Portfolio',
    	'not_found' =>  'No Portfolio Found',
    	'not_found_in_trash' => 'No Portfolio found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Portfolio',
    );
	register_post_type( 'portfolio', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => 'dashicons-portfolio',
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}

// register two taxonomies to go with the post type
add_action( 'init', 'royal_create_portfolio_taxonomies', 0 );
function royal_create_portfolio_taxonomies() {
	// Portfolio Category taxonomy
	$labels = array(
		'name'              => _x( 'Portfolio Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Portfolio Category' ),
		'all_items'         => __( 'All Portfolio Category' ),
		'parent_item'       => __( 'Parent Portfolio Category' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:' ),
		'edit_item'         => __( 'Edit Portfolio Category' ),
		'update_item'       => __( 'Update Portfolio Category' ),
		'add_new_item'      => __( 'Add New Portfolio Category' ),
		'new_item_name'     => __( 'New Portfolio Category' ),
		'menu_name'         => __( 'Portfolio Category' ),
	);
	register_taxonomy( 'portfolio_cat', 'portfolio', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true	
	) );
}


/* Rename Featured Image */
add_action('do_meta_boxes', 'change_portfolio_image_box');
function change_portfolio_image_box()
{
    remove_meta_box( 'postimagediv', 'portfolio', 'portfolio' );
    add_meta_box('postimagediv', __('Set Portfolio Photo (450px X 500px)'), 'post_thumbnail_meta_box', 'portfolio', 'normal', 'high');
}

// custom Type Post============================================================










// Required Feature Post //
function royal_check_thumbnail($post_id) {
    // change to any custom post type
	// if( get_post_format($post_id) === false) // no format is standard format
	// if(get_post_type($post_id) != 'post' && get_post_type($post_id) != 'page')
    if(get_post_type($post_id) != 'teacher') // Specific Post Type
        return;
    if ( !has_post_thumbnail( $post_id ) ) {
        // set a transient to show the users an admin message
        set_transient( "has_post_thumbnail", "no" );
        // unhook this function so it doesn't loop infinitely
        remove_action('save_post', 'royal_check_thumbnail');
        // update the post set it to draft
        wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
        add_action('save_post', 'royal_check_thumbnail');
    } else {
        delete_transient( "has_post_thumbnail" );
    }
}
add_action('save_post', 'royal_check_thumbnail');

function royal_thumbnail_error()
{
    // check if the transient is set, and display the error message
    if ( get_transient( "has_post_thumbnail" ) == "no" ) {
        echo "<div id='message' class='error' style='color:#ff0000;'><p><strong>You must set Teacher's Photo. Otherwise this Post is saved but it can not be published.</strong></p></div>";
        delete_transient( "has_post_thumbnail" );
    }
}
add_action('admin_notices', 'royal_thumbnail_error');





?>