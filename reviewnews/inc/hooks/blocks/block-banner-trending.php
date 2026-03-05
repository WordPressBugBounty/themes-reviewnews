<?php
$reviewnews_filterby = reviewnews_get_option('select_editors_picks_filterby');
                
if ($reviewnews_filterby == 'tag') {
    $reviewnews_editors_pick_category = reviewnews_get_option('select_editors_picks_news_tag');                    
} else {                    
    $reviewnews_editors_pick_category = reviewnews_get_option('select_editors_picks_news_category');                   
}

$reviewnews_all_posts_vertical = reviewnews_get_posts(5, $reviewnews_editors_pick_category, $reviewnews_filterby);

?>
<div class="full-wid-resp">
    <div class="slick-wrapper banner-vertical-slider banner-vertical-slider-1 af-widget-carousel">
        <?php
        $reviewnews_count = 1;
        $show_cat = true;


        if ($reviewnews_all_posts_vertical->have_posts()) :
            while ($reviewnews_all_posts_vertical->have_posts()) : $reviewnews_all_posts_vertical->the_post();

                global $post;

        ?>
                <div class="slick-item">
                    <div class="aft-trending-posts list-part af-sec-post">
                        <?php do_action('reviewnews_action_loop_list', $post->ID, 'thumbnail', $reviewnews_count, $show_cat, true, false); ?>
                    </div>
                </div>
        <?php
                $reviewnews_count++;
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
    <div class="af-trending-navcontrols af-slick-navcontrols"></div>
</div>