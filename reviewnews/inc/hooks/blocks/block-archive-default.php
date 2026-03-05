<?php

/**
 * Full block part for displaying page content in page.php
 *
 * @package ReviewNews
 */

global $post;
$reviewnews_img_url = reviewnews_get_freatured_image_url($post->ID, 'large');
$reviewnews_img_thumb_id = get_post_thumbnail_id($post->ID);
$reviewnews_show_excerpt = reviewnews_get_option('archive_content_view');
?>
<div class="read-single color-pad">
  <div class="read-item">
    <div class="data-bg read-img pos-rel read-bg-img"
      data-background="<?php echo esc_url($reviewnews_img_url); ?>">
      <img src="<?php echo esc_url($reviewnews_img_url); ?>"
        alt="<?php echo esc_attr(reviewnews_get_img_alt($reviewnews_img_thumb_id)); ?>">
      <a class="aft-post-image-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <?php reviewnews_archive_social_share_icons($post->ID); ?>
      <?php reviewnews_post_format($post->ID); ?>
      <?php //reviewnews_count_content_words($post->ID); ?>

    </div>

    <div class="read-details pad-archive">

      <?php if ('post' === get_post_type()) : ?>
        <div class="read-categories">
          <?php reviewnews_post_categories(); ?>
        </div>
      <?php endif; ?>
      <div class="read-title">
        <?php the_title('<h3 class="entry-title">
                    <a href="' . esc_url(get_permalink()) . '" aria-label="' . esc_attr(get_the_title($reviewnews_post_id, 'reviewnews')) . '" rel="bookmark">', '</a>
                </h3>'); ?>
      </div>

      <?php if ('post' === get_post_type()) : ?>
        <div class="post-item-metadata entry-meta author-links">
          <?php reviewnews_post_item_meta(); ?>
          <?php reviewnews_get_comments_views_share($post->ID); ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
  <?php if ($reviewnews_show_excerpt != 'archive-content-none'): ?>
    <div class="read-descprition full-item-discription">
      <div class="post-description">
        <?php
        if ($reviewnews_show_excerpt == 'archive-content-excerpt') {
          echo wp_kses_post(reviewnews_get_the_excerpt($post->ID));
        } else {
          the_content();
        }
        ?>
      </div>
    </div>
  <?php endif; ?>

</div>