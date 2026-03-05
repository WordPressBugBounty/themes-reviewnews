<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ReviewNews
 */

if (!function_exists('reviewnews_post_categories')) :
    function reviewnews_post_categories($reviewnews_is_single = false)
    {
        $reviewnews_global_show_categories = reviewnews_get_option('global_show_categories');
        if ($reviewnews_global_show_categories == 'no') {
            return;
        }


        $reviewnews_global_number_of_categories = reviewnews_get_option('global_number_of_categories');
        if ($reviewnews_global_number_of_categories == 'custom') {
            $show_category_number = reviewnews_get_option('global_custom_number_of_categories');
            $show_category_number = absint($show_category_number);
        } elseif ($reviewnews_global_number_of_categories == 'one') {
            $show_category_number = 1;
        } else {
            $show_category_number = 0;
        }

        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            global $post;
            $reviewnews_post_categories = get_the_category($post->ID);
            if ($reviewnews_post_categories) {

                $reviewnews_output = '<ul class="cat-links">';
                $category_count = 0;
                foreach ($reviewnews_post_categories as $post_category) {
                    $reviewnews_t_id = $post_category->term_id;
                    $reviewnews_color_id = "category_color_" . $reviewnews_t_id;

                    // retrieve the existing value(s) for this meta field. This returns an array
                    $reviewnews_term_meta = get_option($reviewnews_color_id);
                    $reviewnews_color_class = ($reviewnews_term_meta) ? $reviewnews_term_meta['color_class_term_meta'] : 'category-color-1';

                    $reviewnews_output .= '<li class="meta-category">
                             <a class="reviewnews-categories ' . esc_attr($reviewnews_color_class) . '" href="' . esc_url(get_category_link($post_category)) . '" aria-label="' . esc_html($post_category->name) . '">
                                 ' . esc_html($post_category->name) . '
                             </a>
                        </li>';

                    if ($reviewnews_is_single == false) {
                        if (++$category_count == $show_category_number) break;
                    }
                }
                $reviewnews_output .= '</ul>';
                echo wp_kses_post($reviewnews_output);
            }
        }
    }
endif;


if (!function_exists('reviewnews_get_category_color_class')) :

    function reviewnews_get_category_color_class($term_id)
    {

        $reviewnews_color_id = "category_color_" . $term_id;
        // retrieve the existing value(s) for this meta field. This returns an array
        $reviewnews_term_meta = get_option($reviewnews_color_id);
        $reviewnews_color_class = ($reviewnews_term_meta) ? $reviewnews_term_meta['color_class_term_meta'] : '';
        return $reviewnews_color_class;
    }
endif;

if (!function_exists('reviewnews_post_item_meta')) :

    function reviewnews_post_item_meta($reviewnews_post_display = 'spotlight-post')
    {

        global $post;
        if ('post' == get_post_type($post->ID)) :

            $reviewnews_author_id = $post->post_author;
            $reviewnews_date_display_setting = reviewnews_get_option('global_date_display_setting');
            $reviewnews_author_icon_gravatar_display_setting = reviewnews_get_option('global_author_icon_gravatar_display_setting');

            if ($reviewnews_post_display == 'list-post') {
                $reviewnews_post_meta = reviewnews_get_option('list_post_date_author_setting');
            } elseif ($reviewnews_post_display == 'grid-post') {
                $reviewnews_post_meta = reviewnews_get_option('small_grid_post_date_author_setting');
            } else {
                $reviewnews_post_meta = reviewnews_get_option('global_post_date_author_setting');
            }

            if ($reviewnews_post_meta == 'show-date-only') {
                $reviewnews_display_author = false;
                $reviewnews_display_date = true;
            } elseif ($reviewnews_post_meta == 'show-author-only') {
                $reviewnews_display_author = true;
                $reviewnews_display_date = false;
            } elseif (($reviewnews_post_meta == 'show-date-author')) {
                $reviewnews_display_author = true;
                $reviewnews_display_date = true;
            } else {
                $reviewnews_display_author = false;
                $reviewnews_display_date = false;
            }

?>


            <!-- <span class="author-links"> -->
            <?php if ($reviewnews_display_author) : ?>
                <span class="item-metadata posts-author byline">
                    <?php if ($reviewnews_author_icon_gravatar_display_setting == 'display-gravatar') {
                        reviewnews_by_author($gravatar = true);
                    } elseif ($reviewnews_author_icon_gravatar_display_setting == 'display-icon') { ?>
                        <i class="far fa-user-circle"></i>
                    <?php reviewnews_by_author($gravatar = false);
                    } else {
                        reviewnews_by_author($gravatar = false);
                    } ?>
                </span>
            <?php endif; ?>


            <?php
            if ($reviewnews_display_date) : ?>
                <span class="item-metadata posts-date">
                    <i class="far fa-clock" aria-hidden="true"></i>
                    <?php
                    $reviewnews_date_display_setting = reviewnews_get_option('global_date_display_setting');
                    $reviewnews_date_type = reviewnews_get_option('global_date_display_type');
                    
                    

                    if ($reviewnews_date_type == 'published') {
                        $published_time = get_the_time('U');
                        echo esc_html(reviewnews_get_formatted_date($published_time, $reviewnews_date_display_setting));
                    } elseif ($reviewnews_date_type == 'modified') {
                        $modified_time  = get_the_modified_time('U');
                        echo esc_html(reviewnews_get_formatted_date($modified_time, $reviewnews_date_display_setting));
                    } elseif ($reviewnews_date_type == 'both') {
                        $published_time = get_the_time('U');
                        $modified_time  = get_the_modified_time('U');
                        echo esc_html(reviewnews_get_formatted_date($published_time, $reviewnews_date_display_setting));
                        echo " ";
                        printf(
                            esc_html__('(Last updated: %s)', 'reviewnews'),
                            esc_html(reviewnews_get_formatted_date($modified_time, $reviewnews_date_display_setting))
                        );
                    }
                    ?>
                </span>
            <?php endif; ?>

            <!-- </span> -->
        <?php
        endif;
    }
