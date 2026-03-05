<?php

if (!class_exists('ReviewNews_Trending_Posts')) :
  /**
   * Adds ReviewNews_Prime_News widget.
   */
  class ReviewNews_Trending_Posts extends ReviewNews_Widget_Base
  {
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct()
    {
      $this->text_fields = array(
        'reviewnews-trending-news-title',
        'reviewnews-number-of-posts',

      );
      $this->select_fields = array(

        'reviewnews-news_filter-by',
        'reviewnews-select-category',

      );

      $widget_ops = array(
        'classname' => 'reviewnews_trending_news_widget',
        'description' => __('Displays grid from selected categories.', 'reviewnews'),
        'customize_selective_refresh' => false,
      );

      parent::__construct('reviewnews_trending_news', __('AFT Trending News', 'reviewnews'), $widget_ops);
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

      // wp_enqueue_style('slick');
      // wp_enqueue_script('slick');
      $instance = parent::reviewnews_sanitize_data($instance, $instance);

      $reviewnews_trending_news_section_title = apply_filters('widget_title', $instance['reviewnews-trending-news-title'], $instance, $this->id_base);
      $widget_no_title_class = empty($reviewnews_trending_news_section_title) ? 'aft-widgets-no-title' : '';
      $reviewnews_no_of_post = 5;
      $reviewnews_category = !empty($instance['reviewnews-select-category']) ? $instance['reviewnews-select-category'] : '0';

      $color_class = '';
      if (absint($reviewnews_category) > 0) {
        $color_id = "category_color_" . $reviewnews_category;
        // retrieve the existing value(s) for this meta field. This returns an array
        $term_meta = get_option($color_id);
        $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
      }

      // open the widget container
      echo $args['before_widget']; ?>
      <div class="full-wid-resp pad-v <?php echo esc_attr($widget_no_title_class) ?>">
        <?php

        if (!empty($reviewnews_trending_news_section_title)) { ?>
          <?php reviewnews_render_section_title($reviewnews_trending_news_section_title, $color_class); ?>
        <?php }
        ?>
        <div class="slick-wrapper af-trending-widget-carousel af-post-carousel-list banner-vertical-slider af-widget-carousel af-widget-body">

          <?php

          $reviewnews_filterby = 'cat';
          $reviewnews_number_of_posts = 1;
          if ($reviewnews_no_of_post) {
            $reviewnews_number_of_posts = $reviewnews_no_of_post;
          }


          $reviewnews_featured_posts = reviewnews_get_posts($reviewnews_number_of_posts, $reviewnews_category, $reviewnews_filterby);
          if ($reviewnews_featured_posts->have_posts()) :
            $reviewnews_count = 1;
            while ($reviewnews_featured_posts->have_posts()) :
              $reviewnews_featured_posts->the_post();
              global $post;

          ?>
              <div class="slick-item pad">
                <div class="aft-trending-posts list-part af-sec-post">
                  <?php do_action('reviewnews_action_loop_list', $post->ID, 'thumbnail', $reviewnews_count, true, true, false); ?>
                </div>
              </div>
            <?php
              $reviewnews_count++;
            endwhile;
            wp_reset_postdata();
            ?>
          <?php endif; ?>

        </div>
        <div class="af-widget-trending-carousel-navcontrols af-slick-navcontrols"></div>
      </div>
<?php echo $args['after_widget'];
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


      $trending_news_layout = array(
        'layout-1' => "Layout 1",
        'layout-2' => "Layout 1"
      );
      $trending_news_filterby = array(
        'cat' => "Category",
        'tag' => "Tag"
      );
      $featured_image = array(
        'yes' => 'Yes',
        'no' => 'No'
      );
      $categories = reviewnews_get_terms();

      echo parent::reviewnews_generate_text_input('reviewnews-trending-news-title', __('Title', 'reviewnews'), 'Trending News');
      echo parent::reviewnews_generate_select_options('reviewnews-select-category', __('Select Category', 'reviewnews'), $categories);
    }
  }

endif;
