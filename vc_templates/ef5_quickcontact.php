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
switch ($layout_template) {
    case '1':
        $wrap_css_class[] = 'text-12 font-style-500';
        $item_class[] = 'col-12';
        $item_inner_class[] = 'gutter-10 align-items-center';
    break;
}
$qc_infos = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $qc_infos['values'] );
if(empty($values[0])) {
    echo '<p class="require required">'.esc_html__('Please add your contact info','overcome').'</p>';
    return;
}
$qc_icon = $qc_text = '';
$icon_color = !empty($icon_color) ? $icon_color : '';
$icon_classes = ['qc-icon', $icon_color];
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
        $get_direction = '<div class="qc-direction ef5-btn-wrap col-12"><a class="ef5-btn-link text-accent simple ef5-btn-df icon-right underline-primary transition ef5-scroll" href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'"><span class="btn-title">'.esc_html($a_title).'&nbsp;&nbsp;</span> <span class="btn-icon flaticon-right-arrow"></span></a></div>';
    }
}
?>
<div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ', $wrap_css_class));?>">
    <?php 
        if(!empty($img_id)) overcome_image_by_size([
            'id'     => $img_id, 
            'size'   => '270x184',
            'class'  => 'image-fit',
            'before' =>'<div class="qc-image col-12">',
            'after'  => '</div>'
        ]);
        if(!empty($el_title)) echo '<div class="ef5-el-title ef5-heading qc-heading col-12">'.esc_html($el_title).'</div>'; 
    ?>
    <div class="<?php echo trim(implode(' ', $wrap_inner_css_class));?>">
        <?php
            ob_start();
            if($layout_template === '2'){
                echo overcome_html($map_address);
                echo overcome_html($get_direction);
            }
            foreach($values as $value){
                $this->overcome_qc_item_render($atts, $value);
            }
            echo ob_get_clean();
        ?>
    </div>
</div>
