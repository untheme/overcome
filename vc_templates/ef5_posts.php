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
    $item_css_class = ['post-grid-item','ef5-post-item-layout-'.$layout_template,'transition'];

    // Thumbnail size
    $thumbnail_size_index = -1;
    switch ($layout_template) {
        case '4':
            $thumbnail_size = overcome_default_value($thumbnail_size, '370x416');
            break;
    }
    $thumbnail_size = explode(',', $thumbnail_size);
?>
<div class="ef5-posts" id="<?php echo esc_attr($el_id);?>">
    <?php $this->title($atts); ?>
    <div class="<?php $this->overcome_posts_wrap_css_class($atts);?>">
    <?php 
        switch ($layout_template) {
            case '1':
            $post_count = $post_count2 = 0;
            while($posts->have_posts()){
                $post_count++;
                $posts->the_post();
                // Thumbnail Size
                $thumbnail_size_index++;
                if($thumbnail_size_index >= count($thumbnail_size)){
                    $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                }
                if($post_count === 1){
                    $this->overcome_posts_featured_item($atts,[
                        'class'          => 'ef5-rounded-10 overlay-wrap',
                        'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '570')
                    ]);
                }
            }
            wp_reset_postdata();
        ?>
            <div class="col-lg-6">
                <?php
                    while($posts->have_posts()){
                        $post_count2++;
                        $posts->the_post();

                        // Thumbnail Size
                        $thumbnail_size_index++;
                        if($thumbnail_size_index >= count($thumbnail_size)){
                            $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                        }
                        if($post_count2 != 1){
                            $this->overcome_posts_item($atts,[
                                'class'          => 'overlay-wrap',
                                'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '170')
                            ]);
                        }
                    }
                    wp_reset_postdata();
                ?>
            </div>
        <?php
            break;
            case '1_3': // this layour same layout 1, just change background color and overlay background color
            $post_count = $post_count2 = 0;
            while($posts->have_posts()){
                $post_count++;
                $posts->the_post();
                // Thumbnail Size
                $thumbnail_size_index++;
                if($thumbnail_size_index >= count($thumbnail_size)){
                    $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                }
                if($post_count === 1){
                    $this->overcome_posts_featured_item_1_3($atts,[
                        'class'          => 'ef5-rounded-10 overlay-wrap overlay-primary-0/7',
                        'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '570'),
                        'readmore_title' => esc_html__('Donate Now')
                    ]);
                }
            }
            wp_reset_postdata();
        ?>
            <div class="col-lg-6">
                <?php
                    while($posts->have_posts()){
                        $post_count2++;
                        $posts->the_post();

                        // Thumbnail Size
                        $thumbnail_size_index++;
                        if($thumbnail_size_index >= count($thumbnail_size)){
                            $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                        }
                        if($post_count2 != 1){
                            $this->overcome_posts_item_1_3($atts,[
                                'class'          => 'overlay-wrap',
                                'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '170')
                            ]);
                        }
                    }
                    wp_reset_postdata();
                ?>
            </div>
        <?php
            break;
            case '1_2':
            $post_count = $post_count2 = 0;
            while($posts->have_posts()){
                $post_count++;
                $posts->the_post();
                // Thumbnail Size
                $thumbnail_size_index++;
                if($thumbnail_size_index >= count($thumbnail_size)){
                    $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                }
                if($post_count === 1){
                    $this->overcome_posts_featured_item2($atts,[
                        'class'          => 'ef5-rounded-10 overlay-wrap',
                        'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '570')
                    ]);
                }
            }
            wp_reset_postdata();
        ?>
            <div class="col-lg-6">
                <?php
                    while($posts->have_posts()){
                        $post_count2++;
                        $posts->the_post();

                        // Thumbnail Size
                        $thumbnail_size_index++;
                        if($thumbnail_size_index >= count($thumbnail_size)){
                            $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                        }
                        if($post_count2 != 1){
                            $this->overcome_posts_item2($atts,[
                                'class'          => 'overlay-wrap',
                                'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '170')
                            ]);
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
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                	<div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php overcome_vc_post_layout2($atts); ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '2-1':
                $item_css_class[] = 'ef5-rounded-10 overlay-wrap ef5-hover-shadow-1';
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php overcome_vc_post_layout2_1($atts); ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '3':
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                    // Thumbnail Size
                    $thumbnail_size_index++;
                    if($thumbnail_size_index >= count($thumbnail_size)){
                        $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                    }
                    $overlay = overcome_post_donate_button(['echo' => false, 'class'=>'ef5-btn ef5-btn-md accent outline']);
                ?>  <div class="<?php echo overcome_optimize_css_class(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                        <div class="<?php echo overcome_optimize_css_class(implode(' ', $item_css_class)); ?> overlay-wrap ef5-hover-shadow-1">
                            <?php 
                                overcome_post_media([
                                    'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                                    'default_thumb'  => true,
                                    'img_class'      => 'w-auto',   
                                    'after'          => '<div class="overlay ef5-bg-overlay"><div class="overlay-inner center-align">'.$overlay.'</div></div>'
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
                    </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '3-1':
                $d = 0;
                $item_css_class[] = 'ef5-rounded-10 overlay-wrap ef5-hover-shadow-1';
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                    // Thumbnail Size
                    $thumbnail_size_index++;
                    if($thumbnail_size_index >= count($thumbnail_size)){
                        $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                    }
                    $overlay = overcome_post_donate_button(['echo' => false, 'class'=>'ef5-btn ef5-btn-md accent fill']);
                ?>  <div class="<?php echo overcome_optimize_css_class(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                        <div class="<?php echo overcome_optimize_css_class(implode(' ', $item_css_class)); ?>">
                            <?php 
                                overcome_post_media([
                                    'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                                    'default_thumb'  => true,
                                    'img_class'      => 'w-auto ef5-rounded-t-10',   
                                    'after'          => '<div class="overlay ef5-bg-overlay ef5-rounded-t-10"><div class="overlay-inner center-align">'.$overlay.'</div></div>'
                                ]);
                            ?>
                            <div class="ef5-post-info">
                                <?php 
                                    overcome_post_title([
                                        'heading_tag' => 'text-22'
                                    ]);
                                    overcome_post_excerpt([
                                        'show_excerpt' => '1', 
                                        'length'       => '10', 
                                        'more'         => '...',
                                        'class'        => 'ef5-text-777777 pt-4 mb-10'
                                    ]);
                                    if(class_exists('EF5Payments')) {
                                    ?>
                                    <div class="ef5-donate-info">
                                        <div class="row gutters-10">
                                            <div class="col">
                                                <div class="ef5-text-primary font-style-500"><?php esc_html_e('Donate so far:','overcome');?></div>
                                                <?php overcome_post_share([
                                                    'title' => esc_html__('Share:','overcome'),
                                                    'show_share' => '1',
                                                    'class'      => 'text-12 text-uppercase ef5-text-777777 font-style-500',
                                                    'row_class'  => 'gutters-15',
                                                    'social_args'  => [
                                                        'class' => 'ef5-link-777777',
                                                        'size'  => 'small'
                                                    ],
                                                    'show_all'  => '0'  
                                                ]); ?>
                                            </div>
                                            <div class="col-auto text-end">
                                                <?php 
                                                    ef5payments_donation_raised([
                                                        'label' => '',
                                                        'class' => 'text-28 ef5-text-accent font-style-600'
                                                    ]);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '4':
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                    // Thumbnail Size
                    $thumbnail_size_index++;
                    if($thumbnail_size_index >= count($thumbnail_size)){
                        $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                    }
                    $item_css_class[] = 'relative';
                ?>
                <div class="<?php echo overcome_optimize_css_class(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo overcome_optimize_css_class(implode(' ', $item_css_class)); ?>">
                        <?php 
                            overcome_post_media([
                                'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                                'default_thumb'  => true,
                                'img_class'      => 'w-auto ef5-rounded-10',   
                            ]);
                        ?>
                        <div class="overlay ef5-bg-gradient-1 ef5-post-info ef5-rounded-10">
                            <div class="row h-100">
                                <div class="col-12 align-self-start">
                                <?php 
                                    overcome_posted_in([
                                        'show_cat' => '1',
                                        'class'    => '',
                                        'icon'     => '' 
                                    ]);
                                ?>
                                </div>
                                <div class="col-12 align-self-end">
                                    <?php 
                                        overcome_posted_on([
                                            'class' => 'text-white text-13 font-style-400i pb-10',
                                            'icon'  => '',
                                            'date_format' => 'd M, Y'
                                        ]);

                                        overcome_post_title([
                                            'heading_tag' => 'text-18 text-white font-style-500'
                                        ]);
                                        overcome_post_read_more([
                                            'before'         => '<div class="ef5-readmore-wrap">',
                                            'after'          => '</div>',
                                            'readmore_class' => 'text-14 ef5-text-accent font-style-500',
                                            'icon_right'     => is_rtl() ? 'text-12 flaticon-go-back-left-arrow' : 'flaticon-right-arrow-forward text-12'
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '5':
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <div class="row gutter-12">
                            <div class="col-auto">
                                <?php overcome_post_media([
                                    'thumbnail_size' => overcome_default_value($atts['thumbnail_size'], '48'), 
                                    'default_thumb'  => true,
                                    'img_class'      => 'ef5-rounded-5'   
                                ]); ?>
                            </div>
                            <div class="col ef5-content-info">
                                <?php 
                                    overcome_posted_on([
                                        'class' => 'text-13 ef5-text-accent',
                                        'icon'  => ''
                                    ]);
                                    overcome_post_title([
                                        'heading_tag' => 'text-13 lh-18 text-white font-style-400'
                                    ]);
                                    if(class_exists('EF5Payments')) {
                                        ef5payments_donation_layout_1(['progress_bar' => false, 'show_percent'=>false]);
                                    }
                                ?>
                            </div>
                        </div>
                        <?php ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '6':
                $item_css_class[] = 'ef5-rounded-10 ef5-shadow-1';
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php overcome_vc_post_layout6($atts); ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '7':
                $item_css_class[] = '';
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php
                            overcome_post_media([
                                'thumbnail_size' => overcome_default_value($atts['thumbnail_size'], '70'), 
                                'default_thumb'  => true,
                                'class'          => '',
                                'before'         => '<a href="'.get_the_permalink().'">',
                                'after'          => '</a>',
                                'img_class'      => 'ef5-rounded-5'
                            ]); 
                        ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '8':
                $item_css_class[] = '';
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php
                            overcome_post_media([
                                'thumbnail_size' => overcome_default_value($atts['thumbnail_size'], '370x240'), 
                                'default_thumb'  => true,
                                'class'          => '',
                                'before'         => '<a href="'.get_the_permalink().'">',
                                'after'          => '</a>',
                                'img_class'      => 'ef5-rounded-5'
                            ]); 
                        ?>
                        <?php
                            overcome_post_title([
                                'heading_tag' => 'text-22 lh-26 font-style-500'
                            ]);
                            overcome_post_excerpt([
                                'show_excerpt' => '1', 
                                'length'       => '15', 
                                'more'         => '',
                                'class'        => 'ef5-text-fourth'
                            ]);
                        ?>
                        <div class="separator"></div>
                        <?php
                            overcome_sermon_icons([
                                'class' => 'd-flex align-items-center lh-1 text-16'
                            ]);
                            overcome_sermon_metas(['class'=>'text-13', 'value_class' => 'ef5-text-fourth']);
                        ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;

            case '9':
                $item_css_class[] = '';
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <div class="row align-items-center">
                            <?php
                                overcome_post_media([
                                    'thumbnail_size' => overcome_default_value($atts['thumbnail_size'], '400x274'), 
                                    'default_thumb'  => true,
                                    'class'          => 'col-md-4 col-lg-35/8333333',
                                    'before'         => '<a href="'.get_the_permalink().'">',
                                    'after'          => '</a>',
                                    'img_class'      => 'ef5-rounded-5'
                                ]); 
                            ?>
                            <div class="col-md-8 col-lg-64/1666667">
                                <?php
                                    overcome_post_title([
                                        'heading_tag' => 'text-28 lh-32 font-style-500'
                                    ]);
                                    /*overcome_post_excerpt([
                                        'show_excerpt' => '1', 
                                        'length'       => '15', 
                                        'more'         => '',
                                        'class'        => 'ef5-text-fourth'
                                    ]);*/
                                    
                                    if(class_exists('EF5Payments')) {
                                        ef5payments_donation_layout_2();
                                    }

                                    overcome_sermon_icons([
                                        'class' => 'd-flex align-items-center lh-1 text-16'
                                    ]);
                                    overcome_sermon_metas(['class'=>'text-13', 'value_class' => 'ef5-text-fourth']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '11':
                $item_css_class[] = '';
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <?php overcome_vc_post_layout_11($atts); ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '12':
                $d = 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                ?>
                <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                    <div class="<?php echo trim(implode(' ', $item_css_class)); ?>">
                        <div class="row gutter-12">
                            <div class="col-auto">
                                <?php overcome_post_media([
                                    'thumbnail_size' => overcome_default_value($atts['thumbnail_size'], '85'), 
                                    'default_thumb'  => true,
                                    'img_class'      => ''   
                                ]); ?>
                            </div>
                            <div class="col ef5-content-info">
                                <?php
                                    overcome_post_title([
                                        'heading_tag' => 'text-18 font-style-500 pb-4'
                                    ]);
                                    if(class_exists('EF5Payments')) {
                                        ef5payments_donation_layout_1(['progress_bar' => false, 'show_percent'=>false]);
                                    }
                                ?>
                            </div>
                        </div>
                        <?php ?>
                    </div>
                </div>
                <?php
                    }// end while
                    wp_reset_postdata();
            break;
            case '13':
                $d= 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                    // Thumbnail Size
                    $thumbnail_size_index++;
                    if($thumbnail_size_index >= count($thumbnail_size)){
                        $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                    }
                    ?>
                        <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                            <?php
                            overcome_vc_post_layout_12($atts,[
                                'class'          => 'overlay-wrap',
                                'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '270x212')
                            ]);
                            ?>
                        </div>
                    <?php
                }
                wp_reset_postdata();
            break;
            case '14':
                $d= 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                    // Thumbnail Size
                    $thumbnail_size_index++;
                    if($thumbnail_size_index >= count($thumbnail_size)){
                        $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                    }
                    ?>
                        <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                            <?php
                            overcome_vc_post_layout_14($atts,[
                                'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '370x215')
                            ]);
                            ?>
                        </div>
                    <?php
                }
                wp_reset_postdata();
            break;
            case '15':
                $d= 0;
                while($posts->have_posts()){
                    $d++;
                    $posts->the_post();
                    // Thumbnail Size
                    $thumbnail_size_index++;
                    if($thumbnail_size_index >= count($thumbnail_size)){
                        $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
                    }
                    ?>
                        <div class="<?php echo trim(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d*100);?>ms">
                            <?php
                            overcome_vc_post_layout_15($atts,[
                                'thumbnail_size' => overcome_default_value($thumbnail_size[$thumbnail_size_index], '300x238')
                            ]);
                            ?>
                        </div>
                    <?php
                }
                wp_reset_postdata();
            break;
            
        } 
    ?>
    </div>
<?php 
    overcome_loop_pagination(['show_pagination' => $show_pagination, 'style' => '3', 'class' => 'justify-content-'.$pagination_align]); 
    $this->view_all($atts);
?>
</div>
