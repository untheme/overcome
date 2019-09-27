<?php
/**
 * Language direction 
*/
function unbreak_direction($return = true){
    $unbreak_direction = is_rtl() ? 'dir-right' : 'dir-left';
    if($return)
        return $unbreak_direction;
    else 
        echo esc_attr($unbreak_direction);
}
/**
 * get text-align left / right for RTL language 
*/
function unbreak_align($return = true){
    $unbreak_align = is_rtl() ? 'right' : 'left';
    if($return)
        return $unbreak_align;
    else 
        echo esc_attr($unbreak_align);
}
function unbreak_align2($return = true){
    $unbreak_align = is_rtl() ? 'left' : 'right';
    if($return)
        return $unbreak_align;
    else 
        echo esc_attr($unbreak_align);
}
// Custom space
function unbreak_spacing($mode = '',$dir = '',$space = '', $echo = true){
    if(empty($mode) || empty($space) || empty($dir)) return;
    if(is_rtl() && $dir = 'r'){
        $_dir = 'l';
    } elseif (is_rtl() && $dir = 'l') {
        $_dir = 'r';
    } else {
        $_dir = $dir;
    }
    if($echo) {
        echo esc_attr($mode.$_dir.'-'.$space);
    } else {
        return esc_attr($mode.$_dir.'-'.$space);
    }
}
// Optimize CSS class
function unbreak_optimize_css_class($string){
    $string = preg_replace('!\s+!', ' ', $string);
    return $string;
}
/**
 * Page CSS Class
*/
function unbreak_page_css_class($class = ''){
    $cls = apply_filters('unbreak_page_css_class',[]);
    $classes = array_merge(
        [
            'ef5-page',
            'page-header-'.unbreak_get_opts('header_layout', '1'),
            $class
        ], 
        $cls
    );
    if(unbreak_get_opts('header_ontop', '0') === '1' || unbreak_get_opts('header_sticky', '0') === '1'){
       $classes[] = 'page-header-ontop';
    }
    echo trim(implode(' ', $classes));
}

/*
 * Archive sidebar position 
*/
function unbreak_archive_sidebar_position(){
    return apply_filters('unbreak_archive_sidebar_position','bottom');
}
/*
 * Page sidebar position 
*/
function unbreak_page_sidebar_position(){
    return apply_filters('unbreak_page_sidebar_position','bottom');
}
/*
 * Archive content  grid column
*/
function unbreak_archive_grid_col(){
    return apply_filters('unbreak_archive_grid_col','8');
}
/*
 * Single Post sidebar position 
*/
function unbreak_post_sidebar_position(){
    return apply_filters('unbreak_post_sidebar_position','bottom');
}
/*
 * Single Portfolio sidebar position 
*/
function unbreak_portfolio_sidebar_position(){
    return apply_filters('unbreak_portfolio_sidebar_position','bottom');
}
/*
 * Content area css class
*/
function unbreak_get_sidebar($check = true){
    $sidebar = 'none';
    if(is_post_type_archive('post') || is_singular('post') || is_home()){
        $sidebar = 'sidebar-main';
    } elseif (is_post_type_archive('portfolio') || is_singular('ef5_portfolio')) {
        $sidebar = 'sidebar-portfolio';
    } elseif (is_page()) {
        if (class_exists('WooCommerce') && (is_checkout() || is_cart())) {
            $sidebar = 'sidebar-shop';
        } else {
            $sidebar = 'sidebar-page';
        }
    } elseif (class_exists('WooCommerce') && (is_woocommerce() || is_post_type_archive('product') || is_singular('product') ) ) {
        $sidebar = 'sidebar-shop';
    } elseif (is_archive() || is_search()){
        $sidebar = 'sidebar-main';
    }
    if($check)
        return is_active_sidebar($sidebar);
    else 
        return $sidebar;
}
function unbreak_sidebar_position(){
    if((is_archive() || is_post_type_archive('post') || is_home() || is_search()) && !is_post_type_archive('product')){
        $sidebar_position = unbreak_get_opts('archive_sidebar_pos', unbreak_archive_sidebar_position());
    } elseif(is_post_type_archive('portfolio')){
        $sidebar_position = unbreak_get_opts('portfolio_archive_sidebar_pos', unbreak_archive_sidebar_position());
    } elseif(is_page()){
        if (class_exists('WooCommerce') && (is_checkout() || is_cart())) {
            $sidebar_position = unbreak_get_opts('page_sidebar_pos',unbreak_shop_sidebar_position());
        } else {
            $sidebar_position = unbreak_get_opts('page_sidebar_pos',unbreak_page_sidebar_position());
        }
    } elseif (is_singular('post')) {
        $sidebar_position = unbreak_get_opts('post_sidebar_pos',unbreak_post_sidebar_position());
    } elseif (is_singular('ef5_portfolio')) {
        $sidebar_position = unbreak_get_opts('portfolio_sidebar_pos',unbreak_portfolio_sidebar_position());
    } elseif (class_exists('WooCommerce') && is_post_type_archive('product')) {
        $sidebar_position = unbreak_get_opts('shop_sidebar_pos',unbreak_shop_sidebar_position());
    } elseif (is_singular('product')) {
        $sidebar_position = unbreak_get_opts('product_sidebar_pos',unbreak_product_sidebar_position());
    } else {
        $sidebar_position = 'none';
    }
    return $sidebar_position;
}

function unbreak_content_css_class($class=''){
    $classes = [
        'ef5-content-area',
        $class
    ];
    $sidebar            = unbreak_get_sidebar();
    $sidebar_position   = unbreak_sidebar_position();
    $content_grid_class = unbreak_get_opts('archive_grid_col', unbreak_archive_grid_col());
    
    if( $sidebar_position === 'bottom' ){
        $classes[] = 'col-12 has-gtb';
    } else {
        if($sidebar && ('none' !== $sidebar_position || 'center' == $sidebar_position)){
            $classes[] = 'col-lg-'.$content_grid_class;
            if($sidebar_position == 'left') $classes[] = 'order-lg-1';
            if($sidebar_position == 'center') $classes[] = 'offset-lg-2';
        } else {
            $classes[] = 'col-12';
        }
    }

    echo unbreak_optimize_css_class(implode(' ', $classes));
}
/**
 * Show Widget 
*/

function unbreak_sidebar(){
    $sidebar            = unbreak_get_sidebar(false);
    $sidebar_position   = unbreak_sidebar_position();
    if($sidebar_position === 'none' || $sidebar_position === 'center') return;
    if( is_active_sidebar( $sidebar ) ) {
    ?>
        <div id="ef5-sidebar-area" class="<?php unbreak_sidebar_css_class(); ?>">
            <div class="sidebar-inner">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php }
}

/*
 * Widget area css class
*/
function unbreak_sidebar_css_class($class=''){
    $classes = [
        'ef5-sidebar-area',
        $class
    ];
    if(!is_singular() || is_single() || !is_page_template()) $classes[] = 'ef5-blogs';
    $sidebar_position   = unbreak_sidebar_position();
    if( $sidebar_position === 'bottom' ){
        $classes[] = 'col-12 has-gtb';
    } else {
        $content_grid_class = (int) unbreak_get_opts('archive_grid_col', unbreak_archive_grid_col());
        $sidebar_grid_class = 12 - $content_grid_class;
        $classes[] = 'col-lg-'.$sidebar_grid_class; 
    }

    echo unbreak_optimize_css_class(implode(' ', $classes));
}