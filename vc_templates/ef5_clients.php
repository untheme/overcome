<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $thumbnail_size
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_clients
 */

$values = $thumbnail_class = '';
/* get Shortcode custom value */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$wrap_css_class = ['ef5-clients-wrap ef5-owl-wrap', 'ef5-'.$el_id];

$css_class_attr = $item_class = array();
$css_class_attr[] = 'ef5-clients-layout-'.$layout_mode;
$css_class_attr[] = 'img-hover-'.$hover_style;
$item_class[] = 'client-item';

if($layout_mode === 'carousel'){
    $wrap_css_class[] = '';
    $css_class_attr[] = ef5systems_owl_css_class($atts);
    $item_class[] = 'ef5-carousel-item';
} else {
    $css_class_attr[] = 'ef5-client-grid row justify-content-center';
    if($layout_mode === '1') $css_class_attr[] = 'align-items-center';

    $item_class[] = 'ef5-client-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
}

$css_class_attr[] = $el_class;

/* get space for owl item */
$owl_item_space = '';
if(isset($margin) && (isset($number_row) && $number_row > 1 )){
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}


$clients = vc_map_get_attributes( $this->getShortcode(), $atts );
$values = (array) vc_param_group_parse_atts( $clients['values'] );
if(empty($values[0])) {
    echo '<p class="require required">'.esc_html__('Please add a client logo!','unbreak').'</p>';
    return;
}

$count = count($values);
$i=1;
$j=0;

$dot_thumbnail_size = '50';
$item_attrs = '';

?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
    <?php 
        ef5systems_owl_nav_top($atts);
        ef5systems_owl_dots_top($atts); 
    ?>
    <div class="ef5-owl-wrap-inner relative">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ',$css_class_attr));?>"> 
        <?php
            ef5systems_owl_nav_top($atts);
            ef5systems_owl_dots_top($atts); 
            foreach($values as $value){
                $j++;
                if($i > $number_row) $i=1;
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
                    'size'  => $dot_thumbnail_size,
                    'class' => 'dot-thumb',
                    'echo'  => false
                ]);
                if($layout_mode === 'carousel'){
                    $item_attrs = 'data-dot="'.$dot_img.'"';
                }
                if($i==1) : ?>
                    <div class="<?php echo implode(' ',$item_class);?>" <?php echo overcome_html($item_attrs);?>>
                <?php  
                    endif;
                    echo '<div class="ef5-client-item-inner" '.$owl_item_space.'>';                
                    echo overcome_html($link_open);
                        overcome_image_by_size([
                            'id'    => isset($value['image']) ? $value['image'] : '',
                            'size'  => $thumbnail_size,
                            'class' => $thumbnail_class.' img-static'
                        ]);
                        overcome_image_by_size([
                            'id'    => isset($value['image_hover']) ? $value['image_hover'] : $value['image'],
                            'size'  => $thumbnail_size,
                            'class' => $thumbnail_class.' img-hover'
                        ]);
                    echo overcome_html($link_close);
                    echo '</div>';
                if($i == $number_row || $j==$count) echo '</div>';
                $i ++;
            }
        ?>
    </div>
    <?php if($layout_mode === 'carousel'):
        overcome_loading_animation(); 
        ef5systems_owl_dots_container($atts);
        ef5systems_owl_nav_container($atts);
        ef5systems_owl_dots_in_nav_container($atts);
    endif; ?>
</div>
