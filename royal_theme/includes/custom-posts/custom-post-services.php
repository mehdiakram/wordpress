<?php

// register custom post type to work with
add_action( 'init', 'royal_create_services_post_type' );
function royal_create_services_post_type() {
	// services custom post type
	// set up labels
	$labels = array(
 		'name' => 'Services',
    	'singular_name' => 'Service',
    	'add_new' => 'Add New Service',
    	'add_new_item' => 'Add New Service',
    	'edit_item' => 'Edit Service',
    	'new_item' => 'New service',
    	'all_items' => 'All Services',
    	'view_item' => 'View Service',
    	'search_items' => 'Search Services',
    	'not_found' =>  'No Service Found',
    	'not_found_in_trash' => 'No Service found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Services',
    );
	register_post_type( 'services', array(
		'labels' => $labels,
        'public' => true,
        'show_ui' => true,
		'show_in_menu'       => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => 'dashicons-lightbulb',		
		'supports' => array( 'title', 'editor', 'thumbnail'),		
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}
// custom Type Post============================================================




//don't conflict with other plugins
$prefix = 'wcm_';
$post_types = array('services');
//set up the box and teh fields inside
$meta_box = array(
	'id' => 'fa-meta-box',
	'title' => 'Font Awesome Icon', //title of box
	
	'context' => 'side', //normal, advanced or side
	'priority' => 'default',
	'fields' => array(  //and now for the custom fields in the box
		
		array(
			'name' => 'Icon',
			'id' => $prefix . 'fa',
			'type' => 'select',
			'options' => array('fa-adjust' ,
								'align-center' ,
								'fa-align-justify' ,
								'fa-align-left' ,
								'fa-align-right' ,
								'fa-ambulance',
								'fa-angle-down',
								'fa-angle-left',
								'fa-angle-right',
								'fa-angle-up',
								'fa-arrow-down' ,
								'fa-arrow-left' ,
								'fa-arrow-right' ,
								'fa-arrow-up' ,
								'fa-asterisk' ,
								'fa-backward' ,
								'fa-ban-circle' ,
								'fa-bar-chart' ,
								'fa-barcode' ,
								'fa-beaker' ,
								'fa-beer',
								'fa-bell' ,
								'fa-bell-alt',
								'fa-bold' ,
								'fa-bolt' ,
								'fa-book' ,
								'fa-bookmark' ,
								'fa-bookmark-empty' ,
								'fa-briefcase' ,
								'fa-building',
								'fa-bullhorn' ,
								'fa-calendar' ,
								'fa-camera' ,
								'fa-camera-retro' ,
								'fa-caret-down' ,
								'fa-caret-left' ,
								'fa-caret-right' ,
								'fa-caret-up' ,
								'fa-certificate' ,
								'fa-check' ,
								'fa-check-empty' ,
								'fa-chevron-down' ,
								'fa-chevron-left' ,
								'fa-chevron-right' ,
								'fa-chevron-up' ,
								'fa-circle',
								'fa-circle-arrow-down' ,
								'fa-circle-arrow-left' ,
								'fa-circle-arrow-right' ,
								'fa-circle-arrow-up' ,
								'fa-circle-blank',
								'fa-cloud' ,
								'fa-cloud-download',
								'fa-cloud-upload',
								'fa-coffee',
								'fa-cog' ,
								'fa-cogs' ,
								'fa-columns' ,
								'fa-comment' ,
								'fa-comment-alt' ,
								'fa-comments' ,
								'fa-comments-alt' ,
								'fa-copy' ,
								'fa-credit-card' ,
								'fa-cut' ,
								'fa-dashboard' ,
								'fa-desktop',
								'fa-double-angle-down',
								'fa-double-angle-left',
								'fa-double-angle-right',
								'fa-double-angle-up',
								'fa-download' ,
								'fa-download-alt' ,
								'fa-edit' ,
								'fa-eject' ,
								'fa-envelope' ,
								'fa-envelope-alt' ,
								'fa-exchange',
								'fa-exclamation-sign' ,
								'fa-external-link' ,
								'fa-eye-close' ,
								'fa-eye-open' ,
								'fa-facebook' ,
								'fa-facebook-sign' ,
								'fa-facetime-video' ,
								'fa-fast-backward' ,
								'fa-fast-forward' ,
								'fa-fighter-jet',
								'fa-file' ,
								'fa-file-alt',
								'fa-film' ,
								'fa-filter' ,
								'fa-fire' ,
								'fa-flag' ,
								'fa-folder-close' ,
								'fa-folder-close-alt',
								'fa-folder-open' ,
								'fa-folder-open-alt',
								'fa-font' ,
								'fa-food',
								'fa-forward' ,
								'fa-fullscreen' ,
								'fa-gift' ,
								'fa-github' ,
								'fa-github-alt',
								'fa-github-sign' ,
								'fa-glass' ,
								'fa-globe' ,
								'fa-google-plus' ,
								'fa-google-plus-sign' ,
								'fa-group' ,
								'fa-h-sign',
								'fa-hand-down' ,
								'fa-hand-left' ,
								'fa-hand-right' ,
								'fa-hand-up' ,
								'fa-hdd' ,
								'fa-headphones' ,
								'fa-heart' ,
								'fa-heart-empty' ,
								'fa-home' ,
								'fa-hospital',
								'fa-inbox' ,
								'fa-indent-left' ,
								'fa-indent-right' ,
								'fa-info-sign' ,
								'fa-italic' ,
								'fa-key' ,
								'fa-laptop',
								'fa-leaf' ,
								'fa-legal' ,
								'fa-lemon' ,
								'fa-lightbulb',
								'fa-link' ,
								'fa-linkedin' ,
								'fa-linkedin-sign' ,
								'fa-list' ,
								'fa-list-alt' ,
								'fa-list-ol' ,
								'fa-list-ul' ,
								'fa-lock' ,
								'fa-magic' ,
								'fa-magnet' ,
								'fa-map-marker' ,
								'fa-medkit',
								'fa-minus' ,
								'fa-minus-sign' ,
								'fa-mobile-phone',
								'fa-money' ,
								'fa-move' ,
								'fa-music' ,
								'fa-off' ,
								'fa-ok' ,
								'fa-ok-circle' ,
								'fa-ok-sign' ,
								'fa-paper-clip' ,
								'fa-paste' ,
								'fa-pause' ,
								'fa-pencil' ,
								'fa-phone' ,
								'fa-phone-sign' ,
								'fa-picture' ,
								'fa-pinterest' ,
								'fa-pinterest-sign' ,
								'fa-plane' ,
								'fa-play' ,
								'fa-play-circle' ,
								'fa-plus' ,
								'fa-plus-sign' ,
								'fa-plus-sign-alt',
								'fa-print' ,
								'fa-pushpin' ,
								'fa-qrcode' ,
								'fa-question-sign' ,
								'fa-quote-left',
								'fa-quote-right',
								'fa-random' ,
								'fa-refresh' ,
								'fa-remove' ,
								'fa-remove-circle' ,
								'fa-remove-sign' ,
								'fa-reorder' ,
								'fa-repeat' ,
								'fa-reply',
								'fa-resize-full' ,
								'fa-resize-horizontal' ,
								'fa-resize-small' ,
								'fa-resize-vertical' ,
								'fa-retweet' ,
								'fa-road' ,
								'fa-rss' ,
								'fa-save' ,
								'fa-screenshot' ,
								'fa-search' ,
								'fa-share' ,
								'fa-share-alt' ,
								'fa-shopping-cart' ,
								'fa-sign-blank' ,
								'fa-signal' ,
								'fa-signin' ,
								'fa-signout' ,
								'fa-sitemap' ,
								'fa-sort' ,
								'fa-sort-down' ,
								'fa-sort-up' ,
								'fa-spinner',
								'fa-star' ,
								'fa-star-empty' ,
								'fa-star-half' ,
								'fa-step-backward' ,
								'fa-step-forward' ,
								'fa-stethoscope',
								'fa-stop' ,
								'fa-strikethrough' ,
								'fa-suitcase',
								'fa-table' ,
								'fa-tablet',
								'fa-tag' ,
								'fa-tags' ,
								'fa-tasks' ,
								'fa-text-height' ,
								'fa-text-width' ,
								'fa-th' ,
								'fa-th-large' ,
								'fa-th-list' ,
								'fa-thumbs-down' ,
								'fa-thumbs-up' ,
								'fa-time' ,
								'fa-tint' ,
								'fa-trash' ,
								'fa-trophy' ,
								'fa-truck' ,
								'fa-twitter' ,
								'fa-twitter-sign' ,
								'fa-umbrella' ,
								'fa-underline' ,
								'fa-undo' ,
								'fa-unlock' ,
								'fa-upload' ,
								'fa-upload-alt' ,
								'fa-user' ,
								'fa-user-md' ,
								'fa-user-md',
								'fa-volume-down' ,
								'fa-volume-off' ,
								'fa-volume-up' ,
								'fa-warning-sign' ,
								'fa-wrench' ,
								'fa-zoom-in' ,
								'fa-zoom-out'							
 )
		)
	)
);

add_action('admin_menu', 'font_awesome_add_box');

// Add meta box
function font_awesome_add_box() {
	global $meta_box;
	global $post_types;
	foreach($post_types as $type){
	//(id, title, callback, post type, context, priority, callback args)
	add_meta_box($meta_box['id'], $meta_box['title'], 'font_awesome_show_box', $type, $meta_box['context'], $meta_box['priority']);
}
}

// Callback function to show fields in meta box
function font_awesome_show_box() {
	global $meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="font_awesome_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br />', $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'<td>';
		echo '<i style="font-size:14px; font-family: FontAwesome; font-style: normal;" class="fa-large '.$meta.'"></i>';
		echo	'</td></tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'font_awesome_save_data');

// Save data from meta box
function font_awesome_save_data($post_id) {
	global $meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['font_awesome_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}



//theme template tag
function fontawesome_fa(){
	global $post;
	$fa = get_post_meta($post->ID, 'wcm_fa', true); ?>
<?php if($fa):?>
<i class="fa <?php echo get_post_meta($post->ID, 'wcm_fa', true);?> fa-large"></i>
<?php endif;
}








?>