endif;

if (!function_exists('reviewnews_post_item_meta_single')) :

    function reviewnews_post_item_meta_single($reviewnews_post_display = 'spotlight-post')
    {

        global $post;
        if ('post' == get_post_type($post->ID)) :

            $reviewnews_author_id = $post->post_author;
            $reviewnews_date_display_setting = reviewnews_get_option('global_date_display_setting');
            $reviewnews_author_icon_gravatar_display_setting = reviewnews_get_option('global_author_icon_gravatar_display_setting');

            if ($reviewnews_post_display == 'list-post') {
                $reviewnews_post_meta = reviewnews_get_option('list_post_date_author_setting');
            } elseif ($reviewnews_post_display == 'grid-post') {
                $reviewnews_post_meta = reviewnews_get_option('small_grid_post_date_author_setting');
            } else {
                $reviewnews_post_meta = reviewnews_get_option('global_post_date_author_setting');
            }

            if ($reviewnews_post_meta == 'show-date-only') {
                $reviewnews_display_author = false;
                $reviewnews_display_date = true;
            } elseif ($reviewnews_post_meta == 'show-author-only') {
                $reviewnews_display_author = true;
                $reviewnews_display_date = false;
            } elseif (($reviewnews_post_meta == 'show-date-author')) {
                $reviewnews_display_author = true;
                $reviewnews_display_date = true;
            } else {
                $reviewnews_display_author = false;
                $reviewnews_display_date = false;
            }

        ?>


            <!-- <span class="author-links"> -->
            <?php if ($reviewnews_display_author) : ?>
                <span class="item-metadata posts-author byline">
                    <?php if ($reviewnews_author_icon_gravatar_display_setting == 'display-gravatar') {
                        reviewnews_by_author($gravatar = true);
                    } elseif ($reviewnews_author_icon_gravatar_display_setting == 'display-icon') { ?>
                        <i class="far fa-user-circle"></i>
                    <?php reviewnews_by_author($gravatar = false);
                    } else {
                        reviewnews_by_author($gravatar = false);
                    } ?>
                </span>
            <?php endif; ?>


            <?php
            if ($reviewnews_display_date) : ?>
                <span class="item-metadata posts-date">
                    <i class="far fa-clock" aria-hidden="true"></i>
                    <?php
                    $reviewnews_date_display_setting = reviewnews_get_option('global_date_display_setting');
                    $reviewnews_date_type = reviewnews_get_option('single_date_display_type');                    
                    if ($reviewnews_date_type == 'published') {
                        $published_time = get_the_time('U');
                        echo esc_html(reviewnews_get_formatted_date($published_time, $reviewnews_date_display_setting));
                    } elseif ($reviewnews_date_type == 'modified') {
                        $modified_time  = get_the_modified_time('U');
                        echo esc_html(reviewnews_get_formatted_date($modified_time, $reviewnews_date_display_setting));
                    } elseif ($reviewnews_date_type == 'both') {
                        $published_time = get_the_time('U');
                        $modified_time  = get_the_modified_time('U');
                        if ($published_time != $modified_time) {
                            echo esc_html(reviewnews_get_formatted_date($published_time, $reviewnews_date_display_setting));
                            echo " ";
                            printf(
                                esc_html__('(Last updated: %s)', 'reviewnews'),
                                esc_html(reviewnews_get_formatted_date($modified_time, $reviewnews_date_display_setting))
                            );
                        } else {
                            // Dates are same: show only one date without label
                            echo esc_html(reviewnews_get_formatted_date($published_time, $reviewnews_date_display_setting));
                        }
                    }
                    ?>
                </span>
            <?php endif; ?>

            <!-- </span> -->
<?php
        endif;
    }
