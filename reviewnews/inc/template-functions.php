<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ReviewNews
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function reviewnews_body_classes($classes)
{
  // Adds a class of hfeed to non-singular pages.
  if (!is_singular()) {
    $classes[] = 'hfeed';
  }

  
  $sticky_header = reviewnews_get_option('disable_sticky_header_option');
  if ($sticky_header ==  false) {
    $sticky_header_class = reviewnews_get_option('sticky_header_direction');
    $classes[] = $sticky_header_class . ' aft-sticky-header';
  }


  $global_site_mode_setting = reviewnews_get_option('global_site_mode_setting');
  $reviewnews_enable_site_mode_switch = reviewnews_get_option('enable_site_mode_switch');
  if ($reviewnews_enable_site_mode_switch == 'aft-enable-mode-switch') {
    if (isset($_COOKIE["reviewnews-stored-site-mode"])) {
      $classes[] = $_COOKIE["reviewnews-stored-site-mode"];
    } else {
      if (!empty($global_site_mode_setting)) {
        $classes[] = $global_site_mode_setting;
      }
    }
  } else {
    if (!empty($global_site_mode_setting)) {
      $classes[] = $global_site_mode_setting;
    }
  }

  $header_layout = reviewnews_get_option('header_layout');
  $reviewnews_enable_header_builder = reviewnews_get_option('reviewnews_afthfb_show_checkbox_header');
  if ($reviewnews_enable_header_builder) {
    $classes[] =  'aft-header-layout-side';
  } else {
    if (!empty($header_layout)) {
      $classes[] = 'aft-' . $header_layout;
    }
  }

  $select_header_image_mode = reviewnews_get_option('select_header_image_mode');
  if ($select_header_image_mode == 'full') {
    $classes[] = 'header-image-full';
  } elseif ($select_header_image_mode == 'above') {
    $classes[] = 'header-image-above';
  } else {
    $classes[] = 'header-image-default';
  }

  

  $global_widget_title_border = reviewnews_get_option('global_widget_title_border');
  if (!empty($global_widget_title_border)) {
    $classes[] = $global_widget_title_border;
  }


  global $post;

  $global_layout = reviewnews_get_option('global_content_layout');
  if (!empty($global_layout)) {
    $classes[] = $global_layout;
  }


  $global_alignment = reviewnews_get_option('global_content_alignment');
  $page_layout = $global_alignment;
  

  // Check if single.
  if ($post && is_singular()) {
    $post_options = get_post_meta($post->ID, 'reviewnews-meta-content-alignment', true);
    if (!empty($post_options)) {
      $page_layout = $post_options;
    } else {
      $page_layout = $global_alignment;
    }
  }

  // Check if single.
  if ($post && is_singular()) {
    $global_single_content_mode = reviewnews_get_option('global_single_content_mode');
    $post_single_content_mode = get_post_meta($post->ID, 'reviewnews-meta-content-mode', true);
    if (!empty($post_single_content_mode)) {
      $classes[] = $post_single_content_mode;
    } else {
      $classes[] = $global_single_content_mode;
    }
  }


  // Check if single.
  if ($post && is_singular()) {
    $single_post_title_view = reviewnews_get_option('single_post_title_view');
    $classes[] = 'single-post-title-' . $single_post_title_view;
  }


  if (is_front_page()) {
    $frontpage_layout = reviewnews_get_option('frontpage_content_alignment');
    if (!empty($frontpage_layout)) {
      $page_layout = $frontpage_layout;
    }
  }

  if (!is_front_page() && is_home()) {
    $page_layout = $global_alignment;
  }

  if ($page_layout == 'align-content-right') {
    if (is_front_page() && !is_home()) {
      if (class_exists('WooCommerce')) {
        if (is_shop()) {
          if (is_active_sidebar('sidebar-1')) {
            $classes[] = 'align-content-right';
          } else {
            $classes[] = 'full-width-content';
          }
        } else {
          if (is_active_sidebar('home-sidebar-widgets')) {
            $classes[] = 'align-content-right';
          } else {
            $classes[] = 'full-width-content';
          }
        }
      } else {
        if (is_active_sidebar('home-sidebar-widgets')) {
          $classes[] = 'align-content-right';
        } else {
          $classes[] = 'full-width-content';
        }
      }
    } else {
      if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'align-content-right';
      } else {
        $classes[] = 'full-width-content';
      }
    }
  } elseif ($page_layout == 'full-width-content') {
    $classes[] = 'full-width-content';
  } else {
    if (is_front_page() && !is_home()) {

      if (class_exists('WooCommerce')) {
        if (is_shop()) {
          if (is_active_sidebar('sidebar-1')) {
            $classes[] = 'align-content-left';
          } else {
            $classes[] = 'full-width-content';
          }
        } else {
          if (is_active_sidebar('home-sidebar-widgets')) {
            $classes[] = 'align-content-left';
          } else {
            $classes[] = 'full-width-content';
          }
        }
      } else {
        if (is_active_sidebar('home-sidebar-widgets')) {
          $classes[] = 'align-content-left';
        } else {
          $classes[] = 'full-width-content';
        }
      }
    } else {
      if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'align-content-left';
      } else {
        $classes[] = 'full-width-content';
      }
    }
  }


  $banner_layout = reviewnews_get_option('global_site_layout_setting');

  if ($banner_layout == 'wide') {
    $classes[] = 'af-wide-layout';
  } elseif ($banner_layout == 'full') {
    $classes[] = 'af-full-layout';
  } else {
    $classes[] = 'af-boxed-layout';

    $global_topbottom_gaps = reviewnews_get_option('global_site_layout_topbottom_gaps');
    if ($global_topbottom_gaps) {
      $classes[] = 'aft-enable-top-bottom-gaps';
    }
  }


  return $classes;
}

