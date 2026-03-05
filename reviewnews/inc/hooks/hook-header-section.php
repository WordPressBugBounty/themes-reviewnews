<?php
if (!function_exists('reviewnews_header_section')) :
  /**
   * Banner Slider
   *
   * @since ReviewNews 1.0.0
   *
   */
  function reviewnews_header_section()
  {

    // $reviewnews_header_layout = reviewnews_get_option('header_layout');
    $reviewnews_header_layout = reviewnews_get_option('header_layout');




?>

    <header id="masthead" class="<?php echo esc_attr($reviewnews_header_layout); ?> reviewnews-header">
      <?php reviewnews_get_block('layout-default', 'header'); ?>

    </header>

    <!-- end slider-section -->
  <?php
  }
endif;
add_action('reviewnews_action_header_section', 'reviewnews_header_section', 40);


if (!function_exists('reviewnews_header_section_builder')) :
  /**
   * Banner Slider
   *
   * @since ReviewNews 1.0.0
   *
   */
  function reviewnews_header_section_builder()
  {


  ?>

    <header id="masthead" class="header-layout-side reviewnews-header">
      <?php reviewnews_afthfb_render_header_builder(); ?>
    </header>

    <!-- end slider-section -->
  <?php
  }
endif;
add_action('reviewnews_action_header_section_builder', 'reviewnews_header_section_builder', 40);

//Load main nav menu
if (!function_exists('reviewnews_main_menu_nav_section')) :

  function reviewnews_main_menu_nav_section()
  {

  ?>
    <div class="navigation-container">
      <nav class="main-navigation clearfix">

        <span class="toggle-menu" >
          <a href="#" role="button" class="aft-void-menu" aria-controls="primary-menu" aria-expanded="false">
            <span class="screen-reader-text">
              <?php esc_html_e('Primary Menu', 'reviewnews'); ?>
            </span>
            <i class="ham"></i>
          </a>
        </span>


        <?php
        $reviewnews_global_show_home_menu = reviewnews_get_option('global_show_primary_menu_border');
        wp_nav_menu(array(
          'theme_location' => 'aft-primary-nav',
          'menu_id' => 'primary-menu',
          'container' => 'div',
          'container_class' => 'menu main-menu menu-desktop ' . $reviewnews_global_show_home_menu,
        ));
        ?>
      </nav>
    </div>


  <?php }
endif;

add_action('reviewnews_action_main_menu_nav', 'reviewnews_main_menu_nav_section', 40);

//load search form
if (!function_exists('reviewnews_load_search_form_section')) :

  function reviewnews_load_search_form_section()
  {
  ?>
    <div class="af-search-wrap">
      <div class="search-overlay" aria-label="<?php esc_attr_e('Open search form', 'reviewnews') ?>">
        <a href="#" title="Search" class="search-icon" aria-label="<?php esc_attr_e('Open search form', 'reviewnews') ?>">
          <i class="fa fa-search"></i>
        </a>
        <div class="af-search-form">
          <?php get_search_form(); ?>
          <!-- Live Search Results -->
          <div id="af-live-search-results"></div>
        </div>
      </div>
    </div>

    <?php }

endif;
add_action('reviewnews_load_search_form', 'reviewnews_load_search_form_section');


//watch online
if (!function_exists('reviewnews_load_watch_online_section')) :

  function reviewnews_load_watch_online_section()
  {

    $reviewnews_aft_enable_custom_link = reviewnews_get_option('show_watch_online_section');
    if ($reviewnews_aft_enable_custom_link) :
      $reviewnews_aft_custom_link = reviewnews_get_option('aft_custom_link');
      $reviewnews_aft_custom_link = !empty($reviewnews_aft_custom_link) ? $reviewnews_aft_custom_link : '#';
      $reviewnews_aft_custom_icon = reviewnews_get_option('aft_custom_icon');
      $reviewnews_aft_custom_title = reviewnews_get_option('aft_custom_title');
      if (!empty($reviewnews_aft_custom_title)) :
    ?>
        <div class="custom-menu-link">
          <a href="<?php echo esc_url($reviewnews_aft_custom_link); ?>" aria-label="<?php echo esc_attr('View ' . $reviewnews_aft_custom_title, 'reviewnews'); ?>">

            <?php if (!empty($reviewnews_aft_custom_icon)) : ?>

              <i class="<?php echo esc_attr($reviewnews_aft_custom_icon); ?>"></i>
            <?php endif; ?>
            <?php echo esc_html($reviewnews_aft_custom_title); ?>
          </a>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php }

endif;
add_action('reviewnews_load_watch_online', 'reviewnews_load_watch_online_section');

//Load off canvas section
if (!function_exists('reviewnews_load_off_canvas_section')) :

  function reviewnews_load_off_canvas_section()
  {
    if (is_active_sidebar('express-off-canvas-panel')) :
    ?>

      <span class="offcanvas">
        <a href="#" class="offcanvas-nav" role="button" aria-label="Open off-canvas menu" aria-expanded="false" aria-controls="offcanvas-menu">
          <div class="offcanvas-menu">
            <span class="mbtn-top"></span>
            <span class="mbtn-mid"></span>
            <span class="mbtn-bot"></span>
          </div>
        </a>
      </span>
    <?php
    endif;
  }

