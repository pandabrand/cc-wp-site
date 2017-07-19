<?php

function load_map_data() {
  global $post;
  $json_locations = array('locations' => array());
    if( get_post_type($post->ID) == 'artist' ) {
      if( have_rows( 'artists_locations', $post->ID ) ) {
        while( have_rows( 'artists_locations', $post->ID ) ): the_row();
          $location = get_sub_field('location')[0];
          $location_output = array(
            'location_id' => $location->ID,
            'title' => get_the_title($location->ID),
            'website' => get_field('website', $location->ID),
            'coords' => get_field('address', $location->ID)
          );
          $json_locations['locations'][] = $location_output;
        endwhile;
      }
      $related_city = get_field('artist_city', $post->ID)[0];
      $city = array(
        'title' => get_the_title($related_city->ID),
        'location' => get_field('city_location', $related_city->ID)
      );
      $map_info = array(
        'api_key' => MAPBOX_API,
      );
      $json_locations['city'] = $city;
      $json_locations['map_info'] = $map_info;
    } elseif ( get_post_type() == 'city' ) {
      $locations = get_field('locations');
    }
    $js_data = json_encode($json_locations);
    wp_register_script('map_js', get_template_directory_uri() . '/dist/scripts/map_data.js', array(), null, true);
    wp_localize_script( 'map_js', 'map_vars', $js_data );
    wp_enqueue_script('map_js');
}
add_action('wp_enqueue_scripts', 'load_map_data');