endif;


function reviewnews_get_formatted_date($timestamp, $format_key)
{
    switch ($format_key) {
        case 'default-date':
            return date_i18n(get_option('date_format'), $timestamp);

        default:
            $time_diff = human_time_diff($timestamp, current_time('timestamp'));
            return sprintf(
                __('%s ago', 'reviewnews'),
                $time_diff
            );
    }
}


if (!function_exists('reviewnews_post_item_tag')) :

    function reviewnews_post_item_tag($view = 'default')
    {

        $reviewnews_single_show_tags_list = reviewnews_get_option('single_show_tags_list');
        if ($reviewnews_single_show_tags_list) {
            if ('post' === get_post_type()) {

                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list('', ' ');
                if ($tags_list) {
                    /* translators: 1: list of tags. */
                    printf('<span class="tags-links">' . esc_html('Tags: %1$s') . '</span>', $tags_list);
                }
            }
        }

        if (is_single()) {
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'reviewnews'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
        }
    }
endif;

if (!function_exists('reviewnews_preload_header_image')) :
    function reviewnews_preload_header_image()
    {
        // Check if there is a custom header image set for the theme.
        if (has_header_image()) {
            // Get the URL of the header image.
            $reviewnews_background = get_header_image();

            // Output the preload link for the header image.
            echo '<link rel="preload" href="' . esc_url($reviewnews_background) . '" as="image">';
        }
    }
endif;
add_action('wp_head', 'reviewnews_preload_header_image');



function reviewnews_live_search_scripts()
{

    // Check if AJAX search enabled
    $enable_ajax = reviewnews_get_option('search_archive_enable_ajax');
    $limit       = absint(reviewnews_get_option('search_archive_ajax_results'));

    if ($enable_ajax) {

        wp_enqueue_script(
            'reviewnews-live-search',
            get_template_directory_uri() . '/assets/search-script.js',
            array('jquery'),
            null,
            true
        );

        wp_localize_script('reviewnews-live-search', 'afLiveSearch', array(
            'ajax_url'       => admin_url('admin-ajax.php'),
            'searching_text' => __('Searching...', 'reviewnews'),
            'enabled'        => (bool) $enable_ajax,
            'results_count'  => $limit > 0 ? $limit : 5,
            'nonce'          => wp_create_nonce('reviewnews_live_search'),
        ));
    }    
}
add_action('wp_enqueue_scripts', 'reviewnews_live_search_scripts');

function reviewnews_live_search_ajax()
{

    // Security check
    if (empty($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'reviewnews_live_search')) {
        wp_send_json_error(['message' => __('Invalid security token.', 'reviewnews')]);
    }

    // Query text
    $query = isset($_POST['s']) ? sanitize_text_field(wp_unslash($_POST['s'])) : '';

    // Customizer controls
    $search_archive_content_view = reviewnews_get_option('search_archive_content_view');
    $limit = isset($_POST['limit']) ? absint($_POST['limit']) : absint(reviewnews_get_option('search_archive_ajax_results'));

    if ($limit < 1) {
        $limit = 5;
    }

    // Build query
    $args = array(
        's'              => $query,
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
    );

    if ($search_archive_content_view !== 'all') {
        $args['post_type'] = 'post';
    }

    $search = new WP_Query($args);

    // Wrapper
    echo '<div class="af-live-search-results" role="listbox" aria-label="' . esc_attr__('Live search results', 'reviewnews') . '">';

    if ($search->have_posts()) {

        echo '<ul class="af-live-search-list">';

        while ($search->have_posts()) {
            $search->the_post();

            echo '<li class="af-live-search-item" role="option" tabindex="-1">';
            do_action('reviewnews_action_loop_list', get_the_ID(), 'thumbnail', 0, false, false, false);
            echo '</li>';
        }

        echo '</ul>';

        // View all link
        echo '<div class="af-live-search-more">';
        echo '<a href="' . esc_url(get_search_link($query)) . '" class="view-all-results" aria-label="' . esc_attr__('View all search results', 'reviewnews') . '">';
        printf(esc_html__('View all results for "%s"', 'reviewnews'), esc_html($query));
        echo '</a>';
        echo '</div>';
    } else {

        echo '<p class="no-results" role="alert">';
        echo esc_html__('No results found.', 'reviewnews');
        echo '</p>';
    }

    echo '</div>';

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_reviewnews_live_search', 'reviewnews_live_search_ajax');
add_action('wp_ajax_nopriv_reviewnews_live_search', 'reviewnews_live_search_ajax');