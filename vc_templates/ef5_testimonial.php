<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_testimonial
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$wrap_css_class = ['ef5-testimonial-wrap'];
$css_class_attr = $item_class = array();
$css_class_attr[] = 'ef5-testimonial ef5-testimonial-layout-'.$layout_template;
$item_class[] = 'testimonial-item';

if($layout_style === 'carousel'){
    $wrap_css_class[] = ef5systems_owl_css_class($atts);
    $css_class_attr[] = 'ef5-owl testimonial-carousel owl-carousel';
    $item_class[] = 'ef5-carousel-item';
} else {
    $css_class_attr[] = 'ef5-grid row justify-content-center';
    $item_class[] = 'ef5-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
}

$css_class_attr[] = $content_align;
$css_class_attr[] = $el_class;

/* get space for owl item */
$owl_item_space = '';
if(isset($margin) && (isset($number_row) && $number_row > 1 )){
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
// get testinomial data
$testimonials = (array) vc_param_group_parse_atts( $atts['testimonials'] );
// avatar size
switch ($layout_template) {
	default:
		$dot_thumbnail_size = '90';
		break;
}
$ttmn_icon = '<div class="ttmn-icon"><span class="fa fa-quote-left"></span></div>';
$count = count($testimonials);
$i=1;
$j=0;
$author_link_open = $author_link_close = '';

$inner_css_classes = ['ttmn-inner','transition'];
if($layout_template === '1') $inner_css_classes[] = 'ef5-box-shadow-12';

?>
<div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ',$css_class_attr));?>"> 
        <?php
            foreach($testimonials as $testimonial){
                $j++;
                if($i > $number_row) $i=1;

                if(isset($testimonial['author_name'])) {
                	// dot image
                	$dot_image = overcome_image_by_size([
						'id'    => isset($testimonial['author_avatar']) ? $testimonial['author_avatar'] : null,
						'size'  => $dot_thumbnail_size, 
						'class' => 'dot-thumb circle', 
						'echo'  => false
                	]);
                    // star rating
                    $testimonial['author_rate'] = isset($testimonial['author_rate']) ? $testimonial['author_rate'] : '';
                    if($i==1) : ?>
                        <div class="<?php echo join(' ',$item_class);?>" data-dot='<?php echo overcome_html($dot_image); ?>'>
                    <?php  
                        endif;
                        echo '<div class="'.trim(implode(' ', $inner_css_classes)).'" '.$owl_item_space.'>';
                        	switch ($layout_template) {
                        		default:
                        			echo '<div class="row">';
                            			//avatar
                            			$this->overcome_tm_avatar($testimonial,$atts);
                            			echo '<div class="col text-center text-md-start">';
                            				echo '<div class="ttmn-header">';
    		                        			// name
    				                            $this->overcome_tm_name($testimonial, $atts,['class' => 'font-style-500']);
    				                            // position
    				                            $this->overcome_tm_position($testimonial,['class' => 'text-13 ef5-text-accent']);
    			                            echo '</div>';
    			                        	// star rating
    					                    $this->overcome_tm_rate($testimonial, $atts);
    			                        	// text 
    			                        	$this->overcome_tm_text($testimonial, $atts,['class' => 'text-22 font-style-300']);
    		                            echo '</div>';
                                    echo '</div>';
                        		break;
                        	}
                        echo '</div>';
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
