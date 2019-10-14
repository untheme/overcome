<?php 
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $css_classes = array(
        'ef5-counter-wraper',
        'ef5-counter-'.$layout_template,
        $el_class
    );
    if($counter_column > 1) $css_classes[] = 'multiple';
?>
<div id="<?php echo esc_attr('ef5-counter-'.$el_id);?>" class="<?php echo trim(implode(' ',$css_classes)); ?>">
    <div class="row justify-content-center">
        <?php
            $columns = (int)$counter_column;
            
            for($i=1;$i<=$columns;$i++) { 
                echo $this->counter_icon($atts,$i);
                $this->counter_number($atts,$i);
            }
        ?>
    </div>
</div>