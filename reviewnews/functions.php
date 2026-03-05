<?php

/**
 * ReviewNews functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ReviewNews
 */

/**
 * Define Theme Constants.
 */

defined('ESHF_COMPATIBILITY_TMPL') or define('ESHF_COMPATIBILITY_TMPL', 'reviewnews');

/**
 * ReviewNews functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ReviewNews
 */

if (!function_exists('reviewnews_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  /**
   *
   */
  /**
   *
   */
  function reviewnews_setup()
  {
    /** 
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on ReviewNews, use a find and replace
     * to change 'reviewnews' to the name of your theme in all the template files.
     */
    // load_theme_textdomain('reviewnews', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
    add_theme_support('title-tag');

    /**
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */

    add_theme_support('post-thumbnails');
    add_theme_support('rtl');
    // Add featured image sizes    
    add_image_size('reviewnews-large', 825, 575, true); // width, height, crop
    add_image_size('reviewnews-medium', 590, 410, true); // width, height, crop



    /*
         * Enable support for Post Formats on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/post-formats/
         */
    add_theme_support('post-formats', array('image', 'video', 'gallery'));

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
      'aft-primary-nav' => esc_html__('Primary Menu', 'reviewnews'),
      'aft-social-nav' => esc_html__('Social Menu', 'reviewnews'),
      'aft-footer-nav' => esc_html__('Footer Menu', 'reviewnews'),
    ));

    /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('reviewnews_custom_background_args', array(
      'default-color' => 'f5f5f5',
      'default-image' => '',
    )));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');



    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support('custom-logo', array(
      'flex-width' => true,
      'flex-height' => true,
    ));
    // Add AMP support
    add_theme_support('amp');

    /** 
     * Add theme support for gutenberg block
     */
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('appearance-tools');
    add_theme_support('custom-spacing');
    add_theme_support('custom-units');
    add_theme_support('custom-line-height');
    add_theme_support('border');
    add_theme_support('link-color');
  }
endif;
add_action('after_setup_theme', 'reviewnews_setup');


