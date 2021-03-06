<?php
if(!class_exists('EF5Payments')) return;
vc_map(array(
    'name'          => 'OverCome Donate Button',
    'base'          => 'ef5_donate_btn',
    'category'      => esc_html__('OverCome', 'overcome'),
    'description'   => esc_html__('Add a donate button', 'overcome'),
    'icon'         => 'icon-wpb-ui-button',
    'params'        => array_merge(
        array(
            array(
                'type'          => 'textfield',
                'param_name'    => 'btn_text',
                'heading'       => esc_html__( 'Button Text', 'overcome' ),
                'value'         => 'Donate Now',
                'std'           => 'Donate Now',
                'admin_label'   => true
            ),
            array(
                'type'          => 'vc_link',
                'heading'       => esc_html__('Button link','overcome'),
                'param_name'    => 'button_link',
                'value'         => '',
            ),
            array(
            	'type'			=> 'dropdown',
            	'heading'		=> esc_html__('Select an post type','overcome'),
            	'param_name'	=> 'post_type',
            	'value'			=> array(
            		esc_html__('Donation','overcome') => 'donation'
            	)
            ),
            array(
            	'type'			=> 'dropdown',
            	'heading'		=> esc_html__('Select a post','overcome'),
            	'param_name'	=> 'donation_item',
            	'value'			=> ef5systems_options_list_post_for_vc('ef5_donation'),
            	'description'	=> esc_html__('Leave blank to use the first donation','overcome')
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_display',
                'heading'       => esc_html__( 'Button Display', 'overcome' ),
                'value'         => array(
                    esc_html__( 'List', 'overcome' )  => 'list', 
                    esc_html__( 'Block', 'overcome' ) => 'block', 
                ),
                'std'           => 'block',
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_align',
                'heading'       => esc_html__( 'Button Alignment', 'overcome' ),
                'value'         => array(
                    esc_html__( 'Default', 'overcome' ) => '',
                    esc_html__( 'Start', 'overcome' )   => 'start', 
                    esc_html__( 'End', 'overcome' )     => 'end',
                    esc_html__( 'Center', 'overcome' )  => 'center',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'btn_display',
                    'value'     => 'block',
                ),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_style',
                'heading'       => esc_html__( 'Button Style', 'overcome' ),
                'value'         => array(
                    esc_html__('Fill', 'overcome')    => 'fill',
                    esc_html__('Outline', 'overcome') => 'ouline',
                ),
                'std'           => 'fill',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_color',
                'heading'       => esc_html__( 'Button Color', 'overcome' ),
                'value'         => ef5systems_colors_option_for_vc([
                    esc_html__('Custom','overcome') => 'custom'
                ]),
                'std'           => '',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'colorpicker',
                'param_name'    => 'btn_custom_bg_color',
                'heading'       => esc_html__( 'Custom Background/Border Color', 'overcome' ),
                'value'         => '',
                'std'           => '',
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'btn_color',
                    'value'     => 'custom',
                ),
            ),
            array(
                'type'          => 'colorpicker',
                'param_name'    => 'btn_custom_text_color',
                'heading'       => esc_html__( 'Text Color', 'overcome' ),
                'value'         => '',
                'std'           => '',
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'btn_color',
                    'value'     => 'custom',
                ),
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_shape',
                'heading'       => esc_html__( 'Button Shape', 'overcome' ),
                'value'         => array(
                    esc_html__('Default','overcome') => '',
                    esc_html__('Square','overcome')  => 'square'
                ),
                'std'              => '',
                'admin_label'      => true,
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element'            => 'btn_style',
                    'value_not_equal_to' => 'simple',
                ),
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_size',
                'heading'       => esc_html__( 'Button Size', 'overcome' ),
                'value'         => array(
                    esc_html__('Default','overcome')     => '',
                    esc_html__('Tiny','overcome')        => 'tn',
                    esc_html__('Small','overcome')       => 'sm',
                    esc_html__('Medium','overcome')      => 'md',
                    esc_html__('Large','overcome')       => 'lg',
                    esc_html__('Extra Large','overcome') => 'xlg',
                ),
                'std'           => '',
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_underline',
                'heading'       => esc_html__( 'Add Underline', 'overcome' ),
                'value'         => array(
                    esc_html__( 'None', 'overcome' )      => '',
                    esc_html__( 'Default', 'overcome' )   => 'underline-default',
                    esc_html__( 'Primary', 'overcome' )   => 'underline-primary',
                    esc_html__( 'Accent', 'overcome' )    => 'underline-accent',
                    esc_html__( 'Secondary', 'overcome' ) => 'underline-secondary',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'btn_style',
                    'value'     => 'simple',
                ),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_hover_style',
                'heading'       => esc_html__( 'Hover Style', 'overcome' ),
                'value'         => array(
                    esc_html__('Default', 'overcome') => '',
                ),
                'std'              => '',
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element'            => 'btn_style',
                    'value_not_equal_to' => 'simple',
                ),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'add_icon',
                'heading'       => esc_html__( 'Add Icon?', 'overcome' ),
                'std'           => false,
                'group'         => esc_html__('Icon','overcome')
            ),
        ),
        ef5systems_icon_libs(),
        ef5systems_icon_libs_icon(),
        array(
            array(
                'type'          => 'dropdown',
                'param_name'    => 'icon_position',
                'heading'       => esc_html__( 'Icon Position', 'overcome' ),
                'value'         => array(
                    esc_html__( 'Left', 'overcome' )     => 'icon-left',
                    esc_html__( 'Right', 'overcome' )    => 'icon-right',
                ),
                'std'           => 'icon-right',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','overcome'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_style',
                'heading'       => esc_html__( 'Icon Style', 'overcome' ),
                'value'         => array(
                    esc_html__( 'Default', 'overcome' ) => '',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','overcome'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_color',
                'heading'       => esc_html__( 'Icon Color', 'overcome' ),
                'value'         => array(
                    esc_html__( 'Default', 'overcome' )   => '',
                    esc_html__( 'Primary', 'overcome' )   => 'primary',
                    esc_html__( 'Accent', 'overcome' )    => 'accent',
                    esc_html__( 'Secondary', 'overcome' ) => 'secondary',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','overcome'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_animation',
                'heading'       => esc_html__( 'Icon Animation', 'overcome' ),
                'value'         => array(
                    esc_html__( 'None', 'overcome' )        => '',
                    esc_html__( 'Default', 'overcome' )     => 'anim-default'
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','overcome'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
        )
    )
));

class WPBakeryShortCode_ef5_donate_btn extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
    	wp_enqueue_script('bootstrap');
        return parent::content($atts, $content);
    }
    protected function overcome_donate_btn_link($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $post_id = ef5payments_default_donation(overcome_get_id_by_slug($atts['donation_item'],'ef5_donation'));
	    $data = apply_filters('ef5payments_get_payment_form_data',[
	        'class'        => 'ef5-btn-donate',
	        'data-options' => '',
	        'data-target'  => '',
	        'title'	 	   => $atts['btn_text'],	
	        'url'		   => '#',
	        'target'	   => '_self'	
	    ],$post_id);

        $btn_attributes = $btn_custom_styles = [];
        /* Button Class */
        $btn_classes = [$data['class']];
        $btn_classes[] = ($btn_style === 'simple') ? 'ef5-btn-link' : 'ef5-btn';
        if(!empty($btn_size)) $btn_classes[] =  'ef5-btn-'.$btn_size;
        if(!empty($btn_style)) $btn_classes[] = $btn_style;
        if(!empty($btn_shape)) $btn_classes[] = $btn_shape;
        $btn_classes[] = ($btn_style === 'simple') ? 'ef5-text-'.$btn_color : $btn_color;
        $btn_classes[] = 'transition ef5-scroll';
        $btn_classes[] = $args['class'];
        $btn_attributes[] = 'class="'.str_replace('  ', ' ',trim(implode(' ', $btn_classes))).'"';
        // For donate
        $btn_attributes[] = 'data-options="'.esc_attr($data['data-options']).'"';
	    $btn_attributes[] = 'data-target="'.esc_attr($data['data-target']).'"';
	    $btn_attributes[] = 'target="'.esc_attr($data['target']).'"'; 
	    $btn_attributes[] = 'href="'.esc_attr($data['url']).'"';
        // Button link
        $button_link = vc_build_link( $button_link);
        $button_link = ( $button_link == '||' ) ? '' : $button_link;
        //$btn_attributes[] = !empty($button_link['url']) ? 'href="'.esc_url($button_link['url']).'"' : '';

        // Button Text
        $btn_text = !empty($button_link['title']) ? esc_attr($button_link['title']) : esc_attr($btn_text);
        $btn_attributes[] = 'data-title="'.(!empty($button_link['title']) ? esc_attr($button_link['title']) : esc_attr($btn_text)).'"';
        // Button target
        //$btn_attributes[] = strlen( $button_link['target'] ) > 0 ? 'target="'.$button_link['target'].'"' : '';
        // Button Custom Css Style
        if($btn_color === 'custom'){
            if(!empty($btn_custom_bg_color)) {
                if($btn_style === 'outline')
                    $btn_custom_styles[] = 'border-color:'.$btn_custom_bg_color;
                elseif($btn_style === 'fill') 
                    $btn_custom_styles[] = 'background-color:'.$btn_custom_bg_color;
            }
            if(!empty($btn_custom_text_color)) $btn_custom_styles[] = 'color:'.$btn_custom_text_color;
        }
        if(!empty($btn_custom_styles)){
            $btn_attributes[] = 'style="'.implode(';', $btn_custom_styles).'"';
        }
        // output
        echo implode(' ', $btn_attributes);
    }
    protected function overcome_donate_btn_icon($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        if(!$add_icon) return;
        // Button Icon
        $icon = '';
        vc_icon_element_fonts_enqueue( $i_type );
        $icon_name = 'i_icon_' . $i_type ; /* get icon class */
        $icon_default = is_rtl() ? '' : '';
        $iconClass = (isset($atts[$icon_name]) && !empty($atts[$icon_name])) ? $atts[$icon_name] : $icon_default;
        $icon_css_class = [
            'ef5-btn-icon',
            $iconClass,
            $btn_icon_style,
            $btn_icon_animation,
            $icon_position,
            !empty($btn_icon_color) ? $btn_icon_color.'-color' : ''
        ];
        if(!empty($iconClass)) {
            $icon = '<span class="'.trim(implode(' ', $icon_css_class)).'"></span>';
        }
        if(empty($icon)) return;
        echo overcome_html($icon);
    }
    function overcome_donate_btn($atts){
	    wp_enqueue_script('bootstrap');
	    $post_id = ef5payments_default_donation(overcome_get_id_by_slug($atts['donation_item'],'ef5_donation'));
	    $data = apply_filters('ef5payments_get_payment_form_data',[
	        'class'        => 'ef5-btn ef5-btn-sm accent fill',
	        'data-options' => '',
	        'data-target'  => '',
	        'title'	 	   => $atts['btn_text'],	
	        'url'		   => '#',
	        'target'	   => '_self'	
	    ],$post_id);
	    ?>
	    <span class="header-icon ef5-header-donate">
	    	<a class="<?php echo esc_attr($data['class']); ?>"
	       data-options="<?php echo esc_attr($data['data-options']) ?>"
	       data-target="<?php echo esc_attr($data['data-target']) ?>"
	       href="<?php echo esc_attr($data['url']); ?>" target="<?php echo esc_attr($data['target']); ?>" ><?php echo wp_kses_post($data['title']) ?></a>
	   </span>
	    <?php
	}
}