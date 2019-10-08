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
            $item_class = ['counter-item', 'counter-size-'.$counter_size];
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
            for($i=1;$i<=$columns;$i++) { ?>
                    <?php
                        $title      = isset($atts['title'.$i]) ? $atts['title'.$i] : '';
                        $desc       = isset($atts['desc'.$i]) ? $atts['desc'.$i] : '';
                        $i_type     = isset($atts['i'.$i.'_type']) ? $atts['i'.$i.'_type'] : '';
                        $add_icon   = isset($atts['add_icon'.$i]) ? $atts['add_icon'.$i] : '';
                        $icon       = isset($atts['i'.$i.'_icon_'.$i_type]) ? $atts['i'.$i.'_icon_'.$i_type] : '';
                        $icon_color = isset($atts['icon'.$i.'_color']) ? $atts['icon'.$i.'_color'] : '';
                        $suffix     = isset($atts['suffix'.$i]) ? $atts['suffix'.$i] : '';
                        $prefix     = isset($atts['prefix'.$i]) ? $atts['prefix'.$i] : '';
                        $digit      = isset($atts['digit'.$i]) ? $atts['digit'.$i] : '';
                        $digit_color      = isset($atts['digit'.$i.'_color']) ? $atts['digit'.$i.'_color'] : '';
                    if(!empty($title) || !empty($desc) || !empty($add_icon) || !empty($suffix) || !empty($prefix) || !empty($digit)) {
                        /* call icon font css */
                        vc_icon_element_fonts_enqueue($i_type);
                    ?>
                    <div class="<?php echo trim(implode(' ', $item_class));?>">
                        <div class="ef5-counter-wrap-inner">
                            <?php if( $add_icon === 'true' && !empty($icon) ): ?>
            					<span class="counter-icon"><span class="<?php echo esc_attr($icon); ?>" <?php if(!empty($icon_color)) :?>style="color:<?php echo esc_attr($icon_color);?>" <?php endif; ?>></span></span>
            				<?php endif; ?>
            				<div class="ef5-counter-wrap" data-prefix="<?php echo esc_attr($prefix);?>" data-suffix="<?php echo esc_attr($suffix);?>" data-type="<?php echo esc_attr($counter_type);?>" data-digit="<?php echo esc_attr($digit);?>">
                                <?php if(!empty($prefix)) echo '<span class="prefix">'.esc_html($prefix).'</span>'; ?>
                                <span class="ef5-counter ef5-heading accent-color" <?php if(!empty($digit_color)): ?> style="color:<?php echo esc_attr($digit_color);?>;"<?php endif;?>><?php echo esc_attr($digit); ?></span>
                                <?php if(!empty($suffix)) echo '<span class="suffix">'.esc_html($suffix).'</span>'; ?>
            				</div>
                            <?php if($title):?>
                                <div class="ef5-heading counter-title"><?php echo esc_html($title);?></div>
                            <?php endif;?>
                            <?php if($desc):?>
                                <div class="counter-desc"><?php echo overcome_html($desc);?></div>
                            <?php endif;?>
                        </div>
        			</div>
            <?php }
            }
        ?>
    </div>
</div>