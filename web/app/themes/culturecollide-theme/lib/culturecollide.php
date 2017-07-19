<?php
if( ! function_exists('add_classes_on_li') ):
  function add_classes_on_li($classes, $item, $args) {
    if($args->menu_id == 'header-menu'):
      $classes = array('nav-item navigation__item navigation__item__header navbar_navigation__item__header');
    endif;
    if($args->menu_id == 'footer-menu-one' || $args->menu_id == 'footer-menu-two'):
      $classes = array('nav-item navigation__item navigation__item__footer');
    endif;
    return $classes;
  }
endif;
add_filter('nav_menu_css_class','add_classes_on_li',1,3);

if( ! function_exists('add_menuclass') ):
  function add_menuclass($ulclass) {
     return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
  }
endif;
add_filter('wp_nav_menu','add_menuclass');

function get_post_icon_class($post = null) {
  if ( empty( $post )  ) {
    global $post;
  } else {
    $post = get_post($post);
  }

  $icon_class;
  if($post->post_type == 'artist' || $post->post_type == 'city') {
    $icon_class = 'icon icon-travel-white';
  } else {
    $post_categories = wp_get_post_categories( $post->ID );
    if( !empty ( $post_categories ) ) {
      $category = get_category($post_categories[0]);
      $icon_class = 'icon icon-'.$category->slug.'-white';
    } else {
      $icon_class = 'icon icon-travel-white';
    }
  }
  return $icon_class;
}

function get_category_type_title($post = null) {
  if ( empty( $post )  ) {
    global $post;
  } else {
    $post = get_post($post);
  }

  $category_type;
  if($post->post_type == 'artist' || $post->post_type == 'city') {
    $category_type = 'travel guide';
  } elseif ($post->post_type == 'location') {
    $location_terms = get_the_terms( $post, 'location_types' );
    $category_type = (!empty($location_terms)) ? $location_terms[0]->name : '';
  } else {
    $post_categories = wp_get_post_categories( $post->ID );
    $category = get_category($post_categories[0]);
    if($category->slug == 'uncategorized') {
      $category_type = 'editorial';
    } else {
      $category_type = $category->slug;
    }
  }
  return $category_type;
}

function get_category_type_subject($post = null) {
  if ( empty( $post )  ) {
    global $post;
  } else {
    $post = get_post($post);
  }

  $subject = '';
  if($post->post_type == 'artist' || $post->post_type == 'city') {
    $subject = $post->post_title;
  } else {
    $tag_terms = wp_get_post_terms($post->ID);
    if(!empty($tag_terms)) {
      $first_term = $tag_terms[0];
      $subject = $first_term->name;
    }
  }
  return $subject;
}

function get_card_title($post = null) {
  if ( empty( $post )  ) {
    global $post;
  } else {
    $post = get_post($post);
  }

  $title = '';
  if( $post->post_type == 'post' ) {
    $title = $post->post_title;
  } else {
    $title = get_field( 'excerpt_title', $post->ID );
  }

  if ( empty ( $title ) ) {
    $title = get_the_title( $post );
  }
  return $title;
}

function get_card_excerpt($post = null, $length = '60') {
  if ( empty( $post )  ) {
    global $post;
  } else {
    $post = get_post($post);
  }

  $excerpt = get_the_excerpt();
  $line=$excerpt;
  if (preg_match('/^.{1,'.$length.'}\b/s', $excerpt, $match)) {
      $line=$match[0];
  }
  return strip_tags($line.'...');
}

function get_social_links($post = null) {
  if( empty( $post ) ) {
    global $post;
  } else {
    $post = get_post($post);
  }

  $shares = [];
  //facebook share url
  $shares['facebook'] = get_the_permalink();
  $shares['twitter'] = 'https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&url='.urlencode(get_the_permalink());
  $shares['tumblr'] = 'http://www.tumblr.com/widgets/share/tool?canonicalUrl='.urlencode(get_the_permalink());

  return $shares;
}

function add_billboard_class() {
  $billboard_class = 'billboard';
  if(get_field('show_alternate_editorial_layout')) {
    $billboard_class = 'billboard-two';
  }
 echo $billboard_class;
}

function debug_var($var) {
  $var_dump = '';
   if(isset($var)) {
      $var_dump .= "<pre>";
      $var_dump .= var_dump($var);
      $var_dump .= "</pre>";
   } else {
      $var_dump .= "Variable doesn't exist!";
   }
   return $var_dump;
}
