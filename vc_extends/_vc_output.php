<?php
/**
 * Add custom attributes from custom param to VC Element
 * wp-content/plugins/js_composer/include/classes/shortcodes/shortcodes.php
 * https://kb.wpbakery.com/docs/developers-how-tos/
 * https://kb.wpbakery.com/docs/filters/
 *
*/
add_filter('vc_shortcode_output', 'unbreak_vc_shortcode_output', 10, 3);
function unbreak_vc_shortcode_output($html = '', $sc_obj = '', $atts = [])
{
    extract($atts);
    //modify shortcode use div as container
    $shortcode_modify = ['vc_section','vc_row', 'vc_row_inner', 'vc_column','vc_pie'];
    $shortcode_name = $sc_obj->getShortcode();
    if (!in_array($shortcode_name, $shortcode_modify))
        return $html;
    //
    $modify = [
        'attrs'       => [], // for add attrs can use string or array
        'before'      => '',
        'after'       => '',
        'first-child' => '',
        'last-child'  => '',
        'vc-pie-icon' => ''
    ];
    switch ($shortcode_name) {
        //case for $shortcode_modify element
        case 'vc_section':
            $vc_section_html = '<h2 class="d-none">&nbsp;</h2>';
            if(isset($parallax_overlay) && !empty($parallax_overlay))
                $vc_section_html = '<div class="parallax_overlay" style="background-color:'.esc_attr($parallax_overlay).'"></div>'; 

            $modify['first-child'] = $vc_section_html;
            break;
        case 'vc_row':
            $container_style = [];
            $container_class = ['container', 'clearfix'];
            if(isset($vc_row_container_background_color)){
                $container_class[] = $vc_row_container_background_color;
            }

            if(isset($text_color)){
            	$modify['attrs']['style'] = 'color:'.$text_color.';';
            }
            // Background Text
            if(isset($vc_row_background_text) && !empty($vc_row_background_text)){
                $vc_row_background_text_attrs = $vc_row_background_text_css = [];
                $vc_row_background_text_css_class = [
                    'ef5-heading',
                    'ef5-row-bg-text',
                    !empty($vc_row_background_text_pos) ? $vc_row_background_text_pos : '', 
                    !empty($vc_row_background_text_style) ? 'font-style-'.$vc_row_background_text_style : '', 
                    !empty($vc_row_background_text_transform) ? 'text-'.$vc_row_background_text_transform : '',
                ];
                $vc_row_background_text_attrs[] = 'class="'.unbreak_optimize_css_class(implode(' ', $vc_row_background_text_css_class)).'"';
                if(!empty($vc_row_background_text_size)) $vc_row_background_text_css[]           = 'font-size:'.(int)$vc_row_background_text_size.'px'; 
                if(!empty($vc_row_background_text_color)) $vc_row_background_text_css[]          = 'color:'.$vc_row_background_text_color;
                if(!empty($vc_row_background_text_letter_spacing)) $vc_row_background_text_css[] = 'letter-spacing:'.(int)$vc_row_background_text_letter_spacing.'px';
                if(!empty($vc_row_background_text_line_height)) $vc_row_background_text_css[]    = 'line-height:'.$vc_row_background_text_line_height;
                if(!empty($vc_row_background_text_css)) 
                    $vc_row_background_text_attrs[] = 'style="'.trim(implode(';',$vc_row_background_text_css)).'"';

                $vc_row_background_text_tag = 'div';
                if(isset($vc_row_background_text_behavior)){
                    //var_dump($vc_row_background_text_direction);
                    $direction = isset($vc_row_background_text_direction) ? $vc_row_background_text_direction : 'left';
                    $vc_row_background_text_tag = 'marquee';
                    $vc_row_background_text_attrs[] = 'behavior="'.$vc_row_background_text_behavior.'"';
                    $vc_row_background_text_attrs[] = 'direction="'.$direction.'"';
                    if($direction === 'left' || $direction === 'right'){
                        $vc_row_background_text_attrs[] = 'scrollamount="30"';
                        $vc_row_background_text_attrs[] = 'scrolldelay="60"';
                    }
                }
                
                $modify['first-child'] .= '<'.$vc_row_background_text_tag.' '.implode(' ', $vc_row_background_text_attrs).'>'.unbreak_html($vc_row_background_text).'</'.$vc_row_background_text_tag.'>';
            }
            /* parallax overlay color */
            if(isset($parallax_overlay) && !empty($parallax_overlay)){
            	$modify['first-child'] .= '<div class="parallax-overlay" style="background-color:'.esc_attr($parallax_overlay).'"></div>';
            }
            if(!isset($full_width) || $full_width === ''){
	            $modify['before']      .= '<div class="container">'; //ex: '<div class="d-none">Row Before</div>';
	            $modify['after']       .= '</div>'; //ex: '<div class="d-none">Row after</div>';
	        }
	        if(isset($full_width) && $full_width === 'stretch_row'){
                $align_items = '';
                if(isset($content_placement) && !empty($content_placement)){
                    switch ($content_placement) {
                        case 'top':
                            $align_items = 'align-items-start';
                            break;
                        case 'middle':
                            $align_items = 'align-items-center';
                            break;
                        case 'bottom':
                            $align_items = 'align-items-end';
                    }
                }
	        	$modify['first-child'] .= '<div class="'.implode(' ', $container_class).'"><div class="row '.$align_items.'">';
	        	$modify['last-child']  .= '</div></div>';
	        }
            // Stretch row style 2
            if(isset($full_width) && $full_width === 'stretch_row_content2'){
                $align_items = '';
                $container_class[] = 'ef5-container2';
                if(isset($content_placement) && !empty($content_placement)){
                    switch ($content_placement) {
                        case 'top':
                            $align_items = 'align-items-start';
                            break;
                        case 'middle':
                            $align_items = 'align-items-center';
                            break;
                        case 'bottom':
                            $align_items = 'align-items-end';
                    }
                }
                $modify['first-child'] .= '<div class="'.implode(' ', $container_class).'"><div class="row '.$align_items.'">';
                $modify['last-child']  .= '</div></div>';
            }
            // Stretch row style 3
            if(isset($full_width) && $full_width === 'stretch_row_content3'){
                $align_items = '';
                $container_class[] = 'ef5-container3';
                if(isset($content_placement) && !empty($content_placement)){
                    switch ($content_placement) {
                        case 'top':
                            $align_items = 'align-items-start';
                            break;
                        case 'middle':
                            $align_items = 'align-items-center';
                            break;
                        case 'bottom':
                            $align_items = 'align-items-end';
                    }
                }
                $modify['first-child'] .= '<div class="'.implode(' ', $container_class).'"><div class="row '.$align_items.'">';
                $modify['last-child']  .= '</div></div>';
            }
            break;
        case 'vc_row_inner':
            if(isset($vc_row_inner_stretch) && $vc_row_inner_stretch === 'container'){
                $modify['before']      .= '<div class="container">';
                $modify['after']       .= '</div>';
            }
            break;
        case 'vc_column':
            if(isset($text_color)) $modify['attrs']['style'] = 'color:'.$text_color.';';//modify by array
            if(isset($parallax_overlay) && !empty($parallax_overlay))$modify['first-child'] = '<div class="parallax-overlay" style="background-color:'.esc_attr($parallax_overlay).'"></div>'; //ex: '<div class="d-none">col first child</div>';
            $modify['last-child']  = ''; //ex: '<div class="d-none">col last child</div>';
            $modify['before']      = ''; //ex: '<div class="d-none">col Before</div>';
            $modify['after']       = ''; //ex: '<div class="d-none">col after</div>';
            break;
        case 'vc_pie':
            if(isset($add_icon) &&  $add_icon){
                $i_type = isset($i_type) ? $i_type : 'linear';
                // Enqueue needed icon font.
                vc_icon_element_fonts_enqueue( $i_type );
                $icon_name = isset($i_type) ? 'i_icon_' . $i_type : 'i_icon_linear';
                $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name] : '';
                if(!empty($iconClass)) $modify['vc-pie-icon'] = '<span class="vc-pie-icon '.$iconClass.'"></span>';
            }
            break;
        default:
            return $html;
            break;
    }
    //begin modify
    if (!empty($modify['attrs'])) {
        if (is_array($modify['attrs']))
        {
            $custom_attr_str =[];
            foreach ($modify['attrs'] as $key => $value) {
                $value = esc_attr($value);
                $custom_attr_str[] = "{$key}=\"{$value}\"";
            }
            $custom_attr_str = join(' ',$custom_attr_str);
        }
        else
            $custom_attr_str = $modify['attrs'];
        $html = '<div ' . $custom_attr_str . substr($html, 4);
    }
    if (!empty($modify['first-child'])) {
        $html_exp = explode('>', $html);
        $html_exp[1] = $modify['first-child'] . $html_exp[1];
        $html = join('>', $html_exp);
    }
    if (!empty($modify['last-child'])) {
        $html_exp = explode('</div>', $html);
        if (count($html_exp) > 2) {
            for ($index = count($html_exp) - 1; $index > 0; $index--) {
                if (empty(trim($html_exp[$index - 1])))
                    break;
            }
            $html_exp[$index - 1] .= $modify['last-child'];
            $html = join('</div>', $html_exp);
        } else
            $html = substr($html, 0, -6) . $modify['last-child'] . '</div>';
    }
    if (!empty($modify['before']))
        $html = $modify['before'] . $html;
    if (!empty($modify['after']))
        $html = $html . $modify['after'];

    if (!empty($modify['vc-pie-icon'])) {
        $html = str_replace ('<span class="vc_pie_chart_value"></span>', $modify['vc-pie-icon'].'<span class="vc_pie_chart_value"></span>', $html );
    }

    return $html;
}

