<?php
    /**
     * List block part for displaying page content in page.php
     *
     * @package ReviewNews
     */


$reviewnews_thumbnail_size = 'medium_large';
$reviewnews_grid_design ='grid-design-default';

$reviewnews_term_meta_grid = '';
if(is_category()){
    $reviewnews_queried_object = get_queried_object();
    $reviewnews_t_id = $reviewnews_queried_object->term_id;
    $reviewnews_term_meta_grid = get_option("category_layout_grid_$reviewnews_t_id");
}

if (!empty($reviewnews_term_meta_grid)) {
    $reviewnews_archive_image = $reviewnews_term_meta_grid['archive_layout_alignment_term_meta_gird'];
} else {
    $reviewnews_archive_image = reviewnews_get_option('archive_image_alignment_grid');
}

if($reviewnews_archive_image  == 'archive-image-tile'){
    $reviewnews_grid_design ='grid-design-texts-over-image';
}



$reviewnews_content_view = reviewnews_get_option('archive_content_view');
$reviewnews_show_excerpt = true;
if($reviewnews_content_view == 'archive-content-none'){
    $reviewnews_show_excerpt = false;
}
?>

<div class="archive-grid-post">
    <?php do_action('reviewnews_action_loop_grid', $post->ID, $reviewnews_grid_design, $reviewnews_thumbnail_size, $reviewnews_show_excerpt, $reviewnews_content_view); ?>

    <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'reviewnews'),
            'after' => '</div>',
        ));
    ?>
</div>








