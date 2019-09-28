<?php
/**
 * Add filter to support your icon font in Mega Menu and VC 
 * user filter: ef5systems_extra_icons
 * @structure add_filter('ef5systems_extra_icons','overcome_extras_icons');
 * function overcome_extras_icons(){
	return [
		'overcome' => [
			'title'   => 'Over Come ',
			'icon'    => overcome_iconpicker_overcome_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/overcome/overcome.css',
			'version' => '1.0'
		]
	];
 }
 * NOTE: replace 'overcome', 'overcome' with your font name
*/
add_filter('ef5systems_extra_icons','overcome_extras_icons');
function overcome_extras_icons(){
	return [
		'fontname' => [
			'title'   => 'Font Name ',
			'icon'    => overcome_iconpicker_fontname_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/fontname/fontname.css',
			'version' => '1.0'
		],
		'overcome' => [
			'title'   => 'Over Come',
			'icon'    => overcome_iconpicker_overcome_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/overcome/overcome.css',
			'version' => '1.0'
		]
	];
}