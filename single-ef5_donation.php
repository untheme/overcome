<?php
/**
 * The Template for displaying single post
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 * @author Red Team
 */
/* get sidebar position. */
get_header(); 

$content_class = is_active_sidebar('ef5_donation_widget') ? 'col-xl-8' : 'col-xl-12';

?>
 
<div id="ef5p-single-donation" class="ef5p-single-donation content-area container">
    <div class="row">
        <div class="<?php echo esc_attr($content_class);?>">
            <?php
                /* Start the loop.*/
                while ( have_posts() ) : the_post();
                    $post_type = get_post_type();
                    ?>
                    <div <?php post_class(); ?>> 
                        <div class="clearfix">
                            <div class="thumbnail-wrap relative ef5-bg-f5f5f5 ef5-rounded-10 ef5-overflow-hidden">
                                <div class="relative">
                                    <a href="<?php the_permalink();?>" class="ef5-gradient-overlay d-block">
                                        <?php the_post_thumbnail('large'); ?>
                                    </a>
                                    <div class="thumbnail-overlay pl-30 pr-30 pb-12 text-white">
                                        <div class="row justify-content-between">
                                        	<div class="col-auto">
                                        		<div class="row text-14">
		                                            <div class="col-auto post-author">
		                                                <?php the_author(); ?>
		                                            </div>
		                                            <div class="col-auto post-time">
		                                                <?php the_date(); ?>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="col-auto"><?php overcome_post_share([
		                                    	'show_share' => '1',
		                                    	'show_title' => false,
		                                    	'show_all'	 => false,
		                                    	'class'	     => 'ef5-link-inherit text-12'		
		                                    ]);?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="donation-amount-wrap pt-20 pr-30 pb-20 pl-30"><?php 
                                        ef5payments_donation_layout_1();
                                ?></div>
                            </div>
                            <div class="entry-conent-inner">
                                <div class="ef5-tabs-nav ef5-filters ef5-filters-2 d-flex justify-content-center">
                                    <div class="filter-item ef5-tab-active" data-tab=".description">
                                        <span>Description</span>
                                    </div>
                                    <div class="filter-item" data-tab=".document">
                                        <span>Documents</span>
                                    </div>
                                    <div class="filter-item" data-tab=".donation">
                                        <span>Donations (<?php ef5payments_donation_donors_count(['label' => '', 'icon' =>'']); ?>)</span>
                                    </div>
                                    <?php if ( comments_open() || get_comments_number() ) : ?>
                                    <div class="filter-item" data-tab=".comment">
                                        <span><?php esc_html_e('Comments','ef5-payments') ?> (<?php comments_number('0','1',get_comments_number());?>)</span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="ef5-donation-content ef5-tabs-stage">
                                    <div class="ef5-tab-item transition fadeInLeft description"><?php the_content();?></div>
                                    <div class="ef5-tab-item transition fadeInLeft document"><?php
                                        ef5payments_donation_documents();
                                    ?></div>
                                    <div class="ef5-tab-item transition fadeInLeft donation"><div class="ef5-payment-donor-wrap"><?php 
                                        ef5payments_donors([
                                            'customer_name_label'  => '',
                                            'customer_phone_label' => esc_html__('Phone','ef5-payments'),
                                            'customer_mail_label'  => esc_html__('Mail','ef5-payments'),
                                            'donated_label'        => esc_html__('Donated','ef5-payments'),
                                        ]);
                                    ?></div></div>
                                    <?php if ( comments_open() || get_comments_number() ) : ?>
                                        <div class="ef5-tab-item transition fadeInLeft comment"><?php comments_template(); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="ef5-donate-bottom text-center">
                                    <?php ef5payments_donation_donate_button(['class' => 'ef5-btn accent fill ef5-btn-lg']) ?>
                                </div>
                                <div class="ef5-single-nav ef5-donation-nav">
                                    <div class="row justify-content-center gutter-100">
                                        <div class="col-auto ef5-prev-post"><?php 
                                            previous_post_link(
                                                '%link', 
                                                '<span class="icon"></span>'.apply_filters('ef5payments_loop_pagination_'.$post_type.'_prev_text', esc_html__('Previous', 'ef5-payments'))
                                            );
                                        ?></div>
                                        <div class="col-auto ef5-next-post"><?php 
                                            next_post_link(
                                                '%link', 
                                                apply_filters('ef5payments_loop_pagination_'.$post_type.'_next_text', esc_html__('Next', 'ef5-payments')).'<span class="icon"></span>'
                                            );
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                endwhile;
            ?>
        </div>
        <?php if(is_active_sidebar('ef5_donation_widget')): ?>
        <div class="ef5-sidebar col-xl-4">
            <?php dynamic_sidebar('ef5_donation_widget'); ?>
        </div>
        <?php endif; ?>
</div>
<?php
    //get_sidebar();
    get_footer();