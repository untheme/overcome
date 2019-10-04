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
	'walker'          => new OverCome_Menu_Walker()
);
// Title
if(!empty($el_title)){
    vc_icon_element_fonts_enqueue($title_icon_type);
    $title_iconClass = ${'title_icon_icon_'.$title_icon_type};
    $el_title_icon = !empty($title_iconClass) && $add_title_icon ? '<span class="title-icon '.$title_iconClass.'"></span>' : '';
    $el_title = '<span class="ef5-el-title">'.$el_title_icon.$el_title.'</span>';
}
?>
<div class="ef5-wp-menu">
	<?php if(!empty($el_title)) { ?><h2 class="widgettitle"><?php echo overcome_html($el_title); ?></h2><?php } ?>
	<?php 
		wp_nav_menu($nav_menu_args);
	?>
</div>