<?php

// Remove Role
remove_role( 'subscriber' );
remove_role( 'editor' );
remove_role( 'contributor' );
remove_role( 'author' );

//OR
//check if role exist before removing it
if( get_role('subscriber') ){
      remove_role( 'subscriber' );
}

//check if role exist before removing it
if( get_role('contributor') ){
      remove_role( 'contributor' );
}

//check if role exist before removing it
if( get_role('editor') ){
      remove_role( 'editor' );
}

//check if role exist before removing it
if( get_role('author') ){
      remove_role( 'author' );
}




// Creating User Roles
// add_role( $role, $display_name, $capabilities );
add_role('subscriberplus', __('Subscriber+'),
    array(
		'read' => 1,
		'level_0' => 1,
		'read_private_pages'	=> 1,
		
        )
);




