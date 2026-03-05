<?php

/**
 * Customizer callback functions for active_callback.
 *
 * @package ReviewNews
 */

/*select page for trending news*/
if (!function_exists('reviewnews_flash_posts_section_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_flash_posts_section_status($control)
  {

    if (true == $control->manager->get_setting('show_flash_news_section')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;

/*select page for reviewnews_show_date_on_header news*/
if (!function_exists('reviewnews_top_header_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_top_header_status($control)
  {

    if (true == $control->manager->get_setting('show_top_header_section')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;

/*select page for reviewnews_show_date_on_header news*/
if (!function_exists('reviewnews_show_time_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_show_time_status($control)
  {

    if (true == $control->manager->get_setting('show_time_section')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_global_site_mode_light_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_global_site_mode_light_status($control)
  {

    if (('aft-default-mode' == $control->manager->get_setting('global_site_mode_setting')->value())) {
      return true;
    } else {
      return false;
    }
  }

endif;

/*select page for slider*/
if (!function_exists('reviewnews_global_site_mode_dark_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_global_site_mode_dark_status($control)
  {

    if (('aft-dark-mode' == $control->manager->get_setting('global_site_mode_setting')->value())) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_main_banner_section_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_main_banner_section_status($control)
  {

    if (true == $control->manager->get_setting('show_main_news_section')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;







/*select page for slider*/
if (!function_exists('reviewnews_main_banner_section_filterby_cat_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_main_banner_section_filterby_cat_status($control)
  {

    if ('cat' == $control->manager->get_setting('select_main_banner_carousel_filterby')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;




/*select page for slider*/
if (!function_exists('reviewnews_main_banner_section_filterby_tag_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_main_banner_section_filterby_tag_status($control)
  {

    if ('tag' == $control->manager->get_setting('select_main_banner_carousel_filterby')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;









/*select page for slider*/
if (!function_exists('reviewnews_show_watch_online_section_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_show_watch_online_section_status($control)
  {

    if (true == $control->manager->get_setting('show_watch_online_section')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;




/*select page for slider*/
if (!function_exists('reviewnews_editors_picks_section_filterby_cat_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_editors_picks_section_filterby_cat_status($control)
  {

    if ('cat' == $control->manager->get_setting('select_editors_picks_filterby')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_editors_picks_section_filterby_tag_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_editors_picks_section_filterby_tag_status($control)
  {

    if ('tag' == $control->manager->get_setting('select_editors_picks_filterby')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_editors_picks_section_filterby_cat_status_2')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_editors_picks_section_filterby_cat_status_2($control)
  {

    if ('cat' == $control->manager->get_setting('select_editors_picks_filterby_2')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_editors_picks_section_filterby_tag_status_2')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_editors_picks_section_filterby_tag_status_2($control)
  {

    if ('tag' == $control->manager->get_setting('select_editors_picks_filterby_2')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select post*/
if (!function_exists('reviewnews_featured_posts_section')) :

  /**
   * Check if ticker section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_featured_posts_section($control)
  {

    if (true == $control->manager->get_setting('show_featured_posts_section')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;

/*select page for slider*/
if (!function_exists('reviewnews_featured_post_list_section_status')) :

  /**
   * Check if ticker section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_featured_post_list_section_status($control)
  {

    if (true == $control->manager->get_setting('show_featured_post_list_section')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;







/*select page for slider*/
if (!function_exists('frontpage_sticky_sidebar_status')) :

  /**
   * Check if ticker section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function frontpage_sticky_sidebar_status($control)
  {

    if (true == $control->manager->get_setting('frontpage_sticky_sidebar')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_latest_news_section_status')) :

  /**
   * Check if ticker section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_latest_news_section_status($control)
  {

    if (true == $control->manager->get_setting('frontpage_show_latest_posts')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_archive_image_status')) :

  /**
   * Check if archive no image is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_archive_image_status($control)
  {

    if ('archive-layout-list' == $control->manager->get_setting('archive_layout')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;






/*related posts*/
if (!function_exists('reviewnews_related_posts_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_related_posts_status($control)
  {

    if (true == $control->manager->get_setting('single_show_related_posts')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;





/*select page for slider*/
if (!function_exists('reviewnews_global_show_category_number_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_global_show_category_number_status($control)
  {

    if ('yes' == $control->manager->get_setting('global_show_categories')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_global_show_custom_category_number_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_global_show_custom_category_number_status($control)
  {

    if ('custom' == $control->manager->get_setting('global_number_of_categories')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;






/*related posts*/
if (!function_exists('reviewnews_single_post_social_share_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_single_post_social_share_status($control)
  {

    if ('none' != $control->manager->get_setting('single_post_social_share_type')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('reviewnews_disable_header_image_tint_overlay_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_disable_header_image_tint_overlay_status($control)
  {

    if (('default' == $control->manager->get_setting('select_header_image_mode')->value()) || ('full' == $control->manager->get_setting('select_header_image_mode')->value())) {
      return true;
    } else {
      return false;
    }
  }

endif;


/*select page for slider*/
if (!function_exists('global_font_family_type_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function global_font_family_type_status($control)
  {

    if ('google' == $control->manager->get_setting('global_font_family_type')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;

/*related posts*/
if (!function_exists('reviewnews_featured_image_status')) :

  /**
   * Check if slider section page/post is active.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Control $control WP_Customize_Control instance.
   *
   * @return bool Whether the control is active to the current preview.
   */
  function reviewnews_featured_image_status($control)
  {

    if (true == $control->manager->get_setting('single_show_featured_image')->value()) {
      return true;
    } else {
      return false;
    }
  }

endif;

if (!function_exists('reviewnews_is_inactive_builder')) :

  function reviewnews_is_inactive_builder($control)
  {

    if (false == $control->manager->get_setting('reviewnews_afthfb_show_checkbox_header')->value()) {
      return true;
    } else {
      return false;
    }
  }
endif;
if (!function_exists('reviewnews_is_inactive_footer_builder')) :
  function reviewnews_is_inactive_footer_builder($control)
  {

    if (false == $control->manager->get_setting('reviewnews_afthfb_show_checkbox_footer')->value()) {
      return true;
    } else {
      return false;
    }
  }
endif;
if (!function_exists('reviewnews_is_active_builder_header')) :
  function reviewnews_is_active_builder_header($control)
  {
    return (bool) $control->manager->get_setting('reviewnews_afthfb_show_checkbox_header')->value();
  }
endif;

if (!function_exists('reviewnews_is_active_builder_footer')) :
  function reviewnews_is_active_builder_footer($control)
  {
    return (bool) $control->manager->get_setting('reviewnews_afthfb_show_checkbox_footer')->value();
  }
endif;
