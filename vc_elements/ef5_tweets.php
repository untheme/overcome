<?php
vc_map(array(
    'name'          => 'OverCome Tweets',
    'base'          => 'ef5_tweets',
    'icon'          => '',
    'category'      => esc_html__('OverCome', 'overcome'),
    'description'   => esc_html__('Show your tweets', 'overcome'),
    'params'        => array_merge(
        array(
            /* Template Settings */
            array(
                'type' => 'img',
                'heading' => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/tweets1.png',
                ),
                'std' => '1',
                'admin_label' => true
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','overcome'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'overcome'),
            ),
        	array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Twitter Name','overcome'),
                'param_name' => 'screen_name',
                'value'      => '',
                'std'      => '',
                'description' => esc_html__('Your Twitter name', 'overcome'),
                'group'		  => esc_html__('Settings','overcome')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Number','overcome'),
                'param_name' => 'num',
                'value'      => '1',
                'std'      => '1',
                'description' => esc_html__('Number of tweets to show', 'overcome'),
                'group'		  => esc_html__('Settings','overcome')
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'rts',
                'value'      => array(
                	esc_html__('Show Retweets','overcome') => '1'
                ),
                'std'		  => '0',	
                'group'		  => esc_html__('Settings','overcome')
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'ats',
                'value'      => array(
                	esc_html__('Show Replies','overcome') => '1'
                ),
                'std'		  => '0',	
                'group'		  => esc_html__('Settings','overcome')
            ),
            array(
                'type'       => 'textfield',
                'param_name' => 'pop',
                'value'      => '5',
                'std'		  => '5',	
                'group'		  => esc_html__('Settings','overcome')
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'relative_date',
                'value'      => array(
                	esc_html__('Default','overcome') => '0',
                	esc_html__('Relative','overcome') => '1'
                ),
                'std'		  => '0',	
                'group'		  => esc_html__('Settings','overcome')
            ),

            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Date Format','overcome'),
                'param_name' => 'date_format',
                'value'      => '',
                'std'        => '',
                'description' => esc_html__('Enter the date format. Leave empty to use default!', 'overcome'),
                'group'		  => esc_html__('Settings','overcome'),
                'dependency'  => array(
                	'element' => 'relative_date',
                	'value'	  => '0'
                )	
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Relative Text','overcome'),
                'param_name' => 'relative_label',
                'value'      => 'ago',
                'std'        => 'ago',
                'description' => esc_html__('Enter the text', 'overcome'),
                'group'		  => esc_html__('Settings','overcome'),
                'dependency'  => array(
                	'element' => 'relative_date',
                	'value'	  => '1'
                )
            )
        )
    )
));
class WPBakeryShortCode_ef5_tweets extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
}
