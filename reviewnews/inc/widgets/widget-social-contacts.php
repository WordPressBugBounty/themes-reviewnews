<?php
if (!class_exists('ReviewNews_Social_Contacts')) :
    /**
     * Adds ReviewNews_Social_Contacts widget.
     */
    class ReviewNews_Social_Contacts extends ReviewNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('reviewnews-social-contacts-title');
            $this->select_fields = array('reviewnews-select-background', 'reviewnews-select-background-type');

            $widget_ops = array(
                'classname' => 'reviewnews_social_contacts_widget aft-widget',
                'description' => __('Displays social contacts lists from selected settings.', 'reviewnews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('reviewnews_social_contacts', __('AFT Social Contacts', 'reviewnews'), $widget_ops);
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
            $reviewnews_section_title = apply_filters('widget_title', $instance['reviewnews-social-contacts-title'], $instance, $this->id_base);
            $reviewnews_section_title = isset($reviewnews_section_title) ? $reviewnews_section_title : __('Connect with Us', 'reviewnews');
            
            
            // open the widget container
            echo $args['before_widget'];
            ?>
                <div  class="widget-social-contancts-area af-social-contacts pad-v">


                    <?php
                        if (!empty($reviewnews_section_title)) { ?>
                            <?php reviewnews_render_section_title($reviewnews_section_title); ?>
                        <?php }
                    ?>
                    <div class="social-widget-menu af-widget-body">
                        <?php
                            if (has_nav_menu('aft-social-nav')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'aft-social-nav',
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                ));
                            } ?>
                    </div>
                    <?php if (!has_nav_menu('aft-social-nav')) : ?>
                        <p>
                            <?php esc_html_e('Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'reviewnews'); ?>
                        </p>
                    <?php endif; ?>

                </div>

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

            // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
            echo parent::reviewnews_generate_text_input('reviewnews-social-contacts-title', 'Title', 'Connect with Us');

        }


    }
endif;