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

$wrap_css_class = ['ef5-wp-menu'];
if( $layout_type !== 'default') $wrap_css_class[] = $layout_type;

$menu_title = get_term_by('slug',$nav_menu,'nav_menu');

$nav_menu_args = array(
	'fallback_cb'     => '',
	'menu'            => $nav_menu,
	'menu_class'      => trim(implode(' ', ['menu', $layout_mode, $add_divider, 'divider-'.$divider_style, $el_class])),
	'walker'          => new OverCome_Menu_Walker()
);
// Title
$title = '';
if(!empty($el_title)){
    vc_icon_element_fonts_enqueue($title_icon_type);
    $title_iconClass = ${'title_icon_icon_'.$title_icon_type};
    $el_title_icon = !empty($title_iconClass) && $add_title_icon ? '<span class="title-icon '.$title_iconClass.'"></span>' : '';
    $title = '<span class="ef5-el-title">'.$el_title_icon.$el_title.'</span>';
}
?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
	<?php switch ($layout_type) {
			case 'toggle':
				echo overcome_html($title);
				break;
			default:
			?>
				<div class="ef5-heading"><?php echo overcome_html($title); ?></div>
			<?php
			break;
		}
		wp_nav_menu($nav_menu_args);
	?>
</div>