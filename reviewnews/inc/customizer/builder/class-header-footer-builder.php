<?php

/**
 * Header Footer Builder Main Class
 */
class ReviewNews_Header_Footer_Builder
{
  private static $instance = null;

  public static function get_instance()
  {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {
    add_action('customize_register', array($this, 'reviewnews_afthfb_register_customizer_controls'));
    add_action('customize_controls_enqueue_scripts', array($this, 'reviewnews_afthfb_enqueue_customizer_scripts'));
    // add_action('customize_preview_init', array($this, 'enqueue_preview_scripts'));
  }

  /**
   * Register Customizer Controls
   */
  public function reviewnews_afthfb_register_customizer_controls($wp_customize)
  {


    // Add Header Builder Section
    $wp_customize->add_section(
      'header_builder',
      array(
        'title' =>  esc_html__('Header Builder', 'reviewnews'),
        'priority' => 40,
        'class'       => 'reviewnews-customizer-section',
      )
    );

    // Add Footer Builder Section
    $wp_customize->add_section(
      'footer_builder',
      array(
        'title' =>  esc_html__('Footer Builder', 'reviewnews'),
        'priority' => 50,        
        'class'       => 'reviewnews-customizer-section',
      )
    );

    // Header Builder Control
    $wp_customize->add_setting('header_builder_data', array(
      'type' => 'option',
      'default' => reviewnews_afthfb_get_default_header_structure(),
      'sanitize_callback' => array($this, 'sanitize_builder_data'),
      'transport' => 'refresh',
    ));
    $loadHeader = reviewnews_get_option('reviewnews_afthfb_show_checkbox_header');
    //if ($loadHeader) {
    $wp_customize->add_control(new ReviewNews_Header_Footer_Builder_Control(
      $wp_customize,
      'header_builder_data',
      array(
        'section' => 'header_builder',
        'type' => 'header_builder_data',
      )
    ));
    //}

    // Footer Builder Control
    $wp_customize->add_setting('footer_builder_data', array(
      'type' => 'option',
      'default' => reviewnews_afthfb_get_default_footer_structure(),
      'sanitize_callback' => array($this, 'sanitize_builder_data'),
      'transport' => 'refresh',
    ));
    $loadFooter = reviewnews_get_option('reviewnews_afthfb_show_checkbox_footer');

    $wp_customize->add_control(new ReviewNews_Header_Footer_Builder_Control(
      $wp_customize,
      'footer_builder_data',
      array(
        'label' =>  esc_html__('Footer Layout', 'reviewnews'),
        'section' => 'footer_builder',
        'type' => 'footer_builder_data',
      )
    ));



    foreach (['header', 'footer'] as $builder_type) {



      if ($builder_type === 'header') {
        $message = esc_html__('Create dynamic header effortlessly with drag-and-drop builder.', 'reviewnews');
        $label = esc_html__('Header', 'reviewnews');
      } elseif ($builder_type === 'footer') {
        $message = esc_html__('Create dynamic footer effortlessly with drag-and-drop builder.', 'reviewnews');
        $label = esc_html__('Footer', 'reviewnews');
      }
      // Add checkbox control
      $checkbox_setting_id = "reviewnews_afthfb_show_checkbox_{$builder_type}";

      $wp_customize->add_setting($checkbox_setting_id, [
        'default' => false,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_checkbox',

      ]);

      $wp_customize->add_control($checkbox_setting_id, [
        'type' => 'checkbox',
        'section' => "{$builder_type}_builder",
        'label' =>  esc_html(sprintf(
          __("Enable %s Builder", 'reviewnews'),
          $label
        )),
        'description' => $message,
        'priority' => 2,
      ]);

      // Element Settings Container Control
      $setting_id = "reviewnews_afthfb_element_settings_container_{$builder_type}";
      $wp_customize->add_setting($setting_id, [
        'type' => 'option',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage',

      ]);

      $wp_customize->add_control(new ReviewNews_Element_Settings_Container_Control(
        $wp_customize,
        $setting_id,
        [

          'section' => "{$builder_type}_builder",
          'settings' => $setting_id,
          'transport' => 'postMessage',
          'priority' => 2,
          'active_callback' => "reviewnews_is_active_builder_{$builder_type}"
        ]
      ));
    }



    // Register individual block settings
    $this->reviewnews_afthfb_register_block_settings($wp_customize);
  }

  /**
   * Register Block Settings - Enhanced to create dynamic controls
   */
  private function reviewnews_afthfb_register_block_settings($wp_customize)
  {
    $blocks = reviewnews_afthfb_get_all_registered_blocks();

    foreach ($blocks as $block_id => $block_config) {
      if (!empty($block_config['settings'])) {
        // Create a section for each block type's settings
        $section_id = "reviewnews_afthfb_{$block_id}_settings";

        foreach ($block_config['settings'] as $setting_id => $setting_config) {
          $full_setting_id = "reviewnews_afthfb_{$block_id}_{$setting_id}";

          // Register the setting
          $wp_customize->add_setting(
            $full_setting_id,
            array(
              'type' => 'option',
              'default' => $setting_config['default'] ?? '',
              'sanitize_callback' => $setting_config['sanitize'] ?? 'sanitize_text_field',
              'transport' => 'postMessage',
            )
          );

          // Create dynamic control based on setting type
          $control_args = array(
            'label' => isset($setting_config['description']) ? $setting_config['label'] : "",
            'section' => 'header_builder', // Will be dynamically moved by JS
            'type' => $setting_config['type'],
            'settings' => $full_setting_id,
            'active_callback' => array($this, 'is_element_active_callback'),
            'priority' => 2,
          );

          // Add choices for select and radio types
          if (isset($setting_config['choices'])) {
            $control_args['choices'] = $setting_config['choices'];
          }
          if (isset($setting_config['description'])) {
            $control_args['description'] = $setting_config['description'];
          }
          if (isset($setting_config['checkbox'])) {
            $control_args['checkbox'] = $setting_config['checkbox'];
          }

          $wp_customize->add_control($full_setting_id, $control_args);
        }
      }
    }
  }

  /**
   * Active callback for element settings - will be controlled by JS
   */
  public function is_element_active_callback($control)
  {
    // This will be overridden by JavaScript to show/hide controls dynamically
    return false; // Hidden by default
  }

  /**
   * Sanitize Builder Data
   */
  public function sanitize_builder_data($input)
  {
    $data = json_decode($input, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      return '';
    }
    return wp_json_encode($data);
  }

  /**
   * Enqueue Customizer Scripts
   */
  public function reviewnews_afthfb_enqueue_customizer_scripts()
  {
    $loadHeader = reviewnews_get_option('reviewnews_afthfb_show_checkbox_header');
    $loadFooter = reviewnews_get_option('reviewnews_afthfb_show_checkbox_footer');

    // if ($loadHeader == false && $loadFooter == false) {

    //   return;
    // }
    wp_enqueue_script(
      'header-footer-builder-customizer',
      get_template_directory_uri() . '/admin-dashboard/dist/reviewnews_customizer_scripts.build.js',
      array('jquery', 'jquery-ui-sortable', 'customize-controls'),
      '1.0.1', // Updated version
      true
    );

    wp_enqueue_style(
      'header-footer-builder-customizer',
      get_template_directory_uri() . '/assets/css/customizer-builder.css',
      array(),
      '1.0.1'
    );

    // Enhanced localization with element settings mapping
    $all_available_blocks_config = reviewnews_afthfb_get_all_registered_blocks();
    $allowed_header_blocks = array_keys(reviewnews_afthfb_get_available_blocks());
    $allowed_footer_blocks = array_keys(reviewnews_afthfb_get_footer_available_blocks());

    // Create settings mapping for JS
    $settings_mapping = array();
    foreach ($all_available_blocks_config as $block_id => $block_config) {
      if (!empty($block_config['settings'])) {
        $settings_mapping[$block_id] = array();
        foreach ($block_config['settings'] as $setting_id => $setting_config) {
          $settings_mapping[$block_id][] = "reviewnews_afthfb_{$block_id}_{$setting_id}";
        }
      }
    }

    wp_localize_script(
      'header-footer-builder-customizer',
      'athfbCustomizer',
      array(
        'allAvailableBlocks' => $all_available_blocks_config,
        'allowedHeaderBlocks' => $allowed_header_blocks,
        'allowedFooterBlocks' => $allowed_footer_blocks,
        'settingsMapping' => $settings_mapping,
        'nonce' => wp_create_nonce('reviewnews_afthfb_customizer'),
        'strings' => array(
          'addElement' =>  esc_html__("Add Element", "reviewnews"),
          'removeElement' =>  esc_html__("Remove Element", 'reviewnews'),
          'configureElement' =>  esc_html__("Configure Element", "reviewnews"),
          'desktop' =>  esc_html__("Desktop", "reviewnews"),
          'elementSettings' =>  esc_html__("Element Settings", "reviewnews"),
        ),
      )
    );
  }

  /**
   * Enqueue Preview Scripts
   */
  public function enqueue_preview_scripts()
  {

    wp_enqueue_script(
      'header-footer-builder-previews',
      get_template_directory_uri() . '/js/preview-builder.js',
      array('jquery', 'customize-preview', 'reviewnews-fixed-header-script'),
      '1.0.0',
      true
    );
  }
}

// Initialize the builder
ReviewNews_Header_Footer_Builder::get_instance();
