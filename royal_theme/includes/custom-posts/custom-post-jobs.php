<?php

// register custom post type to work with
add_action( 'init', 'royal_create_jobs_post_type' );

function royal_create_jobs_post_type() {

    $labels = array( 
        'name' => _x( 'Jobs', 'job' ),
        'singular_name' => _x( 'job', 'job' ),
        'add_new' => _x( 'Add New Job', 'job' ),
        'add_new_item' => _x( 'Add New job', 'job' ),
        'edit_item' => _x( 'Edit job', 'job' ),
        'new_item' => _x( 'New job', 'job' ),
        'view_item' => _x( 'View job', 'job' ),
        'search_items' => _x( 'Search jobs', 'job' ),
        'not_found' => _x( 'No jobs found', 'job' ),
        'not_found_in_trash' => _x( 'No jobs found in Trash', 'job' ),
        'parent_item_colon' => _x( 'Parent job:', 'job' ),
        'menu_name' => _x( 'Jobs', 'job' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'hierarchical' => false,
        'rewrite' => false,
		'has_archive' => true,
		'menu_position' => 2,		
		'menu_icon' => 'dashicons-images-alt2',		
		'supports' => array( 'title', 'thumbnail'),		
		'exclude_from_search' => false,
        'can_export' => true,

        // map_meta_cap will allow us to remap the existing capabilities with new capabilities to match the new custom post type
        'map_meta_cap' => true,
        // capabilities are what we are customising so lets remap them
        'capabilities' => array(
            'edit_post' => 'edit_job',
            'edit_posts' => 'edit_jobs',
            'edit_others_posts' => 'edit_other_jobs',
            'publish_posts' => 'publish_jobs',
            'edit_publish_posts' => 'edit_publish_jobs',
            'read_post' => 'read_jobs',
            'read_private_posts' => 'read_private_jobs',
            'delete_post' => 'delete_job'
        ),
        // capability_type defines how to make words plural, by default the
        // second word has an 's' added to it and for 'job' that's fine
        // however when it comes to words like gallery the plural would become
        // galleries so it's worth adding your own regardless of the plural.
        'capability_type' => array('job', 'jobs'),
    );
    register_post_type( 'jobs', $args );
}


function manage_job_capabilities() {
    // gets the role to add capabilities to
    $admin = get_role( 'administrator' );
    $editor = get_role( 'editor' );
    $author = get_role( 'author' );
	// replicate all the remapped capabilites from the custom post type job
    $caps = array(
    	'edit_job',
    	'edit_jobs',
    	'edit_other_jobs',
    	'publish_jobs',
    	'edit_published_jobs',
    	'read_jobs',
    	'read_private_jobs',
    	'delete_job'
    );
    // give all the capabilities to the administrator
    foreach ($caps as $cap) {
	    $admin->add_cap( $cap );
    }

    foreach ($caps as $cap) {
	    $author->remove_cap( $cap );
    }	

    // limited the capabilities to the editor or a custom role 
	
    $editor->add_cap( 'edit_job' );
    $editor->add_cap( 'edit_jobs' );
    $editor->add_cap( 'read_jobs' );

}
add_action( 'admin_init', 'manage_job_capabilities');

// custom Type Post============================================================



?>