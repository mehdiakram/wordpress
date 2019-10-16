<?php

// custom Type Post===========================================================

// register custom post type for experience
add_action( 'init', 'royal_experience_create_post_company' );
function royal_experience_create_post_company() {
	// experience custom post type
	// set up labels
	$labels = array(
 		'name' => 'Experience',
    	'singular_name' => 'Experience',
    	'add_new' => 'Add New Experience',
    	'add_new_item' => 'Add New Experience',
    	'edit_item' => 'Edit Experience',
    	'new_item' => 'New Experience',
    	'all_items' => 'All Experience',
    	'view_item' => 'View Experience',
    	'search_items' => 'Search Experience',
    	'not_found' =>  'No Experience Found',
    	'not_found_in_trash' => 'No Experience found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Experience',
    );
	register_post_type( 'experience', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => 'dashicons-admin-network',
		'supports' => array( 'title'),
		'register_meta_box_cb' => 'add_experience_metaboxes',
		'exclude_from_search' => false,
		'capability_company' => 'post',
		)
	);
}



// Add the experience Meta Boxes

function add_experience_metaboxes() {
	add_meta_box('experience_details', 'Experience Details', 'experience_details', 'experience', 'normal', 'high');
}



// The Metabox

function experience_details() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="experiencemeta_noncename" id="experiencemeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get meta box
        $experience_position = get_post_meta($post->ID, '_experience_position', true);
        $experience_company = get_post_meta($post->ID, '_experience_company', true);
        $experience_key_responsibilities = get_post_meta($post->ID, '_experience_key_responsibilities', true);
        $experience_descriptions = get_post_meta($post->ID, '_experience_descriptions', true);
        $experience_joining_date = get_post_meta($post->ID, '_experience_joining_date', true);
        $experience_resignation_date = get_post_meta($post->ID, '_experience_resignation_date', true);
	
	// Echo out the field    
		echo '<p>Position</p>';
        echo '<input type="text" name="_experience_position" value="' . $experience_position  . '" class="widefat" />';        
		
		echo '<p>Company Name</p>';
        echo '<input type="text" name="_experience_company" value="' . $experience_company  . '" class="widefat" />';	
				
		echo '<p>Key Responsibilities</p>';
        echo '<input type="text" name="_experience_key_responsibilities" value="' . $experience_key_responsibilities  . '" class="widefat" />';	
		
		echo '<p>Job Descriptions</p>';
        echo '<input type="text" name="_experience_descriptions" value="' . $experience_descriptions  . '" class="widefat" />';	
			
		echo '<p>Joining_date</p>';
        echo '<input type="text" name="_experience_joining_date" value="' . $experience_joining_date  . '" class="widefat" />';	
				
		echo '<p>Resignation Date</p>';
        echo '<input type="text" name="_experience_resignation_date" value="' . $experience_resignation_date  . '" class="widefat" />';	
		

}


// Save the Metabox Data
function royal_save_experience_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['experiencemeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	

	$experience_meta['_experience_position'] = $_POST['_experience_position'];
	$experience_meta['_experience_company'] = $_POST['_experience_company'];
	$experience_meta['_experience_key_responsibilities'] = $_POST['_experience_key_responsibilities'];
	$experience_meta['_experience_descriptions'] = $_POST['_experience_descriptions'];
	$experience_meta['_experience_joining_date'] = $_POST['_experience_joining_date'];
	$experience_meta['_experience_resignation_date'] = $_POST['_experience_resignation_date'];
	
	// Add values of $experience_meta as custom fields
	
	foreach ($experience_meta as $key => $value) { // Cycle through the $experience_meta array!
		if( $post->post_company == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'royal_save_experience_meta', 1, 2); // save the custom fields


// custom Type Post============================================================


?>