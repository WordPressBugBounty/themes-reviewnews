<?php

/**
 * Full block part for displaying page content in page.php
 *
 * @package ReviewNews
 */

$reviewnews_posts_filter_by = reviewnews_get_option('select_main_banner_carousel_filterby');
if ($reviewnews_posts_filter_by == 'tag') {
  $reviewnews_slider_category = reviewnews_get_option('select_slider_news_tag');
  $reviewnews_filterby = 'tag';
} else {
  $reviewnews_slider_category = reviewnews_get_option('select_slider_news_category');
  $reviewnews_filterby = 'cat';
}

$reviewnews_number_of_slides = reviewnews_get_option('number_of_slides');
$reviewnews_slider_mode = reviewnews_get_option('select_main_banner_section_mode');
$reviewnews_main_banner_layout_section = reviewnews_get_option('select_main_banner_layout_section');

$reviewnews_centerPadding = '';
$reviewnews_break_point_1_centerPadding = '';
$reviewnews_break_point_2_centerPadding = '';
$reviewnews_break_point_3_centerPadding = '';


if (($reviewnews_main_banner_layout_section == 'layout-5') || ($reviewnews_main_banner_layout_section == 'layout-6')) {
  $thumbnail_size = 'reviewnews-large';
} else {
  $thumbnail_size = 'reviewnews-medium';
}
if ($reviewnews_main_banner_layout_section == 'layout-7') {
  $reviewnews_centerMode = false;
  $reviewnews_slidesToShow = 2;
  $reviewnews_slidesToScroll = 1;
  $reviewnews_carousel_class = 'af-carousel-2';
  $reviewnews_break_point_1_slidesToShow = 2;
  $reviewnews_break_point_1_slidesToScroll = 1;
  $reviewnews_break_point_2_slidesToShow = 2;
  $reviewnews_break_point_2_slidesToScroll = 1;
  $reviewnews_break_point_3_slidesToShow = 1;
  $reviewnews_break_point_3_slidesToScroll = 1;
} else {
  $reviewnews_centerMode = false;
  $reviewnews_slidesToShow = 1;
  $reviewnews_slidesToScroll = 1;
  $reviewnews_carousel_class = 'af-carousel-default';
  $reviewnews_break_point_1_slidesToShow = 1;
  $reviewnews_break_point_1_slidesToScroll = 1;
  $reviewnews_break_point_2_slidesToShow = 1;
  $reviewnews_break_point_2_slidesToScroll = 1;
  $reviewnews_break_point_3_slidesToShow = 1;
  $reviewnews_break_point_3_slidesToScroll = 1;
}

$reviewnews_carousel_args = array(
  'slidesToShow' => $reviewnews_slidesToShow,
  'slidesToScroll' => $reviewnews_slidesToScroll,
  'autoplaySpeed' => 10000,
  'centerMode' => $reviewnews_centerMode,
  'centerPadding' => $reviewnews_centerPadding,
  'responsive' => array(
    array(
      'breakpoint' => 1025,
      'settings' => array(
        'slidesToShow' => $reviewnews_break_point_2_slidesToShow,
        'slidesToScroll' => $reviewnews_break_point_3_slidesToScroll,
        'infinite' => true,
        'centerPadding' => $reviewnews_break_point_1_centerPadding,
      ),
    ),
    array(
      'breakpoint' => 600,
      'settings' => array(
        'slidesToShow' => $reviewnews_break_point_2_slidesToShow,
        'slidesToScroll' => $reviewnews_break_point_2_slidesToScroll,
        'infinite' => true,
        'centerPadding' => $reviewnews_break_point_2_centerPadding,
      ),
    ),
    array(
      'breakpoint' => 480,
      'settings' => array(
        'slidesToShow' => $reviewnews_break_point_3_slidesToShow,
        'slidesToScroll' => $reviewnews_break_point_3_slidesToScroll,
        'infinite' => true,
        'centerPadding' => $reviewnews_break_point_3_centerPadding,
      ),
    ),
  ),
);

$reviewnews_carousel_args_encoded = wp_json_encode($reviewnews_carousel_args);
// wp_enqueue_style('slick');
// wp_enqueue_script('slick');
?>

<div class="af-widget-carousel aft-carousel">
  <div class="slick-wrapper af-banner-carousel af-banner-carousel-1 common-carousel af-cat-widget-carousel <?php echo esc_html($reviewnews_carousel_class); ?>"
    data-slick='<?php echo wp_kses_post($reviewnews_carousel_args_encoded); ?>'>
    <?php
    $reviewnews_slider_posts = reviewnews_get_posts($reviewnews_number_of_slides, $reviewnews_slider_category, $reviewnews_filterby);
    if ($reviewnews_slider_posts->have_posts()) :
      while ($reviewnews_slider_posts->have_posts()) : $reviewnews_slider_posts->the_post();
        global $post;

    ?>
        <div class="slick-item">
          <?php do_action('reviewnews_action_loop_grid', $post->ID, 'grid-design-texts-over-image', $thumbnail_size); ?>
        </div>
    <?php
      endwhile;
    endif;
    wp_reset_postdata();
    ?>
  </div>
  <div class="af-main-navcontrols af-slick-navcontrols"></div>
</div>