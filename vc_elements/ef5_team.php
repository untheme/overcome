<?php
vc_map(array(
    'name'          => 'OverCome Team',
    'base'          => 'ef5_team',
    'icon'          => '',
    'category'      => esc_html__('OverCome', 'overcome'),
    'description'   => esc_html__('Add your team member', 'overcome'),
    'params'        => array_merge(
        array(
            /* Template Settings */
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Content Alignments','overcome'),
                'param_name'    => 'content_align',
                'value'         => array(
                    'Default'       => '',
                    'Text Left'     => 'left',
                    'Text Right'    => 'right',
                    'Text Center'   => 'center',
                ),
                'std'           => '',
            ),
            array(
                'type' => 'img',
                'heading' => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/team1.png',
                ),
                'std' => '1',
                'admin_label' => true
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
            /* Members Settings */
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Member image size','overcome'),
                'param_name'    => 'thumbnail_size',
                'value'         => overcome_thumbnail_sizes(),
                'std'           => 'custom',
                'group'         => esc_html__('Members','overcome'),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Custom member image size','overcome'),
                'description'   => esc_html__('Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','overcome'),
                'param_name'    => 'thumbnail_size_custom',
                'value'         => '',
                'std'           => '',
                'group'         => esc_html__('Members','overcome'),
                'dependency'    => array(
                    'element'   => 'thumbnail_size',
                    'value'     => 'custom',
                ),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'thumbnail_bw',
                'value'         => array(
                    esc_html__('Make Member image as Black & White','overcome') => '1'
                ),
                'std'           => '0',
                'group'         => esc_html__('Members', 'overcome')
            ),
            array(
                'type'          => 'param_group',
                'heading'       => esc_html__( 'Add Member', 'overcome' ),
                'param_name'    => 'teams',
                'std'           => urlencode( json_encode( array(
                    array(
                        'name'     => 'Roberto Antonio',
                        'position' => 'Director',
                        'link'     => 'title:Roberto Antonio||url:#',
                    ),
                    array(
                        'name'     => 'Damien Ruth',
                        'position' => 'Ceo & Architect',
                        'link'     => 'title:Damien Ruth||url:#',
                    ),
                    array(
                        'name'     => 'Ashley Fletcher',
                        'position' => 'Director',
                        'link'     => 'title:Ashley Fletcher||url:#',
                    ),
                    array(
                        'name'     => 'Marie Mercury',
                        'position' => 'Elevator',
                        'link'     => 'title:Marie Mercury||url:#',
                    ),
                    array(
                        'name'     => 'William',
                        'position' => 'Founder & CEO',
                        'desc'     => '',
                        'link'     => 'title:William||url:#',
                    ),
                    array(
                        'name'     => 'Charlotte',
                        'position' => 'Marketing',
                        'desc'     => '',
                        'link'     => 'title:Charlotte||url:#',
                    ),
                    array(
                        'name'     => 'Benjamin',
                        'position' => 'Graphic Designer',
                        'desc'     => '',
                        'link'     => 'title:Benjamin||url:#',
                    ),
                    array(
                        'name'     => 'Amelia',
                        'position' => 'Support',
                        'desc'     => '',
                        'link'     => 'title:Amelia||url:#',
                    ),
                ) ) ),
                'params'        => array(
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Image', 'overcome' ),
                        'param_name'    => 'image',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Name', 'overcome' ),
                        'param_name'    => 'name',
                        'admin_label'   => true,
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Position', 'overcome' ),
                        'param_name'    => 'position',
                    ),
                    array(
                        'type'          => 'textarea',
                        'heading'       => esc_html__( 'Description', 'overcome' ),
                        'param_name'    => 'desc',
                    ),
                    array(
                        'type'          => 'vc_link',
                        'heading'       => esc_html__( 'Member Page', 'overcome' ),
                        'param_name'    => 'link',
                        'description'   => esc_html__( 'Enter link to member details page.', 'overcome' ),
                    ),
                    array(
                        'type'          => 'param_group',
                        'heading'       => esc_html__( 'Member Social', 'overcome' ),
                        'param_name'    => 'social',
                        'std'           => urlencode( json_encode( array(
                            array(
                                'icon' => 'fa fa-facebook',
                                'link' => 'title:Facebook||url:facebook.com'
                            ),
                            array(
                                'icon' => 'fa fa-twitter',
                                'link' => 'title:Twitter||url:twitter.com'
                            ),
                            array(
                                'icon' => 'fa fa-google-plus',
                                'link' => 'title:Google Plus||url:plus.google.com'
                            ),
                            array(
                                'icon' => 'fa fa-linkedin',
                                'link' => 'title:Linkedin||url:linkedin.com'
                            ),
                        ) ) ),
                        'params'        => array(
                            array(
                                'type'          => 'iconpicker',
                                'heading'       => esc_html__( 'Social icon', 'overcome' ),
                                'param_name'    => 'icon',
                                'admin_label'   => true,
                            ),
                            array(
                                'type'          => 'vc_link',
                                'heading'       => esc_html__( 'Enter social link', 'overcome' ),
                                'param_name'    => 'link',
                            ),
                        ),
                    ),
                    
                ),
                'group'     => esc_html__('Members','overcome')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Style','overcome'),
                'param_name' => 'layout_style',
                'value'      =>  array(
                    esc_html__('Grid','overcome')     => 'grid',
                    esc_html__('Carousel','overcome') => 'carousel'
                ),
                'std'        => 'grid',
                'group'      => esc_html__('Layout Settings','overcome'),
                'admin_label' => true
            )
        ),
        /* Grid settings */
        ef5systems_grid_settings(array(
                'group'                  => esc_html__('Layout Settings','overcome'), 
                'dependency_element'     => 'layout_style', 
                'dependency_value_value' => 'grid'
            )
        ),
        /* Carousel Settings */
        ef5systems_owl_settings(array(
                'group'      => esc_html__('Layout Settings','overcome'), 
                'param_name' => 'layout_style', 
                'value'      => 'carousel'
            )
        )
    )
));

class WPBakeryShortCode_ef5_team extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
}