<div class="row cc-row travel travel-feature">
  <?php
    $args = array(
      "post_type" => ["artist","city"],
      "numberposts" => 2,
      "order" => "rand"
    );
    $feature_posts = get_posts($args);
    if( !empty( $feature_posts ) ):
      foreach( $feature_posts as $post ): setup_postdata( $post );
  ?>
  <div class="col-6">
    <?php get_template_part('layouts/travel', 'feature-block__1-2'); ?>
  </div>
  <?php
      endforeach;
      wp_reset_postdata();
    endif;
  ?>
</div>
