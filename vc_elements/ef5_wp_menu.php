<?php
vc_map(array(
    'name'        => 'OverCome Custom Menu',
    'base'        => 'ef5_wp_menu',
    'category'    => esc_html__('OverCome', 'unbreak'),
    'description' => esc_html__('Use this element to add one of your custom menus', 'unbreak'),
    'icon'        => 'icon-wpb-wp',
    'params'      => array_merge(
    	array(
	        array(
			    'type'        => 'dropdown',
			    'heading'     => esc_html__( 'Menu', 'unbreak' ),
			    'param_name'  => 'nav_menu',
			    'value'       => ef5systems_options_menu_list_for_vc(),
			    'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'unbreak' ) : esc_html__( 'Select menu to display.', 'unbreak' ),
			    'admin_label' => true,
			    'save_always' => true,
			),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Title','unbreak'),
                'description'   => esc_html__('What text use as a title. Leave blank to use menu title created in Menu Manager','unbreak'),
                'param_name'    => 'title',
                'value'         => '',
                'std'           => '',
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_title_on_desktop',
                'value'      => array(
                    esc_html__('Show Title On Large Screen?','unbreak') => '1'
                ),
                'std'        => '1',
                'description'=> esc_html__('The title will always show on small srceen! This option to make sure you want to show title on large screen or not?','unbreak'),
            ),
			array(
				'type'        => 'el_id',
				'heading'     => esc_html__( 'Element ID', 'unbreak' ),
				'param_name'  => 'el_id',
				'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'unbreak' ), '//w3schools.com/tags/att_global_id.asp' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'unbreak' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'unbreak' ),
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Mode','unbreak'),
                'param_name' => 'layout_mode',
                'value'      =>  array(
                    esc_html__('Vertical','unbreak')   => 'vertical',
                    esc_html__('Vertical (2 Columns)','unbreak')   => 'vertical two-col',
                    esc_html__('Horizontal','unbreak') => 'horizontal',
                    esc_html__('Horizontal and Center','unbreak') => 'horizontal justify-content-center',
                ),
                'std'        => 'vertical',
                'admin_label' => true,
                'group' => esc_html__('Layout','unbreak')
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'add_divider',
                'value'      => array(
                    esc_html__('Add Divider','unbreak') => 'add-divider'
                ),
                'std'        => '',
                'dependency'    => array(
                    'element' => 'layout_mode',
                    'value'   => array('horizontal', 'horizontal justify-content-center')
                ),
                'group' => esc_html__('Layout','unbreak')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Divider Style','unbreak'),
                'param_name' => 'divider_style',
                'value'      =>  array(
                    esc_html__('Horizontal','unbreak') => 'horizontal',
                    esc_html__('Vertical','unbreak')             => 'vertical',
                    esc_html__('Circle','unbreak')     => 'circle',
                ),
                'std'        => 'horizontal',
                'dependency'    => array(
                    'element' => 'add_divider',
                    'value'   => 'add-divider'
                ),
                'group' => esc_html__('Layout','unbreak')
            ),
    	)
    )
));
class WPBakeryShortCode_ef5_wp_menu extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
}