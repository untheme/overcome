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

function overcome_vc_post_layout6($atts, $args = []){
    $args = wp_parse_args($args,[
        'label' => esc_html__('Upcoming Event','overcome')
    ]);
    $time_start = '';
    $time_end = '';
    wp_enqueue_script('countdown');
    wp_enqueue_script('ef5-countdown');
    if(get_post_type() === 'trile_events') $time_end = '';
    $time = strtotime($time_end);
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
    ?>
    <div class="p-15 pr-lg-35">
        <div class="row gutter-lg-70">
            <div class="col-lg-7">
                <div class="ef5-text-accent font-style-500"><?php echo esc_html($args['label']); ?></div>
                <?php 
                    overcome_post_title([
                        'heading_tag' => 'text-22',
                        'class'       => 'pb-15'  
                    ]);
                    overcome_tribe_events_info_hori(['class' => 'text-13']);
                    overcome_vc_item_meta1(['class' => 'text-13']);
                ?>
            </div>
            <div class="col-lg-5">
                <div class="<?php echo trim(implode(' ', $countdown_css_class));?>">
                    <div class="ef5-countdown-bar ef5-countdown-time" data-count="<?php echo esc_attr(date('Y,m,d,H,i,s', $time)); ?>" data-format="<?php echo esc_attr($time_format);?>" data-label="<?php echo esc_attr($time_label);?>" data-timezone="<?php echo esc_attr($gmt_offset); ?>"></div> 
                </div>
            </div>
        </div>
    </div>
    <?php
}