<?php
add_action('overcome_before_content','overcome_404_bg');
function overcome_404_bg(){
	?>
		<div class="ef5-404-img">
			<img class="ef5-img-fit" src="<?php echo get_template_directory_uri();?>/assets/images/404.jpg" alt="404" />
		</div>
	<?php
}