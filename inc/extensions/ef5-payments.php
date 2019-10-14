<?php
function overcome_loop_donate_info($args = []){
	$args = wp_parse_args($args,[
		'layout' => '1',
		'class'  => '' 
	]);
	$post_type = get_post_type(get_the_ID());
	$css_class = ['ef5-loop-donate-info', 'layout-'.$args['layout'], $args['class']];
    if(class_exists('EF5Payments') && in_array($post_type, apply_filters('ef5payments_payment_attach_post_types',['ef5_donation']))){
    	switch ($args['layout']) { 		
    		default:
    		$css_class[] = 'row justify-content-between';
	?>
		<div class="<?php echo trim(implode(' ', $css_class));?>">
			<div class="ef5-loop-donate-info-inner">
				<div class="col-auto">
					<?php ef5payments_donation_raised([
						'label' => esc_html__('Donate so far:','overcome'),
						'class'	=> 'ef5-donation-raised'
					]); ?>
				</div>
				<div class="col-auto">
					<?php 
						ef5payments_donation_donate_button([
							'class' => 'ef5-btn ef5-btn-md accent outline2'
						]); 
						overcome_post_share(['show_share' => '1','title' => esc_html__('Share:','overcome'), 'show_all' => 'false']);
					?>
				</div>
			</div>
		</div>
	<?php
			break;
    	}
	} else {
		overcome_post_read_more(['show_readmore' => '1']); 
	}
}