add_filter('body_class', 'reviewnews_body_classes');


function reviewnews_is_elementor()
{
  global $post;
  return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function reviewnews_pingback_header()
{
  if (is_singular() && pings_open()) {
    echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
  }
}

add_action('wp_head', 'reviewnews_pingback_header');

/**
 * Get posts based on filter type (category, tag, view count, comment count, etc.).
 *
 * @since ReviewNews 1.0.0
 *
 * @param int    $number_of_posts Number of posts to retrieve (max 50).
 * @param int    $term_id         Category or tag ID depending on filter.
 * @param string $filterby        Filter type: 'cat', 'tag', 'view', 'comment', 'recent'.
 * @param array  $extra_args      Optional extra WP_Query args (offset, date_query etc).
 * @return WP_Query               WP_Query object.
 */
if ( ! function_exists( 'reviewnews_get_posts' ) ) {
  function reviewnews_get_posts( $number_of_posts = 5, $term_id = 0, $filterby = 'cat', $extra_args = array() ) {
      $number_of_posts = absint( $number_of_posts );
      $number_of_posts = min( $number_of_posts, 20 );  // Cap to safe max.

      $term_id = absint( $term_id );
      $filterby = sanitize_key( $filterby );

      $args = array(
          'post_type'           => 'post',
          'posts_per_page'      => $number_of_posts,
          'post_status'         => 'publish',
          'ignore_sticky_posts' => true,
          'order'               => 'DESC',
          'no_found_rows'       => true,
      );

      switch ( $filterby ) {
          case 'tag':
              if ( $term_id > 0 ) {
                  $args['tag_id'] = $term_id;
              }
              $args['orderby'] = 'date';
              break;          

          case 'comment':
              $args['orderby'] = 'comment_count';
              break;

          case 'recent':
              // Possibly use date_query
              $args['orderby'] = 'date';
              break;

          case 'cat':
          default:
              if ( $term_id > 0 ) {
                  $args['cat'] = $term_id;
              }
              $args['orderby'] = 'date';
              break;
      }

      // Merge in any extra query args
      if ( is_array( $extra_args ) && ! empty( $extra_args ) ) {
          $args = array_merge( $args, $extra_args );
      }

      /**
       * Allow overriding query args.
       *
       * @param array $args           Final WP_Query arguments.
       * @param int   $number_of_posts Passed number of posts.
       * @param int   $term_id         Term ID.
       * @param string $filterby        Filter type.
       * @param array $extra_args      Extra args passed.
       */
      $args = apply_filters( 'reviewnews_get_posts_args', $args, $number_of_posts, $term_id, $filterby, $extra_args );

      return new WP_Query( $args );
  }
}



/**
 * Returns no image url.
 *
 * @since  ReviewNews 1.0.0
 */
if (!function_exists('reviewnews_post_format')) :
  function reviewnews_post_format($post_id)
  {
    $post_format = get_post_format($post_id);

    if ($post_format) {
      $format_url = get_post_format_link($post_format); // Get archive link for the post format

      switch ($post_format) {
        case "image":
          $icon = "<i class='fas fa-image'></i>";
          break;
        case "video":
          $icon = "<i class='fas fa-play'></i>";
          break;
        case "gallery":
          $icon = "<i class='fas fa-images'></i>";
          break;
        default:
          $icon = "";
          break;
      }

      if ($icon) {
        $post_format_html = "<div class='af-post-format em-post-format'><a href='" . esc_url($format_url) . "' aria-label='" . esc_attr(ucfirst($post_format)) . "'>" . $icon . "</a></div>";
      } else {
        $post_format_html = "";
      }
    } else {
      $post_format_html = "";
    }

    echo wp_kses_post($post_format_html);
  }
endif;


if (!function_exists('reviewnews_get_block')) :
  /**
   *
   * @param null
   *
   * @return null
   *
   * @since ReviewNews 1.0.0
   *
   */
  function reviewnews_get_block($block = 'grid', $section = 'post')
  {

    get_template_part('inc/hooks/blocks/block-' . $section, $block);
  }
endif;

if (!function_exists('reviewnews_archive_title')) :
  /**
   *
   * @param null
   *
   * @return null
   *
   * @since ReviewNews 1.0.0
   *
   */

  function reviewnews_archive_title($title)
  {
    if (is_category()) {
      $title = single_cat_title('', false);
    } elseif (is_tag()) {
      $title = single_tag_title('', false);
    } elseif (is_author()) {
      $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
      $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
      $title = single_term_title('', false);
    }

    return $title;
  }

endif;
add_filter('get_the_archive_title', 'reviewnews_archive_title');


/* Display Breadcrumbs */
if (!function_exists('reviewnews_get_breadcrumb')) :

  /**
   * Simple breadcrumb.
   *
   * @since 1.0.0
   */
  function reviewnews_get_breadcrumb()
  {

    $enable_breadcrumbs = reviewnews_get_option('enable_breadcrumb');

    if (1 != $enable_breadcrumbs) {
      return;
    }
    // Bail if Home Page.
    if (is_front_page() || is_home()) {
      return;
    }

    $select_breadcrumbs = reviewnews_get_option('select_breadcrumb_mode');

?>
    <div class="af-breadcrumbs font-family-1 color-pad">

      <?php
      if ((function_exists('yoast_breadcrumb')) && ($select_breadcrumbs == 'yoast')) {
        yoast_breadcrumb();
      } elseif ((function_exists('rank_math_the_breadcrumbs')) && ($select_breadcrumbs == 'rankmath')) {
        rank_math_the_breadcrumbs();
      } elseif ((function_exists('bcn_display')) && ($select_breadcrumbs == 'bcn')) {
        bcn_display();
      } else {
        reviewnews_get_breadcrumb_trail();
      }
      ?>

    </div>
  <?php


  }

endif;
add_action('reviewnews_action_get_breadcrumb', 'reviewnews_get_breadcrumb');

/* Display Breadcrumbs */
if (!function_exists('reviewnews_get_breadcrumb_trail')) :

  /**
   * Simple excerpt length.
   *
   * @since 1.0.0
   */

  function reviewnews_get_breadcrumb_trail()
  {

    if (!function_exists('breadcrumb_trail')) {

      /**
       * Load libraries.
       */

      require_once get_template_directory() . '/lib/breadcrumb-trail/breadcrumb-trail.php';
    }

    $breadcrumb_args = array(
      'container' => 'div',
      'show_browse' => false,
    );

    breadcrumb_trail($breadcrumb_args);
  }

endif;


/**
 * Front-page main banner section layout
 */
if (!function_exists('reviewnews_front_page_main_section_scope')) {

  function reviewnews_front_page_main_section_scope()
  {

    $reviewnews_hide_on_blog = reviewnews_get_option('disable_main_banner_on_blog_archive');

    if ($reviewnews_hide_on_blog) {
      if (is_front_page()) {
        do_action('reviewnews_action_front_page_main_section');
      }
    } else {
      if (is_front_page() || is_home()) {
        do_action('reviewnews_action_front_page_main_section');
      }
    }
  }
}
add_action('reviewnews_action_front_page_main_section_scope', 'reviewnews_front_page_main_section_scope');


/* Display Breadcrumbs */
if (!function_exists('reviewnews_excerpt_length')) :

  /**
   * Simple excerpt length.
   *
   * @since 1.0.0
   */

  function reviewnews_excerpt_length($length)
  {

    $reviewnews_global_excerpt_length = reviewnews_get_option('global_excerpt_length');
    if (is_admin()) {
      return $length;
    }
    return $reviewnews_global_excerpt_length;
  }

endif;
add_filter('excerpt_length', 'reviewnews_excerpt_length', 999);


/* Display Breadcrumbs */
if (!function_exists('reviewnews_excerpt_more')) :

  /**
   * Simple excerpt more.
   *
   * @since 1.0.0
   */
  function reviewnews_excerpt_more($more)
  {
    if (is_admin()) {
      return $more;
    }
    global $post;
    $reviewnews_global_read_more_texts = reviewnews_get_option('global_read_more_texts');
    //return $reviewnews_global_read_more_texts;
    return '';
  }

endif;
add_filter('excerpt_more', 'reviewnews_excerpt_more');

if (!function_exists('reviewnews_get_the_excerpt')) :

  /**
   * Simple excerpt more with descriptive "Read More" links.
   *
   * @since 1.0.0
   */
  function reviewnews_get_the_excerpt($post_id)
  {

    if (empty($post_id)) {
      return;
    }

    // Get the default excerpt for the post.
    $reviewnews_default_excerpt = get_the_excerpt($post_id);

    // Retrieve the "Read More" text from theme options.
    $reviewnews_global_read_more_texts = reviewnews_get_option('global_read_more_texts');

    // Get the post title to make the "Read More" link more descriptive.
    $post_title = get_the_title($post_id);

    // Create a descriptive "Read More" link, making it translation-ready.
    // Use `sprintf()` to dynamically insert the translated post title.
    $reviewnews_read_more = sprintf(
      '<div class="aft-readmore-wrapper">
         <a href="%1$s" class="aft-readmore" aria-label="%2$s">
           %3$s <span class="screen-reader-text">%4$s</span>
         </a>
       </div>',
      esc_url(get_permalink($post_id)),  // %1$s: Link to the post.
      esc_attr(sprintf(__('Read more about %s', 'reviewnews'), $post_title)), // %2$s: Aria-label, translation-ready.
      esc_html($reviewnews_global_read_more_texts), // %3$s: The main "Read More" text.
      esc_html(sprintf(__('Read more about %s', 'reviewnews'), $post_title)) // %4$s: Screen-reader text, translation-ready.
    );

    // Get the global excerpt length from theme options.
    $reviewnews_global_excerpt_length = reviewnews_get_option('global_excerpt_length');

    // Split the excerpt into words and truncate based on the defined length.
    $excerpt = explode(' ', $reviewnews_default_excerpt, $reviewnews_global_excerpt_length);
    if (count($excerpt) >= $reviewnews_global_excerpt_length) {
      array_pop($excerpt);
      $excerpt = implode(" ", $excerpt) . '...';
    } else {
      $excerpt = implode(" ", $excerpt);
    }

    // Remove any shortcodes or unwanted characters from the excerpt.
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);

    // Append the "Read More" link to the excerpt.
    $excerpt = $excerpt . $reviewnews_read_more;

    return $excerpt;
  }

