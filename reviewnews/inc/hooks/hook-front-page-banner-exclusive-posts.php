<?php
if (!function_exists('reviewnews_banner_exclusive_posts')):
  /**
   * Ticker Slider
   *
   * @since ReviewNews 1.0.0
   *
   */
  function reviewnews_banner_exclusive_posts()
  {



    if (false != reviewnews_get_option('show_popular_tags_section')) : ?>
      <div class="aft-popular-tags">
        <div class="container-wrapper">
          <?php

          $reviewnews_show_popular_tags_title = reviewnews_get_option('frontpage_popular_tags_section_title');
          $reviewnews_select_popular_tags_mode = reviewnews_get_option('select_popular_tags_mode');
          $reviewnews_number_of_popular_tags = reviewnews_get_option('number_of_popular_tags');


          reviewnews_list_popular_taxonomies($reviewnews_select_popular_tags_mode, $reviewnews_show_popular_tags_title, $reviewnews_number_of_popular_tags);


          ?>
        </div>
      </div>
    <?php endif;


    if (false != reviewnews_get_option('show_flash_news_section')) :

      $reviewnews_em_ticker_news_mode = 'aft-flash-slide left';
      $reviewnews_dir = 'left';
      if (is_rtl()) {
        $reviewnews_em_ticker_news_mode = 'aft-flash-slide right';
        $reviewnews_dir = 'right';
      }
    ?>
      <div class="banner-exclusive-posts-wrapper">

        <?php
        $reviewnews_categories = reviewnews_get_option('select_flash_news_category');
        $reviewnews_number_of_posts = reviewnews_get_option('number_of_flash_news');
        $reviewnews_em_ticker_news_title = reviewnews_get_option('flash_news_title');

        $reviewnews_all_posts = reviewnews_get_posts($reviewnews_number_of_posts, $reviewnews_categories);
        $reviewnews_show_trending = true;
        $reviewnews_count = 1;
        ?>

        <div class="container-wrapper">
          <div class="exclusive-posts">
            <div class="exclusive-now primary-color">
              <div class="aft-box-ripple">
                <div class="box1"></div>
                <div class="box2"></div>
                <div class="box3"></div>
                <div class="box4"></div>
              </div>
              <?php if (!empty($reviewnews_em_ticker_news_title)): ?>
                <span><?php echo esc_html($reviewnews_em_ticker_news_title); ?></span>
              <?php endif; ?>
            </div>
            <div class="exclusive-slides" dir="ltr">
              <?php
              if ($reviewnews_all_posts->have_posts()) : ?>
                <div class='marquee <?php echo esc_attr($reviewnews_em_ticker_news_mode); ?>' data-speed='80000'
                  data-gap='0' data-duplicated='true' data-direction="<?php echo esc_attr($reviewnews_dir); ?>">
                  <?php

                  while ($reviewnews_all_posts->have_posts()) : $reviewnews_all_posts->the_post();
                    global $post;
                    
                  ?>
                    <a href="<?php the_permalink(); ?>" aria-label="<?php echo the_title(); ?>">
                      <?php if ($reviewnews_show_trending == true): ?>

                      <?php endif; ?>

                      <span class="circle-marq">

                        <?php reviewnews_the_post_thumbnail('thumbnail', $post->ID); ?>
                      </span>

                      <?php the_title(); ?>
                    </a>
                <?php
                    $reviewnews_count++;
                  endwhile;
                endif;
                wp_reset_postdata();
                ?>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Excluive line END -->
<?php

    endif;
  }
endif;

add_action('reviewnews_action_banner_exclusive_posts', 'reviewnews_banner_exclusive_posts', 10);
