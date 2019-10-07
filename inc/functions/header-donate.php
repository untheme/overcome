<?php
function overcome_header_donate_button(){
	if(!function_exists('ef5payments_donation_donate_button')) return;
	ef5payments_donation_donate_button([
		'id' => ''
	]);
}