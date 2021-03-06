<?php
vc_map(array(
    'name'        => 'OverCome Quick Contact',
    'base'        => 'ef5_quickcontact',
    'category'    => esc_html__('OverCome', 'overcome'),
    'description' => esc_html__('Add your quick contact info', 'overcome'),
    'icon'        => 'icon-wpb-wp',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/qc-1.png',
                    '2' => get_template_directory_uri().'/vc_elements/layouts/qc-2.png',
                    '3' => get_template_directory_uri().'/vc_elements/layouts/qc-3.png',
                    '4' => get_template_directory_uri().'/vc_elements/layouts/qc-4.png',
                ),
                'std'        => '1',
                'admin_label' => true,
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Text Color','overcome'),
                'param_name'    => 'content_color',
                'value'         => ef5systems_colors_option_for_vc(),
                'std'           => '',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Icon Color','overcome'),
                'param_name'    => 'icon_color',
                'value'         => ef5systems_colors_option_for_vc(),
                'std'           => '',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Horizontal alignment','overcome'),
                'param_name'    => 'content_align',
                'value'         => ef5systems_alignment_option_for_vc(),
                'std'           => '',
                'dependency'    => array(
                    'element' => 'layout_template',
                    'value'   => array('1')
                )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','overcome'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'overcome'),
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
            // Contact Image
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Add your Image','overcome'),
                'param_name' => 'img_id',
                'value'      => '',
                'dependency' => array(
                    'element' => 'layout_template',
                    'value'   => array('3')
                ),
                'group'     => 'Contact Info'
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Images size','overcome'),
                'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large","post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave blank to use default','overcome'),
                'param_name'    => 'img_size',
                'value'         => '',
                'std'           => '',
                'dependency' => array(
                    'element'   => 'img_id',
                    'not_empty' => true
                ),
                'group'         => esc_html__('Contact Info','overcome'),
            ),
            // Contact Title
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Title','overcome'),
                'param_name' => 'el_title',
                'value'      => '',
                'dependency' => array(
                    'element' => 'layout_template',
                    'value'   => array('2','3','4')
                ),
                'group'     => 'Contact Info',
                'holder'    => 'h3'    
            ),
            // Contact Info
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add your info', 'overcome' ),
                'param_name' => 'values',
                'value' => urlencode( json_encode( array(
                    array(
                        'i_type'             => 'overcome',
                        'i_icon_overcome'    => 'flaticon-call-answer',
                        'qc_heading'         => 'Call Us:',
                        'qc_text'            => '(+123) 888 666',
                    )
                ) ) ),
                'params'     => array_merge(
                    ef5systems_icon_libs(),
                    ef5systems_icon_libs_icon(),
                    array(
                        array(
                            'type'        => 'textarea',
                            'heading'     => esc_html__( 'Heading', 'overcome' ),
                            'param_name'  => 'qc_heading',
                            'admin_label' => true,
                        ),
                        array(
                            'type'        => 'textarea',
                            'heading'     => esc_html__( 'Text', 'overcome' ),
                            'param_name'  => 'qc_text',
                            'admin_label' => true,
                        ),
                    )
                ),
                'group'     => 'Contact Info'
            ),
            array(
                'type'        => 'textarea',
                'param_name'  => 'map_address',
                'heading'     => esc_html__('Address for map','overcome'),
                'description' => esc_html__('Add your address','overcome'),
                'value'       => '20, First Avenue, San Jose, USA',
                'std'        => '20, First Avenue, San Jose, USA',
                'dependency' => array(
                    'element' => 'layout_template',
                    'value'   => array('2','3','4')
                ),
                'group'       => esc_html__('Maps','overcome')
            ),
            array(
                'type'        => 'vc_link',
                'param_name'  => 'get_direction',
                'heading'     => esc_html__('Direction with Map','overcome'),
                'description' => esc_html__('Add your map','overcome'),
                'value'       => 'title:Get Direction||url:google.com/maps/dir//Bobst+Library,+70+Washington+Square+S,+New+York,+NY+10012,+USA/@40.7291313,-73.9972548,18.22z/data=!4m8!4m7!1m0!1m5!1m1!1s0x89c2599051e43f09:0x73708ab233ccf977!2m2!1d-73.9971753!2d40.7294556||target:_blank',
                'dependency' => array(
                    'element' => 'layout_template',
                    'value'   => array('2','3','4')
                ),
                'group'       => esc_html__('Maps','overcome')
            )
        )
    )
));

