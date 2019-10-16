<?php

// custom Type Post===========================================================

// register custom post type for certification
add_action( 'init', 'royal_certification_create_post_type' );
function royal_certification_create_post_type() {
	// certification custom post type
	// set up labels
	$labels = array(
 		'name' => 'Certification',
    	'singular_name' => 'Certification',
    	'add_new' => 'Add New Certification',
    	'add_new_item' => 'Add New Certification',
    	'edit_item' => 'Edit Certification',
    	'new_item' => 'New Certification',
    	'all_items' => 'All Certification',
    	'view_item' => 'View Certification',
    	'search_items' => 'Search Certification',
    	'not_found' =>  'No Certification Found',
    	'not_found_in_trash' => 'No certification found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Certification',
    );
	register_post_type( 'certification', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => 'dashicons-awards',
		'supports' => array( 'title', 'editor'),
		'register_meta_box_cb' => 'add_certification_metaboxes',
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}



// Add the Certification Meta Boxes

function add_certification_metaboxes() {
	add_meta_box('certification_details', 'Certification Details', 'certification_details', 'certification', 'normal', 'high');
}



// The Metabox

function certification_details() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="certificationmeta_noncename" id="certificationmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get meta box

        $certification_university_name = get_post_meta($post->ID, '_certification_university_name', true);
        $certification_type = get_post_meta($post->ID, '_certification_type', true);
	
	// Echo out the field
      
		echo '<p>University Name</p>';
        echo '<input type="text" name="_certification_university_name" value="' . $certification_university_name  . '" class="widefat" />';        
		
		echo '<p>Certification Type, Like:Graduated, Post-Graduated, Under-Graduated </p>';
        echo '<input type="text" name="_certification_type" value="' . $certification_type  . '" class="widefat" />';	
		

}


// Save the Metabox Data
function royal_save_certification_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['certificationmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	

	$certification_meta['_certification_university_name'] = $_POST['_certification_university_name'];
	$certification_meta['_certification_type'] = $_POST['_certification_type'];
	
	// Add values of $certification_meta as custom fields
	
	foreach ($certification_meta as $key => $value) { // Cycle through the $certification_meta array!
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

add_action('save_post', 'royal_save_certification_meta', 1, 2); // save the custom fields


// custom Type Post============================================================


?>