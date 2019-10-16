<?php
/*
Plugin Name: Royal Pricing Tables
Plugin URI: http://www.royaltechbd.com/royal-pricing-tables/
Description: A very simple pricing table plugin.
Version: 1.0.0
Author: Mehdi Akram
Author URI: http://www.shamokaldarpon.com
License: GPL2
*/

/* This plugin was forked and further modified from the Responsive Pricing Table plugin by WP Darko */

/* Enqueue styles */
function rt_rpt_scripts() {
	wp_enqueue_style( 'pricing-tables-pro', plugins_url( 'css/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'rt_rpt_scripts', 99 );

/* Enqueue admin styles */
function rt_rpt_admin_scripts() {
	wp_enqueue_style( 'pricing-tables-pro-admin', plugins_url( 'css/admin.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'rt_rpt_admin_scripts' );

// Create Pricing Table custom type
function rt_rpt_register_post_type() {
	register_post_type( 'royal_pricing_table',
		array(
		'labels' => array(
			'name' => 'Royal Pricing Tables',
			'singular_name' => 'Royal Pricing Table',
			'add_new' => 'Add New Pricing Table',
			'add_new_item' => 'Add New Pricing Table',
			'edit_item' => 'Edit Pricing Table',
			'new_item' => 'New Pricing Table',
			'all_items' => 'All Pricing Tables',
			'view_item' => 'View Pricing Table',
			'search_items' => 'Search Pricing Tables',
			'not_found' =>  'No Pricing Table Found',
			'not_found_in_trash' => 'No Pricing Table found in Trash', 			
			),
		'public' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'supports'           => array( 'title' ),
		'menu_icon'    => 'dashicons-screenoptions',
		)
	);
}
add_action( 'init', 'rt_rpt_register_post_type' );

/* Hide View/Preview since it's a shortcode */
function rpt_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'royal_pricing_table' == $screen->post_type ) {
          $title = 'Enter Plan Group Name Here';
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'rpt_change_title_text' );



/* Hide View/Preview since it's a shortcode */
function royal_pricing_table_admin_css() {
	global $post_type;
	$post_types = array(
						'royal_pricing_table',
				  );
	if ( in_array( $post_type, $post_types ) ) {
		echo '<style type="text/css">#post-preview, #view-post-btn {display: none;}</style>'; }
}

function rt_rpt_remove_view_link( $action ) {

	unset( $action['view'] );
	return $action;
}

add_filter( 'post_row_actions', 'rt_rpt_remove_view_link' );
add_action( 'admin_head-post-new.php', 'royal_pricing_table_admin_css' );
add_action( 'admin_head-post.php', 'royal_pricing_table_admin_css' );

// Adding the CMB2 Metabox class
if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

// Registering Pricing Table metaboxes
function rt_rpt_register_plan_group_metabox() {

	$prefix = '_rt_rpt_';
	
	// Tables group
	$main_group = new_cmb2_box( array(
		'id' => $prefix . 'plan_metabox',
		'title' => 'Pricing Table Plans',
		'object_types' => array( 'royal_pricing_table' ),
	));
		
	$main_group->add_field( array(
		'name'             => 'Maximum Columns per row',
		'desc'             => 'Select how many rows you want to show per column',
		'id'               => $prefix .'maxcol',
		'type'             => 'select',
		'default'          => 'custom',
		'options'          => array(
			'1' 	=> __( '1 Column', 'cmb2' ),
			'2' 	=> __( '2 Columns', 'cmb2' ),
			'3' 	=> __( '3 Columns', 'cmb2' ),
			'4' 	=> __( '4 Columns', 'cmb2' ),
			'5' 	=> __( '5 Columns', 'cmb2' ),
			'6' 	=> __( '6 Columns', 'cmb2' ),
			'7' 	=> __( '7 Columns', 'cmb2' ),
			'8' 	=> __( '8 Columns', 'cmb2' ),
			'9' 	=> __( '9 Columns', 'cmb2' ),
			'10' 	=> __( '10 Columns', 'cmb2' ),
		),
	) );	
		
	
	
    $main_group->add_field( array(
        'name' => __( 'Title Border Bottom Color', 'cmb2' ),
        'id'   => $prefix . 'bottomcolor',
        'type' => 'colorpicker',
		'default' => '#111',
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				// Iris Options set here as values in the 'data-colorpicker' array
				'palettes' => array( '#111', '#222', '#333', '#1c1c1c'),
			) ),	
		),
    ) );	
	
    $main_group->add_field( array(
        'name' => __( 'Top Color', 'cmb2' ),
        'id'   => $prefix . 'topcolor',
        'type' => 'colorpicker',
		'default' => '#222',
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				// Iris Options set here as values in the 'data-colorpicker' array
				'palettes' => array( '#222', '#111', '#1c1c1c', '#333'),
			) ),	
		),
    ) );
    $main_group->add_field( array(
        'name' => __( 'Top Color Hover', 'cmb2' ),
        'id'   => $prefix . 'topcolorhover',
        'type' => 'colorpicker',
		'default' => '#222',
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				// Iris Options set here as values in the 'data-colorpicker' array
				'palettes' => array( '#222', '#111', '#1c1c1c', '#333'),
			) ),	
		),
    ) );
	
    $main_group->add_field( array(
        'name' => __( 'Gradient Color 1', 'cmb2' ),
        'id'   => $prefix . 'gradientcolor1',
        'type' => 'colorpicker',
		'default' => '#333',
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				// Iris Options set here as values in the 'data-colorpicker' array
				'palettes' => array( '#333', '#222', '#111', '#1c1c1c'),
			) ),	
		),
    ) );
	
    $main_group->add_field( array(
        'name' => __( 'Gradient Color 1 Hover', 'cmb2' ),
        'id'   => $prefix . 'gradientcolor1hover',
        'type' => 'colorpicker',
		'default' => '#333',
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				// Iris Options set here as values in the 'data-colorpicker' array
				'palettes' => array( '#333', '#222', '#111', '#1c1c1c'),
			) ),	
		),
    ) );
	
    $main_group->add_field( array(
        'name' => __( 'Gradient Color 2', 'cmb2' ),
        'id'   => $prefix . 'gradientcolor2',
        'type' => 'colorpicker',
		'default' => '#1c1c1c',
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				// Iris Options set here as values in the 'data-colorpicker' array
				'palettes' => array( '#1c1c1c', '#333', '#222', '#111'),
			) ),	
		),
    ) );
	
    $main_group->add_field( array(
        'name' => __( 'Gradient Color 2 Hover', 'cmb2' ),
        'id'   => $prefix . 'gradientcolor2hover',
        'type' => 'colorpicker',
		'default' => '#1c1c1c',
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				// Iris Options set here as values in the 'data-colorpicker' array
				'palettes' => array( '#1c1c1c', '#333', '#222', '#111'),
			) ),	
		),
    ) );	
	
	$rpt_plan_group = $main_group->add_field( array(
		'id' => $prefix . 'plan_group',
		'type' => 'group',
		'options' => array(
			'group_title' => 'Plan {#}',
			'add_button' => 'Add another plan',
			'remove_button' => 'Remove plan',
			'sortable' => true,
			'closed'     => true,
		),
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Plan Header',
		'id' => $prefix . 'head_header',
		'type' => 'title',
		'row_classes' => 'de_hundred de_heading',
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Title',
		'id' => $prefix . 'title',
		'type' => 'text',
		'row_classes' => 'de_first de_hundred de_text de_input',
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Before Price',
		'id'   => $prefix . 'before_price',
		'type' => 'text',
		'row_classes' => 'de_twentyfive de_text de_input',
		'attributes'  => array(
		'placeholder' => 'e.g. Tk.',
		),
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Price',
		'id'   => $prefix . 'price',
		'type' => 'text',
		'row_classes' => 'de_twentyfive de_text de_input',
		'attributes'  => array(
		'placeholder' => '99',
		),
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'After Price',
		'id'   => $prefix . 'after_price',
		'type' => 'text',
		'row_classes' => 'de_twentyfive de_text de_input',
		'attributes'  => array(
		'placeholder' => 'e.g. .00',
		),
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Caption',
		'id'   => $prefix . 'recurrence',
		'type' => 'text',
		'sanitization_cb' => false,
		'row_classes' => 'de_twentyfive de_text de_input',
		'attributes'  => array(
		'placeholder' => 'e.g. Monthly',
		),
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Plan Features',
		'id' => $prefix . 'features_header',
		'type' => 'title',
		'row_classes' => 'de_hundred de_heading',
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Feature list',
		'id' => $prefix . 'features',
		'type' => 'textarea',
		'attributes'  => array(
			'placeholder' => 'one per line',
			'rows' => 13,
		),
		'row_classes' => 'de_first de_fifty de_textarea de_input',
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Allowed HTML',
		'desc' => '<span class="dashicons dashicons-yes"></span> Images<br/><span style="color:#bbb;">&lt;img src="/wp-content/uploads/example.png" alt="Alt text"&gt;</span><br/><br/><span class="dashicons dashicons-yes"></span> Links<br/><span style="color:#bbb;">&lt;a href="http://example.com"&gt;Go to example.com&lt;/a&gt;</span><br/><br/><span class="dashicons dashicons-yes"></span> Bolded text<br/><span style="color:#bbb;">&lt;strong&gt;Something <strong>important</strong>&lt;/strong&gt;</span><br/><br/><span class="dashicons dashicons-yes"></span> Emphasized text<br/><span style="color:#bbb;">&lt;em&gt;Something <em>emphasized</em>&lt;/em&gt;</span><br/><br/><span class="dashicons dashicons-yes"></span> Strikethroughs<br/><span style="color:#bbb;">&lt;del&gt;My feature&lt;/del&gt;</span>',
		'id'   => $prefix . 'features_desc',
		'type' => 'title',
		'row_classes' => 'de_fifty de_info',
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Plan Button',
		'id' => $prefix . 'button_header',
		'type' => 'title',
		'row_classes' => 'de_hundred de_heading',
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Call to action text',
		'id'   => $prefix . 'btn_text',
		'type' => 'text',
		'attributes'  => array(
			'placeholder' => 'e.g. Purchase',
		),
		'row_classes' => 'de_first de_fifty de_text de_input',
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => 'Call to action URL',
		'id'   => $prefix . 'btn_link',
		'type' => 'text',
		'sanitization_cb' => false,
		'attributes'  => array(
		'placeholder' => 'e.g. http://example.com',
		),
		'row_classes' => 'de_fifty de_text de_input',
	));

	$main_group->add_group_field( $rpt_plan_group, array(
		'name' => '',
		'id'   => $prefix . 'sep_header',
		'type' => 'title',
	));
}
add_action( 'cmb2_init', 'rt_rpt_register_plan_group_metabox' );





