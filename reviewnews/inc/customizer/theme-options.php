<?php

/**
 * Option Panel
 *
 * @package ReviewNews
 */

$reviewnews_default = reviewnews_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/customizer/frontpage-options.php';

//font and color options
require get_template_directory() . '/inc/customizer/font-color-options.php';

//selective refresh
require get_template_directory() . '/inc/customizer/customizer-refresh.php';


/**
 * Front-page options section
 *
 * @package ReviewNews
 */


// Add Front-page Options Panel.
$wp_customize->add_panel(
  'site_header_option_panel',
  array(
    'title' => __('Header Options', 'reviewnews'),
    'priority' => 198,
    'capability' => 'edit_theme_options',
    'type'     => 'reviewnews-panel',
  )
);

/**
 * Header section
 *
 * @package ReviewNews
 */

// Front-page Section.
$wp_customize->add_section(
  'header_options_settings',
  array(
    'title' => __('Header Settings', 'reviewnews'),
    'priority' => 49,
    'capability' => 'edit_theme_options',
    'panel' => 'site_header_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'enable_site_mode_switch',
  array(
    'default' => $reviewnews_default['enable_site_mode_switch'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'enable_site_mode_switch',
  array(
    'label' => __('Site Mode Switch', 'reviewnews'),
    'section' => 'header_builder',
    'settings' => 'enable_site_mode_switch',
    'type' => 'select',
    'choices' => array(
      'aft-enable-mode-switch' => __('Enable', 'reviewnews'),
      'aft-disable-mode-switch' => __('Disable', 'reviewnews'),
    ),
    'priority' => 5,
  )
);

// Setting - sticky_header_option.
$wp_customize->add_setting(
  'disable_sticky_header_option',
  array(
    'default'           => $reviewnews_default['disable_sticky_header_option'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);
$wp_customize->add_control(
  'disable_sticky_header_option',
  array(
    'label'    => __('Disable Sticky Header', 'reviewnews'),
    'section'  => 'header_builder',
    'type'     => 'checkbox',
    'priority' => 5,
    'description' => __('Sticky header works only with builder at bottom.', 'reviewnews'),

  )
);

//section title
$wp_customize->add_setting(
  'show_top_header_section_title',
  array(
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  new ReviewNews_Section_Title(
    $wp_customize,
    'show_top_header_section_title',
    array(
      'label' => __("Top Header Section", 'reviewnews'),
      'section' => 'header_builder',
      'priority' => 5,

    )
  )
);


// Setting - show_site_title_section.
$wp_customize->add_setting(
  'show_top_header_section',
  array(
    'default' => $reviewnews_default['show_top_header_section'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'show_top_header_section',
  array(
    'label' => __('Show Top Header', 'reviewnews'),
    'section' => 'header_builder',
    'settings' => 'show_top_header_section',
    'type' => 'checkbox',
    'priority' => 5,
    
  )
);


// Setting - show_site_title_section.
$wp_customize->add_setting(
  'show_date_section',
  array(
    'default' => $reviewnews_default['show_date_section'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);
$wp_customize->add_control(
  'show_date_section',
  array(
    'label' => __('Show Date', 'reviewnews'),
    'section' => 'header_builder',
    'type' => 'checkbox',
    'priority' => 5,
    'active_callback' => function ($control) {
      return (
        reviewnews_top_header_status($control)
        &&
        reviewnews_is_inactive_builder($control)
      );
    },
  )
);

// Setting - show_site_title_section.
$wp_customize->add_setting(
  'show_time_section',
  array(
    'default' => $reviewnews_default['show_time_section'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);
$wp_customize->add_control(
  'show_time_section',
  array(
    'label' => __('Show Time', 'reviewnews'),
    'section' => 'header_builder',
    'type' => 'checkbox',
    'priority' => 5,
    'active_callback' => 'reviewnews_top_header_status'
  )
);

// Setting - select_main_banner_section_mode.
$wp_customize->add_setting(
  'top_header_time_format',
  array(
    'default' => $reviewnews_default['top_header_time_format'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'top_header_time_format',
  array(
    'label' => __('Time Format', 'reviewnews'),
    'section' => 'header_builder',
    'type' => 'select',
    'choices' => array(
      'en-US' => __('12 hours', 'reviewnews'),
      'en-GB' => __('24 hours', 'reviewnews'),
      'en-WP' => __('From WordPress Settings', 'reviewnews'),
    ),
    'priority' => 5,
    'active_callback' => function ($control) {
      return (
        reviewnews_top_header_status($control)
        &&
        reviewnews_show_time_status($control)


      );
    },

  )
);


// Advertisement Section.
$wp_customize->add_section(
  'frontpage_advertisement_settings',
  array(
    'title' => __('Header Advertisement', 'reviewnews'),
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'panel' => 'site_header_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);



//section title
$wp_customize->add_setting(
  'banner_advertisement_section_title',
  array(
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  new ReviewNews_Section_Title(
    $wp_customize,
    'banner_advertisement_section_title',
    array(
      'label' => __("Header Advertisement", 'reviewnews'),
      'section' => 'header_builder',
      'priority' => 120,

    )
  )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting(
  'banner_advertisement_section',
  array(
    'default' => $reviewnews_default['banner_advertisement_section'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',
  )
);




$wp_customize->add_control(
  new WP_Customize_Cropped_Image_Control(
    $wp_customize,
    'banner_advertisement_section',
    array(
      'label' => __('Header Section Advertisement', 'reviewnews'),
      'description' => esc_html(sprintf(__('Recommended Size %1$s px X %2$s px', 'reviewnews'), 930, 110)),
      'section' => 'header_builder',
      'width' => 930,
      'height' => 110,
      'flex_width' => true,
      'flex_height' => true,
      'priority' => 120,
    )
  )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting(
  'banner_advertisement_section_url',
  array(
    'default' => $reviewnews_default['banner_advertisement_section_url'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
  )
);
$wp_customize->add_control(
  'banner_advertisement_section_url',
  array(
    'label' => __('URL Link', 'reviewnews'),
    'section' => 'header_builder',
    'type' => 'text',
    'priority' => 130,
  )
);


// Add Theme Options Panel.
$wp_customize->add_panel(
  'theme_option_panel',
  array(
    'title' => __('Theme Options', 'reviewnews'),
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'type'     => 'reviewnews-panel',
  )
);





// Breadcrumb Section.
$wp_customize->add_section(
  'site_breadcrumb_settings',
  array(
    'title' => __('Breadcrumb Options', 'reviewnews'),
    'priority' => 49,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);


// Setting - breadcrumb.
$wp_customize->add_setting(
  'enable_breadcrumb',
  array(
    'default' => $reviewnews_default['enable_breadcrumb'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'enable_breadcrumb',
  array(
    'label' => __('Show breadcrumbs', 'reviewnews'),
    'section' => 'site_breadcrumb_settings',
    'type' => 'checkbox',
    'priority' => 10,
  )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
  'select_breadcrumb_mode',
  array(
    'default' => $default['select_breadcrumb_mode'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'select_breadcrumb_mode',
  array(
    'label' => __('Select Breadcrumbs', 'reviewnews'),
    'description' => __("Please ensure that you have enabled the plugin's breadcrumbs before choosing other than Default", 'reviewnews'),
    'section' => 'site_breadcrumb_settings',
    'settings' => 'select_breadcrumb_mode',
    'type' => 'select',
    'choices' => array(
      'default' => __('Default', 'reviewnews'),
      'yoast' => __('Yoast SEO', 'reviewnews'),
      'rankmath' => __('Rank Math', 'reviewnews'),
      'bcn' => __('NavXT', 'reviewnews'),
    ),
    'priority' => 100,
  )
);




/**
 * Layout options section
 *
 * @package ReviewNews
 */

// Layout Section.
$wp_customize->add_section(
  'site_layout_settings',
  array(
    'title' => __('Global Settings', 'reviewnews'),
    'priority' => 9,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);


// Setting - preloader.
$wp_customize->add_setting(
  'enable_site_preloader',
  array(
    'default' => $reviewnews_default['enable_site_preloader'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'enable_site_preloader',
  array(
    'label' => __('Enable Preloader', 'reviewnews'),
    'section' => 'site_layout_settings',
    'type' => 'checkbox',
    'priority' => 10,
  )
);


// Setting - Disable Emoji Script.
$wp_customize->add_setting(
  'disable_wp_emoji',
  array(
    'default'           => $reviewnews_default['disable_wp_emoji'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'disable_wp_emoji',
  array(
    'label'    => __('Disable Emoji Script', 'reviewnews'),
    'description'       => __('GDPR friendly & better performance', 'reviewnews'),
    'section'  => 'site_layout_settings', // Use your preferred section.
    'type'     => 'checkbox',
    'priority' => 10,
  )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_content_alignment',
  array(
    'default' => $reviewnews_default['global_content_alignment'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_content_alignment',
  array(
    'label' => __('Global Content Alignment', 'reviewnews'),
    'section' => 'site_layout_settings',
    'type' => 'select',
    'choices' => array(
      'align-content-left' => __('Content - Primary sidebar', 'reviewnews'),
      'align-content-right' => __('Primary sidebar - Content', 'reviewnews'),
      'full-width-content' => __('Full width content', 'reviewnews')
    ),
    'priority' => 130,
  )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_fetch_content_image_setting',
  array(
    'default'           => $default['global_fetch_content_image_setting'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_fetch_content_image_setting',
  array(
    'label'       => __('Also Show Content Image in Archive', 'reviewnews'),
    'description'       => __('If there is no Post Featured image set', 'reviewnews'),
    'section'     => 'site_layout_settings',
    'type'        => 'select',
    'choices'               => array(
      'enable' => __('Enable ', 'reviewnews'),
      'disable' => __('Disable', 'reviewnews'),

    ),
    'priority'    => 130,
  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_toggle_image_lazy_load_setting',
  array(
    'default'           => $default['global_toggle_image_lazy_load_setting'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_toggle_image_lazy_load_setting',
  array(
    'label'       => __('Image Lazy Loading', 'reviewnews'),
    'description'       => __('Set for better performance', 'reviewnews'),
    'section'     => 'site_layout_settings',
    'type'        => 'select',
    'choices'               => array(
      'enable' => __('Enable ', 'reviewnews'),
      'disable' => __('Disable', 'reviewnews'),

    ),
    'priority'    => 130,
  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_decoding_image_async_setting',
  array(
    'default'           => $default['global_decoding_image_async_setting'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_decoding_image_async_setting',
  array(
    'label'       => __('Image Async Decoding', 'reviewnews'),
    'description'       => __('Set to enhance rendering speed', 'reviewnews'),
    'section'     => 'site_layout_settings',
    'type'        => 'select',
    'choices'               => array(
      'enable' => __('Enable ', 'reviewnews'),
      'disable' => __('Disable', 'reviewnews'),

    ),
    'priority'    => 130,
  )
);



// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_scroll_to_top_position',
  array(
    'default' => $reviewnews_default['global_scroll_to_top_position'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_scroll_to_top_position',
  array(
    'label' => __('Scroll to Top Position', 'reviewnews'),
    'section' => 'site_layout_settings',
    'settings' => 'global_scroll_to_top_position',
    'type' => 'select',
    'choices' => array(
      'right' => __('Right', 'reviewnews'),
      'left' => __('Left', 'reviewnews'),

    ),
    'priority' => 130,
  )
);


// Global Section.
$wp_customize->add_section(
  'site_categories_settings',
  array(
    'title' => __('Categories Settings', 'reviewnews'),
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_show_categories',
  array(
    'default' => $reviewnews_default['global_show_categories'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_show_categories',
  array(
    'label' => __('Post Categories', 'reviewnews'),
    'section' => 'site_categories_settings',
    'type' => 'select',
    'choices' => array(
      'yes' => __('Show', 'reviewnews'),
      'no' => __('Hide', 'reviewnews'),

    ),
    'priority' => 130,
  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_number_of_categories',
  array(
    'default' => $reviewnews_default['global_number_of_categories'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_number_of_categories',
  array(
    'label' => __('Categories to be displayed', 'reviewnews'),
    'section' => 'site_categories_settings',
    'type' => 'select',
    'choices' => array(
      'all' => __('Show All', 'reviewnews'),
      'one' => __('Top One Category', 'reviewnews'),

    ),
    'priority' => 130,
    'active_callback' => 'reviewnews_global_show_category_number_status'

  )
);

// Setting - sticky_header_option.
$wp_customize->add_setting(
  'global_custom_number_of_categories',
  array(
    'default' => $reviewnews_default['global_custom_number_of_categories'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',
  )
);
$wp_customize->add_control(
  'global_custom_number_of_categories',
  array(
    'label' => __('Number of Categories', 'reviewnews'),
    'section' => 'site_categories_settings',
    'type' => 'number',
    'priority' => 130,
    'active_callback' => 'reviewnews_global_show_custom_category_number_status'
  )
);

// Global Section.
$wp_customize->add_section(
  'site_author_and_date_settings',
  array(
    'title' => __('Author and Date Settings', 'reviewnews'),
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_author_icon_gravatar_display_setting',
  array(
    'default' => $reviewnews_default['global_author_icon_gravatar_display_setting'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_author_icon_gravatar_display_setting',
  array(
    'label' => __('Author Icon', 'reviewnews'),
    'section' => 'site_author_and_date_settings',
    'type' => 'select',
    'choices' => array(
      'display-gravatar' => __('Show Gravatar', 'reviewnews'),
      'display-icon' => __('Show Icon', 'reviewnews'),
      'display-none' => __('None', 'reviewnews'),
    ),
    'priority' => 130,

  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_date_display_setting',
  array(
    'default' => $reviewnews_default['global_date_display_setting'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_date_display_setting',
  array(
    'label' => __('Date Format', 'reviewnews'),
    'section' => 'site_author_and_date_settings',
    'type' => 'select',
    'choices' => array(
      'default-date' => __('WordPress Default Date Format', 'reviewnews'),
      'theme-date' => __('Ago Date Format', 'reviewnews'),
    ),
    'priority' => 130,

  )
);


//========== minutes read count options ===============

// Global Section.
$wp_customize->add_section(
  'site_min_read_settings',
  array(
    'title' => __('Minutes Read Count', 'reviewnews'),
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_show_min_read',
  array(
    'default' => $reviewnews_default['global_show_min_read'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_show_min_read',
  array(
    'label' => __('Minutes Read Count', 'reviewnews'),
    'section' => 'site_min_read_settings',
    'type' => 'select',
    'choices' => array(
      'yes' => __('Show', 'reviewnews'),
      'no' => __('Hide', 'reviewnews'),

    ),
    'priority' => 130,
  )
);



// Global Section.
$wp_customize->add_section(
  'site_excerpt_settings',
  array(
    'title' => __('Excerpt Settings', 'reviewnews'),
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);



// Setting - related posts.
$wp_customize->add_setting(
  'global_read_more_texts',
  array(
    'default' => $reviewnews_default['global_read_more_texts'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  'global_read_more_texts',
  array(
    'label' => __('Global Excerpt Read More', 'reviewnews'),
    'section' => 'site_excerpt_settings',
    'type' => 'text',
    'priority' => 130,

  )
);


//============= Watch Online Section ==========
//section title
$wp_customize->add_setting(
  'show_watch_online_section_section_title',
  array(
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  new ReviewNews_Section_Title(
    $wp_customize,
    'show_watch_online_section_section_title',
    array(
      'label' => __("Primary Menu Section", 'reviewnews'),
      'section' => 'header_builder',
      'priority' => 100,

    )
  )
);

$wp_customize->add_setting(
  'show_primary_menu_desc',
  array(
    'default' => $reviewnews_default['show_primary_menu_desc'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'show_primary_menu_desc',
  array(
    'label' => __('Show Primary Menu Description', 'reviewnews'),
    'section' => 'header_builder',
    'type' => 'checkbox',
    'priority' => 100,

  )
);

$wp_customize->add_setting(
  'show_watch_online_section',
  array(
    'default' => $reviewnews_default['show_watch_online_section'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'show_watch_online_section',
  array(
    'label' => __('Enable Custom Menu Section', 'reviewnews'),
    'section' => 'header_builder',
    'type' => 'checkbox',
    'priority' => 100,
    'active_callback' => 'reviewnews_is_inactive_builder'

  )
);


// Setting - related posts.
$wp_customize->add_setting(
  'aft_custom_title',
  array(
    'default' => $reviewnews_default['aft_custom_title'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  'aft_custom_title',
  array(
    'label' => __('Title', 'reviewnews'),
    'section' => 'header_builder',
    'type' => 'text',
    'priority' => 100,
    'active_callback' => 'reviewnews_show_watch_online_section_status'
  )
);

// Setting - related posts.
$wp_customize->add_setting(
  'aft_custom_link',
  array(
    'default' => $reviewnews_default['aft_custom_link'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
  )
);

$wp_customize->add_control(
  'aft_custom_link',
  array(
    'label' => __('Link', 'reviewnews'),
    'section' => 'header_builder',
    'settings' => 'aft_custom_link',
    'type' => 'text',
    'priority' => 100,
    'active_callback' => 'reviewnews_show_watch_online_section_status'
  )
);


//========== single posts options ===============

// Single Section.
$wp_customize->add_section(
  'site_single_posts_settings',
  array(
    'title' => __('Single Post', 'reviewnews'),
    'priority' => 9,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);

// Setting - related posts.
$wp_customize->add_setting(
  'single_show_featured_image',
  array(
    'default' => $reviewnews_default['single_show_featured_image'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'single_show_featured_image',
  array(
    'label' => __('Show Featured Image', 'reviewnews'),
    'section' => 'site_single_posts_settings',
    'type' => 'checkbox',
    'priority' => 100,
  )
);


$wp_customize->add_setting(
  'single_featured_image_view',
  array(
    'default' => $reviewnews_default['single_featured_image_view'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);


$wp_customize->add_control(
  'single_featured_image_view',
  array(
    'label' => __('Featured Image Width', 'reviewnews'),
    'section' => 'site_single_posts_settings',
    'type' => 'select',
    'choices' => array(
      'full' => __('Full - Default', 'reviewnews'),
      'original' => __('Original', 'reviewnews')
    ),
    'priority' => 100,
    'active_callback' => 'reviewnews_featured_image_status'
  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'global_single_content_mode',
  array(
    'default'           => $default['global_single_content_mode'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'global_single_content_mode',
  array(
    'label'       => __('Single Content Mode', 'reviewnews'),
    'section'     => 'site_single_posts_settings',
    'settings'     => 'global_single_content_mode',
    'type'        => 'select',
    'choices'               => array(
      'single-content-mode-default' => __('Default', 'reviewnews'),
      'single-content-mode-boxed' => __('Spacious', 'reviewnews'),
    ),
    'priority'    => 100,
  )
);






// Setting - trending posts.
$wp_customize->add_setting(
  'single_show_theme_author_bio',
  array(
    'default' => $default['single_show_theme_author_bio'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'single_show_theme_author_bio',
  array(
    'label' => __('Show Author Bio under Content', 'reviewnews'),
    'section' => 'site_single_posts_settings',
    'settings' => 'single_show_theme_author_bio',
    'type' => 'checkbox',
    'priority' => 100,
  )
);

// Setting - trending posts.
$wp_customize->add_setting(
  'single_show_tags_list',
  array(
    'default' => $default['single_show_tags_list'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'single_show_tags_list',
  array(
    'label' => __('Show Tags under Content', 'reviewnews'),
    'section' => 'site_single_posts_settings',
    'settings' => 'single_show_tags_list',
    'type' => 'checkbox',
    'priority' => 100,
  )
);


//Social share option

$wp_customize->add_setting(
  'single_social_share_section_title',
  array(
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  new reviewnews_Section_Title(
    $wp_customize,
    'single_social_share_section_title',
    array(
      'label' => __("Social Share Options", 'reviewnews'),
      'section' => 'site_single_posts_settings',
      'priority' => 100,

    )
  )
);

$wp_customize->add_setting(
  'single_post_social_share_type',
  array(
    'default' => $reviewnews_default['single_post_social_share_type'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'single_post_social_share_type',
  array(
    'label' => __('Defined Links', 'reviewnews'),
    'section' => 'site_single_posts_settings',
    'type' => 'select',
    'choices' => array(
      'theme' => __('Theme', 'reviewnews'),
      'jetpack' => __('JetPack', 'reviewnews'),
      'none' => __('None', 'reviewnews'),
    ),
    'priority' => 100,
  )
);
$wp_customize->add_setting(
  'single_post_social_share_view',
  array(
    'default' => $reviewnews_default['single_post_social_share_view'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'single_post_social_share_view',
  array(
    'label' => __('Position', 'reviewnews'),
    'section' => 'site_single_posts_settings',
    'type' => 'select',
    'choices' => array(      
      'after-title-default' => __('Before Content', 'reviewnews'),
      'after-content' => __('After Content', 'reviewnews'),
    ),
    'priority' => 100,
    'active_callback' => 'reviewnews_single_post_social_share_status'
  )
);

//========== related posts  options ===============

$wp_customize->add_setting(
  'single_related_posts_section_title',
  array(
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  new ReviewNews_Section_Title(
    $wp_customize,
    'single_related_posts_section_title',
    array(
      'label' => __("Related Posts Settings", 'reviewnews'),
      'section' => 'site_single_posts_settings',
      'priority' => 100,

    )
  )
);

// Setting - related posts.
$wp_customize->add_setting(
  'single_show_related_posts',
  array(
    'default' => $reviewnews_default['single_show_related_posts'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'single_show_related_posts',
  array(
    'label' => __('Enable Related Posts', 'reviewnews'),
    'section' => 'site_single_posts_settings',
    'type' => 'checkbox',
    'priority' => 100,
  )
);

// Setting - related posts.
$wp_customize->add_setting(
  'single_related_posts_title',
  array(
    'default' => $reviewnews_default['single_related_posts_title'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  'single_related_posts_title',
  array(
    'label' => __('Title', 'reviewnews'),
    'section' => 'site_single_posts_settings',
    'settings' => 'single_related_posts_title',
    'type' => 'text',
    'priority' => 100,
    'active_callback' => 'reviewnews_related_posts_status'
  )
);



/**
 * Archive options section
 *
 * @package ReviewNews
 */

// Archive Section.
$wp_customize->add_section(
  'site_archive_settings',
  array(
    'title' => __('Archive Settings', 'reviewnews'),
    'priority' => 9,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);


// Disable main banner in blog
$wp_customize->add_setting(
  'disable_main_banner_on_blog_archive',
  array(
    'default'           => $default['disable_main_banner_on_blog_archive'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'disable_main_banner_on_blog_archive',
  array(
    'label'    => __('Disable Main Banner on Blog', 'reviewnews'),
    'section'  => 'site_archive_settings',
    'type'     => 'checkbox',
    'priority' => 50,
    'active_callback' => 'reviewnews_main_banner_section_status'
  )
);

//Setting - archive content view of news.
$wp_customize->add_setting(
  'archive_layout',
  array(
    'default' => $reviewnews_default['archive_layout'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'archive_layout',
  array(
    'label' => __('Archive layout', 'reviewnews'),
    'description' => __('Select layout for archive', 'reviewnews'),
    'section' => 'site_archive_settings',
    'settings' => 'archive_layout',
    'type' => 'select',
    'choices' => array(
      'archive-layout-grid' => __('grid', 'reviewnews'),
      'archive-layout-full' => __('Full', 'reviewnews'),

    ),
    'priority' => 130,
  )
);


// Setting - archive content view of news.
$wp_customize->add_setting(
  'archive_image_alignment',
  array(
    'default' => $reviewnews_default['archive_image_alignment'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'archive_image_alignment',
  array(
    'label' => __('Image Alignment', 'reviewnews'),
    'description' => __('Select image alignment for archive', 'reviewnews'),
    'section' => 'site_archive_settings',
    'type' => 'select',
    'choices' => array(
      'archive-image-left' => __('Left', 'reviewnews'),
      'archive-image-right' => __('Right', 'reviewnews'),
    ),
    'priority' => 130,
    'active_callback' => 'reviewnews_archive_image_status'
  )
);




//Setting - archive content view of news.
$wp_customize->add_setting(
  'archive_content_view',
  array(
    'default' => $reviewnews_default['archive_content_view'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'archive_content_view',
  array(
    'label' => __('Content View', 'reviewnews'),
    'description' => __('Select content view for archive', 'reviewnews'),
    'section' => 'site_archive_settings',
    'type' => 'select',
    'choices' => array(
      'archive-content-excerpt' => __('Post Excerpt', 'reviewnews'),
      'archive-content-full' => __('Full Content', 'reviewnews'),
      'archive-content-none' => __('None', 'reviewnews'),

    ),
    'priority' => 130,
  )
);

// Breadcrumb Section.
$wp_customize->add_section(
  'site_search_settings',
  array(
    'title' => __('Search Options', 'reviewnews'),
    'priority' => 9,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
  )
);


//Setting - archive content view of news.
$wp_customize->add_setting(
  'search_archive_content_view',
  array(
    'default' => $reviewnews_default['search_archive_content_view'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'search_archive_content_view',
  array(
    'label' => __('Search Results', 'reviewnews'),
    'description' => __('Select search results for archive', 'reviewnews'),
    'section' => 'site_search_settings',
    'type' => 'select',
    'choices' => array(
      'all' => __('All (Pages, Posts, etc)', 'reviewnews'),
      'posts' => __('Posts', 'reviewnews')
    ),
    'priority' => 130,
  )
);


//Setting - archive content view of news.
$wp_customize->add_setting(
  'search_archive_enable_ajax',
  array(
    'default' => $reviewnews_default['search_archive_enable_ajax'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',
  )
);

$wp_customize->add_control(
  'search_archive_enable_ajax',
  array(
    'label' => __('Ajax Results Dropdown', 'reviewnews'),    
    'section' => 'site_search_settings',
    'type' => 'checkbox',
    'priority' => 130,
  )
);



//========== sidebar blocks options ===============

// Trending Section.
$wp_customize->add_section(
  'sidebar_block_settings',
  array(
    'title' => __('Sidebar Settings', 'reviewnews'),
    'priority' => 9,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);


// Setting - frontpage_sticky_sidebar.
$wp_customize->add_setting(
  'frontpage_sticky_sidebar',
  array(
    'default' => $default['frontpage_sticky_sidebar'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'frontpage_sticky_sidebar',
  array(
    'label' => __('Make Sidebar Sticky', 'reviewnews'),
    'section' => 'sidebar_block_settings',
    'type' => 'checkbox',
    'priority' => 100,

  )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
  'frontpage_sticky_sidebar_position',
  array(
    'default' => $default['frontpage_sticky_sidebar_position'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_select',
  )
);

$wp_customize->add_control(
  'frontpage_sticky_sidebar_position',
  array(
    'label' => __('Sidebar Sticky Position', 'reviewnews'),
    'section' => 'sidebar_block_settings',
    'type' => 'select',
    'choices' => array(
      'sidebar-sticky-top' => __('Top', 'reviewnews'),
      'sidebar-sticky-bottom' => __('Bottom', 'reviewnews'),
    ),
    'priority' => 100,
    'active_callback' => 'frontpage_sticky_sidebar_status'
  )
);

//========== footer latest blog carousel options ===============

// Footer Section.



$wp_customize->add_section(
  'frontpage_latest_posts_settings',
  array(
    'title' => __('You May Have Missed', 'reviewnews'),
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'panel' => 'theme_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);
// Setting - latest blog carousel.
$wp_customize->add_setting(
  'frontpage_show_latest_posts',
  array(
    'default' => $reviewnews_default['frontpage_show_latest_posts'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'frontpage_show_latest_posts',
  array(
    'label' => __('Show Above Footer', 'reviewnews'),
    'section' => 'frontpage_latest_posts_settings',
    'type' => 'checkbox',
    'priority' => 100,
  )
);


// Setting - featured_news_section_title.
$wp_customize->add_setting(
  'frontpage_latest_posts_section_title',
  array(
    'default' => $reviewnews_default['frontpage_latest_posts_section_title'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
  )
);
$wp_customize->add_control(
  'frontpage_latest_posts_section_title',
  array(
    'label' => __('Posts Section Title', 'reviewnews'),
    'section' => 'frontpage_latest_posts_settings',
    'settings' => 'frontpage_latest_posts_section_title',
    'type' => 'text',
    'priority' => 100,
    'active_callback' => 'reviewnews_latest_news_section_status'

  )
);



//========== footer section options ===============


// Add Front-page Options Panel.
$wp_customize->add_panel(
  'site_footer_option_panel',
  array(
    'title' => __('Footer Options', 'reviewnews'),
    'priority' => 198,
    'capability' => 'edit_theme_options',
    'type'     => 'reviewnews-panel',
  )
);

// Footer Section.
$wp_customize->add_section(
  'site_footer_settings',
  array(
    'title' => __('Footer', 'reviewnews'),
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'panel' => 'site_footer_option_panel',
    'class'       => 'reviewnews-customizer-section',
  )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting(
  'footer_background_image',
  array(
    'default' => $default['footer_background_image'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'absint',
  )
);


$wp_customize->add_control(
  new WP_Customize_Cropped_Image_Control(
    $wp_customize,
    'footer_background_image',
    array(
      'label' => __('Footer Background Image', 'reviewnews'),
      'description' => esc_html(sprintf(__('Recommended Size %1$s px X %2$s px', 'reviewnews'), 1024, 800)),
      'section' => 'footer_builder',
      'width' => 1024,
      'height' => 800,
      'flex_width' => true,
      'flex_height' => true,
      'priority' => 100,
    )
  )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
  'footer_copyright_text',
  array(
    'default' => $reviewnews_default['footer_copyright_text'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  'footer_copyright_text',
  array(
    'label' => __('Copyright Text', 'reviewnews'),
    'section' => 'footer_builder',
    'settings' => 'footer_copyright_text',
    'type' => 'text',
    'priority' => 100,
  )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
  'hide_footer_menu_section',
  array(
    'default' => $reviewnews_default['hide_footer_menu_section'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'reviewnews_sanitize_checkbox',
  )
);

$wp_customize->add_control(
  'hide_footer_menu_section',
  array(
    'label' => __('Hide footer Menu Section', 'reviewnews'),
    'section' => 'footer_builder',
    'type' => 'checkbox',
    'priority' => 100,
  )
);
