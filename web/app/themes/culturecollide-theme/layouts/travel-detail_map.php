<?php
$current_post = $post;
?>
<div class="row cc-row travel travel__detail__map__row">
  <div class="col-6 push-6">
    <?php get_template_part('layouts/travel', 'map_block'); ?>
  </div>
  <div class="col-6 pull-6 travel__detail__map__list">
    <?php
      $locations = get_field('artists_locations', $current_post);
      if( !empty( $locations ) ):
        foreach( $locations as $location_arr ):
          $location = $location_arr['location'][0];
          include( locate_template( 'layouts/travel-location_block.php', false, false ) );
        endforeach;
      endif;
    ?>
  </div>
</div>
