<?php
/**
 * Full block part for displaying page content in page.php
 *
 * @package ReviewNews
 */

$reviewnews_thumbnail_size = 'large';
$reviewnews_grid_design = 'grid-design-default';
$reviewnews_title_position = 'bottom';

$reviewnews_content_view = reviewnews_get_option('archive_content_view');

$reviewnews_term_meta_grid = '';
if(is_category()){
    $reviewnews_queried_object = get_queried_object();
    $reviewnews_t_id = $reviewnews_queried_object->term_id;
    $reviewnews_term_meta_grid = get_option("category_layout_full_$reviewnews_t_id");
}



$reviewnews_archive_image = reviewnews_get_option('archive_layout_full');
if($reviewnews_archive_image == 'full-title-first'){
    $reviewnews_title_position = 'top';
}



$reviewnews_show_excerpt = true;
if ($reviewnews_content_view == 'archive-content-none') {
    $reviewnews_show_excerpt = false;
}
do_action('reviewnews_action_loop_grid', $post->ID, $reviewnews_grid_design, $reviewnews_thumbnail_size, $reviewnews_show_excerpt, $reviewnews_content_view, $reviewnews_title_position);