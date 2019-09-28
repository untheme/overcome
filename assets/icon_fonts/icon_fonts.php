<?php
define('OVERCOME_ICON_FONT_DIR' , get_template_directory_uri() . '/assets/icon_fonts/');
/**
 * Add filter to support your icon font in Mega Menu and VC 
 * user filter: ef5systems_extra_icons
 * @structure add_filter('ef5systems_extra_icons','overcome_extras_icons');
 * function overcome_extras_icons(){
	return [
		'fontname' => [
			'title'   => 'Font Name',
			'icon'    => overcome_iconpicker_fontname_icons(), // icons list
			'css'     => OVERCOME_ICON_FONT_DIR . 'fontname/fontname.css',
			'version' => '1.0'
		]
	];
 }
 * NOTE: replace 'overcome', 'Font Name' with your font name
*/
//add_filter('ef5systems_extra_icons','overcome_extras_icons');
function overcome_extras_icons(){
	return [
		'overcome' => [
			'title'   => 'Over Come',
			'icon'    => overcome_iconpicker_overcome_icons(), // icons list
			'css'     => OVERCOME_ICON_FONT_DIR.'overcome/overcome.css',
			'version' => '1.0'
		]
	];
}