endif;


/* Display Pagination */
if (!function_exists('reviewnews_numeric_pagination')) :

  /**
   * Simple excerpt more.
   *
   * @since 1.0.0
   */
  function reviewnews_numeric_pagination()
  {



    the_posts_pagination(array(
      'mid_size' => 3,
      'prev_text' => __('Previous', 'reviewnews'),
      'next_text' => __('Next', 'reviewnews'),
    ));
  }

endif;


/* Word read count Pagination */
// if (!function_exists('reviewnews_count_content_words')) :
//   /**
//    * @param $content
//    *
//    * @return string
//    */
//   function reviewnews_count_content_words($post_id)
//   {
//     $reviewnews_show_read_mins = reviewnews_get_option('global_show_min_read');
//     if ($reviewnews_show_read_mins == 'yes') {
//       $content = apply_filters('the_content', get_post_field('post_content', $post_id));
//       $reviewnews_read_words = reviewnews_get_option('global_show_min_read_number');
//       $reviewnews_decode_content = html_entity_decode($content);
//       $reviewnews_filter_shortcode = do_shortcode($reviewnews_decode_content);
//       $reviewnews_strip_tags = wp_strip_all_tags($reviewnews_filter_shortcode, true);
//       $reviewnews_count = str_word_count($reviewnews_strip_tags);
//       $reviewnews_word_per_min = (absint($reviewnews_count) / $reviewnews_read_words);
//       $reviewnews_word_per_min = ceil($reviewnews_word_per_min);

