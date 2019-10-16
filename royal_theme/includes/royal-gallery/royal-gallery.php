<?php

// register custom post type to work with
add_action( 'init', 'royal_create_galleries_post_type' );
function royal_create_galleries_post_type() {
	// Galleries custom post type
	// set up labels
	$labels = array(
 		'name' => 'Galleries',
    	'singular_name' => 'Gallery',
    	'add_new' => 'Add New Gallery',
    	'add_new_item' => 'Add New Gallery',
    	'edit_item' => 'Edit Galleries',
    	'new_item' => 'New Galleries',
    	'all_items' => 'All Galleries',
    	'view_item' => 'View Galleries',
    	'search_items' => 'Search Galleries',
    	'not_found' =>  'No Galleries Found',
    	'not_found_in_trash' => 'No Galleries found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Royal Galleries',
    );
	register_post_type( 'royal_galleries', array(
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
		'menu_icon' => 'dashicons-cart',		
		'supports' => array( 'title'),		
		'exclude_from_search' => false,
		'capability_type' => 'post',
		)
	);
}

/* This code for Featured Image Support */
add_theme_support( 'post-thumbnails', array( 'royal_galleries') );
set_post_thumbnail_size( 200, 200, true );
add_image_size( 'galleriesthumbnails', 200, 200, true ); 
add_image_size( 'galleries800x600', 800, 600, true ); 
 

add_filter( 'enter_title_here', 'royal_galleries_custom_enter_title' );
function royal_galleries_custom_enter_title( $input ) {
    global $post_type;

    if ( is_admin() && 'royal_galleries' == $post_type )
        return __( 'Enter Gallery Name Here', 'royal_theme' );

    return $input;
}
// custom Type Post============================================================


