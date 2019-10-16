<?php
if(!class_exists('NewsletterWidgetMinimal') && !class_exists('NewsletterWidget')) return;
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $wrapper_class = array('ef5-newsletter', $layout_mode, 'ef5-newsletter-'.$layout_template, $el_class);
?>
<div class="<?php echo trim(implode(' ',$wrapper_class)); ?>">
    <?php switch ($layout_mode) {
        case 'minimal':
            echo do_shortcode('[newsletter_form type="minimal" button="'.esc_attr($btn_text).'" button_color="" placeholder="'.esc_attr($email_text).'"  class="'.esc_attr($el_class).'"][/newsletter_form]');
            break;
        default:
            echo do_shortcode('[newsletter_form button_label="'.esc_attr($btn_text).'" class="'.esc_attr($el_class).'"][/newsletter_form][newsletter_form lists_field_layout="dropdown" lists_field_empty_label="Select..." lists_field_label="Our topics"]');
            break;
    } ?>
</div>