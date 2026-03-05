<?php
$reviewnews_trending_posts_title = reviewnews_get_option('main_trending_news_section_title');
// $reviewnews_trending_posts_title_2 = reviewnews_get_option('main_trending_news_section_title_2');
$reviewnews_main_posts_title = reviewnews_get_option('main_banner_news_section_title');
$reviewnews_editors_picks_posts_title = reviewnews_get_option('main_editors_picks_section_title');
$reviewnews_editors_picks_posts_title_2 = reviewnews_get_option('main_editors_picks_section_title_2');

$reviewnews_title_class = '';
if (empty($reviewnews_main_posts_title)) {
    $reviewnews_title_class .= 'no-main-slider-title';
}

if (empty($reviewnews_trending_posts_title)) {
    $reviewnews_title_class .= ' no-trending-title';
}

if (empty($reviewnews_editors_picks_posts_title)) {
    $reviewnews_title_class .= ' no-editors-picks-title';
}

$reviewnews_editors_pick_color_class = '';
$reviewnews_banner_posts_color_class = '';
$reviewnews_trending_posts_color_class = '';



$reviewnews_banner_posts_filter_by = reviewnews_get_option('select_main_banner_carousel_filterby');
if ($reviewnews_banner_posts_filter_by == 'cat') {
    $reviewnews_banner_posts_category = reviewnews_get_option('select_slider_news_category');
    if (absint($reviewnews_banner_posts_category) > 0) {
        $color_id = "category_color_" . $reviewnews_banner_posts_category;
        // retrieve the existing value(s) for this meta field. This returns an array
        $term_meta = get_option($color_id);
        $reviewnews_banner_posts_color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
    }
}



?>

<div class="aft-main-banner-part af-container-row-5 <?php echo esc_attr($reviewnews_title_class); ?>">

    <div class="aft-trending-part aft-4-trending-posts aft-4-trending-posts-1 col-4 pad">
        <div class="reviewnews-customizer">
            <?php if (!empty($reviewnews_trending_posts_title)) : ?>
                <?php reviewnews_render_section_title($reviewnews_editors_picks_posts_title, $reviewnews_trending_posts_color_class); ?>
            <?php endif; ?>
            <?php reviewnews_get_block('trending', 'banner'); ?>
        </div>
    </div>

    <div class="aft-slider-part col-2 pad">
        <div class="reviewnews-customizer">
            <?php if (!empty($reviewnews_main_posts_title)) : ?>
                <?php reviewnews_render_section_title($reviewnews_main_posts_title, $reviewnews_banner_posts_color_class); ?>
            <?php endif; ?>
            <?php reviewnews_get_block('carousel', 'banner'); ?>
        </div>
    </div>

    <div class="aft-trending-part col-4 aft-4-trending-posts pad aft-4-trending-posts-2">
        <div class="reviewnews-customizer">
            <?php if (!empty($reviewnews_trending_posts_title)) : ?>
                <?php reviewnews_render_section_title($reviewnews_editors_picks_posts_title_2, $reviewnews_trending_posts_color_class); ?>
            <?php endif; ?>
            <?php reviewnews_get_block('trending-2', 'banner'); ?>
        </div>
    </div>



</div>