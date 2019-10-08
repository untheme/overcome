<?php
    $title = $el_class = $video_source = $online_video = $uploaded_video = $embed_video = $poster = $poster_style = $autoplay = $muted = $loop = $preload = $controls = $show_btn = $btn_link = $bg_video_color = $bg_video_src_mp4 = $bg_video_src_ogv = $bg_video_src_ogg = $bg_video_src_webm = $video_width = $video_height = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

$wrap_css_class = array('ef5-video-'.$layout_template, 'video-source-'.$video_source, $el_class,'row','align-items-center');

$bg_video_args = array();
if ($bg_video_src_mp4)  $bg_video_args['mp4'] = $bg_video_src_mp4;
if ($bg_video_src_ogg)  $bg_video_args['ogg'] = $bg_video_src_ogg;
if ($bg_video_src_ogv)  $bg_video_args['ogv'] = $bg_video_src_ogv;
if ($bg_video_src_webm) $bg_video_args['webm'] = $bg_video_src_webm;
if($video_source == '3' && empty($bg_video_args)){
    esc_html_e('No video found!','overcome');
    return;
}
global $wp_embed;

$title_attrs = [];
$desc_attrs = ['class="ef5-video-desc clearfix '.$this->getCSSAnimation('fadeIn').'"'];
$title_border_style = [];

// Heading
$title_css_classes = ['ef5-heading', 'large-heading', 'text-40'];
if(!empty($title_color)) $title_css_classes[] = 'text-'.$title_color;
$title_css_classes[] = $this->getCSSAnimation('fadeIn');
$title_attrs[] = 'class="'.implode(' ', $title_css_classes).'"';
// Heading Part
$title_part_css_classes = ['title-part'];
if(!empty($title_part_color)) $title_part_css_classes[] = 'text-'.$title_part_color;
$title_part_attrs[] = 'class="'.implode(' ', $title_part_css_classes).'"';
if(!empty($title_part_color_custom)) $title_part_attrs[] = 'style="color:'.$title_part_color_custom.'"';

$title_part = '<span '.implode(' ', $title_part_attrs).'>'.$title_part.'</span>';


if(!empty($title_color_custom)) {
    $title_attrs[] = 'style="color:'.esc_attr($title_color_custom).'"';
    $title_border_style[] = '#ef5-video-'.esc_attr($el_id).' .el-title:after{background-color:'.esc_attr($title_color_custom).'}';
}
if(!empty($title_border_style)) echo '<div class="ef5-inline-css" data-css="'.trim(implode(';', $title_border_style)).'"></div>';

if(!empty($content_color)) {
    $desc_attrs[] = 'style="color:'.esc_attr($content_color).'"';
}

$play_btn_url = get_template_directory_uri().'/assets/images/play-btn-'.$play_btn.'.png';
if($play_btn === 'custom') $play_btn_url = overcome_get_image_url_by_size([
    'id'            => $play_btn_custom,
    'size'          => '80',
    'default_thumb' => true,
    'class'         => 'circle'
]);

$ef5_waves = '<div class="ef5-wave-wrap"><div class="circle delay1 ef5-wave infinite"></div> <div class="circle delay2 ef5-wave infinite"></div><div class="circle delay3 ef5-wave infinite"></div><div class="circle delay4 ef5-wave infinite"></div></div>';

switch ($layout_template) {
    case '5':
        $video_info_class = 'col-12';
        $video_class = 'col-12';
        break;
    case '2':
        $wrap_css_class[] = 'gutters-100';
        $video_info_class = 'col-lg-6 order-2';
        $video_class = 'col-lg-6';
        break;
    
    default:
        $video_info_class = 'col-lg-5';
        $video_class = 'col-xl-7 col-lg-6 offset-lg-1 offset-xl-0';
        break;
}
?>
<div class="ef5-video-wrapper ef5-video-<?php echo esc_attr($layout_template);?>">
<div id="ef5-video-<?php echo esc_attr($el_id);?>" class="<?php echo overcome_optimize_css_class(implode(' ', $wrap_css_class));?>">
    <?php switch ($layout_template) {
        case '5':
    ?>
        <div class="ef5-video <?php echo esc_attr($video_class);?>">
        <?php switch ($video_type) {
            case '2':  /* popup video */
                if(!empty($poster)){
                    echo '<div class="ef5-video-popup-wrap overlay-wrap d-flex justify-content-center justify-content-lg-end"><div class="ef5-video-popup-inner relative">';
                    echo overcome_html($this->overcome_ef5_video_poster($atts));
                }
                    echo overcome_html($this->overcome_ef5_video_popup($atts,['anim' => $play_btn_effect]));
                if(!empty($poster)) echo '</div></div>';
                break;
            default:
                echo overcome_html($this->overcome_ef5_video_plain($atts));
                break;
        } ?>
        </div>
        <div class="ef5-video-info <?php echo esc_attr($video_info_class);?>"><?php 
            echo overcome_html($this->overcome_ef5_video_small_heading($atts)); 
            echo overcome_html($this->overcome_ef5_video_heading($atts)); 
            echo overcome_html($this->overcome_ef5_video_desc($atts)); 
        ?></div>
    <?php
            break;
        default:
    ?>
        <?php if( $title || $content ) : ?>
        <div class="ef5-video-info <?php echo esc_attr($video_info_class);?>">
            <?php if($small_heading){ ?>
                <div class="ef5-heading small-heading text-14 <?php echo esc_attr($this->getCSSAnimation('fadeIn'));?>"><?php echo esc_html($small_heading);?></div>
            <?php }
            if($title){ ?>
                <div <?php echo overcome_optimize_css_class(implode(' ', $title_attrs));?>><?php echo implode(' ', [$title, $title_part]);?></div>
            <?php }
            if($content){ ?>
                <div <?php echo trim(implode(' ', $desc_attrs));?>>
                    <?php echo esc_attr($content);?>
                </div>
            <?php } ?>
            <div class="ef5-button-wrapper d-flex align-items-center">
                <?php if($layout_template === '2') echo overcome_html($this->overcome_ef5_video_play_button($atts,['anim' => $play_btn_effect])); ?>
                <?php overcome_html($this->overcome_ef5_video_link($atts)); ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="ef5-video <?php echo esc_attr($video_class);?>">
        <?php switch ($video_type) {
            case '2':  /* popup video */
                if(!empty($poster)){
                    echo '<div class="ef5-video-popup-wrap overlay-wrap d-flex justify-content-center justify-content-lg-end"><div class="ef5-video-popup-inner relative">';
                    echo overcome_html($this->overcome_ef5_video_poster($atts));
                }
                    echo overcome_html($this->overcome_ef5_video_popup($atts,['anim' => $play_btn_effect]));
                if(!empty($poster)) echo '</div></div>';
                break;
            default:
                echo overcome_html($this->overcome_ef5_video_plain($atts));
                break;
        } ?>
        </div>
    <?php
            break;
    } ?>
</div>
</div>