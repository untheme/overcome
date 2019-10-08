<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
?>
<div class="ef5-video-wrapper ef5-video-<?php echo esc_attr($layout_template);?>">
<div id="ef5-video-<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ', $wrap_css_class));?>">
    <?php switch ($layout_template) {
        default:
    ?>
        <div class="ef5-video-info empty-none"><?php
            $this->overcome_ef5_video_small_heading($atts);
            $this->overcome_ef5_video_heading($atts);
            $this->overcome_ef5_video_desc($atts);
            $this->overcome_ef5_video_link($atts);
        ?></div>
        <div class="ef5-video <?php echo esc_attr($video_class);?>"><?php 
            $this->overcome_ef5_video_poster($atts);
            $this->overcome_ef5_video_play_button($atts);
            $this->overcome_ef5_video_popup($atts);
            $this->overcome_ef5_video_plain($atts);
        ?></div>
    <?php
            break;
    } ?>
</div>
</div>