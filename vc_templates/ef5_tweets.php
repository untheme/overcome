<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_tweets
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_id = 'ef5-tweets-'.!empty($el_id) ? $el_id : uniqid();

$custom_class = 'ef5-tweets-'.$atts['layout_template']. ' '.$el_class;

?>
<div id="<?php echo esc_attr($el_id); ?>">
	<?php
		ef5systems_twitter_html([
			'screen_name'    => $atts['screen_name'],
			'num'            => $atts['num'], // interger
			'rts'            => (bool)$atts['rts'], // bool
			'ats'            => (bool)$atts['ats'], // bool
			'pop'            => $atts['pop'], // interger
			'date_format'    => !empty($atts['date_format']) ? $atts['date_format'] : get_option('date_format'),
			'relative_date'  => (bool)$atts['relative_date'],
			'relative_label' => $atts['relative_label'],
			'class'          => $custom_class 
		]);
	?>
</div>