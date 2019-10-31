<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_button
 */
/* get Shortcode custom value */
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    /* Button Wrapper Class */
    $btn_wrap_cls   = array('ef5-btn-wrap', $btn_display);
    $btn_wrap_cls[] = !empty($btn_align) ? 'text-'.$btn_align : '';

    $wrapper_attributes[] = 'class="'.trim(implode(' ', $btn_wrap_cls)).'"'; 


    

    // Button Icon
    $icon = '';
    if($add_icon){
        vc_icon_element_fonts_enqueue( $i_type );
        $icon_name = 'i_icon_' . $i_type ; /* get icon class */
        $icon_default = is_rtl() ? '' : '';
        $iconClass = (isset($atts[$icon_name]) && !empty($atts[$icon_name])) ? $atts[$icon_name] : $icon_default;
        $icon_css_class = [
            'ef5-btn-icon',
            $iconClass,
            $btn_icon_style,
            $btn_icon_animation,
            $icon_position,
            !empty($btn_icon_color) ? $btn_icon_color.'-color' : ''
        ];

        if(!empty($iconClass)) {
            if($icon_position === 'icon-left') $icon = '<span class="'.trim(implode(' ', $icon_css_class)).'"></span>&nbsp;&nbsp;';
            if($icon_position === 'icon-right') $icon = '&nbsp;&nbsp;<span class="'.trim(implode(' ', $icon_css_class)).'"></span>';
        }
    }
    
?>
<?php if(!empty($btn_text)) { ?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?>>
        <a <?php $this->overcome_btn_link($atts);?>>
        <?php 
            switch ($icon_position) {
                case 'icon-right':
            ?>
                <span class="btn-title"><?php echo esc_attr( $btn_text );?></span> <?php echo overcome_html($icon); ?>
            <?php   
                break;
                default:
            ?>
                <?php echo overcome_html($icon); ?> <span class="btn-title"><?php echo esc_attr( $btn_text );?></span>
            <?php
                break;
            }
        ?>
        </a>
    </div>
<?php }