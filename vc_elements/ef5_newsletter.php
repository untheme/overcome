<?php
if(!class_exists('Newsletter')) return;
vc_map(array(
	'name'        => 'OverCome Newsletter',
	'base'        => 'ef5_newsletter',
	'icon'        => 'ef5-icon-newsletter',
	'category'    => esc_html__('OverCome', 'overcome'),
	'description' => esc_html__('Add Newsletter Form.', 'overcome'),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Element Title', 'overcome' ),
			'description' => esc_html__( 'Enter the text you want to show as title', 'overcome' ),
			'param_name'  => 'el_title',
			'value'       => '',
			'std'		  => '',
			'admin_label' => true,
    	),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Layout Mode', 'overcome' ),
			'description' => esc_html__( 'Choose Layout mode you want to show', 'overcome' ),
			'param_name'  => 'layout_mode',
			'value'       => array(
				esc_html__('Newsletter','overcome')         => 'default',
				esc_html__('Newsletter Minimal','overcome') => 'minimal',
			),
			'std'		  => 'minimal',
			'admin_label' => true,
    	),
    	array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Template','overcome'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_elements/layouts/newsletter-1.png',
                '2' => get_template_directory_uri().'/vc_elements/layouts/newsletter-2.png',
            ),
            'std'        => '1',
            'admin_label'=> true
        ),
        array(
			'type'        => 'checkbox',
			'description' => esc_html__( 'Show field name', 'overcome' ),
			'param_name'  => 'show_name',
			'value'       => array(
				esc_html__( 'Show Name', 'overcome' ) => '1'
			),
			'std'		  => '0',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'default',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Name Text', 'overcome' ),
			'description' => esc_html__( 'Enter name text', 'overcome' ),
			'param_name'  => 'name_text',
			'value'       => 'Your Name',
			'std'		  => 'Your Name',
			'dependency'    => array(
				'element'   => 'show_name',
				'value'     => '1',
			),
    	),
        array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Email Text', 'overcome' ),
			'description' => esc_html__( 'Enter email text', 'overcome' ),
			'param_name'  => 'email_text',
			'value'       => 'E-mail address',
			'std'		  => 'E-mail address',
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Button Text', 'overcome' ),
			'description' => esc_html__( 'Enter button text', 'overcome' ),
			'param_name'  => 'btn_text',
			'value'       => 'Subscribe',
			'std'		  => 'Subscribe',
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra Class', 'overcome' ),
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'overcome' ),
			'param_name'  => 'el_class',
			'value'       => '',
			'std'		  => '',
			'admin_label' => true,
    	),
    	vc_map_add_css_animation()
    ) 
));

class WPBakeryShortCode_ef5_newsletter extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
    protected function title($atts, $args=[]){
    	if(empty($atts['el_title'])) return;
    	$args = wp_parse_args($args, [
    		'class' => ''
    	]);
    	$classes = ['ef5-el-title', 'ef5-heading', $args['class']];
    	?>
    		<div class="<?php echo trim(implode(' ', $classes));?>">
    			<?php echo esc_html($atts['el_title']); ?>
    		</div>
    	<?php
    }
}