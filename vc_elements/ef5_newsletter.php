<?php
if(!class_exists('Newsletter')) return;
vc_map(array(
	'name'        => 'OverCome Newsletter',
	'base'        => 'ef5_newsletter',
	'icon'        => 'ef5-icon-newsletter',
	'category'    => esc_html__('OverCome', 'overcome'),
	'description' => esc_html__('Add Newsletter Form.', 'overcome'),
	'params'      => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Layout Mode', 'overcome' ),
			'description' => esc_html__( 'Choose Layout mode you want to show', 'overcome' ),
			'param_name'  => 'layout_mode',
			'value'       => array(
				esc_html__('Newsletter','overcome')      	=> 'default',
				esc_html__('Newsletter Minimal','overcome') 	=> 'minimal',
			),
			'std'		  => 'minimal',
			'admin_label' => true,
    	),
    	array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Show lists as', 'overcome' ),
			'param_name'  => 'lists_layout',
			'value'       => array(
				esc_html__('Checkbox','overcome') => '',
				esc_html__('Dropdown','overcome') => 'dropdown'
			),
			'std'		  	=> '',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'default',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'First dropdown entry label', 'overcome' ),
			'param_name'  => 'lists_empty_label',
			'value'		  => '',
			'dependency'    => array(
				'element'   => 'lists_layout',
				'value'     => 'dropdown',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Lists field label', 'overcome' ),
			'description' => esc_html__( 'Seperate by comma (,)', 'overcome' ),
			'value'		  => '',		
			'param_name'  => 'lists_field_label',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'default',
			),
    	),
    	array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Template','overcome'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_elements/layouts/newsletter1.png',
            ),
            'std'        => '1',
            'admin_label'=> true
        ),
        array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Email Text', 'overcome' ),
			'description' => esc_html__( 'Enter email text', 'overcome' ),
			'param_name'  => 'email_text',
			'value'       => 'Subscribe to newsletter',
			'std'		  => 'Subscribe to newsletter',
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Button Text', 'overcome' ),
			'description' => esc_html__( 'Enter button text', 'overcome' ),
			'param_name'  => 'btn_text',
			'value'       => 'Subscribe',
			'std'		  => 'Subscribe',
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra Class', 'overcome' ),
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'overcome' ),
			'param_name'  => 'el_class',
			'value'       => '',
			'std'		  => '',
			'admin_label' => true,
    	),
    ) 
));

class WPBakeryShortCode_ef5_newsletter extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
}