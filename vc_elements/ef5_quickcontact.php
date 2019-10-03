<?php
vc_map(array(
    'name'        => 'OverCome Quick Contact',
    'base'        => 'ef5_quickcontact',
    'category'    => esc_html__('OverCome', 'unbreak'),
    'description' => esc_html__('Add your quick contact info', 'unbreak'),
    'icon'        => 'icon-wpb-wp',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','unbreak'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/qc-1.png',
                ),
                'std'        => '1',
                'admin_label' => true,
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Text Color','unbreak'),
                'param_name'    => 'content_color',
                'value'         => ef5systems_colors_option_for_vc(),
                'std'           => '',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Icon Color','unbreak'),
                'param_name'    => 'icon_color',
                'value'         => ef5systems_colors_option_for_vc(),
                'std'           => '',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Horizontal alignment','unbreak'),
                'param_name'    => 'content_align',
                'value'         => ef5systems_alignment_option_for_vc(),
                'std'           => '',
                'dependency'    => array(
                    'element' => 'layout_template',
                    'value'   => array('1')
                )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','unbreak'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'unbreak'),
            ),
            array(
                'type'        => 'el_id',
                'settings' => array(
                    'auto_generate' => true,
                ),
                'heading'     => esc_html__( 'Element ID', 'unbreak' ),
                'param_name'  => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'unbreak' ), '//w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Title','unbreak'),
                'param_name' => 'el_title',
                'value'      => '',
                'dependency' => array(
                    'element' => 'layout_template',
                    'value'   => array('2')
                ),
                'group'     => 'Contact Info',
                'holder'    => 'h3'    
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Add your Image','unbreak'),
                'param_name' => 'img_id',
                'value'      => '',
                'dependency' => array(
                    'element' => 'layout_template',
                    'value'   => array('2')
                ),
                'group'     => 'Contact Info'
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Images size','unbreak'),
                'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large","post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave blank to use default','unbreak'),
                'param_name'    => 'img_size',
                'value'         => '',
                'std'           => '',
                'dependency' => array(
                    'element'   => 'img_id',
                    'not_empty' => true
                ),
                'group'         => esc_html__('Contact Info','unbreak'),
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add your info', 'unbreak' ),
                'param_name' => 'values',
                'value' => urlencode( json_encode( array(
                    array(
                        'i_type'             => 'overcome',
                        'i_icon_fontawesome' => 'flaticon-call-answer',
                        'qc_heading'         => 'Call Us:',
                        'qc_text'            => '(+123) 888 666',
                    )
                ) ) ),
                'params'     => array_merge(
                    ef5systems_icon_libs(),
                    ef5systems_icon_libs_icon(),
                    array(
                        array(
                            'type'        => 'textarea',
                            'heading'     => esc_html__( 'Heading', 'unbreak' ),
                            'param_name'  => 'qc_heading',
                            'admin_label' => true,
                        ),
                        array(
                            'type'        => 'textarea',
                            'heading'     => esc_html__( 'Text', 'unbreak' ),
                            'param_name'  => 'qc_text',
                            'admin_label' => true,
                        ),
                    )
                ),
                'group'     => 'Contact Info'
            ),
            array(
                'type'        => 'vc_link',
                'param_name'  => 'get_direction',
                'heading'     => esc_html__('Direction with Map','unbreak'),
                'description' => esc_html__('Add your map','unbreak'),
                'value'       => 'title:Get Direction||url:google.com/maps/dir//Bobst+Library,+70+Washington+Square+S,+New+York,+NY+10012,+USA/@40.7291313,-73.9972548,18.22z/data=!4m8!4m7!1m0!1m5!1m1!1s0x89c2599051e43f09:0x73708ab233ccf977!2m2!1d-73.9971753!2d40.7294556||target:_blank',
                'dependency' => array(
                    'element' => 'layout_template',
                    'value'   => array('2')
                ),
                'group'       => esc_html__('Maps','unbreak')
            )
        )
    )
));

class WPBakeryShortCode_ef5_quickcontact extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );
        return parent::content($atts, $content);
    }
}