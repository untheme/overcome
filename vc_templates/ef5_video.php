<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $video_class = ['ef5-video', 'transition', 'overlay-wrap'];
?>
<div class="ef5-video-wrapper ef5-video-<?php echo esc_attr($layout_template);?>">
<div id="ef5-video-<?php echo esc_attr($el_id);?>">
    <?php switch ($layout_template) {
        case '2': 
    ?>
        <div class="ef5-video-info empty-none"><?php
            $this->overcome_ef5_video_small_heading($atts,['class' => 'text-22 ef5-text-accent']);
            $this->overcome_ef5_video_heading($atts, ['class' => 'text-36 ef5-text-primary']);
            $this->overcome_ef5_video_desc($atts);
            $this->overcome_ef5_video_link($atts);
        ?></div>
        <div class="<?php echo trim(implode(' ', $video_class));?>"><?php 
            $this->overcome_ef5_video_poster2($atts,['class' => 'ef5-shadow-2 ef5-rounded-10']);
        ?><div class="relative"><?php
            $this->overcome_ef5_video_poster($atts,['class' => 'ef5-shadow-2 ef5-rounded-10']);
            $this->overcome_ef5_video_plain($atts);
            $this->overcome_ef5_video_popup($atts,['overlay' => true, 'overlay_class' => 'ef5-rounded-10']);
        ?></div>
        </div>
    <?php
        break;
        default:
        $video_class[] = 'ef5-hover-shadow-2';
    ?>
        <div class="ef5-video-info empty-none"><?php
            $this->overcome_ef5_video_small_heading($atts,['class' => 'text-22 ef5-text-accent']);
            $this->overcome_ef5_video_heading($atts, ['class' => 'text-36 ef5-text-primary']);
            $this->overcome_ef5_video_desc($atts);
            $this->overcome_ef5_video_link($atts);
        ?></div>
        <div class="<?php echo trim(implode(' ', $video_class));?>"><?php 
            $this->overcome_ef5_video_poster2($atts);
            $this->overcome_ef5_video_poster($atts);
            $this->overcome_ef5_video_plain($atts);
            $this->overcome_ef5_video_popup($atts,['overlay' => true, 'overlay_class' => 'ef5-rounded-10']);
        ?></div>
    <?php
        break;
    } ?>
</div>
</div>