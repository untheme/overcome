<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_wp_menu
*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if(empty($nav_menu)) return;

$menu_title = get_term_by('slug',$nav_menu,'nav_menu');

$nav_menu_args = array(
	'fallback_cb'     => '',
	'menu'            => $nav_menu,
	'menu_class'      => trim(implode(' ', ['menu', $layout_mode, $add_divider, 'divider-'.$divider_style, $el_class])),
	'walker'          => new UnBreak_Menu_Walker()
);
?>
<div class="ef5-wp-menu">
	<?php if(!empty($title)) { ?><h2 class="widgettitle"><?php echo esc_html($title); ?><span class="ef5-open-submenu"></span></h2><?php } ?>
	<?php 
		wp_nav_menu($nav_menu_args);
	?>
</div>