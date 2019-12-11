<?php
/**
 * Template Name: Page Buider
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
    <div class="row">
        <div id="ef5-content-area" class="<?php overcome_content_css_class();?>">
            <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile; // End of the loop.
            ?>
        </div>
        <?php overcome_sidebar(); ?>
        <?php 

            do_action( 'tribe_events_before_template' );

// Title Bar
tribe_get_template_part( 'month/title-bar' );

// Tribe Bar
tribe_get_template_part( 'modules/bar' );

// Main Events Content
tribe_get_template_part( 'month/content' );

do_action( 'tribe_events_after_template' );
        ?>
    </div>
<?php
get_footer();