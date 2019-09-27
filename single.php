<?php
/**
 * The template for displaying single post
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
                <div class="ef5-blogs">
                <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/single/content', get_post_format() );
                        // Post Navigation
                        unbreak_post_navigation();
                        // About Author
                        unbreak_post_author();
                        // Related
                        unbreak_post_related();
                        // Comment
                        unbreak_comment();
                    endwhile; // End of the loop.
                ?>
                </div>
            </div>
            <?php unbreak_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();