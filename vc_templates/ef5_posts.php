<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    $el_id = !empty($el_id) ? 'ef5-posts-'.$el_id : uniqid('ef5-posts-');
    

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
    $grid_item_css_class = ['ef5-grid-item-wrap', $this->getCSSAnimation( $css_animation ), 'col-'.$col_sm, 'col-md-'.$col_md, 'col-lg-'.$col_lg, 'col-xl-'.$col_xl];
    // Items CSS Classes
    $item_css_class = ['post-grid-item','transition'];
?>
<div class="ef5-posts" id="<?php echo esc_attr($el_id);?>">
    <div class="<?php $this->overcome_posts_wrap_css_class($atts);?>">
    <?php 
        switch ($layout_template) {
            case '1':
            $post_count = $post_count2 = 0;
            while($posts->have_posts()){
                $post_count++;
                $posts->the_post();
                if($post_count === 1){
                    $this->overcome_posts_featured_item($atts,['class' => 'ef5-rounded-10 overlay-wrap']);
                }
            }
            wp_reset_postdata();
        ?>
            <div class="col-lg-6">
                <?php
                    while($posts->have_posts()){
                        $post_count2++;
                        $posts->the_post();
                        if($post_count2 != 1){
                            $this->overcome_posts_item($atts,['class'=>'overlay-wrap']);
                        }
                    }
                    wp_reset_postdata();
                ?>
            </div>
        <?php
                break;
            case '2':
                $item_css_class[] = 'ef5-rounded-10 overlay-wrap ef5-hover-shadow-1';
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                    $after = '<div class="overlay ef5-bg-overlay"><div class="overlay-inner center-align"><a class="text-36 text-white" href="'.get_the_permalink().'"><span class="fa fa-link"></span></a></div></div>';
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                	<div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <div class="relative">
                            <?php 
                                overcome_post_media([
                                    'thumbnail_size' => '', 
                                    'default_thumb'  => true,
                                    'after'          => $after
                                ]);
                            ?>
                        </div>
                        <div class="pl-15 pr-15 pl-lg-35 pr-lg-35 pt-25 pb-25">
                            <?php 
                                overcome_post_title([
                                    'heading_tag' => 'text-22',
                                    'class'       => 'pb-15'  
                                ]);
                                overcome_post_excerpt([
                                    'show_excerpt' => '1', 
                                    'length'       => '15', 
                                    'more'         => ''
                                ]);
                                overcome_post_read_more(['show_readmore' => '1']); 
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    }// end while
                ?>
        <?php
            break;
        } 
    ?>
    </div>
<?php 
    overcome_loop_pagination(['show_pagination' => $show_pagination, 'style' => '2']); 
    $this->view_all($atts);
?>
</div>
