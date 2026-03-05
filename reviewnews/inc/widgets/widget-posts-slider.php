<?php
if (!class_exists('ReviewNews_Posts_Slider')) :
    /**
     * Adds ReviewNews_Posts_Slider widget.
     */
    class ReviewNews_Posts_Slider extends ReviewNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('reviewnews-posts-slider-title','reviewnews-number-of-posts');
            $this->select_fields = array('reviewnews-select-category');

            $widget_ops = array(
                'classname' => 'reviewnews_posts_slider_widget aft-widget',
                'description' => __('Displays posts slider from selected category.', 'reviewnews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('reviewnews_posts_slider', __('AFT Posts Slider', 'reviewnews'), $widget_ops);
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
            $reviewnews_posts_slider_title = apply_filters('widget_title', $instance['reviewnews-posts-slider-title'], $instance, $this->id_base);
            $widget_no_title_class = empty($reviewnews_posts_slider_title) ? 'aft-widgets-no-title' : '';
            $reviewnews_category = isset($instance['reviewnews-select-category']) ? $instance['reviewnews-select-category'] : 0;


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
            <?php
            
            ?>
            <section class="aft-blocks pad-v <?php echo esc_attr($widget_no_title_class)?>">
                <div class="af-slider-wrap">
    
                    <?php if (!empty($reviewnews_posts_slider_title)): ?>
                        <?php reviewnews_render_section_title($reviewnews_posts_slider_title, $color_class); ?>
                    <?php endif; ?>
                    <div class="widget-block widget-wrapper af-widget-body">
                        <div class="af-posts-slider af-widget-post-slider posts-slider banner-slider-2  af-posts-slider af-widget-carousel af-cat-widget-carousel slick-wrapper">
                            <?php
                                $reviewnews_slider_posts = reviewnews_get_posts(3, $reviewnews_category);
                                if ($reviewnews_slider_posts->have_posts()) :
                                    while ($reviewnews_slider_posts->have_posts()) : $reviewnews_slider_posts->the_post();
            
                                        global $post;

                                        ?>
                                        <div class="slick-item">
                                            <?php do_action('reviewnews_action_loop_grid', $post->ID, 'grid-design-texts-over-image', 'reviewnews-large'); ?>
                                        </div>
                                    <?php
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                            ?>
                        </div>
                        <div class="af-widget-post-slider-navcontrols af-slick-navcontrols"></div>
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
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;
            

            $categories = reviewnews_get_terms();
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::reviewnews_generate_text_input('reviewnews-posts-slider-title', __('Title', 'reviewnews'), 'Posts Slider');

                echo parent::reviewnews_generate_select_options('reviewnews-select-category', __('Select category', 'reviewnews'), $categories);

            }
        }
    }
endif;