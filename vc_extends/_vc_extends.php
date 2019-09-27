<?php
/**
 * Register icons for Visual Composer
 */
function overcome_vc_icon_fonts_register()
{
    wp_register_style('font-linear', get_template_directory_uri() . '/assets/fonts/linear/font-linear.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-elegant', get_template_directory_uri() . '/assets/fonts/elegant/font-elegant.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-etline', get_template_directory_uri() . '/assets/fonts/et-line-font/et-line-font.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/flaticon.css', array(), wp_get_theme()->get('Version'));
}
add_action( 'wp_enqueue_scripts', 'overcome_vc_icon_fonts_register' );
add_action( 'admin_enqueue_scripts', 'overcome_vc_icon_fonts_register' );

/**
 * Enqueues icons for Visual Composer
 */
function overcome_vc_icon_fonts_enqueue()
{
    wp_enqueue_style( 'font-linear' );
    wp_enqueue_style( 'font-elegant' );
    wp_enqueue_style( 'font-etline' );
    wp_enqueue_style( 'font-flaticon' );
}
add_action( 'vc_backend_editor_enqueue_js_css', 'overcome_vc_icon_fonts_enqueue' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'overcome_vc_icon_fonts_enqueue' );

add_action('vc_enqueue_font_icon_element', 'overcome_vc_icon_font');
function overcome_vc_icon_font($font)
{
    switch ($font) {
        case 'linear':
            wp_enqueue_style('font-linear');
        case 'elegant':
            wp_enqueue_style('font-elegant');
        case 'etline':
            wp_enqueue_style('font-etline');
        case 'flaticon':
            wp_enqueue_style('font-flaticon');
    }
}

function overcome_icon_libs($args = array()){
    $args = wp_parse_args($args, array(
        'group'            => esc_html__('Icon','overcome'),
        'field_prefix'     => 'i_', 
        'dependency'       => 'add_icon',
        'dependency_value' => 'true'
    ));
    extract($args);

    require_once vc_path_dir( 'CONFIG_DIR', 'content/vc-icon-element.php' );
    /**
     * @source 
     * vc_map_integrate_shortcode( $shortcode, $field_prefix = '', $group_prefix = '', $change_fields = null, $dependency = null )
    **/
    $icons_params = vc_map_integrate_shortcode( vc_icon_element_params(), $field_prefix, $group, array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => $dependency,
        'value'   => $dependency_value,
    ) );

    // populate integrated vc_icons params.
    if ( is_array( $icons_params ) && ! empty( $icons_params ) ) {
        foreach ( $icons_params as $key => $param ) {
            if ( is_array( $param ) && ! empty( $param ) ) {
                if ( $field_prefix.'type' === $param['param_name'] ) {
                    /* append biger icon to dropdown 
                     * use: 
                     * $icons_params[ $key ]['value'][ esc_html__( 'Linear Icon', 'overcome' ) ] = 'linear';
                    */
                    $icons_params[ $key ]['value'][ esc_html__( 'Linear Icon', 'overcome' ) ]  = 'linear';
                    $icons_params[ $key ]['value'][ esc_html__( 'Elegant Icon', 'overcome' ) ] = 'elegant';
                    $icons_params[ $key ]['value'][ esc_html__( 'ET Line Icon', 'overcome' ) ] = 'etline';
                    $icons_params[ $key ]['value'][ esc_html__( 'Flat Icon', 'overcome' ) ] = 'flaticon';
                    /* Change default font icon
                     * $icons_params[ $key ]['std'] = 'fontawesome';
                    */
                    $icons_params[ $key ]['std'] = 'linear';
                }
                if ( isset( $param['admin_label'] ) ) {
                    /*remove admin label*/
                    unset( $icons_params[ $key ]['admin_label'] );
                }
            }
        }
    }
    return $icons_params;
}
function overcome_icon_libs_icon($args = array()){
    $args = wp_parse_args($args, array(
        'group'        => esc_html__('Icon','overcome'), 
        'field_prefix' => 'i_', 
        'return'       => true
    ));
    extract($args);
    if(!$return) return array();
    return array (
        /* Theme Icons */
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'overcome' ),
            'param_name' => $field_prefix.'icon_linear',
            'value'      => 'lnr lnr-home',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'linear',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'linear',
            ),
            'description' => esc_html__( 'Select icon from library.', 'overcome' ),
            'group'       => $group
        ),
        /* Elegant */
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'overcome' ),
            'param_name' => $field_prefix.'icon_elegant',
            'value'      => 'arrow_up',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'elegant',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'elegant',
            ),
            'description' => esc_html__( 'Select icon from library.', 'overcome' ),
            'group'       => $group
        ),
        // ET Line
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'overcome' ),
            'param_name' => $field_prefix.'icon_etline',
            'value'      => 'icon-mobile',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'etline',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'etline',
            ),
            'description' => esc_html__( 'Select icon from library.', 'overcome' ),
            'group'       => $group
        ),
        // Flaticon
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'overcome' ),
            'param_name' => $field_prefix.'icon_flaticon',
            'value'      => 'flaticon-medal',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'flaticon',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'flaticon',
            ),
            'description' => esc_html__( 'Select icon from library.', 'overcome' ),
            'group'       => $group
        )
    );
}

