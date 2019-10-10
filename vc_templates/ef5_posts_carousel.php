<?php
    $lists = $icon = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    /* get value for Design Tab */
    $css_classes = array(
        'ef5-posts-carousel',
        'ef5-posts-'.$layout_template,
        'ef5-owl',
        'owl-carousel',
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    /* Post query */
    $tax_query = ef5systems_tax_query($post_type, $taxonomies, $taxonomies_exclude);
    if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } elseif ( get_query_var('page') ) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
    $posts_args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'post_status'    => 'publish',
        'tax_query'      => $tax_query,
        'paged'          => $paged,
    );
    global $wp_query;
    $posts = $wp_query = new WP_Query($posts_args);
    // Grid columns css class
    $grid_item_css_class = ['ef5-post-item ef5-carousel-item', $this->getCSSAnimation( $css_animation )];
    // Items CSS Classes
    $item_css_class = ['post-item','transition', 'ef5-hover-wrap'];

    // Thumbnail Size
    $thumbnail_size_index = -1;
    $thumbnail_size = explode(',', $thumbnail_size);
?>
<div id="<?php echo esc_attr('ef5-posts-'.$el_id);?>" class="ef5-posts <?php echo ef5_owl_css_class($atts);?>">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo esc_attr(trim($css_class));?>">
    <?php 
        $d = 0;
        while($posts->have_posts()){
            $d++;
            // Thumbnail Size
            $thumbnail_size_index++;
            if($thumbnail_size_index >= count($thumbnail_size))
                $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
            $posts->the_post();
            // Post Metas
            $post_metas   = [];
            $post_metas[] = overcome_posted_on(['show_date'=>'1','echo' => false]);
            $post_metas[] = overcome_posted_by(['show_author'=>'1','author_avatar' => false, 'echo' => false]);
        ?>
        <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
        <?php
            switch ($layout_template) {
                default:
        ?>	
        	<div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                <?php 
                    overcome_post_media([
                        'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                        'default_thumb'  => true
                    ]);
                ?>
                <?php 
                    overcome_post_header([
                        'heading_tag' => overcome_default_value($heading_tag,'h2'), 
                        'before_args' => ['show_cat'=> '1'], 
                        'after_args'  => ['show_cat' => false,'show_author' => '1', 'show_date'=> '1', 'show_cmt' => '1', 'show_view' => '0', 'show_like' => '0', 'sep' => '|' ]]);
                    overcome_post_excerpt([
                        'show_excerpt' => '1', 
                        'length'       => '15', 
                        'more'         => ''
                    ]);
                    overcome_post_read_more(['show_readmore' => '1']); 
                ?>
            </div>
        <?php
                break;
            }
        ?>
        </div>
        <?php
        } // end while
        wp_reset_query();
    ?>
    </div>
    <?php overcome_loading_animation(); ?>
    <div class="ef5-posts-footer <?php echo 'nav-style-'.esc_attr($nav_style);?>"><?php 
        ef5systems_owl_dots_container($atts);
        ef5systems_owl_nav_container($atts);
        ef5systems_owl_dots_in_nav_container($atts);
    ?></div>
</div>