//CMB2 Gallery
add_action( 'cmb2_admin_init', 'cmb2_galleries_metaboxes' );
function cmb2_galleries_metaboxes() {
    $royal_galleries_cmb = new_cmb2_box( array(
        'id'            => 'galleries_metabox',
        'title'         => __( 'Gallery Details', 'royal_theme' ),
        'object_types'  => array( 'royal_galleries'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );
	
    // Image List
    $royal_galleries_cmb->add_field( array(
        'name' => __( 'Add Photos for this gallery', 'royal_theme' ),
		'desc' => 'Minimum image size 200X200px, Should maximum use 800X600px',
        'id'   => '_royal_gallery',
        'type' => 'file_list',
    ) );
	$royal_galleries_cmb->add_field( array(
		'name'             => 'Maximum Columns per row',
		'desc'             => 'Select how many images you want to show per column',
		'id'               => '_royal_maxcol',
		'type'             => 'select',
		'default'          => '4',
		'options'          => array(
			'1' 	=> __( '1 Column', 'royal_theme' ),
			'2' 	=> __( '2 Columns', 'royal_theme' ),
			'3' 	=> __( '3 Columns', 'royal_theme' ),
			'4' 	=> __( '4 Columns', 'royal_theme' ),
			'5' 	=> __( '5 Columns', 'royal_theme' ),
			'6' 	=> __( '6 Columns', 'royal_theme' ),
			'7' 	=> __( '7 Columns', 'royal_theme' ),
			'8' 	=> __( '8 Columns', 'royal_theme' ),
			'9' 	=> __( '9 Columns', 'royal_theme' ),
			'10' 	=> __( '10 Columns', 'royal_theme' ),
		),
	) );		
}




/* Add Aditional Content for Royal Galleries */
function royal_portfolio_before_after($content) {
    if ( is_singular( 'royal_galleries' ) ) {
		global $post;
		$gallery = get_post_meta( $post->ID, '_royal_gallery', true );
		$imgcount = count( $gallery );
		$maxcol = get_post_meta( $post->ID, '_royal_maxcol', true );
		$before = '';
		$before .= '<div id="gal_id_'.$thePostID.'" class="royalgallery imgcount-'.$imgcount.'">';		
		$before .= '<div class="galinner maxcol-'.$maxcol.'">';		
		$before .= '<ul>';
			foreach ( (array) $gallery as $attachment_id => $attachment_url ) {
				$galthumb = wp_get_attachment_image_url( $attachment_id, 'galleriesthumbnails' );
				$gal800 = wp_get_attachment_image_url( $attachment_id, 'galleries800x600' );
				$before .='<li><a href="'.$gal800.'"><img src="'.$galthumb.'" alt="" /></li></a>';
			}			
		$before .= '</ul>';		
		// Closing ptp inner
		$before .= '</div>';

		// Closing ptp container
		$before .= '</div>';		
		$after = '<style type="text/css">
		.royalgallery{overflow:hidden;}
		.royalgallery .galinner{}
		.royalgallery .galinner ul{margin: 0!important; padding: 0!important; text-align: center;}
		.royalgallery .galinner ul li{
			list-style: none;
			display: inline-block;				
		}
		.royalgallery .galinner ul li a{}
		.royalgallery .galinner ul li a img{
			padding: 5px;
			margin: 5px;
			border: 1px solid #ddd;
			box-shadow: 3px 2px 5px #ddd;
			width: calc(100% - 22px);			
			
		}
		.royalgallery .maxcol-1 ul li{width: 100%;}
		.royalgallery .maxcol-2 ul li{width: 50%;}
		.royalgallery .maxcol-3 ul li{width: 33.333333333%;}
		.royalgallery .maxcol-4 ul li{width: 25%;}
		.royalgallery .maxcol-5 ul li{width: 20%;}
		.royalgallery .maxcol-6 ul li{width: 16.6666667%;}
		.royalgallery .maxcol-7 ul li{width: 14.2857143%;}
		.royalgallery .maxcol-8 ul li{width: 12.5%;}
		.royalgallery .maxcol-9 ul li{width: 11.1111111%;}
		.royalgallery .maxcol-10 ul li{width: 10%;}

		@media only screen and (max-width: 767px) {
		.royalgallery .maxcol-3 ul li,
		.royalgallery .maxcol-4 ul li{
			width: 50%;
		}
		
		.royalgallery .maxcol-5 ul li,
		.royalgallery .maxcol-6 ul li,
		.royalgallery .maxcol-7 ul li,
		.royalgallery .maxcol-8 ul li,
		.royalgallery .maxcol-9 ul li,
		.royalgallery .maxcol-10 ul li{
			width: 25%;
			}
		
		}
		
		@media only screen and (max-width: 599px) {
		.royalgallery .maxcol-1 ul li,
		.royalgallery .maxcol-2 ul li,
		.royalgallery .maxcol-3 ul li,
		.royalgallery .maxcol-4 ul li,
		.royalgallery .maxcol-5 ul li,
		.royalgallery .maxcol-6 ul li,
		.royalgallery .maxcol-7 ul li,
		.royalgallery .maxcol-8 ul li,
		.royalgallery .maxcol-9 ul li,
		.royalgallery .maxcol-10 ul li{width: 100%;}			
		}
		</style>';
        $fullcontent = $before . $content . $after;
    } else {
        $fullcontent = $content;
    }   
    return $fullcontent;
}
add_filter('the_content', 'royal_portfolio_before_after');










// Shortcode column
function royal_galleries_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'royal_gallery_shortcode' :
			global $post;
			$slug = '' ;
			$slug = $post->post_name;
			$shortcode = '[royalgallery name="'.$slug.'"]';
			echo esc_html($shortcode);
	    break;			
		
		case 'royal_galleries_shortcode' :
			$shortcode = '[royalgalleries"]';
			echo esc_html($shortcode);
	    break;		
		

	}
}
add_action( 'manage_royal_galleries_posts_custom_column' , 'royal_galleries_custom_columns', 10, 2 );