/**
 * VC Post type list
 * Get post type for vc element 
*/
if (!function_exists('overcome_vc_post_type_list')) {
    function overcome_vc_post_type_list()
    {
        $post_types = get_post_types(array('public' => true), 'object');
        $DefaultExcludedPostTypes = array(
            'revision',
            'nav_menu_item',
            'vc_grid_item',
            'page',
            'attachment',
            'custom_css',
            'customize_changeset',
            'oembed_cache',
            'ef5_mega_menu',
            'ef5_header_top',
            'ef5_footer'
        );
        $ExtraExcludedPostTypes = apply_filters('overcome_vc_post_type_list', array());
        
        $excludedPostTypes = array_merge($DefaultExcludedPostTypes, $ExtraExcludedPostTypes );

        $result = [];
        if (!is_array($post_types))
            return $result;
        foreach ($post_types as $post_type) {
            if (!$post_type instanceof WP_Post_Type)
                continue;
            if (in_array($post_type->name, $excludedPostTypes))
                continue;
            $result["{$post_type->label} ({$post_type->name})"] = $post_type->name;
        }
        return $result;
    }
}


/**
 * Button Colors
*/
if(!function_exists('overcome_button_colors')){
    function overcome_button_colors(){
        $button_colors = array(
            esc_html__('Primary', 'overcome')   => 'primary',
            esc_html__('Accent', 'overcome')    => 'accent',
            esc_html__('Accent - Text White', 'overcome')    => 'accent text-white',
            esc_html__('Secondary', 'overcome') => 'secondary',
            esc_html__('Custom', 'overcome')    => 'custom',
        );
        return $button_colors;
    }
}

/**
 * Button Style
*/
if(!function_exists('overcome_button_style')){
    function overcome_button_style(){
        $button_type = array(
            esc_html__('Fill', 'overcome')        => 'fill',
            esc_html__('Outline', 'overcome')     => 'outline',
            esc_html__('Simple Link', 'overcome') => 'simple',
        );
        return $button_type;
    }
}
/**
 * Button Shape
*/
if(!function_exists('overcome_button_shapes')){
    function overcome_button_shapes(){
        $button_type = array(
            esc_html__('Default', 'overcome')        => '',
            esc_html__('Square', 'overcome')         => 'square',
            esc_html__('Rounded Corner', 'overcome') => 'rounded',
        );
        return $button_type;
    }
}

/**
 * Button Size
*/
if(!function_exists('overcome_button_size')){
    function overcome_button_size(){
        $button_size = array(
            esc_html__('Tiny', 'overcome')        => 'tn',
            esc_html__('Small', 'overcome')       => 'sm',
            esc_html__('Medium', 'overcome')      => 'md',
            esc_html__('Extra Medium', 'overcome')=> 'xmd',
            esc_html__('Default', 'overcome')     => 'df',
            esc_html__('Large', 'overcome')       => 'lg',
            esc_html__('Extra Large', 'overcome') => 'xlg',
        );
        return $button_size;
    }
}

/**
 * List of thumbnails size
 * @since 1.0.0
 * @author CMSSuperHeroes
 */
