<?php
/**
 * Primary Color 
 * use filter: 'overcome_primary_color';
 * @return string
 * @example add_filter('overcome_primary_color', function(){ return '#000000';});
*/
/**
 * Accent Color 
 * use filter : overcome_accent_color
 * @return string
 * @example add_filter('overcome_accent_color', function(){ return '#25d6a2';});
*/

/**
 * Page CSS Class
 * use filter: overcome_page_css_class
 * @return array
 * @example add_filter('overcome_page_css_class', function($cls) { $cls[] = 'yout-css-class';  return $cls;});
*/

/**
 * Header link color, 
 * use filter: overcome_header_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('overcome_header_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/
/**
 * Header OnTop link color, 
 * use filter: overcome_ontop_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('overcome_ontop_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Header Sticky link color, 
 * use filter: overcome_sticky_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('overcome_sticky_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Dropdown Background color, 
 * use filter: overcome_dropdown_bg
 * 
 * @return string
 * @example add_filter('overcome_dropdown_bg', function(){ return 'rgba(#000000, 1)';})
*/

/**
 * Dropdown link color, 
 * use filter: overcome_dropdown_link_colors
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('overcome_dropdown_link_colors', function(){ return ['regular' => 'white', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Logo Size
 * use filter: overcome_logo_size
 * @return array(width, height, units)
 * @example add_filter('overcome_logo_size', function() { return ['width' => '130', 'height' => '51', 'units' => 'px'];});
*/

/**
 * Show Default Post thumbnail
 * use filter : overcome_default_post_thumbnail
 * @return bool
 * @default false
 * @example add_filter('overcome_default_post_thumbnail', function(){ return false;});
*/
add_filter('overcome_default_post_thumbnail', function(){ return overcome_configs('overcome_default_post_thumbnail');});

/**
 * Default sidebar position 
 * use filter: overcome_archive_sidebar_position
 * @return string left / right / none
 * @example add_filter('overcome_archive_sidebar_position', function(){ return 'right';});
*/
add_filter('overcome_archive_sidebar_position', function(){ return 'bottom';});
/**
 * Default Archive grid columns
 * use filter : overcome_archive_grid_col
 * @return string 1 - 12
 * @example add_filter('overcome_archive_grid_col', function(){ return '8';});
*/

/**
 * Default Archive Pagination
 * use filter: overcome_loop_pagination
 * @return string 1 - 5
 * @example: add_filter('overcome_loop_pagination', function(){ return '3';});
*/

/**
 * Default Archive Pagination Prev Text
 * use filter: overcome_loop_pagination_prev_text
 * @return string 
 * @example: add_filter('overcome_loop_pagination_prev_text', function(){ return esc_html__('Previous', 'overcome');});
*/

/**
 * Default Archive Pagination Next Text
 * use filter: overcome_loop_pagination_next_text
 * @return string 
 * @example: add_filter('overcome_loop_pagination_next_text', function(){ return esc_html__('Next', 'overcome');});
*/

/**
 * Default Archive Pagination Sep Text
 * use filter: overcome_loop_pagination_sep_text
 * @return string 
 * @example: add_filter('overcome_loop_pagination_sep_text', function(){ return '<span class="d-none"></span>';});
*/

/**
 * Show post related by taxonomy
 * use filter: overcome_post_related_by
 * @return string
 * @default cat
 * @example add_filter('overcome_post_related_by', function(){return 'cat';});
*/

/**
 * Remove Supported post type for VC Element 
 * use filter : overcome_vc_post_type_list 
 * @return array
 * @example add_filter('overcome_vc_post_type_list', function($post_type){ $post_type[] = 'ef5_header_top'; return $post_type;});
*/

// Support Portfolio or Not
add_filter('overcome_cpts_portfolio',function(){ return true;});
// Support header Top
add_filter('overcome_cpts_header_top', function(){ return true;});
// Support Footer Top
add_filter('overcome_cpts_footer', function(){ return true;});

/**
 * Custom WooCommerce
 * Custom single images, loop images, gallery thumbnail, cart thumbnail size
 * 
*/
/**
 * WooCommerce loop thumbnail size
 * use filter: 
 * width: overcome_product_loop_image_w
 * height: overcome_product_loop_image_h
 * @return string
 * @example 
 * widht : apply_filters('overcome_product_loop_image_w', funtion(){ return '400';});
 * height : apply_filters('overcome_product_loop_image_h', funtion(){ return '400';});
*/

