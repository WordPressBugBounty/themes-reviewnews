<?php
if (!class_exists('ReviewNews_Express_Posts_Single_Column')) :
    /**
     * Adds ReviewNews_Express_Posts_Single_Column widget.
     */
    class ReviewNews_Express_Posts_Single_Column extends ReviewNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array(
                'reviewnews-posts-list-title',
                'reviewnews-posts-slider-number'

            );
            $this->select_fields = array(

                'reviewnews-select-category',

            );

            $widget_ops = array(
                'classname' => 'reviewnews_posts_single_column_widget',
                'description' => __('Displays posts single column from selected categories.', 'reviewnews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('reviewnews_posts_single_column', __('AFT Post Single Column', 'reviewnews'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {

            $instance = parent::reviewnews_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */

            $title_1 = apply_filters('widget_title', $instance['reviewnews-posts-list-title'], $instance, $this->id_base);


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
                <section class="aft-blocks aft-featured-category-section archive-list-post featured-cate-sec pad-v">
                    <?php if (!empty($title_1)): ?>
                        <?php reviewnews_render_section_title($title_1, $color_class); ?>
                    <?php endif; ?>
                    <?php $reviewnews_all_posts_vertical = reviewnews_get_posts(5, $reviewnews_category); ?>

                    <div class="full-wid-resp af-widget-body clearfix">
                        <?php
                            if ($reviewnews_all_posts_vertical->have_posts()) :
                                while ($reviewnews_all_posts_vertical->have_posts()) : $reviewnews_all_posts_vertical->the_post();
                                    global $post;

                                    ?>
                                    <div class="list-style">
                                        <?php do_action('reviewnews_action_loop_list', $post->ID, 'medium_large', 0, true, true, true, true); ?>
                                    </div>
                                <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                    </div>
                </section>
            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;


            //print_pre($terms);
            $categories = reviewnews_get_terms();



            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::reviewnews_generate_text_input('reviewnews-posts-list-title', __('Title', 'reviewnews'), 'Post Single Column');
                echo parent::reviewnews_generate_select_options('reviewnews-select-category', __('Select Category', 'reviewnews'), $categories);


            }

            //print_pre($terms);


        }

    }
endif;