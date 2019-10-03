<?php
var_dump(ef5systems_icon_libs()); die('xxxx1');
vc_map(array(
    'name'        => 'OverCome Socials',
    'base'        => 'ef5_socials',
    'icon'        => '',
    'category'    => esc_html__('OverCome', 'overcome'),
    'description' => esc_html__('Add text with icon', 'overcome'),
    'params'      => array_merge(
        array(
            array(
                'type'       => 'dropdown',
                'param_name' => 'source',
                'heading'    => esc_html__( 'Source', 'overcome' ),
                'value'      => array(
                    esc_html__( 'Custom', 'overcome' ) => 'custom',
                ),
                'std' => 'custom',
                'description' => esc_html__( 'Choose what social source display.', 'overcome' ),
                'admin_label' => true,
            ),
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
                'type'       => 'textfield',
                'param_name' => 'el_title',
                'heading'    => esc_html__( 'Element Title', 'overcome' ),
                'value'      => '',
                'description' => esc_html__( 'Enter element title', 'overcome' ),
                'admin_label' => true,
            )
        ),
        ef5systems_icon_libs([
            'group' => '',
            'field_prefix' => 'title_icon_'
        ]),
        ef5systems_icon_libs_icon([
            'group' => '',
            'field_prefix' => 'title_icon_'
        ]),
        array(
            array(
                'type'       => 'dropdown',
                'param_name' => 'el_icon_hint_pos',
                'heading'    => esc_html__( 'Hint Label Position', 'overcome' ),
                'value'      => array(
                    esc_html__( 'Top', 'overcome' )    => 'top',
                    esc_html__( 'Bottom', 'overcome' ) => 'bottom',
                ),
                'std' => 'top',
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'el_content_align',
                'heading'    => esc_html__( 'Content Align', 'overcome' ),
                'value'      => ef5systems_alignment_option_for_vc(),
                'std'        => '',
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add your icons', 'overcome' ),
                'param_name' => 'values',
                'group'      => esc_html__('Items','overcome'),
                'dependency' => array(
                    'element' => 'source',
                    'value'   => 'custom',
                ),
                'value' => urlencode( json_encode( array(
                    array(
                        'i_type'             => 'fontawesome',
                        'i_icon_fontawesome' => 'fa fa-facebook',
                        'icon_link'          => 'title:Facebook||url:facebook.com'
                    ),
                    array(
                        'i_type'             => 'fontawesome',
                        'i_icon_fontawesome' => 'fa fa-twitter',
                        'icon_link'          => 'title:Twitter||url:twitter.com'
                    ),
                    array(
                        'i_type'             => 'fontawesome',
                        'i_icon_fontawesome' => 'fa fa-pinterest',
                        'icon_link'          => 'title:Pinterest||url:pinterest.com'
                    ),
                    array(
                        'i_type'             => 'fontawesome',
                        'i_icon_fontawesome' => 'fa fa-linkedin',
                        'icon_link'          => 'title:LinkedIn||url:linkedin.com'
                    ),
                ) ) ),
                'params' => array_merge(
                    ef5systems_icon_libs(),
                    ef5systems_icon_libs_icon(),
                    array(
                        array(
                            'type'       => 'vc_link',
                            'heading'    => esc_html__( 'Icon Link', 'overcome' ),
                            'param_name' => 'icon_link',
                            'admin_label'=> true,
                        ),
                    )
                ),
            )
        )
    )
));

class WPBakeryShortCode_ef5_socials extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}