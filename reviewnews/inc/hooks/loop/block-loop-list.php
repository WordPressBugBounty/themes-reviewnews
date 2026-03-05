<?php
if (!function_exists('reviewnews_loop_list')) :
  /**
   * Post List Display
   *
   * @since ReviewNews 1.0.0
   */
  function reviewnews_loop_list($reviewnews_post_id, $reviewnews_thumbnail_size = 'thumbnail', $reviewnews_count = 0, $show_cat = false, $show_meta = true, $show_excerpt = false, $big_img = false, $archive_content_view = 'archive-content-excerpt')
  {
    $reviewnews_post_display = 'list-post';
    if ($big_img) {
      $reviewnews_post_display = 'spotlight-post';
    }

    // Get the post thumbnail and check if it exists
    $reviewnews_post_thumbnail = reviewnews_the_post_thumbnail($reviewnews_thumbnail_size, $reviewnews_post_id, true);
    $reviewnews_no_thumbnail_class = "has-post-image";
    if (!isset($reviewnews_post_thumbnail) || empty($reviewnews_post_thumbnail)) {
      $reviewnews_no_thumbnail_class = "no-post-image";
    }

?>
    <div class="af-double-column list-style clearfix aft-list-show-image <?php echo esc_attr($reviewnews_no_thumbnail_class); ?>">
      <div class="read-single color-pad">
        <div class="col-3 float-l pos-rel read-img read-bg-img">
          <a class="aft-post-image-link"
            href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <?php
          // Display the post thumbnail if available
          if ($reviewnews_post_thumbnail) {
            echo wp_kses_post($reviewnews_post_thumbnail);
          }
          ?>
          <?php if (absint($reviewnews_count) > 0): ?>
            <span class="trending-no"><?php echo esc_html($reviewnews_count); ?></span>
          <?php endif; ?>
          <?php if ($big_img != false): ?>
            <div class="category-min-read-wrap af-cat-widget-carousel">
              <div class="post-format-and-min-read-wrap">
                <?php reviewnews_post_format($reviewnews_post_id); ?>
                <?php //reviewnews_count_content_words($reviewnews_post_id); ?>
              </div>
              <div class="read-categories categories-inside-image">
                <?php reviewnews_post_categories(); ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <div class="col-66 float-l pad read-details color-tp-pad">
          <?php if ($big_img == false): ?>
            <?php if ($show_cat != false): ?>
              <div class="read-categories">
                <?php reviewnews_post_categories(); ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <div class="read-title">
            <h3>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
          </div>
          <?php if ($show_meta != false): ?>
            <div class="post-item-metadata entry-meta author-links">
              <?php reviewnews_post_item_meta($reviewnews_post_display); ?>
              <?php reviewnews_get_comments_views_share($reviewnews_post_id); ?>
            </div>
          <?php endif; ?>

          <?php if ($show_excerpt != false):   ?>
            <div class="read-descprition full-item-discription">
              <div class="post-description">
                <?php
                if ($archive_content_view == 'archive-content-full') {
                  the_content();
                } else {
                  echo wp_kses_post(reviewnews_get_the_excerpt($reviewnews_post_id));
                }
                ?>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

<?php
  }
endif;
add_action('reviewnews_action_loop_list', 'reviewnews_loop_list', 10, 8);
?>