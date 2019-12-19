<?php
/**
 * Template Name: OverCome Tribe Event
 *
 * This is the template that displays page content with VC.
 *
 * @package EF5 Theme
 * @subpackage OverCome
 * @since 1.0.0
 * @author EF5 Team
 */
get_header();
?>
    <div class="container">
        <div class="row">
            <div id="ef5-content-area" class="<?php overcome_content_css_class();?>">
                <div id="ef5-posts" class="ef5-posts ef5-blogs">
                <?php
					while ( have_posts() ) :
						the_post();
                        overcome_post_content();
					endwhile;
                ?>
                </div>
            </div>
            <?php overcome_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();