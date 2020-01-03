<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * 
 * @package EF5 Theme
 * @subpackage OverCome
 * @since 1.0.0
 * @author EF5 Team
 *
*/
get_header();
?>	
	<div class="container d-flex justify-content-center text-center">
		<div class="error-404 not-found">
			<div class="err-msg-large">
				<?php esc_html_e('404','overcome') ?>
			</div>
			<div class="err-msg-medium">
				<?php esc_html_e( 'Ooops, Page Not Found', 'overcome' ); ?>
			</div>
			<div class="text-large font-style-700 err-msg-small">
				<?php esc_html_e( 'We Can\'t Seem to find the page you\'re looking for.', 'overcome' ); ?>
			</div>
			<div class="back-home">
				<a href="<?php echo esc_url(home_url('/'));?>" class="ef5-btn accent fill"><?php esc_html_e('Back Home','overcome'); ?></a>
			</div>
			<div class="search-404">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
<?php
get_footer();