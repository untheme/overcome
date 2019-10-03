<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_quickcontact
 */
/* get Shortcode custom value */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$wrap_css_class = [
    'ef5-qc', 
    'ef5-qc-'.$layout_template, 
    $content_align, 
    $content_color,
    $el_class 
];
$wrap_inner_css_class = ['row'];
$item_class = ['qc-item'];
$item_inner_class = ['row'];
$qc_infos = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $qc_infos['values'] );
if(empty($values[0])) {
    echo '<p class="require required">'.esc_html__('Please add your contact info','unbreak').'</p>';
    return;
}
$qc_icon = $qc_text = '';
$icon_color = !empty($icon_color) ? $icon_color : 'accent-color';
$icon_classes = ['qc-icon', $icon_color];
switch ($layout_template) {
    case '4':
        $wrap_inner_css_class[] = 'gutters-60';
        $item_class[] = 'col-auto';
        $item_inner_class[] = 'gutters-10';
        break;
    case '2':
        $item_class[] = 'col-12';
        $item_inner_class[] = 'gutters-20';
        break;
    default:
        $wrap_inner_css_class[] = 'gutters-80';
        $item_class[] = 'col-auto';
        $item_inner_class[] = 'gutters-20 align-items-center';
        break;
}
// Get Direction
$use_link = false;
$get_direction = '';
if(!empty($atts['get_direction'])){
    $button_link = vc_build_link( $atts['get_direction'] );
    $button_link = ( $button_link == '||' ) ? '' : $button_link;
    if ( strlen( $button_link['url'] ) > 0 ) {
        $use_link = true; 
        $a_href = $button_link['url'];
        $a_title = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read More','unbreak') ;
        $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
        // Button for layout 4
        $get_direction = '<div class="qc-direction ef5-btn-wrap col-12"><a class="ef5-btn-link text-accent simple ef5-btn-df icon-right underline-primary transition ef5-scroll" href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'"><span class="btn-title">'.esc_html($a_title).'&nbsp;&nbsp;</span> <span class="btn-icon flaticon-right-arrow"></span></a></div>';
    }
}
?>
<div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ', $wrap_css_class));?>">
    <div class="<?php echo trim(implode(' ', $wrap_inner_css_class));?>">
        <?php
            ob_start();

            if(!empty($img_id)) overcome_image_by_size([
                'id'     => $img_id, 
                'size'   => '270x184',
                'class'  => 'image-fit',
                'before' =>'<div class="qc-image col-12">',
                'after'  => '</div>'
            ]);
        	if(!empty($el_title)) echo '<div class="ef5-heading qc-heading col-12 text-20">'.esc_html($el_title).'</div>';
            foreach($values as $value){
                vc_icon_element_fonts_enqueue( $value['i_type'] );
                $iconClass  = isset($value['i_icon_'. $value['i_type']]) ? $value['i_icon_'. $value['i_type']] : '';
                $qc_icon    = !empty($iconClass) ? '<span class="'.implode(' ', $icon_classes).' '.$iconClass.'"></span>' : '';
                $qc_heading = isset($value['qc_heading']) && !empty($value['qc_heading']) ? $value['qc_heading'] : '';
                $qc_text    = isset($value['qc_text']) ? $value['qc_text'] : '';
                switch ($layout_template) {
                    default:
                        echo '<div class="'.trim(implode(' ', $item_class)).'">';
                            echo '<div class="'.trim(implode(' ', $item_inner_class)).'">';
                                if(!empty($iconClass)) echo '<div class="col-auto">'.overcome_html($qc_icon).'</div>';
                                echo '<div class="col">';
                                    echo '<div class="ef5-heading qc-item-heading font-style-600">'.overcome_html($qc_heading).'</div>';
                                    if(!empty($qc_text)) echo '<div class="qc-text">'.overcome_html($qc_text).'</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    break;
                }
            }
            if($layout_template === '2') echo overcome_html($get_direction);
            echo ob_get_clean();
        ?>
    </div>
</div>
