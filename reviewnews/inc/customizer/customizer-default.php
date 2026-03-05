<?php

/**
 * Default theme options.
 *
 * @package ReviewNews
 */

if (!function_exists('reviewnews_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function reviewnews_get_default_theme_options()
    {

        $defaults = array();
        // Preloader options section
        $defaults['enable_site_preloader'] = 0;
        $defaults['disable_wp_emoji'] = 0;
        $defaults['disable_theme_meta_tags'] = 0;
        $defaults['show_primary_menu_desc'] = 0;

        // Header options section
        $defaults['reviewnews_afthfb_show_checkbox_header'] = false;
        $defaults['reviewnews_afthfb_show_checkbox_footer'] = false;
        $defaults['header_layout'] = 'header-layout-side';
        $defaults['sticky_header_direction'] = 'scrollup-sticky-header';
        $defaults['disable_sticky_header_option'] = 0;
        $defaults['show_top_header_section'] = 1;
        $defaults['show_social_menu_section'] = 1;

        $defaults['show_date_section'] = 1;
        $defaults['show_time_section'] = 1;
        $defaults['top_header_time_format'] = 'en-US';

        $defaults['global_show_min_read']           = 'yes';
        $defaults['global_show_min_read_number']   = 200;
        $defaults['global_show_categories']           = 'yes';


        $defaults['enable_site_mode_switch'] = 'aft-enable-mode-switch';

        $defaults['global_site_mode_setting']    = 'aft-default-mode';

        $defaults['show_watch_online_section']           = 1;

        $defaults['aft_custom_icon']           = 'fas fa-play';
        $defaults['aft_custom_title']           = __('Subscribe', 'reviewnews');
        $defaults['aft_custom_link']           = '';
        $defaults['disable_header_image_tint_overlay'] = 1;
        $defaults['select_header_image_mode'] = 'default';

        $defaults['banner_advertisement_section'] = '';
        $defaults['banner_advertisement_section_url'] = '';

        $defaults['banner_advertisement_scope'] = 'site-wide';
        //Popular Tags
        $defaults['frontpage_popular_tags_settings'] = '';
        $defaults['show_popular_tags_section'] = 0;
        $defaults['frontpage_popular_tags_section_title'] = __('Popular Tags', 'reviewnews');
        $defaults['number_of_popular_tags'] = 10;
        $defaults['select_popular_tags_mode'] = 'category';
        //Flash news
        $defaults['frontpage_flash_news_settings'] = '';
        $defaults['show_flash_news_section'] = 1;
        $defaults['flash_news_title'] = __('Breaking News', 'reviewnews');
        $defaults['select_flash_news_category'] = 0;
        $defaults['number_of_flash_news'] = 5;



        //List post section
        $defaults['frontpage_list_pots_section_settings'] = __('Posts List Section', 'reviewnews');
        $defaults['show_featured_post_list_section'] = 1;
        $defaults['featured_post_list_section_title_1'] = __('General', 'reviewnews');
        $defaults['featured_post_list_category_section_1'] = 0;
        $defaults['featured_post_list_section_title_2'] = __('Update', 'reviewnews');
        $defaults['featured_post_list_category_section_2'] = 0;
        $defaults['featured_post_list_section_title_3'] = __('More', 'reviewnews');
        $defaults['featured_post_list_category_section_3'] = 0;



        // breadcrumb options section
        $defaults['enable_breadcrumb'] = 1;
        $defaults['select_breadcrumb_mode'] = 'default';


        // Front-page Section.
        $defaults['show_main_news_section'] = 1;
        $defaults['main_banner_background_section'] = 0;


        $defaults['select_main_banner_layout_section'] = 'layout-2';

        $defaults['main_banner_news_section_title'] = __('Main News', 'reviewnews');
        $defaults['select_main_banner_order'] = 'order-1';
        $defaults['main_trending_news_section_title'] = __('Trending Now', 'reviewnews');
        $defaults['select_trending_post_filterby'] = 'tag';
        $defaults['select_trending_post_category'] = 0;
        $defaults['select_trending_post_tag'] = 0;
        $defaults['trending_post_number_of_slides'] = 5;
        $defaults['select_slider_news_category'] = 0;
        $defaults['select_slider_news_tag'] = 0;
        $defaults['select_tab_section_mode'] = 'default';


        $defaults['select_main_banner_section_mode'] = 'banner-carousel';

        $defaults['select_main_banner_carousel_filterby'] = 'cat';

        $defaults['main_editors_picks_section_title'] = __("Editor's Picks", 'reviewnews');
        $defaults['select_editors_picks_filterby'] = 'cat';
        $defaults['select_editors_picks_news_category'] = 0;
        $defaults['select_editors_picks_news_tag'] = 0;

        $defaults['main_editors_picks_section_title_2'] = __("Trending Now", 'reviewnews');
        $defaults['select_editors_picks_filterby_2'] = 'tag';
        $defaults['select_editors_picks_news_category_2'] = 0;
        $defaults['select_editors_picks_news_tag_2'] = 0;

        $defaults['select_main_banner_carousel_layout_option'] = 'square-default';

        $defaults['main_banner_section_background_color'] = '#202020';
        $defaults['main_banner_section_secondary_background_color'] = '#212121';
        $defaults['main_banner_section_texts_color'] = '#ffffff';
        $defaults['main_banner_section_background_image'] = 0;
        $defaults['number_of_slides'] = 5;       

        $defaults['show_featured_posts_section'] = 1;
        $defaults['featured_news_section_title'] = __('Featured Posts', 'reviewnews');
        $defaults['number_of_featured_news'] = 4;
        //$defaults['select_featured_post'] = 0;

        $defaults['show_featured_category_section'] = 0;
        $defaults['select_featured_news_category'] = 0;

        $defaults['featured_category_section'] = __('Featured Categories', 'reviewnews');
        $defaults['featured_page_section'] = __('Featured Pages', 'reviewnews');
        $defaults['featured_custom_section'] = __('Custom Options', 'reviewnews');

        for ($i = 1; $i < 5; $i++) {
            $defaults['featured_category_section_' . $i] =  esc_html(sprintf(__('Post list Section Title %d', 'reviewnews'), $i));
            $defaults['featured_category_image_' . $i] = '';
            $defaults['select_featured_category_' . $i] = 0;
            $defaults['select_featured_page_' . $i] = 0;
            $defaults['featured_custom_image_' . $i] = '';
            $defaults['featured_custom_url_' . $i] = '';
            $defaults['featured_custom_text_' . $i] = __('View More', 'reviewnews');
        }

        $defaults['show_featured_category_page_section'] = 'category';

        $defaults['frontpage_content_alignment'] = 'align-content-left';
        $defaults['frontpage_content_type'] = 'frontpage-widgets-and-content';
        $defaults['frontpage_sticky_sidebar'] = 1;
        $defaults['frontpage_sticky_sidebar_position'] = 'sidebar-sticky-top';

        //layout options
        $defaults['global_content_layout'] = 'default-content-layout';
        $defaults['global_content_alignment'] = 'align-content-left';
        $defaults['global_fetch_content_image_setting'] = 'enable';
        $defaults['global_toggle_image_lazy_load_setting'] = 'enable';
        $defaults['global_decoding_image_async_setting'] = 'enable';
        $defaults['global_image_alignment'] = 'full-width-image';
        $defaults['global_post_date_author_setting'] = 'show-date-author';
        $defaults['small_grid_post_date_author_setting'] = 'show-date-author';
        $defaults['list_post_date_author_setting'] = 'show-date-author';
        $defaults['global_author_icon_gravatar_display_setting'] = 'display-icon';

        $defaults['global_excerpt_length'] = 18;
        $defaults['global_read_more_texts'] = __('Read More', 'reviewnews');
        $defaults['global_widget_excerpt_setting'] = 'default-excerpt';
        $defaults['global_date_display_setting'] = 'default-date';
        $defaults['single_date_display_type'] = 'both';
        $defaults['global_date_display_type'] = 'published';

        $defaults['archive_layout'] = 'archive-layout-grid';
        $defaults['archive_layout_first_post_full'] = 0;
        $defaults['archive_pagination_view'] = 'archive-default';
        $defaults['archive_image_alignment_grid'] = 'archive-image-default';
        $defaults['search_archive_content_view'] = 'all';
        $defaults['search_archive_enable_ajax'] = 1;
        $defaults['search_archive_ajax_results'] = 3;

        //grid column optoon
        $defaults['archive_grid_column_layout'] = 'grid-layout-three';
        $defaults['archive_image_alignment'] = 'archive-image-left';



        $defaults['archive_layout_full'] = 'full-image-first';

        $defaults['archive_content_view'] = 'archive-content-excerpt';
        $defaults['disable_main_banner_on_blog_archive'] = 1;

        //Related posts
        $defaults['single_show_featured_image'] = 1;
        $defaults['single_featured_image_size'] = 'full';
        $defaults['single_featured_image_view'] = 'original';
        $defaults['global_single_content_mode'] = 'single-content-mode-default';

        $defaults['single_show_tags_list'] = 0;
        $defaults['single_show_theme_author_bio'] = 1;

        $defaults['single_post_title_view']     = 'boxed';

        $defaults['single_post_social_share_type']     = 'theme';
        $defaults['single_post_social_share_view']     = 'after-content';
        $defaults['single_post_social_share_copylink']     = 1;
        $defaults['single_post_social_share_facebook']     = 1;
        $defaults['single_post_social_share_twitter']     = 1;
        $defaults['single_post_social_share_email']     = 1;

        //Related posts
        $defaults['single_show_related_posts'] = 1;
        $defaults['single_related_posts_title']     = __('Related Stories', 'reviewnews');
        $defaults['single_number_of_related_posts']  = 6;

        //Pagination.
        $defaults['site_pagination_type'] = 'default';



        // Footer.
        // Latest posts
        $defaults['frontpage_show_latest_posts'] = 1;
        $defaults['frontpage_latest_posts_section_title'] = __('You May Have Missed', 'reviewnews');
        $defaults['frontpage_latest_posts_category'] = 0;
        $defaults['number_of_frontpage_latest_posts'] = 4;

        $defaults['footer_copyright_text'] = __('Copyright &copy; {year} All rights reserved.', 'reviewnews');
        $defaults['hide_footer_menu_section']  = 0;
        $defaults['hide_footer_site_title_section']  = 0;
        $defaults['hide_footer_copyright_credits']  = 0;
        $defaults['number_of_footer_widget']  = 3;

        $defaults['footer_background_image'] = 0;



        // font and color options

        $defaults['secondary_color']     = '#0047AB';
        $defaults['light_background_color']     = '#f5f5f5';
        $defaults['dark_background_color']     = '#101010';
        $defaults['link_color']     = '#0047AB ';
        $defaults['link_color_dark']     = '#ffffff ';
        $defaults['link_hover_color']     = '#0047AB ';
        $defaults['link_hover_color_dark']     = '#ffffff ';


        //font options additional value
        global $reviewnews_google_fonts;
        $reviewnews_google_fonts = array(

            'Inter:400,700'                             => 'Inter',
            'Open+Sans:400,400italic,600,700'           => 'Open Sans',
            'Oswald:300,400,700'                        => 'Oswald',
            'Noto+Sans:400,400italic,700'               => 'Noto Sans',
        );

        //font option

        $defaults['global_font_family_type']      = 'google';
        $defaults['site_title_font']      = 'Inter:400,700';
        $defaults['primary_font']      = 'Noto+Sans:400,400italic,700';
        $defaults['secondary_font']    = 'Inter:400,700';

        $defaults['global_widget_title_border']       = 'widget-title-fill-and-border';
        $defaults['global_scroll_to_top_position']    = 'right';
        $defaults['global_show_comment_count']        = 'yes';
        $defaults['global_show_view_count']           = 'yes';
        $defaults['global_show_primary_menu_border']  = 'show-menu-border';

        $defaults['global_show_categories']           = 'yes';
        $defaults['global_number_of_categories']        = 'all';
        $defaults['global_custom_number_of_categories']  = 3;

        $defaults['global_site_layout_setting']    = 'wide';
        $defaults['global_site_layout_tone']    = 'default';
        $defaults['global_site_layout_topbottom_gaps']    = true;

        $defaults['site_title_uppercase']    = false;

        //font size
        $defaults['site_title_font_size']    = 41;


        // Pass through filter.
        $defaults = apply_filters('reviewnews_filter_default_theme_options', $defaults);

        return $defaults;
    }

endif;
