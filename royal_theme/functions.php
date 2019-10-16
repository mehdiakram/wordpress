<?php 
ob_start();
/* Royal Technologies Theme */

// Enable shortcode output in widgets
// Enable for widget title
add_filter('widget_title', 'do_shortcode');
// Enable for widget text
add_filter('widget_text', 'do_shortcode');



/* TGM Plugin Activation */
require_once ('includes/class-tgm-plugin-activation.php');
require_once ('includes/royaltech-plugin-activation.php');



/* Includes */
require_once ('includes/royal-tech-branding.php');



/* Option Tree Settings */
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
include_once( 'option-tree/ot-loader.php' );
include_once( 'includes/theme-options.php' );




/* This code for Featured Image Support */
add_theme_support( 'post-thumbnails', array( 'post', 'teacher') );
set_post_thumbnail_size( 200, 200, true );
add_image_size( 'post-image', 150, 150, true ); 
add_image_size( 'teacher-photo', 150, 170, true ); 




/* Adding Latest jQuery from Wordpress */
function royaltech_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'royaltech_latest_jquery');
		
	
	
	
/* Add Font Awesome Style */
add_action('admin_enqueue_scripts', 'font_awesome_style' );
add_action('init', 'font_awesome_style');
add_action('wp_enqueue_scripts', 'font_awesome_style');
add_action('admin_head','font_awesome_style');
add_action('wp_head','font_awesome_style');
add_action('admin_init','font_awesome_style');
function font_awesome_style() {
  wp_register_style( 'font-awesome-style', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
  wp_enqueue_style('font-awesome-style');

}
/* Add Font Awesome End */


/* Include into head the dynamic.php */
function royal_dynamic() { 
	include_once( 'includes/dynamic.php' );
}
add_action( 'wp_head', 'royal_dynamic' );




/* Menu Start */
function wpj_register_menu() {
    if (function_exists('register_nav_menu')) {
		register_nav_menu( 'mainmenu', __( 'Main Menu') );
        register_nav_menu( 'topmenu', __( 'Top Menu') );
    }
}
add_action('init', 'wpj_register_menu');
/* Menu End */




/* Widgets Start */ 
function royaltech_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Left Widget Area', 'royaltech' ),
		'id' => 'left-widget-area',
		'description' => __( 'The Left widget area', 'royaltech' ),
		'before_widget' => '<div class="widget-box">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Home Widget Area', 'royaltech' ),
		'id' => 'home-widget-area',
		'description' => __( 'The Home widget area', 'royaltech' ),
		'before_widget' => '<div class="image-box">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'royaltech_widgets_init' );
/* Widgets End */ 




/* Dynamic Excerpt Start */
function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }
/* Dynamic Excerpt End */




/* Dynamic Copyright Date Start */	
function royaltechbd_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "&copy; " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}
/* Dynamic Copyright Date End */	

	
	
	
/* Royal pagination Start */
function rt_pagination() {
	global $wp_query;
	echo paginate_links(array('total' => $wp_query -> max_num_pages, 'current' => get_query_var('paged'), 'show_all' => TRUE, 'prev_next' => FALSE, 'type' => 'array', 'base' => @add_query_arg('paged','%#%'), 'format' => '?paged=%#%', 'type' => 'plain'));
}

function rt_next_posts_link() {
	global $paged, $wp_query;
	$max_page = $wp_query -> max_num_pages;
	if (!$paged) {
		$paged = 1;
	}
	$nextpage = intval($paged) + 1;
	$label = __('Next Page &raquo;', 'rt');
	$attr = apply_filters('next_posts_link_attributes', '');
	if (!is_single()) {
		if ($nextpage <= $max_page) {
			echo '<a href="' . next_posts($max_page, false) . "\" $attr>" . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) . '</a>';
		}
		else {
			echo '<span ' . $attr . '>' . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) . '</span>';
		}
	}
}
function rt_previous_posts_link() {
	global $paged;
	$label = __('&laquo; Previous Page', 'rt');
	if (!is_single()) {
		if ($paged > 1) {
			$attr = apply_filters('previous_posts_link_attributes', '');
			echo '<a href="' . previous_posts(false) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) . '</a>';
		}
		else {
			echo '<span>' . preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) . '</span>';
		}
	}
	
}
/* Royal pagination End */













?>