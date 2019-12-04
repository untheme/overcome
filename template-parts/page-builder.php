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

                    var_dump(taxonomy_exists( 'category' ) );
wp_list_categories(['taxonomy' => 'ef5_donation_cat']);
$get_categories = get_categories(['taxonomy' => 'ef5_donation_cat']);
var_dump($get_categories);

                endwhile; // End of the loop.
            ?>
        </div>
        <?php overcome_sidebar(); ?>
    </div>
<?php
get_footer();