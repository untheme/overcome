<?php
function overcome_iconpicker_font_name_icons(){
	// add your icon here
	// struct ['icon-class-name' => 'icon name']
	// icon name need in array
	$default_icons = [
		['xxx' => 'xxx']
	];
	return array_merge($default_icons, apply_filters('overcome_iconpicker_font_name_icons', []));
}
add_filter( 'vc_iconpicker-type-font-name', 'overcome_vc_iconpicker_type_font_name_icons' );
function overcome_vc_iconpicker_type_font_name_icons( $icons ) {
	$font_name_icons = overcome_iconpicker_font_name_icons();
	return array_merge( $icons, $font_name_icons );
}

/**
 * Add filter to support your icon font in Mega Menu and VC 
 * user filter: ef5systems_extra_icons
 * @structure add_filter('ef5systems_extra_icons','overcome_font_name_icons');
 * function overcome_font_name_icons(){
	return [
		'font-name' => [
			'title'   => 'Font Title ',
			'icon'    => overcome_iconpicker_font_name_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/font-name/font-name.css',
			'version' => '1.0'
		]
	];
 }
 * NOTE: replace 'font-name', 'font_name' with your font name
*/
add_filter('ef5systems_extra_icons','overcome_font_name_icons');
function overcome_font_name_icons(){
	return [
		'font-name' => [
			'title'   => 'Font Title ',
			'icon'    => overcome_iconpicker_font_name_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/font-name/font-name.css',
			'version' => '1.0'
		]
	];
}