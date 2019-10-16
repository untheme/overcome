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
$el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');

$wrap_css_class = ['ef5-clients-wrap ef5-owl-wrap', 'ef5-'.$el_id];

$css_class_attr = $item_class = array();
$css_class_attr[] = 'ef5-clients-layout-'.$layout_style;
$css_class_attr[] = 'img-hover-'.$hover_style;
$item_class[] = 'client-item';

if($layout_style === 'carousel'){
    $wrap_css_class[] = '';
    $css_class_attr[] = ef5systems_owl_css_class($atts);
    $item_class[] = 'ef5-carousel-item';
} else {
    $css_class_attr[] = 'ef5-client-grid row justify-content-center';
    if($layout_style === '1') $css_class_attr[] = 'align-items-center';

    $item_class[] = 'ef5-client-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
}

$css_class_attr[] = $el_class;

/* get space for owl item */



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
$item_attrs = [];
$owl_item_space = '';
if(!empty($atts['margin']) && $atts['number_row'] > 1 ) {
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
?>
<div class="<?php $this->overcome_clients_wrap_css_class($atts);?>">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php $this->overcome_clients_css_class($atts);?>">
        <?php 
            foreach($values as $value){
                $j++;
                if($i > $number_row) $i=1;

                $dot_img = overcome_image_by_size([
                    'id'    => isset($value['image']) ? $value['image'] : '',
                    'size'  => '50',
                    'class' => 'dot-thumb',
                    'echo'  => false
                ]);
                if($layout_style === 'carousel'){
                    $item_attrs[] = 'data-dot=\''.$dot_img.'\'';
                }

                if($i==1) : ?>
                    <div class="<?php $this->overcome_clients_item_css_class($atts);?>">
                        <div class="ef5-client-item-inner" <?php echo overcome_html($owl_item_space);?>> 
                            <?php $this->overcome_client_render($$value); ?>
                        </div>
                <?php
                if($i == $number_row || $j==$count) echo '</div>';
                $i ++;
            }
        ?>
    </div>
    <?php if($layout_style === 'carousel'):
        overcome_loading_animation(); 
        ef5systems_owl_dots_container($atts);
        ef5systems_owl_nav_container($atts);
        ef5systems_owl_dots_in_nav_container($atts);
    endif; ?>
</div>