//       if (absint($reviewnews_word_per_min) > 0) {
//         $word_count_strings = sprintf(__("%s min read", 'reviewnews'), number_format_i18n($reviewnews_word_per_min));
//         if ('post' == get_post_type($post_id)) :
//           echo '<span class="min-read">';
//           echo esc_html($word_count_strings);
//           echo '</span>';
//         endif;
//       }
//     }
//   }

// endif;


if (!function_exists('reviewnews_count_content_words')) :

  function reviewnews_count_content_words($post_id)
  {
    
    $reviewnews_show_read_mins = reviewnews_get_option('global_show_min_read');
    if($reviewnews_show_read_mins == 'no'){
      return;
    }
    
    // Posts only
    if ('post' !== get_post_type($post_id)) {
      return;
    }

    // Get pre-saved reading time (best performance)
    $read_time = absint(get_post_meta($post_id, '_aft_read_time', true));

    // If not available (older posts), fallback once
    if (!$read_time) {

      // Lightweight processing (DO NOT use the_content filter)
      $content = get_post_field('post_content', $post_id);

      // Fast cleanup
      $clean_text = wp_strip_all_tags(strip_shortcodes($content), true);

      // Fast word count
      $word_count = str_word_count($clean_text);

      // Words per minute
      $wpm = absint(reviewnews_get_option('global_show_min_read_number'));
      if (!$wpm) {
        $wpm = 200;
      }

      $read_time = ceil($word_count / $wpm);

      // Store so it never recalculates again
      update_post_meta($post_id, '_aft_read_time', $read_time);
    }

    if ($read_time > 0) {

      // Translatable singular/plural
      $output = sprintf(
        _n(
          '%s minute read',
          '%s minutes read',
          $read_time,
          'reviewnews'
        ),
        number_format_i18n($read_time)
      );

      echo '<span class="min-read">' . esc_html($output) . '</span>';
    }
  }

