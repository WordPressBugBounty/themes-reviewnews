<?php

/**
 * Front page section additions.
 */


if (!function_exists('reviewnews_full_width_upper_footer_section')) :
    /**
     *
     * @since ReviewNews 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function reviewnews_full_width_upper_footer_section()
    {



        ?>

        <section class="aft-blocks above-footer-widget-section">
            <?php

            if (1 == reviewnews_get_option('frontpage_show_latest_posts')) {
                reviewnews_get_block('latest');
            }

            ?>
        </section>
        <?php

    }
endif;
add_action('reviewnews_action_full_width_upper_footer_section', 'reviewnews_full_width_upper_footer_section');
