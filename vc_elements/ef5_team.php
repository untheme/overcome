<?php
vc_map(array(
    'name'          => 'OverCome Team',
    'base'          => 'ef5_team',
    'icon'          => '',
    'category'      => esc_html__('OverCome', 'overcome'),
    'description'   => esc_html__('Add your team member', 'overcome'),
    'params'        => array_merge(
        array(
            /* Template Settings */
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Content Alignments','overcome'),
                'param_name'    => 'content_align',
                'value'         => array(
                    'Default'       => '',
                    'Text Left'     => 'left',
                    'Text Right'    => 'right',
                    'Text Center'   => 'center',
                ),
                'std'           => '',
            ),
            array(
                'type' => 'img',
                'heading' => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/team1.png',
                ),
                'std' => '1',
                'admin_label' => true
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
            /* Members Settings */
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Custom member image size','overcome'),
                'description'   => esc_html__('Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','overcome'),
                'param_name'    => 'thumbnail_size',
                'value'         => '',
                'std'           => '',
                'group'         => esc_html__('Members','overcome'),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'thumbnail_bw',
                'value'         => array(
                    esc_html__('Make Member image as Black & White','overcome') => '1'
                ),
                'std'           => '0',
                'group'         => esc_html__('Members', 'overcome')
            ),
            array(
                'type'          => 'param_group',
                'heading'       => esc_html__( 'Add Member', 'overcome' ),
                'param_name'    => 'teams',
                'std'           => urlencode( json_encode( array(
                    array(
                        'name'     => 'Andrew Bright',
                        'position' => 'CEO & Founder',
                        'link'     => 'title:Andrew Bright||url:#',
                    ),
                    array(
                        'name'     => 'Conrad Smith',
                        'position' => 'Volunteer',
                        'link'     => 'title:Conrad Smith||url:#',
                    ),
                    array(
                        'name'     => 'Belle Hill',
                        'position' => 'Volunteer',
                        'link'     => 'title:Belle Hill||url:#',
                    ),
                    array(
                        'name'     => 'Alison Becker',
                        'position' => 'Manager',
                        'link'     => 'title:Alison Becker||url:#',
                    ),
                ) ) ),
                'params'        => array(
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Image', 'overcome' ),
                        'param_name'    => 'image',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Name', 'overcome' ),
                        'param_name'    => 'name',
                        'admin_label'   => true,
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Position', 'overcome' ),
                        'param_name'    => 'position',
                    ),
                    array(
                        'type'          => 'textarea',
                        'heading'       => esc_html__( 'Description', 'overcome' ),
                        'param_name'    => 'desc',
                    ),
                    array(
                        'type'          => 'vc_link',
                        'heading'       => esc_html__( 'Member Page', 'overcome' ),
                        'param_name'    => 'link',
                        'description'   => esc_html__( 'Enter link to member details page.', 'overcome' ),
                    ),
                    array(
                        'type'          => 'param_group',
                        'heading'       => esc_html__( 'Member Social', 'overcome' ),
                        'param_name'    => 'social',
                        'std'           => urlencode( json_encode( array(
                            array(
                                'icon' => 'fa fa-facebook',
                                'link' => 'title:Facebook||url:facebook.com'
                            ),
                            array(
                                'icon' => 'fa fa-twitter',
                                'link' => 'title:Twitter||url:twitter.com'
                            ),
                            array(
                                'icon' => 'fa fa-pinterest',
                                'link' => 'title:pinterest||url:pinterest.com'
                            ),
                            array(
                                'icon' => 'fa fa-linkedin',
                                'link' => 'title:Linkedin||url:linkedin.com'
                            ),
                        ) ) ),
                        'params'        => array(
                            array(
                                'type'          => 'iconpicker',
                                'heading'       => esc_html__( 'Social icon', 'overcome' ),
                                'param_name'    => 'icon',
                                'admin_label'   => true,
                            ),
                            array(
                                'type'          => 'vc_link',
                                'heading'       => esc_html__( 'Enter social link', 'overcome' ),
                                'param_name'    => 'link',
                            ),
                        ),
                    ),
                    
                ),
                'group'     => esc_html__('Members','overcome')
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
                'admin_label' => true
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

class WPBakeryShortCode_ef5_team extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
    protected function overcome_team_image($atts, $team, $args = []){
        $args = wp_parse_args($args, [
            'class' => '',
            'size'  => '270x340',
            'img_class' => 'ef5-rounded-10'  
        ]);
        $classes = ['team-image', $args['class']];
    ?>
        <div class="<?php echo trim(implode(' ', $classes));?>"><?php 
            overcome_image_by_size([
                'id'      => $team['image'],
                'size'    => overcome_default_value($atts['thumbnail_size'], $args['size']),
                'class'   => trim(implode(' ', ['team-img', 'transition', $args['img_class']])),
                'default' => true
            ]);
        ?></div>
    <?php
    }
    protected function overcome_team_name($team, $args = []){
        if(!isset($team['name']) || empty($team['name'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $classes = ['team-name', $args['class']];
        $team_link_open = $team_link_close = '';
        if(!empty($team['link'])){
            $team_link = vc_build_link( $team['link']);
            $team_link = ( $team_link == '||' ) ? '' : $team_link;  
            if ( strlen( $team_link['url'] ) > 0 ) {
                $a_href = $team_link['url'];
                $a_title = !empty($team_link['title']) ? $team_link['title'] : $team['name'];
                $a_target = strlen( $team_link['target'] ) > 0 ? $team_link['target'] : '_blank';
            }
            $team_link_open = '<a href="'.esc_url($a_href).'" title="'.esc_attr($a_title).'" target="'.esc_attr($a_target).'">';
            $team_link_close = '</a>';
        }
    ?>
        <div class="<?php echo trim(implode(' ', $classes));?>"><?php 
            echo overcome_html($team_link_open.$team['name'].$team_link_close); 
        ?></div>
    <?php
    }
    protected function overcome_team_position($team, $args = []){
        if(!isset($team['position']) || empty($team['position'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $classes = ['team-position', $args['class']];
    ?>
        <div class="<?php echo trim(implode(' ', $classes));?>"><?php 
            echo overcome_html($team['position']);
        ?></div>
    <?php
    }
    protected function overcome_team_desc($team, $args = []){
        if(!isset($team['desc']) || empty($team['desc'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $classes = ['team-desc', $args['class']];
    ?>
        <div class="<?php echo trim(implode(' ', $classes));?>"><?php 
            echo overcome_html($team['desc']);
        ?></div>
    <?php
    }
    protected function overcome_team_socials($team, $args = []){
        if(!isset($team['social']) || empty($team['social'])) return;
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $classes = ['team-socials', $args['class']];

        $socials_list = '';
        $socials = (array) vc_param_group_parse_atts( $team['social']);
        foreach($socials as $social){
            if(isset($social['icon'])) $icon = '<span class="'.$social['icon'].'"></span>';
            /* parse social link */
            $link = false;
            if(isset($social['link'])){
                $icon_link = vc_build_link( $social['link'] );
                $icon_link = ( $icon_link == '||' ) ? '' : $icon_link;
                if ( strlen( $icon_link['url'] ) > 0 ) {
                    $link = true;
                    $social_href = $icon_link['url'];
                    $social_title = $icon_link['title'] ? $icon_link['title'] : '';
                    $social_target = strlen( $icon_link['target'] ) > 0 ? str_replace(' ','',$icon_link['target']) : '_self';
                }
            }
            if($link){
                $link_open = '<a href="'.esc_url($social_href).'" title="'.esc_attr($social_title).'" target="'.esc_attr($social_target).'">';
                $link_close = '</a>';
                $socials_list .= $link_open.$icon.$link_close;
            }     
        }
    ?>
        <div class="<?php echo trim(implode(' ', $classes));?>"><?php 
            echo overcome_html($socials_list);
        ?></div>
    <?php
    }
}