<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_cms_team
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
?>
<div class="widget widget_categories ef5-taxonomy-list">
	<?php 
		$this->title($atts); 
		$this->overcome_taxonomy_list($atts);
	?>
</div>