<?php
if (!function_exists('reviewnews_banner_featured_posts')):
    /**
     * Ticker Slider
     *
     * @since ReviewNews 1.0.0
     *
     */
    function reviewnews_banner_featured_posts()
    {

        $reviewnews_enable_featured_news = reviewnews_get_option('show_featured_posts_section');
        $reviewnews_category = reviewnews_get_option('select_featured_news_category');
        $reviewnews_number_of_featured_news = reviewnews_get_option('number_of_featured_news');
        $reviewnews_featured_posts = reviewnews_get_posts($reviewnews_number_of_featured_news, $reviewnews_category);
        $color_class = '';
        if (absint($reviewnews_category) > 0) {
            $color_id = "category_color_" . $reviewnews_category;
            // retrieve the existing value(s) for this meta field. This returns an array
            $term_meta = get_option($color_id);
            $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
        }

        if ($reviewnews_enable_featured_news):
            $reviewnews_featured_news_title = reviewnews_get_option('featured_news_section_title');
            ?>
            <div class="af-main-banner-featured-posts featured-posts reviewnews-customizer">

                <?php if (!empty($reviewnews_featured_news_title)): ?>
                    <?php reviewnews_render_section_title($reviewnews_featured_news_title, $color_class); ?>
                <?php endif; ?>



                <div class="section-wrapper af-widget-body">
                    <div class="af-container-row clearfix">
                        <?php

                        
                        if ($reviewnews_featured_posts->have_posts()) :
                            while ($reviewnews_featured_posts->have_posts()) :
                                $reviewnews_featured_posts->the_post();
                                global $post;
                                ?>


                                    <div class="af-sec-post col-4 pad float-l">
                                        <?php do_action('reviewnews_action_loop_grid', $post->ID); ?>
                                    </div>


                            <?php endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <!-- Trending line END -->
        <?php

    }
endif;

add_action('reviewnews_action_banner_featured_posts', 'reviewnews_banner_featured_posts', 10);