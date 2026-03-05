<?php
if (!class_exists('ReviewNews_Express_Posts_List')) :
    /**
     * Adds ReviewNews_Express_Posts_List widget.
     */
    class ReviewNews_Express_Posts_List extends ReviewNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array(
                'reviewnews-express-posts-section-title',
                'reviewnews-number-of-posts',

            );
            $this->select_fields = array(

                'reviewnews-select-category',

            );

            $widget_ops = array(
                'classname' => 'reviewnews_express_posts_list_widget',
                'description' => __('Displays Express Posts from selected categories.', 'reviewnews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('reviewnews_express_posts_list', __('AFT Express Posts List', 'reviewnews'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         * @see WP_Widget::widget()
         *
         */

        public function widget($args, $instance)
        {

            $instance = parent::reviewnews_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */

            $reviewnews_express_section_title = apply_filters('widget_title', $instance['reviewnews-express-posts-section-title'], $instance, $this->id_base);
            $reviewnews_express_section_title = $reviewnews_express_section_title ? $reviewnews_express_section_title : "Express Post";

            $reviewnews_category = !empty($instance['reviewnews-select-category']) ? $instance['reviewnews-select-category'] : '0';



            $color_class = '';
            if(absint($reviewnews_category) > 0){
                $color_id = "category_color_" . $reviewnews_category;
                // retrieve the existing value(s) for this meta field. This returns an array
                $term_meta = get_option($color_id);
                $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
            }

            // open the widget container
            echo $args['before_widget'];
            ?>
            <section class="aft-blocks aft-featured-category-section af-list-post featured-cate-sec pad-v">
                <?php $reviewnews_featured_express_posts_one = reviewnews_get_posts(5, $reviewnews_category); ?>

                <div class="af-main-banner-categorized-posts express-posts layout-1">
                    <div class="section-wrapper clearfix">
                        <div class="small-grid-style clearfix">
                            <?php

                            if ($reviewnews_featured_express_posts_one->have_posts()) :
                                ?>
                                <?php if (!empty($reviewnews_express_section_title)): ?>
                                <?php reviewnews_render_section_title($reviewnews_express_section_title, $color_class); ?>
                            <?php endif; ?>
                                <div class="featured-post-items-wrap clearfix af-container-row af-widget-body">
                                    <?php
                                    $reviewnews_count = 1;
                                    while ($reviewnews_featured_express_posts_one->have_posts()) :
                                        $reviewnews_featured_express_posts_one->the_post();
                                        global $post;
                                        $reviewnews_first_section_class = '';
                                        if ($reviewnews_count == 1): ?>
                                            <div class="col-2 pad float-l af-sec-post <?php echo esc_html($reviewnews_first_section_class); ?>">
                                                <?php do_action('reviewnews_action_loop_grid', $post->ID, 'grid-design-default', 'reviewnews-medium', true); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-2 pad float-l list-part af-sec-post">
                                                <?php do_action('reviewnews_action_loop_list', $post->ID, 'thumbnail', 0, true, true, false); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        $reviewnews_count++;
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            <?php endif;
                            ?>
                        </div>

                    </div>
                </div>
            </section>
            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @param array $instance Previously saved values from database.
         * @see WP_Widget::form()
         *
         */
        public function form($instance)
        {
            $this->form_instance = $instance;


            //print_pre($terms);
            $categories = reviewnews_get_terms();


            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::reviewnews_generate_text_input('reviewnews-express-posts-section-title', __('Title', 'reviewnews'), 'Express Posts List');
                echo parent::reviewnews_generate_select_options('reviewnews-select-category', __('Select Category', 'reviewnews'), $categories);


            }

            //print_pre($terms);


        }

    }
endif;