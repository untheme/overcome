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
?>
<?php if(!empty($btn_text)) { ?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?>>
        <a <?php $this->overcome_btn_link($atts);?>>
        <?php 
            switch ($icon_position) {
                case 'icon-right':
            ?>
                <span class="btn-title"><?php echo esc_attr( $btn_text );?></span><?php $this->overcome_btn_icon($atts); ?>
            <?php   
                break;
                default:
            ?>
                <?php $this->overcome_btn_icon($atts); ?><span class="btn-title"><?php echo esc_attr( $btn_text );?></span>
            <?php
                break;
            }
        ?>
        </a>
    </div>
<?php }