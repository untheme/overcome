<?php
vc_map(
	array(
		'name'        => esc_html__('OverCome Counter', 'overcome'),
		'base'        => 'ef5_counter',
		'icon'        => 'vc-icon-counter',
		'category'    => esc_html__('OverCome', 'overcome'),
		'description' => esc_html__('Add counter', 'overcome'),
		'params'   => array_merge(
			array(
				array(
		            'type'       => 'img',
		            'heading'    => esc_html__('Layout Template','overcome'),
		            'param_name' => 'layout_template',
		            'value'      =>  array(
		                '1' => get_template_directory_uri().'/vc_elements/layouts/counter-1.png',
		            ),
		            'std'        => '1',
		            'admin_label' => true
		        ),
		        array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Color Mode','overcome'),
					'param_name' => 'color_mode',
					'value'      => array(					
						esc_html__('Default','overcome')  => '',
						esc_html__('Gradient','overcome') => 'gradient',
					),
		            'std'		 => '',
		            'admin_label' => true,
		        ),
		        overcome_vc_content_align_opts(),
		        array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Counter Type','overcome'),
					'param_name' => 'counter_type',
					'value'      => array(
						esc_html__('Count Up','overcome')   => 'countup',
		            ),
		            'std'		 => 'countup',
		            
		        ),
		        array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Counter Size','overcome'),
					'param_name' => 'counter_size',
					'value'      => array(
						esc_html__('Default','overcome')     => 'default',
					),
		            'std'		 => 'default',
		            'admin_label' => true,
		            
		        ),
		        array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Select Number Cols','overcome'),
					'param_name' => 'counter_column',
					'value'      => array('1','2','3','4','5','6'),
		            'std'		 => 1,
		            'admin_label' => true,
		            
		        ),
		        
		        array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Element Class','overcome'),
					'param_name'  => 'el_class',
					'value'       => '',
					
		        ),
		        array(
					'type'       => 'el_id',
					'heading'    => esc_html__('Element ID','overcome'),
					'param_name' => 'el_id',
					'settings' => array(
						'auto_generate' => true,
					),
					'description'	=> sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'overcome' ), '//w3schools.com/tags/att_global_id.asp' ),
				),
		    ),
		    /* Counter 1 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','overcome'),
					'param_name' => 'title1',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('1','2','3','4','5','6')
		            ),
					'value'       => '',
					'holder'	  => 'h3',	
					'group'       => esc_html__('Counter 1', 'overcome')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','overcome'),
					'param_name' => 'desc1',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('1','2','3','4','5','6')
		            ),
					'value'       => '',
					'holder'	  => 'div',
					'group'       => esc_html__('Counter 1', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','overcome'),
					'param_name' => 'digit1',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'counter_column',
						'value'	  =>array('1','2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 1', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','overcome'),
					'param_name' => 'prefix1',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('1','2','3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 1', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','overcome'),
					'param_name' => 'suffix1',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('1','2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 1', 'overcome')
		        ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Custom Digit Color','overcome'),
					'param_name' => 'digit1_color',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('1','2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 1', 'overcome')
		        ), 
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon1',
	                'heading'       => esc_html__( 'Add Icon?', 'overcome' ),
	                'std'           => 'false',
	                'group'         => esc_html__('Counter 1','overcome')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','overcome'),
					'param_name' => 'icon1_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon1',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 1', 'overcome')
		        ), 
		    ),
		    overcome_icon_libs(array('group'=>esc_html__('Counter 1','overcome'),'field_prefix'=>'i1_', 'dependency'=>'add_icon1')),
			overcome_icon_libs_icon(array('group'=>esc_html__('Counter 1','overcome'),'field_prefix'=>'i1_')),
			/* Counter 2 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','overcome'),
					'param_name' => 'title2',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('2','3','4','5','6')
		            ),
					'value'       => '',
					'holder'	  => 'h3',	
					'group'       => esc_html__('Counter 2', 'overcome')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','overcome'),
					'param_name' => 'desc2',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('2','3','4','5','6')
		            ),
					'value'       => '',
					'holder'	  => 'div',	
					'group'       => esc_html__('Counter 2', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','overcome'),
					'param_name' => 'digit2',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'counter_column',
						'value'	  =>array('2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 2', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','overcome'),
					'param_name' => 'prefix2',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('2','3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 2', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','overcome'),
					'param_name' => 'suffix2',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 2', 'overcome')
		        ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Custom Digit Color','overcome'),
					'param_name' => 'digit2_color',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('2','3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 2', 'overcome')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon2',
	                'heading'       => esc_html__( 'Add Icon?', 'overcome' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' => 'counter_column',
						'value'	  =>array('2','3','4','5','6')
		            ),
	                'group'         => esc_html__('Counter 2','overcome')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','overcome'),
					'param_name' => 'icon2_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon2',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 2', 'overcome')
		        ), 
		    ),
		    overcome_icon_libs(array('group'=>esc_html__('Counter 2','overcome'),'field_prefix'=>'i2_', 'dependency'=>'add_icon2')),
			overcome_icon_libs_icon(array('group'=>esc_html__('Counter 2','overcome'),'field_prefix'=>'i2_')),
			/* Counter 3 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','overcome'),
					'param_name' => 'title3',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('3','4','5','6')
		            ),
					'value'       => '',
					'holder'	  => 'h3',	
					'group'       => esc_html__('Counter 3', 'overcome')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','overcome'),
					'param_name' => 'desc3',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('3','4','5','6')
		            ),
					'value'       => '',
					'holder'	  => 'div',	
					'group'       => esc_html__('Counter 3', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','overcome'),
					'param_name' => 'digit3',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'counter_column',
						'value'	  =>array('3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 3', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','overcome'),
					'param_name' => 'prefix3',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('3','4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 3', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','overcome'),
					'param_name' => 'suffix3',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 3', 'overcome')
		        ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Custom Digit Color','overcome'),
					'param_name' => 'digit3_color',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('3','4','5','6')
		            ),
					'group'      => esc_html__('Counter 3', 'overcome')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon3',
	                'heading'       => esc_html__( 'Add Icon?', 'overcome' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('3','4','5','6')
		            ),
	                'group'         => esc_html__('Counter 3','overcome')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','overcome'),
					'param_name' => 'icon3_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon3',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 3', 'overcome')
		        ), 
		    ),
		    overcome_icon_libs(array('group'=>esc_html__('Counter 3','overcome'),'field_prefix'=>'i3_', 'dependency'=>'add_icon3')),
			overcome_icon_libs_icon(array('group'=>esc_html__('Counter 3','overcome'),'field_prefix'=>'i3_')),
			/* Counter 4 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','overcome'),
					'param_name' => 'title4',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('4','5','6')
		            ),
					'value'       => '',
					'holder'	  => 'h3',
					'group'       => esc_html__('Counter 4', 'overcome')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','overcome'),
					'param_name' => 'desc4',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('4','5','6')
		            ),
					'value'       => '',
					'holder'	  => 'div',
					'group'       => esc_html__('Counter 4', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','overcome'),
					'param_name' => 'digit4',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'counter_column',
						'value'	  =>array('4','5','6')
		            ),
					'group'      => esc_html__('Counter 4', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','overcome'),
					'param_name' => 'prefix4',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('4','5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 4', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','overcome'),
					'param_name' => 'suffix4',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('4','5','6')
		            ),
					'group'      => esc_html__('Counter 4', 'overcome')
		        ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Custom Digit Color','overcome'),
					'param_name' => 'digit4_color',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('4','5','6')
		            ),
					'group'      => esc_html__('Counter 4', 'overcome')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon4',
	                'heading'       => esc_html__( 'Add Icon?', 'overcome' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('4','5','6')
		            ),
	                'group'         => esc_html__('Counter 4','overcome')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','overcome'),
					'param_name' => 'icon4_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon4',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 4', 'overcome')
		        ), 
		    ),
		    overcome_icon_libs(array('group'=>esc_html__('Counter 4','overcome'),'field_prefix'=>'i4_', 'dependency'=>'add_icon4')),
			overcome_icon_libs_icon(array('group'=>esc_html__('Counter 4','overcome'),'field_prefix'=>'i4_')),
			/* Counter 5 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','overcome'),
					'param_name' => 'title5',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('5','6')
		            ),
					'value'       => '',
					'holder'	  => 'h3',
					'group'       => esc_html__('Counter 5', 'overcome')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','overcome'),
					'param_name' => 'desc5',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('5','6')
		            ),
					'value'       => '',
					'holder'	  => 'div',
					'group'       => esc_html__('Counter 5', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','overcome'),
					'param_name' => 'digit5',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'counter_column',
						'value'	  =>array('5','6')
		            ),
					'group'      => esc_html__('Counter 5', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','overcome'),
					'param_name' => 'prefix5',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('5','6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 5', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','overcome'),
					'param_name' => 'suffix5',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('5','6')
		            ),
					'group'      => esc_html__('Counter 5', 'overcome')
		        ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Custom Digit Color','overcome'),
					'param_name' => 'digit5_color',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('5','6')
		            ),
					'group'      => esc_html__('Counter 5', 'overcome')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon5',
	                'heading'       => esc_html__( 'Add Icon?', 'overcome' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('5','6')
		            ),
	                'group'         => esc_html__('Counter 5','overcome')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','overcome'),
					'param_name' => 'icon5_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon5',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 5', 'overcome')
		        ), 
		    ),
		    overcome_icon_libs(array('group'=>esc_html__('Counter 5','overcome'),'field_prefix'=>'i5_', 'dependency'=>'add_icon5')),
			overcome_icon_libs_icon(array('group'=>esc_html__('Counter 5','overcome'),'field_prefix'=>'i5_')),
			/* Counter 6 */
		    array(
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title','overcome'),
					'param_name' => 'title6',
					'dependency' => array(
		            	'element'=>'counter_column',
		            	'value'	 =>array('6')
		            ),
					'value'       => '',
					'holder'	  => 'h3',
					'group'       => esc_html__('Counter 6', 'overcome')
		        ),
		        array(
					'type'       => 'textarea',
					'heading'    => esc_html__('Description','overcome'),
					'param_name' => 'desc6',
					'dependency' => array(
		            	'element'=> 'counter_column',
		            	'value'	 => array('6')
		            ),
					'value'       => '',
					'holder'	  => 'div',
					'group'       => esc_html__('Counter 6', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Digit','overcome'),
					'param_name' => 'digit6',
					'value'      => '',
					'edit_field_class' => 'vc_col-sm-4',
		            'dependency' => array(
						'element' => 'counter_column',
						'value'	  =>array('6')
		            ),
					'group'      => esc_html__('Counter 6', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Prefix','overcome'),
					'param_name' => 'prefix6',
					'edit_field_class' => 'vc_col-sm-4',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('6')
		            ),
					'value'       => '',
					'group'       => esc_html__('Counter 6', 'overcome')
		        ),
		        array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Suffix','overcome'),
					'param_name' => 'suffix6',
					'edit_field_class' => 'vc_col-sm-4',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('6')
		            ),
					'group'      => esc_html__('Counter 6', 'overcome')
		        ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Custom Digit Color','overcome'),
					'param_name' => 'digit6_color',
					'value'      => '',
					'dependency' => array(
						'element' =>'counter_column',
						'value'	  =>array('6')
		            ),
					'group'      => esc_html__('Counter 6', 'overcome')
		        ),
		        array(
	                'type'          => 'checkbox',
	                'param_name'    => 'add_icon6',
	                'heading'       => esc_html__( 'Add Icon?', 'overcome' ),
	                'std'           => 'false',
	                'dependency' => array(
						'element' => 'counter_column',
						'value'	  =>array('6')
		            ),
	                'group'         => esc_html__('Counter 6','overcome')
	            ),
		        array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Icon Color','overcome'),
					'param_name' => 'icon6_color',
					'value'      => '',
		            'dependency' => array(
						'element' => 'add_icon6',
						'value'	  => 'true'
		            ),
					'group'      => esc_html__('Counter 6', 'overcome')
		        ), 
		    ),
		    overcome_icon_libs(array('group'=>esc_html__('Counter 6','overcome'),'field_prefix'=>'i6_', 'dependency'=>'add_icon6')),
			overcome_icon_libs_icon(array('group'=>esc_html__('Counter 6','overcome'),'field_prefix'=>'i6_'))
	    )
	)
);
class WPBakeryShortCode_ef5_counter extends WPBakeryShortCode{
	protected function content($atts, $content = null){
        wp_enqueue_script( 'waypoints' );
        wp_enqueue_script( 'counterup' );
		return parent::content($atts, $content);
	}
}