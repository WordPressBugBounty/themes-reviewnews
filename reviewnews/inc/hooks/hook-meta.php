<?php
/**
 * Implement theme metabox.
 *
 * @package ReviewNews
 */

if (!function_exists('reviewnews_add_theme_meta_box')) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function reviewnews_add_theme_meta_box()
    {

        $reviewnews_screens = array('post', 'page');

        foreach ($reviewnews_screens as $screen) {
            add_meta_box(
                'reviewnews-theme-settings',
                esc_html__('Layout Options', 'reviewnews'),
                'reviewnews_render_layout_options_metabox',
                $screen,
                'side',
                'low'


            );
        }

    }

endif;

add_action('add_meta_boxes', 'reviewnews_add_theme_meta_box');

if (!function_exists('reviewnews_render_layout_options_metabox')) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function reviewnews_render_layout_options_metabox($post, $metabox)
    {

        $reviewnews_post_id = $post->ID;

        // Meta box nonce for verification.
        wp_nonce_field(basename(__FILE__), 'reviewnews_meta_box_nonce');
        // Fetch Options list.
        $reviewnews_content_layout = get_post_meta($reviewnews_post_id, 'reviewnews-meta-content-alignment', true);
        $reviewnews_global_single_content_mode = get_post_meta($reviewnews_post_id, 'reviewnews-meta-content-mode', true);

        if (empty($reviewnews_content_layout)) {
            $reviewnews_content_layout = reviewnews_get_option('global_content_alignment');
        }

        if (empty($reviewnews_global_single_content_mode)) {
            $reviewnews_global_single_content_mode = reviewnews_get_option('global_single_content_mode');
        }


        ?>
        <div id="reviewnews-settings-metabox-container" class="reviewnews-settings-metabox-container">
            <div id="reviewnews-settings-metabox-tab-layout">

                <div class="reviewnews-row-content">
                    <!-- Select Field-->
                    <h3><?php esc_html_e('Content Options', 'reviewnews') ?></h3>
                    <p>
                        <select name="reviewnews-meta-content-mode" id="reviewnews-meta-content-mode">

                            <option value="" <?php selected('', $reviewnews_global_single_content_mode); ?>>
                                <?php esc_html_e('Set as global layout', 'reviewnews') ?>
                            </option>
                            <option value="single-content-mode-default" <?php selected('single-content-mode-default', $reviewnews_global_single_content_mode); ?>>
                                <?php esc_html_e('Default', 'reviewnews') ?>
                            </option>
                            <option value="single-content-mode-boxed" <?php selected('single-content-mode-boxed', $reviewnews_global_single_content_mode); ?>>
                                <?php esc_html_e('Spacious', 'reviewnews') ?>
                            </option>

                        </select>
                    </p>
                    <small><?php esc_html_e('Please go to Customize>Themes Options for Single Post/Page.', 'reviewnews')?></small>

                </div><!-- .reviewnews-row-content -->
                <div class="reviewnews-row-content">
                    <!-- Select Field-->
                    <h3><?php esc_html_e('Sidebar Options', 'reviewnews') ?></h3>
                    <p>
                        <select name="reviewnews-meta-content-alignment" id="reviewnews-meta-content-alignment">

                            <option value="" <?php selected('', $reviewnews_content_layout); ?>>
                                <?php esc_html_e('Set as global layout', 'reviewnews') ?>
                            </option>
                            <option value="align-content-left" <?php selected('align-content-left', $reviewnews_content_layout); ?>>
                                <?php esc_html_e('Content - Primary Sidebar', 'reviewnews') ?>
                            </option>
                            <option value="align-content-right" <?php selected('align-content-right', $reviewnews_content_layout); ?>>
                                <?php esc_html_e('Primary Sidebar - Content', 'reviewnews') ?>
                            </option>
                            <option value="full-width-content" <?php selected('full-width-content', $reviewnews_content_layout); ?>>
                                <?php esc_html_e('No Sidebar', 'reviewnews') ?>
                            </option>
                        </select>
                    </p>
                    <small><?php esc_html_e('Please go to Customize>Front-page Options for Homepage.', 'reviewnews')?></small>

                </div><!-- .reviewnews-row-content -->

            </div><!-- #reviewnews-settings-metabox-tab-layout -->
        </div><!-- #reviewnews-settings-metabox-container -->

        <?php
    }

endif;


if (!function_exists('reviewnews_save_layout_options_meta')) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int $reviewnews_post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function reviewnews_save_layout_options_meta($reviewnews_post_id, $post)
    {

        // Verify nonce.
        if (!isset($_POST['reviewnews_meta_box_nonce']) || !wp_verify_nonce($_POST['reviewnews_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        // Bail if auto save or revision.
        if (defined('DOING_AUTOSAVE') || is_int(wp_is_post_revision($post)) || is_int(wp_is_post_autosave($post))) {
            return;
        }

        // Check the post being saved == the $reviewnews_post_id to prevent triggering this call for other save_post events.
        if (empty($_POST['post_ID']) || $_POST['post_ID'] != $reviewnews_post_id) {
            return;
        }

        // Check permission.
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $reviewnews_post_id)) {
                return;
            }
        } else if (!current_user_can('edit_post', $reviewnews_post_id)) {
            return;
        }

        $reviewnews_content_layout = isset($_POST['reviewnews-meta-content-alignment']) ? $_POST['reviewnews-meta-content-alignment'] : '';
        $reviewnews_global_single_content_mode = isset($_POST['reviewnews-meta-content-mode']) ? $_POST['reviewnews-meta-content-mode'] : '';
        update_post_meta($reviewnews_post_id, 'reviewnews-meta-content-alignment', sanitize_text_field($reviewnews_content_layout));
        update_post_meta($reviewnews_post_id, 'reviewnews-meta-content-mode', sanitize_text_field($reviewnews_global_single_content_mode));


    }

