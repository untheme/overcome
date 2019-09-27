<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
                <?php
					while ( have_posts() ) :
						the_post();
                        unbreak_post_content();
                        unbreak_link_pages();
                        posts_nav_link();
                        unbreak_comment();
					endwhile;
                ?>
                </div>
            </div>
            <?php unbreak_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();