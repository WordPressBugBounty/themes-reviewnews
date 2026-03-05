<?php
if (!function_exists('reviewnews_single_header')) :
    /**
     * Banner Slider
     *
     * @since ReviewNews 1.0.0
     *
     */
    function reviewnews_single_header()
    {
        global $post;
        $reviewnews_post_id = $post->ID;
        ?>
        <header class="entry-header pos-rel">
            <div class="read-details">
                <div class="entry-header-details af-cat-widget-carousel">
                    <?php if ('post' === get_post_type()) : ?>

                        <div class="figure-categories read-categories figure-categories-bg categories-inside-image">
                            <?php reviewnews_post_format($post->ID); ?>
                            <?php reviewnews_post_categories(true); ?>
                        </div>
                    <?php endif; ?>
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>



                    <div class="aft-post-excerpt-and-meta color-pad">
                        <?php if ('post' === get_post_type($reviewnews_post_id)) :
                            if (has_excerpt($reviewnews_post_id)):

                                ?>
                                <div class="post-excerpt">
                                    <?php echo wp_kses_post(get_the_excerpt($post->ID)); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <div class="entry-meta author-links">

                            <?php reviewnews_post_item_meta_single(); ?>
                            <?php reviewnews_count_content_words($post->ID); ?>
                            <?php reviewnews_get_comments_views_share_single($post->ID); ?>                          

                        </div>
                    </div>
                </div>
            </div>



        </header><!-- .entry-header -->




        <!-- end slider-section -->
        <?php
    }
endif;
add_action('reviewnews_action_single_header', 'reviewnews_single_header', 40);