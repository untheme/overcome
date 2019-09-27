<?php
/**
 * Custom Woocommerce shop page.
 *
 * @package UnBreak
 * @subpackage UnBreak
 * @since 1.0.0
 * @author EF5 Team
 *
 */
get_header();
?>
    <div class="container">
        <div class="row gutter-lg-60">
            <div id="ef5-content-area" class="<?php unbreak_content_css_class();?>">
                <div id="ef5-posts" class="ef5-posts ef5-blogs">
                    <?php woocommerce_content(); ?>
                </div>
            </div>
            <?php unbreak_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();