endif;



/**
 * Check if given term has child terms
 *
 * @param Integer $term_id
 * @param String $taxonomy
 *
 * @return Boolean
 */
function reviewnews_list_popular_taxonomies($taxonomy = 'post_tag', $title = "Popular Tags", $number = 5)
{
  $popular_taxonomies = get_terms(array(
    'taxonomy' => $taxonomy,
    'number' => absint($number),
    'orderby' => 'count',
    'order' => 'DESC',
    'hide_empty' => true,
  ));

  $html = '';

  if (isset($popular_taxonomies) && !empty($popular_taxonomies)) :
    $html .= '<div class="aft-popular-taxonomies-lists clearfix">';
    if (!empty($title)) :
      $html .= '<span>';
      $html .= esc_html($title);
      $html .= '</span>';
    endif;
    $html .= '<ul>';
    foreach ($popular_taxonomies as $tax_term) :
      $html .= '<li>';
      $html .= '<a href="' . esc_url(get_term_link($tax_term)) . '">';
      $html .= $tax_term->name;
      $html .= '</a>';
      $html .= '</li>';
    endforeach;
    $html .= '</ul>';
    $html .= '</div>';
  endif;

  echo wp_kses_post($html);
}


/**
 * @param $post_id
 * @param string $size
 *
 * @return mixed|string
 */
function reviewnews_get_freatured_image_url($post_id, $size = 'large')
{
  $url = '';
  if (has_post_thumbnail($post_id)) {
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
    if (isset($thumb[0])) {
      $url = $thumb[0];
    }
  } else {
    $url = '';
  }

  return $url;
}


//Get attachment alt tag

if (!function_exists('reviewnews_get_img_alt')) :
  function reviewnews_get_img_alt($attachment_ID)
  {
    // Get ALT
    $thumb_alt = get_post_meta($attachment_ID, '_wp_attachment_image_alt', true);

    // No ALT supplied get attachment info
    if (empty($thumb_alt))
      $attachment = get_post($attachment_ID);

    // Use caption if no ALT supplied
    if (empty($thumb_alt))
      $thumb_alt = $attachment->post_excerpt;

    // Use title if no caption supplied either
    if (empty($thumb_alt))
      $thumb_alt = $attachment->post_title;

    // Return ALT
    return trim(strip_tags($thumb_alt));
  }
endif;

// Move Jetpack from the_content / the_excerpt to another position

function reviewnews_jptweak_remove_share()
{
  if (is_singular('post')) {
    remove_filter('the_content', 'sharing_display', 19);
    remove_filter('the_excerpt', 'sharing_display', 19);
  }
}

add_action('loop_start', 'reviewnews_jptweak_remove_share');

/**
 * Display comment count icon for posts
 *
 * @param int $post_id
 */
function reviewnews_get_comments_views_share( $post_id ) {

	if ( get_post_type( $post_id ) !== 'post' ) {
		return;
	}

	$show_comment_count = reviewnews_get_option( 'global_show_comment_count' );

	if ( 'yes' !== $show_comment_count ) {
		return;
	}

	$comment_count = get_comments_number( $post_id );
  if (comments_open($post_id) || $comment_count > 0) :
	// $permalink     = get_permalink( $post_id );
	?>
	<span class="aft-comment-view-share">
		<span class="aft-comment-count">
			<a href="<?php echo esc_url(get_comments_link($post_id)); ?>" aria-label="<?php echo esc_attr( sprintf( _n( '%s comment', '%s comments', $comment_count, 'reviewnews' ), number_format_i18n( $comment_count ) ) ); ?>">
				<i class="far fa-comment" aria-hidden="true"></i>
				<span class="aft-show-hover">
					<?php echo esc_html( number_format_i18n( $comment_count ) ); ?>
				</span>
			</a>
		</span>
	</span>
	<?php
  endif;
}

/**
 * Display comment count icon for posts
 *
 * @param int $post_id
 */
