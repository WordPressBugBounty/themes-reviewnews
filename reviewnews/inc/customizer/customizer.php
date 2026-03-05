<?php

/**
 * ReviewNews Theme Customizer
 *
 * @package ReviewNews
 */

if (!function_exists('reviewnews_get_option')):
  /**
   * Get theme option.
   *
   * @since 1.0.0
   *
   * @param string $key Option key.
   * @return mixed Option value.
   */
  function reviewnews_get_option($key)
  {

    if (empty($key)) {
      return;
    }

    $value = '';

    $default       = reviewnews_get_default_theme_options();
    $default_value = null;

    if (is_array($default) && isset($default[$key])) {
      $default_value = $default[$key];
    }

    if (null !== $default_value) {
      $value = get_theme_mod($key, $default_value);
    } else {
      $value = get_theme_mod($key);
    }

    return $value;
  }
endif;

// Load customize default values.
require get_template_directory() . '/inc/customizer/customizer-callback.php';

// Load customize default values.
require get_template_directory() . '/inc/customizer/customizer-default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function reviewnews_customize_register($wp_customize)
{

  // Load customize controls.
  require get_template_directory() . '/inc/customizer/customizer-control.php';

  // Load customize sanitize.
  require get_template_directory() . '/inc/customizer/customizer-sanitize.php';

  $wp_customize->get_setting('blogname')->transport         = 'postMessage';
  $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
  $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

  $wp_customize->get_control('background_color')->label = __('Body Background Color', 'reviewnews');

  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial('blogname', array(
      'selector'        => '.site-title a',
      'render_callback' => 'reviewnews_customize_partial_blogname',
    ));
    $wp_customize->selective_refresh->add_partial('blogdescription', array(
      'selector'        => '.site-description',
      'render_callback' => 'reviewnews_customize_partial_blogdescription',
    ));
  }

  $default = reviewnews_get_default_theme_options();

  // Setting - secondary_font.
  $wp_customize->add_setting(
    'site_title_font_size',
    array(
      'default'           => $default['site_title_font_size'],
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_text_field',
    )
  );

  $wp_customize->add_control(
    'site_title_font_size',
    array(
      'label'    => __('Site Title Size', 'reviewnews'),
      'section'  => 'title_tagline',
      'type'     => 'number',
      'priority' => 50,
    )
  );

  // Setting - header overlay.
  $wp_customize->add_setting(
    'site_title_uppercase',
    array(
      'default'           => $default['site_title_uppercase'],
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'reviewnews_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'site_title_uppercase',
    array(
      'label'    => __('Uppercase Site Title and Tagline', 'reviewnews'),
      'section'  => 'title_tagline',
      'type'     => 'checkbox',
      'priority' => 50,
    )
  );


  $wp_customize->get_section('header_image')->panel = 'site_header_option_panel';

  // use get control
  $wp_customize->get_control('header_textcolor')->label = __('Site Title/Tagline Color', 'reviewnews');
  $wp_customize->get_control('header_textcolor')->section = 'colors';
  $wp_customize->get_control('header_textcolor')->section = 'colors';
  $wp_customize->get_control('header_textcolor')->priority = 5;

  // Setting - header_image.
  $wp_customize->get_control('header_image')->section = 'header_builder';
  $wp_customize->get_control('header_image')->priority = 10;

  //section title
$wp_customize->add_setting(
  'header_image_background_section_title',
  array(
    'sanitize_callback' => 'sanitize_text_field',
  )
);

$wp_customize->add_control(
  new ReviewNews_Section_Title(
    $wp_customize,
    'header_image_background_section_title',
    array(
      'label' => __("Header Background", 'reviewnews'),
      'section' => 'header_builder',
      'priority' => 6,

    )
  )
);

  // Setting - select_main_banner_section_mode.
  $wp_customize->add_setting(
    'select_header_image_mode',
    array(
      'default'           => $default['select_header_image_mode'],
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'reviewnews_sanitize_select',
    )
  );

  $wp_customize->add_control(
    'select_header_image_mode',
    array(
      'label'       => __('Header Image Mode', 'reviewnews'),
      'description'       => __('Image visibility may vary as per the mode', 'reviewnews'),
      'section'     => 'header_builder',
      'type'        => 'select',
      'choices'               => array(
        'above' => __("Above Site Title", 'reviewnews'),
        'default' => __("Set as Background", 'reviewnews'),
        'full' => __("Show Full Image (Background)", 'reviewnews'),
      ),
      'priority'    => 6
    )
  );


  // Setting - header overlay.
  $wp_customize->add_setting(
    'disable_header_image_tint_overlay',
    array(
      'default'           => $default['disable_header_image_tint_overlay'],
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'reviewnews_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'disable_header_image_tint_overlay',
    array(
      'label'    => __('Disable Image Tint/Overlay', 'reviewnews'),
      'section'  => 'header_builder',
      'type'     => 'checkbox',
      'priority' => 6,
      'active_callback' => 'reviewnews_disable_header_image_tint_overlay_status'
    )
  );


  /*theme option panel info*/
  require get_template_directory() . '/inc/customizer/theme-options.php';

  // Register custom section types.
  $wp_customize->register_section_type('ReviewNews_Customize_Section_Upsell');

  // Register sections.
  $wp_customize->add_section(
    new ReviewNews_Customize_Section_Upsell(
      $wp_customize,
      'theme_upsell',
      array(
        'title'    => __('ReviewNews Pro', 'reviewnews'),
        'pro_text' => __('Upgrade Now', 'reviewnews'),
        'pro_url'  => 'https://www.afthemes.com/products/reviewnews-pro/',
        'priority'  => 1,
      )
    )
  );
}
add_action('customize_register', 'reviewnews_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function reviewnews_customize_partial_blogname()
{
  bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function reviewnews_customize_partial_blogdescription()
{
  bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function reviewnews_customize_preview_js()
{
  wp_enqueue_script('reviewnews-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'reviewnews_customize_preview_js');


function reviewnews_customizer_css()
{
  wp_enqueue_script('reviewnews-customize-controls', get_template_directory_uri() . '/assets/customizer-admin.js', array('customize-controls'));

  wp_enqueue_style('reviewnews-customize-controls-style', get_template_directory_uri() . '/assets/customizer-admin.css');
}
add_action('customize_controls_enqueue_scripts', 'reviewnews_customizer_css', 0);
