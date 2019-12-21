<?php
function overcome_vc_post_layout2($atts){
	$after = '<div class="overlay ef5-bg-overlay"><div class="overlay-inner center-align"><a class="text-36 text-white" href="'.get_the_permalink().'"><span class="fa fa-link"></span></a></div></div>';
	?>
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
                overcome_loop_donate_info();
            ?>
        </div>
	<?php
}
function overcome_vc_post_layout2_1($atts){
    $after = '<div class="overlay ef5-bg-overlay"><div class="overlay-inner center-align">';
    switch (get_post_type()) {
        case 'ef5_donation':
                $after .= ef5payments_donation_donate_button(['echo' => false, 'class' => 'ef5-btn accent fill ef5-btn-md']);
            break;
        
        default:
                $after .= '<a class="text-36 text-white" href="'.get_the_permalink().'"><span class="fa fa-link"></span></a>';
            break;
    }
    $after .= '</div></div>';
    ?>
        <div class="relative">
            <?php 
                overcome_post_media([
                    'thumbnail_size' => '', 
                    'default_thumb'  => true,
                    'after'          => $after
                ]);
            ?>
        </div>
        <div class="pl-15 pr-15 pl-lg-30 pr-lg-30 pt-25 pb-25">
            <?php 
                overcome_post_title([
                    'heading_tag' => 'text-20',
                    'class'       => 'pb-13'  
                ]);
                overcome_post_excerpt([
                    'show_excerpt' => '1', 
                    'length'       => '15', 
                    'more'         => '',
                    'class'        => 'mb-18 ef5-text-787878' 
                ]);
                //overcome_loop_donate_info();
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
    <?php

}

