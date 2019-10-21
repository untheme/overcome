<?php
function overcome_vc_item_meta1($args=[]){
	$args = wp_parse_args($args,[
		'class' => '',
		'echo'	=> true,
		'not_show_in' => ['tribe_events']
	]);
	if(in_array(get_post_type(), $args['not_show_in'])) return;
	$css_classes = ['ef5-vc-item-meta','empty-none', 'row', $args['class']];
	$html_output = '<div class="'.trim(implode(' ', $css_classes)).'">
			<div class="date empty-none col-auto pb-5"><span class="flaticon-calendar ef5-text-accent"></span>&nbsp;&nbsp;'.overcome_posted_date(['echo' => $args['echo']]).'</div>
			<div class="venue empty-none col-auto pb-5"><span class="flaticon-maps-and-flags ef5-text-accent"></span>&nbsp;&nbsp;'.overcome_posted_by(['echo' => $args['echo']]).'</div>
			<div class="cost empty-none col-auto"><span class="flaticon-coin-1 ef5-text-accent"></span>&nbsp;&nbsp;'.overcome_posted_in(['echo' => $args['echo']]).'</div>
		</div>';
	if($args['echo']){
		echo overcome_html($html_output);
	} else {
		return $html_output;
	}
}