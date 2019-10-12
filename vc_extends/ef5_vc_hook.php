<?php
/**
 * Custom OWL Nav Style
*/
add_filter('ef5systems_carousel_custom_nav_style', 'overcome_owl_custom_nav_style');
function overcome_owl_custom_nav_style(){
	return [
		esc_html__('Overcome Style 01','overcome') => 'overcome-1'
	];
}