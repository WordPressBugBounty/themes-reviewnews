<?php
if (!function_exists('reviewnews_banner_featured_section')):
    /**
     * Ticker Slider
     *
     * @since ReviewNews 1.0.0
     *
     */
    function reviewnews_banner_featured_section()
    {
        ?>
        <div class="aft-frontpage-feature-section-wrapper">

            <?php $reviewnews_show_featured_section = reviewnews_get_option('show_featured_posts_section');
            if ($reviewnews_show_featured_section): ?>
                <section class="aft-blocks af-main-banner-featured-posts reviewnews-customizer">
                    <div class="container-wrapper">
                        <?php do_action('reviewnews_action_banner_featured_posts'); ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php

            $reviewnews_show_post_list_section = reviewnews_get_option('show_featured_post_list_section');

            ?>

            <?php if ($reviewnews_show_post_list_section) { ?>
                <section class="aft-blocks aft-featured-category-section af-list-post featured-cate-sec reviewnews-customizer">
                    <div class="container-wrapper">

                            <?php reviewnews_get_block('list-posts', 'featured'); ?>

                    </div>
                </section>
            <?php } ?>

        </div>
    <?php }
endif;


add_action('reviewnews_action_banner_featured_section', 'reviewnews_banner_featured_section', 10);