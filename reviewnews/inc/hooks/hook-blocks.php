<?php
if (!function_exists('reviewnews_archive_layout_selection')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since ReviewNews 1.0.0
     *
     */
    function reviewnews_archive_layout_selection($reviewnews_archive_layout = 'default')
    {

        switch ($reviewnews_archive_layout) {           
            
            case "archive-layout-full":
                reviewnews_get_block('full', 'archive');
                break;
            default:
                reviewnews_get_block('grid', 'archive');
        }
    }
endif;

if (!function_exists('reviewnews_archive_layout')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since ReviewNews 1.0.0
     *
     */
    function reviewnews_archive_layout($cat_slug = '')
    {

        $reviewnews_archive_args = reviewnews_archive_layout_class($cat_slug);
        if (!empty($reviewnews_archive_args['data_mh'])): ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class($reviewnews_archive_args['add_archive_class']); ?>
                 data-mh="<?php echo esc_attr($reviewnews_archive_args['data_mh']); ?>">
            <?php reviewnews_archive_layout_selection($reviewnews_archive_args['archive_layout']); ?>
        </article>
    <?php else: ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class($reviewnews_archive_args['add_archive_class']); ?> >
            <?php reviewnews_archive_layout_selection($reviewnews_archive_args['archive_layout']); ?>
        </article>
    <?php endif; ?>

        <?php

    }

    add_action('reviewnews_action_archive_layout', 'reviewnews_archive_layout', 10, 1);
endif;

function reviewnews_archive_layout_class($reviewnews_cat_slug)
{




    $reviewnews_archive_class = reviewnews_get_option('archive_layout');
    $reviewnews_archive_layout_list = reviewnews_get_option('archive_image_alignment');
    $reviewnews_archive_layout_grid = reviewnews_get_option('archive_image_alignment_grid');

    if ($reviewnews_archive_class == 'archive-layout-grid') {
        $reviewnews_archive_args['archive_layout'] = 'archive-layout-grid';
        $reviewnews_archive_args['add_archive_class'] = 'af-sec-post latest-posts-grid col-3 float-l pad ';
        //$reviewnews_archive_layout_mode = reviewnews_get_option('archive_image_alignment_grid');
        $reviewnews_archive_layout_mode = $reviewnews_archive_layout_grid;
        if ($reviewnews_archive_layout_mode == 'archive-image-full-alternate' || $reviewnews_archive_layout_mode == 'archive-image-list-alternate') {
          $reviewnews_archive_args['data_mh'] = '';
        } else {
          $reviewnews_archive_args['data_mh'] = 'archive-layout-grid';
        }
        $reviewnews_image_align_class = $reviewnews_archive_layout_grid;
        $reviewnews_archive_args['add_archive_class'] .= ' ' . $reviewnews_archive_class . ' ' . $reviewnews_image_align_class;
      }elseif ($reviewnews_archive_class == 'archive-layout-list') {
        $reviewnews_archive_args['archive_layout'] = 'archive-layout-list';
        $reviewnews_archive_args['add_archive_class'] = 'latest-posts-list col-1 float-l pad';
        $reviewnews_archive_args['data_mh'] = '';
        $reviewnews_image_align_class = $reviewnews_archive_layout_list;
        $reviewnews_archive_args['add_archive_class'] .= ' ' . $reviewnews_archive_class . ' ' . $reviewnews_image_align_class;
    } else {
        $reviewnews_archive_args['archive_layout'] = 'archive-layout-full';
        $reviewnews_archive_args['add_archive_class'] = 'af-sec-post latest-posts-full col-1 float-l pad';
        $reviewnews_archive_args['data_mh'] = '';
    }

    return $reviewnews_archive_args;

}


//Archive div wrap before loop

if (!function_exists('reviewnews_archive_layout_before_loop')) :

    /**
     *
     * @param null
     *
     * @return null
     *
     * @since ReviewNews 1.0.0
     *
     */

    function reviewnews_archive_layout_before_loop()
    {

            //grid layout option
            $reviewnews_archive_mode = reviewnews_get_option('archive_layout');
            if ($reviewnews_archive_mode == 'archive-layout-full') {
                $reviewnews_archive_layout_full = reviewnews_get_option('archive_layout_full');
                if ($reviewnews_archive_layout_full == 'full-image-first') {
                    $reviewnews_archive_class = $reviewnews_archive_mode . " " . 'full-image-first';
                } else if ($reviewnews_archive_layout_full == 'full-title-first') {
                    $reviewnews_archive_class = $reviewnews_archive_mode . " " . 'archive-title-first';
                } else if ($reviewnews_archive_layout_full == 'archive-full-grid') {
                    $reviewnews_archive_class = $reviewnews_archive_mode . " " . "full-with-grid";
                } else {
                    $reviewnews_archive_class = $reviewnews_archive_mode;
                }
            } else {

                $reviewnews_archive_class = $reviewnews_archive_mode;
            }

        ?>
        <div class="af-container-row aft-archive-wrapper reviewnews-customizer clearfix <?php echo esc_attr($reviewnews_archive_class); ?>">
        <?php

    }

    add_action('reviewnews_archive_layout_before_loop', 'reviewnews_archive_layout_before_loop');
endif;

if (!function_exists('reviewnews_archive_layout_after_loop')):

    function reviewnews_archive_layout_after_loop()
    {
        ?>
        </div>
    <?php }

    add_action('reviewnews_archive_layout_after_loop', 'reviewnews_archive_layout_after_loop');

endif;