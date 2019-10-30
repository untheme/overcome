<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_fancy_icon
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract($atts);
// Wrap css class
$wrap_css_class = ['ef5-fancybox','ef5-fancybox-'.$layout_template, 'transition', $el_class];

?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
	<?php switch ($layout_template) {
		case '3':
		?>
			<div class="row gutter-40">
				<div class="col-auto">
					<?php
					echo overcome_html($this->ef5_fancy_box_icon($atts,['class' => 'text-50 ef5-text-accent']));
					?>
				</div>
				<div class="col">
					<?php
			        	echo overcome_html($this->ef5_fancy_box_heading($atts,['class'=> 'text-18 lh-1/33333333']));
			        	echo overcome_html($this->ef5_fancy_box_desc($atts));
			        	echo overcome_html($this->ef5_fancy_box_link($atts));
			        ?>
			    </div>
        	</div>
        <?php
			break;
		default:
        	echo overcome_html($this->ef5_fancy_box_icon($atts,['class' => 'text-56 ef5-text-accent']));
        	echo overcome_html($this->ef5_fancy_box_heading($atts,['class'=> 'text-18 lh-1/33333333']));
        	echo overcome_html($this->ef5_fancy_box_desc($atts));
        	echo overcome_html($this->ef5_fancy_box_link($atts));
         break;
	} ?>
</div>