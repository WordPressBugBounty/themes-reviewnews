<?php
    /**
     * List block part for displaying latest posts in footer.php
     *
     * @package ReviewNews
     */
    
    $reviewnews_latest_posts_title = reviewnews_get_option('frontpage_latest_posts_section_title');
    $reviewnews_latest_posts_subtitle = reviewnews_get_option('frontpage_latest_posts_section_subtitle');
    $reviewnews_number_of_posts = reviewnews_get_option('number_of_frontpage_latest_posts');
    $reviewnews_all_posts = reviewnews_get_posts($reviewnews_number_of_posts);
?>
<div class="af-main-banner-latest-posts grid-layout reviewnews-customizer">
    <div class="container-wrapper">
        <div class="widget-title-section">
            <?php if (!empty($reviewnews_latest_posts_title)): ?>
                <?php reviewnews_render_section_title($reviewnews_latest_posts_title); ?>
            <?php endif; ?>
        </div>
        <div class="af-container-row clearfix">
            <?php
                if ($reviewnews_all_posts->have_posts()) :
                    while ($reviewnews_all_posts->have_posts()) : $reviewnews_all_posts->the_post();
                        global $post;

                        ?>
                        <div class="col-4 pad float-l">
                            <?php do_action('reviewnews_action_loop_grid', $post->ID); ?>
                        </div>
                    <?php
                    endwhile; ?>
                <?php
                endif;
                wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
