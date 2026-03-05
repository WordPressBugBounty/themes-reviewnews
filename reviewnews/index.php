<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ReviewNews
 */

get_header(); ?>
    <div class="section-block-upper">

        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <!--<div class="af-container-row">-->

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>

					<?php
					endif;
                    $count = 1;
                    do_action( 'reviewnews_archive_layout_before_loop' );
                    
                    $applied_archive = true;
                    $archive_layout = reviewnews_get_option('archive_layout');


                    if($archive_layout == 'archive-layout-masonry' || $archive_layout == 'archive-layout-full' ){
                        $applied_archive = false;
                    }

                    while (have_posts()) : the_post();

                        
                            /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */

                            get_template_part('template-parts/content', get_post_format());
                        


                        $count++;
					endwhile;

					//div wrap end
					do_action( 'reviewnews_archive_layout_after_loop' );

					?>

				<?php

				else :
					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
                <div class="col col-ten">
                    <div class="reviewnews-pagination">
                        <?php reviewnews_numeric_pagination(); ?>
                    </div>
                </div>
                <!--</div>-->
            </main><!-- #main -->

        </div><!-- #primary -->

		<?php
		get_sidebar();
		?>

    </div>
<?php
get_footer();