/**
 * Change default class name of VC to use Bootstrap 4.x
 *
 * Filter to replace default css class names for vc_row shortcode and vc_column
 * https://kb.wpbakery.com/docs/filters/vc_shortcodes_css_class/
*/
add_filter( 'vc_shortcodes_css_class', 'unbreak_css_classes_for_vc_row_and_vc_column', 10, 2 );
function unbreak_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
    if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
        $class_string = str_replace( 'vc_row ', 'vc_row row ', $class_string );
        $class_string = str_replace( 'vc_row-has-fill', 'has-fill', $class_string );
    }
    if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
        $class_string = preg_replace( '/vc_col-has-fill/', 'vc-col-has-fill', $class_string );
        $class_string = preg_replace( '/vc_col-lg-(\d{1,2})/', 'col-xl-$1', $class_string );
        $class_string = preg_replace( '/vc_col-md-(\d{1,2})/', 'col-lg-$1', $class_string );
        $class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string );
        $class_string = preg_replace( '/vc_col-xs-(\d{1,2})/', 'col-$1', $class_string );
        // offset 
        $class_string = preg_replace( '/vc_col-lg-offset-(\d{1,2})/', 'offset-xl-$1', $class_string );
        $class_string = preg_replace( '/vc_col-md-offset-(\d{1,2})/', 'offset-lg-$1', $class_string );
        $class_string = preg_replace( '/vc_col-sm-offset-(\d{1,2})/', 'offset-md-$1', $class_string );
        $class_string = preg_replace( '/vc_col-xs-offset-(\d{1,2})/', 'offset-$1', $class_string );
    }
    return $class_string; // Important: you should always return modified or original $class_string
}

