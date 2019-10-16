<?php

// custom Type Post===========================================================

// register custom post type to work with
add_action( 'init', 'rt_create_post_type' );
function rt_create_post_type() {
	// Teacher custom post type
	// set up labels
	$labels = array(
 		'name' => 'Teacher Bio',
    	'singular_name' => 'Teacher Bio',
    	'add_new' => 'Add New',
    	'add_new_item' => 'Add New Teacher Bio',
    	'edit_item' => 'Edit Teacher Bio',
    	'new_item' => 'New Teacher Bio',
    	'all_items' => 'All Teacher Bio',
    	'view_item' => 'View Teacher Bio',
    	'search_items' => 'Search Teacher Bio',
    	'not_found' =>  'No Teacher Bio Found',
    	'not_found_in_trash' => 'No Teacher Bio found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Teacher Bio',
    );
	register_post_type( 'teacher', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => get_stylesheet_directory_uri() . '/images/teacher.png',
		'supports' => array( 'title', 'editor',  'thumbnail' ),
		'register_meta_box_cb' => 'add_Teacher_metaboxes',
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}

// register two taxonomies to go with the post type
add_action( 'init', 'rt_create_taxonomies', 0 );
function rt_create_taxonomies() {
	// Department taxonomy
	$labels = array(
		'name'              => _x( 'Departments', 'taxonomy general name' ),
		'singular_name'     => _x( 'Department', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Departments' ),
		'all_items'         => __( 'All Departments' ),
		'parent_item'       => __( 'Parent Department' ),
		'parent_item_colon' => __( 'Parent Department:' ),
		'edit_item'         => __( 'Edit Department' ),
		'update_item'       => __( 'Update Department' ),
		'add_new_item'      => __( 'Add New Department' ),
		'new_item_name'     => __( 'New Department' ),
		'menu_name'         => __( 'Departments' ),
	);
	register_taxonomy( 'Department', 'teacher', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true	
	) );
	// Position taxonomy
	$labels = array(
		'name'              => _x( 'Positions', 'taxonomy general name' ),
		'singular_name'     => _x( 'Position', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Positions' ),
		'all_items'         => __( 'All Position' ),
		'parent_item'       => __( 'Parent Position' ),
		'parent_item_colon' => __( 'Parent Position:' ),
		'edit_item'         => __( 'Edit Position' ),
		'update_item'       => __( 'Update Position' ),
		'add_new_item'      => __( 'Add New Position' ),
		'new_item_name'     => __( 'New Position' ),
		'menu_name'         => __( 'Positions' ),
	);
	register_taxonomy( 'Position', 'teacher', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true	
	) );
}


// Add the Teacher Meta Boxes

function add_Teacher_metaboxes() {
	add_meta_box('teacher_details', 'Teacher Details', 'teacher_details', 'teacher', 'normal', 'high');
}



// The Metabox

function teacher_details() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="teachermeta_noncename" id="teachermeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get meta box

        $teacher_mobile_number = get_post_meta($post->ID, '_teacher_mobile_number', true);
        $teacher_email = get_post_meta($post->ID, '_teacher_email', true);
        $teacher_publishers = get_post_meta($post->ID, '_teacher_publishers', true);
	
	// Echo out the field
      
		echo '<p>Mobile Number</p>';
        echo '<input type="text" name="_teacher_mobile_number" value="' . $teacher_mobile_number  . '" class="widefat" />';        
		
		echo '<p>Email Address</p>';
        echo '<input type="text" name="_teacher_email" value="' . $teacher_email  . '" class="widefat" />';	
		
		echo '<p>Teacher Total Publishers</p>';
        echo '<input type="text" name="_teacher_publishers" value="' . $teacher_publishers  . '" class="widefat" />';

}


// Save the Metabox Data
function wpt_save_teacher_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['teachermeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	

	$Teacher_meta['_teacher_mobile_number'] = $_POST['_teacher_mobile_number'];
	$Teacher_meta['_teacher_email'] = $_POST['_teacher_email'];
	$Teacher_meta['_teacher_publishers'] = $_POST['_teacher_publishers'];
	
	// Add values of $Teacher_meta as custom fields
	
	foreach ($Teacher_meta as $key => $value) { // Cycle through the $Teacher_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpt_save_teacher_meta', 1, 2); // save the custom fields



/* Rename Featured Image */
add_action('do_meta_boxes', 'change_image_box');
function change_image_box()
{
    remove_meta_box( 'postimagediv', 'teacher', 'teacher' );
    add_meta_box('postimagediv', __('Set Teacher Photo (150px X 200px)'), 'post_thumbnail_meta_box', 'teacher', 'normal', 'high');
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