endif;
add_action('reviewnews_load_off_canvas', 'reviewnews_load_off_canvas_section');

//load date part
if (!function_exists('reviewnews_load_date_section')) :
  function reviewnews_load_date_section()
  {
    $reviewnews_show_date = reviewnews_get_option('show_date_section');
    $reviewnews_show_time = reviewnews_get_option('show_time_section');
    if ($reviewnews_show_date == true || $reviewnews_show_time == true) : ?>
      <span class="topbar-date">
        <?php
        $datetime = '';
        if ($reviewnews_show_date == true) {
          $datetime .= date_i18n(get_option('date_format'), current_time('timestamp'));
        }

        if ($reviewnews_show_time == true) {
          $reviewnews_top_header_time_format = reviewnews_get_option('top_header_time_format');
          if ($reviewnews_top_header_time_format == 'en-US' || $reviewnews_top_header_time_format == 'en-GB') {
            $datetime .=  ' <span id="topbar-time"></span>';
          } else {
            $datetime .=  ' <span id="topbar-time-wp">';
            $datetime .=  date_i18n(get_option('time_format'), current_time('timestamp'));
            $datetime .=  '</span>';
          }
        }

        echo wp_kses_post($datetime);
        ?>
      </span>
    <?php endif;
  }
endif;
add_action('reviewnews_load_date', 'reviewnews_load_date_section');

//load social icon menu
if (!function_exists('reviewnews_load_social_menu_section')) :

  function reviewnews_load_social_menu_section()
  {
    ?>
    <?php
    $reviewnews_show_social_menu = reviewnews_get_option('show_social_menu_section');
    if (has_nav_menu('aft-social-nav') && $reviewnews_show_social_menu == true) : ?>

      <?php
      wp_nav_menu(array(
        'theme_location' => 'aft-social-nav',
        'link_before' => '<span class="screen-reader-text">',
        'link_after' => '</span>',
        'container' => 'div',
        'container_class' => 'social-navigation'
      ));
      ?>

    <?php endif; ?>
  <?php }

endif;

add_action('reviewnews_load_social_menu', 'reviewnews_load_social_menu_section');

//Load site branding section

if (!function_exists('reviewnews_load_site_branding_section')) :
  function reviewnews_load_site_branding_section()
  {
    $reviewnews_class = '';
    $reviewnews_site_title_uppercase = reviewnews_get_option('site_title_uppercase');
    if ($reviewnews_site_title_uppercase) {
      $reviewnews_class = 'uppercase-site-title';
    }
  ?>
    <div class="site-branding <?php echo esc_attr($reviewnews_class); ?>">
      <?php
      the_custom_logo();
      if (is_front_page() || is_home()) : ?>
        <h1 class="site-title font-family-1">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-anchor" rel="home"><?php bloginfo('name'); ?></a>
        </h1>
      <?php else : ?>
        <p class="site-title font-family-1">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-anchor" rel="home"><?php bloginfo('name'); ?></a>
        </p>
      <?php endif; ?>

      <?php
      $reviewnews_description = get_bloginfo('description', 'display');
      if ($reviewnews_description || is_customize_preview()) : ?>
        <p class="site-description"><?php echo esc_html($reviewnews_description); ?></p>
      <?php
      endif; ?>
    </div>

    <?php }

endif;
add_action('reviewnews_load_site_branding', 'reviewnews_load_site_branding_section');


//watch online
if (!function_exists('reviewnews_dark_and_light_mode_section')) :

  function reviewnews_dark_and_light_mode_section()
  {
    $reviewnews_enable_site_mode_switch = reviewnews_get_option('enable_site_mode_switch');
    if ($reviewnews_enable_site_mode_switch == 'aft-enable-mode-switch') :
      $reviewnews_global_site_mode_setting = reviewnews_get_option('global_site_mode_setting');

      if (isset($_COOKIE["reviewnews-stored-site-mode"])) {
        $reviewnews_global_site_mode_setting = $_COOKIE["reviewnews-stored-site-mode"];
      } else {
        if (!empty($reviewnews_global_site_mode_setting)) {
          $reviewnews_global_site_mode_setting = $reviewnews_global_site_mode_setting;
        }
      }
    ?>
      <div id="aft-dark-light-mode-wrap">
        <a href="javascript:void(0)" class="<?php echo esc_attr($reviewnews_global_site_mode_setting); ?>" data-site-mode="<?php echo esc_attr($reviewnews_global_site_mode_setting); ?>" id="aft-dark-light-mode-btn">
          <span class="aft-icon-circle"><?php esc_html_e('Light/Dark Button', 'reviewnews'); ?></span>
        </a>
      </div>
<?php
    endif;
  }

endif;
add_action('reviewnews_dark_and_light_mode', 'reviewnews_dark_and_light_mode_section');
