<?php
vc_map(array(
    'name'        => 'OverCome Clients',
    'base'        => 'ef5_clients',
    'category'    => esc_html__('OverCome', 'overcome'),
    'description' => esc_html__('Add clients image with custom link', 'overcome'),
    'icon'        => '',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'         => get_template_directory_uri().'/vc_extends/layouts/client-logo1.png',
                ),
                'std'        => '1',
                'admin_label' => true
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Hover Style','overcome'),
                'param_name' => 'hover_style',
                'value'      =>  array(
                    esc_html__('Grow Up','overcome')    => 'grow-up',
                    esc_html__('Slide Up','overcome')   => 'slide-up',
                    esc_html__('Slide Down','overcome') => 'slide-down',
                    esc_html__('Fade in','overcome')    => 'fade-in',
                ),
                'std'        => 'grow-up',
            ),
            array(
                'type'        => 'el_id',
                'settings' => array(
                    'auto_generate' => true,
                ),
                'heading'     => esc_html__( 'Element ID', 'overcome' ),
                'param_name'  => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'overcome' ), '//w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','overcome'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'overcome'),
            ),
            /* Clients Settings */
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Client image size','overcome'),
                'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','overcome'),
                'param_name'    => 'thumbnail_size',
                'value'         => '210',
                'std'           => '210',
                'group'         => esc_html__('Clients','overcome'),
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add Clients', 'overcome' ),
                'param_name' => 'values',
                'value'      =>  urlencode( json_encode( array(
                    array(
                        'image_link' => 'title:Client 1||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 2||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 3||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 4||url:#||target="_blank"',
                    )
                ))),
                'params'     => array(
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__( 'Client Image', 'overcome' ),
                        'param_name'  => 'image',
                        'admin_label' => true,
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__( 'Client Image on Hover', 'overcome' ),
                        'param_name'  => 'image_hover',
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
                        'type'        => 'vc_link',
                        'heading'     => esc_html__( 'Link', 'overcome' ),
                        'param_name'  => 'image_link',
                        'description' => esc_html__( 'Enter link for image.', 'overcome' ),
                    ),
                ),
                'group'     => 'Clients'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Style','overcome'),
                'param_name' => 'layout_mode',
                'value'      =>  array(
                    esc_html__('Grid','overcome')     => 'grid',
                    esc_html__('Carousel','overcome') => 'carousel'
                ),
                'std'        => 'grid',
                'group'      => esc_html__('Layout Settings','overcome'),
            )
        ),
        /* Grid settings */
        ef5systems_grid_settings(array(
            'group'              => esc_html__('Layout Settings','overcome'), 
            'dependency_element' => 'layout_mode', 
            'dependency_value'   => 'grid'
            )
        ),
        /* Carousel Settings */
        ef5systems_owl_settings(array(
            'group'      => esc_html__('Layout Settings','overcome'), 
            'param_name' => 'layout_mode', 
            'value'      => 'carousel'
            )
        )
    )
));

class WPBakeryShortCode_ef5_clients extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
}