<?php
function overcome_vc_item_meta1($args=[]){
	$args = wp_parse_args($args,[
		'class'       => '',
		'echo'        => true,
		'not_show_in' => ['tribe_events']
	]);
	if(in_array(get_post_type(), $args['not_show_in'])) return;
	$css_classes = ['ef5-vc-item-meta','empty-none', 'row', $args['class']];
	$html_output = '<div class="'.trim(implode(' ', $css_classes)).'">
			<div class="date empty-none col-auto pb-5">'.overcome_posted_on(['echo' => false, 'icon_class' => 'ef5-text-accent']).'</div>
			<div class="venue empty-none col-auto pb-5">'.overcome_posted_by(['echo' => false, 'icon_class' => 'ef5-text-accent']).'</div>
			<div class="cost empty-none col-auto">'.overcome_posted_in(['echo' => false, 'icon_class' => 'ef5-text-accent']).'</div>
		</div>';
	if($args['echo']){
		echo overcome_html($html_output);
	} else {
		return $html_output;
	}
}