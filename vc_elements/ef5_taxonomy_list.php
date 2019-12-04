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
        )
    )
));
