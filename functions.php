<?php 

/**
 * Accept the post request from another site to autoregister a user
 *
 * @return void
 */
function wpc_register_user_from_endpoint(){

    register_rest_route( 'wp/v2', '/user', array(
        'methods' => \WP_REST_Server::CREATABLE,
        'callback' => 'wpc_register',
    ));
}
add_action( 'rest_api_init', 'wpc_register_user_from_endpoint' );

/**
 * 
 * Register the user with detail we have from post request
 * @param [type] $data
 * @return void
 */
function wpc_register($data){
	$userdata = array(
		'user_login' => $data['username'],
		'user_email' => $data['email'],
		'user_pass' => $data['password'],
		'role' => $data['roles'],
	);

	$user_id = wp_insert_user( $userdata );
	echo json_encode(['id'=>$user_id,  'message' => 'Created']);
}