<?php 
add_action('vc_after_init', 'overcome_vc_tta_accordion_params');
function overcome_vc_tta_accordion_params() {   
	// Shape
    $param = WPBMap::getParam('vc_tta_accordion', 'shape');
    $param['value'][esc_html__('OverCome','overcome')] = 'overcome';
    $param['std'] = 'overcome';
    vc_update_shortcode_param('vc_tta_accordion', $param);
    // Style 
    $param = WPBMap::getParam('vc_tta_accordion', 'style');
    $param['value'][esc_html__('OverCome','overcome')] = 'overcome';
    $param['std'] = 'overcome';
    vc_update_shortcode_param('vc_tta_accordion', $param);
    // Style 
    $param = WPBMap::getParam('vc_tta_accordion', 'color');
    $param['value'][esc_html__('OverCome','overcome')] = 'overcome';
    $param['std'] = 'overcome';
    vc_update_shortcode_param('vc_tta_accordion', $param);
    // Gap 
    $param = WPBMap::getParam('vc_tta_accordion', 'gap');
    $param['value'][esc_html__('OverCome','overcome')] = 'overcome';
    $param['std'] = 'overcome';
    vc_update_shortcode_param('vc_tta_accordion', $param);
    // Alignments  
    $param = WPBMap::getParam('vc_tta_accordion', 'c_align');
    $param['value'][esc_html__('OverCome','overcome')] = 'overcome';
    $param['std'] = 'overcome';
    vc_update_shortcode_param('vc_tta_accordion', $param);
    // Icon  
    $param = WPBMap::getParam('vc_tta_accordion', 'c_icon');
    $param['value'][esc_html__('OverCome','overcome')] = 'overcome';
    $param['std'] = 'overcome';
    vc_update_shortcode_param('vc_tta_accordion', $param);
}