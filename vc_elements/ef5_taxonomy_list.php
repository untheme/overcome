<?php
vc_map(array(
    'name'          => 'OverCome Taxonomy List',
    'base'          => 'ef5_taxonomy_list',
    'category'      => esc_html__('OverCome', 'overcome'),
    'description'   => esc_html__('Display taxonomy list', 'overcome'),
    'icon'         => 'icon-wpb-application-icon-large',
    'params'        => array_merge(
        array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Element Title', 'overcome' ),
                'description' => esc_html__( 'Enter the text you want to show as title', 'overcome' ),
                'param_name'  => 'el_title',
                'value'       => '',
                'std'         => '',
                'admin_label' => true,
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Taxonomy', 'overcome' ),
                'param_name'  => 'taxonomy',
                'value'       => ef5systems_vc_taxonomy_list(),
                'std'         => 'category',
                'description' => esc_html__( 'Select taxonomy', 'overcome' ),
                'admin_label' => true,
            ),
        )
    )
));
class WPBakeryShortCode_ef5_taxonomy_list extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
    protected function overcome_taxonomy_list($atts, $args=[]){
    	$args = wp_parse_args($args, [
    		'class' => ''
    	]);
    	extract($atts);
    	wp_list_categories([
    		'taxonomy' => $taxonomy,
    		'title_li' => '',
    		'style'		=> 'none'	
    	]);
    }
}