if(!function_exists('overcome_thumbnail_sizes')){
    function overcome_thumbnail_sizes() {
        $overcome_thumbnail_sizes = $overcome_default_thumbnail_sizes = $overcome_custom_thumbnail_sizes = array();
        $overcome_default_thumbnail_sizes = array(
            esc_html__( 'Post Thumbnail', 'overcome' )             => 'post-thumbnail',
            esc_html__( 'Medium', 'overcome' )                     => 'medium',
            esc_html__( 'Large', 'overcome' )                      => 'large',
            esc_html__( 'Full', 'overcome' )                       => 'full',
            esc_html__( 'Thumbnail', 'overcome' )                  => 'thumbnail',
        );
        $overcome_custom_thumbnail_sizes = array(
            esc_html__( 'Custom', 'overcome' )                 => 'custom',
        );

        $overcome_thumbnail_sizes = array_merge($overcome_default_thumbnail_sizes, $overcome_custom_thumbnail_sizes);

        return $overcome_thumbnail_sizes;
    }
}

/** 
 * Add new param text-align to VC param_type font_container
 * Added text-align INHERIT for get default text-align when 
 * switch LTR to RTL language
 * @author CMSSuperHeroes
 * @since 1.0.0
*/
add_filter('vc_font_container_output_data','overcome_vc_font_container_render_filter',11,4);
function overcome_vc_font_container_render_filter($data, $fields, $values, $settings){       
    if ( isset( $fields['text_align'] ) ) {
        $data['text_align'] = '
        <div class="vc_row-fluid vc_column">
            <div class="wpb_element_label">' . esc_html__( 'Text align', 'overcome' ) . '</div>
            <div class="vc_font_container_form_field-text_align-container">
                <select class="vc_font_container_form_field-text_align-select">
                    <option value="inherit" class="inherit" ' . ( 'inherit' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'Default', 'overcome' ) . '</option>
                    <option value="left" class="left" ' . ( 'left' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'left', 'overcome' ) . '</option>
                    <option value="right" class="right" ' . ( 'right' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'right', 'overcome' ) . '</option>
                    <option value="center" class="center" ' . ( 'center' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'center', 'overcome' ) . '</option>
                    <option value="justify" class="justify" ' . ( 'justify' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'justify', 'overcome' ) . '</option>
                </select>
            </div>';
        if ( isset( $fields['text_align_description'] ) && strlen( $fields['text_align_description'] ) > 0 ) {
            $data['text_align'] .= '
            <span class="vc_description clear">' . $fields['text_align_description'] . '</span>
            ';
        }
        $data['text_align'] .= '</div>';
    }
    return $data;
}

