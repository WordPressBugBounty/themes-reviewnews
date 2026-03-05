<?php
    if (!class_exists('ReviewNews_Featured_Post')) :
        /**
         * Adds ReviewNews_Featured_Post widget.
         */
        class ReviewNews_Featured_Post extends ReviewNews_Widget_Base
        {
            /**
             * Sets up a new widget instance.
             *
             * @since 1.0.0
             */
            function __construct()
            {
                $this->text_fields = array(
                    'reviewnews-featured-posts-title',
                    'reviewnews-number-of-posts'
                
                );
                $this->select_fields = array(
                    
                    'reviewnews-select-category',
                
                );
                
                $widget_ops = array(
                    'classname' => 'reviewnews_featured_posts_widget',
                    'description' => __('Displays grid from selected categories.', 'reviewnews'),
                    'customize_selective_refresh' => false,
                );
                
                parent::__construct('reviewnews_featured_posts', __('AFT Post Grid', 'reviewnews'), $widget_ops);
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
    
                $reviewnews_featured_news_title = apply_filters('widget_title', $instance['reviewnews-featured-posts-title'], $instance, $this->id_base);
    

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
                <section class="aft-blocks af-main-banner-featured-posts pad-v">
                    <div class="af-main-banner-featured-posts featured-posts">
                        <?php if (!empty($reviewnews_featured_news_title)): ?>
                            <?php reviewnews_render_section_title($reviewnews_featured_news_title, $color_class); ?>
                        <?php endif; ?>
                        <div class="section-wrapper af-widget-body">
                            <div class="af-container-row clearfix">
                                <?php
                                    $reviewnews_featured_posts = reviewnews_get_posts(3, $reviewnews_category);
                                    if ($reviewnews_featured_posts->have_posts()) :
                                        while ($reviewnews_featured_posts->have_posts()) :
                                            $reviewnews_featured_posts->the_post();
                                            global $post;
                                            ?>
                                            <div class="col-4 pad float-l ">
                                                <?php do_action('reviewnews_action_loop_grid', $post->ID); ?>
                                            </div>
                                        <?php endwhile;
                                    endif;
                                    wp_reset_postdata();
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
                    echo parent::reviewnews_generate_text_input('reviewnews-featured-posts-title', __('Title', 'reviewnews'), 'Posts Grid');
                    echo parent::reviewnews_generate_select_options('reviewnews-select-category', __('Select Category', 'reviewnews'), $categories);

                }
                
                //print_pre($terms);
                
                
            }
            
        }
    endif;