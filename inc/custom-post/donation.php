<?php
/**
 * Change single donation navigation label
*/
var_dump(has_filter('ef5payments_loop_pagination_ef5_donation_prev_text'));
add_filter('ef5payments_loop_pagination_ef5_donation_prev_text', function(){
	return esc_html__('Prev Cause','overcome');
});
add_filter('ef5payments_loop_pagination_ef5_donation_next_text', function(){
	return esc_html__('Next Cause','overcome');
});