function reviewnews_is_amp()
{
  return function_exists('is_amp_endpoint') && is_amp_endpoint();
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function reviewnews_content_width()
{
  $GLOBALS['content_width'] = apply_filters('reviewnews_content_width', 640);
}

add_action('after_setup_theme', 'reviewnews_content_width', 0);
/**
 * Supported local fonts and their match patterns.
 */
function reviewnews_get_local_fonts() {
  return [
      'inter'      => 'inter.css',
      'oswald'     => 'oswald.css',
      'open sans'  => 'open-sans.css',
      'open+sans'  => 'open-sans.css',
      'noto sans'  => 'noto-sans.css',
      'noto+sans'  => 'noto-sans.css',
  ];
}

function reviewnews_add_font_css_resource_hints($urls, $relation_type) {
  if ($relation_type !== 'preload') {
      return $urls;
  }

  if (function_exists('reviewnews_is_amp') && reviewnews_is_amp()) {
      return $urls;
  }

  if (reviewnews_get_option('global_font_family_type') !== 'google') {
      return $urls;
  }

  $primary   = strtolower(trim(reviewnews_get_option('primary_font')));
  $secondary = strtolower(trim(reviewnews_get_option('secondary_font')));
  $base_css  = get_template_directory_uri() . '/assets/fonts/css/';
  $fonts     = reviewnews_get_local_fonts();

  foreach ($fonts as $key => $file) {
      if (strpos($primary, $key) !== false || strpos($secondary, $key) !== false) {
          $urls[] = esc_url($base_css . $file);
      }
  }

  return $urls;
}
add_filter('wp_resource_hints', 'reviewnews_add_font_css_resource_hints', 10, 2);

function reviewnews_enqueue_local_font_css() {
  if (reviewnews_get_option('global_font_family_type') !== 'google') {
      return;
  }

  $primary   = strtolower(trim(reviewnews_get_option('primary_font')));
  $secondary = strtolower(trim(reviewnews_get_option('secondary_font')));
  $base_css  = get_template_directory_uri() . '/assets/fonts/css/';
  $fonts     = reviewnews_get_local_fonts();

  $loaded = []; // Prevent duplicates

  foreach ($fonts as $key => $file) {

      if (strpos($primary, $key) !== false || strpos($secondary, $key) !== false) {
          if (!in_array($file, $loaded)) {
              wp_enqueue_style('reviewnews-font-' . $key, $base_css . $file, [], null);
              $loaded[] = $file;
          }
      }
  }
}
add_action('wp_enqueue_scripts', 'reviewnews_enqueue_local_font_css', 5);


/**
 * Enqueue local editor fonts properly for the block editor.
 */
function reviewnews_enqueue_block_editor_fonts() {

  // Load only inside the block editor.
  $screen = function_exists('get_current_screen') ? get_current_screen() : null;
  if (!$screen || !method_exists($screen, 'is_block_editor') || !$screen->is_block_editor()) {
      return;
  }

  if (reviewnews_get_option('global_font_family_type') !== 'google') {
      return;
  }

  $primary_font = strtolower(trim(reviewnews_get_option('primary_font')));
  $font_stack   = "system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif";

  $fonts   = reviewnews_get_local_fonts(); // ← uses your optimized font registry
  $css_url = '';
  $chosen_font_family = $font_stack;

  // Detect which local font matches the primary font.
  foreach ($fonts as $key => $file) {
      if (strpos($primary_font, $key) !== false) {

          // Build front-facing font-family name (normalize casing).
          $pretty_name = ucwords(str_replace(['+', '-'], ' ', $key));

          // For "open+sans" → "Open Sans"
          $pretty_name = str_replace('Sans Sans', 'Sans', $pretty_name);

          $chosen_font_family = "'{$pretty_name}', {$font_stack}";
          $css_url            = get_template_directory_uri() . '/assets/fonts/css/' . $file;
          break;
      }
  }

  // Ensure a handle exists.
  if ($css_url) {
      wp_enqueue_style('reviewnews-editor-font', $css_url, [], null);
  } else {
      wp_register_style('reviewnews-editor-font', false);
      wp_enqueue_style('reviewnews-editor-font');
  }

  // Inline editor styles.
  $inline_css = "
      body.editor-styles-wrapper,
      .editor-post-title__input,
      .wp-block {
          font-family: {$chosen_font_family};
          line-height: 1.7;
      }

      .editor-styles-wrapper {
          font-size: 16px;
      }

      /* Match frontend link underline */
      .editor-styles-wrapper p a,
      .editor-styles-wrapper .wp-block-table a,
      .editor-styles-wrapper .wp-block-list a,
      .editor-styles-wrapper .wp-block-quote a,
      .editor-styles-wrapper .wp-block-heading a,
      .editor-styles-wrapper .wp-block-paragraph a,
      .editor-styles-wrapper .wp-block-code a,
      .editor-styles-wrapper .wp-block-preformatted a {
          border-bottom: 2px solid;
          text-decoration: none;
      }
  ";

  wp_add_inline_style('reviewnews-editor-font', $inline_css);
}
add_action('enqueue_block_assets', 'reviewnews_enqueue_block_editor_fonts');




/**
 * Load Init for Hook files.
 */
require get_template_directory() . '/inc/custom-style.php';



add_action('wp_enqueue_scripts', 'reviewnews_style_files');
function reviewnews_style_files()
{

  $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
  $reviewnews_version = wp_get_theme()->get('Version');

  // --- Core Icon / Base Styles ---
  wp_register_style('aft-icons', get_template_directory_uri() . '/assets/icons/style.css', array(), $reviewnews_version, 'all');
  wp_enqueue_style('aft-icons');
  wp_enqueue_style('slick');
  // --- Vendor Styles (register first for conditional loading) ---
  
  wp_register_style('slick', get_template_directory_uri() . '/assets/slick/css/slick' . $min . '.css', array(), $reviewnews_version, 'all');
  wp_register_style('sidr', get_template_directory_uri() . '/assets/sidr/css/jquery.sidr.dark.css', array(), $reviewnews_version, 'all');
  wp_register_style('magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/magnific-popup.css', array(), $reviewnews_version, 'all');

  // --- Conditional Builder Styles ---
  $show_header_checkbox = reviewnews_get_option('reviewnews_afthfb_show_checkbox_header');
  $show_footer_checkbox = reviewnews_get_option('reviewnews_afthfb_show_checkbox_footer');

  if ($show_header_checkbox) {
    wp_register_style('morenew-header-builder', get_template_directory_uri() . '/assets/css/header-builder.css', array(), $reviewnews_version, 'all');
    wp_enqueue_style('morenew-header-builder');
  }

  if ($show_footer_checkbox) {
    wp_register_style('morenew-footer-builder', get_template_directory_uri() . '/assets/css/footer-builder.css', array(), $reviewnews_version, 'all');
    wp_enqueue_style('morenew-footer-builder');
  }

  // --- WooCommerce Styles (only load if active) ---
  if (class_exists('WooCommerce')) {
    wp_register_style('reviewnews-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), $reviewnews_version, 'all');
    wp_enqueue_style('reviewnews-woocommerce-style');

    // Inline WooCommerce star font for compatibility
    $font_path = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
            font-family: "star";
            src: url("' . $font_path . 'star.eot");
            src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                 url("' . $font_path . 'star.woff") format("woff"),
                 url("' . $font_path . 'star.ttf") format("truetype"),
                 url("' . $font_path . 'star.svg#star") format("svg");
            font-weight: normal;
            font-style: normal;
        }';
    wp_add_inline_style('reviewnews-woocommerce-style', $inline_font);
  }

  // --- Conditional Vendor Loads (to reduce unused CSS) ---
  if (is_front_page() || is_home()) {
    
    wp_enqueue_style('slick');
    wp_enqueue_style('sidr');
  }

  if (is_singular()) {
   
    wp_enqueue_style('magnific-popup');
  }

  // --- Core Theme Styles ---
  wp_register_style('reviewnews-style', get_template_directory_uri() . '/style' . $min . '.css', array('aft-icons'), $reviewnews_version, 'all');
  wp_enqueue_style('reviewnews-style');

  // --- Inline Custom CSS from Customizer ---
  wp_add_inline_style('reviewnews-style', reviewnews_custom_style());
}


/**
 * Enqueue scripts.
 */

function reviewnews_scripts()
{

  $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
  $reviewnews_version = wp_get_theme()->get('Version');

  // --- Register Core Scripts ---
  wp_register_script('reviewnews-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $reviewnews_version, true);
  wp_register_script('reviewnews-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $reviewnews_version, true);
  wp_register_script('reviewnews-script', get_template_directory_uri() . '/admin-dashboard/dist/reviewnews_scripts.build.js', array('jquery'), $reviewnews_version, true);

  // --- Small Helper Scripts ---
  wp_register_script('jquery-cookie', get_template_directory_uri() . '/assets/jquery.cookie.js', array('jquery'), $reviewnews_version, true);
  wp_register_script('reviewnews-toggle-script', get_template_directory_uri() . '/assets/toggle-script.js', array('jquery-cookie'), $reviewnews_version, true);

  // --- Vendor / Heavy Libraries (conditionally enqueued later) ---

  wp_register_script('slick', get_template_directory_uri() . '/assets/slick/js/slick' . $min . '.js', array('jquery'), $reviewnews_version, true);
  wp_register_script('sidr', get_template_directory_uri() . '/assets/sidr/js/jquery.sidr' . $min . '.js', array('jquery'), $reviewnews_version, true);
  wp_register_script('magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/jquery.magnific-popup' . $min . '.js', array('jquery'), $reviewnews_version, true);
  wp_register_script('magnific-popup-script', get_template_directory_uri() . '/assets/magnific-popup-script.js', array('jquery'), $reviewnews_version, true);
  wp_register_script('matchheight', get_template_directory_uri() . '/assets/jquery-match-height/jquery.matchHeight' . $min . '.js', array('jquery'), $reviewnews_version, true);
  wp_register_script('marquee', get_template_directory_uri() . '/admin-dashboard/dist/reviewnews_marque_scripts.build.js', array('jquery'), $reviewnews_version, true);
  wp_register_script('marquee-script', get_template_directory_uri() . '/assets/marquee-script.js', array('jquery'), $reviewnews_version, true);
  wp_register_script('reviewnews-background-script', get_template_directory_uri() . '/assets/background-script.js', array('jquery'), $reviewnews_version, true);

  // --- Defer non-critical libraries ---
  $defer_handles = array('slick', 'sidr', 'magnific-popup', 'marquee');
  foreach ($defer_handles as $handle) {
    if (wp_script_is($handle, 'registered')) {
      wp_script_add_data($handle, 'strategy', 'defer');
    }
  }

  // --- Enqueue Core Scripts (always needed) ---

  wp_enqueue_script('reviewnews-navigation');
  wp_enqueue_script('reviewnews-skip-link-focus-fix');
  wp_enqueue_script('reviewnews-script');
  wp_enqueue_script('reviewnews-background-script');
  wp_enqueue_script('slick');
  // Sidr for mobile menu or single page layouts
  wp_enqueue_script('sidr');
  // --- Conditional Feature Scripts ---
  // Sticky Header
  if (!reviewnews_get_option('disable_sticky_header_option')) {
    wp_register_script('reviewnews-fixed-header-script', get_template_directory_uri() . '/assets/fixed-header-script.js', array('jquery'), $reviewnews_version, true);
    wp_enqueue_script('reviewnews-fixed-header-script');
  }

  $top_header_time_format = reviewnews_get_option('top_header_time_format');
  $localized_time_format = array();
  if ($top_header_time_format == 'en-US' || $top_header_time_format == 'en-GB') {
    $localized_time_format['format'] = $top_header_time_format;
    wp_localize_script('reviewnews-script', 'AFlocalizedTime', $localized_time_format);
  }
  
  // Toggle / Cookie handling (for mode switch or user prefs)
  if (reviewnews_get_option('enable_site_mode_switch') == 'aft-enable-mode-switch') {
    wp_enqueue_script('jquery-cookie');
    wp_enqueue_script('reviewnews-toggle-script');
  }

  // --- Conditional Page-Level Enqueues ---
  if (is_front_page() || is_home()) {

    wp_enqueue_script('marquee');
    wp_enqueue_script('marquee-script');
    wp_enqueue_script('matchheight');
  }

  if (is_archive() || is_search()) {
    wp_enqueue_script('matchheight');
  }

  if (is_singular()) {
    $post_content = get_post_field('post_content', get_the_ID());

    // Gallery/lightbox only if shortcode exists
    if ($post_content && (has_shortcode($post_content, 'gallery') || has_shortcode($post_content, 'nggallery'))) {
      wp_enqueue_script('magnific-popup');
      wp_enqueue_script('magnific-popup-script');
    }
  }

  // --- Localize Scripts ---
  if (wp_script_is('reviewnews-script', 'enqueued')) {
    wp_localize_script('reviewnews-script', 'reviewnews_ajax', array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce'    => wp_create_nonce('reviewnews_nonce'),
    ));
  }

  // --- Comment Reply (WordPress Core) ---
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'reviewnews_scripts', 20);



/**
 * Enqueue admin scripts and styles.
 *
 * @since ReviewNews 1.0.0
 */
function reviewnews_admin_scripts($hook)
{
  if ('widgets.php' === $hook) {
    wp_enqueue_media();
    wp_enqueue_script('reviewnews-widgets', get_template_directory_uri() . '/assets/widgets.js', array('jquery'), '1.0.0', true);
  }

  wp_enqueue_style('reviewnews-notice', get_template_directory_uri() . '/assets/css/notice.css');
}

add_action('admin_enqueue_scripts', 'reviewnews_admin_scripts');

add_action('elementor/editor/before_enqueue_scripts', 'reviewnews_admin_scripts');






/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Multi Author tags for this theme.
 */
require get_template_directory() . '/inc/multi-author.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-images.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/init.php';



/**
 * Functions which enhance AMP Compatibility
 */

require get_template_directory() . '/inc/class-amp-compatible.php';
require get_template_directory() . '/inc/class-walker-menu.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
  require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
  require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Descriptions on Header Menu
 * @author AF themes
 * @param string $item_output , HTML outputp for the menu item
 * @param object $item , menu item object
 * @param int $depth , depth in menu structure
 * @param object $args , arguments passed to wp_nav_menu()
 * @return string $item_output
 */
function reviewnews_header_menu_desc($item_output, $item, $depth, $args)
{
  $show_primary_menu_desc = reviewnews_get_option('show_primary_menu_desc');
  if ($show_primary_menu_desc) {
    if (isset($args->theme_location) && 'aft-primary-nav' == $args->theme_location && $item->description)
      $item_output = str_replace('</a>', '<span class="menu-description">' . $item->description . '</span></a>', $item_output);
  }


  return $item_output;
}

add_filter('walker_nav_menu_start_el', 'reviewnews_header_menu_desc', 10, 4);

function reviewnews_menu_notitle($menu)
{
  return $menu = preg_replace('/ title=\"(.*?)\"/', '', $menu);
}
add_filter('wp_nav_menu', 'reviewnews_menu_notitle');
add_filter('wp_page_menu', 'reviewnews_menu_notitle');
add_filter('wp_list_categories', 'reviewnews_menu_notitle');



function reviewnews_print_pre($args)
{
  if ($args) {
    echo "<pre>";
    print_r($args);
    echo "</pre>";
  } else {
    echo "<pre>";
    print_r('Empty');
    echo "</pre>";
  }
}

add_action('init', 'reviewnews_transltion_init', 99);

function reviewnews_transltion_init()
{
  load_theme_textdomain('reviewnews', get_template_directory()  . '/languages');
}


require_once get_template_directory() . '/inc/customizer/builder/options.php';
function reviewnews_afthfb_load_files()
{
  // Only load in admin or customizer context
  if (!is_admin() && !is_customize_preview()) {
    return;
  }

  // Include files in the correct order
  require_once get_template_directory() . '/inc/customizer/builder/class-header-footer-builder.php';
  require_once get_template_directory() . '/inc/customizer/builder/class-header-footer-builder-control.php';
  require_once get_template_directory() . '/inc/customizer/builder/class-block-toggle.php';
}

// Load files when WordPress is ready and customizer classes are available
add_action('customize_register', 'reviewnews_afthfb_load_files', 1);
function reviewnews_afthfb_loadFiles()
{
  $loadHeader = reviewnews_get_option('reviewnews_afthfb_show_checkbox_header');
  $loadFooter = reviewnews_get_option('reviewnews_afthfb_show_checkbox_footer');
  // if ($loadHeader || $loadFooter) {
  require_once get_template_directory() . '/inc/customizer/builder/builder-structure.php';
  require_once get_template_directory() . '/inc/customizer/builder/header-builder-structure.php';
  require_once get_template_directory() . '/inc/customizer/builder/footer-builder-structure.php';
  // }
}


add_action('init', 'reviewnews_afthfb_loadFiles');
/**
 * Always load theme integration for frontend
 */


/**
 * Initialize the Header Footer Builder
 */
function reviewnews_afthfb_init()
{
  // Only initialize if we're in the right context
  if (class_exists('ReviewNews_Header_Footer_Builder')) {
    ReviewNews_Header_Footer_Builder::get_instance();
  }
}
add_action('admin_init', 'reviewnews_afthfb_init');
