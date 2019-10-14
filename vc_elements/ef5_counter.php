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
		                '2' => get_template_directory_uri().'/vc_elements/layouts/counter-2.png',
		            ),
		            'std'        => '1',
		            'admin_label' => true
		        ),
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
		    ef5systems_icon_libs(array('group'=>esc_html__('Counter 1','overcome'),'field_prefix'=>'i1_', 'dependency'=>'add_icon1')),
			ef5systems_icon_libs_icon(array('group'=>esc_html__('Counter 1','overcome'),'field_prefix'=>'i1_')),
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
		    ef5systems_icon_libs(array('group'=>esc_html__('Counter 2','overcome'),'field_prefix'=>'i2_', 'dependency'=>'add_icon2')),
			ef5systems_icon_libs_icon(array('group'=>esc_html__('Counter 2','overcome'),'field_prefix'=>'i2_')),
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
		    ef5systems_icon_libs(array('group'=>esc_html__('Counter 3','overcome'),'field_prefix'=>'i3_', 'dependency'=>'add_icon3')),
			ef5systems_icon_libs_icon(array('group'=>esc_html__('Counter 3','overcome'),'field_prefix'=>'i3_')),
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
		    ef5systems_icon_libs(array('group'=>esc_html__('Counter 4','overcome'),'field_prefix'=>'i4_', 'dependency'=>'add_icon4')),
			ef5systems_icon_libs_icon(array('group'=>esc_html__('Counter 4','overcome'),'field_prefix'=>'i4_')),
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
		    ef5systems_icon_libs(array('group'=>esc_html__('Counter 5','overcome'),'field_prefix'=>'i5_', 'dependency'=>'add_icon5')),
			ef5systems_icon_libs_icon(array('group'=>esc_html__('Counter 5','overcome'),'field_prefix'=>'i5_')),
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
		    ef5systems_icon_libs(array('group'=>esc_html__('Counter 6','overcome'),'field_prefix'=>'i6_', 'dependency'=>'add_icon6')),
			ef5systems_icon_libs_icon(array('group'=>esc_html__('Counter 6','overcome'),'field_prefix'=>'i6_'))
	    )
	)
);
class WPBakeryShortCode_ef5_counter extends WPBakeryShortCode{
	protected function content($atts, $content = null){
        wp_enqueue_script( 'waypoints' );
        wp_enqueue_script( 'counterup' );
		return parent::content($atts, $content);
	}
	protected function counter_icon($atts, $i, $args = []){
		extract($atts);
		$args = wp_parse_args($args, [
			'class' => ''
		]);
        $i_type     = isset($atts['i'.$i.'_type']) ? $atts['i'.$i.'_type'] : '';
        $add_icon   = isset($atts['add_icon'.$i]) ? $atts['add_icon'.$i] : '';
        $icon       = isset($atts['i'.$i.'_icon_'.$i_type]) ? $atts['i'.$i.'_icon_'.$i_type] : '';
        $icon_color = isset($atts['icon'.$i.'_color']) ? $atts['icon'.$i.'_color'] : '';
        /* call icon font css */
        vc_icon_element_fonts_enqueue($i_type);
            if($add_icon === 'true' && !empty($icon) ): ?>
				<span class="counter-icon"><span class="<?php echo esc_attr($icon); ?>" <?php if(!empty($icon_color)) :?>style="color:<?php echo esc_attr($icon_color);?>" <?php endif; ?>></span></span>
			<?php endif;  
    }
	protected function counter_number($atts, $i, $args = []){
		extract($atts);
		$args = wp_parse_args($args, [
			'class' => ''
		]);
		$item_class = ['counter-item'];
		$columns = (int)$counter_column;
        switch($columns){
            case '2':
                $item_class[] = 'col-md-6';
                break;
            case '3':
                $item_class[] = 'col-md-4';
                break;
            case '4':
                $item_class[] = 'col-md-6 col-lg-3';
                break;
            case '5':
                $item_class[] = 'col-md-6 col-lg-1/5';
                break;
            case '6':
                $item_class[] = 'col-md-4 col-lg-2';
                break;
            default:
                $item_class[] = 'col-12';
                break;
        }
		$suffix      = isset($atts['suffix'.$i]) ? $atts['suffix'.$i] : '';
		$prefix      = isset($atts['prefix'.$i]) ? $atts['prefix'.$i] : '';
		$digit       = isset($atts['digit'.$i]) ? $atts['digit'.$i] : '';
		$digit_color = isset($atts['digit'.$i.'_color']) ? $atts['digit'.$i.'_color'] : '';
        if(!empty($suffix) || !empty($prefix) || !empty($digit)) {
        ?>
			<div class="ef5-counter-wrap" data-prefix="<?php echo esc_attr($prefix);?>" data-suffix="<?php echo esc_attr($suffix);?>" data-type="<?php echo esc_attr($counter_type);?>" data-digit="<?php echo esc_attr($digit);?>">
                <?php if(!empty($prefix)) echo '<span class="prefix">'.esc_html($prefix).'</span>'; ?>
                <span class="ef5-counter" <?php if(!empty($digit_color)): ?> style="color:<?php echo esc_attr($digit_color);?>;"<?php endif;?>><?php echo esc_attr($digit); ?></span>
                <?php if(!empty($suffix)) echo '<span class="suffix">'.esc_html($suffix).'</span>'; ?>
			</div>
    	<?php 
    	}
    }
	protected function counter_title($atts, $i, $args = []){
		extract($atts);
		$args = wp_parse_args($args, [
			'class' => ''
		]);
        $title      = isset($atts['title'.$i]) ? $atts['title'.$i] : '';
        if(!empty($title)) {
        ?>
        	<div class="counter-title"><?php echo esc_html($title);?></div>
    	<?php 
    	}
	}
	protected function counter_desc($atts, $i, $args = []){
		extract($atts);
		$args = wp_parse_args($args, [
			'class' => ''
		]);
        $desc = isset($atts['desc'.$i]) ? $atts['desc'.$i] : '';
        if(!empty($desc)) {
        ?>
        	<div class="counter-desc"><?php echo overcome_html($desc);?></div>
    	<?php 
    	}
	}
}