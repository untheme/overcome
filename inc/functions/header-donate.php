<?php
function overcome_header_donate_button(){
	var_dump(overcome_get_opts('header_donate', '0'));
	if(!function_exists('ef5payments_donation_donate_button') || overcome_get_opts('header_donate', '0')) return;
	ef5payments_donation_donate_button([
		'id'    => overcome_get_id_by_slug(overcome_get_opts('header_donate_item',''),'ef5_donation'),
		'title' => overcome_get_opts('header_donate_label', esc_html__('Donate Now','overcome'))
	]);
}