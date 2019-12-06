<?php
vc_map(array(
    'name'          => 'OverCome Taxonomy List',
    'base'          => 'ef5_taxonomy_list',
    'category'      => esc_html__('OverCome', 'overcome'),
    'description'   => esc_html__('Display taxonomy list', 'overcome'),
    'icon'         => 'icon-wpb-application-icon-large',
    'params'        => array_merge(
        array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Element Title', 'overcome' ),
                'description' => esc_html__( 'Enter the text you want to show as title', 'overcome' ),
                'param_name'  => 'el_title',
                'value'       => '',
                'std'         => '',
                'admin_label' => true,
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Taxonomy', 'overcome' ),
                'param_name'  => 'taxonomy',
                'value'       => ef5systems_vc_taxonomy_list(),
                'std'         => 'category',
                'description' => esc_html__( 'Select taxonomy', 'overcome' ),
                'admin_label' => true,
            ),
            array(
                'type'        => 'checkbox',
                'param_name'  => 'taxonomy_style',
                'value'       => [
                	esc_html__('Show as Tag','overcome') => '1'
                ],
                'std'         => '0',
            ),
            array(
                'type'        => 'checkbox',
                'param_name'  => 'show_count',
                'value'       => [
                	esc_html__(' Show counts','overcome') => '1'
                ],
                'std'         => '0',
            ),
            array(
                'type'        => 'checkbox',
                'param_name'  => 'hierarchical',
                'value'       => [
                	esc_html__(' Show hierarchy','overcome') => '1'
                ],
                'std'         => '0',
                'dependency'  => array(
                	'element'	=> 'taxonomy_style',
                	'value_not_equal_to'		=> '1'
                )
            ),
        )
    )
));
class WPBakeryShortCode_ef5_taxonomy_list extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
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
            <div class="<?php echo trim(implode(' ', $classes));?>"><?php 
            	echo esc_html($atts['el_title']); 
            ?></div>
        <?php
    }
    protected function overcome_taxonomy_list($atts, $args=[]){
    	$args = wp_parse_args($args, [
    		'class' => ''
    	]);
    	extract($atts);
    	if($taxonomy_style){
    	?>
    		<div class="tagcloud">
    			<?php 
    				$tag_cloud = wp_tag_cloud(
						apply_filters(
							'widget_tag_cloud_args',
							array(
								'taxonomy'   => $taxonomy,
								'echo'       => false,
								'show_count' => $show_count,
							),
							$atts
						)
					);
					echo overcome_html($tag_cloud);
    			?>
    		</div>
    	<?php } else { ?>
    		<ul class="ef5-taxonomy-list">
	    		<?php 
		    	wp_list_categories([
					'taxonomy'     => $taxonomy,
					'title_li'     => '',
					'style'        => 'list',
					'orderby'      => 'name',
					'show_count'   => $show_count,
					'hierarchical' => $hierarchical,
					'walker'       => new OverCome_Categories_Walker
		    	]);
		    	?>
		    </ul>
		<?php
	    }
    }
}