class WPBakeryShortCode_ef5_quickcontact extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );
        return parent::content($atts, $content);
    }
    protected function overcome_qc_item_render($atts, $value){
        extract($atts);
        $item_class = ['qc-item'];
        $item_inner_class = ['row'];
        $item_row_class = ['row'];
        switch ($layout_template) {
            case '1':
                $item_class[] = 'col-12';
                $item_inner_class[] = 'gutters-10 align-items-center';
            break;
            case '2':
                $item_class[] = 'col-12';
                $item_row_class[] = 'gutters-5';
            break;
            default :
                $item_class[] = 'col-12';
                $item_row_class[] = 'gutters-20';
            break;
        }
        $icon_color = !empty($icon_color) ? $icon_color : '';
        $icon_classes = ['qc-icon', $icon_color];

        vc_icon_element_fonts_enqueue( $value['i_type'] );
        $iconClass  = isset($value['i_icon_'. $value['i_type']]) ? $value['i_icon_'. $value['i_type']] : '';
        $qc_icon    = !empty($iconClass) ? '<span class="'.overcome_optimize_css_class(implode(' ', $icon_classes)).' '.$iconClass.'"></span>' : '';
        $qc_heading = isset($value['qc_heading']) && !empty($value['qc_heading']) ? $value['qc_heading'] : '';
        $qc_text    = isset($value['qc_text']) ? $value['qc_text'] : '';

        echo '<div class="'.overcome_optimize_css_class(implode(' ', $item_class)).'">';
            echo '<div class="'.overcome_optimize_css_class(implode(' ', $item_inner_class)).'">';
                if(!empty($iconClass)) echo '<div class="col-auto">'.overcome_html($qc_icon).'</div>';
                echo '<div class="col"><div class="'.overcome_optimize_css_class(implode(' ', $item_row_class)).'">';
                    echo '<div class="qc-item-heading col-auto">'.overcome_html($qc_heading).'</div>';
                    if(!empty($qc_text)) echo '<div class="qc-text col">'.overcome_html($qc_text).'</div>';
                echo '</div></div>';
            echo '</div>';
        echo '</div>';
    }
    protected function overcome_qc_direction($atts, $args=[]){
        extract($atts);
        if(!in_array($layout_template, ['2','3','4'])) return;
        $args = wp_parse_args($args, [
            'class' => '',
            'icon' => 'flaticon-right-arrow-forward'
        ]);
        $icon = !empty($args['icon']) ? '<span class="icon '.$args['icon'].'"></span>' : '';
        $wrap_css_class = ['qc-direction', 'col-12', $args['class']];
        // Get Direction
        $use_link = false;
        $get_direction = '';
        if(!empty($atts['get_direction'])){
            $button_link = vc_build_link( $atts['get_direction'] );
            $button_link = ( $button_link == '||' ) ? '' : $button_link;
            if ( strlen( $button_link['url'] ) > 0 ) {
                $use_link = true; 
                $a_href = $button_link['url'];
                $a_title = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read More','overcome') ;
                $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
                // Button for layout 4
                $get_direction = '<div class="qc-direction"><a class="ef5-text-accent transition ef5-scroll" href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'"><span class="title">'.esc_html($a_title).'&nbsp;&nbsp;</span> <span class="flaticon-right-arrow"></span></a></div>';
            }
        }
        if(!$use_link) return;
        ?>
            <div class="<?php echo trim(implode(' ', $wrap_css_class)); ?>">
                <div class="qc-address"><?php echo overcome_html($map_address); ?></div>
                <a class="ef5-text-accent transition ef5-scroll" href="<?php echo esc_url($a_href);?>" target="<?php echo esc_attr($a_target);?>">
                    <span class="title"><?php echo esc_html($a_title);?></span>
                    <?php echo overcome_html($icon); ?>
                </a>
            </div>
        <?php
    }

    protected function overcome_qc_image($atts, $args=[]){
        extract($atts);
        if($layout_template !== '3' || empty($img_id)) return;
        $args = wp_parse_args($args, [
            'class' => '',
            'img_size' => overcome_default_value($img_size, '270x360')
        ]);
        overcome_image_by_size([
            'id'     => $img_id, 
            'size'   => $args['img_size'],
            'class'  => 'image-fit',
            'before' =>'<div class="qc-image">',
            'after'  => '</div>'
        ]);
    }
}