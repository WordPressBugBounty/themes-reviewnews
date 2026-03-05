<?php

/**
 * Font and Color Option Panel
 *
 * @package ReviewNews
 */

$reviewnews_default = reviewnews_get_default_theme_options();


// Setting - global content alignment of news.
$wp_customize->add_setting('global_site_mode_setting',
    array(
        'default' => $reviewnews_default['global_site_mode_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control('global_site_mode_setting',
    array(
        'label' => __('Site Color Mode', 'reviewnews'),
        'section' => 'colors',
        'type' => 'select',
        'choices' => array(
            'aft-default-mode' => __('Light', 'reviewnews'),
            'aft-dark-mode' => __('Dark', 'reviewnews'),
        ),
        'priority' => 5,
    ));

//section title
$wp_customize->add_setting('site_background_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ReviewNews_Section_Title(
        $wp_customize,
        'site_background_color_section_title',
        array(
            'label' => __('Primary Color Section ', 'reviewnews'),
            'section' => 'colors',
            'priority' => 5,
            
        )
    )
);


//section title
$wp_customize->add_setting('global_color_section_notice',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ReviewNews_Simple_Notice_Custom_Control(
        $wp_customize,
        'global_color_section_notice',
        array(
            'description' => __('Body Background Color (Dark Mode) will be applied for this mode.', 'reviewnews'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => 'reviewnews_global_site_mode_dark_status'
        )
    )
);



// Setting - slider_caption_bg_color.
$wp_customize->add_setting('dark_background_color',
    array(
        'default' => $reviewnews_default['dark_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'dark_background_color',
        array(
            'label' => __('Body Background Color (Dark Mode)', 'reviewnews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'reviewnews_global_site_mode_dark_status'

        )
    )
);


// Setting - primary_color.
$wp_customize->add_setting(
    'link_color',
    array(
      'default' => $reviewnews_default['link_color'],
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
  $wp_customize->add_control(
  
    new WP_Customize_Color_Control(
      $wp_customize,
      'link_color',
      array(
        'label' => __('Link Color', 'reviewnews'),
        'section' => 'colors',
        'type' => 'color',
        'priority' => 10,
        'active_callback' => 'reviewnews_global_site_mode_light_status'
      )
    )
  );
  
  // Setting - primary_color.
  $wp_customize->add_setting(
    'link_color_dark',
    array(
      'default' => $reviewnews_default['link_color_dark'],
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
  $wp_customize->add_control(
  
    new WP_Customize_Color_Control(
      $wp_customize,
      'link_color_dark',
      array(
        'label' => __('Link Color', 'reviewnews'),
        'section' => 'colors',
        'type' => 'color',
        'priority' => 10,
        'active_callback' => 'reviewnews_global_site_mode_dark_status'
      )
    )
  );
  
  
  
  // Setting - primary_color.
  $wp_customize->add_setting(
    'link_hover_color',
    array(
      'default' => $reviewnews_default['link_hover_color'],
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
  $wp_customize->add_control(
  
    new WP_Customize_Color_Control(
      $wp_customize,
      'link_hover_color',
      array(
        'label' => __('Link Hover Color', 'reviewnews'),
        'section' => 'colors',
        'type' => 'color',
        'priority' => 10,
        'active_callback' => 'reviewnews_global_site_mode_light_status'
      )
    )
  );
  
  // Setting - primary_color.
  $wp_customize->add_setting(
    'link_hover_color_dark',
    array(
      'default' => $reviewnews_default['link_hover_color_dark'],
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
  $wp_customize->add_control(
  
    new WP_Customize_Color_Control(
      $wp_customize,
      'link_hover_color_dark',
      array(
        'label' => __('Link Hover Color', 'reviewnews'),
        'section' => 'colors',
        'type' => 'color',
        'priority' => 10,
        'active_callback' => 'reviewnews_global_site_mode_dark_status'
      )
    )
  );


//section title
$wp_customize->add_setting('secondary_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ReviewNews_Section_Title(
        $wp_customize,
        'secondary_color_section_title',
        array(
            'label' => __('Secondary Color Section ', 'reviewnews'),
            'section' => 'colors',
            'priority' => 10,
            
        )
    )
);


// Setting - secondary_color.
$wp_customize->add_setting('secondary_color',
    array(
        'default' => $reviewnews_default['secondary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'secondary_color',
        array(
            'label' => __('Secondary Color', 'reviewnews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
           
        )
    )
);



//============= Font Options ===================
// font Section.
$wp_customize->add_section('font_typo_section',
    array(
        'title' => __('Fonts & Typography', 'reviewnews'),
        'priority' => 5,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
        'class'       => 'reviewnews-customizer-section',
    )
);

global $reviewnews_google_fonts;


// Trending Section.
$wp_customize->add_setting('site_title_font_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ReviewNews_Section_Title(
        $wp_customize,
        'site_title_font_section_title',
        array(
            'label' => __("Font Family Section", 'reviewnews'),
            'section' => 'font_typo_section',
            'priority' => 100,

        )
    )
);



// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_font_family_type',
    array(
        'default' => $reviewnews_default['global_font_family_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_font_family_type',
    array(
        'label' => __('Fonts Source', 'reviewnews'),
        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => array(
            'google' => __('Theme Fonts', 'reviewnews'),
            'system' => __('System Fonts', 'reviewnews')
        ),
        'priority' => 100,
    )
);

// Setting - primary_font.
$wp_customize->add_setting('primary_font',
    array(
        'default' => $reviewnews_default['primary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);
$wp_customize->add_control('primary_font',
    array(
        'label' => __('Primary Font', 'reviewnews'),
        'description' => __('Content, menus, normal texts and paragraphs, etc', 'reviewnews'),
        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $reviewnews_google_fonts,
        'priority' => 100,
        'active_callback' => 'global_font_family_type_status'
    )
);


// Setting - secondary_font.
$wp_customize->add_setting(
    'secondary_font',
    array(
      'default' => $reviewnews_default['secondary_font'],
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'reviewnews_sanitize_select',
    )
  );
  $wp_customize->add_control(
    'secondary_font',
    array(
      'label' => __('Secondary Font', 'reviewnews'),
      'description' => __('Site title, post titles, widgets titles, etc', 'reviewnews'),
      'section' => 'font_typo_section',
      'type' => 'select',
      'choices' => $reviewnews_google_fonts,
      'priority' => 110,
      'active_callback' => 'global_font_family_type_status'
    )
  );
  