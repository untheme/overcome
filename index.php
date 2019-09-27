<?php
/**
 * The main template file
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
                    if ( have_posts() )
                    {
                        while ( have_posts() )
                        {
                            the_post();
                            get_template_part( 'template-parts/loop/content', get_post_format() );
                        }
                        unbreak_loop_pagination();
                    }
                    else
                    {
                        get_template_part( 'template-parts/content', 'none' );
                    }
                    ?>
                </div>
            </div>
            <?php unbreak_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();