/*
 * Grid Settings 
*/
function overcome_grid_columns(){
    return array(
        esc_html__('1 Column','overcome')   => '12',
        esc_html__('2 Columns','overcome')  => '6',
        esc_html__('3 Columns','overcome')  => '4',
        esc_html__('4 Columns','overcome')  => '3',
        esc_html__('5 Columns','overcome')  => '1/5',
        esc_html__('6 Columns','overcome')  => '2',
        esc_html__('7 Columns','overcome')  => '1/7',
        esc_html__('8 Columns','overcome')  => '1/8',
        esc_html__('9 Columns','overcome')  => '1/9',
        esc_html__('10 Columns','overcome') => '1/10',
        esc_html__('11 Columns','overcome') => '1/11',
        esc_html__('12 Columns','overcome') => '1',
        esc_html__('Auto','overcome')       => 'auto',
    );
}
function overcome_grid_settings($args = array()){
    $args = wp_parse_args($args, array(
        'group'      => '',
        'param_name' => '',
        'value'      => ''
    ));
    extract($args);
    
    return array(
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Small Devices','overcome'),
            'param_name'       => 'col_sm',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => overcome_grid_columns(),
            'std'              => '12',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Medium Devices','overcome'),
            'param_name'       => 'col_md',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => overcome_grid_columns(),
            'std'              => '6',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Large Devices','overcome'),
            'param_name'       => 'col_lg',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => overcome_grid_columns(),
            'std'              => '4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Extra Large Devices','overcome'),
            'param_name'       => 'col_xl',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => overcome_grid_columns(),
            'std'              => '3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        )
    );
}
/* OWL Carousel Setting 
 * All option will use in element use OWL Carousel Libs
*/
function overcome_owl_settings( $args = array()){
    $args = wp_parse_args($args, array(
        'group'      => '',
        'param_name' => '',
        'value'      => '',
        'not_value'  => ''
    ));
    extract($args);
    return array(
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('XSmall Devices','overcome'),
            'param_name'       => 'owl_sm_items',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'std'              => 1,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Small Devices','overcome'),
            'param_name'       => 'owl_md_items',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'std'              => 2,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Medium Devices','overcome'),
            'param_name'       => 'owl_lg_items',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'std'              => 3,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Large Devices','overcome'),
            'param_name'       => 'owl_xl_items',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'std'              => 4,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => esc_html__('Number Row','overcome'),
            'description' => esc_html__( 'Choose number of row you want to show.', 'overcome' ),
            'param_name'  => 'number_row',
            'value'       => array(1,2,3,4,5,6,7,8,9,10),
            'std'         => 1,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'       => $group,
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Slide By','overcome'),
            'description' => esc_html__( 'Number/String. Navigation slide by X. "page" string can be set to slide by page.', 'overcome' ),
            'param_name'  => 'slideby',
            'value'       => 'page',
            'std'         => 'page',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'       => $group,
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Slide Transition','overcome'),
            'description' => esc_html__( 'You can define the transition for the stage you want to use eg. linear.', 'overcome' ),
            'param_name'  => 'slidetransition',
            'value'       => 'ease',
            'std'         => 'ease',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'       => $group,
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Loop Items','overcome'),
            'param_name' => 'loop',
            'std'        => 'false',
            'edit_field_class' => 'vc_col-sm-3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Center','overcome'),
            'param_name' => 'center',
            'std'        => 'false',
            'edit_field_class' => 'vc_col-sm-3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Auto Width','overcome'),
            'param_name' => 'autowidth',
            'std'        => 'false',
            'edit_field_class' => 'vc_col-sm-3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Auto Height','overcome'),
            'param_name' => 'autoheight',
            'std'        => 'true',
            'edit_field_class' => 'vc_col-sm-3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Items Space','overcome'),
            'param_name' => 'margin',
            'value'      => 30,
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Stage Padding','overcome'),
            'param_name' => 'stagepadding',
            'value'      => '0',
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Start Position','overcome'),
            'param_name' => 'startposition',
            'value'      => '0',
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        
        array(
            'type'        => 'checkbox',
            'param_name'  => 'nav',
            'value'       => array(
                esc_html__('Show Next/Preview button','overcome') => 'true'
            ),
            'std'         => 'false',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Nav Style','overcome'),
            'param_name' => 'nav_style',
            'value'      => ef5_carousel_nav_style(),
            'std'        => 'default',
            'dependency' => array(
                'element'=>'nav',
                'value'  => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Nav Position','overcome'),
            'param_name' => 'nav_pos',
            'value'      => ef5_carousel_nav_pos(),
            'std'        => 'default',
            'dependency' => array(
                'element'            => 'nav_style',
                'value_not_equal_to' => 'dot-in-nav',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Nav Color','overcome'),
            'param_name' => 'nav_color',
            'value'      => ef5_carousel_color(),
            'std'        => 'default',
            'dependency' => array(
                'element'=> 'nav',
                'value'  => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'dots',
            'value'      => array(
                esc_html__('Show Dots','overcome') => 'true'
            ),
            'std'        => 'true',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'  => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Dots Style','overcome'),
            'param_name' => 'dot_style',
            'value'      => ef5_carousel_dots_style(),
            'std'        => 'default',
            'dependency' => array(
                'element'=>'dots',
                'value'  => array('true'),
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Dots Position','overcome'),
            'param_name' => 'dot_pos',
            'value'      => ef5_carousel_dot_pos(),
            'std'        => 'default',
            'dependency' => array(
                'element'=>'dots',
                'value'  => array('true'),
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Dots Color','overcome'),
            'param_name' => 'dot_color',
            'value'      => ef5_carousel_color(),
            'std'        => 'default',
            /*'dependency' => array(
                'element'=>'dot_style',
                'value_not_equal_to'  => array('thumbnail'),
            ),*/
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Dots Thumbnail Size','overcome'),
            'description'    => esc_html__('Enter size: widthxheight','overcome'),
            'param_name' => 'dot_thumbnail_size',
            'value'      => '100',
            'dependency' => array(
                'element'=>'dot_style',
                'value'  => 'thumbnail',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'value'      => array(
                esc_html__('Auto Play','overcome') => 'true',
            ),
            'param_name' => 'autoplay',
            'std'        => 'true',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Smart Speed','overcome'),
            'param_name'  => 'smartspeed',
            'value'       => '250',
            'description' => esc_html__('Speed scroll of each item','overcome'),
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element' =>'autoplay',
                'value'   => 'true',
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Auto Play TimeOut','overcome'),
            'param_name' => 'autoplaytimeout',
            'value'      => '5000',
            'dependency' => array(
                'element' =>'autoplay',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Pause on mouse hover','overcome'),
            'param_name' => 'autoplayhoverpause',
            'std'        => 'true',
            'dependency' => array(
                'element' =>'autoplay',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
      
        array(
            'type'          => 'animation_style',
            'class'         => '',
            'heading'       => esc_html__('Animation In','overcome'),
            'param_name'    => 'owlanimation_in',
            'std'           => '',
            'settings'      => array(
                'type' => array(
                    'in'
                ),
            ),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'          => 'animation_style',
            'class'         => '',
            'heading'       => esc_html__('Animation Out','overcome'),
            'param_name'    => 'owlanimation_out',
            'std'           => '',
            'settings'      => array(
                'type' => array(
                    'out'
                ),
            ),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
    );
}
/* Call Masonry Settings */
function overcome_masonry_call_settings($atts)
{
    extract($atts);
    wp_enqueue_script('vc_masonry');
}
/**
 * VC Element Hover Effect
*/
function overcome_hover_effect(){
    return array(
        esc_html__('None','overcome')                           => 'none',
        esc_html__('Push','overcome')                           => 'push',
        esc_html__('Slide','overcome')                          => 'slide',
        esc_html__('Slide Bottom to Top','overcome')            => 'slide-top',
        esc_html__('Slide Bottom to Top with Title','overcome') => 'slide-top2',
        esc_html__('FadeIn','overcome')                         => 'fade-in',
        esc_html__('FadeIn With with Delay','overcome')         => 'fade-in delay1',
    );
}

function overcome_hover_content($args=[]){
    $args = wp_parse_args($args, [
        'dependency' => '',
        'group' => ''
    ]);
    return array(
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Overlay Background','overcome'),
            'param_name' => 'hover_bg',
            'value'      =>  array(
               esc_html__('Accent Color','overcome')  => 'accent-bg',     
               esc_html__('Primary Color','overcome') => 'primary-bg',     
               esc_html__('Custom Color','overcome')  => 'custom-bg',     
            ),
            'dependency' => $args['dependency'],
            'std'        => 'accent-bg',
            'group'      => $args['group']
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Custom Overlay Background','overcome'),
            'param_name' => 'custom_hover_bg',
            'dependency' => array(
                'element' => 'hover_bg',
                'value'   => 'custom-bg'
            ),
            'edit_field_class' => 'vc_col-sm-6',
            'group'      => $args['group']
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Custom Text Color','overcome'),
            'param_name' => 'custom_text_color',
            'dependency' => array(
                'element' => 'hover_bg',
                'value'   => 'custom-bg'
            ),
            'edit_field_class' => 'vc_col-sm-6',
            'group'      => $args['group']
        )
    );
}
/**
 * Content Alignment
*/
function overcome_vc_content_align_opts($args = []){
    $args = wp_parse_args($args, [
        'heading'    => esc_html__('Content Alignment', 'overcome'), 
        'param_name' => 'content_align', 
        'args'       => [], 
        'dependency' => [],
        'group'      => ''
    ]);
    $_args = array_merge(
        array(
            esc_html__('Default', 'overcome') => '',
            esc_html__('Start', 'overcome')   => 'text-start',
            esc_html__('End', 'overcome')     => 'text-end',
            esc_html__('Center', 'overcome')  => 'text-center',
        ),
        $args['args']
    );
    return array(
        'type'        => 'dropdown',
        'heading'     => $args['heading'],
        'param_name'  => $args['param_name'],
        'value'       => $_args,
        'std'         => '',
        'admin_label' => true,
        'dependency'  => $args['dependency'],
        'group'       => $args['group']
    );
}
/**
 * Heading Tags
*/
function overcome_heading_tag($args=[]){
    $args = array_merge(
        array(
            esc_html__('Default', 'overcome')            => '',
            esc_html__('Heading 2', 'overcome')          => 'h2',
            esc_html__('Heading 3', 'overcome')          => 'h3',
            esc_html__('Heading 4', 'overcome')          => 'h4',
            esc_html__('Heading 5', 'overcome')          => 'h5',
            esc_html__('Heading 6', 'overcome')          => 'h6',
            esc_html__('Div', 'overcome')                => 'div',
            esc_html__('Custom Size (20px)', 'overcome') => 'h4-1',
        ),
        $args
    );
    return $args;
}
function overcome_heading_font_weight(){
    return array(
        esc_html__('Default','overcome')            => '',
        esc_html__('Thin','overcome')               => '100',
        esc_html__('Thin Italic','overcome')        => '100i',
        esc_html__('Extra-Light','overcome')        => '200',
        esc_html__('Extra-Light Italic','overcome') => '200i',
        esc_html__('Light','overcome')              => '300',
        esc_html__('Light Italic','overcome')       => '300i',
        esc_html__('Regular','overcome')            => '400',
        esc_html__('Regular Italic','overcome')     => '400i',
        esc_html__('Medium','overcome')             => '500',
        esc_html__('Medium Italic','overcome')      => '500i',
        esc_html__('Semi-Bold','overcome')          => '600',
        esc_html__('Semi-Bold Italic','overcome')   => '600i',
        esc_html__('Bold','overcome')               => '700',
        esc_html__('Bold Italic','overcome')        => '700i',
        esc_html__('Extra-Bold','overcome')         => '800',
        esc_html__('Extra-Bold Italic','overcome')  => '800i',
        esc_html__('Black','overcome')              => '900',
        esc_html__('Black Italic','overcome')       => '900i',
    );
}
function overcome_heading_font_style(){
    return array(
        esc_html__('Default','overcome') => '',
        esc_html__('Normal','overcome')  => 'normal',
        esc_html__('Italic','overcome')  => 'italic'
    );
}
function overcome_heading_text_transform(){
    return array(
        esc_html__('Default','overcome')    => '',
        esc_html__('Uppercase','overcome')  => 'uppercase',
        esc_html__('Capitalize','overcome') => 'capitalize',
        esc_html__('Lowercase','overcome')  => 'lowercase',
        esc_html__('Unset','overcome')      => 'unset'
    );
}

function overcome_bg_color(){
    return array(
        esc_html__('Default','overcome')                => 'ef5-bg',
        esc_html__('Accent Color','overcome')           => 'ef5-bg-accent',
        esc_html__('Darken Accent Color','overcome')    => 'ef5-bg-darken-accent',
        esc_html__('Primary Color','overcome')          => 'ef5-bg-primary',
        esc_html__('Secondary Color','overcome')        => 'ef5-bg-secondary',
        esc_html__('Medium Dark (#1F1F1F)','overcome')  => 'ef5-bg-medium-dark',
        esc_html__('Light Dark (#303030)','overcome')   => 'ef5-bg-light-dark',
        esc_html__('Dark (#000)','overcome')            => 'ef5-bg-dark',
        esc_html__('Medium Light (#f1f1f1)','overcome') => 'ef5-bg-medium-light',
        esc_html__('Light (#f5f5f5)','overcome')        => 'ef5-bg-light',
        esc_html__('Dark Blue (#182333)','overcome')    => 'ef5-bg-dark-blue',
        esc_html__('White (#ffffff)','overcome')        => 'ef5-bg-white',
    );
}

function overcome_bg_style(){
    return array(
        esc_html__('Default','overcome')     => '',
        esc_html__('Space Left','overcome')  => 'ef5-bg-space-left',
        esc_html__('Space Right','overcome') => 'ef5-bg-space-right',
    );
}

if(!function_exists('overcome_theme_colors')){
    function overcome_theme_colors($default = false, $custom = false){
        $_default = $_custom = [];
        if($default) $_default[esc_html__('Default','overcome')] =  '';
        if($custom) $_custom[esc_html__('Custom Color','overcome')] =  'custom';

        $theme_color =  array(
            esc_html__('Accent','overcome')        => 'accent',
            esc_html__('Accent 2','overcome')      => 'accent2',
            esc_html__('Accent Dark','overcome')   => 'darken-accent',
            esc_html__('Primary','overcome')       => 'primary',
            esc_html__('Dark','overcome')          => 'dark',
            esc_html__('Cyan','overcome')          => 'cyan',
            esc_html__('Cyan Dark','overcome')     => 'cyan-dark',
            esc_html__('Green','overcome')         => 'green',
            esc_html__('Green Dark','overcome')    => 'green-dark',
            esc_html__('Blue','overcome')          => 'blue',
            esc_html__('Blue Dark','overcome')     => 'blue-dark',
            esc_html__('Violet','overcome')        => 'violet',
            esc_html__('Violet Dark','overcome')   => 'violet-dark',
            esc_html__('Cello','overcome')         => 'cello',
            esc_html__('Cello Dark','overcome')    => 'cello-dark',
            esc_html__('Yellow','overcome')        => 'yellow',
            esc_html__('Yellow Dark','overcome')   => 'yellow-dark',
            esc_html__('Orange','overcome')        => 'orange',
            esc_html__('Orange Dark','overcome')   => 'orange-dark',
            esc_html__('Red','overcome')           => 'red',
            esc_html__('Red Dark','overcome')      => 'red-dark',
            esc_html__('Grey','overcome')          => 'grey',
            esc_html__('Grey Dark','overcome')     => 'grey-dark',
            esc_html__('Gray','overcome')          => 'gray',
            esc_html__('Gray Dark','overcome')     => 'gray-dark',
            esc_html__('White','overcome')         => 'white'
        );

        return array_merge($_default, $theme_color, $_custom);
    }
}

/**
 * Get Page List 
 * @return array
*/
if(!function_exists('overcome_vc_list_page')){
    function overcome_vc_list_page($args = []){
        $args = wp_parse_args($args, [
            'default' => true
        ]);
        $page_list = array();
        if($args['default'] === true )$page_list[esc_html__('Default','overcome')] = '';
        $pages = get_pages(array('hierarchical' => 0, 'posts_per_page' => '-1'));
        foreach($pages as $page){
            $page_list[$page->post_title] = $page->ID;
        }
        return $page_list;
    }
}


class OverCome_VcSharedLibrary extends VcSharedLibrary{
    /**
     * Round box styles
     *
     * @var array
     */
    public function __construct(){
        parent::$round_box_styles = array(
            'Round'               => 'vc_box_rounded',
            'Round Border'        => 'vc_box_border_rounded',
            'Round Outline'       => 'vc_box_outline_rounded',
            'Round Shadow'        => 'vc_box_shadow_rounded',
            'Round Border Shadow' => 'vc_box_shadow_border_rounded',
        );
    }
}
new OverCome_VcSharedLibrary();


/**
 * Get Contact Form 7 List
 * @return array
*/
if(!function_exists('overcome_vc_get_list_cf7')){
    function overcome_vc_get_list_cf7() {
        if(!class_exists('WPCF7')) return;
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
        $contact_forms = [];
        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->post_title;
        }
        return $contact_forms;
    }
}

/**
 * Default value
 * @param $param
 * @param $default
 * @return 
*/
function overcome_default_value($param, $default){
    return !empty($param) ? $param : $default;
}
/**
 * Custom Animation
*/
function overcome_vc_map_add_css_animation( $args = [] ) {
    $args = wp_parse_args($args,[
        'heading'    => esc_html__( 'CSS Animation', 'overcome' ),
        'description'=> esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'overcome' ),
        'label'      => false,
        'type'       => ['in'],
        'param_name' => 'css_animation',
        'group'      => '',
        'value'      => 'fadeInUp',
        'dependency' => ''
    ]);
    $data = array(
        'type'        => 'animation_style',
        'heading'     => $args['heading'],
        'description' => '',
        'param_name'  => $args['param_name'],
        'value'       => $args['value'],
        'std'         => $args['value'],
        'settings'    => array(
            'type'   => array('in'),
            'custom' => array(
                array(
                    'label'  => esc_html__( 'Default', 'overcome' ),
                    'values' => array(
                        esc_html__( 'Top to bottom', 'overcome' )      => 'top-to-bottom',
                        esc_html__( 'Bottom to top', 'overcome' )      => 'bottom-to-top',
                        esc_html__( 'Left to right', 'overcome' )      => 'left-to-right',
                        esc_html__( 'Right to left', 'overcome' )      => 'right-to-left',
                        esc_html__( 'Appear from center', 'overcome' ) => 'appear',
                    ),
                ),
            )
        ),
        'dependency'  => $args['dependency'],
        'group'       => $args['group'],
        'admin_label' => $args['label'],
    );
    return apply_filters( 'vc_map_add_css_animation', $data, $args );
}
