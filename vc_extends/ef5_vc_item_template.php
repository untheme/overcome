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

function overcome_vc_post_layout6($atts, $args[]){
    $args = wp_parse_args($args,[
        'label' => esc_html__('Upcoming Event','overcome');
    ]);
    ?>
    <div class="row gutter-lg-70">
        <div class="col-lg-7">
            <?php echo esc_html($args['label']); ?>
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
        </div>
    </div>
    <?php
}