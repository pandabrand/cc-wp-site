<div class="row travel__detail__map__item <?php $location->ID; ?>" id="<?php echo $location->ID; ?>">
  <div class="col-12">
    <div class="card card__2-1">

        <a href="<?php echo the_permalink($location->ID);?>" class="block__link">
          <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $location->ID ), 'large-feature' ); ?>
          <div class="card__image"  style="background-image:url('<?php echo esc_url( $large_image_url[0] ); ?>')">
            <div class="card__category-block">
              <div class="<?php echo get_post_icon_class($location); ?>"></div>
              <div class="card__category-block__category-details">
                <div class="card__category-block__category-type">
                  <?php echo get_category_type_title($location);?>
                </div>
                <div class="card__category-block__category-info">
                  <?php echo get_category_type_subject($location); ?>
                </div>
              </div>
            </div>
            <div class="card__category-line"></div>
            <div class="card__filter"></div>
            <div class="card__body">
              <div class="card__copy">
                <div class="card__title">
                  <?php echo get_card_title($location); ?>
                </div>
                <div class="card__text">
                  <?php echo $location->post_content; ?>
                </div>
              </div>
            </div>
          </div>
        </a>

    </div>
  </div>
</div>
