<?php 
add_action('vc_after_init', 'overcome_vc_row_custom_params');
function overcome_vc_row_custom_params() {   
    $param = WPBMap::getParam('vc_row', 'full_width');
    $param['value'][esc_html__('Stretch Row and Content Wide','overcome')] = 'stretch_row_content2';
    vc_update_shortcode_param('vc_row', $param);
}