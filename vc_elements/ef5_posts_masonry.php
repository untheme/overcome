<?php
vc_map(array(
    'name'          => 'OverCome Posts Masonry',
    'base'          => 'ef5_posts_masonry',
    'category'      => esc_html__('OverCome', 'overcome'),
    'description'   => esc_html__('Display your posts with Masonry layout', 'overcome'),
    'icon'         => 'vc_icon-vc-masonry-grid',
    'params'        => array_merge(
        array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Data source', 'overcome' ),
                'param_name'  => 'post_type',
                'value'       => ef5systems_vc_post_type_list(),
                'std'         => 'post',
                'description' => esc_html__( 'Select content type for your grid.', 'overcome' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Narrow data source', 'overcome' ),
                'param_name' => 'taxonomies',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => ef5systems_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'overcome' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Exclude from Content and filter list', 'overcome' ),
                'param_name' => 'taxonomies_exclude',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => ef5systems_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories, tags or custom taxonomies won\'t be shown in the content and filters list', 'overcome' ),
                'admin_label' => true
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'posts_per_page',
                'heading'       => esc_html__( 'Number of posts', 'overcome' ),
                'description'   => esc_html__( 'number of post to show per page', 'overcome' ),
                'std'           => '8',
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
            )
        ),
        // Layout Template
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_extends/layouts/posts-masonry-1.png',
                ),
                'std'   => '1',
                'group' => esc_html__('Layouts','overcome'),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_pagination',
                'value'         => array(
                    esc_html__( 'Show Pagination', 'overcome' ) => '1'
                ),
                'std'           => '1',
                'group'         => esc_html__('Layouts','overcome')
            )
        ),
        // Filter
        array(
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_filter',
                'value'      => array(
                    esc_html__('Show Filter','overcome') => '1'
                ),
                'std'   => '1',
                'group' => esc_html__('Filter','overcome'),
            ),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Filter Template','overcome'),
                'param_name' => 'filter_template',
                'img_class'  => 'cols-1',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_elements/layouts/filter-1.png'
                ),
                'std'   => '1',
                'dependency' => array(
                    'element' => 'show_filter',
                    'value'   => array('1')
                ), 
                'group' => esc_html__('Filter','overcome'),
            )
        ),
        ef5systems_content_align_option_for_vc(),
        // Item Template
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Items Template','overcome'),
                'param_name' => 'item_template',
                'value' =>  array(
                    '2-1' => get_template_directory_uri().'/vc_elements/layouts/posts-2.png',
                ),
                'std'   => '2',
                'group' => esc_html__('Item Layout','overcome'),
            )
        )
    )
));

class WPBakeryShortCode_ef5_posts_masonry extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        wp_enqueue_script( 'imagesloaded');
        wp_enqueue_script( 'isotope');
        return parent::content($atts, $content);
    }
    protected function ef5_posts_masonry_wrap_class($atts, $args=[]){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        extract($atts);
        $css_classes = array(
            'ef5-posts-masonry',
            'ef5-masonry',
            'ef5-posts-masonry-'.$layout_template,
            'ef5-posts-'.$item_template,
            $args['class']
        );
        if($layout_template === '1'){
            $css_classes[] = 'row';
        } 
        echo overcome_optimize_css_class(implode(' ', $css_classes));
    }
    protected function ef5_posts_masonry_items_class($atts, $args=[]){
        $args = wp_parse_args($args, [
            'overlay_dir' => 'fade-in',
            'class'       => ''
        ]);
        extract($atts);
        $css_classes = [
            'ef5-masonry-item', 
            'ef5-grid-item',
            'ef5-hover-wrap',
            'hoverdir-wrap',
            $args['overlay_dir'],
            $args['class']
        ];
        if($layout_template === '1'){
            $css_classes[] = 'col-lg-4 col-md-6';
        } 
        echo overcome_optimize_css_class(implode(' ', $css_classes));
    }
    protected function ef5_posts_masonry_filters($atts, $args=[]){
        $args = wp_parse_args($args, [
            'class'       => ''
        ]);
        extract($atts);
        if($show_filter === '0') return;
        // Filters
        $filters_class = [
            'ef5-filters', 
            'ef5-masonry-filters', 
            'ef5-filters-'.$filter_template,
            'row',
            $args['class']
        ];
        // Filter Button Data 
        $filter_terms_args = [
            'taxonomy' => overcome_get_custom_post_taxonomies( $post_type , 'cat'), 
            'exclude'  => overcome_get_term_id_by_slug($post_type, 'cat', $taxonomies_exclude)
        ];
        if(!empty($taxonomies))  $filter_terms_args['slug'] = explode(',', $taxonomies);
        $filter_terms = get_terms($filter_terms_args);

    ?>
        <div class="<?php echo overcome_optimize_css_class(implode(' ', $filters_class));?>">
            <div class="filter-item active col-auto" data-filter="*">
                <span><?php esc_html_e('All','unbreak'); ?></span>
            </div>
            <?php 
                foreach ($filter_terms as $term) {
                    echo '<div class="filter-item col-auto" data-filter="'.esc_attr('.'.$term->slug).'"><span>'.esc_html($term->name).'</span><span class="d-none">'.$term->count.'</span></div>';
                } 
            ?>
        </div>
    <?php
    }
}