add_filter( 'manage_edit-royal_galleries_columns', 'royal_galleries_edit_rpt_columns' ) ;
function royal_galleries_edit_rpt_columns( $columns ) {
	$columns = array(
		'cb' 							=> '<input type="checkbox" />',
		'title' 						=> __('Gallery Name'),
		'royal_gallery_shortcode' 		=> __('Single Gallery Shortcode'),
		'royal_galleries_shortcode' 	=> __('All Galleries Shortcode'),
		'date' 							=> __('Date')
	);

	return $columns;
}



// Royal Gallery Single Shortcode
add_shortcode( 'royalgallery', 'royal_gallery_single_shortcode' );
function royal_gallery_single_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
	), $atts));
	$output = '';

	global $post;
	$args = array( 'post_type' => 'royal_galleries', 'name' => $name );
	$gallery_posts = get_posts( $args );
	foreach ( $gallery_posts as $post ) : setup_postdata( $post );

		$gallery = get_post_meta( $post->ID, '_royal_gallery', true );
		$imgcount = count( $gallery );
		$maxcol = get_post_meta( $post->ID, '_royal_maxcol', true );		
		// Opening rpt-pricing-table container
		$thePostID = $post->ID;		
		$output .= '<div id="gal_id_'.$thePostID.'" class="royalgallery imgcount-'.$imgcount.'">';

		// Opening rpt-inner		
		$output .= '<div class="galinner maxcol-'.$maxcol.'">';
		$output .= '<ul>';
			// Loop through them and output an image
			foreach ( (array) $gallery as $attachment_id => $attachment_url ) {
				$galthumb = wp_get_attachment_image_url( $attachment_id, 'galleriesthumbnails' );
				$gal800 = wp_get_attachment_image_url( $attachment_id, 'galleries800x600' );
				$output .='<li><a href="'.$gal800.'"><img src="'.$galthumb.'" alt="" /></li></a>';
			}			
		$output .= '</ul>';
		// Closing ptp inner
		$output .= '</div>';

		// Closing ptp container
		$output .= '</div>';
		
		
		$bottomcolor 	= get_post_meta( $post->ID, '_rt_rpt_bottomcolor', true );
		$topcolor 		= get_post_meta( $post->ID, '_rt_rpt_topcolor', true );
		$tchover 		= get_post_meta( $post->ID, '_rt_rpt_topcolorhover', true );
		$gradientcolor1 = get_post_meta( $post->ID, '_rt_rpt_gradientcolor1', true );
		$gc1hover 		= get_post_meta( $post->ID, '_rt_rpt_gradientcolor1hover', true );
		$gradientcolor2 = get_post_meta( $post->ID, '_rt_rpt_gradientcolor2', true );
		$gc2hover 		= get_post_meta( $post->ID, '_rt_rpt_gradientcolor2hover', true );
		echo '<style type="text/css">
		.royalgallery{overflow:hidden;}
		.royalgallery .galinner{}
		.royalgallery .galinner ul{margin: 0!important; padding: 0!important; text-align: center;}
		.royalgallery .galinner ul li{
			list-style: none;
			display: inline-block;				
		}
		.royalgallery .galinner ul li a{}
		.royalgallery .galinner ul li a img{
			padding: 5px;
			margin: 5px;
			border: 1px solid #ddd;
			box-shadow: 3px 2px 5px #ddd;
			width: calc(100% - 22px);			
			
		}
		.royalgallery .maxcol-1 ul li{width: 100%;}
		.royalgallery .maxcol-2 ul li{width: 50%;}
		.royalgallery .maxcol-3 ul li{width: 33.333333333%;}
		.royalgallery .maxcol-4 ul li{width: 25%;}
		.royalgallery .maxcol-5 ul li{width: 20%;}
		.royalgallery .maxcol-6 ul li{width: 16.6666667%;}
		.royalgallery .maxcol-7 ul li{width: 14.2857143%;}
		.royalgallery .maxcol-8 ul li{width: 12.5%;}
		.royalgallery .maxcol-9 ul li{width: 11.1111111%;}
		.royalgallery .maxcol-10 ul li{width: 10%;}

		@media only screen and (max-width: 767px) {
		.royalgallery .maxcol-3 ul li,
		.royalgallery .maxcol-4 ul li{
			width: 50%;
		}
		
		.royalgallery .maxcol-5 ul li,
		.royalgallery .maxcol-6 ul li,
		.royalgallery .maxcol-7 ul li,
		.royalgallery .maxcol-8 ul li,
		.royalgallery .maxcol-9 ul li,
		.royalgallery .maxcol-10 ul li{
			width: 25%;
			}
		
		}
		
		@media only screen and (max-width: 599px) {
		.royalgallery .maxcol-1 ul li,
		.royalgallery .maxcol-2 ul li,
		.royalgallery .maxcol-3 ul li,
		.royalgallery .maxcol-4 ul li,
		.royalgallery .maxcol-5 ul li,
		.royalgallery .maxcol-6 ul li,
		.royalgallery .maxcol-7 ul li,
		.royalgallery .maxcol-8 ul li,
		.royalgallery .maxcol-9 ul li,
		.royalgallery .maxcol-10 ul li{width: 100%;}			
		}
		</style>';
	endforeach; wp_reset_postdata();
	return $output;
}





