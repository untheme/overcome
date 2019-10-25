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
extract( $atts );
$wrap_css_class = ['ef5-team-wrap'];
$css_class_attr = $item_class = array();
$css_class_attr[] = 'ef5-team ef5-team-layout-'.$layout_template;
$item_class[] = 'team-item';

if($layout_style === 'carousel'){
	$wrap_css_class[] = ef5_owl_css_class($atts);
	$css_class_attr[] = 'ef5-owl team-carousel owl-carousel';
	$item_class[]     = 'ef5-carousel-item';
} else {
	$css_class_attr[] = 'ef5-grid row align-items-center justify-content-center';
	$item_class[]     = 'ef5-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
}
$text_align = '';
if(!empty($content_align)) {
    $text_align = 'text-'.$content_align;
} else {
    if(in_array($layout_template, ['2','3'])) {
        $text_align = 'text-center';
        $content_align = 'center';
    }
}
$css_class_attr[] = $text_align;
$css_class_attr[] = $el_class;

/* get space for owl item */
$owl_item_space = '';
if(isset($margin) && (isset($number_row) && $number_row > 1 )){
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
// Inner class 
$item_inner_class = ['inner-box'];

// get testinomial data
$teams = (array) vc_param_group_parse_atts( $atts['teams'] );
// OWL Dots thumbnail Size
switch ($layout_template) {
    case '4': 
        $item_inner_class[] = 'shadow-hover'; 
        break;
	default:
		$dot_thumbnail_size = '80';
		break;
}
$count = count($teams);
$i=1;
$j=0;
$team_link_open = $team_link_close = $socials = '';
?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ',$css_class_attr));?>"> 
        <?php
            foreach($teams as $team){
                $team['image']  = isset($team['image']) ? $team['image'] : null;
                $j++;
                if($i > $number_row) $i=1;
                
                if(isset($team['name'])) {
                	// dot image
                	if(!empty($team['image']))
                    	$dot_image = overcome_image_by_size(['id'=>$team['image'], 'size'=>$dot_thumbnail_size, 'class'=>'dot-thumb circle', 'echo' => false]);
                    else 
                    	$dot_image = overcome_default_image_thumbnail(['size' => $dot_thumbnail_size, 'class' => 'dot-thumb circle']);
                    if($i==1) : ?>
                        <div class="<?php echo join(' ',$item_class);?>" data-dot='<?php echo wp_kses_post($dot_image); ?>'>
                    <?php  
                        endif;
                        echo '<div class="ef5-item-inner" '.$owl_item_space.'><div class="'.implode(' ', $item_inner_class).'">';
                        	switch ($layout_template) {
                        		default:
                            ?>
                                <div class="hoverdir-wrap fade-in">
                                    <div class="hover-inner team-images">
                                        <?php
                                            // image            
                                            $this->overcome_team_image($team);
                                		?>
                                        <div class="hover-content content-flex align-items-end justify-content-<?php echo esc_attr($content_align);?> overlay-bg-1">
                                            <div class="team-social ef5-social text-white size-30"><?php
                                                overcome_team_socials($team);
                                            ?></div>
                                        </div>
                                    </div>
                            		<div class="team-info"><?php
    	                        			// name
    			                            $this->overcome_team_name($team);
    			                            // position
                                            $this->overcome_team_position($team);
    	                        			// desc 
    			                        	$this->overcome_team_desc($team);
    			                    ?></div>
                                </div>
			                    <?php
                        		break;
                        	}
                        echo '</div></div>';
                    if($i == $number_row || $j==$count) echo '</div>';
                    $i ++;
                }
            }
        ?>
    </div>
    <?php if($layout_style === 'carousel'):
        overcome_loading_animation(); 
        ef5systems_owl_dots_container($atts);
        ef5systems_owl_nav_container($atts);
        ef5systems_owl_dots_in_nav_container($atts);
    endif; ?>
</div>
