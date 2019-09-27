<?php
/**
 * Header Top
 * Need add custom post type: header_top
 *
*/
if(!function_exists('unbreak_header_top')){
    function unbreak_header_top($class = ''){
        $header_top = unbreak_get_opts('header_top', '');
        $header_top_title = sanitize_title(get_the_title(unbreak_get_id_by_slug($header_top, 'ef5_header_top')));
        $classes = array('ef5-header-top', $header_top_title);
        $classes[] = $class;
        if(empty($header_top) || 'none' === $header_top) return;
    ?>
        <div id="ef5-header-top" class="<?php echo trim(implode(' ',$classes));?>">
        	<?php unbreak_content_by_slug($header_top,'ef5_header_top'); ?>
        </div>
    <?php
    }
}