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
		<div class="error-404 not-found ef5-rounded-10 ef5-bg-overlay">
			<div class="font-style-700 text-uppercase err-msg-large">
				<?php esc_html_e('Oops!','overcome') ?>
			</div>
			<div class="text-large font-style-700 err-msg-small">
				<?php esc_html_e( 'The page you requested could not be found', 'overcome' ); ?>
			</div>

			<div class="page-content">
				<a href="<?php echo esc_url(home_url('/'));?>" class="ef5-btn ef5-btn-df ef5-btn-xlg accent fill"><?php esc_html_e('Back to Home','overcome'); ?></a>
			</div>
		</div>
	</div>
<?php
get_footer();