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
$el_id = !empty($el_id) ? 'ef5-'.$el_id : uniqid('ef5-');

/* get space for owl item */
$owl_item_space = '';
if(isset($margin) && (isset($number_row) && $number_row > 1 )){
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
// get testinomial data
$teams = (array) vc_param_group_parse_atts( $atts['teams'] );

$count = count($teams);
$i=1;
$j=0;
?>
<div class="ef5-teams <?php echo ef5systems_owl_css_class($atts);?>">
    <?php 
        ef5systems_owl_nav_top($atts);
        ef5systems_owl_dots_top($atts); 
    ?>
    <div class="ef5-owl-wrap-inner relative">
        <div id="<?php echo esc_attr($el_id);?>" class="<?php $this->overcome_team_wrap_class($atts);?>">
            <?php
                foreach($teams as $team) {
                    $team['image']  = isset($team['image']) ? $team['image'] : null;
                    $j++;
                    if($i > $number_row) $i=1;
                    
                    if($i==1) : ?>
                        <div class="<?php $this->overcome_team_item_class($atts);?>" data-dot='<?php $this->overcome_owl_dot_data($atts, $team); ?>'>
                    <?php endif; ?>
                        <div class="ef5-item" <?php echo overcome_html($owl_item_space);?>>
                            <div class="<?php $this->overcome_team_item_inner_class($atts,['class' => 'overlay-wrap']);?>">
                                <?php switch ($layout_template) {
                                    default:
                                ?>
                                    <div class="relative">
                                        <?php
                                            // image            
                                            $this->overcome_team_image($atts, $team);
                                        ?>
                                        <div class="overlay ef5-overlay-bg ef5-rounded-10 row justify-content-center"><div class="col-auto align-self-end"><?php
                                                $this->overcome_team_socials($team,['class' => 'ef5-rounded-5']);
                                        ?></div></div>
                                    </div>
                                    <div class="team-info"><?php
                                            // name
                                            $this->overcome_team_name($team);
                                            // position
                                            $this->overcome_team_position($team);
                                            // desc 
                                            $this->overcome_team_desc($team);
                                    ?></div>
                                <?php
                                    break;
                                } ?>
                            </div>
                        </div>
                    <?php if($i == $number_row || $j==$count) : ?>
                        </div>
                    <?php endif;
                    $i ++;
                }
            ?>
        </div>
        <?php if($layout_style === 'carousel'){
            overcome_loading_animation(); 
            ef5systems_owl_dots_container($atts);
            ef5systems_owl_nav_container($atts);
            ef5systems_owl_dots_in_nav_container($atts);
        } ?>
    </div>
</div>