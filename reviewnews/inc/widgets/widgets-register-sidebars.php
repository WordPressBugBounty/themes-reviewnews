<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function reviewnews_widgets_init()
{
   
    register_sidebar(array(
        'name'          => __('Header Banner Ad Section', 'reviewnews'),
        'id'            => 'home-advertisement-widgets',
        'description'   => __('Add widgets for frontpage banner section advertisement.', 'reviewnews'),
        'before_widget' => '<div id="%1$s" class="widget reviewnews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));



    register_sidebar(array(
        'name'          => __('Off Canvas Drawer Menu Section', 'reviewnews'),
        'id'            => 'express-off-canvas-panel',
        'description'   => __('Add widgets for off-canvas section.', 'reviewnews'),
        'before_widget' => '<div id="%1$s" class="widget reviewnews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));
    
    register_sidebar(array(
        'name' => __('Main Sidebar', 'reviewnews'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets for main sidebar.', 'reviewnews'),
        'before_widget' => '<div id="%1$s" class="widget reviewnews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));
    
    register_sidebar(array(
        'name' => __('Front-page Content Section', 'reviewnews'),
        'id' => 'home-content-widgets',
        'description' => __('Add widgets to front-page contents section.', 'reviewnews'),
        'before_widget' => '<div id="%1$s" class="widget reviewnews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name' => __('Front-page Sidebar Section', 'reviewnews'),
        'id' => 'home-sidebar-widgets',
        'description' => __('Add widgets to front-page sidebar section.', 'reviewnews'),
        'before_widget' => '<div id="%1$s" class="widget reviewnews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    
    
    register_sidebar(array(
        'name' => __('Footer Widget 1', 'reviewnews'),
        'id' => 'footer-first-widgets-section',
        'description' => __('Displays items on footer first column.', 'reviewnews'),
        'before_widget' => '<div id="%1$s" class="widget reviewnews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));


    register_sidebar(array(
        'name' => __('Footer Widget 2', 'reviewnews'),
        'id' => 'footer-second-widgets-section',
        'description' => __('Displays items on footer second column.', 'reviewnews'),
        'before_widget' => '<div id="%1$s" class="widget reviewnews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name' => __('Footer Widget 3', 'reviewnews'),
        'id' => 'footer-third-widgets-section',
        'description' => __('Displays items on footer third column.', 'reviewnews'),
        'before_widget' => '<div id="%1$s" class="widget reviewnews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));



}

add_action('widgets_init', 'reviewnews_widgets_init');