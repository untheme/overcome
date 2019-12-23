<?php
vc_map(array(
    'name'          => 'OverCome Instagram',
    'base'          => 'ef5_instagram',
    'category'    => esc_html__('OverCome', 'overcome'),
    'description' => esc_html__('Show your Instagram image', 'overcome'),
    'icon'        => 'icon-wpb-ui-icon',
    'params'      => array(
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Layout', 'overcome'),
            'param_name'    => 'layout_mode',
            'value'         => array(
                esc_html__('Default', 'overcome')       => 'default',
            ),
            'std'           => 'default'
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Image Size', 'overcome'),
            'param_name'    => 'size',
            'value'         => array(
                esc_html__('Thumbnail (150x150)', 'overcome')       => 'thumbnail',
                esc_html__('Small (320x320)', 'overcome')           => 'small',
                esc_html__('Large (640x640)', 'overcome')           => 'large',
                esc_html__('Original (640x640)', 'overcome')        => 'original',
            ),
            'std'           => 'thumbnail',
            'description'   => esc_html__('Auto-detect means that the plugin automatically sets the image resolution based on the size of your feed.', 'overcome'),
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Number Image', 'overcome'),
            'param_name'    => 'number',
            'std'           => '4',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Number Columns', 'overcome'),
            'param_name'    => 'columns',
            'value'         => array('1', '2', '3', '4', '6', '8', '12'),
            'std'           => '4',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Columns Space', 'overcome'),
            'param_name'    => 'columns_space',
            'value'         => array('0', '2', '5', '10', '20', '30'),
            'std'           => '0',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        
        array(
            'type'          => 'checkbox',
            'param_name'    => 'show_like',
            'value'         => array(
                esc_html__('Show like count?', 'overcome') => true
            ),
            'std'           => false,
            'edit_field_class' => 'vc_col-sm-4'
        ),
        array(
            'type'          => 'checkbox',
            'param_name'    => 'show_cmt',
            'value'         => array(
                esc_html__('Show comment count?', 'overcome') => true
            ),
            'std'           => false,
            'edit_field_class' => 'vc_col-sm-4'
        ),
        array(
            'type'          => 'checkbox',
            'param_name'    => 'show_author',
            'value'         => array(
                esc_html__('Show Author?', 'overcome') => true
            ),
            'std'           => 'true',
            'edit_field_class' => 'vc_col-sm-4'
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Author Text', 'overcome'),
            'param_name'    => 'author_text',
            'value'         => esc_html__('Follow Us Now', 'overcome'),
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'overcome'),
            'dependency'    => array(
                'element'   => 'show_author',
                'value'     => 'true',
            ),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__('Open Link in?', 'overcome'),
            'param_name'    => 'target',
            'value'         => array(
                esc_html__('Current window', 'overcome')       => '_self',
                esc_html__('New Window ', 'overcome')      => '_blank',
            ),
            'std'           => '_self',
            'dependency'    => array(
                'element'   => 'show_author',
                'value'     => 'true',
            ),
        )
    )
));
class WPBakeryShortCode_ef5_instagram extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes($this->getShortcode(), $atts);
        extract($atts);
        return parent::content($atts, $content);
    }
    
}
