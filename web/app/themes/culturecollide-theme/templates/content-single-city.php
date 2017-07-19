<?php get_template_part('templates/content', 'travel_header'); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('layouts/travel', 'detail_header'); ?>
          <div class="row">
            <div class="editorial__detail__article__copy col-8 offset-2">
              <?php the_content(); ?>
              <h1>yeah artist  dawg</h1>
            </div>
          </div>
<?php endwhile; ?>