/**
 * WooCommerce single thumbnail size
 * use filter: 
 * width: overcome_product_single_image_w
 * height: overcome_product_single_image_h
 * @return string
 * @example 
 * widht : apply_filters('overcome_product_single_image_w', funtion(){ return '600';});
 * height : apply_filters('overcome_product_single_image_h', funtion(){ return '600';});
*/

/**
 * WooCommerce gallery thumbnail size
 * use filter: 
 * width: overcome_product_gallery_thumbnail_w
 * height: overcome_product_gallery_thumbnail_h
 * @return string
 * @example 
 * widht : apply_filters('overcome_product_gallery_thumbnail_w', funtion(){ return '100';});
 * height : apply_filters('overcome_product_gallery_thumbnail_h', funtion(){ return '100';});
*/

/**
 * WooCommerce cart thumbnail size
 * use filter: 
 * size: overcome_woocommerce_cart_item_thumbnail_size
 * @return string
 * @example 
 * size : apply_filters('overcome_woocommerce_cart_item_thumbnail_size', funtion(){ return '100x100';});
 * 
*/

/**
 * Add your theme spacing
*/
add_filter('ef5systems_spacings','overcome_spacings');
function overcome_spacings(){
	return [
		'custom1 pt-8 pb-8' => ['OverCome Space 01', 'Top 8px - Bottom 8px'],
		'87-0-92'          	=> ['OverCome Space 02', 'Top 87px - Bottom 92px', '87px 0 92px 0'],
		'93-0-100'          => ['OverCome Space 03', 'Top 93px - Bottom 100px', '93px 0 100px 0'],
		'93-0-93'          	=> ['OverCome Space 04', 'Top 93px - Bottom 93px', '93px 0 93px 0'],
		'100-0'             => ['OverCome Space 05', 'Top 100px - Bottom 100px', '100px 0'],
		'140-100'           => ['OverCome Space 06', 'Top 140px - Bottom 100px', '140px 0'],
	];
}

/**
 * Add your theme Gutter
*/
add_filter('ef5systems_gutters','overcome_gutters');
function overcome_gutters(){
	return [
		'20' => [
			'title' => 'OverCome Gutter 20', 
			'desc'  => '',
			'key'   => '20',
			'value' => '20px'
		]
	];
}

/**
 * Add your theme Color
*/
add_filter('ef5systems_colors','overcome_colors');
function overcome_colors(){
	return [
		'inherit' => ['Inherit', 'inherit'],
		'white'   => ['White', '#fff'],
		'overlay' => ['Overlay Background', 'rgba(0,0,0,0.5)'],
		'overlay-03' => ['Overlay Background 03', 'rgba(0,0,0,0.3)'],
		'ababab'  => ['OverCome Color 01', '#ababab'],
		'eee8d9'  => ['OverCome Color 02', '#eee8d9'],
		'f5f5f5'  => ['OverCome Color 03', '#f5f5f5'],
		'f7f7f8'  => ['OverCome Color 04', '#f7f7f8'],
		'787878'  => ['OverCome Color 05', '#787878'],
		'cecece'  => ['OverCome Color 06', '#cecece'],
		'353353'  => ['OverCome Color 07', '#353353'],
		'777777'  => ['OverCome Color 08', '#777777'],
		'7c7c80'  => ['OverCome Color 09', '#7c7c80'],
		'909097'  => ['OverCome Color 10', '#909097']
	];
}
/**
 * Add your theme font size
*/
add_filter('ef5systems_font_sizes', 'overcome_font_sizes');
function overcome_font_sizes(){
	return [
		'86' => ['86px','86px']
	];
}
/**
 * Custom OWL Nav Style
*/
add_filter('ef5systems_carousel_custom_nav_style', 'overcome_owl_custom_nav_style');
function overcome_owl_custom_nav_style(){
	return [
		esc_html__('Overcome Style 01','overcome') => 'overcome-1'
	];
}
/**
 * Custom OWL Dots Style
*/
add_filter('ef5systems_carousel_custom_dots_style', 'overcome_owl_custom_dots_style');
function overcome_owl_custom_dots_style(){
	return [
		esc_html__('Circle (11px)','overcome') => 'circle size-11'
	];
}
add_filter('ef5systems_carousel_custom_dot_color', 'overcome_owl_custom_dot_color');
function overcome_owl_custom_dot_color(){
	return [
		esc_html__('White - Primary','overcome') => 'white-primary',
		esc_html__('White - Blue (#5580ff)','overcome') => 'white-blue-5580ff'
	];
}
