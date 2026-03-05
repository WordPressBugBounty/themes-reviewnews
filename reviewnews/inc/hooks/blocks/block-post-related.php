<?php

/**
 * List block part for displaying page content in page.php
 *
 * @package ReviewNews
 */
?>

<div class="promotionspace enable-promotionspace">
    <div class="af-reated-posts reviewnews-customizer">
        <?php
        global $post;
        $reviewnews_categories = get_the_category($post->ID);
        $reviewnews_related_section_title = reviewnews_get_option('single_related_posts_title');
        $reviewnews_number_of_related_posts = 3;

        if ($reviewnews_categories) {
            $reviewnews_cat_ids = array();
            foreach ($reviewnews_categories as $reviewnews_category) $reviewnews_cat_ids[] = $reviewnews_category->term_id;
            $reviewnews_args = array(
                'category__in' => $reviewnews_cat_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => $reviewnews_number_of_related_posts, // Number of related posts to display.
                'ignore_sticky_posts' => 1
            );
            $reviewnews_related_posts = new wp_query($reviewnews_args);

            if ($reviewnews_related_posts->have_posts()) { ?>
                <?php reviewnews_render_section_title($reviewnews_related_section_title);

                ?>
            <?php }
            ?>
            <div class="af-container-row clearfix">
                <?php
                while ($reviewnews_related_posts->have_posts()) {
                    $reviewnews_related_posts->the_post();
                    global $post;


                ?>
                    <div class="col-3 float-l pad latest-posts-grid af-sec-post">
                        <?php do_action('reviewnews_action_loop_grid', $post->ID); ?>
                    </div>
            <?php }
            }
            wp_reset_postdata();
            ?>
            </div>
    </div>
</div>