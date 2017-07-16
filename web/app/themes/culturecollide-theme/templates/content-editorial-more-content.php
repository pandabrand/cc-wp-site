<?php
$args = array(
'posts_per_page' => 12,
'post_type' => 'post',
'orderby' => 'rand'
);
$more_query = new WP_Query($args);
if($more_query->have_posts()): $counter = 1; ?>
<div class="row cc-row editorial__block">
  <?php while($more_query->have_posts()): $more_query->the_post(); ?>
    <?php if($counter > 6) { $counter = 1; } ?>

    <?php if ($counter == 1) : ?>
      <div class="col-sm-12 col-md-4 push-md-8 col-lg-3 push-lg-9">
        <?php get_template_part('layouts/ad', 'block'); ?>
      </div>
    <?php elseif($counter == 2): ?>
      <div class="col-sm-6 col-md-8 pull-md-4 col-lg-6 pull-lg-3">
        <?php get_template_part('layouts/card', 'card__2-1'); ?>
      </div>
    <?php elseif($counter == 3): ?>
      <div class="col-sm-6 col-md-8 pull-md-4 col-lg-3 pull-lg-3">
        <?php get_template_part('layouts/card', 'card__1-1'); ?>
      </div>
    <?php else: ?>
      <div class="col-4">
        <?php get_template_part('layouts/card', 'card__3-1'); ?>
      </div>
  <?php endif; ?>
  <?php $counter++; endwhile; ?>
</div>
<?php endif; ?>
<?php wp_reset_query(); ?>
