<?php
vc_map(array(
    'name'          => 'OverCome Posts',
    'base'          => 'ef5_posts',
    'category'      => esc_html__('OverCome', 'unbreak'),
    'description'   => esc_html__('Display your posts with grid layout', 'unbreak'),
    'icon'         => 'icon-wpb-application-icon-large',
    'params'        => array_merge(
        array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Data source', 'unbreak' ),
                'param_name'  => 'post_type',
                'value'       => ef5systems_vc_post_type_list(),
                'std'         => 'post',
                'description' => esc_html__( 'Select content type for your grid.', 'unbreak' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Narrow data source', 'unbreak' ),
                'param_name' => 'taxonomies',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => ef5systems_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories.', 'unbreak' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Exclude from Content and filter list', 'unbreak' ),
                'param_name' => 'taxonomies_exclude',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => ef5systems_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories won\'t be shown in the content and filters list', 'unbreak' ),
                'admin_label' => true
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'posts_per_page',
                'heading'       => esc_html__( 'Number of posts', 'unbreak' ),
                'description'   => esc_html__( 'number of post to show per page', 'unbreak' ),
                'std'           => '4',
            ),
            vc_map_add_css_animation(),
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
                'heading'    => esc_html__('Extra Class','unbreak'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'unbreak'),
            ),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','unbreak'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1'  => get_template_directory_uri().'/vc_elements/layouts/posts-grid-1.png',
                    '2'  => get_template_directory_uri().'/vc_elements/layouts/posts-grid-1.png'
                ),
                'std'   => '1',
                'group' => esc_html__('Layouts','unbreak'),
            ),
        ),
        array(
            array(
                'param_name'  => 'grid_settings',
                'type'        => 'custom_markup',
                'value'       => '<strong>'.esc_html__('Grid Settings','unbreak').'</strong>',
                'std'         => '<strong>'.esc_html__('Grid Settings','unbreak').'</strong>',
                'group'       => esc_html__('Layouts','unbreak'),
            )
        ),
        /* Grid settings */
        ef5systems_grid_settings(
            [
                'group'                  => esc_html__('Layouts','unbreak'), 
                'dependency_element'     => 'layout_template', 
                'dependency_value'       => 'not_equal_to',
                'dependency_value_value' => ['1']
            ]
        ),
        array(
            array(
                'type'          => 'textfield',
                'param_name'    => 'thumbnail_size',
                'heading'       => esc_html__('Thumbnail Size (Leave blank to use default size)','unbreak'),
                'description'   => esc_html__('Enter our defined size: "thumbnail", "medium", "large", "post-thumbnail", "full". Or alternatively enter size in pixels (Example: 200x100 (Width x Height)).','unbreak'),
                'std'           => '',
                'group'         => esc_html__('Post Meta','unbreak'),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_pagination',
                'value'         => array(
                    esc_html__( 'Show Pagination', 'unbreak' ) => '1'
                ),
                'std'           => '1',
                'group'         => esc_html__('Post Meta','unbreak')
            )
        ),
        array(
            array(
                'type'       => 'css_editor',
                'heading'    => '',
                'param_name' => 'css',
                'value'      => '',
                'group'      => esc_html__('Design Options','unbreak'),
            )
        )
    )
));

class WPBakeryShortCode_ef5_posts extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
}
