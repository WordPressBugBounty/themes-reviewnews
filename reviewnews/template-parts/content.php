<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ReviewNews
 */

?>


<?php if (is_singular()) : ?>
    <div class="color-pad">
        <div class="entry-content read-details">
            <?php
            the_content(sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'reviewnews'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )); ?>
            <?php if (is_single()): ?>
                <div class="post-item-metadata entry-meta author-links">
                    <?php reviewnews_post_item_tag(); ?>
                </div>
            <?php endif; ?>
            <?php $social_share_icon_opt = reviewnews_get_option('single_post_social_share_view');
      if ($social_share_icon_opt == 'after-content') {
        reviewnews_single_post_social_share_icons();
      } ?>
            <?php           

            the_post_navigation( array(
                'prev_text' => sprintf(
                    /* translators: %s: Title of the previous post. */
                    esc_html__( 'Previous: %s', 'reviewnews' ),
                    '<span class="em-post-navigation nav-title">%title</span>'
                ),
                'next_text' => sprintf(
                    /* translators: %s: Title of the next post. */
                    esc_html__( 'Next: %s', 'reviewnews' ),
                    '<span class="em-post-navigation nav-title">%title</span>'
                ),
                /* translators: Hidden heading for the post navigation section. */
                'screen_reader_text' => esc_html__( 'Post navigation', 'reviewnews' ),
            ) );
            
            ?>
            <?php wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'reviewnews'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->
    </div>
<?php else:



    do_action('reviewnews_action_archive_layout');

endif;
