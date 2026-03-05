<div class="af-main-banner-thumb-posts">
    <div class="section-wrapper">
        <div class="small-grid-style clearfix">
            <?php
                
                $reviewnews_filterby = reviewnews_get_option('select_editors_picks_filterby_2');
                $reviewnews_editors_pick_category = 0;
                if ($reviewnews_filterby == 'tag') {
                    $reviewnews_editors_pick_category = reviewnews_get_option('select_editors_picks_news_tag_2');
                    
                } 
                
                $reviewnews_featured_posts = reviewnews_get_posts(2, $reviewnews_editors_pick_category, $reviewnews_filterby);
                if ($reviewnews_featured_posts->have_posts()) :
                    $reviewnews_count = 1;
                    while ($reviewnews_featured_posts->have_posts()) :
                        $reviewnews_featured_posts->the_post();
                        global $post;

                        ?>

                        <div class="af-sec-post">
                            <?php do_action('reviewnews_action_loop_grid', $post->ID, 'grid-design-texts-over-image'); ?>
                        </div>


                        <?php
                        $reviewnews_count++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                <?php endif; ?>
        </div>
    </div>
</div>
<!-- Editors Pick line END -->
