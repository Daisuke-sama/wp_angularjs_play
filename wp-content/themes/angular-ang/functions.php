<?php

function set_scripts() {

	wp_enqueue_style( 'bootstrapCSS', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css', [], '1.0', 'all' );
	wp_enqueue_script( 'angular-core', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js', [ 'jquery' ], '1.0', false );
	wp_enqueue_script( 'angular-resource', '//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-resource.js', [ 'angular-core' ], '1.0', false );
	wp_enqueue_script( 'ui-router', 'https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.15/angular-ui-router.min.js', [ 'angular-core' ], '1.0', false );
	wp_enqueue_script( 'ngScripts', get_template_directory_uri() . '/assets/js/angular-theme.js', [ 'ui-router' ], '1.0', false );
	wp_localize_script( 'ngScripts', 'appInfo',
		[

			'api_url'            => rest_get_url_prefix() . '/wp/v2/',
			'template_directory' => get_template_directory_uri() . '/',
			'nonce'              => wp_create_nonce( 'wp_rest' ),
			'is_admin'           => current_user_can( 'administrator' )

		]
	);

}

add_action( 'wp_enqueue_scripts', 'set_scripts' );

function register_new_api_field() {
	register_rest_field( 'post',
		'a_new_one_field',
		[ 'get_callback' => 'new_one_field_func', ]
	);
}

function new_one_field_func( $object, $field_name, $request ) {
	return "(custom field) the date " . date('Y-m-d H:i:s', $object['date']);
}

add_action( 'rest_api_init', 'register_new_api_field' );


