<?php
    $reviewnews_featured_categories = array();
    
    for ($reviewnews_i = 1; $reviewnews_i <= 3; $reviewnews_i++) {
        $reviewnews_category = reviewnews_get_option('featured_post_list_category_section_' . $reviewnews_i);
        $reviewnews_featured_categories['feature_' . $reviewnews_i][] = $reviewnews_category;
        $reviewnews_featured_categories['feature_' . $reviewnews_i][] = reviewnews_get_option('featured_post_list_section_title_' . $reviewnews_i);
        
        $color_class = '';
        if(absint($reviewnews_category) > 0){
            $color_id = "category_color_" . $reviewnews_category;
            // retrieve the existing value(s) for this meta field. This returns an array
            $term_meta = get_option($color_id);
            $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
        }
        $reviewnews_featured_categories['feature_' . $reviewnews_i][] = $color_class;
    }
    
    if (isset($reviewnews_featured_categories)):
        $reviewnews_count = 1;
        foreach ($reviewnews_featured_categories as $reviewnews_fc): ?>
            <div class="featured-category-item pad float-l reviewnews-customizer">

                    <?php if (!empty($reviewnews_fc[1])): ?>
                        <?php reviewnews_render_section_title($reviewnews_fc[1], $reviewnews_fc[2]); ?>
                    <?php endif; ?>

                
                <?php $reviewnews_all_posts_vertical = reviewnews_get_posts(3, $reviewnews_fc[0]); ?>
                <div class="full-wid-resp af-widget-body">
                    <?php
                        if ($reviewnews_all_posts_vertical->have_posts()) :
                            while ($reviewnews_all_posts_vertical->have_posts()) : $reviewnews_all_posts_vertical->the_post();
                                global $post;

                                ?>
                                <?php do_action('reviewnews_action_loop_list', $post->ID, 'thumbnail', 0, true, true, false); ?>
                            <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
            </div><!--featured-category-item-->
            <?php
            $reviewnews_count++;
        endforeach;
    endif;
