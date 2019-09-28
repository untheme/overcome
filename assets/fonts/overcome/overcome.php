<?php
function overcome_iconpicker_overcome_icons(){
	// add your icon here
	// struct 'icon-class-name' => 'icon name'
	$default_icons = [];
	return array_merge($default_icons, apply_filters('overcome_iconpicker_overcome_icons', []));
}
add_filter( 'vc_iconpicker-type-overcome', 'overcome_vc_iconpicker_type_overcome_icons' );
function overcome_vc_iconpicker_type_overcome_icons( $icons ) {
	$overcome_icons = overcome_iconpicker_overcome_icons();
	return array_merge( $icons, $overcome_icons );
}

/**
 * Add filter to support your icon font in Mega Menu and VC 
 * user filter: ef5systems_extra_icons
 * @structure add_filter('ef5systems_extra_icons','overcome_default_extra_icons');
 * function overcome_default_extra_icons(){
	return [
		'overcome' => [
			'title'   => 'Font Title ',
			'icon'    => overcome_iconpicker_overcome_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/overcome/overcome.css',
			'version' => '1.0'
		]
	];
 }
 * NOTE: replace 'overcome', 'overcome' with your font name
*/
add_filter('ef5systems_extra_icons','overcome_default_extra_icons');
function overcome_default_extra_icons(){
	return [
		'overcome' => [
			'title'   => 'Over Come',
			'icon'    => overcome_iconpicker_overcome_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/overcome/overcome.css',
			'version' => '1.0'
		]
	];
}