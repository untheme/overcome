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
            $item_class = ['counter-item'];
            switch($columns){
                case '2':
                    $item_class[] = 'col-md-6';
                    break;
                case '3':
                    $item_class[] = 'col-md-4';
                    break;
                case '4':
                    $item_class[] = 'col-md-6 col-lg-3';
                    break;
                case '5':
                    $item_class[] = 'col-md-6 col-lg-1/5';
                    break;
                case '6':
                    $item_class[] = 'col-md-4 col-lg-2';
                    break;
                default:
                    $item_class[] = 'col-12';
                    break;
            }
            for($i=1;$i<=$columns;$i++) { 
                $this->counter_icon($atts,$i);
            }
        ?>
    </div>
</div>