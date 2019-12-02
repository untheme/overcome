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
    $item_css_class = ['post-masonry-item','transition'];

    $has_shadow = ['2','3','4','5','6','14'];
    if(in_array($item_template, $has_shadow)) $item_css_class[] = 'ef5-box ef5-box-shadow-13';

    $slide_overlay = ['8','9'];
    if(in_array($item_template, $slide_overlay)) $item_css_class[] = 'ef5-line-corner-wrap';
    
    // Title 
    $title_class = '';

    // Masonry 
    $originLeft = is_rtl() ? false : true;
    $masonry_opts = array(
        'itemSelector'    => '.ef5-masonry-item',
        'columnWidth'     => '.ef5-masonry-sizer',
        'gutter'          => '.ef5-masonry-gutter',
        'percentPosition' => true,
        'originLeft'      => $originLeft,
        'horizontalOrder' => true,
        
    );
    // Thumbnail Size 
    $masonry_size_index = -1;
    switch ($layout_template) {
        default:
            $masonry_size = ['370x240'];
            break;
    }
    // Filters
    $filter_content_align = 'text-center';
    $filters_class = ['ef5-filters', 'ef5-masonry-filters', 'ef5-filters-'.$filter_template, str_replace('text-', 'justify-content-lg-',$filter_content_align), $this->getCSSAnimation('fadeInUp')];
    // Filter Button Data 
    $filter_terms_args = [
        'taxonomy' => overcome_get_custom_post_taxonomies( $post_type , 'cat'), 
        'exclude'  => overcome_get_term_id_by_slug($post_type, 'cat', $taxonomies_exclude)
    ];
    if(!empty($taxonomies))  $filter_terms_args['slug'] = explode(',', $taxonomies);
    $filter_terms = get_terms($filter_terms_args);
?>
<div class="ef5-posts" id="<?php echo esc_attr($el_id);?>">
    <?php if($show_filter === '1'): ?>
        <div class="<?php echo overcome_optimize_css_class(implode(' ', $filters_class));?>">
            <div class="filter-item active" data-filter="*">
                <span><?php esc_html_e('All','unbreak'); ?></span>
            </div>
            <?php 
                foreach ($filter_terms as $term) {
                    echo '<div class="filter-item" data-filter="'.esc_attr('.'.$term->slug).'"><span>'.esc_html($term->name).'</span><span class="d-none">'.$term->count.'</span></div>';
                } 
            ?>
        </div>
    <?php endif; ?>
    <div class="<?php $this->ef5_posts_masonry_wrap_class($atts);?>" data-masonry="<?php echo esc_attr(json_encode($masonry_opts));?>">
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
                // Post Metas
                $post_metas   = [];
                $post_metas[] = overcome_posted_on(['show_date'=>'1','echo' => false]);
                $post_metas[] = overcome_posted_by(['show_author'=>'1','author_avatar' => false, 'echo' => false]);
                /**
                 * Layout 5 Post Metas 
                */
                $post_metas_5   = [];
                $post_metas_5[] = overcome_posted_by(['show_author'=>'1','author_avatar' => false, 'echo' => false]);
                $post_metas_5[] = overcome_comments_popup_link(['show_cmt'=>'1','echo' => false]);

                // Readmore button 
                $overcome_post_media_readmore = overcome_post_read_more([
                    'before'         => '<div class="center-align">',
                    'after'          => '</div>',
                    'echo'           => false, 
                    'show_readmore'  => '1', 
                    'readmore_class' => ''
                ]);
                $overcome_post_media_readmore2 = overcome_post_read_more_circle([
                    'before'         => '<div class="center-align">',
                    'after'          => '</div>',
                    'echo'           => false, 
                    'show_readmore'  => '1', 
                    'readmore_class' => ''
                ]);
                $overcome_post_media_cat   = overcome_posted_in(['echo' => false, 'show_cat' => '1','class' => 'ef5-box-meta ef5-box-meta2', 'sep' => '']);
                $overcome_post_media_share = overcome_post_share(['echo' => false, 'class' => 'col-auto', 'show_share' => '0', 'show_title' => false, 'social_args' => ['class' => 'shape-circle colored-hover outline justify-content-center', 'size' => '30']]);
                $overcome_post_media_date  = overcome_posted_on(['echo' => false, 'show_date' => '1','class' => 'ef5-box-meta ef5-box-meta2 text-uppercase', 'sep' => '']);

            ?>
            <div class="<?php $this->ef5_posts_masonry_items_class($atts,['class' => $item_w.' '.$filters_class]); ?>">
            <?php  
                switch ($item_template) {
                    default:
            ?>	
            	<div class="<?php echo overcome_optimize_css_class(implode(' ', $item_css_class)); ?>">
                    <?php 
                        overcome_post_media([
                            'thumbnail_size' => $masonry_size[$masonry_size_index], 
                            'default_thumb'  => true
                        ]);
                    ?>
                    <?php 
                        overcome_post_title([
                            'heading_tag' => '', 
                        ]);

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
            if($show_pagination !== '1') wp_reset_query();
        ?>
    </div>
    <?php overcome_loop_pagination(['show_pagination' => $show_pagination, 'style' => '2']); ?>
</div>
