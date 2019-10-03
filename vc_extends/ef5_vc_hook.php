<?php
/**
 * Add your theme spacing
*/
add_filter('ef5systems_spacings','overcome_spacings');
function overcome_spacings(){
	return [
		' pt-8 pb-8' => ['OverCome Space 01', 'Top 8px - Bottom 8px', ''],
	];
}

/**
 * Add your theme Color
*/
add_filter('ef5systems_colors','overcome_colors');
function overcome_colors(){
	return [
		'ababab' => ['OverCome Color 01', '#ababab'],
	];
}