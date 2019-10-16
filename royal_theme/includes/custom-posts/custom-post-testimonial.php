<?php
/* Register Custom Post Types Testimonial */
	function create_post_type() {
		register_post_type( 'testimonial',
			array(
				'labels' => array(
					'name' => __( 'Testimonial' ),
					'singular_name' => __( 'Testimonial' ),
					'add_new' => __( 'Add New Testimonial' ),
					'add_new_item' => __( 'Add New Testimonial' ),
					'edit_item' => __( 'Edit Testimonial' ),
					'new_item' => __( 'New Testimonial' ),
					'view_item' => __( 'View Testimonial' ),
					'not_found' => __( 'Sorry, we couldn\'t find the Testimonial you are looking for.' )
				),
			'public' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'menu_position' => 2,
			'has_archive' => false,
			'hierarchical' => false, 
			'menu_icon' => 'dashicons-format-quote',	
			'capability_type' => 'page',
			'rewrite' => array( 'slug' => 'testimonial' ),
			'supports' => array( 'title' )
			)
		);

	}
	add_action( 'init', 'create_post_type' );
	
	
	
	

// Add the testimonial Meta Boxes
add_action( 'add_meta_boxes', 'add_testimonial_metaboxes' );
function add_testimonial_metaboxes() {
	add_meta_box('testimonial_details', 'Testimonial, URL & Country', 'testimonial_details', 'testimonial', 'normal', 'high');
}


// The Metabox
function testimonial_details() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="testimonialmeta_noncename" id="testimonialmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get meta box
        $client_testimonial = get_post_meta($post->ID, '_client_testimonial', true);
        $client_moreurl = get_post_meta($post->ID, '_client_moreurl', true);
        $client_country = get_post_meta($post->ID, '_client_country', true);
	
	// Echo out the field
		echo '<p>Client Testimonial</p>';
        echo '<input type="text" name="_client_testimonial" value="' . $client_testimonial  . '" class="widefat" />';			
		
		echo '<p>Client More URL</p>';
        echo '<input type="text" name="_client_moreurl" value="' . $client_moreurl  . '" class="widefat" />';	
		
		echo '<p>Client Country</p>';
        echo '<input type="text" name="_client_country" value="' . $client_country  . '" class="widefat" />';

}


// Save the Metabox Data
function royal_testimonial_save_testimonial_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['testimonialmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	

	$testimonial_meta['_client_testimonial'] = $_POST['_client_testimonial'];
	$testimonial_meta['_client_moreurl'] = $_POST['_client_moreurl'];
	$testimonial_meta['_client_country'] = $_POST['_client_country'];
	
	// Add values of $testimonial_meta as custom fields
	
	foreach ($testimonial_meta as $key => $value) { // Cycle through the $testimonial_meta array!
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

add_action('save_post', 'royal_testimonial_save_testimonial_meta', 1, 2); // save the custom fields



	
	
	
	
	
	
	

?>	