function reviewnews_get_comments_views_share_single( $post_id ) {

	if ( get_post_type( $post_id ) !== 'post' ) {
		return;
	}

	$show_comment_count = reviewnews_get_option( 'global_show_comment_count' );

	if ( 'yes' !== $show_comment_count ) {
		return;
	}

	$comment_count = get_comments_number( $post_id );
	// $permalink     = get_permalink( $post_id );
  if (comments_open($post_id) || $comment_count > 0) :
	?>
	<span class="aft-comment-view-share">
		<span class="aft-comment-count">
			<a href="<?php echo esc_url(get_comments_link($post_id)); ?>" aria-label="<?php echo esc_attr( sprintf( _n( '%s comment', '%s comments', $comment_count, 'reviewnews' ), number_format_i18n( $comment_count ) ) ); ?>">
				<i class="far fa-comment" aria-hidden="true"></i>
				<span class="aft-show-hover">
        <?php echo esc_attr( sprintf( _n( '%s comment', '%s comments', $comment_count, 'reviewnews' ), number_format_i18n( $comment_count ) ) ); ?>
				</span>
			</a>
		</span>
	</span>
	<?php
  endif;
}



//Social share icons and comments view for single page
function reviewnews_social_share_post()
{
  global $post;

  // Get current page URL 
  $post_link = urlencode(get_the_permalink($post->ID));

  // Get current page title
  $post_title = rawurlencode(html_entity_decode(wp_strip_all_tags(get_the_title($post->ID)), ENT_COMPAT, 'UTF-8'));

  // Theme option flags
  $single_post_social_share_copylink   = reviewnews_get_option('single_post_social_share_copylink');
  $single_post_social_share_facebook   = reviewnews_get_option('single_post_social_share_facebook');
  $single_post_social_share_twitter    = reviewnews_get_option('single_post_social_share_twitter');
  $single_post_social_share_email      = reviewnews_get_option('single_post_social_share_email');

  $social_share_links = [];

  if ($single_post_social_share_facebook) {
    $social_share_links['facebook'] = [
      "https://www.facebook.com/sharer/sharer.php?u=" . $post_link,
      'fab fa-facebook aft-icon-facebook'
    ];
  }

  if ($single_post_social_share_twitter) {
    $social_share_links['twitter'] = [
      "https://twitter.com/intent/tweet?text=" . $post_title . "&url=" . $post_link,
      'fab fa-twitter aft-icon-twitter'
    ];
  }

  if ($single_post_social_share_email) {
    $social_share_links['mail'] = [
      'mailto:?subject=' . $post_title . '&body=' . $post_link,
      'fas fa-envelope aft-icon-envelope'
    ];
  }
?>
  <?php if ($single_post_social_share_copylink) { ?>
    <span class="aft-jpshare">
      <?php if ($single_post_social_share_copylink) { ?>
        <i class="fa fa-clipboard aft-copy-to-clipboard" role="button" tabindex="0" aria-label="<?php echo esc_attr__('Copy link to clipboard', 'reviewnews'); ?>" data-copy-msg="<?php echo esc_attr__('Link copied to clipboard!', 'reviewnews'); ?>"></i>
      <?php } ?>
    </span>
  <?php } ?>

  <?php foreach ($social_share_links as $ssl) : ?>
    <a href="<?php echo esc_url($ssl[0]); ?>" target="_blank" rel="noopener noreferrer">
      <i class="<?php echo esc_attr($ssl[1]); ?>"></i>
    </a>
    <?php endforeach;
}


/**
 * @param $post_id
 */
function reviewnews_archive_social_share_icons($post_id)
{
  if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')) :
    if (function_exists('sharing_display')) :
      $sharer = new Sharing_Service();
      $global = $sharer->get_global_options();
      if (in_array('index', $global['show']) && (is_home() || is_front_page() || is_archive() || is_search() || in_array(get_post_type(), $global['show']))) :
    ?>
        <div class="aft-comment-view-share">
          <span class="aft-jpshare">
            <i class="fa fa-share-alt" aria-hidden="true"></i>
            <?php sharing_display('', true); ?>
          </span>
        </div>
      <?php
      endif;
    endif;
  endif;
}

//Social share icons and comments view for single page


function reviewnews_single_post_social_share_icons()
{

  $social_share_icon_type = reviewnews_get_option('single_post_social_share_type');

  if ($social_share_icon_type === 'none') {
    return;
  }

  $social_share_icon_opt = reviewnews_get_option('single_post_social_share_view');

  if ($social_share_icon_type === 'jetpack') {
    if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')) :

      $social_share_icon_opt = reviewnews_get_option('single_post_social_share_view');

      if ($social_share_icon_opt == 'side') {
        echo '<div class="vertical-left-right">';
      }
      ?>
      <div class="aft-social-share">
        <?php
        if (function_exists('sharing_display')) {
          sharing_display('', true);
        }
        ?>

      </div>
    <?php
      if ($social_share_icon_opt == 'side') {
        echo '</div>';
      }
    endif;
  } else {

    if ($social_share_icon_opt == 'side') {
      echo '<div class="vertical-left-right">';
    }
    ?>
    <div class="aft-social-share">
      <?php reviewnews_social_share_post(); ?>
    </div>
  <?php
    if ($social_share_icon_opt == 'side') {
      echo '</div>';
    }
  }
}