/**
 * Add custom class from custom param to VC Element
 * https://kb.wpbakery.com/docs/filters/vc_shortcodes_css_class/
 *
 */
add_filter('vc_shortcodes_css_class', 'unbreak_vc_shortcodes_css_class', 10, 3);
function unbreak_vc_shortcodes_css_class($class_string, $tag, $atts = '')
{
    $custom_class = array();
    extract($atts);
    if ($tag == 'vc_section') {
        if (isset($vc_row_priority)) {
            $custom_class[] = $vc_row_priority;
        }
        if (isset($vc_row_default_theme_background_img_pos)) {
            $custom_class[] = $vc_row_default_theme_background_img_pos;
        }
    }
    if ($tag == 'vc_row') {
        if (isset($vc_row_priority)) {
            $custom_class[] = $vc_row_priority;
        }
        if (isset($vc_row_padding)) {
            $custom_class[] = $vc_row_padding;
        }
        if (isset($vc_row_default_theme_background_img_pos)) {
            $custom_class[] = $vc_row_default_theme_background_img_pos;
        }
        if (isset($vc_row_default_theme_background_color)) {
            $custom_class[] = $vc_row_default_theme_background_color;
        }
        if(isset($vc_row_divider) && !empty($vc_row_divider))
            $custom_class[] = $vc_row_divider;
        if(isset($vc_row_divider_color) && !empty($vc_row_divider_color))
            $custom_class[] = $vc_row_divider_color;
        if(isset($remove_overflow) && $remove_overflow === '1'){
            $custom_class[] = 'no-overflow-hidden';
        } 
        if(isset($text_color_opts) && $text_color_opts !== ''){
            $custom_class[] = 'text-'.$text_color_opts;
        } 
        if(isset($link_color_opts) && $link_color_opts !== ''){
            $custom_class[] = 'link-'.$link_color_opts;
        }
    }
    if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        if (isset($gap)) {
            $custom_class[] = 'vc-column-gap-'.$gap;
        }
        if (isset($vc_col_priority)) {
            $custom_class[] = $vc_col_priority;
        }
        if (isset($vc_col_padding)) {
            $custom_class[] = $vc_col_padding;
        }
        if (isset($vc_col_content_align)) {
            $custom_class[] = $vc_col_content_align;
        }
        if (isset($element_display) && !empty($element_display) ) {
            $custom_class[] = 'element-'.$element_display;
        }
        if (isset($vc_col_element_align) && !empty($vc_col_element_align)) {
            $custom_class[] = 'justify-content-'.$vc_col_element_align;
        }
        if (isset($vc_col_default_theme_background_color)) {
            $custom_class[] = $vc_col_default_theme_background_color;
        }
        if(isset($vc_col_custom_position)){
            $custom_class[] = $vc_col_custom_position;
        }
    }
    /* add custom loading delay time for VC Grid */
    if ($tag == 'vc_basic_grid' || $tag == 'vc_masonry_grid' || $tag == 'vc_media_grid' || $tag == 'vc_masonry_media_grid') {
        if (isset($element_width) && $element_width) {
            $custom_class[] = 'ef5-iw-' . $element_width;
        }
        if (isset($item) && $item) {
            $custom_class[] = $item;
        }

        if (isset($vcbg_hover) && $vcbg_hover) {
            $custom_class[] = $vcbg_hover;
        }

        if (isset($vcbg_space) && $vcbg_space) {
            $custom_class[] = 'vc_gitem-row-' . $vcbg_space;
        }

        if (isset($delay_time) && $delay_time) {
            $custom_class[] = 'zk-loading-delay-' . $delay_time;
        }

        if (isset($pagination_top_space) && $pagination_top_space) {
            $custom_class[] = 'pagination-top-' . $pagination_top_space;
        }
    }
    /* add css class for vc single image */
    if($tag == 'vc_single_image'){
        if(isset($style) && !empty($style) ){
            $custom_class[] = $style;
        }
        if(isset($border_color) && !empty($border_color) ){
            $custom_class[] = 'vc_box_border_'.$border_color;
        }
    }
    // add css class to vc_progress_bar
    if($tag == 'vc_progress_bar'){
        if(isset($vc_progress_bar_template))
            $custom_class[] = 'layout-'.$vc_progress_bar_template;
    }

    $class_string .= ' ' . trim(implode(' ', $custom_class));
    return $class_string;
}