<?php

/* This code for Login Logo */
function royaltech_custom_login_logo() {
    echo '<style type="text/css">
        #login h1 
		{
		background-image:url('.get_bloginfo('template_directory').'/images/logo.png); 
		background-position: center center;
		background-repeat: no-repeat;
		background-size: 95% 95%;
		}
		
		.login h1 a
		{
		background-image:url('. ot_get_option("login_logo") .'); 
		margin-bottom: 5px;
		background-size: 100% auto;
		border: 3px solid #FFF;
		box-shadow: 0 0 9px 6px;
		padding-bottom: 60px;
		width: auto; 
		height: auto;		
		}
		
		body.login 
		{
		background-image:url('. ot_get_option("login_bg") .');
		background-size: 100% auto;
		background-repeat: no-repeat;
		}
    </style>';
}
add_action('login_head', 'royaltech_custom_login_logo');


/* This code for Login URL */
function my_custom_login_url() {
return site_url();
}
add_filter( 'login_headerurl', 'my_custom_login_url', 10, 4 );


/* This code for Login Title Text */
function login_header_title()
{
return get_bloginfo('name');
}
add_filter('login_headertitle','login_header_title');


/* Admin Area Favicon */
function royal_admin_area_favicon() {
$favicon_url = get_bloginfo('template_directory'). '/favicon.ico';
echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
}
add_action('admin_head', 'royal_admin_area_favicon');




/* Dashboard- Remove the dashboard widgets */
function remove_dashboard_widgets(){
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal'); //Activity since 3.8
    // remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins	
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News	
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


// Move the 'Right Now' dashboard widget to the right hand side
function rt_move_dashboard_widget() {
    $user = wp_get_current_user();
    if ( ! $user->has_cap( 'manage_options' ) ) {
        global $wp_meta_boxes;
        $widget = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
        unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
        $wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now'] = $widget;
    }
}
add_action( 'wp_dashboard_setup', 'rt_move_dashboard_widget' );


// Add New Dashboard Widgets
function rt_add_dashboard_widgets() {
    wp_add_dashboard_widget( 'rt_dashboard_welcome', 'Welcome to Royal Technologies', 'rt_add_welcome_widget' );
    wp_add_dashboard_widget( 'rt_dashboard_links', 'Useful Links', 'rt_add_links_widget' );
}

// Welcome Widget
function rt_add_welcome_widget(){ ?>
 <div style="overflow:hidden;">
	<div style="float:left; margin-right: 10px;">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- 250 X 250 Text & Image -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:250px;height:250px"
			 data-ad-client="ca-pub-9225233207220165"
			 data-ad-slot="2391028868"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>

	<div style="float:left;">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- 250 X 250 Image -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:250px;height:250px"
			 data-ad-client="ca-pub-9225233207220165"
			 data-ad-slot="0822180284"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
 </div>
<?php }
 
// Useful Link Widget
function rt_add_links_widget() { ?>
     Some links to resources which will help you manage your site:
	 <div>
		 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- 468 X 60 Text Ads -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:468px;height:60px"
			 data-ad-client="ca-pub-9225233207220165"
			 data-ad-slot="9914295665"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	 </div>	 
    <ul>
		<a href="http://royaltechbd.com" target="_blank"><li>Royal Technologies</li></a>
		<a href="http://shamokaldarpon.com" target="_blank"><li>Shamokal Darpon</li></a>
    </ul>
<?php }

add_action( 'wp_dashboard_setup', 'rt_add_dashboard_widgets' );








/*Edit Right Now*/
//Remove Version
add_filter('gettext', 'remove_admin_stuff', 20, 3);
function remove_admin_stuff( $translated_text, $untranslated_text, $domain ) {
    $custom_field_text = 'You are using <span class="b">WordPress %s</span>.';
    if ( is_admin() && $untranslated_text === $custom_field_text ) {
        return '';
    }
    return $translated_text;
}


//Remove Theme Name
add_filter( 'ngettext', 'wps_remove_theme_name' );
if(!function_exists('wps_remove_theme_name')) {
function wps_remove_theme_name($translated) {
     $translated = str_ireplace('Theme <span class="b">%1$s</span> with',  '',  $translated );
     return $translated;
  }
}






/* Remove menu items from WordPress admin bar */	
function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );





/* Remove Dashboard WP Version */
function change_footer_version() {return ' ';}
add_filter( 'update_footer', 'change_footer_version', 9999);





/* Rename Howdy*/
function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
$user_id = get_current_user_id();
$current_user = wp_get_current_user();
$profile_url = get_edit_profile_url( $user_id );

if ( 0 != $user_id ) {
/* Add the "My Account" menu */
$avatar = get_avatar( $user_id, 28 );
$howdy = sprintf( __('Welcome, %1$s'), $current_user->display_name );
$class = empty( $avatar ) ? '' : 'with-avatar';

$wp_admin_bar->add_menu( array(
'id' => 'my-account',
'parent' => 'top-secondary',
'title' => $howdy . $avatar,
'href' => $profile_url,
'meta' => array(
'class' => $class,
),
) );

}
}
add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );





/*Remove Help*/
function hide_help() {
    echo '<style type="text/css">
           #contextual-help-link-wrap { display: none !important; }
         </style>';
}
add_action('admin_head', 'hide_help');




/*Welcome Panel*/
function welcome_panel() {
    echo '<style type="text/css">
           #welcome-panel { display: none !important; }
         </style>';
}
add_action('admin_head', 'welcome_panel');




/* Automatically create meta description from the_content FOR SEO Purpose*/
function create_meta_desc() {  
    global $post;  
    if (!is_single()) { return; }  
    $meta = strip_tags($post->post_content);  
    $meta = strip_shortcodes($post->post_content);  
    $meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);  
    $meta = substr($meta, 0, 125);  
    echo "<meta name='description' content='$meta' />";  
}  
add_action('wp_head', 'create_meta_desc');



remove_action('wp_head', 'wp_generator');

?>