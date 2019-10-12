<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    $el_id = !empty($el_id) ? 'ef5-posts-'.$el_id : uniqid('ef5-posts-');
    /* get value for Design Tab */
    $css_classes = array(
        'ef5-posts-grid',
        'ef5-grid',
        'ef5-posts-grid-'.$layout_template,
        'row',
        'justify-content-center',
        vc_shortcode_custom_css_class( $css ),
    );
    
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    /* Post query */
    $tax_query = overcome_tax_query($post_type, $taxonomies, $taxonomies_exclude);
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
    $grid_item_css_class = ['ef5-grid-item', $this->getCSSAnimation( $css_animation ), 'col-'.$col_sm, 'col-md-'.$col_md, 'col-lg-'.$col_lg, 'col-xl-'.$col_xl];
    // Items CSS Classes
    $item_css_class = ['post-grid-item','transition'];
?>
<div class="ef5-posts" id="<?php echo esc_attr($el_id);?>">
    <div class="<?php echo esc_attr(trim($css_class));?>">
    <?php 
        $d = 0;
        while($posts->have_posts()){
            $d++;
            $posts->the_post();
        ?>
        <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
        <?php
            switch ($layout_template) {
                
                default:
        ?>	
        	<div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                <?php 
                    overcome_post_media([
                        'thumbnail_size' => '', 
                        'default_thumb'  => true
                    ]);
                ?>
                <?php 
                    overcome_post_header([
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
    ?>
    </div>
<?php overcome_loop_pagination(['show_pagination' => $show_pagination, 'style' => '2']); ?>
</div>
