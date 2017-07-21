<?php

function enqueue_scripts_styles_init() {

	wp_register_script( 'ajax-script', get_stylesheet_directory_uri().'/dist/scripts/locate_user.js', array('jquery'), null, true ); // jQuery will be included automatically
  // wp_localize_script( 'ajax-script', 'map_info', $map_info );
  wp_enqueue_script('ajax-script');

	// get_template_directory_uri() . '/js/script.js'; // Inside a parent theme
	// get_stylesheet_directory_uri() . '/js/script.js'; // Inside a child theme
	// plugins_url( '/js/script.js', __FILE__ ); // Inside a plugin
	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); // setting ajaxurl
}
add_action('init', 'enqueue_scripts_styles_init');

function ajax_action_stuff() {
	$post_id = $_POST['post_id']; // getting variables from ajax post
	// doing ajax stuff
	update_post_meta($post_id, 'post_key', 'meta_value');
	echo 'ajax submitted';
	die(); // stop executing script
}
add_action( 'wp_ajax_ajax_action', 'ajax_action_stuff' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_ajax_action', 'ajax_action_stuff' ); // ajax for not logged in users
