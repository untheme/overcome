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
<div class="<?php $this->overcome_heading_wrap_css_class($atts); ?>">
	<?php 
		switch ($layout_template) {
			case '8':
				$this->ef5_heading_small_heading($atts, ['class' => 'text-uppercase']);
				$this->ef5_heading_main_heading_icon($atts);
				$this->ef5_heading_main_heading($atts,['class' => 'ef5-heading']);
				break;
			case '6':
				$this->ef5_heading_small_heading($atts, ['class' => 'text-22 ef5-text-accent text-uppercase']);
				$this->ef5_heading_main_heading_icon($atts);
				$this->ef5_heading_main_heading($atts,['class' => 'ef5-heading']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22']);
				$this->ef5_heading_desccription($atts,['class' => 'text-18 font-style-500 pt-20']);
				$this->ef5_heading_button($atts,['wrap_class' => 'pt-65', 'class' => 'ef5-btn white fill ef5-btn-md']);
				break;
			case '5':
				$this->ef5_heading_icon_top($atts);
				$this->ef5_heading_small_heading($atts, ['class' => 'text-22 text-uppercase font-style-600 text-white']);
				$this->ef5_heading_main_heading($atts,['class' => 'ef5-heading']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22 text-white']);
				$this->ef5_heading_desccription($atts,['class' => 'text-white']);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent fill ef5-btn-lg']);
				break;
			case '4':
				$this->ef5_heading_small_heading($atts,['class'=> 'text-22 ef5-text-accent ']);
				$this->ef5_heading_main_heading_icon($atts);
				$this->ef5_heading_main_heading($atts,['class' => '']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-15 ef5-text-accent font-style-500']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent fill ef5-btn-lg']);
				break;
			case '3':
				$this->ef5_heading_small_heading($atts, ['class' => 'text-22 text-uppercase text-white']);
				$this->ef5_heading_main_heading_icon($atts);
				$this->ef5_heading_main_heading($atts,['class' => 'ef5-heading']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22 text-white']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent outline ef5-btn-md']);
				break;
			default:
				$this->ef5_heading_small_heading($atts, ['class' => 'text-22 ef5-text-accent text-uppercase']);
				$this->ef5_heading_main_heading_icon($atts);
				$this->ef5_heading_main_heading($atts,['class' => 'ef5-heading']);
				$this->ef5_heading_sub_heading($atts, ['class' => 'text-22']);
				$this->ef5_heading_desccription($atts);
				$this->ef5_heading_button($atts,['class' => 'ef5-btn accent fill ef5-btn-md']);
				break;
		}
	?>
</div>