// Royal Gallery All Shortcode
add_shortcode( 'royalgalleries', 'royal_all_galleries_shortcode' );
function royal_all_galleries_shortcode( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' 		=> 'royal_galleries',
        'posts_per_page' 	=> -1,
        'order' 			=> 'DESC',
        'orderby' 			=> 'date',
    ) );
    if ( $query->have_posts() ) { ?>
        <ul class="allroyalgalleries">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <li id="post-<?php the_ID(); ?>" class="">
				<?php
				$group_files = get_post_meta( get_the_ID(), '_royal_gallery', 1 );
				$imgcount = count( $group_files );
				if ( $group_files ){
					$i = 0;
					$len = count($array);
					foreach ( (array) $group_files as $attachment_id => $attachement_url ) {
						$thumbnail = wp_get_attachment_image_url( $attachment_id, 'galleriesthumbnails' );
						if ($i == 0) { // First One
						echo '<a href="'.get_the_permalink().'"><img src="'.$thumbnail.'" alt=""></a>';
						} 
						else if ($i == $len - 1) {
							// last
						} 
						else {
							// Else
						}
					$i++;			
					}
				}
				echo '<p class="title">'.get_the_title().'</p>';
				echo '<p>'.$imgcount.' Photos</p>';
				?>   
            </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </ul>
		<style type="text/css">
		ul.allroyalgalleries{text-align: center;}
		ul.allroyalgalleries li{
			list-style: none;
			display: inline-block;
			}
		ul.allroyalgalleries li img{
			box-shadow: 2px 2px #ddd;
			padding: 5px;
			margin: 5px;
			background: #fff;
			border: 1px solid #ddd;
			border-radius: 100%;
			-moz-transition: all 0.3s;
			-webkit-transition: all 0.3s;
			transition: all 0.3s;	
		}
		ul.allroyalgalleries li img:hover{
			-moz-transform: scale(1.5);
			-webkit-transform: scale(1.5);
			transform: scale(1.5);
			z-index: 100;		
		}
		ul.allroyalgalleries li .title{
			font-size: 14px;
			font-weight: bold;	
			}
		</style>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}






add_action('wp_enqueue_scripts', 'custom_script_for_royal_galleries');
function custom_script_for_royal_galleries() {
wp_enqueue_script( 'jquery-magnific-popup-js', get_template_directory_uri() . '/includes/royal-gallery/magnific-popup/jquery.magnific-popup.min.js', true );
wp_enqueue_script( 'custom', get_template_directory_uri() . '/includes/royal-gallery/custom.js', true );
wp_enqueue_style( 'magnific-popup-css', get_template_directory_uri() . '/includes/royal-gallery/magnific-popup/magnific-popup.css', true );
}






?>