/**
 * Output Social Meta Tags (Open Graph + Twitter)
 * Based on ReviewNews and NewsX approaches, refined for WP.org compliance.
 */
function reviewnews_output_social_meta_tags()
{

  // Allow disabling via theme option
  if (function_exists('reviewnews_get_option') && reviewnews_get_option('disable_theme_meta_tags')) {
    return;
  }

  // Prevent conflicts with popular SEO plugins
  if (defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || defined('AIOSEO_PHP_VERSION_DIR')) {
    return;
  }

  global $post;
  if (empty($post)) {
    return;
  }

  $post_id     = $post->ID;
  $is_singular = is_singular();

  // Determine type
  $og_type = 'website';
  if (is_singular('post') || is_singular('news')) {
    $og_type = 'article';
  }

  // Basic data
  $title       = wp_strip_all_tags(get_the_title($post_id));
  $description = wp_trim_words(wp_strip_all_tags(get_the_excerpt($post_id)), 35);
  $url         = get_permalink($post_id);

  // Determine image priority: featured → logo → header
  $image = get_the_post_thumbnail_url($post_id, 'large');
  if (empty($image)) {
    if (has_custom_logo()) {
      $image = wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'large');
    } elseif (get_header_image()) {
      $image = get_header_image();
    } else {
      $image = ''; // Do not force placeholder — user's responsibility
    }
  }

  ob_start();
  ?>

  <!-- Social Meta Tags -->
  <meta property="og:type" content="<?php echo esc_attr($og_type); ?>" />
  <meta property="og:title" content="<?php echo esc_attr($title); ?>" />
  <meta property="og:description" content="<?php echo esc_attr($description); ?>" />
  <meta property="og:url" content="<?php echo esc_url($url); ?>" />
  <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
  <meta property="og:locale" content="<?php echo esc_attr(strtolower(str_replace('-', '_', get_bloginfo('language')))); ?>" />

  <?php
  // Add image if available
  if (!empty($image)) :
    echo '<meta property="og:image" content="' . esc_url($image) . '" />';

    $image_data = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'large');
    if ($image_data && !empty($image_data[1]) && !empty($image_data[2])) {
      echo '<meta property="og:image:width" content="' . esc_attr($image_data[1]) . '" />';
      echo '<meta property="og:image:height" content="' . esc_attr($image_data[2]) . '" />';
    }
  endif;
  ?>

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?php echo esc_attr($title); ?>" />
  <meta name="twitter:description" content="<?php echo esc_attr($description); ?>" />
  <meta name="twitter:url" content="<?php echo esc_url($url); ?>" />
  <?php if (!empty($image)) : ?>
    <meta name="twitter:image" content="<?php echo esc_url($image); ?>" />
  <?php endif; ?>

<?php
  // Output the buffer
  echo ob_get_clean();
}
add_action('wp_head', 'reviewnews_output_social_meta_tags');


function reviewnews_single_post_commtents_view($post_id)
{
?>
  <div class="aft-comment-view-share">
    <?php
    $show_comment_count = reviewnews_get_option('global_show_comment_count');
    if ($show_comment_count == 'yes') :
      $comment_count = get_comments_number($post_id);
      if (comments_open($post_id) || $comment_count > 0) :
    ?>
        <span class="aft-comment-count">
          <a href="<?php echo esc_url(get_comments_link($post_id)); ?>">
            <i class="far fa-comment"></i>
            <span class="aft-show-hover">
              <?php echo esc_html(get_comments_number($post_id)); ?>
            </span>
          </a>
        </span>
    <?php endif;
    endif;

    ?>
  </div>
  <?php
}


/* Display Breadcrumbs */
if (!function_exists('reviewnews_toggle_lazy_load')) :

  /**
   * Simple excerpt more.
   *
   * @since 1.0.0
   */
  function reviewnews_toggle_lazy_load()
  {
    $reviewnews_lazy_load = reviewnews_get_option('global_toggle_image_lazy_load_setting');
    if ($reviewnews_lazy_load == 'disable') {
      add_filter('wp_lazy_loading_enabled', '__return_false');
    }
  }

endif;

add_action('wp_loaded', 'reviewnews_toggle_lazy_load');


add_action('init', 'reviewnews_disable_wp_emojis');


function reviewnews_disable_wp_emojis()
{
  $disable_emoji = reviewnews_get_option('disable_wp_emoji');
  if ($disable_emoji) {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'reviewnews_disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'reviewnews_disable_emojis_remove_dns_prefetch', 10, 2);
  }
}

function reviewnews_disable_emojis_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  }
  return array();
}

function reviewnews_disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
  if ('dns-prefetch' === $relation_type) {
    $emoji_svg_url = 'https://s.w.org/images/core/emoji/';
    foreach ($urls as $key => $url) {
      if (strpos($url, $emoji_svg_url) !== false) {
        unset($urls[$key]);
      }
    }
  }
  return $urls;
}

