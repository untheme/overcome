<?php
function overcome_header_donate_button(){
	if(!function_exists('ef5payments_donation_donate_button') || overcome_get_opts('header_donate', '0') === '0') return;
	echo 'xxx';
	ef5payments_donation_donate_button([
		'id'    => ef5payments_default_donation(overcome_get_id_by_slug(overcome_get_opts('header_donate_item',''),'ef5_donation')),
		'title' => overcome_get_opts('header_donate_label', esc_html__('Donate Now','overcome')),
		'class' => 'ef5-btn fill accent donate-'.ef5payments_default_donation(overcome_get_id_by_slug(overcome_get_opts('header_donate_item',''),'ef5_donation'))
	]);
}