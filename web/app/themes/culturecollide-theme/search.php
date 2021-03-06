<?php get_template_part('templates/page', 'header'); ?>
<div class="container-fluid">
  <div class="row cc-row justify-content-center search-page__results">
    <div class="col-10">
      <?php if (!have_posts()) : ?>
        <div class="alert alert-warning">
          <?php _e('Sorry, no results were found.', 'sage'); ?>
        </div>
        <?php get_search_form(); ?>
      <?php endif; ?>

      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', 'search'); ?>
      <?php endwhile; ?>

      <?php the_posts_navigation(); ?>
    </div>
  </div>
</div>
