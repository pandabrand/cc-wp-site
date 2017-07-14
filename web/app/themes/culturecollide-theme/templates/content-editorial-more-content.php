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
    <?php get_template_part('layouts/card', 'card__3-1'); ?>
  <?php endwhile; ?>
</div>
<?php endif; ?>
<?php wp_reset_query(); ?>
