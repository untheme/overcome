<?php
    $lists = $icon = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $el_id = !empty($el_id) ? 'ef5-posts-'.$el_id : uniqid('ef5-posts-');
    /* get value for Design Tab */
    $css_classes = array(
        'ef5-posts-masonry',
        'ef5-masonry',
        'ef5-posts-masonry-'.$layout_template,
        'ef5-posts-grid-'.$item_template
    );

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
    
    // Items CSS Classes
    $item_css_class = ['post-masonry-item','post-grid-item','transition'];

    $has_shadow = ['2','3','4','5','6','14'];
    if(in_array($item_template, $has_shadow)) $item_css_class[] = 'ef5-box ef5-box-shadow-13';

    $slide_overlay = ['8','9'];
    if(in_array($item_template, $slide_overlay)) $item_css_class[] = 'ef5-line-corner-wrap';
    
    // Title 
    $title_class = '';

    // Masonry 
    $originLeft = is_rtl() ? 'false' : 'true';
    // Thumbnail Size 
    $masonry_size_index = -1;
    switch ($layout_template) {
        default:
            $masonry_size = ['100x200','200x300','300x150','300x150','100','300x200'];
            break;
    }
    
?>
<div class="ef5-posts" id="<?php echo esc_attr($el_id);?>">
    <?php $this->ef5_posts_masonry_filters($atts); ?>
    <div class="<?php $this->ef5_posts_masonry_wrap_class($atts);?>" data-originleft="<?php echo $originLeft;?>">
        <div class="ef5-masonry-sizer"></div>
        <div class="ef5-masonry-gutter"></div>
        <?php 
            $d = 0; $large_item = [1,5,9,10]; $large_item_index = -1;
            while($posts->have_posts()){
                $d++;
                $large_item_index++;
                if($large_item_index >= count($large_item))
                    $large_item_index = $large_item_index - count($large_item);
                
                if( $large_item[$large_item_index] === 0) {
                    $item_w = 'large';
                } elseif ($d % $large_item[$large_item_index] === 0){
                    $item_w = 'large';
                } else {
                    $item_w = 'small';
                }
                $posts->the_post();
                $filter_class = overcome_get_taxo_slug_as_css_class(['taxo' => overcome_get_custom_post_taxonomies( $post_type , 'cat')] );
                // Thumbnail Size
                $masonry_size_index++;
                if($masonry_size_index >= count($masonry_size))
                    $masonry_size_index = $masonry_size_index - count($masonry_size) ;
            ?>
            <div class="<?php $this->ef5_posts_masonry_items_class($atts,['class' => $item_w.' '.$filter_class]); ?>">
            <?php  
                switch ($item_template) {
                    default:
                    $item_css_class[] = 'ef5-rounded-10 overlay-wrap ef5-hover-shadow-1';
            ?>	
            	<div class="<?php echo overcome_optimize_css_class(implode(' ', $item_css_class)); ?>">
                    <?php overcome_vc_post_layout2_1($atts); ?>
                </div>
            <?php
                    break;
                }
            ?>
            </div>
            <?php
            } // end while
            if($show_pagination !== '1') wp_reset_query();
        ?>
    </div>
    <?php overcome_loop_pagination(['show_pagination' => $show_pagination, 'style' => '2']); ?>
</div>
