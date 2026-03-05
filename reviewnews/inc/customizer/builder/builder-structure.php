<?php

if (!function_exists('reviewnews_afthfb_render_header_builder')) {
  function reviewnews_afthfb_render_header_builder()
  {
    $header_data = get_option('header_builder_data', reviewnews_afthfb_get_default_header_structure());

    $header_structure = json_decode($header_data, true);
    if (!$header_structure) {
      return;
    }

    wp_enqueue_style('morenew_builder');

    reviewnews_afthfb_render_builder_structure($header_structure, 'header');
  }
}

/**
 * Render Footer Builder
 */
if (!function_exists('reviewnews_afthfb_render_footer_builder')) {

  function reviewnews_afthfb_render_footer_builder()
  {

    $footer_data = get_option('footer_builder_data', reviewnews_afthfb_get_default_footer_structure());
    $footer_structure = json_decode($footer_data, true);
    if (!$footer_structure) {
      return;
    }

    reviewnews_afthfb_render_footer_structure($footer_structure, 'footer');
  }
}


if (!function_exists('reviewnews_afthfb_render_element')) {
  function reviewnews_afthfb_render_element($element, $context)
  {
    if (!isset($element['type']) || !isset($element['id'])) {
      return;
    }

    $element_type = $element['type'];
    $element_id = $element['id'];


    switch ($element_type) {
      case 'header_logo':
        reviewnews_afthfb_render_logo_element($element_id, $context);
        break;
      case 'header_navigation':
        reviewnews_afthfb_render_navigation_element($element_id, $context);
        break;

      case 'header_promotion':
        reviewnews_afthfb_render_promotion_element($element_id, $context);
        break;
      case 'header_off_canvas':
        reviewnews_afthfb_render_header_off_canvas_element($element_id, $context);
        break;
      case 'header_date';
        reviewnews_afthfb_render_header_date_element($element_id, $context);
        break;


      case 'header_site_mode';
        reviewnews_afthfb_render_header_site_mode_element($element_id, $context);
        break;


      case 'header_search':

        reviewnews_afthfb_render_search_element($element_id, $context);
        break;
      case 'header_button':

        reviewnews_afthfb_render_button_element($element_id, $context);
        break;

      case 'header_social_icons':
        reviewnews_afthfb_render_social_icons_element($element_id, $context);
        break;
      //Footer Part
      case 'footer_navigation':
        reviewnews_afthfb_render_footer_navigation_element($element_id, $context);
        break;

      case 'footer_date';
        reviewnews_afthfb_render_header_date_element($element_id, $context);
        break;
      case 'footer_site_mode';
        reviewnews_afthfb_render_header_site_mode_element($element_id, $context);
        break;



      case 'footer_search':
        reviewnews_afthfb_render_search_element($element_id, $context);
        break;

      case 'footer_button':

        reviewnews_afthfb_render_button_element($element_id, $context);
        break;

      case 'footer_social_icons': // Added specific case for footer social icons
        reviewnews_afthfb_render_social_icons_element($element_id, $context); // Re-use existing render function if logic is same
        break;
      case 'footer_copyright':
        reviewnews_afthfb_render_copyright_element($element_id);
        break;

      case 'footer_widget_1':
        reviewnews_afthfb_render_footer_widget_element($element_id, $context, 1);
        break;
      case 'footer_widget_2':
        reviewnews_afthfb_render_footer_widget_element($element_id, $context, 2);
        break;
      case 'footer_widget_3':
        reviewnews_afthfb_render_footer_widget_element($element_id, $context, 3);
        break;

        //
    }
  }
}


/**
 * Render Logo Element
 */
if (!function_exists('reviewnews_afthfb_render_logo_element')) {
  function reviewnews_afthfb_render_logo_element($element_id)
  {

    do_action('reviewnews_load_site_branding');
  }
}

/**
 * Render Offcanvas
 */

if (!function_exists('reviewnews_afthfb_render_header_off_canvas_element')) {
  function reviewnews_afthfb_render_header_off_canvas_element($element_id, $context)
  {
    if (!reviewnews_is_amp()) {
      if (is_active_sidebar('express-off-canvas-panel')) : ?>

        <div class="off-cancas-panel">
          <?php do_action('reviewnews_load_off_canvas'); ?>
        </div>

        <?php
      endif;
    }
  }
}

/**
 * Render Promotion
 */
