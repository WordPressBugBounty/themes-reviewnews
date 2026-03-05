<?php
if (!function_exists('reviewnews_front_page_main_section')) :
    /**
     * Banner Slider
     *
     * @since ReviewNews 1.0.0
     *
     */
    function reviewnews_front_page_main_section()
    {
        $reviewnews_enable_main_slider = reviewnews_get_option('show_main_news_section');

        if ($reviewnews_enable_main_slider):

            $reviewnews_banner_layout = reviewnews_get_option('select_main_banner_layout_section');
            $reviewnews_banner_background = reviewnews_get_option('main_banner_background_section');

            $reviewnews_layout_class = 'aft-banner-' . $reviewnews_banner_layout;

            $reviewnews_main_banner_order = reviewnews_get_option('select_main_banner_order');
            $reviewnews_layout_class .= ' aft-banner-'.$reviewnews_main_banner_order;

            $reviewnews_main_banner_url = '';

            if (!empty($reviewnews_banner_background)) {
                $reviewnews_banner_background = absint($reviewnews_banner_background);
                $reviewnews_main_banner_url = wp_get_attachment_url($reviewnews_banner_background);
                $reviewnews_layout_class .= ' data-bg';

            }

            ?>

            <section
                    class="aft-blocks aft-main-banner-section banner-carousel-1-wrap bg-fixed  reviewnews-customizer <?php echo esc_attr($reviewnews_layout_class); ?>"
                    data-background="<?php echo esc_attr($reviewnews_main_banner_url); ?>">
            <?php do_action('reviewnews_action_banner_exclusive_posts'); ?>


            <?php
                if (is_active_sidebar('home-above-main-banner-widgets')): ?>
                    <section class="aft-blocks aft-above-main-banner-section">
                        <div class="container-wrapper">
                            <div class="home-main-banner-widgets upper">
                                <?php dynamic_sidebar('home-above-main-banner-widgets'); ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
                
                <div class="container-wrapper">
                    <div class="aft-main-banner-wrapper">
                        <?php
                        $reviewnews_banner_block = 'main-' . $reviewnews_banner_layout;
                        reviewnews_get_block($reviewnews_banner_block, 'banner');
                        ?>
                    </div>
                </div>



            </section>


        <?php
        else:
            do_action('reviewnews_action_banner_exclusive_posts');
        endif;
    }
endif;
add_action('reviewnews_action_front_page_main_section', 'reviewnews_front_page_main_section', 40);