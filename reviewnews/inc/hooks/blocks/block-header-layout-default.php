<?php

/**
 * List block part for displaying header content in page.php
 *
 * @package ReviewNews
 */

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
$reviewnews_show_top_header_section = reviewnews_get_option('show_top_header_section');
?>
<?php if ($reviewnews_show_top_header_section) : ?>
  <div class="top-header">
    <div class="container-wrapper">
      <div class="top-bar-flex">
        <div class="top-bar-left col-2">
          <div class="date-bar-left">
            <?php do_action('reviewnews_load_date'); ?>
          </div>
        </div>
        <div class="top-bar-right col-2">
          <div class="aft-small-social-menu">
            <?php do_action('reviewnews_load_social_menu'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="af-middle-header <?php echo esc_attr($reviewnews_class); ?>" <?php echo $inline_style; ?>>
  <div class="container-wrapper">

    <?php if (has_header_image() && $select_header_image_mode == 'above') : ?>
      <div class="header-image-above-site-title">
        <img src="<?php echo esc_url(get_header_image()); ?>" alt="<?php echo esc_attr(get_bloginfo('title')); ?>" />
      </div>
    <?php endif; ?>
    <div class="af-middle-container">
      <div class="logo">
        <?php do_action('reviewnews_load_site_branding'); ?>
      </div>
      <?php
      $reviewnews_banner_advertisement = reviewnews_get_option('banner_advertisement_section');
      if (('' != $reviewnews_banner_advertisement) || is_active_sidebar('home-advertisement-widgets')) {
        $reviewnews_banner_advertisement_scope = reviewnews_get_option('banner_advertisement_scope');

        if ($reviewnews_banner_advertisement_scope == 'front-page-only') :
          if (is_home() || is_front_page()) : ?>
            <div class="header-promotion">
              <?php do_action('reviewnews_action_banner_advertisement'); ?>
            </div>
          <?php endif;
        else : ?>
          <div class="header-promotion">
            <?php do_action('reviewnews_action_banner_advertisement'); ?>
          </div>
      <?php endif;
      }
      ?>
    </div>
  </div>
</div>
<?php
        if (!reviewnews_is_amp()) {
          if (is_active_sidebar('express-off-canvas-panel')) : ?>
            
            <div id="sidr" class="primary-background">
              <a class="sidr-class-sidr-button-close" aria-label="<?php esc_attr_e('Open Off-Canvas Navigation', 'reviewnews') ?>" href="#sidr"></a>
              <?php dynamic_sidebar('express-off-canvas-panel'); ?>
            </div>
        <?php endif;
        } ?>
<div id="main-navigation-bar" class="af-bottom-header">
  <div class="container-wrapper">
    <div class="bottom-bar-flex">
      <div class="offcanvas-navigaiton">
        <?php
        if (!reviewnews_is_amp()) {
          if (is_active_sidebar('express-off-canvas-panel')) : ?>
            <div class="off-cancas-panel">
              <?php do_action('reviewnews_load_off_canvas'); ?>
            </div>
            
        <?php endif;
        } ?>
        <div class="af-bottom-head-nav">
          <?php do_action('reviewnews_action_main_menu_nav'); ?>
        </div>
      </div>
      <div class="search-watch">
      <?php do_action('reviewnews_dark_and_light_mode'); ?>
        <?php do_action('reviewnews_load_search_form'); ?>
        <?php do_action('reviewnews_load_watch_online'); ?>
      </div>
    </div>
  </div>
</div>