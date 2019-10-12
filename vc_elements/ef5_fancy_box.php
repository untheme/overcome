<?php
vc_map(array(
    'name'        => 'OverCome Fancy Box',
    'base'        => 'ef5_fancy_box',
    'category'    => esc_html__('OverCome', 'overcome'),
    'description' => esc_html__('Add fancy boxes', 'overcome'),
    'icon'        => 'icon-wpb-ui-icon',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','overcome'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/fancy-box1.png',
                ),
                'std'        => '1',
                'admin_label' => true
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Background Color','overcome'),
                'param_name'  => 'bg_color',
                'value'       => ef5systems_colors_option_for_vc(),
                'std'         => 'ef5-bg',
                'description' => esc_html__('Choose your box background color','overcome'),
                'dependency'  => array(
                    'element' => 'layout_template',
                    'value'   => array('6')
                )
            ),
	        array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Element Class','overcome'),
				'param_name' => 'el_class',
				'std'		 => ''
			)
        ),
        // Content
        array(
        	array(
        		'type'       => 'textarea',
                'heading'    => esc_html__('Heading','overcome'),
                'param_name' => 'heading',
                'value'      => 'CMS Fancy Icon Box',
                'holder' 	 => 'h3',
                'group'	     => esc_html__('Content','overcome')	
        	),
        	array(
        		'type'       => 'textarea',
                'heading'    => esc_html__('Description','overcome'),
                'param_name' => 'desc',
                'value'      => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit sit amet justo Suspendisse et justo.',
                'holder' 	 => 'div',
                'group'	     => esc_html__('Content','overcome')	
        	),
        	array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('Choose your link','overcome'),
				'param_name' => 'button_link',
	            'group'	     => esc_html__('Content','overcome')
		    )
        ),
        // Icon
        array(
        	array(
        		'type'       => 'dropdown',
                'param_name' => 'add_icon',
                'heading'    => esc_html__('Add Icon?','overcome'),
                'value'      => array(
                    esc_html__('None','overcome')          => 'none',
                    esc_html__('Font Icon?','overcome')    => 'true',
                    esc_html__('Image Icon?','overcome')   => 'image',
                    esc_html__('Upload Icon ?','overcome') => 'upload'
                ),
                'std'		 => 'true',
                'group'	     => esc_html__('Icon','overcome')
        	),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Choose our existing image','overcome'),
                'param_name' => 'icon_existing',
                'value'      =>  array(
                    '1'   => get_template_directory_uri().'/vc_elements/icons/1.png',
                ),
                'std'        => '',
                'dependency' => array(
                    'element' => 'add_icon',
                    'value'   => 'image',
                ),
                'group'      => esc_html__('Icon','overcome'),
                'edit_field_class' => 'ef5-vc-list-icon'
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Upload your own image?','overcome'),
                'param_name' => 'icon_upload',
                'value'      => '',
                'std'        => '',
                'dependency' => array(
                    'element' => 'add_icon',
                    'value'   => 'upload',
                ),
                'group'      => esc_html__('Icon','overcome')
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Icon Size','overcome'),
                'description'   => esc_html__('Enter image size defined by theme (Example: "thumbnail", "medium", "large","post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','overcome'),
                'param_name'    => 'icon_size',
                'value'         => '60',
                'std'           => '60',
                'group'         => esc_html__('Image', 'overcome'),
                'dependency'    => array(
                  'element'   => 'icon_upload',
                  'not_empty' => true,
                ),
            ),
        ),
        // icon list 
        ef5systems_icon_libs(),
        ef5systems_icon_libs_icon()
    )
));
class WPBakeryShortCode_ef5_fancy_box extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		/* Call icon font stylesheet */
		vc_icon_element_fonts_enqueue( $atts['i_type'] );
        return parent::content($atts, $content);
    }
    protected function ef5_fancy_box_icon($atts, $args=[]){
        extract($atts);
        if($add_icon === 'none') return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-fancybox-icon', 'transition', $args['class']];
        $icon_name = "i_icon_" . $i_type;
        $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name]: '';
        if(empty($iconClass)) return;
        ?>
            <div class="<?php echo trim(implode(' ', $icon_css_class));?>" <?php echo overcome_html($iconStyle);?>>
                <?php switch ($add_icon) {
                    case 'upload':
                        overcome_image_by_size([
                            'id'    => $icon_upload,
                            'size'  => $icon_size,
                            'class' => 'ef5-pricing-img'
                        ]);
                        break;
                    case 'image':
                ?>
                    <img src="<?php echo esc_url(get_template_directory_uri().'/vc_elements/icons/png/'.$icon_existing.'.png');?>" alt="<?php echo esc_attr($heading);?>">
                <?php
                        break;
                    default:
                ?>
                    <span class="<?php echo esc_attr($iconClass); ?>"></span>
                <?php
                        break;
                } 
                ?>
            </div>
        <?php
    }
    protected function ef5_fancy_box_heading($atts, $args=[]){
        extract($atts);
        if(empty($heading)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-heading','ef5-fancybox-heading', $args['class']];
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>"><?php echo overcome_html($heading); ?></div>
        <?php
    }
    protected function ef5_fancy_box_desc($atts, $args=[]){
        extract($atts);
        if(empty($desc)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-fancybox-desc', $args['class']];
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>"><?php echo overcome_html($desc); ?></div>
        <?php
    }
    protected function ef5_fancy_box_link($atts, $args=[]){
        extract($atts);
        /* parse button link */
        $use_link = false;
        if(!empty($atts['button_link'])){
            $button_link = vc_build_link( $atts['button_link'] );
            $button_link = ( $button_link == '||' ) ? '' : $button_link;
            if ( strlen( $button_link['url'] ) > 0 ) {
                $use_link = true; 
                $a_href = $button_link['url'];
                $a_title = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read more','unbreak') ;
                $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
            }
        }
        if(!($use_link)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_classes = ['ef5-fancybox-link', $args['class']];
        ?>
            <div class="<?php echo trim(implode(' ', $css_classes));?>">
                <a href="<?php echo esc_url($a_href) ?>" target="<?php echo esc_attr($a_target);?>">
                    <?php echo esc_html($a_title);?>
                </a>
            </div>
        <?php
    }
}