<?php

/**
 * Add your theme spacing
*/
add_filter('ef5systems_spacings','overcome_spacings');
function overcome_spacings(){
	return [
		'1' => ['OverCome Space 01', '100px 0'],
		'2' => ['OverCome Space 02', '200px 0']
	];
}