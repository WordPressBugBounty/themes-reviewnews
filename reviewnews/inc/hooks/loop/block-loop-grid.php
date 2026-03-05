<?php
if (!function_exists('reviewnews_loop_grid')) :
  /**
   * Banner Slider
   *
   * @since ReviewNews 1.0.0
   *
   */
  function reviewnews_loop_grid($reviewnews_post_id, $reviewnews_grid_design = 'grid-design-default', $reviewnews_thumbnail_size = 'medium_large', $reviewnews_show_excerpt = false, $archive_content_view = 'archive-content-excerpt', $reviewnews_title_position = 'bottom', $archive_title_tag = 'h3')
  {
    $reviewnews_post_display = 'spotlight-post';
    if ($reviewnews_thumbnail_size == 'medium') {
      $reviewnews_post_display = 'grid-post';
    }

    // Get the post thumbnail and check if it exists
    $reviewnews_post_thumbnail = reviewnews_the_post_thumbnail($reviewnews_thumbnail_size, $reviewnews_post_id, true);
    $reviewnews_no_thumbnail_class = "has-post-image";
    if (!isset($reviewnews_post_thumbnail) || empty($reviewnews_post_thumbnail)) {
      $reviewnews_no_thumbnail_class = "no-post-image";
    }
?>

    <div class="pos-rel read-single color-pad clearfix af-cat-widget-carousel <?php echo esc_attr($reviewnews_grid_design); ?> <?php echo esc_attr($reviewnews_no_thumbnail_class); ?>">
      <?php if ($reviewnews_title_position == 'top'): ?>
        <div class="read-title">
          <h3>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h3>
        </div>
        <div class="post-item-metadata entry-meta author-links">
          <?php reviewnews_post_item_meta($reviewnews_post_display); ?>
          <?php reviewnews_get_comments_views_share($reviewnews_post_id); ?>
        </div>
      <?php endif; ?>

      <div class="read-img pos-rel read-bg-img">
        <a class="aft-post-image-link" aria-label="<?php echo esc_attr(get_the_title($reviewnews_post_id, 'reviewnews')); ?>" href="<?php the_permalink(); ?>"></a>
        <?php
        if ($reviewnews_post_thumbnail) {
          echo wp_kses_post($reviewnews_post_thumbnail);
        }
        ?>
        <div class="post-format-and-min-read-wrap">
          <?php reviewnews_post_format($reviewnews_post_id); ?>
          <?php //reviewnews_count_content_words($reviewnews_post_id); ?>
        </div>

        <?php if ($reviewnews_grid_design == 'grid-design-default'): ?>
          <div class="category-min-read-wrap">
            <div class="read-categories categories-inside-image">
              <?php reviewnews_post_categories(); ?>
            </div>
          </div>
        <?php endif; ?>

      </div>

      <div class="pad read-details color-tp-pad">
        <?php if ($reviewnews_grid_design == 'grid-design-texts-over-image'): ?>
          <div class="read-categories categories-inside-image">
            <?php reviewnews_post_categories(); ?>
          </div>
        <?php endif; ?>

        <?php if ($reviewnews_title_position == 'bottom'): ?>
          <div class="read-title">
            <h3>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
          </div>
          <div class="post-item-metadata entry-meta author-links">
            <?php reviewnews_post_item_meta($reviewnews_post_display); ?>
            <?php reviewnews_get_comments_views_share($reviewnews_post_id); ?>
          </div>
        <?php endif; ?>

        <?php if ($reviewnews_show_excerpt == true): ?>
          <div class="post-description">
            <?php
            if ($archive_content_view == 'archive-content-full') {
              the_content();
            } else {
              echo wp_kses_post(reviewnews_get_the_excerpt($reviewnews_post_id));
            }
            ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

<?php
  }
endif;
add_action('reviewnews_action_loop_grid', 'reviewnews_loop_grid', 10, 8);
