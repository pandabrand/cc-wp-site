<?php
$args = array(
    'posts_per_page' => 4,
    'post_type' => ['post'],
  );
  $the_query = new WP_Query($args);
?>
<?php if($the_query->have_posts()): ?>
<?php while($the_query->have_posts()): $the_query->the_post(); ?>
<?php switch ($the_query->current_post):
case 0: ?>
<div class="row cc-row feature-block_color feature-block home">
<div class="col-md-6">
<?php include( locate_template('layouts/feature-block__1-2.php')); ?>
</div>
<?php
break;
case 1:
?>
<div class="col-md-6 col-lg-3">
<?php include( locate_template('layouts/feature-block__1-4-tall.php')); ?>
<div class="hidden-md-up w-100"></div>
</div>
<div class="col-md-12 col-lg-3 last-child">
<?php
break;
case 2:
?>
<?php include( locate_template('layouts/feature-block__square.php')); ?>
<?php
break;
case 3:
?>
<?php include( locate_template('layouts/feature-block__square.php')); ?>
</div>
</div>
<?php break ;?>
<?php endswitch; ?>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