// Shortcode column
function rt_rpt_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'rt_rpt_shortcode' :
			global $post;
			$slug = '' ;
			$slug = $post->post_name;
			$shortcode = '[rpt name="'.$slug.'"]';
			echo esc_html($shortcode);
	    break;		
		

	}
}
add_action( 'manage_royal_pricing_table_posts_custom_column' , 'rt_rpt_custom_columns', 10, 2 );


add_filter( 'manage_edit-royal_pricing_table_columns', 'my_edit_rpt_columns' ) ;
function my_edit_rpt_columns( $columns ) {

	$columns = array(
		'cb' 				=> '<input type="checkbox" />',
		'title' 			=> __('Royal Pricing Table Group Name'),
		'rt_rpt_shortcode' 	=> __('Shortcode'),
		'date' 				=> __('Date')
	);

	return $columns;
}







// Display Shortcode
function rt_rpt_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
	), $atts));
	$output2 = '';

	global $post;
	$args = array( 'post_type' => 'royal_pricing_table', 'name' => $name );
	$custom_posts = get_posts( $args );
	foreach ( $custom_posts as $post ) : setup_postdata( $post );

		$entries = get_post_meta( $post->ID, '_rt_rpt_plan_group', true );
		$nb_entries = count( $entries );
		$maxcol = get_post_meta( $post->ID, '_rt_rpt_maxcol', true );		
		// Opening rpt-pricing-table container
		$thePostID = $post->ID;		
		$output2 .= '<div id="rpt_id_'.$thePostID.'" class="rpt-plans rpt-'.$nb_entries.'-plans ">';

		// Opening rpt-inner
		
		$output2 .= '<div class="rpt-inner maxcol-'.$maxcol.'">';

		foreach ( $entries as $key => $plans ) {

			$output2 .= '<div class="rpt-plan rpt-plan-' . $key . ' ">';

			// Title
			if ( ! empty( $plans['_rt_rpt_title'] ) ) {
				$output2 .= '<div class="rpt-title rpt-title-' . $key . '">';
				$output2 .= $plans['_rt_rpt_title'];
				$output2 .= '</div>';
			}

			// Head
			$output2 .= '<div class="rpt-head rpt-head-' . $key . '">';

			// Price
			if ( ! empty( $plans['_rt_rpt_price'] ) ) {

				$output2 .= '<div class="rpt-price rpt-price-' . $key . '">';
				
					if ( ! empty( $plans['_rt_rpt_before_price'] ) ) {
						$output2 .= '<span class="rpt-before-price rpt-before-price-' . $key . '">';
						$output2 .= $plans['_rt_rpt_before_price'];
						$output2 .= '</span>';				
					}

				$output2 .= '<span class="rpt-price-inner rpt-price-inner-' . $key . '">';
				$output2 .= $plans['_rt_rpt_price'];
				$output2 .= '</span>';
				
					if ( ! empty( $plans['_rt_rpt_after_price'] ) ) {
						$output2 .= '<span class="rpt-after-price rpt-after-price-' . $key . '">';
						$output2 .= $plans['_rt_rpt_after_price'];
						$output2 .= '</span>';				
					}

				$output2 .= '</div>';
			}

			// Recurrence
			if ( ! empty( $plans['_rt_rpt_recurrence'] ) ) {
				$output2 .= '<div class="rpt-recurrence rpt-recurrence_' . $key . '">' . $plans['_rt_rpt_recurrence'] . '</div>';
			}

			// Closing plan head
			$output2 .= '</div>';

			if ( ! empty( $plans['_rt_rpt_features'] ) ) {

				$output2 .= '<div class="rpt-features rpt-features-' . $key . '">';

				$string = $plans['_rt_rpt_features'];
				$stringAr = explode( "\n", $string );
				$stringAr = array_filter( $stringAr, 'trim' );

				$features = '';

				foreach ( $stringAr as $feature ) {
					$features[] .= strip_tags( $feature,'<strong></strong><br><br/></br><img><a><del><em>' );
				}

				foreach ( $features as $small_key => $feature ) {
					if ( ! empty( $feature ) ) {

						$output2 .= '<div class="rpt-feature rpt-feature-' . $key . '-' . $small_key . '">';
						$output2 .= $feature;
						$output2 .= '</div>';

					}
				}

				$output2 .= '</div>';
			}

			if ( ! empty( $plans['_rt_rpt_btn_text'] ) ) {
				$btn_text = $plans['_rt_rpt_btn_text'];
				if ( ! empty( $plans['_rt_rpt_btn_link'] ) ) {
					$btn_link = $plans['_rt_rpt_btn_link'];
				} else { $btn_link = '#'; }
			} else {
				$btn_text = '';
				$btn_link = '#';
			}

				  // Default footer
			if ( ! empty( $plans['_rt_rpt_btn_text'] ) ) {
				$output2 .= '<a href="' . do_shortcode( $btn_link ) . '" class="rpt-foot rpt-foot-' . $key . '">';
			} else {
				$output2 .= '<a class="rpt-foot rpt-foot-' . $key . '">';
			}

				$output2 .= do_shortcode( $btn_text );

				  // Closing default footer
				  $output2 .= '</a>';

			$output2 .= '</div>';

		}

		// Closing ptp inner
		$output2 .= '</div>';

		// Closing ptp container
		$output2 .= '</div>';
		
		
		
		
		$bottomcolor 	= get_post_meta( $post->ID, '_rt_rpt_bottomcolor', true );
		$topcolor 		= get_post_meta( $post->ID, '_rt_rpt_topcolor', true );
		$tchover 		= get_post_meta( $post->ID, '_rt_rpt_topcolorhover', true );
		$gradientcolor1 = get_post_meta( $post->ID, '_rt_rpt_gradientcolor1', true );
		$gc1hover 		= get_post_meta( $post->ID, '_rt_rpt_gradientcolor1hover', true );
		$gradientcolor2 = get_post_meta( $post->ID, '_rt_rpt_gradientcolor2', true );
		$gc2hover 		= get_post_meta( $post->ID, '_rt_rpt_gradientcolor2hover', true );
		echo '<style type="text/css">
		#rpt_id_'.$thePostID.' .rpt-plan .rpt-title {
			border-bottom:'. $bottomcolor .' solid 2px;
			background:'.$topcolor.';
			}	
		#rpt_id_'.$thePostID.' .rpt-plan .rpt-foot{
			background:'.$topcolor.';
		}
		#rpt_id_'.$thePostID.' .rpt-plan .rpt-head {
			border-top:'. $topcolor .' solid 2px;
			background: '. $gradientcolor1 .';
			background: -moz-linear-gradient(45deg, '. $gradientcolor1 .' 0%, '. $gradientcolor2 .' 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,'. $gradientcolor1 .'), color-stop(100%,'. $gradientcolor2 .')); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(45deg, '. $gradientcolor1 .' 0%,'. $gradientcolor2 .' 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(45deg, '. $gradientcolor1 .' 0%,'. $gradientcolor2 .' 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(45deg, '. $gradientcolor1 .' 0%,'. $gradientcolor2 .' 100%); /* IE10+ */
			background: linear-gradient(45deg, '. $gradientcolor1 .' 0%,'. $gradientcolor2 .' 100%); /* W3C */				
			}
			
		#rpt_id_'.$thePostID.' .rpt-plan:hover .rpt-title {
			border-bottom:'. $bottomcolor .' solid 2px;
			background:'.$tchover.';
		}		
			
		#rpt_id_'.$thePostID.' .rpt-plan:hover .rpt-head{
			background: '. $gc1hover .';
			background: -moz-linear-gradient(45deg, '. $gc1hover .' 0%, '. $gc2hover .' 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,'. $gc1hover .'), color-stop(100%,'. $gc2hover .')); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(45deg, '. $gc1hover .' 0%,'. $gc2hover .' 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(45deg, '. $gc1hover .' 0%,'. $gc2hover .' 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(45deg, '. $gc1hover .' 0%,'. $gc2hover .' 100%); /* IE10+ */
			background: linear-gradient(45deg, '. $gc1hover .' 0%,'. $gc2hover .' 100%); /* W3C */		
		}
			
		</style>';
		

		
	endforeach; wp_reset_postdata();
	return $output2;

}

add_shortcode( 'rpt', 'rt_rpt_shortcode' );
?>
