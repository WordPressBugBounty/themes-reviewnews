<?php

if (!function_exists('reviewnews_front_page_widgets_section')) :
    /**
     *
     * @param null
     * @return null
     *
     * @since ReviewNews 1.0.0
     *
     */
    function reviewnews_front_page_widgets_section()
    {
        $frontpage_layout = reviewnews_get_option('frontpage_content_alignment');
        $frontpage_content_type = reviewnews_get_option('frontpage_content_type');

?>

        <section class="section-block-upper">



            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <?php
                    if ($frontpage_content_type == 'frontpage-widgets-and-content') {
                        while (have_posts()) : the_post();

                            
                            $content = trim(get_the_content());
                            if (!empty($content)) {
                                get_template_part('template-parts/content', 'page');
                            }

                        endwhile;
                    }

                    ?>
                    <?php if (is_active_sidebar('home-content-widgets')) : ?>
                        <?php dynamic_sidebar('home-content-widgets'); ?>
                    <?php endif; ?>
                </main>
            </div>



            <?php if (is_active_sidebar('home-sidebar-widgets') && $frontpage_layout != 'full-width-content') : ?>

                <?php
                $sticky_sidebar_class = '';
                $sticky_sidebar = reviewnews_get_option('frontpage_sticky_sidebar');
                if ($sticky_sidebar) {
                    $sticky_sidebar_class = reviewnews_get_option('frontpage_sticky_sidebar_position');
                }
                ?>


                <div id="secondary" class="sidebar-area <?php echo esc_attr($sticky_sidebar_class); ?>">
                    <aside class="widget-area color-pad">
                        <?php dynamic_sidebar('home-sidebar-widgets'); ?>
                    </aside>
                </div>
            <?php endif; ?>
        </section>

<?php
    }
endif;
add_action('reviewnews_front_page_section', 'reviewnews_front_page_widgets_section', 50);
