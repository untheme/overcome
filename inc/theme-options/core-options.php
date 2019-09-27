<?php
/**
 * Theme Options 
 * Site Boxed
 * Add option repeated Boxed theme/ meta option
*/
if(!function_exists('unbreak_general_opts')){
    function unbreak_general_opts($args = []){
        $args = wp_parse_args($args, [
            'default'   => false
        ]);
        $default_value              = $args['default'] ? '-1' : '0';
        $force_output               = $args['default'] ? true : false;
        $default_dropdown_opts      = $args['default'] ? array('-1' => esc_html__('Default','unbreak')) : array();
        $default_page_loading_value = $args['default'] ? '-1' : 'fading-circle';

        if($args['default'] === true){
            $options_layout = array(
                '-1'       => esc_html__('Default','unbreak'),
                'boxed'    => esc_html__('Boxed','unbreak'),
                'bordered' => esc_html__('Bordered','unbreak'),
            );
            $default_layout = '-1';

            $options_boxed = array(
                '-1' => esc_html__('Default','unbreak'),
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
        } else {
            $options_layout = array(
                '-1'       => esc_html__('Default','unbreak'),
                'boxed'    => esc_html__('Boxed','unbreak'),
                'bordered' => esc_html__('Bordered','unbreak'),
            );
            $default_layout = '-1';
            
            $options_boxed = array(
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
        }
        return array(
            array(
                'id'       => 'body_bg',
                'type'     => 'background',
                'title'    => esc_html__('Body Background', 'unbreak'),
                'subtitle' => esc_html__('Choose background style for body', 'unbreak'),
                'output'   => array('body')
            ),       
            array(
                'id'       => 'site_layout',
                'type'     => 'button_set',
                'title'    => esc_html__('Layout', 'unbreak'),
                'subtitle' => esc_html__('Choose site layout', 'unbreak'),
                'options'  => $options_layout,
                'default'  => $default_layout,
            ),
            array(
                'id'       => 'boxed_content_bg',
                'type'     => 'background',
                'title'    => esc_html__('Boxed Content Background', 'unbreak'),
                'subtitle' => esc_html__('Choose background style for boxed content', 'unbreak'),
                'required' => array(
                    array('site_layout', '=', 'boxed')
                ),
                'output'   => array('.site-boxed .ef5-page'),
                'force_output' => $force_output
            ),
            array(
                'id'       => 'site_bordered_w',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__('Bordered Width', 'unbreak'),
                'subtitle' => esc_html__('Enter bordered with.', 'unbreak'),
                'units'    => array('px'),
                'default'  => array(
                    'padding-top'    => '50px',
                    'padding-right'  => '50px',
                    'padding-bottom' => '50px',
                    'padding-left'   => '50px',
                    'units'          => 'px'
                ),
                'required' => array(
                    array('site_layout', '=', 'bordered')
                ),
                'force_output' => $force_output,
                //'output'       => array('.site-bordered')
            ),
            array(
                'id'       => 'bordered_content_bg',
                'type'     => 'background',
                'title'    => esc_html__('Bordered Content Background', 'unbreak'),
                'subtitle' => esc_html__('Choose background style for bordered content', 'unbreak'),
                'required' => array(
                    array('site_layout', '=', 'bordered')
                ),
                'output'   => array('.site-bordered .ef5-page'),
                'force_output' => $force_output
            ),
            array(
                'id'       => 'show_page_loading',
                'type'     => 'button_set',
                'title'    => esc_html__('Enable Page Loading', 'unbreak'),
                'subtitle' => esc_html__('Enable Page Loading Effect When You Load Site', 'unbreak'),
                'options'  => $options_boxed,
                'default'  => $default_value,
            ),
            array(
                'title'     => esc_html__('Page Loadding Style','unbreak'),
                'subtitle'  => esc_html__('Select Style Page Loadding.','unbreak'),
                'id'        => 'page_loading_style',
                'type'      => 'select',
                'options'   => unbreak_page_loading_styles($args['default']),
                'default'   => $default_page_loading_value,
                'required'  => array('show_page_loading', '=', '1' )
            ),
            array(
                'id'       => 'back_totop_on',
                'type'     => 'button_set',
                'title'    => esc_html__('Back to Top Button', 'unbreak'),
                'subtitle' => esc_html__('Show back to top button when scrolled down.', 'unbreak'),
                'options'  => $options_boxed,
                'default'  => $default_value,
            )
        );
    }
}

/**
 * Theme Options 
 * Header Top Area 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('unbreak_header_top_opts')){
    function unbreak_header_top_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => false
        ]);
        $default_value = $args['default'] ? '-1' : '';
        return array(
            'title'  => esc_html__('Header Top', 'unbreak'),
            'icon'   => 'el el-website',
            'fields' => array(
                array(
                    'id'          => 'header_top',
                    'type'        => 'image_select',
                    'title'       => esc_html__('Layout', 'unbreak'),
                    'subtitle'    => esc_html__('Select a layout for upper header top area.', 'unbreak'),
                    'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom header layout first.','unbreak'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=ef5_header_top' ) ) . '">','</a>'),
                    'options'     => unbreak_list_post_thumbnail('ef5_header_top', $args['default']),
                    'default'     => $default_value
                )
            )
        );
    }
}

/**
 * Theme Options 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('unbreak_header_layout')){
    function unbreak_header_layout($default = false){
        $layouts = [];
        if($default){
            $layouts['-1'] = get_template_directory_uri() . '/assets/images/default.png';
            $layouts['none'] = get_template_directory_uri() . '/assets/images/none.png';
        }
        $layouts['1'] = get_template_directory_uri() . '/assets/images/header/header-1.png';
        $layouts['2'] = get_template_directory_uri() . '/assets/images/header/header-2.png';
        $layouts['5'] = get_template_directory_uri() . '/assets/images/header/header-5.png';
        $layouts['6'] = get_template_directory_uri() . '/assets/images/header/header-6.png';
        $layouts['7'] = get_template_directory_uri() . '/assets/images/header/header-7.png';
        $layouts['8'] = get_template_directory_uri() . '/assets/images/header/header-8.png';
        
        return $layouts;
    }
}

if(!function_exists('unbreak_header_opts')){
    function unbreak_header_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => false
        ]);
        $default_value = '1';
        $default_menu = '0';
        if($args['default'] === true){
            $options_width = array(
                '-1' => esc_html__('Default','unbreak'),
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            
            $default_value = $default_menu = $default_width_value = '-1';
        } else {
            $options_width = array(
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_width_value = '0';
        }
        return array(
            array(
                'id'       => 'header_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'unbreak'),
                'subtitle' => esc_html__('Select a layout for header.', 'unbreak'),
                'options'  => unbreak_header_layout($args['default']),
                'default'  => $default_value
            ),
            array(
                'id'       => 'header_menu',
                'type'     => 'select',
                'options'  => unbreak_get_nav_menu(['default' => $args['default'],'none' => true]),
                'default'  => $default_menu,
                'title'    => esc_html__('Header Menu', 'unbreak'),
                'subtitle' => esc_html__('Choose a menu to show', 'unbreak'),
            ),
            array(
                'id'       => 'header_design',
                'type'     => 'info',
                'style'    => 'success',
                'title'    => esc_html__('Header Design', 'unbreak'),
                'subtitle' => esc_html__('Custom header style like: background, text color, link color, border style, ...', 'unbreak'),
            ),
            array(
                'title'    => esc_html__('Header Width', 'unbreak'),
                'subtitle' => esc_html__('Make header content full width or not', 'unbreak'),
                'id'       => 'header_fullwidth',
                'type'     => 'button_set',
                'options'  => $options_width,
                'default'  => $default_width_value,
                'required' => array(
                    array('header_layout' ,'!=', '3')
                )
            ),
            array(
                'title'    => esc_html__('Menu Height', 'unbreak'),
                'subtitle' => esc_html__('Enter the height for Menu', 'unbreak'),
                'id'       => 'main_menu_height',
                'type'     => 'dimensions',
                'width'    => false,
                'units'    => array('px'),
                'default'  => array(),
                'required' => array(
                    array('header_layout' ,'!=', '3')
                ),
                'force_output' => true
            ),
            array(
                'title'    => esc_html__('Header Width', 'unbreak'),
                'subtitle' => esc_html__('Enter the width for side navigation header', 'unbreak'),
                'id'       => 'header_sidewidth',
                'type'     => 'dimensions',
                'height'   => false,
                'units'     => array('px'),
                'required' => array(
                    array('header_layout' ,'=', '3')
                ),
                'force_output' => true
            ),
            array(
                'id'     => 'header_bg',
                'type'   => 'background',
                'title'  => esc_html__('Background', 'unbreak'),
                'output' => array('.header-default')
            ),
            array(
                'id'          => 'header_text_color',
                'type'        => 'color_rgba',
                'title'       => esc_html__('Text Color', 'unbreak'),
                'default'     => '',
                'output'      => array('.header-default')
            ),
            array(
                'id'    => 'header_link_colors',
                'type'  => 'link_color',
                'title' => esc_html__('Link colors', 'unbreak'),
            ),
            array(
                'id'       => 'header_border',
                'type'     => 'border',
                'all'      => false,
                'color'    => false,
                'title'    => esc_html__('Border Style', 'unbreak'),
                'subtitle' => esc_html__('Add your custom border design', 'unbreak'),
                'output'   => array('.header-default')
            ),
            array(
                'id'       => 'header_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Border Color', 'unbreak'),
                'subtitle' => esc_html__('Add your custom border color', 'unbreak'),
                'output'   => array(
                    'border-color' => '.header-default'
                )
            )
        ); 
    }
}

/**
 * Theme Option:
 * Header Attributes 
 *
*/
if(!function_exists('unbreak_header_atts')){
    function unbreak_header_atts($default = false){
        $header_side_nav_icon_type = array(
            'icon'            => esc_html__('Icon Only','unbreak'),
            'separator-left'  => esc_html__('Icon with separator left','unbreak'),
            'separator-right' => esc_html__('Icon with separator right','unbreak'),
        );
        $header_popup_nav_icon_type = array(
            'text'            => esc_html__('Text','unbreak'),
            'icon'            => esc_html__('Icon Only','unbreak'),
            'separator-left'  => esc_html__('Icon with separator left','unbreak'),
            'separator-right' => esc_html__('Icon with separator right','unbreak'),
        );
        $header_mobile_nav_icon_type = array(
            'icon' => esc_html__('Icon','unbreak'),
            'text' => esc_html__('Text','unbreak'),
        );
        $header_atts_icon_style = array(
            'icon'                => esc_html__('Icon','unbreak'),
            'circle accent'       => esc_html__('Circle Icon - Accent Color','unbreak'),
            'circle primary'      => esc_html__('Circle Icon - Primary Color','unbreak'),
            'circle grey'         => esc_html__('Circle Icon - Grey Color - Size 30','unbreak'),
            'circle grey size-36' => esc_html__('Circle Icon - Grey Color - Size 36','unbreak'),
            'circle grey2'        => esc_html__('Circle Icon - (#3F3F3F)','unbreak'),
            
        );
        if($default){
            $options = array(
                '-1' => esc_html__('Default','unbreak'),
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_value = $default_helper_menu_value = $default_popup_menu = $header_mobile_nav_icon_type_value = $header_side_nav_icon_type_value = $header_popup_nav_icon_type_value = $header_atts_icon_style_value = '-1';
            $default_helper_menu = [
                'default' => true,
                'none'    => true
            ];
            $header_mobile_nav_icon_type['-1'] = esc_html__('Default','unbreak');
            $header_side_nav_icon_type['-1']   = esc_html__('Default','unbreak');
            $header_popup_nav_icon_type['-1']  = esc_html__('Default','unbreak');
            $header_atts_icon_style['-1']      = esc_html__('Default','unbreak');
        } else {
            $options = array(
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_value = '0';
            
            $default_helper_menu_value = '';
            $default_helper_menu  = [];
            $default_popup_menu = '0';
            $header_mobile_nav_icon_type_value = 'icon';
            $header_side_nav_icon_type_value = 'icon';
            $header_popup_nav_icon_type_value = 'text';
            $header_atts_icon_style_value = 'icon';
        }
        return array_merge(
            array(
                array(
                    'id'       => 'header_attr',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Header Attributes', 'unbreak'),
                    'subtitle' => esc_html__('Choose header attributes to show', 'unbreak'),
                ),
                array(
                    'title'    => esc_html__('Mobile Menu Icon Style', 'unbreak'),
                    'subtitle' => esc_html__('Choose style of mobile menu icon', 'unbreak'),
                    'id'       => 'header_mobile_nav_icon_type',
                    'type'     => 'select',
                    'options'  => $header_mobile_nav_icon_type,
                    'default'  => $header_mobile_nav_icon_type_value,
                ),
                array(
                    'title'    => esc_html__('Helper Menu', 'unbreak'),
                    'subtitle' => esc_html__('Show/Hide helper menu', 'unbreak'),
                    'id'       => 'header_helper_menu',
                    'type'     => 'select',
                    'options'  => unbreak_get_nav_menu($default_helper_menu),
                    'default'  => $default_helper_menu_value
                ),
                array(
                    'title'    => esc_html__('Icon Style', 'unbreak'),
                    'subtitle' => esc_html__('Choose style attributes icon', 'unbreak'),
                    'id'       => 'header_atts_icon_style',
                    'type'     => 'select',
                    'options'  => $header_atts_icon_style,
                    'default'  => $header_atts_icon_style_value,
                ),
                array(
                    'title'    => esc_html__('Show Social', 'unbreak'),
                    'subtitle' => esc_html__('Show/Hide social icon', 'unbreak'),
                    'id'       => 'header_social',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),

                array(
                    'title'    => esc_html__('Show Search', 'unbreak'),
                    'subtitle' => esc_html__('Show/Hide search icon', 'unbreak'),
                    'id'       => 'header_search',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                )
            ),
            unbreak_header_wc_attrs($options, $default_value),
            unbreak_header_contact_attrs($options, $default, $default_value),
            unbreak_header_contact_plain_text_attrs($options, $default_value),
            array(
                array(
                    'title'    => esc_html__('Show Nav Widget', 'unbreak'),
                    'subtitle' => esc_html__('Show/Hide side menu', 'unbreak'),
                    'desc'     => sprintf(esc_html__('When this option is YES, you need add widget to %sNav Widget%s area','unbreak'),'<a href="' . esc_url( admin_url( 'widgets.php#sidebar-nav' ) ) . '" target="_blank">','</a>'),
                    'id'       => 'header_side_nav',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),
                array(
                    'title'    => esc_html__('Nav Widget Icon Style', 'unbreak'),
                    'subtitle' => esc_html__('Choose style of side menu icon', 'unbreak'),
                    'id'       => 'header_side_nav_icon_type',
                    'type'     => 'select',
                    'options'  => $header_side_nav_icon_type,
                    'default'  => $header_side_nav_icon_type_value,
                    'required' => array('header_side_nav', '=', '1'),
                ),
                array(
                    'title'    => esc_html__('Show Popup Menu', 'unbreak'),
                    'subtitle' => esc_html__('Show/Hide poup menu', 'unbreak'),
                    'id'       => 'header_popup_nav',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),
                array(
                    'title'    => esc_html__('Popup Menu Icon Style', 'unbreak'),
                    'subtitle' => esc_html__('Choose style of icon: Text or Icon', 'unbreak'),
                    'id'       => 'header_popup_nav_icon_type',
                    'type'     => 'select',
                    'options'  => $header_popup_nav_icon_type,
                    'default'  => $header_popup_nav_icon_type_value,
                    'required' => array('header_popup_nav', '=', '1'),
                ),
                array(
                    'id'       => 'header_popup_menu',
                    'type'     => 'select',
                    'options'  => unbreak_get_nav_menu(['default' => $default, 'none' => true]),
                    'default'  => $default_popup_menu,
                    'required' => array('header_popup_nav', '=', '1'),
                    'title'    => esc_html__('Popup Menu', 'unbreak'),
                    'subtitle' => esc_html__('Choose a menu to show', 'unbreak'),
                )
            ),
            unbreak_header_signin_signup_opts(['default' => $default]),
            array(
                array(
                    'id'       => 'header_side_copyright',
                    'type'     => 'textarea',
                    'default'  => sprintf('&copy; Biger. by <a href="%s">CMSSuperheroes</a>', esc_url('http://www.cmssuperheroes.com/')),
                    'required' => array('header_layout', '=', '3'),
                    'title'    => esc_html__('Copyright Text', 'unbreak'),
                    'subtitle' => esc_html__('Enter your copyright text', 'unbreak'),
                )
            )

        );
    }
}

/**
 * Theme Options 
 * Show cart, wishlist, ... icon
 * Require WooCommerce, WooCommerce Smash Wishlist, and more to work
 *
*/
function unbreak_header_wc_attrs($options, $default_value){
    if(!class_exists('WooCommerce')) return array();
    $opts = [
        array(
            'title'    => esc_html__('Show Cart', 'unbreak'),
            'subtitle' => esc_html__('Show/Hide cart icon', 'unbreak'),
            'id'       => 'header_cart',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        )
    ];
    if(class_exists('WPcleverWoosw')){
        $opts[] = array(
            'title'    => esc_html__('Show Wishlist', 'unbreak'),
            'subtitle' => esc_html__('Show/Hide Wishlist icon', 'unbreak'),
            'id'       => 'header_wishlist',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        );
    }
    if(class_exists('WPcleverWooscp')){
        $opts[] = array(
            'title'    => esc_html__('Show Compare', 'unbreak'),
            'subtitle' => esc_html__('Show/Hide Compare icon', 'unbreak'),
            'id'       => 'header_compare',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        );
    }
    return $opts;
}
/**
 * Theme Options 
 * Show Contact button
 * Require Contact form 7 to work
 *
*/
function unbreak_header_contact_attrs($options, $default, $default_value){
    if(!class_exists('WPCF7')) return array();
    $opts = [
         array(
            'title'    => esc_html__('Show Contact', 'unbreak'),
            'subtitle' => esc_html__('Show/Hide contact button', 'unbreak'),
            'id'       => 'header_contact',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        ),
        array(
            'title'    => esc_html__('Contact Form', 'unbreak'),
            'subtitle' => esc_html__('Choose an contact form', 'unbreak'),
            'id'       => 'header_contact_form',
            'type'     => 'select',
            'options'  => unbreak_get_list_cf7($default),
            'default'  => $default_value,
            'required' => array(
                array('header_contact', '!=', '-1'),
                array('header_contact', '!=', '0')
            )
        )
    ];
    
    return $opts;
}

/**
 * Theme Options 
 * Show Contact Plain Info
 * hot line, working hour, address, email,
 *
*/
function unbreak_header_contact_plain_text_attrs($options, $default_value){
    $opts = [
         array(
            'title'    => esc_html__('Show Plain Contact Info', 'unbreak'),
            'subtitle' => esc_html__('Show/Hide contact plain text info', 'unbreak'),
            'id'       => 'header_contact_plain',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
            'required' => array(
                array('header_layout', '=', array('1','2','5','6','6-white','7','8')),
            )
        ),
        array(
            'title'    => esc_html__('Icon 1', 'unbreak'),
            'id'       => 'header_contact_plain_icon1',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your font icon class, ex: lnr lnr-phone-handset or flaticon-telephone','unbreak')
        ),
        array(
            'title'    => esc_html__('Title 1', 'unbreak'),
            'id'       => 'header_contact_plain_text1',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your text, ex: (+88)222.888.66','unbreak')
        ),
        array(
            'title'    => esc_html__('Description 1', 'unbreak'),
            'id'       => 'header_contact_plain_subtext1',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your text, ex: Free call','unbreak')
        ),
        array(
            'title'    => esc_html__('Icon 2', 'unbreak'),
            'id'       => 'header_contact_plain_icon2',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your font icon class, ex: lnr lnr-clock or flaticon-clock','unbreak')
        ),
        array(
            'title'    => esc_html__('Title 2', 'unbreak'),
            'id'       => 'header_contact_plain_text2',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your text, ex: 8:00 AM - 6:00 PM','unbreak')
        ),
        array(
            'title'    => esc_html__('Description 2', 'unbreak'),
            'id'       => 'header_contact_plain_subtext2',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your text, ex: Monday - Friday','unbreak')
        ),
        array(
            'title'    => esc_html__('Icon 3', 'unbreak'),
            'id'       => 'header_contact_plain_icon3',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your font icon class, ex: lnr lnr-map-marker or flaticon-location-pin','unbreak')
        ),
        array(
            'title'    => esc_html__('Title 3', 'unbreak'),
            'id'       => 'header_contact_plain_text3',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your text, ex: 99 Kellen Motorway','unbreak')
        ),
        array(
            'title'    => esc_html__('Description 3', 'unbreak'),
            'id'       => 'header_contact_plain_subtext3',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your text, ex: Wallis and Futuna','unbreak')
        ),
        array(
            'title'    => esc_html__('Title 3 (Sub)', 'unbreak'),
            'id'       => 'header_contact_plain_sub_text3',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your text, ex: Closed on','unbreak')
        ),
        array(
            'title'    => esc_html__('Description 3 (Sub)', 'unbreak'),
            'id'       => 'header_contact_plain_sub_subtext3',
            'type'     => 'text',
            'default'  => '',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            ),
            'description' => esc_html__('Enter your text, ex: Weekends','unbreak')
        ),

    ];
    
    return $opts;
}

/**
 * Theme Options 
 * Show SingIn / SingUp button
 * Require CSH Login Plugin
 *
*/
if(!function_exists('unbreak_header_signin_signup_opts')){
    function unbreak_header_signin_signup_opts($args = []){
        if(!function_exists('cshlg_add_login_form')) return array();
        $args = wp_parse_args($args,[
            'default' => false
        ]);
        if($args['default']){
            $options = array(
                '-1' => esc_html__('Default','unbreak'),
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_value = '-1';
        } else {
            $options = array(
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_value = '0';
        }
        return array (
            array(
                'title'    => esc_html__('Show SignIn', 'unbreak'),
                'subtitle' => esc_html__('Show/Hide SignIn Button', 'unbreak'),
                'id'       => 'header_signin',
                'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
            ),
            array(
                'title'    => esc_html__('SignIn Label', 'unbreak'),
                'id'       => 'header_signin_label',
                'type'     => 'text',
                'default'  => esc_html__('Sign In','unbreak'),
                'required' => array('header_signin', '!=', '0')
            ),
            array(
                'title'    => esc_html__('Show SignUp', 'unbreak'),
                'subtitle' => esc_html__('Show/Hide SignUp Button', 'unbreak'),
                'id'       => 'header_signup',
                'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
            ),
            array(
                'title'    => esc_html__('SignUp Label', 'unbreak'),
                'id'       => 'header_signup_label',
                'type'     => 'text',
                'default'  => esc_html__('Sign Up','unbreak'),
                'required' => array('header_signup', '!=', '0')
            )
        );
    }
}

/**
 * Main Logo
*/
if(!function_exists('unbreak_header_main_logo')){
    function unbreak_header_main_logo($args = []){
        $args = wp_parse_args($args, [
            'subsection' => true
        ]);
        return array(
            'title'      => esc_html__('Logo', 'unbreak'),
            'icon'       => 'el-icon-picture',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'             => 'logo',
                    'type'           => 'media',
                    'library_filter' => array('gif','jpg','jpeg','png','svg'),
                    'title'          => esc_html__('Logo', 'unbreak'),
                    'subtitle'       => esc_html__('Choose your logo. If not set, default Logo will be used', 'unbreak')
                ),
                array(
                    'id'       => 'logo_size',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'unbreak'),
                    'subtitle' => esc_html__('Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'unbreak'),
                    'units'     => array('px'),
                    'default'   => array(),
                ),
            )
        );
    }
}

/**
 * Main Logo
*/
if(!function_exists('unbreak_header_page_logo')){
    function unbreak_header_page_logo($args = []){
        $args = wp_parse_args($args, [
            'subsection' => true
        ]);
        return array(
            'title'      => esc_html__('Logo', 'unbreak'),
            'icon'       => 'el-icon-picture',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'             => 'logo',
                    'type'           => 'media',
                    'library_filter' => array('gif','jpg','jpeg','png','svg'),
                    'title'          => esc_html__('Main Logo', 'unbreak'),
                    'subtitle'       => esc_html__('Choose your logo. If not set, default Logo will be used', 'unbreak')
                ),
                array(
                    'id'             => 'sticky_logo',
                    'type'           => 'media',
                    'library_filter' => array('gif','jpg','jpeg','png','svg'),
                    'title'          => esc_html__('Sticky Logo', 'unbreak'),
                    'subtitle'       => esc_html__('Choose your sticky logo. If not set, default Logo will be used', 'unbreak')
                ),
                array(
                    'id'       => 'logo_size',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'unbreak'),
                    'subtitle' => esc_html__('Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'unbreak'),
                    'units'     => array('px'),
                    'default'   => array(),
                ),
            )
        );
    }
}

/**
 * Ontop Header 
*/
if(!function_exists('unbreak_ontop_header_opts')){
    function unbreak_ontop_header_opts($args = []){
        $args = wp_parse_args($args, [
            'default'    => false,
            'subsection' => true
        ]);
        $force_output = $args['default'] ? true : false;
        if($args['default']){
            $options = array(
                '-1' => esc_html__('Default','unbreak'),
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_value = '-1';
        } else {
            $options = array(
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_value = '0';
        }
        return array(
            'title'      => esc_html__('On Top Header', 'unbreak'),
            'icon'       => 'el-icon-credit-card ',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'       => 'header_ontop',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Header On top', 'unbreak'),
                    'subtitle' => esc_html__('Header will be on top when applicable.', 'unbreak'),
                    'options'  => $options,
                    'default'  => $default_value
                ),
                array(
                    'id'       => 'ontop_logo_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('On top Logo', 'unbreak'),
                    'subtitle' => esc_html__('Custon Logo', 'unbreak'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_logo',
                    'type'     => 'media',
                    'title'    => esc_html__('On top Logo', 'unbreak'),
                    'subtitle' => esc_html__('If not set, default logo will be used.', 'unbreak'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_logo_maxh',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'unbreak'),
                    'subtitle' => esc_html__('Enter size for your logo in on top header, just in case the logo is too large. If not set, default size will be used', 'unbreak'),
                    'units'     => array('px'),
                    'default'  => array(),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_header_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Header Design', 'unbreak'),
                    'subtitle' => esc_html__('Custom on top header style like: background, color, space, ...', 'unbreak'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'     => 'ontop_header_bg',
                    'type'   => 'color_rgba',
                    'title'  => esc_html__('Background', 'unbreak'),
                    'output' => array(
                        'background-color' => '.header-ontop'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'          => 'ontop_header_text_color',
                    'type'        => 'color_rgba',
                    'title'       => esc_html__('Text Color', 'unbreak'),
                    'default'     => '',
                    'output'      => array(
                        'color' => '.header-ontop'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'    => 'ontop_link_colors',
                    'type'  => 'link_color',
                    'title' => esc_html__('Link colors', 'unbreak'),
                    'output' => array(
                        'color' => '.header-ontop a'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'header_ontop_border',
                    'type'     => 'border',
                    'all'      => false,
                    'color'    => false,
                    'title'    => esc_html__('Border Style', 'unbreak'),
                    'subtitle' => esc_html__('Add your custom border design', 'unbreak'),
                    'output'   => array('.header-ontop'),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'header_ontop_border_color',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Border Color', 'unbreak'),
                    'subtitle' => esc_html__('Add your custom border color', 'unbreak'),
                    'output'   => array(
                        'border-color' => '.header-ontop'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                )
            )
        );
    }
}

/**
 * Header Sticky Options
*/
if(!function_exists('unbreak_sticky_header_opts')){
    function unbreak_sticky_header_opts($args=[]){
        $args = wp_parse_args($args, [
            'default'    => false,
            'subsection' => true
        ]);
        if($args['default']){
            $options = array(
                '-1' => esc_html__('Default','unbreak'),
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_value = '-1';
        } else {
            $options = array(
                '1'  => esc_html__('Yes','unbreak'),
                '0'  => esc_html__('No','unbreak'),
            );
            $default_value = '0';
        }
        return array(
            'title'      => esc_html__('Sticky Header', 'unbreak'),
            'icon'       => 'el-icon-credit-card ',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'       => 'header_sticky',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Sticky Header', 'unbreak'),
                    'subtitle' => esc_html__('Header will be sticked when applicable.', 'unbreak'),
                    'options'  => $options,
                    'default'  => $default_value
                ),
                array(
                    'id'       => 'sticky_logo_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Sticky Logo', 'unbreak'),
                    'subtitle' => esc_html__('Custon Logo', 'unbreak'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_logo',
                    'type'     => 'media',
                    'title'    => esc_html__('Sticky Header Logo', 'unbreak'),
                    'subtitle' => esc_html__('If not set, default logo will be used.', 'unbreak'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_logo_maxh',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'unbreak'),
                    'subtitle' => esc_html__('Enter size for your logo on sticky header, just in case the logo is too large.', 'unbreak'),
                    'units'     => array('px'),
                    'default'  => array(),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_header_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Sticky Header Design', 'unbreak'),
                    'subtitle' => esc_html__('Custom sticky header style like: background, color, space, ...', 'unbreak'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'     => 'sticky_header_bg',
                    'type'   => 'color_rgba',
                    'title'  => esc_html__('Background', 'unbreak'),
                    'output' => array(
                        'background-color' => '.header-sticky'
                    ),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'          => 'sticky_header_text_color',
                    'type'        => 'color_rgba',
                    'title'       => esc_html__('Text Color', 'unbreak'),
                    'default'     => '',
                    'output'      => array('.header-sticky'),
                    'required' => array('header_sticky','=', '1')
                ),
                array(
                    'id'    => 'sticky_link_colors',
                    'type'  => 'link_color',
                    'title' => esc_html__('Link colors', 'unbreak'),
                    'output' => array(
                        'color' => '.header-sticky a'
                    ),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'header_sticky_border',
                    'type'     => 'border',
                    'all'      => false,
                    'color'    => false,
                    'title'    => esc_html__('Border Style', 'unbreak'),
                    'subtitle' => esc_html__('Add your custom border design', 'unbreak'),
                    'output'   => array('.header-sticky'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'header_sticky_border_color',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Border Color', 'unbreak'),
                    'subtitle' => esc_html__('Add your custom border color', 'unbreak'),
                    'output'   => array(
                        'border-color' => '.header-sticky'
                    ),
                    'required' => array('header_sticky', '=', '1')
                )
            )
        );
    }
}
/**
 * Theme Options
 * Page title options
*/
if(!function_exists('unbreak_page_title_opts')){
    function unbreak_page_title_opts($args=[]){
        $args = wp_parse_args($args,[
            'default' => false
        ]);
        $force_output = $args['default'] ? true : false;
        $default_value = '2';

        $custom_title = $custom_desc = '';

        $ptitle_layout = [
            '1' => get_template_directory_uri() . '/assets/images/page-title/01.png',
            '2' => get_template_directory_uri() . '/assets/images/page-title/02.png',
        ];
        $breadcrumb_on_opts = array(
            '1'  => esc_html__('Show','unbreak'), 
            '0'  => esc_html__('Hide','unbreak'), 
         );
        if($args['default']){
            $default_value = '-1';
            $ptitle_layout = [
                '-1'   => get_template_directory_uri() . '/assets/images/default.png',
                'none' => get_template_directory_uri() . '/assets/images/none.png'
            ] + $ptitle_layout;

            $custom_title = array(
                'id'       => 'custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Custom Title', 'unbreak'),
                'subtitle' => esc_html__('Use custom title for this page. The default title will be used on document title.', 'unbreak')
            );

            $custom_desc = array(
                'id'       => 'custom_desc',
                'type'     => 'textarea',
                'title'    => esc_html__('Custom description', 'unbreak'),
                'subtitle' => esc_html__('Show custom page description under page title', 'unbreak')
            );

            $breadcrumb_on_opts = [
                '-1'  => esc_html__('Default','unbreak')
            ] + $breadcrumb_on_opts;
        }
        return array(
            array(
                'id'       => 'ptitle_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'unbreak'),
                'subtitle' => esc_html__('Select a layout for page title.', 'unbreak'),
                'options'  => $ptitle_layout,
                'default'  => $default_value
            ),
            $custom_title,
            $custom_desc,
            array(
                'id'           => 'ptitle_color',
                'type'         => 'color_rgba',
                'title'        => esc_html__('Title Color', 'unbreak'),
                'subtitle'     => esc_html__('Page title color.', 'unbreak'),
                'output'       => array(
                    'color' => '.ef5-pagetitle .page-title'
                ),
                'force_output' => $force_output,
                'default'      => ''
            ),
            array(
                'id'       => 'ptitle_parallax',
                'type'     => 'media',
                'title'    => esc_html__('Parallax Image', 'unbreak'),
                'subtitle' => esc_html__('Choose your image', 'unbreak'),
            ),
            array(
                'id'       => 'ptitle_parallax_overlay',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Parallax Overlay Color', 'unbreak'),
                'subtitle' => esc_html__('Add parallax overlay color.', 'unbreak'),
                'output'   => array(
                    'background-color' => '.ef5-pagetitle .parallax:before'
                ),
                'force_output' => $force_output,
                'default'      => ''
            ),
            array(
                'id'           => 'ptitle_paddings',
                'type'         => 'spacing',
                'title'        => esc_html__('Paddings', 'unbreak'),
                'subtitle'     => esc_html__('Enter inner space.', 'unbreak'),
                'mode'         => 'padding',
                'units'        => array('px'),
                'output'       => array('#ef5-page .ef5-pagetitle'),
                'force_output' => $force_output,
                'default'      => array()
            ),
            array(
                'id'           => 'ptitle_margins',
                'type'         => 'spacing',
                'title'        => esc_html__('Margin', 'unbreak'),
                'subtitle'     => esc_html__('Enter outer space.', 'unbreak'),
                'mode'         => 'margin',
                'units'        => array('px'),
                'force_output' => $force_output,
                'output'       => array('#ef5-page .ef5-pagetitle-wrap'),
                'default'      => array()
            ),
            array(
                'id'      => 'breadcrumb_on',
                'type'    => 'button_set',
                'options' => $breadcrumb_on_opts,
                'title'   => esc_html__('Breadcrumb', 'unbreak'),
                'default' => $default_value
            ),
            array(
                'id'          => 'breadcrumb_color',
                'type'        => 'color',
                'title'       => esc_html__('Breadcrumb Text Color', 'unbreak'),
                'subtitle'    => esc_html__('Select text color for breadcrumb', 'unbreak'),
                'transparent' => false,
                'output'      => array('.ef5-pagetitle-wrap .breadcrumb'),
                'force_output'=> $force_output,
                'required'    => array('breadcrumb_on', '=', true)
            ),
            array(
                'id'           => 'breadcrumb_link_colors',
                'type'         => 'link_color',
                'title'        => esc_html__('Breadcrumb Link Colors', 'unbreak'),
                'subtitle'     => esc_html__('Select link colors for breadcrumb', 'unbreak'),
                'output'       => array('.ef5-pagetitle-wrap .breadcrumb a'),
                'force_output' => $force_output,
                'default'      => array(),
                'required'     => array('breadcrumb_on', '=', true)
            )
        );
    }
}
/**
 * Widget Options
 * sidebar position
*/
function unbreak_sidebar_position_opts($default = false){
    $options_default = array('-1' => esc_html__('Default','unbreak'));
    $options =  array(
        'none'   => esc_html__('No Widget', 'unbreak'),
        'center' => esc_html__('No Widget - Content Center', 'unbreak'),
        'left'   => esc_html__('Left', 'unbreak'),
        'right'  => esc_html__('Right', 'unbreak'),
        'bottom' => esc_html__('Below Content', 'unbreak')
    );
    if($default)
        return $options_default+$options;
    else 
        return $options;
}

/* Page Options */
if(!function_exists('unbreak_page_opts')){
    function unbreak_page_opts($default = false){
        $default_value = unbreak_page_sidebar_position();
        if($default){
            $default_value = '-1';
        }
        return array(
            array(
                'id'       => 'page_sidebar_pos',
                'type'     => 'button_set',
                'title'    => esc_html__('Layouts', 'unbreak'),
                'subtitle' => esc_html__('select a layout for single...', 'unbreak'),
                'options'  => unbreak_sidebar_position_opts($default),
                'default'  => $default_value
            )
        );
    }
}

/**
 * WooCommerce Options
*/
if(!function_exists('unbreak_woocommerce_theme_opts')){
    function unbreak_woocommerce_theme_opts($default = false){
        $gallery_layout = $gallery_thumb_position        = array();
        $default_value          = 'none';
        $default_gallery_layout = 'simple';
        $default_gallery_thumb_position = 'thumb-right';
        if($default){
            $gallery_layout['-1']         = esc_html__('Default','unbreak');
            $gallery_thumb_position['-1'] = esc_html__('Default','unbreak');
            $default_value                = '-1';
            $default_gallery_layout       = '-1';
            $default_gallery_thumb_position       = '-1';
        }
        $gallery_layout['simple']     = esc_html__('Simple', 'unbreak');
        $gallery_layout['thumbnail_v'] = esc_html__('Thumbnail Vertical', 'unbreak');
        $gallery_layout['thumbnail_h'] = esc_html__('Thumbnail Horizontal', 'unbreak');

        $gallery_thumb_position['thumb-left'] = esc_html__('Left','unbreak');
        $gallery_thumb_position['thumb-right'] = esc_html__('Right','unbreak');

        return array(
            'title'      => esc_html__('WooCommerce', 'unbreak'),
            'icon'       => 'el el-shopping-cart',
            'subsection' => false,
            'fields'     => array(
                array(
                    'id'       => 'loop_product_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Loop Products Design', 'unbreak'),
                    'subtitle' => esc_html__('Custom products design, ...', 'unbreak'),
                ),
                array(
                    'id'       => 'products_per_page',
                    'type'     => 'slider',
                    'title'    => esc_html__('Number Products', 'unbreak'),
                    'subtitle' => esc_html__('Choose number products to show on archive page, ...', 'unbreak'),
                    'default'   => 12,
                    'min'       => 1,
                    'step'      => 1,
                    'max'       => 50,
                    'display_value' => 'label'
                ),
                array(
                    'id'       => 'products_columns',
                    'type'     => 'slider',
                    'title'    => esc_html__('Products Columns', 'unbreak'),
                    'subtitle' => esc_html__('Choose products columns show on archive page, ...', 'unbreak'),
                    'default'   => 4,
                    'min'       => 1,
                    'step'      => 1,
                    'max'       => 6,
                    'display_value' => 'label'
                ),
                array(
                    'id'       => 'shop_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'unbreak'),
                    'subtitle' => esc_html__('select a layout for products page', 'unbreak'),
                    'options'  => unbreak_sidebar_position_opts(),
                    'default'  => unbreak_shop_sidebar_position()
                ),
                array(
                    'id'       => 'single_product_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Single Product Design', 'unbreak'),
                    'subtitle' => esc_html__('Custom single product design, ...', 'unbreak'),
                ),
                array(
                    'id'       => 'product_gallery_layout',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'unbreak'),
                    'subtitle' => esc_html__('select a layout for single...', 'unbreak'),
                    'options'  => $gallery_layout,
                    'default'  => $default_gallery_layout
                ),
                array(
                    'id'       => 'product_gallery_thumb_position',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Thumbnail Position', 'unbreak'),
                    'subtitle' => esc_html__('select a position for gallery thumbnail', 'unbreak'),
                    'options'  => $gallery_thumb_position,
                    'default'  => $default_gallery_thumb_position,
                    'required' => array(
                        array('product_gallery_layout', '=', 'thumbnail_v')
                    )
                ),
                array(
                    'id'       => 'product_share_on',
                    'title'    => esc_html__('Share', 'unbreak'),
                    'subtitle' => esc_html__('Show share product to some socials network on each post.', 'unbreak'),
                    'type'     => 'switch',
                    'default'  => '0',
                ),
                array(
                    'id'       => 'product_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'unbreak'),
                    'subtitle' => esc_html__('select a layout for single product page', 'unbreak'),
                    'options'  => unbreak_sidebar_position_opts(),
                    'default'  => unbreak_product_sidebar_position()
                ),
            )
        );
    }
}

/**
 * Theme Options 
 * Footer Area 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('unbreak_footer_opts')){
    function unbreak_footer_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => false
        ]);
        $default_value = $args['default'] ? '-1' : '';
        $force_output  = $args['default'] ? true : false;
        return array(
            'title'  => esc_html__('Footer', 'unbreak'),
            'icon'   => 'el el-website',
            'fields' => array(
                array(
                    'id'          => 'footer_layout',
                    'type'        => 'image_select',
                    'title'       => esc_html__('Layout', 'unbreak'),
                    'subtitle'    => esc_html__('Select a layout for upper footer area.', 'unbreak'),
                    'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','unbreak'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=ef5_footer' ) ) . '">','</a>'),
                    'placeholder' => esc_html__('Default','unbreak'),
                    'options'     => unbreak_list_post_thumbnail('ef5_footer', $args['default']),
                    'default'     => $default_value
                ),
                array(
                    'id'             => 'footer_margin',
                    'type'           => 'spacing',
                    'mode'           => 'margin',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Footer margin', 'unbreak'),
                    'subtitle'       => esc_html__('Enter outer space', 'unbreak'),
                    'force_output'   => $force_output,
                    'output'         => array(
                        '#ef5-footer'
                    )
                ),
            )
        );
    }
}