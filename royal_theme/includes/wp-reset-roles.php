<?php
/*
 * example usage: $results = reset_role_WPSE_82378( 'subscriber' );
 * per add_role() (WordPress Codex), $results "Returns a WP_Role object
 * on success, null if that role already exists."
 *
 * possible $role values:
 * 'administrator'
 * 'editor'
 * 'author'
 * 'contributor'
 * 'subscriber'
 
 Uses : reset_role_akrr('editor');
 */
function reset_role_akrr( $role ) {
	$default_roles = array(
		'administrator' => array(
			'switch_themes' => 1,
			'edit_themes' => 1,
			'activate_plugins' => 1,
			'edit_plugins' => 1,
			'edit_users' => 1,
			'edit_files' => 1,
			'manage_options' => 1,
			'moderate_comments' => 1,
			'manage_categories' => 1,
			'manage_links' => 1,
			'upload_files' => 1,
			'import' => 1,
			'unfiltered_html' => 1,
			'edit_posts' => 1,
			'edit_others_posts' => 1,
			'edit_published_posts' => 1,
			'publish_posts' => 1,
			'edit_pages' => 1,
			'read' => 1,
			'level_10' => 1,
			'level_9' => 1,
			'level_8' => 1,
			'level_7' => 1,
			'level_6' => 1,
			'level_5' => 1,
			'level_4' => 1,
			'level_3' => 1,
			'level_2' => 1,
			'level_1' => 1,
			'level_0' => 1,
			'edit_others_pages' => 1,
			'edit_published_pages' => 1,
			'publish_pages' => 1,
			'delete_pages' => 1,
			'delete_others_pages' => 1,
			'delete_published_pages' => 1,
			'delete_posts' => 1,
			'delete_others_posts' => 1,
			'delete_published_posts' => 1,
			'delete_private_posts' => 1,
			'edit_private_posts' => 1,
			'read_private_posts' => 1,
			'delete_private_pages' => 1,
			'edit_private_pages' => 1,
			'read_private_pages' => 1,
			'delete_users' => 1,
			'create_users' => 1,
			'unfiltered_upload' => 1,
			'edit_dashboard' => 1,
			'update_plugins' => 1,
			'delete_plugins' => 1,
			'install_plugins' => 1,
			'update_themes' => 1,
			'install_themes' => 1,
			'update_core' => 1,
			'list_users' => 1,
			'remove_users' => 1,
			'add_users' => 1,
			'promote_users' => 1,
			'edit_theme_options' => 1,
			'delete_themes' => 1,
			'export' => 1,
		),
		'editor' => array(
			'moderate_comments' => 1,
			'manage_categories' => 1,
			'manage_links' => 1,
			'upload_files' => 1,
			'unfiltered_html' => 1,
			'edit_posts' => 1,
			'edit_others_posts' => 1,
			'edit_published_posts' => 1,
			'publish_posts' => 1,
			'edit_pages' => 1,
			'read' => 1,
			'level_7' => 1,
			'level_6' => 1,
			'level_5' => 1,
			'level_4' => 1,
			'level_3' => 1,
			'level_2' => 1,
			'level_1' => 1,
			'level_0' => 1,
			'edit_others_pages' => 1,
			'edit_published_pages' => 1,
			'publish_pages' => 1,
			'delete_pages' => 1,
			'delete_others_pages' => 1,
			'delete_published_pages' => 1,
			'delete_posts' => 1,
			'delete_others_posts' => 1,
			'delete_published_posts' => 1,
			'delete_private_posts' => 1,
			'edit_private_posts' => 1,
			'read_private_posts' => 1,
			'delete_private_pages' => 1,
			'edit_private_pages' => 1,
			'read_private_pages' => 1,
		),
		'author' => array(
			'upload_files' => 1,
			'edit_posts' => 1,
			'edit_published_posts' => 1,
			'publish_posts' => 1,
			'read' => 1,
			'level_2' => 1,
			'level_1' => 1,
			'level_0' => 1,
			'delete_posts' => 1,
			'delete_published_posts' => 1,
		),
		'contributor' => array(
			'edit_posts' => 1,
			'read' => 1,
			'level_1' => 1,
			'level_0' => 1,
			'delete_posts' => 1,
		),
		'subscriber' => array(
			'read' => 1,
			'level_0' => 1,
		),
		'display_name' => array(
			'administrator' => 'Administrator',
			'editor'		=> 'Editor',
			'author'		=> 'Author',
			'contributor'   => 'Contributor',
			'subscriber'	=> 'Subscriber',
		),
	);
	$role = strtolower( $role );
	remove_role( $role );
	return add_role( $role, $default_roles['display_name'][$role], $default_roles[$role] );
} // function reset_role_akrr