if (!function_exists('reviewnews_afthfb_render_promotion_element')) {
  function reviewnews_afthfb_render_promotion_element($element_id, $context)
  {
    $reviewnews_banner_advertisement = reviewnews_get_option('banner_advertisement_section');
    if (('' != $reviewnews_banner_advertisement) || is_active_sidebar('home-advertisement-widgets')) {
      $reviewnews_banner_advertisement_scope = reviewnews_get_option('banner_advertisement_scope');

      if ($reviewnews_banner_advertisement_scope == 'front-page-only') :
        if (is_home() || is_front_page()) : ?>

          <?php do_action('reviewnews_action_banner_advertisement'); ?>

        <?php endif;
      else : ?>

        <?php do_action('reviewnews_action_banner_advertisement'); ?>

    <?php endif;
    }
  }
}
/**
 * Render Navigation Element
 */
if (!function_exists('reviewnews_afthfb_render_navigation_element')) {
  function reviewnews_afthfb_render_navigation_element($element_id, $context)
  { ?>


    <div class="navigation-container">
      <nav class="main-navigation clearfix">
        <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
          <a href="#" role="button" class="aft-void-menu" aria-expanded="false">
            <span class="screen-reader-text">
              <?php esc_html_e('Primary Menu', 'reviewnews'); ?>
            </span>
            <i class="ham"></i>
          </a>
        </span>
        <?php
        $menu_id = 'aft-primary-nav'; //get_option("reviewnews_afthfb_{$context}_navigation_menu_id", '');
        $reviewnews_global_show_home_menu = reviewnews_get_option('global_show_primary_menu_border');
        // // Check if a menu is assigned and has items
        // $locations = get_nav_menu_locations();
        // $has_menu_items = !empty($menu_id) && !empty($locations[$menu_id]);

        $has_menu_items = reviewnews_afthfb_has_menu_items($menu_id);


        if ($has_menu_items) {
          wp_nav_menu(array(
            'theme_location'  => $menu_id,
            'container'       => 'div',
            'menu_class'      => 'menu menu-desktop',
            'fallback_cb'     => false,
            'container_class' => 'menu main-menu menu-desktop ' . $reviewnews_global_show_home_menu
          ));
        } else {

          wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'menu_id' => 'primary-menu',
            'menu_class' => 'menu menu-mobile',
            'container' => 'div',
            'container_class' => 'menu main-menu menu-desktop show-menu-border' . $reviewnews_global_show_home_menu

          ));
        }
        ?>
      </nav>
    </div>
    <?php


  }
}

if (!function_exists('reviewnews_afthfb_render_footer_navigation_element')) {
  function reviewnews_afthfb_render_footer_navigation_element($element, $context)
  {
    //$menu_id = get_option("reviewnews_afthfb_{$context}_navigation_menu_id", '');
    $menu_id = 'aft-footer-nav';
    $has_menu_items = reviewnews_afthfb_has_menu_items($menu_id);

    //var_dump($has_menu_items);
    if ($has_menu_items) {
      wp_nav_menu(array(
        'theme_location' => $menu_id,
        'menu_id' => 'footer-menu',
        'depth' => 1,
        'container' => 'div',
        'container_class' => 'footer-navigation footer-nav-wrapper'
      ));
    }
  }
}

/**
 * Render Search Element
 */
if (!function_exists('reviewnews_afthfb_render_search_element')) {
  function reviewnews_afthfb_render_search_element($element_id, $contex)
  {


    if ($contex === 'header') {
      do_action('reviewnews_load_search_form');
    } else {
      get_search_form();
    }
  }
}


/**
 * Render Button Element
 */
if (!function_exists('reviewnews_afthfb_render_button_element')) {
  function reviewnews_afthfb_render_button_element($element_id, $context)
  {

    // $reviewnews_aft_enable_custom_link = reviewnews_get_option('show_watch_online_section');

    $reviewnews_aft_custom_link = reviewnews_get_option('aft_custom_link');
    $reviewnews_aft_custom_link = !empty($reviewnews_aft_custom_link) ? $reviewnews_aft_custom_link : '#';
    $reviewnews_aft_custom_icon = reviewnews_get_option('aft_custom_icon');
    $reviewnews_aft_custom_title = reviewnews_get_option('aft_custom_title');
    if (!empty($reviewnews_aft_custom_title)):
    ?>
      <div class="custom-menu-link">
        <a href="<?php echo esc_url($reviewnews_aft_custom_link); ?>" aria-label="<?php echo esc_attr('View ' . $reviewnews_aft_custom_title, 'reviewnews'); ?>">

          <?php if (!empty($reviewnews_aft_custom_icon)): ?>

            <i class="<?php echo esc_attr($reviewnews_aft_custom_icon); ?>"></i>
          <?php endif; ?>
          <?php echo esc_html($reviewnews_aft_custom_title); ?>
        </a>
      </div>
    <?php endif;
  }
}

