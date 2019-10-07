<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_heading
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="<?php $this->unbreak_heading_wrap_css_class($atts); ?>">
	<?php 
		switch ($layout_template) {
			default:
				$this->ef5_heading_small_heading($atts);
				$this->ef5_heading_main_heading($atts);
				$this->ef5_heading_sub_heading($atts);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts);
			break;
		}
	?>
</div>