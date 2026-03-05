<?php
if (!class_exists('ReviewNews_author_info')) :
  /**
   * Adds ReviewNews_author_info widget.
   */
  class ReviewNews_author_info extends ReviewNews_Widget_Base
  {
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct()
    {
      $this->text_fields = array('reviewnews-author-info-title', 'reviewnews-author-info-subtitle', 'reviewnews-author-info-image', 'reviewnews-author-info-name', 'reviewnews-author-info-desc', 'reviewnews-author-info-phone', 'reviewnews-author-info-email');
      $this->url_fields = array('reviewnews-author-info-facebook', 'reviewnews-author-info-twitter', 'reviewnews-author-info-linkedin', 'reviewnews-author-info-instagram', 'reviewnews-author-info-vk', 'reviewnews-author-info-youtube', 'reviewnews-author-info-tiktok');

      $widget_ops = array(
        'classname' => 'reviewnews_author_info_widget aft-widget',
        'description' => __('Displays author info.', 'reviewnews'),
        'customize_selective_refresh' => false,
      );

      parent::__construct('reviewnews_author_info', __('AFT Author Info', 'reviewnews'), $widget_ops);
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

      $reviewnews_featured_news_title = apply_filters('widget_title', $instance['reviewnews-author-info-title'], $instance, $this->id_base);


      $profile_image = isset($instance['reviewnews-author-info-image']) ? ($instance['reviewnews-author-info-image']) : '';

      if ($profile_image) {
        $image_attributes = wp_get_attachment_image_src($profile_image, 'large');
        $image_src = $image_attributes[0];
        $image_class = 'data-bg data-bg-hover';
      } else {
        $image_src = '';
        $image_class = 'no-bg';
      }

      $name = isset($instance['reviewnews-author-info-name']) ? ($instance['reviewnews-author-info-name']) : '';

      $desc = isset($instance['reviewnews-author-info-desc']) ? ($instance['reviewnews-author-info-desc']) : '';
      $facebook = isset($instance['reviewnews-author-info-facebook']) ? ($instance['reviewnews-author-info-facebook']) : '';
      $twitter = isset($instance['reviewnews-author-info-twitter']) ? ($instance['reviewnews-author-info-twitter']) : '';
      $youtube = isset($instance['reviewnews-author-info-youtube']) ? ($instance['reviewnews-author-info-youtube']) : '';


      echo $args['before_widget'];
?>
      <section class="aft-blocks af-author-info pad-v">
        <div class="af-author-info-wrap">
          <?php if (!empty($reviewnews_featured_news_title)): ?>
            <?php reviewnews_render_section_title($reviewnews_featured_news_title); ?>
          <?php endif; ?>
          <div class="widget-block widget-wrapper af-widget-body">
            <div class="posts-author-wrapper">

              <?php if (!empty($image_src)) : ?>


                <figure class="read-img af-author-img">
                  <img src="<?php echo esc_attr($image_src); ?>" alt="" />
                </figure>

              <?php endif; ?>
              <div class="af-author-details">
                <?php if (!empty($name)) : ?>
                  <h3 class="af-author-display-name"><?php echo esc_html($name); ?></h3>
                <?php endif; ?>
                <?php if (!empty($desc)) : ?>
                  <p class="af-author-display-name"><?php echo esc_html($desc); ?></p>
                <?php endif; ?>

                <?php if (!empty($facebook) || !empty($twitter) || !empty($youtube)) : ?>
                  <div class="social-navigation aft-small-social-menu">
                    <ul>
                      <?php if (!empty($facebook)) : ?>
                        <li>
                          <a href="<?php echo esc_url($facebook); ?>" target="_blank" aria-label="Facebook"></a>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($twitter)) : ?>
                        <li>
                          <a href="<?php echo esc_url($twitter); ?>" target="_blank" aria-label="Twitter"></a>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($youtube)) : ?>
                        <li>
                          <a href="<?php echo esc_url($youtube); ?>" target="_blank" aria-label="Youtube"></a>
                        </li>
                      <?php endif; ?>




                    </ul>
                  </div>
                <?php endif; ?>
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
        echo parent::reviewnews_generate_text_input('reviewnews-author-info-title', __('About Author', 'reviewnews'), __('Title', 'reviewnews'));

        echo parent::reviewnews_generate_image_upload('reviewnews-author-info-image', __('Profile image', 'reviewnews'), __('Profile image', 'reviewnews'));
        echo parent::reviewnews_generate_text_input('reviewnews-author-info-name', __('Name', 'reviewnews'), __('Name', 'reviewnews'));
        echo parent::reviewnews_generate_text_input('reviewnews-author-info-desc', __('Descriptions', 'reviewnews'), '');
        echo parent::reviewnews_generate_text_input('reviewnews-author-info-facebook', __('Facebook', 'reviewnews'), '');
        echo parent::reviewnews_generate_text_input('reviewnews-author-info-twitter', __('Twitter', 'reviewnews'), '');
        echo parent::reviewnews_generate_text_input('reviewnews-author-info-youtube', __('YouTube', 'reviewnews'), '');
      }
    }
  }
endif;
