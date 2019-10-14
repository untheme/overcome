<?php
function overcome_loop_donate_info($args = []){
	$args = wp_parse_args($args,[
		'layout' => ''
	]);
	$post_type = get_post_type(get_the_ID());
    if(class_exists('EF5Payments') && in_array($post_type, apply_filters('ef5payments_payment_attach_post_types',['ef5_donation']))){
    	switch ($args['layout']) { 		
    		default:
	?>
		<div class="ef5-loop-donate-info row justify-content-between">
			<div class="col-md-6">
				<?php ef5payments_donation_raised([
					'label' => esc_html__('Donate so far:','overcome')
				]); ?>
			</div>
			<div class="col-md-6">
				<?php 
					ef5payments_donation_donate_button(); 
					overcome_post_share(['show_share' => '1','title' => esc_html__('Share:','overcome')]);
				?>
			</div>
		</div>
	<?php
			break;
    	}
	} else {
		overcome_post_read_more(['show_readmore' => '1']); 
	}
}