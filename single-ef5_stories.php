<?php
/**
 * The template for displaying single post
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package EF5 Theme
 * @subpackage OverCome
 * @since 1.0.0
 * @author EF5 Team
 *
 */
get_header();
?>
    <div class="container">
        <div class="row">
            <div id="ef5-content-area" class="<?php overcome_content_css_class();?>">
                <div class="ef5-blogs">
                <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();
                    ?>
                        <div <?php post_class('ef5-single clearfix'); ?>>
                            <?php 
                                overcome_post_media([
                                    'class' => 'mb-45',
                                    'img_class' => 'ef5-rounded-10'
                                ]); 
                                overcome_post_content(['class' => 'ef5-single-content']);
                                overcome_link_pages(['class' => 'ef5-single-page-links']);
                            ?>
                        </div>
                    <?php
                        // Post Navigation
                        overcome_post_navigation();
                        // About Author
                        overcome_post_author();
                        // Related
                        overcome_post_related();
                        // Comment
                        overcome_comment(['walker' => 'OverCome_Tribe_Event_Walker_Comment']);
                    endwhile; // End of the loop.
                ?>
                </div>
            </div>
            <?php overcome_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();