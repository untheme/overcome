<?php
vc_map(array(
    'name'        => 'OverCome Clients',
    'base'        => 'ef5_clients',
    'category'    => esc_html__('OverCome', 'overcome'),
    'description' => esc_html__('Add clients image with custom link', 'overcome'),
    'icon'        => '',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'         => get_template_directory_uri().'/vc_extends/layouts/client-logo1.png',
                ),
                'std'        => '1',
                'admin_label' => true
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Hover Style','overcome'),
                'param_name' => 'hover_style',
                'value'      =>  array(
                    esc_html__('Grow Up','overcome')    => 'grow-up',
                    esc_html__('Slide Up','overcome')   => 'slide-up',
                    esc_html__('Slide Down','overcome') => 'slide-down',
                    esc_html__('Fade in','overcome')    => 'fade-in',
                ),
                'std'        => 'grow-up',
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
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','overcome'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'overcome'),
            ),
            /* Clients Settings */
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Client image size','overcome'),
                'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','overcome'),
                'param_name'    => 'thumbnail_size',
                'value'         => '210',
                'std'           => '210',
                'group'         => esc_html__('Clients','overcome'),
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Add Clients', 'overcome' ),
                'param_name' => 'values',
                'value'      =>  urlencode( json_encode( array(
                    array(
                        'image_link' => 'title:Client 1||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 2||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 3||url:#||target="_blank"',
                    ),
                    array(
                        'image_link' => 'title:Client 4||url:#||target="_blank"',
                    )
                ))),
                'params'     => array(
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__( 'Client Image', 'overcome' ),
                        'param_name'  => 'image',
                        'admin_label' => true,
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__( 'Client Image on Hover', 'overcome' ),
                        'param_name'  => 'image_hover',
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
                        'type'        => 'vc_link',
                        'heading'     => esc_html__( 'Link', 'overcome' ),
                        'param_name'  => 'image_link',
                        'description' => esc_html__( 'Enter link for image.', 'overcome' ),
                    ),
                ),
                'group'     => 'Clients'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Style','overcome'),
                'param_name' => 'layout_style',
                'value'      =>  array(
                    esc_html__('Grid','overcome')     => 'grid',
                    esc_html__('Carousel','overcome') => 'carousel'
                ),
                'std'        => 'grid',
                'group'      => esc_html__('Layout Settings','overcome'),
            )
        ),
        /* Grid settings */
        ef5systems_grid_settings(array(
            'group'                  => esc_html__('Layout Settings','overcome'), 
            'dependency_element'     => 'layout_style', 
            'dependency_value_value' => 'grid'
            )
        ),
        /* Carousel Settings */
        ef5systems_owl_settings(array(
            'group'      => esc_html__('Layout Settings','overcome'), 
            'param_name' => 'layout_style', 
            'value'      => 'carousel'
            )
        )
    )
));

class WPBakeryShortCode_ef5_clients extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
    protected function overcome_clients_wrap_css_class($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => '',
            'echo'  => true
        ]);
        $el_id = !empty($el_id) ? $el_id : uniqid();
        $wrap_css_class = ['ef5-clients', $args['class'], 'ef5-clients-'.$el_id];

        if($args['echo']){
            echo trim(implode(' ', $wrap_css_class));
        } else {
            return trim(implode(' ', $wrap_css_class));
        }
    }
    protected function overcome_clients_css_class($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => '',
            'echo'  => true
        ]);
        $el_id = !empty($el_id) ? $el_id : uniqid();
        $wrap_css_class = [];
        switch ($layout_template) {
            case 'carousel':
                $wrap_css_class[] = 'ef5-owl';
                break;
            
            default:
                $wrap_css_class[] = 'ef5-grid row justify-content-center align-items-center';
                break;
        }
        if($args['echo']){
            echo trim(implode(' ', $wrap_css_class));
        } else {
            return trim(implode(' ', $wrap_css_class));
        }
    }
    protected function overcome_clients_item_css_class($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, [
            'class' => '',
            'echo'  => true
        ]);
        $item_css_class = ['ef5-item ef5-client', $args['class']];
        switch ($layout_template) {
            case 'carousel':
                $item_css_class[] = 'ef5-carousel-item';
                break;
            
            default:
                $item_css_class[] = 'ef5-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
                break;
        }
        
        if($args['echo']){
            echo trim(implode(' ', $item_css_class));
        } else {
            return trim(implode(' ', $item_css_class));
        }
    }
    protected function overcome_client_render($atts, $args = []){
        $clients = vc_map_get_attributes( $this->getShortcode(), $atts );
        $values = (array) vc_param_group_parse_atts( $clients['values'] );
        $count = count($values);
        $i=1;
        $j=0;
        $args = wp_parse_args($args,[
            'class' => '',
            'dot_thumbnail_size' => '50'
        ]);
        $item_attrs = [];
        $owl_item_space = '';
        if(!empty($atts['margin']) && $atts['number_row'] > 1 ){
            $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
        }
        $thumbnail_class = '';
        foreach($values as $value){
            $j++;
            if($i > $atts['number_row']) $i=1;
            // image
            $value['image'] = isset($value['image']) ? $value['image'] : '';
            /* parse image_link */
            $link = false;
            $link_open = '<span class="client-logo image-hover" data--hint="No Title"><span>';
            $link_close = '</span></span>';
            if(isset($value['image_link'])){
                $image_link = vc_build_link( $value['image_link']);
                $image_link = ( $image_link == '||' ) ? '' : $image_link;
                if ( strlen( $image_link['url'] ) > 0 ) {
                    $link = true;
                    $a_href = $image_link['url'];
                    $a_title = $image_link['title'] ? $image_link['title'] : '';
                    $a_target = strlen( $image_link['target'] ) > 0 ? str_replace(' ','',$image_link['target']) : '_self';
                    $link_open = '<a class="client-logo image-hover" href="'.esc_url($a_href).'" data-hint="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'"><span>';
                    $link_close = '</span></a>';
                }
            }
            $dot_img = overcome_image_by_size([
                'id'    => isset($value['image']) ? $value['image'] : '',
                'size'  => $args['dot_thumbnail_size'],
                'class' => 'dot-thumb',
                'echo'  => false
            ]);
            $item_attrs[] = 'data-dot=\''.$dot_img.'\'';

            if($i==1) : ?>
                <div class="<?php $this->overcome_clients_item_css_class($atts);?>" <?php echo implode(' ', $item_attrs);?>>
            <?php  
                endif;
                echo '<div class="ef5-client-item-inner" '.$owl_item_space.'>';                
                echo overcome_html($link_open);
                    overcome_image_by_size([
                        'id'    => $value['image'],
                        'size'  => $atts['thumbnail_size'],
                        'class' => $thumbnail_class.' img-static'
                    ]);
                    overcome_image_by_size([
                        'id'    => isset($value['image_hover']) ? $value['image_hover'] : $value['image'],
                        'size'  => $atts['thumbnail_size'],
                        'class' => $thumbnail_class.' img-hover'
                    ]);
                echo overcome_html($link_close);
                echo '</div>';
            if($i == $atts['number_row'] || $j==$count) echo '</div>';
            $i ++;
        }
    }
}