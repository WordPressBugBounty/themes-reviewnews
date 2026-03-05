<?php

/**
 * Option Panel
 *
 * @package ReviewNews
 */

$reviewnews_default = reviewnews_get_default_theme_options();


/**
 * Front-page options section
 *
 * @package ReviewNews
 */



// Add Front-page Options Panel.
$wp_customize->add_panel(
    'main_banner_option_panel',
    array(
        'title' => __('Main Banner Options', 'reviewnews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'type'     => 'reviewnews-panel',
    )
);



//Flash news
$wp_customize->add_section(
    'frontpage_flash_news_settings',
    array(
        'title' => __('Breaking News', 'reviewnews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'main_banner_option_panel',
        'class'       => 'reviewnews-customizer-section',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting(
    'frontpage_flash_news_settings',
    array(
        'default' => $reviewnews_default['frontpage_flash_news_settings'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_setting(
    'show_flash_news_section',
    array(
        'default' => $reviewnews_default['show_flash_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'show_flash_news_section',
    array(
        'label' => __('Enable Flash News', 'reviewnews'),
        'section' => 'frontpage_flash_news_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


$wp_customize->add_setting(
    'flash_news_title',
    array(
        'default' => $reviewnews_default['flash_news_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'flash_news_title',
    array(
        'label' => __('Section Title ', 'reviewnews'),
        'section' => 'frontpage_flash_news_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'reviewnews_flash_posts_section_status'

    )

);

$wp_customize->add_setting(
    'select_flash_news_category',
    array(
        'default'           => $reviewnews_default['select_flash_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new reviewnews_Dropdown_Taxonomies_Control(
    $wp_customize,
    'select_flash_news_category',
    array(
        'label'       => __('Flash Posts Category', 'reviewnews'),
        'description' => __('Select category to be shown on trending posts ', 'reviewnews'),
        'section'     => 'frontpage_flash_news_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 100,
        'active_callback' => 'reviewnews_flash_posts_section_status'
    )
));




/**
 * Main Banner Slider Section
 * */

// Main banner Sider Section.
$wp_customize->add_section(
    'frontpage_main_banner_section_settings',
    array(
        'title' => __('Main Banner', 'reviewnews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'main_banner_option_panel',
        'class'       => 'reviewnews-customizer-section',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting(
    'show_main_news_section',
    array(
        'default' => $reviewnews_default['show_main_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'show_main_news_section',
    array(
        'label' => __('Enable Main Banner Section', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting(
    'main_banner_background_section',
    array(
        'default' => $default['main_banner_background_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control(
        $wp_customize,
        'main_banner_background_section',
        array(
            'label' => __('Main Banner Background Image', 'reviewnews'),
            'description' => esc_html(sprintf(__('Recommended Size %1$s px X %2$s px', 'reviewnews'), 1024, 800)),
            'section' => 'frontpage_main_banner_section_settings',
            'width' => 1024,
            'height' => 800,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 100,
            'active_callback' => 'reviewnews_main_banner_section_status'
        )
    )
);


//main banner layout

$wp_customize->add_setting(
    'select_main_banner_layout_section',
    array(
        'default' => $reviewnews_default['select_main_banner_layout_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control(
    'select_main_banner_layout_section',
    array(
        'label' => __('Select Main Banner Layout', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'layout-10' => __("Slider and Double Tiles", 'reviewnews'),            
            'layout-2' => __("Slider, Tiles and Trending", 'reviewnews'),            
            'layout-9' => __("Slider and Double Trending", 'reviewnews'),
        ),
        'priority' => 100,
        'active_callback' => 'reviewnews_main_banner_section_status'
    )
);



//main banner order

$wp_customize->add_setting(
    'select_main_banner_order',
    array(
        'default' => $reviewnews_default['select_main_banner_order'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control(
    'select_main_banner_order',
    array(
        'label' => __('Select Main Banner Order', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'order-1' => __("Order 1", 'reviewnews'),
            'order-2' => __("Order 2", 'reviewnews'),
            'order-3' => __("Order 3", 'reviewnews'),

        ),
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                
            );
        },
    )
);



/**
 * Main Banner Section
 * */

//section title
$wp_customize->add_setting(
    'main_banner_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ReviewNews_Section_Title(
        $wp_customize,
        'main_banner_panel_section_title',
        array(
            'label' => __('Main News Section ', 'reviewnews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => 'reviewnews_main_banner_section_status',
        )
    )
);

$wp_customize->add_setting(
    'main_banner_news_section_title',
    array(
        'default' => $reviewnews_default['main_banner_news_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'main_banner_news_section_title',
    array(
        'label' => __('Section Title ', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'reviewnews_main_banner_section_status'

    )

);



// Setting - select_main_banner_section_mode.
$wp_customize->add_setting(
    'select_main_banner_carousel_filterby',
    array(
        'default' => $reviewnews_default['select_main_banner_carousel_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control(
    'select_main_banner_carousel_filterby',
    array(
        'label' => __('Filter Posts By', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => __("Category", 'reviewnews'),
            'tag' => __("Tag", 'reviewnews'),
        ),
        'priority' => 100,
        'active_callback' => 'reviewnews_main_banner_section_status'
    )
);


// Setting - drop down category for slider.
$wp_customize->add_setting(
    'select_slider_news_category',
    array(
        'default' => $reviewnews_default['select_slider_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ReviewNews_Dropdown_Taxonomies_Control(
    $wp_customize,
    'select_slider_news_category',
    array(
        'label' => __('Select Category', 'reviewnews'),
        'description' => __('Select category to be shown on main slider section', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                &&
                reviewnews_main_banner_section_filterby_cat_status($control)
            );
        },

    )
));


// Setting - drop down category for slider.
$wp_customize->add_setting(
    'select_slider_news_tag',
    array(
        'default' => $reviewnews_default['select_slider_news_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ReviewNews_Dropdown_Taxonomies_Control(
    $wp_customize,
    'select_slider_news_tag',
    array(
        'label' => __('Select Tag', 'reviewnews'),
        'description' => __('Select tag to be shown on main slider section', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                &&
                reviewnews_main_banner_section_filterby_tag_status($control)
            );
        },
    )
));

/**
 * Editor's Picks Post Section
 * */


//section title
$wp_customize->add_setting(
    'editors_picks_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ReviewNews_Section_Title(
        $wp_customize,
        'editors_picks_panel_section_title',
        array(
            'label' => __("Editor's Picks Section", 'reviewnews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => function ($control) {
                return (
                    reviewnews_main_banner_section_status($control)
                   
                );
            },
        )
    )
);


$wp_customize->add_setting(
    'main_editors_picks_section_title',
    array(
        'default' => $reviewnews_default['main_editors_picks_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'main_editors_picks_section_title',
    array(
        'label' => __('Section Title ', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'settings' => 'main_editors_picks_section_title',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                
            );
        },

    )

);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting(
    'select_editors_picks_filterby',
    array(
        'default' => $reviewnews_default['select_editors_picks_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control(
    'select_editors_picks_filterby',
    array(
        'label' => __('Filter Posts By', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => __("Category", 'reviewnews'),
            'tag' => __("Tag", 'reviewnews'),

        ),
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                
            );
        },
    )
);


// Setting - drop down category for slider.
$wp_customize->add_setting(
    'select_editors_picks_news_category',
    array(
        'default' => $reviewnews_default['select_editors_picks_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ReviewNews_Dropdown_Taxonomies_Control(
    $wp_customize,
    'select_editors_picks_news_category',
    array(
        'label' => __('Select', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                &&
                reviewnews_editors_picks_section_filterby_cat_status($control)
                
            );
        },

    )
));


// Setting - drop down category for slider.
$wp_customize->add_setting(
    'select_editors_picks_news_tag',
    array(
        'default' => $reviewnews_default['select_editors_picks_news_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ReviewNews_Dropdown_Taxonomies_Control(
    $wp_customize,
    'select_editors_picks_news_tag',
    array(
        'label' => __('Select Tag', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                &&
                reviewnews_editors_picks_section_filterby_tag_status($control)
                
            );
        },
    )
));



//Editors Picks 2 Start

/**
 * Editor's Picks Post Section
 * */


//section title
$wp_customize->add_setting(
    'editors_picks_panel_section_title_2',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new ReviewNews_Section_Title(
        $wp_customize,
        'editors_picks_panel_section_title_2',
        array(
            'label' => __("Trending Section", 'reviewnews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => function ($control) {
                return (
                    reviewnews_main_banner_section_status($control)
                    
                );
            },
        )
    )
);


$wp_customize->add_setting(
    'main_editors_picks_section_title_2',
    array(
        'default' => $reviewnews_default['main_editors_picks_section_title_2'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'main_editors_picks_section_title_2',
    array(
        'label' => __('Section Title ', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                
            );
        },

    )

);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting(
    'select_editors_picks_filterby_2',
    array(
        'default' => $reviewnews_default['select_editors_picks_filterby_2'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control(
    'select_editors_picks_filterby_2',
    array(
        'label' => __('Filter Posts By', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(            
            'tag' => __("Tag", 'reviewnews'),
            'comment' => __("Comment Count", 'reviewnews'),            
        ),
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                
            );
        },
    )
);


// Setting - drop down category for slider.
$wp_customize->add_setting(
    'select_editors_picks_news_category_2',
    array(
        'default' => $reviewnews_default['select_editors_picks_news_category_2'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ReviewNews_Dropdown_Taxonomies_Control(
    $wp_customize,
    'select_editors_picks_news_category_2',
    array(
        'label' => __('Select', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                &&
                reviewnews_editors_picks_section_filterby_cat_status_2($control)
                
            );
        },

    )
));


// Setting - drop down category for slider.
$wp_customize->add_setting(
    'select_editors_picks_news_tag_2',
    array(
        'default' => $reviewnews_default['select_editors_picks_news_tag_2'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new ReviewNews_Dropdown_Taxonomies_Control(
    $wp_customize,
    'select_editors_picks_news_tag_2',
    array(
        'label' => __('Select Tag', 'reviewnews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                reviewnews_main_banner_section_status($control)
                &&
                reviewnews_editors_picks_section_filterby_tag_status_2($control)
                
            );
        },
    )
));

//Editors Picks 2 End







/**
 * Front-page options section
 *
 * @package ReviewNews
 */


// Add Front-page Options Panel.
$wp_customize->add_panel(
    'frontpage_option_panel',
    array(
        'title' => __('Front-page Options', 'reviewnews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'type'     => 'reviewnews-panel',
    )
);



/**
 * Featured Post Section
 * */

$wp_customize->add_section(
    'frontpage_featured_posts_settings',
    array(
        'title' => __('Featured Posts', 'reviewnews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
        'class'       => 'reviewnews-customizer-section',
    )
);




// Setting - show_featured_posts_section.
$wp_customize->add_setting(
    'show_featured_posts_section',
    array(
        'default' => $reviewnews_default['show_featured_posts_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'show_featured_posts_section',
    array(
        'label' => __('Enable Featured Post Section', 'reviewnews'),
        'section' => 'frontpage_featured_posts_settings',
        'type' => 'checkbox',
        'priority' => 22,


    )
);

$wp_customize->add_setting(
    'featured_news_section_title',
    array(
        'default' => $reviewnews_default['featured_news_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'featured_news_section_title',
    array(
        'label' => __('Section Title ', 'reviewnews'),
        'section' => 'frontpage_featured_posts_settings',
        'type' => 'text',
        'priority' => 130,
        'active_callback' => 'reviewnews_featured_posts_section'

    )

);

//List of categories

$wp_customize->add_setting(
    'select_featured_news_category',
    array(
        'default' => $reviewnews_default['select_featured_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(new ReviewNews_Dropdown_Taxonomies_Control(
    $wp_customize,
    'select_featured_news_category',
    array(
        'label' => sprintf(__('Select ', 'reviewnews')),
        'description' => __('Select category to be shown on featured section ', 'reviewnews'),
        'section' => 'frontpage_featured_posts_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 130,
        'active_callback' => 'reviewnews_featured_posts_section',


    )
));



/**
 * Posts List Section
 * */


$wp_customize->add_section(
    'frontpage_featured_post_list_settings',
    array(
        'title' => __('Posts List', 'reviewnews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
        'class'       => 'reviewnews-customizer-section',
    )
);

// Setting - show_featured_category_section.
$wp_customize->add_setting(
    'show_featured_post_list_section',
    array(
        'default' => $reviewnews_default['show_featured_post_list_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'show_featured_post_list_section',
    array(
        'label' => __('Enable Post List Section', 'reviewnews'),
        'section' => 'frontpage_featured_post_list_settings',
        'settings' => 'show_featured_post_list_section',
        'type' => 'checkbox',
        'priority' => 22,


    )
);

for ($reviewnews_i = 1; $reviewnews_i <= 3; $reviewnews_i++) {

    //section title
    $wp_customize->add_setting(
        'express_posts_panel_section_title_' . $reviewnews_i,
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        new ReviewNews_Section_Title(
            $wp_customize,
            'express_posts_panel_section_title_' . $reviewnews_i,
            array(
                'label' => sprintf(__('Section %d', 'reviewnews'), $reviewnews_i),
                'section' => 'frontpage_featured_post_list_settings',
                'priority' => 130,
                'active_callback' => 'reviewnews_featured_post_list_section_status'
            )
        )
    );


    // Setting - featured_category_section.
    $wp_customize->add_setting(
        'featured_post_list_section_title_' . $reviewnews_i,
        array(
            'default' => $reviewnews_default['featured_post_list_section_title_' . $reviewnews_i],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'featured_post_list_section_title_' . $reviewnews_i,
        array(
            'label' => __('Section Title', 'reviewnews'),
            'section' => 'frontpage_featured_post_list_settings',
            'type' => 'text',
            'priority' => 130,
            'active_callback' => 'reviewnews_featured_post_list_section_status'

        )

    );


    // Setting - featured  category1.
    $wp_customize->add_setting(
        'featured_post_list_category_section_' . $reviewnews_i,
        array(
            'default' => $reviewnews_default['featured_post_list_category_section_' . $reviewnews_i],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(new ReviewNews_Dropdown_Taxonomies_Control(
        $wp_customize,
        'featured_post_list_category_section_' . $reviewnews_i,
        array(
            'label' => __('Category', 'reviewnews'),
            'description' => __('Select category to be shown on featured section ', 'reviewnews'),
            'section' => 'frontpage_featured_post_list_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 130,
            'active_callback' => 'reviewnews_featured_post_list_section_status'
        )
    ));
}
/* End Featured Category Section */



// Front-page Layout Section.
$wp_customize->add_section(
    'frontpage_layout_settings',
    array(
        'title' => __('Front-page Layout Settings', 'reviewnews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
        'class'       => 'reviewnews-customizer-section',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting(
    'frontpage_content_type',
    array(
        'default' => $reviewnews_default['frontpage_content_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control(
    'frontpage_content_type',
    array(
        'label' => __('Front-page Content Display', 'reviewnews'),
        'description' => __('Select frontpage content display', 'reviewnews'),
        'section' => 'frontpage_layout_settings',
        'settings' => 'frontpage_content_type',
        'type' => 'select',
        'choices' => array(
            'frontpage-widgets' => __('Front-page Widgets', 'reviewnews'),
            'frontpage-widgets-and-content' => __('Page Contents & Front-page Widgets', 'reviewnews'),
        ),
        'priority' => 10,
    )
);

// Setting - show_main_news_section.
$wp_customize->add_setting(
    'frontpage_content_alignment',
    array(
        'default' => $reviewnews_default['frontpage_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'reviewnews_sanitize_select',
    )
);

$wp_customize->add_control(
    'frontpage_content_alignment',
    array(
        'label' => __('Front-page Content Alignment', 'reviewnews'),
        'description' => __('Select frontpage content alignment', 'reviewnews'),
        'section' => 'frontpage_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => __('Home Content - Home Sidebar', 'reviewnews'),
            'align-content-right' => __('Home Sidebar - Home Content', 'reviewnews'),
            'full-width-content' => __('Only Home Content', 'reviewnews')
        ),
        'priority' => 10,
    )
);