function overcome_vc_post_layout6($atts, $args = []){
    $args = wp_parse_args($args,[
        'label' => esc_html__('Upcoming Event','overcome')
    ]);
    $support_coundown = apply_filters('overcome_support_coundown', ['tribe_events','ef5_donation','ef5_stories']);
    if(in_array(get_post_type(), $support_coundown)){
        wp_enqueue_script('countdown');
        wp_enqueue_script('ef5-countdown');
        $time_start = '';
        $time_end = '';
        switch (get_post_type()) {
            case 'tribe_events':
                $time_end = get_post_meta( get_the_ID(), '_EventEndDate', true );
                break;
            
            case 'ef5_donation':
                $meta = apply_filters('ef5payments_get_post_meta',[],get_the_ID(),false);
                $time_end = isset($meta['end_date_time']) && !empty($meta['end_date_time']) ? strtotime($meta['end_date_time']) : strtotime('+22 days 18 hours '.get_the_ID().' minutes 55 seconds');;
                break;

            case 'ef5_stories':
                $meta = apply_filters('ef5payments_get_post_meta',[],get_the_ID(),false);
                $time_end = isset($meta['end_date_time']) && !empty($meta['end_date_time']) ? strtotime($meta['end_date_time']) : strtotime('+22 days 18 hours '.get_the_ID().' minutes 55 seconds');;
                break;
        }
        $time = is_numeric($time_end) ? $time_end : strtotime($time_end);

        $date_sever = date_i18n('Y-m-d G:i:s');   
        $gmt_offset = get_option( 'gmt_offset' );
        /* check if current time from config is empty or less than current time 
         * && (strtotime($time) < strtotime('now'))
         */
        if(empty($time)) $time = strtotime("+22 days 18 hours 30 minutes 55 seconds");
        $countdown_css_class = ['ef5-countdown'];
        /*
            * Time format
            'Years, Month, Week, Days, Hours, Minute, Second' => '1',
            'Month, Week, Days, Hours, Minute, Second'        => '2',
            'Month, Days, Hours, Minute, Second'              => '3',
            'Week, Days, Hours, Minute, Second'               => '4',
            'Days, Hours, Minute, Second'                     => '5',
            'Hours, Minute, Second'                           => '6',
        */
        $time_format = apply_filters('overcome_time_coundown_format','5');
        $time_label = apply_filters('overcome_time_coundown_label', esc_html__('Years, Month, Week, Days, Hours, Mins, Secs','overcome'));
        // Css Class 
        $left_class = 'col-lg-7';
    } else {
        $left_class = 'col-12';
    }
    ?>
    <div class="p-15 pl-lg-35 pr-lg-35 pt-lg-27 pb-lg-20">
        <div class="row">
            <div class="<?php echo esc_attr($left_class);?>">
                <div class="ef5-text-accent font-style-500 pb-4"><?php echo esc_html($args['label']); ?></div>
                <?php 
                    overcome_post_title([
                        'heading_tag' => 'text-22',
                        'class'       => 'pb-12'  
                    ]);
                    overcome_tribe_events_info_hori(['class' => 'text-13']);
                    overcome_vc_item_meta1(['class' => 'text-13']);
                ?>
            </div>
            <?php if(in_array(get_post_type(), $support_coundown)) : ?>
            <!-- HTML CountDown Structure
                <div class="item-inner"><span class="amount">{ynn}</span><span class="title">' + data_label[0] + '</span></div>
            -->
            <div class="col-auto col-lg-5 pt-25 pt-lg-5">
                <div class="<?php echo trim(implode(' ', $countdown_css_class));?>">
                    <div class="ef5-countdown-bar ef5-countdown-time ef5-countdown-layout-1" data-count="<?php echo esc_attr(date('Y,m,d,H,i,s', $time)); ?>" data-format="<?php echo esc_attr($time_format);?>" data-label="<?php echo esc_attr($time_label);?>" data-timezone="<?php echo esc_attr($gmt_offset); ?>"></div> 
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <?php
}
function overcome_vc_post_layout_11($atts, $args =[]){
    $args = wp_parse_args($args, [
        'class' => ''
    ]);
    extract($atts);
    ?>
        <div class="row align-items-center">
            <?php
                overcome_post_media([
                    'thumbnail_size' => overcome_default_value($atts['thumbnail_size'], '350x240'), 
                    'default_thumb'  => true,
                    'class'          => 'col-12 col-md-6 mw-lg-380 col-auto',
                    'before'         => '<a href="'.get_the_permalink().'">',
                    'after'          => '</a>',
                    'img_class'      => 'ef5-rounded-10'
                ]); 
            ?>
            <div class="col">
                <?php
                    overcome_post_title([
                        'heading_tag' => 'text-20 font-style-600 mt-20 mt-md-0 pb-15'
                    ]);
                    overcome_post_excerpt([
                        'show_excerpt' => '1', 
                        'length'       => '15', 
                        'more'         => '',
                        'class'        => 'ef5-text-787878 mb-18'
                    ]);
                    
                    if(class_exists('EF5Payments')) {
                        ef5payments_donation_layout_1();
                    }
                    overcome_sermon_icons([
                        'class' => 'd-flex align-items-center lh-1 text-16'
                    ]);
                    overcome_sermon_metas(['class'=>'text-13', 'value_class' => 'ef5-text-fourth']);
                ?>
            </div>
        </div>
    <?php
}
function overcome_vc_post_layout_12($atts, $args = []){
    $args = wp_parse_args($args, [
        'class'          => '',
        'thumbnail_size' => '270x212',
    ]);
    $css_class = ['ef5-post-item-inner', 'row', $args['class']];
    $after = '<div class="overlay ef5-bg-overlay"><div class="overlay-inner center-align"><a class="text-36 text-white" href="'.get_the_permalink().'"><span class="fa fa-link"></span></a></div></div>'
    ?>
    <div class="ef5-post-item ef5-post-item-<?php echo esc_attr($atts['layout_template']);?> ef5-rounded-10 ef5-hover-shadow-1 mb-50 transition">
        <div class="<?php echo trim(implode(' ', $css_class));?>">
            <?php 
                overcome_post_media([
                    'thumbnail_size' => $args['thumbnail_size'], 
                    'default_thumb'  => true,
                    'class'          => 'col-xs-auto p-0',
                    'before'         => '<div class="relative h-100">',
                    'after'          => $after.'</div>',
                    'img_class'      => 'h-100'
                ]);   
            ?>
            <div class="col pt-17 pb-8 pl-20 pr-20">
                <?php 
                    overcome_post_title(['class'=>'text-22 pb-5']);
                    overcome_post_excerpt([
                        'show_excerpt' => '1', 
                        'length'       => '5', 
                        'more'         => '',
                        'class'        => 'text-13 mb-17' 
                    ]);
                    overcome_tribe_events_info_hori(['class' => 'text-13']);
                    overcome_loop_donate_info2(['layout' => '3']);
                ?>
            </div>
        </div>
    </div>
    <?php
}