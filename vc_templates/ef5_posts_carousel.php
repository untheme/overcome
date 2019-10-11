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
    $grid_item_css_class = ['ef5-post-item', 'ef5-post-item-layout-'.$layout_template, 'ef5-carousel-item', $this->getCSSAnimation( $css_animation )];
    // Items CSS Classes
    $item_css_class = ['ef5-post-item-inner','transition'];

    // Thumbnail Size
    $thumbnail_size_index = -1;
    $thumbnail_size = explode(',', $thumbnail_size);
?>
<div id="<?php echo esc_attr('ef5-posts-'.$el_id);?>" class="ef5-posts <?php echo ef5systems_owl_css_class($atts);?>">
    <?php 
        ef5systems_owl_nav_top($atts);
        ef5systems_owl_dots_top($atts); 
    ?>
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
                if(get_post_type() === 'ef5_donation')
                    $overlay = class_exists('EF5Payments') ? ef5payments_donation_donate_button() : overcome_post_read_more(['show_readmore' => '1','echo' => false]);
                else 
                    $overlay = overcome_post_read_more(['show_readmore' => '1','echo' => false]);

        ?>	
        	<div class="<?php echo trim(implode(' ', $item_css_class)); ?> ef5-hover-shadow-1">
                <?php 
                    overcome_post_media([
                        'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                        'default_thumb'  => true,
                        'after'          => $overlay
                    ]);
                ?>
                <div class="ef5-post-info">
                    <?php 
                        overcome_post_title([
                            'heading_tag' => 'text-20'
                        ]);
                        overcome_post_excerpt([
                            'show_excerpt' => '1', 
                            'length'       => '16', 
                            'more'         => ''
                        ]);
                        if(class_exists('EF5Payments')) {
                            ef5systems_donation_progress_donors([
                                'donor_icon' => '<span class="flaticon-like"></span>'
                            ]);
                            ef5payments_donation_donate_amount([
                                'goal_label' => esc_html__('Goal:','overcome'),
                                'raised_label' => esc_html__('Raised:','overcome')
                            ]);
                        }
                    ?>
                </div>
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
    <?php 
        overcome_loading_animation(); 
        ef5systems_owl_dots_container($atts);
        ef5systems_owl_nav_container($atts);
        ef5systems_owl_dots_in_nav_container($atts);

        echo overcome_html($this->view_all($atts));
    ?>
</div>