endif;

add_action('save_post', 'reviewnews_save_layout_options_meta', 10, 2);


//Category fields meta starts


if (!function_exists('reviewnews_taxonomy_add_new_meta_field')) :
// Add term page
    function reviewnews_taxonomy_add_new_meta_field()
    {
        // this will add the custom meta field to the add new term page

        $reviewnews_cat_color = array(
            'category-color-1' => __('Category Color 1', 'reviewnews'),
            'category-color-2' => __('Category Color 2', 'reviewnews'),
            'category-color-3' => __('Category Color 3', 'reviewnews'),


        );
        ?>
        <div class="form-field">
            <label for="term_meta[color_class_term_meta]"><?php esc_html_e('Color Class', 'reviewnews'); ?></label>
            <select id="term_meta[color_class_term_meta]" name="term_meta[color_class_term_meta]">
                <?php foreach ($reviewnews_cat_color as $key => $value): ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description"><?php esc_html_e('Select category color class. You can set appropriate categories color on "Categories" section of the theme customizer.', 'reviewnews'); ?></p>
        </div>
        <?php
    }
endif;
add_action('category_add_form_fields', 'reviewnews_taxonomy_add_new_meta_field', 10, 2);


if (!function_exists('reviewnews_taxonomy_edit_meta_field')) :
// Edit term page
    function reviewnews_taxonomy_edit_meta_field($term)
    {

        // put the term ID into a variable
        $reviewnews_t_id = $term->term_id;

        // retrieve the existing value(s) for this meta field. This returns an array
        $reviewnews_term_meta = get_option("category_color_$reviewnews_t_id");

        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label
                        for="term_meta[color_class_term_meta]"><?php esc_html_e('Color Class', 'reviewnews'); ?></label></th>
            <td>
                <?php
                $reviewnews_cat_color = array(
                    'category-color-1' => __('Category Color 1', 'reviewnews'),
                    'category-color-2' => __('Category Color 2', 'reviewnews'),
                    'category-color-3' => __('Category Color 3', 'reviewnews'),


                );
                ?>
                <select id="term_meta[color_class_term_meta]" name="term_meta[color_class_term_meta]">
                    <?php foreach ($reviewnews_cat_color as $key => $value): ?>
                        <option value="<?php echo esc_attr($key); ?>"<?php selected(isset($reviewnews_term_meta['color_class_term_meta'])?$reviewnews_term_meta['color_class_term_meta']:'', $key); ?>><?php echo esc_html($value); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="description"><?php esc_html_e('Select category color class. You can set appropriate categories color on "Categories" section of the theme customizer.', 'reviewnews'); ?></p>
            </td>
        </tr>
        <?php
    }
endif;
add_action('category_edit_form_fields', 'reviewnews_taxonomy_edit_meta_field', 10, 2);




if (!function_exists('reviewnews_save_taxonomy_color_class_meta')) :
// Save extra taxonomy fields callback function.
    function reviewnews_save_taxonomy_color_class_meta($reviewnews_term_id)
    {
        if (isset($_POST['term_meta'])) {
            $reviewnews_t_id = $reviewnews_term_id;
            $reviewnews_term_meta = get_option("category_color_$reviewnews_t_id");
            $reviewnews_cat_keys = array_keys($_POST['term_meta']);
            foreach ($reviewnews_cat_keys as $key) {
                if (isset ($_POST['term_meta'][$key])) {
                    $reviewnews_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option("category_color_$reviewnews_t_id", $reviewnews_term_meta);
        }
    }

endif;
add_action('edited_category', 'reviewnews_save_taxonomy_color_class_meta', 10, 2);
add_action('create_category', 'reviewnews_save_taxonomy_color_class_meta', 10, 2);



add_action('save_post', 'reviewnews_save_reading_time_meta');

function reviewnews_save_reading_time_meta($post_id)
{
    $reviewnews_show_read_mins = reviewnews_get_option('global_show_min_read');
    if($reviewnews_show_read_mins == 'no'){
      return;
    }
    
    // Avoid autosave & revisions
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;

    // Posts only
    if (get_post_type($post_id) !== 'post') return;

    // Raw content (fastest)
    $content = get_post_field('post_content', $post_id);

    // Strip tags + shortcodes (light + safe)
    $clean_text = wp_strip_all_tags(strip_shortcodes($content), true);

    // Count words
    $word_count = str_word_count($clean_text);

    // Words per minute
    $wpm = absint(reviewnews_get_option('global_show_min_read_number'));
    if (!$wpm) {
        $wpm = 200;
    }

    // Calculate minutes
    $minutes = ceil($word_count / $wpm);

    // Store
    update_post_meta($post_id, '_aft_read_time', $minutes);
}