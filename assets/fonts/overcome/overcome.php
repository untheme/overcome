<?php
function overcome_iconpicker_overcome_icons(){
	// add your icon here
	// struct 'icon-class-name' => 'icon name'
	$default_icons = [
		'flaticon-001-axe'         => esc_html('flaticon-001-axe '),
		'flaticon-002-bat'         => esc_html('flaticon-002-bat '),
		'flaticon-003-moon'        => esc_html('flaticon-003-moon '),
		'flaticon-004-crossbones'  => esc_html('flaticon-004-crossbones '),
		'flaticon-005-broom'       => esc_html('flaticon-005-broom '),
		'flaticon-006-candle'      => esc_html('flaticon-006-candle '),
		'flaticon-007-candy'       => esc_html('flaticon-007-candy '),
		'flaticon-008-candies'     => esc_html('flaticon-008-candies '),
		'flaticon-009-candy'       => esc_html('flaticon-009-candy '),
		'flaticon-010-cauldron'    => esc_html('flaticon-010-cauldron '),
		'flaticon-011-cobweb'      => esc_html('flaticon-011-cobweb '),
		'flaticon-012-coffin'      => esc_html('flaticon-012-coffin '),
		'flaticon-013-dracula'     => esc_html('flaticon-013-dracula '),
		'flaticon-014-eyeball'     => esc_html('flaticon-014-eyeball '),
		'flaticon-015-ghost'       => esc_html('flaticon-015-ghost '),
		'flaticon-016-cat'         => esc_html('flaticon-016-cat '),
		'flaticon-017-ghost'       => esc_html('flaticon-017-ghost '),
		'flaticon-018-ghost'       => esc_html('flaticon-018-ghost '),
		'flaticon-019-gravestone'  => esc_html('flaticon-019-gravestone '),
		'flaticon-020-zombie'      => esc_html('flaticon-020-zombie '),
		'flaticon-021-zombie'      => esc_html('flaticon-021-zombie '),
		'flaticon-022-knife'       => esc_html('flaticon-022-knife '),
		'flaticon-023-lantern'     => esc_html('flaticon-023-lantern '),
		'flaticon-024-monster'     => esc_html('flaticon-024-monster '),
		'flaticon-025-mummy'       => esc_html('flaticon-025-mummy '),
		'flaticon-026-owl'         => esc_html('flaticon-026-owl '),
		'flaticon-027-poison'      => esc_html('flaticon-027-poison '),
		'flaticon-028-pumpkin'     => esc_html('flaticon-028-pumpkin '),
		'flaticon-029-scripture'   => esc_html('flaticon-029-scripture '),
		'flaticon-030-scythe'      => esc_html('flaticon-030-scythe '),
		'flaticon-031-skull'       => esc_html('flaticon-031-skull '),
		'flaticon-032-skull'       => esc_html('flaticon-032-skull '),
		'flaticon-033-tree'        => esc_html('flaticon-033-tree '),
		'flaticon-034-trident'     => esc_html('flaticon-034-trident '),
		'flaticon-035-voodoo-doll' => esc_html('flaticon-035-voodoo-doll '),
		'flaticon-036-wand'        => esc_html('flaticon-036-wand '),
	];
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
 * @structure add_filter('ef5systems_extra_icons','overcome_overcome_icons');
 * function overcome_overcome_icons(){
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
add_filter('ef5systems_extra_icons','overcome_overcome_icons');
function overcome_overcome_icons(){
	return [
		'overcome' => [
			'title'   => 'Over Come',
			'icon'    => overcome_iconpicker_overcome_icons(), // icons list
			'css'     => get_template_directory_uri() . '/assets/fonts/overcome/overcome.css',
			'version' => '1.0'
		]
	];
}