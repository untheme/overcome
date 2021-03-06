<?php
/*! //keith-wood.name/countdown.html
 * Countdown for jQuery v2.1.0.
 * Written by Keith Wood (wood.keith{at}optusnet.com.au) January 2008.
 * Available under the MIT (//keith-wood.name/licence.html) license. 
*/
vc_map(array(
    'name'        => 'OverCome CountDown',
    'base'        => 'ef5_countdown',
    'icon'        => '',
    'category'    => esc_html__('OverCome', 'overcome'),
    'description' => esc_html__('Choose your time remaining', 'overcome'),
    'params'      => array(
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Mode','overcome'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_elements/layouts/countdown-1.png',
                '2' => get_template_directory_uri().'/vc_elements/layouts/countdown-2.png',
            ),
            'std'        => '1',
            'admin_label' => true
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'color',
            'heading'     => esc_html__( 'Color', 'overcome' ),
            'value'       => array_merge(
                array(
                    esc_html__('Default','overcome')      => '',
                )
            ),
            'std'         => '',
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'size',
            'heading'     => esc_html__( 'Size', 'overcome' ),
            'value'       => array(
                esc_html__('Default','overcome') => ''
            ),
            'std' => ''
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'shape',
            'heading'     => esc_html__( 'Shape', 'overcome' ),
            'value'       => array(
                esc_html__( 'Default', 'overcome' )         => '',
            ),
            'std' => ''
        ),
        vc_map_add_css_animation(),
        array(
            'type'        => 'ef5_datetime', 
            'param_name'  => 'time',
            'value'       => '',
            'heading'     => esc_html__( 'Target Time For Countdown', 'overcome' ),
            'description' => esc_html__( 'Choose your time remaining. Date and time format (yyyy/mm/dd hh:mm:ss). Default will is next : 2 week 0 days 8 hours 32 minutes 50 seconds', 'overcome' ),
            'holder'      => 'div',
            'group'       => esc_html__('Timer','overcome')
        ),
        array(
            'type'        => 'textfield',
            'param_name'  => 'time_label',
            'value'       => 'Years, Month, Week, Days, Hours, Mins, Secs',
            'heading'     => esc_html__( 'Lable Time For Countdown', 'overcome' ),
            'description' => esc_html__( 'Enter your time for label. Separated by Comma \',\'! IMPORTANT: You need fill all label value for: Year, Month, Week, Day, Hour, Minute, Second', 'overcome' ),
            'group'       => esc_html__('Timer','overcome')
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'time_format',
            'value'       => array(
                'Years, Month, Week, Days, Hours, Minute, Second' => '1',
                'Month, Week, Days, Hours, Minute, Second'        => '2',
                'Month, Days, Hours, Minute, Second'              => '3',
                'Week, Days, Hours, Minute, Second'               => '4',
                'Days, Hours, Minute, Second'                     => '5',
                'Hours, Minute, Second'                           => '6',
            ),
            'std'         => '5',
            'heading'     => esc_html__( 'Format Time For Countdown', 'overcome' ),
            'description' => esc_html__( 'Choose time format you want!', 'overcome' ),
            'group'       => esc_html__('Timer','overcome')
        )
    )
));

class WPBakeryShortCode_ef5_countdown extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
    	wp_enqueue_script('countdown');
    	wp_enqueue_script('ef5-countdown');
        return parent::content($atts, $content);
    }
}