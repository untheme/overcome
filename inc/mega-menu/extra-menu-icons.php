<?php
/**
 * Defind menu has can add icon
 * 
*/
if(!function_exists('overcome_menu_can_add_icon')){
    add_filter('ef5_menu_icon_locations','overcome_menu_can_add_icon');
    function overcome_menu_can_add_icon(){
        return array(
        	'ef5-menu-icon',
        	'ef5-menu-icon-2',
        	'ef5-menu-icon-3',
        	'ef5-menu-icon-4',
        	'ef5-menu-icon-5'
        );
    }
}

/**
 * add new icon
 *
*/
if(!function_exists('overcome_extra_mega_menu_icons')){
	add_filter('ef5_extra_nav_icon', 'overcome_extra_mega_menu_icons' );
	function overcome_extra_mega_menu_icons(){
		$extra_icons = array(
			'Flat Icons' => overcome_iconpicker_flaticon_icons()
		);
		return $extra_icons;
	}
}
/**
 * Call new icon
 *
*/
if(!function_exists('overcome_extra_mega_menu_icons_css')){
	add_action('admin_enqueue_scripts', 'overcome_extra_mega_menu_icons_css');
	add_action('wp_enqueue_scripts', 'overcome_extra_mega_menu_icons_css');
	function overcome_extra_mega_menu_icons_css(){
	    wp_enqueue_style('font-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/flaticon.css', '');
	}
}



