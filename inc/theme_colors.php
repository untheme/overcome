<?php
/**
 * Add theme colors list
 * structure: name => array (Title, Color Value)
*/
function overcome_colors(){
	return [
		''				=> ['Default'],
		'primary'		=> ['Primary', overcome_configs('primary_color'), 'var(--primary-color)'],
		'accent'		=> ['Accent', overcome_configs('accent_color'), 'var(--accent-color)'],
		'accent2'		=> ['Accent2', '#FF9827'],
		'secondary'	 	=> ['Secondary', overcome_configs('secondary_color'), 'var(--secondary-color)'],
		'darken-accent' => ['Darken Accent', overcome_configs('secondary_color'), 'var(--secondary-color)'],
		'dark' 		    => ['Dark', '#000000'],
		'medium-dark'   => ['Medium Dark', '#161616'],
		'dark-blue'     => ['Dark Blue', '#182333'],
		'light-dark'    => ['Light Dark', '#161616'],
		'light' 	    => ['Light', '#f5f5f5'],
		'medium-light'  => ['Medium Light', '#f1f1f1'],
		'white' 		=> ['White', '#FFFFFF'],
		'white-1'		=> ['White 1', 'rgba(255,255,255, 0.1)'],
		'white-2'		=> ['White 2', 'rgba(255,255,255, 0.2)'],
		'white-3'		=> ['White 3', 'rgba(255,255,255, 0.3)'],
		'white-4'		=> ['White 4', 'rgba(255,255,255, 0.4)'],
		'white-5'		=> ['White 5', 'rgba(255,255,255, 0.5)'],
		'white-6'		=> ['White 6', 'rgba(255,255,255, 0.6)'],
		'white-7'		=> ['White 7', 'rgba(255,255,255, 0.7)'],
		'white-8'		=> ['White 8', 'rgba(255,255,255, 0.8)'],
		'white-9'		=> ['White 9', 'rgba(255,255,255, 0.9)'],
		'invalid'		=> ['Invalid', '$invalid_color'],
		'green'		    => ['Green', 'green'],
		'yellow'		=> ['Yellow', 'yellow'],
		'red'		    => ['Red', 'red'],
		'violet'		=> ['Violet', 'violet'],
		'cyan'		    => ['Cyan', 'cyan'],
		'grey'		    => ['Grey', '#b0b0b0'],
		't606060'		=> ['606060', '#606060'],
		't999999'		=> ['999999', '#999999'],
	];
}

function overcome_colors_option_for_vc($extra = []){
	$colors = overcome_colors();
	$options = [];
	foreach ($colors as $key => $color) {
		$sub_title = isset($color[1]) ? ' ('.$color[1].')' : '';
		$options[$color[0].$sub_title] = $key;
	}
	return array_merge($options, $extra);
}


function overcome_colors_option_for_scss($extra = []){
	$colors = overcome_colors();
	$options = [];
	foreach ($colors as $key => $color) {
		$color[1] = isset($color[1]) ? $color[1] : '\'\'';
		$color[2] = isset($color[2]) ? $color[2] : $color[1];

		if(!empty($key)) $options[] = '\''.$key.'\':'.$color[2];
	}
	return implode(',',array_merge($options, $extra));
}