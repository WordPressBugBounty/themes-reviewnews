<?php

/**
 * ReviewNews AMP Compatibility Module
 */

if (! defined('ABSPATH')) {
  exit; // No direct access
}

if (! class_exists('ReviewNews_AMP_Module')) {

  class ReviewNews_AMP_Module
  {

    /**
     * Singleton instance
     *
     * @var ReviewNews_AMP_Module
     */
    private static $instance = null;

    /**
     * Get the class instance
     *
     * @return ReviewNews_AMP_Module
     */
    public static function get_instance()
    {
      if (null === self::$instance) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct()
    {

      add_action('wp', array($this, 'reviewnews_init'));

      //add_action('init', array($this, 'reviewnews_init_hooks'), 100);
      //add_action('wp_loaded', array($this, 'reviewnews_init_new_hooks'), 40);
    }

    public function reviewnews_init()
    {
      if (!reviewnews_is_amp()) {
        return;
      } else {
        $this->reviewnews_init_hooks();
        $this->reviewnews_init_new_hooks();
      }
    }



    public function reviewnews_init_hooks()
    {


      add_filter('sidebars_widgets', array($this, 'morenws_amp_disable_sidebar_1'));
      remove_action('reviewnews_load_off_canvas', 'reviewnews_load_off_canvas_section');
      remove_action('reviewnews_action_main_menu_nav', 'reviewnews_main_menu_nav_section', 40);
      remove_action('reviewnews_load_search_form', 'reviewnews_load_search_form_section');
      //remove_action('reviewnews_load_watch_online', 'reviewnews_load_watch_online_section');

      remove_action('reviewnews_action_full_width_upper_footer_section', 'reviewnews_full_width_upper_footer_section');
      //remove_action('reviewnews_action_banner_advertisement', 'reviewnews_banner_advertisement', 10);
    }
    public function reviewnews_init_new_hooks()
    {
      add_action('wp_enqueue_scripts', array($this, 'reviewnews_style_amp_files'), 40);
      add_action('reviewnews_action_main_menu_nav', array($this, 'reviewnews_amp_custom_header'), 40);
      add_action('reviewnews_load_search_form', array($this, 'reviewnews_amp_search_form_section'));
    }
    public function reviewnews_style_amp_files()
    {
      $reviewnews_version = wp_get_theme()->get('Version');
      wp_enqueue_style('reviewnews-amp-style', get_template_directory_uri() . '/assets/css/amp.css', array(), $reviewnews_version);
      wp_dequeue_style('bootstrap');
      wp_dequeue_style('slick-css');
      wp_dequeue_style('sidr');
      wp_dequeue_style('magnific-popup');
      wp_dequeue_style('reviewnews-woocommerce-style');
      wp_dequeue_script('jquery');
      wp_dequeue_script('reviewnews-background-script');
      wp_dequeue_script('reviewnews-navigation');
      wp_dequeue_script('reviewnews-skip-link-focus-fix');
      wp_dequeue_script('slick');
      wp_dequeue_script('bootstrap');
      wp_dequeue_script('sidr');
      wp_dequeue_script('magnific-popup');
      wp_dequeue_script('matchheight');
      wp_dequeue_script('marquee');
      wp_dequeue_script('reviewnews-script');
      wp_dequeue_script('reviewnews-toggle-script');

      wp_dequeue_script('jquery-cookie');
      wp_dequeue_style('wp-block-library');
      wp_dequeue_style('wp-block-library-theme');
      wp_dequeue_style('block-style-variation-styles');
      wp_dequeue_script('reviewnews-fixed-header-script');
    }
    public function morenws_amp_disable_sidebar_1($sidebars_widgets)
    {
      if (is_single() || is_search() || is_archive()) {
        // Disable sidebar-1 on single posts
        $sidebars_widgets['sidebar-1'] = false;
        $sidebars_widgets['footer-first-widgets-section'] = false;
        $sidebars_widgets['footer-second-widgets-section'] = false;
        $sidebars_widgets['footer-third-widgets-section'] = false;
      }
      return $sidebars_widgets;
    }
    public function reviewnews_amp_custom_header()
    {
      $reviewnews_header_layout = reviewnews_get_option('header_layout');
      $select_header_image_mode = reviewnews_get_option('select_header_image_mode');
      $reviewnews_class = '';
      $reviewnews_background = '';
      $inline_style = '';
      if (has_header_image()) {


        if ($select_header_image_mode == 'above') {
          $reviewnews_class = 'af-header-image';
        } else {
          $reviewnews_class = 'af-header-image data-bg';
          $reviewnews_background = get_header_image();
          // Set inline style for background-image
          $inline_style = 'style="background-image: url(' . esc_url($reviewnews_background) . ');"';
        }
      }
?>

      <div class="navigation-container">
        <nav class="main-navigation clearfix">
          <amp-state id="menuToggled">
            <script type="application/json">
              false
            </script>
          </amp-state>
          <span class="toggle-menu">
            <a href="#" role="button"
              class="aft-void-menu"
              on="tap:AMP.setState({menuToggled: !menuToggled})"
              aria-expanded="false">
              <span class="screen-reader-text">
                <?php esc_html_e('Primary Menu', 'reviewnews'); ?>
              </span>
              <i class="ham" [class]="menuToggled ? 'ham exit' : 'ham'"></i>
            </a>
          </span>
          <div class="amp-mobile-menu" [class]="menuToggled ? 'amp-mobile-menu active':''" aria-expanded="false">
            <?php
            $reviewnews_global_show_home_menu = reviewnews_get_option('global_show_primary_menu_border');
            wp_nav_menu(array(
              'theme_location' => 'aft-primary-nav',
              'menu_id' => 'primary-menu',
              'menu_class' => 'menu menu-mobile',
              'container' => 'div',
              'container_class' => 'menu main-menu menu-desktop ' . $reviewnews_global_show_home_menu,
              'walker' => new AMP_Walker_Nav_Menu()
            ));
            ?>
          </div>

          <?php
          $reviewnews_global_show_home_menu = reviewnews_get_option('global_show_primary_menu_border');
          wp_nav_menu(array(
            'theme_location' => 'aft-primary-nav',
            'menu_id' => 'primary-menu',
            'menu_class' => 'menu menu-desktop',
            'container' => 'div',
            'container_class' => 'menu main-menu menu-desktop ' . esc_attr($reviewnews_global_show_home_menu),
          ));
          ?>

        </nav>
      </div>

    <?php }
    public function reviewnews_amp_search_form_section()
    { ?>
      <div class="search-watch">
        <div class="af-search-wrap">
          <div class="search-overlay" [class]="'search-overlay' + (ampSearch ? ' reveal-search' : '')" aria-label="<?php esc_attr_e('Open search form', 'reviewnews') ?>">
            <a href="#" title="Search"
              class="search-icon"
              on="tap:AMP.setState({ampSearch: !ampSearch})"
              aria-label="<?php esc_attr_e('Open search form', 'reviewnews') ?>">
              <i class="fa fa-search"></i>
            </a>
            <div class="af-search-form">
              <?php get_search_form(); ?>
            </div>
          </div>

        </div>
      </div>
<?php }
  }
}

// Kick it off
ReviewNews_AMP_Module::get_instance();