/**
 * Render Social Icons Element (used for both generic and footer-specific social icons)
 */
if (!function_exists('reviewnews_afthfb_render_social_icons_element')) {
  function reviewnews_afthfb_render_social_icons_element($element_id, $context)
  {
    $menu_id = 'aft-social-nav';

    $has_menu_items = reviewnews_afthfb_has_menu_items($menu_id);

    if ($has_menu_items) { ?>
      <div class="aft-small-social-menu">
        <?php
        if ($menu_id) {
          wp_nav_menu(array(
            'theme_location' => 'aft-social-nav',
            'link_before' => '<span class="screen-reader-text">',
            'link_after' => '</span>',
            'container' => 'div',
            'container_class' => 'social-navigation'
          ));
        }
        ?>
      </div>
    <?php
    } else { ?>
      <div class="top-navigation clearfix">
        <?php

        wp_nav_menu(array(
          'theme_location' => 'primary-menu',
          'menu_id' => 'top-navigation',
          'menu_class' => 'menu menu-mobile',
          'container' => 'div',
          'container_class' => 'menu main-menu menu-desktop show-menu-border'

        ));
        ?>
      </div>
    <?php
    }
  }
}

/**
 * Render Copyright Element
 */
if (!function_exists('reviewnews_afthfb_render_copyright_element')) {
  function reviewnews_afthfb_render_copyright_element($element_id)
  {
    // Get the user's copyright text option
    $reviewnews_copy_right = reviewnews_get_option('footer_copyright_text');

    // Get the current year based on WordPress date settings
    $current_year = date_i18n('Y');

    // Replace {year} placeholder with the current year
    $reviewnews_copy_right = str_replace('{year}', $current_year, $reviewnews_copy_right);

    ?>
    <div class="athfb-copyright">
      <?php
      // Output the text if it is not empty
      if (!empty($reviewnews_copy_right)) {
        echo esc_html($reviewnews_copy_right);
      }
      ?>
      <?php $reviewnews_theme_credits = reviewnews_get_option('hide_footer_copyright_credits'); ?>
      <?php if ($reviewnews_theme_credits != 1) : ?>

        <span class="sep"> | </span>
        <?php
        /* translators: 1: Theme name, 2: Theme author. */
        printf(esc_html__('%1$s by %2$s.', 'reviewnews'), '<a href="https://afthemes.com/products/reviewnews/" target="_blank">ReviewNews</a>', 'AF themes');
        ?>

      <?php endif;
      ?>
    </div>
  <?php
  }
}



/**
 * Render header date
 */
if (!function_exists('reviewnews_afthfb_render_header_date_element')) {
  function reviewnews_afthfb_render_header_date_element($element_id, $context)
  {
    $date =   get_option('date_format', '');


    if (empty($date)) {
      $date = get_option('date_format', 'F j, Y');
    }



  ?>
    <div class="date-bar-left">
      <span class="topbar-date"><?php echo esc_html(date_i18n($date)); ?></span>
    </div>


<?php

  }
}

/**
 * Render Site mode
 */
if (!function_exists('reviewnews_afthfb_render_header_site_mode_element')) {
  function reviewnews_afthfb_render_header_site_mode_element($element_id, $context)
  {
    if (reviewnews_is_amp()) {
      return;
    }


    do_action('reviewnews_dark_and_light_mode');
  }
}


/**
 * 
 * Render Widget
 */
if (!function_exists('reviewnews_afthfb_render_footer_widget_element')) {
  function reviewnews_afthfb_render_footer_widget_element($element_id, $context, $widget_number)
  {

    if ($widget_number === 1) {
      $selected_sidebar_id = 'footer-first-widgets-section';
    } elseif ($widget_number === 2) {
      $selected_sidebar_id = 'footer-second-widgets-section';
    } else {
      $selected_sidebar_id = 'footer-third-widgets-section';
    }

    if (! empty($selected_sidebar_id) && is_active_sidebar($selected_sidebar_id)) {
      dynamic_sidebar($selected_sidebar_id);
    }
  }
}


if (!function_exists('reviewnews_afthfb_has_menu_items')) {
  function reviewnews_afthfb_has_menu_items($menu_location)
  {

    $locations = get_nav_menu_locations();

    $has_menu_items = false;

    if (isset($locations[$menu_location])) {
      $menu_id = $locations[$menu_location];
      // Get all menu items for the menu ID
      $menu_items = wp_get_nav_menu_items($menu_id);

      if (!empty($menu_items)) {
        $has_menu_items = true;
      }
    }
    return  $has_menu_items;
  }
}
