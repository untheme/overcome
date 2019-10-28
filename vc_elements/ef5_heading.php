<?php
vc_map(array(
    'name'        => 'OverCome Heading',
    'base'        => 'ef5_heading',
    'category'    => esc_html__('OverCome', 'overcome'),
    'description' => esc_html__('Add your custom heading', 'overcome'),
    'icon'        => 'icon-wpb-ui-custom_heading',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'  => get_template_directory_uri().'/vc_elements/layouts/heading-1.png',
                    '2'  => get_template_directory_uri().'/vc_elements/layouts/heading-2.png',
                    '3'  => get_template_directory_uri().'/vc_elements/layouts/heading-3.png',
                ),
                'std'              => '1',
                'admin_label'      => true,
                'edit_field_class' => 'ef5-select-img-2col'
            ),
            ef5systems_content_align_option_for_vc(),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Element Class','overcome'),
                'param_name' => 'el_class',
                'value'      => '',
                'std'        => ''
            ),
            // Small Heading 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','overcome'),
                'param_name' => 'small_heading_text',
                'value'      => 'Small Heading',
                'std'        => 'Small Heading',
                'holder'     => 'div',
                'group'      => esc_html__('Small Heading','overcome'),
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'small_css_animation',
                'group'      => esc_html__('Small Heading','overcome'),
                'dependency' => array(
                    'element'   => 'small_heading_text',
                    'not_empty' => true
                ),
            ]),
            // Heading 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','overcome'),
                'param_name' => 'heading_text',
                'value'      => 'This is OverCome custom heading element',
                'std'        => 'This is OverCome custom heading element',
                'holder'     => 'h4',
                'group'      => esc_html__('Heading','overcome')   
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'add_heading_icon',
                'value'      => array(
                    esc_html__('Add icon?','overcome') => 'true'
                ),
                'std'        => 'false',
                'group'      => esc_html__('Heading','overcome')   
            ),
            // Text Color
            array(
                'type'         => 'dropdown',
                'heading'      => esc_html__( 'Text Color', 'overcome' ),
                'param_name'   => 'text_color_opts',
                'value'        => ef5systems_colors_option_for_vc([
                    esc_html__('Custom','overcome') => 'custom'
                ]),
                'std'          => '',
                'description'  => esc_html__( 'Choose color for this row', 'overcome' ),
                'group'        => esc_html__('Theme Custom','overcome'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type'         => 'colorpicker',
                'heading'      => esc_html__( 'Custom Text Color', 'overcome' ),
                'param_name'   => 'text_color',
                'description'  => esc_html__( 'Choose your color for this row', 'overcome' ),
                'dependency' => array(
                    'element'   => 'text_color_opts',
                    'value'     => 'custom'
                ),
                'group'        => esc_html__('Theme Custom','overcome'),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        ),
        ef5systems_icon_libs([
            'dependency'        => 'add_heading_icon',
            'dependency_option' => 'value',
            'dependency_value'  => 'true',
            'group'             => esc_html__('Heading','overcome') 
        ]),
        ef5systems_icon_libs_icon([
            'group'             => esc_html__('Heading','overcome') 
        ]),
        array(
            // Heading part 2 
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_heading2',
                'value'      => array(
                    esc_html__('Show Heading Part 2','overcome') => '1',
                ),
                'std'        => '0',
                'group'      => esc_html__('Heading','overcome'),
                'dependency' => array(
                    'element'   => 'heading_text',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','overcome'),
                'param_name' => 'heading2_text',
                'dependency' => array(
                    'element' => 'show_heading2',
                    'value'   => array('1')
                ),
                'holder'     => 'h4',
                'group'      => esc_html__('Heading','overcome')   
            ),
            // Heading Part 3
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_heading3',
                'value'      => array(
                    esc_html__('Show Heading Part 3','overcome') => '1',
                ),
                'std'        => '0',
                'group'      => esc_html__('Heading','overcome'),
                'dependency' => array(
                    'element'   => 'heading_text',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','overcome'),
                'param_name' => 'heading3_text',
                'dependency' => array(
                    'element' => 'show_heading3',
                    'value'   => array('1')
                ),
                'holder'     => 'h4',
                'group'      => esc_html__('Heading','overcome')   
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'heading_css_animation',
                'group'      => esc_html__('Heading','overcome'),
                'dependency' => array(
                    'element'   => 'heading_text',
                    'not_empty' => true
                ),
            ]),
            // Sub Heading 
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Text','overcome'),
                'param_name' => 'subheading_text',
                'value'      => 'Sub Heading',
                'std'        => 'Sub Heading',
                'holder'     => 'h3',
                'group'      => esc_html__('Sub Heading','overcome')
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'subheading_text_css_animation',
                'group'      => esc_html__('Sub Heading','overcome'),
                'dependency' => array(
                    'element'   => 'subheading_text',
                    'not_empty' => true
                )
            ]),
            // Description 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','overcome'),
                'param_name' => 'desc_text',
                'value'      => 'This is OverCome custom description. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo.',
                'holder'     => 'div',
                'group'      => esc_html__('Description','overcome'),
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'desc_text_css_animation',
                'group'      => esc_html__('Description','overcome'),
                'dependency' => array(
                    'element'   => 'desc_text',
                    'not_empty' => true
                )
            ]),
            // Link 
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__('Link','overcome'),
                'description'=> esc_html__('Add your custom link','overcome'),
                'param_name' => 'button_link',
                'group'      => esc_html__('Link','overcome')
            ),
            ef5systems_vc_map_add_css_animation([
                'param_name' => 'button_link_css_animation',
                'group'      => esc_html__('Link','overcome')
            ]),
        )
    )
));
class WPBakeryShortCode_ef5_heading extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
    protected function overcome_heading_wrap_css_class($atts, $class = ''){
        extract( $atts );
        $wrap_css_class = ['ef5-heading-wrap','ef5-heading-'.$layout_template, $content_align, $class, $el_class];
        echo trim(implode(' ', $wrap_css_class));
    }
    protected function ef5_heading_small_heading($atts,$args = []){
        if(empty($atts['small_heading_text'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        $small_heading_attrs = $small_heading_css = [];
        $small_heading_css_class = [
            'small-heading',
            $args['class']
        ];
        $small_heading_attrs[] = 'class="'.trim(implode(' ', $small_heading_css_class)).'"';
    ?>
        <div <?php echo trim(implode(' ', $small_heading_attrs));?>><?php 
            echo overcome_html($small_heading_text); 
        ?></div>
    <?php
    }
    protected function ef5_heading_main_heading($atts,$args = []){
        if(empty($atts['heading_text'])) return;
        $args = wp_parse_args($args, [
            'class'      => '',
            'icon_class' => '',
            'icon_tag'   => 'span'
        ]);
        extract( $atts );
        if(!empty($heading2_text)) $heading2_text = '<span class="part2">'.$heading2_text.'</span>';
        if(!empty($heading3_text)) $heading3_text = '<span class="part3">'.$heading3_text.'</span>';

        $heading_string = trim(implode(' ',[$heading_text, $heading2_text, $heading3_text]));
        // Heading 
        $heading_attrs = $heading_css = [];

        $heading_css_class = [
            'main-heading',
            $args['class']
        ];
        
        $heading_attrs[] = 'class="'.trim(implode(' ', $heading_css_class)).'"';
        ?>
            <div <?php echo trim(implode(' ', $heading_attrs));?>><?php 
                echo overcome_html($heading_string);
                $this->ef5_heading_heading_icon($atts,[
                    'class' => $args['icon_class'],
                    'tag'   => $args['icon_tag']  
                ]);
            ?></div>
        <?php 
    }
    protected function ef5_heading_main_heading_icon($atts, $args=[]){
        extract($atts);
        if(empty($atts['heading_text']) || $atts['layout_template'] !== '3' || $atts['add_heading_icon'] === 'false') return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-heading-icon', $args['class']];
        $icon_name = "i_icon_" . $i_type;
        $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name]: '';
        if(empty($iconClass)) return;
        vc_icon_element_fonts_enqueue($i_type);
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>">
                <span class="<?php echo esc_attr($iconClass); ?>"></span>
            </div>
        <?php
    }
    protected function ef5_heading_heading_icon($atts, $args=[]){
        extract($atts);
        if(empty($atts['heading_text']) || $atts['layout_template'] === '3' || $atts['add_heading_icon'] === 'false') return;
        $args = wp_parse_args($args,[
            'class' => '',
            'tag'   => 'span'
        ]);
        $css_classes = ['ef5-heading-icon', $args['class']];
        $icon_name = "i_icon_" . $i_type;
        $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name]: '';
        if(empty($iconClass)) return;
        vc_icon_element_fonts_enqueue($i_type);
        $styles = (!empty($text_color_opts) && !empty($text_color)) ? 'style="color:'.$text_color.'"' : '';
        ?>
            <<?php echo overcome_html($args['tag']);?> class="<?php echo trim(implode(' ', $css_classes));?>" <?php echo overcome_html($styles);?>>
                <span class="<?php echo esc_attr($iconClass); ?>"></span>
            </<?php echo overcome_html($args['tag']);?>>
        <?php
    }
    protected function ef5_heading_sub_heading($atts,$args = []){
        if(empty($atts['subheading_text'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        // SubHeading
        $subheading_attrs = [];
        $subheading_css_class = [
            'subheading',
            $args['class']
        ];
        $subheading_attrs[] = 'class="'.trim(implode(' ', $subheading_css_class)).'"';
        ?>
            <div <?php echo implode(' ', $subheading_attrs);?>><?php 
                echo overcome_html($subheading_text); 
            ?></div>
        <?php
    }
    protected function ef5_heading_desccription($atts,$args = []){
        if(empty($atts['desc_text'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract( $atts );
        // Description 
        $desc_attrs = [];
        $desc_css_class = [
            'desc',
            $args['class']
        ];
        $desc_attrs[] = 'class="'.trim(implode(' ', $desc_css_class)).'"';
        ?>
            <div <?php echo trim(implode(' ', $desc_attrs));?>><?php 
                echo overcome_html($desc_text);
            ?></div>
        <?php
    }
    protected function ef5_heading_button($atts,$args = []){
        $args = wp_parse_args($args, [
            'before' => '<div class="ef5-heading-btn">',
            'after'  => '</div>',
            'class'  => ''
        ]);
        extract( $atts );
        //  Button Link
        $use_link = false;
        $button_link = vc_build_link( $atts['button_link'] );
        $button_link = ( $button_link == '||' ) ? '' : $button_link;
        if ( strlen( $button_link['url'] ) > 0 ) {
            $use_link = true; 
            $a_href   = $button_link['url'];
            $a_title  = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read More','overcome') ;
            $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
        }
        if(!$use_link) return;
            $html = $args['before'];
                $html .= '<a href="'.esc_url($a_href).'" class="'.$args['class'].'" target="'.esc_attr($a_target).'">'.$a_title.'</a>';
            $html .= $args['after'];
            echo overcome_html($html);
    }
}