<?php

function enqueue_scripts_styles_init() {
  if( is_post_type_archive( ['city', 'artist'] ) || is_single( ['city', 'artist'] ) || is_tax( 'location_types' ) ):
    $args = array(
      "post_type" => "city",
      "numberposts" => -1,
    );
    $cities = get_posts( $args );
    $map_info = array( 'cities' => array( ) );
    foreach($cities as $city) {
      $city_output = array(
        'city_id' => $city->ID,
        'title' => get_the_title($city->ID),
        'link' => get_the_permalink($city->ID),
        'location' => get_field('city_location', $city->ID)
      );
      $map_info['cities'][] = $city_output;
    }

  	wp_register_script( 'ajax-script', get_stylesheet_directory_uri().'/dist/scripts/locate_user.js', array('jquery'), null, true ); // jQuery will be included automatically
    wp_localize_script( 'ajax-script', 'map_info', $map_info );
    wp_enqueue_script('ajax-script');

  	// get_template_directory_uri() . '/js/script.js'; // Inside a parent theme
  	// get_stylesheet_directory_uri() . '/js/script.js'; // Inside a child theme
  	// plugins_url( '/js/script.js', __FILE__ ); // Inside a plugin
  	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); // setting ajaxurl
  endif;
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
