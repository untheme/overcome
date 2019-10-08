<?php
/**
 * Add your theme spacing
*/
add_filter('ef5systems_spacings','overcome_spacings');
function overcome_spacings(){
	return [
		'custom1 pt-8 pb-8' => ['OverCome Space 01', 'Top 8px - Bottom 8px'],
		'100-0' => ['OverCome Space 02', 'Top 100px - Bottom 100px', '100px 0'],
	];
}

/**
 * Add your theme Gutter
*/
add_filter('ef5systems_gutters','overcome_gutters');
function overcome_gutters(){
	return [
		'20' => ['OverCome Gutter 20', '', '20px'],
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