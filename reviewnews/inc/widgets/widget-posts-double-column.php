<?php
if (!class_exists('ReviewNews_Express_Posts_Double_Column')) :
    /**
     * Adds ReviewNews_Express_Posts_Double_Column widget.
     */
    class ReviewNews_Express_Posts_Double_Column extends ReviewNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array(
                'reviewnews-posts-list-title-1',
                'reviewnews-posts-list-title-2',
                'reviewnews-posts-slider-number'

            );
            $this->select_fields = array(

                'reviewnews-select-category-1',
                'reviewnews-select-category-2',

            );

            $widget_ops = array(
                'classname' => 'reviewnews_posts_double_columns_widget',
                'description' => __('Displays grid from selected categories.', 'reviewnews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('reviewnews_posts_double_column', __('AFT Post Double Columns', 'reviewnews'), $widget_ops);
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




            for ($reviewnews_i = 1; $reviewnews_i <= 2; $reviewnews_i++) {
                $reviewnews_section_title = apply_filters('widget_title', $instance['reviewnews-posts-list-title-' . $reviewnews_i], $instance, $this->id_base);
                $reviewnews_category = !empty($instance['reviewnews-select-category-' . $reviewnews_i]) ? $instance['reviewnews-select-category-' . $reviewnews_i] : '0';
                $reviewnews_featured_categories['feature_' . $reviewnews_i][] = $reviewnews_category;
                $reviewnews_featured_categories['feature_' . $reviewnews_i][] = $reviewnews_section_title;



                $color_class = '';
                if(absint($reviewnews_category) > 0){
                    $color_id = "category_color_" . $reviewnews_category;
                    // retrieve the existing value(s) for this meta field. This returns an array
                    $term_meta = get_option($color_id);
                    $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
                }
                $reviewnews_featured_categories['feature_' . $reviewnews_i][] = $color_class;

            }

            // open the widget container
            echo $args['before_widget'];
            if (isset($reviewnews_featured_categories)): ?>

                <div class="af-container-row pad-v clearfix">
                    <?php
                    foreach ($reviewnews_featured_categories as $reviewnews_fc): ?>
                        <div class="col-2 pad float-l af-sec-post">
                            <?php if (!empty($reviewnews_fc[1])): ?>
                                <?php reviewnews_render_section_title($reviewnews_fc[1], $reviewnews_fc[2]); ?>
                            <?php endif; ?>

                            <?php $reviewnews_all_posts_vertical = reviewnews_get_posts(3, $reviewnews_fc[0]); ?>
                            <div class="full-wid-resp af-widget-body">
                                <?php
                                if ($reviewnews_all_posts_vertical->have_posts()) :
                                    $reviewnews_count = 1;
                                    while ($reviewnews_all_posts_vertical->have_posts()) : $reviewnews_all_posts_vertical->the_post();
                                        global $post;
                                        if ($reviewnews_count == 1):
                                            ?>
                                            <div class="af-sec-post">
                                                <?php do_action('reviewnews_action_loop_grid', $post->ID, 'grid-design-default', 'reviewnews-medium'); ?>
                                            </div>
                                        <?php else: ?>
                                            <?php do_action('reviewnews_action_loop_list', $post->ID, 'thumbnail', 0, true, true, false); ?>
                                        <?php
                                        endif;
                                        $reviewnews_count++;
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div><!--featured-category-item-->
                    <?php

                    endforeach; ?>

                </div>
            <?php
            endif;

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
                echo parent::reviewnews_generate_text_input('reviewnews-posts-list-title-1', __('Title', 'reviewnews'), 'Post Double Columns 1');
                echo parent::reviewnews_generate_text_input('reviewnews-posts-list-title-2', __('Title', 'reviewnews'), 'Post Double Columns 2');
                echo parent::reviewnews_generate_select_options('reviewnews-select-category-1', __('Select Category 1', 'reviewnews'), $categories);
                echo parent::reviewnews_generate_select_options('reviewnews-select-category-2', __('Select Category 2', 'reviewnews'), $categories);
                     }

            //print_pre($terms);


        }

    }
endif;