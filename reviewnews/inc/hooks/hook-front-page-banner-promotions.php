<?php
if (!function_exists('reviewnews_banner_advertisement')):
    /**
     * Ticker Slider
     *
     * @since ReviewNews 1.0.0
     *
     */
    function reviewnews_banner_advertisement()
    {


        $reviewnews_banner_advertisement = reviewnews_get_option('banner_advertisement_section');

        if (('' != $reviewnews_banner_advertisement) ) { ?>
            <div class="banner-promotions-wrapper">
                <?php if (('' != $reviewnews_banner_advertisement)):
                    $reviewnews_banner_advertisement = absint($reviewnews_banner_advertisement);
                    $reviewnews_banner_advertisement = wp_get_attachment_image($reviewnews_banner_advertisement, 'full');
                    $reviewnews_banner_advertisement_url = reviewnews_get_option('banner_advertisement_section_url');
                    $reviewnews_banner_advertisement_url = isset($reviewnews_banner_advertisement_url) ? esc_url($reviewnews_banner_advertisement_url) : '#';

                    ?>
                    <div class="promotion-section">
                        <a href="<?php echo esc_url($reviewnews_banner_advertisement_url); ?>" >
                            <?php echo wp_kses_post($reviewnews_banner_advertisement); ?>
                        </a>
                    </div>
                <?php endif; ?>                

            </div>
            <!-- Trending line END -->
            <?php
        }

         if (is_active_sidebar('home-advertisement-widgets')): ?>
                     <div class="banner-promotions-wrapper">
                    <div class="promotion-section">
                        <?php dynamic_sidebar('home-advertisement-widgets'); ?>
                    </div>
                </div>
                <?php endif;
    }
endif;

add_action('reviewnews_action_banner_advertisement', 'reviewnews_banner_advertisement', 10);