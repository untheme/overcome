<?php
// Enable Instagram Widget
if (!function_exists('enable_instagram_widget')) {
    add_filter('enable_instagram_widget', 'overcome_instagram');
    function overcome_instagram()
    {
        return true;
    }
}
// Update Instagrame username from theme options to widget
if (!function_exists('overcome_instagram_api_username')) {
    add_filter('ef5_instagram_api_username', 'overcome_instagram_api_username');
    function overcome_instagram_api_username()
    {
        return overcome_get_theme_opt('instagram_api_username', '');
    }
}

// Update Instagrame api key from theme options to widget
if (!function_exists('overcome_instagram_api_key')) {
    add_filter('ef5systems_instagram_api_key', 'overcome_instagram_api_key');
    function overcome_instagram_api_key()
    {
        return overcome_get_theme_opt('instagram_api_key', '');
    }
}
/**
 * Custom layout 
 * add_filter('ef5systems_instagram_custom_layout','overcome_instagram_custom_layout');
 */
if (!function_exists('overcome_instagram_custom_layout')) {
    function overcome_instagram_custom_layout()
    {
        return [
            '1' => esc_html__('Layout 1', 'overcome'),
            '2' => esc_html__('Layout 2', 'overcome'),
            '3' => esc_html__('Layout 3', 'overcome'),
        ];
    }
}
// Output HTML 
if (!function_exists('overcome_instagram_html_output')) {
    add_filter('ef5systems_instagram_output_html', 'overcome_instagram_html_output', 10, 1);
    function overcome_instagram_html_output($args = [])
    {
        extract($args);
        $args = wp_parse_args($args, [
            'layout_mode'   => 'default',
            'span'          => '4',
            'columns_space' => '0',
            'media_array'   => [],
            'size'          => 'small',
            'target'        => '_sefl',
            'show_like'     => '1',
            'show_cmt'      => '1',
            'show_author'   => '1',
            'author_text'   => '',
            'username'      => ''
        ]);
        
        switch ($layout_mode) {
            case '0':
                echo '<div class="ef5-instagram layout-' . $layout_mode . '">';
                if ($show_author) { 
                    $avatar_src = $media_array[0]['avatar'];
                    $follower = $media_array[0]['follower'];
                    $following = $media_array[0]['following'];
                ?>
                    <div class="user d-flex gutter-15 align-items-center">
                        <div class="user-avatar">
                            <a href="//instagram.com/<?php echo trim($username); ?>" target="<?php echo esc_attr($target); ?>">
                                <img src="<?php echo esc_url($avatar_src);?>"/>
                            </a>
                        </div>
                        <div class="user-data">
                            <a href="//instagram.com/<?php echo trim($username); ?>" target="<?php echo esc_attr($target); ?>">
                                <?php 
                                if (!empty($author_text)) 
                                    echo '<span class="author-text">' . esc_html($author_text) . '</span>';
                                else
                                    echo '<span class="author-name">' . trim($username) . '</span>'; 
                                ?>
                            </a>
                            <div class="user-follow">
                                <span class="follower"><?php echo esc_attr($follower)?> <?php echo esc_html__('Followers','overcome')?></span>
                                <span class="following"><?php echo esc_attr($following)?> <?php echo esc_html__('Following','overcome')?></span>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
                <div class="ef5-instagram-wrap row grid-gutters-<?php echo esc_attr($columns_space); ?> clearfix">
                    <?php
                    foreach ($media_array as $item) {
                        ?>
                        <div class="<?php echo trim(implode(' ', array('instagram-item', $span, 'overlay-wrap'))); ?>">
                            <a class="ins-img" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>">
                                <img src="<?php echo esc_url($item[$size]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                            </a>
                            <div class="overlay d-flex align-items-center animated" data-animation-in="zoomIn" data-animation-out="zoomOut">
                                <div class="overlay-inner col-12 text-center">
                                    <a class="ins-icon" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-instagram"></span></a>
                                    <?php if ($show_like) : ?><a class="like" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-heart-o"></span><span><?php echo esc_html($item['likes']); ?></span></a><?php endif; ?>
                                    <?php if ($show_cmt) : ?><a class="comments" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-comments-o"></span><span><?php echo esc_html($item['comments']); ?></span></a><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php 
                echo '</div>';
            break;
            default:
                echo '<div class="ef5-instagram layout-' . $layout_mode . '">';
                ?>
                <div class="ef5-instagram-wrap row grid-gutters-<?php echo esc_attr($columns_space); ?> clearfix">
                    <?php
                    foreach ($media_array as $item) {
                        ?>
                        <div class="<?php echo trim(implode(' ', array('instagram-item', $span, 'overlay-wrap'))); ?>">
                            <a class="ins-img" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>">
                                <img src="<?php echo esc_url($item[$size]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                            </a>
                            <div class="overlay d-flex align-items-center animated" data-animation-in="zoomIn" data-animation-out="zoomOut">
                                <div class="overlay-inner col-12 text-center">
                                    <a class="ins-icon" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-instagram"></span></a>
                                    <?php if ($show_like) : ?><a class="like" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-heart-o"></span><span><?php echo esc_html($item['likes']); ?></span></a><?php endif; ?>
                                    <?php if ($show_cmt) : ?><a class="comments" href="<?php echo esc_url($item['link']); ?>" target="<?php echo esc_attr($target); ?>"><span class="fa fa-comments-o"></span><span><?php echo esc_html($item['comments']); ?></span></a><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($show_author) { ?>
                    <div class="user"><a href="//instagram.com/<?php echo trim($username); ?>" target="<?php echo esc_attr($target); ?>"><?php if (!empty($author_text)) echo '<span class="author-text">' . esc_html($author_text) . '</span>';
                    echo '<span class="author-name">@' . trim($username) . '</span>'; ?></a></div>
                <?php
                }
                echo '</div>';
            break;
        }
    }
}