if (!function_exists('reviewnews_author_bio_box')) :
  function reviewnews_author_bio_box()
  {
    if (!is_single()) {
      return;
    }

    $allowed_post_types = apply_filters('reviewnews_author_bio_post_types', array('post'));

    if (!in_array(get_post_type(), $allowed_post_types, true)) {
      return;
    }

    $author_id   = get_the_author_meta('ID');
    $author_name = get_the_author();
    $author_url  = get_author_posts_url($author_id);
    $website     = get_the_author_meta('user_url');

    // Get author role (optional)
    $user = get_userdata($author_id);
    $roles = $user->roles;
    $role_name = !empty($roles) ? ucfirst($roles[0]) : '';

  ?>
    <section class="reviewnews-author-bio">

      <?php


      $title = esc_html__('About the Author', 'reviewnews');
      reviewnews_render_section_title($title);
      ?>


      <div class="author-box-content">
        <div class="author-avatar">
          <?php echo get_avatar($author_id, 96); ?>
        </div>
        <div class="author-info">
          <h4 class="author-name">
            <a href="<?php echo esc_url($author_url); ?>">
              <?php echo esc_html($author_name); ?>
            </a>
          </h4>
          <?php if ($role_name) : ?>
            <p class="author-role">
              <?php echo esc_html($role_name); ?>
            </p>
          <?php endif; ?>
          <p class="author-description">
            <?php echo esc_html(get_the_author_meta('description')); ?>
          </p>

          <div class="author-website-and-posts">
            <?php if ($website) : ?>

              <a class="author-website" href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener">
                <?php esc_html_e('Visit Website', 'reviewnews'); ?>
              </a>

            <?php endif; ?>

            <a href="<?php echo esc_url($author_url); ?>" class="author-posts-link">
              <?php esc_html_e('View All Posts', 'reviewnews'); ?>
            </a>
          </div>

        </div>
      </div>
    </section>
<?php
  }
endif;

add_filter('the_content', 'reviewnews_append_author_bio');
function reviewnews_append_author_bio($content)
{

  $single_show_theme_author_bio = reviewnews_get_option('single_show_theme_author_bio');

  if ($single_show_theme_author_bio == false) {
    return $content;
  }

  // Check if WP Post Author plugin has its author box active
  if (has_filter('the_content', 'awpa_add_author')) {
    return $content;
  }

  if (is_single() && in_the_loop() && is_main_query()) {
    ob_start();
    reviewnews_author_bio_box();
    $bio_box = ob_get_clean();
    return $content . $bio_box;
  }

  return $content;
}


/**
 * Comment form placeholders and accessibility enhancements
 *
 * @package ReviewNews
 */

/*
** Add placeholders to comment form fields
*/
function reviewnews_add_comment_placeholders($defaults)
{
  if (!empty($defaults['fields']['author'])) {
    $defaults['fields']['author'] = str_replace(
      '<input',
      '<input placeholder="' . esc_attr__('Your name', 'reviewnews') . '"',
      $defaults['fields']['author']
    );
  }

  if (!empty($defaults['fields']['email'])) {
    $defaults['fields']['email'] = str_replace(
      '<input',
      '<input placeholder="' . esc_attr__('Your email', 'reviewnews') . '"',
      $defaults['fields']['email']
    );
  }

  if (!empty($defaults['fields']['url'])) {
    $defaults['fields']['url'] = str_replace(
      '<input',
      '<input placeholder="' . esc_attr__('Your website', 'reviewnews') . '"',
      $defaults['fields']['url']
    );
  }

  if (!empty($defaults['comment_field'])) {
    $defaults['comment_field'] = str_replace(
      '<textarea',
      '<textarea placeholder="' . esc_attr__('Leave a comment', 'reviewnews') . '"',
      $defaults['comment_field']
    );
  }

  return $defaults;
}
add_filter('comment_form_defaults', 'reviewnews_add_comment_placeholders', 10);

/*
** Fix search form tabindex for accessibility on 404 pages
*/
function reviewnews_fix_search_tabindex_on_404($form)
{
  if (is_404()) {
    $form = str_replace('tabindex="-1"', 'tabindex="0"', $form);
  }
  return $form;
}
add_filter('get_search_form', 'reviewnews_fix_search_tabindex_on_404');

/*
** Exclude pages from search results
*/
function reviewnews_search_results( $query ) {

  $search_archive_content_view = reviewnews_get_option('search_archive_content_view');

  if ($search_archive_content_view == 'all') {
    return;
  }

  // Ensure this only runs on the main query in the search context
  if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
      $query->set( 'post_type', 'post' ); // Include only posts
  }
}
add_action( 'pre_get_posts', 'reviewnews_search_results' );
