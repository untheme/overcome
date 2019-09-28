<?php
function overcome_iconpicker_fontname_icons(){
	// add your icon here
	// struct ['icon-class-name' => 'icon name']
	// icon name need in array
	$default_icons = [
		['xxx' => 'xxx']
	];
	return array_merge($default_icons, apply_filters('overcome_iconpicker_fontname_icons', []));
}
add_filter( 'vc_iconpicker-type-fontname', 'overcome_vc_iconpicker_type_fontname_icons' );
function overcome_vc_iconpicker_type_fontname_icons( $icons ) {
	$fontname_icons = overcome_iconpicker_fontname_icons();
	return array_merge( $icons, $fontname_icons );
}

/**
 * Add filter to support your icon font in Mega Menu and VC 
 * user filter: ef5systems_extra_icons
 * @structure add_filter('ef5systems_extra_icons','overcome_fontname_icons');
 * function overcome_fontname_icons(){
	return [
		'fontname' => [
			'title'   => 'Font Name ',
			'icon'    => overcome_iconpicker_fontname_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/fontname/fontname.css',
			'version' => '1.0'
		]
	];
 }
 * NOTE: replace 'fontname', with your font name
*/
add_filter('ef5systems_extra_icons','overcome_fontname_icons');
function overcome_fontname_icons(){
	return [
		'fontname' => [
			'title'   => 'Font Name ',
			'icon'    => overcome_iconpicker_fontname_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/fontname/fontname.css',
			'version' => '1.0'
		]
	];
}