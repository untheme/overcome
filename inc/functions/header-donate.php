<?php
function overcome_header_donate_button(){
	if(!class_exists('EF5Payments') || overcome_get_opts('header_donate', '0') === '0') return;
    wp_enqueue_script('bootstrap');
    $post_id = ef5payments_default_donation(overcome_get_id_by_slug(overcome_get_opts('header_donate_item',''),'ef5_donation'));
    $data = apply_filters('ef5payments_get_payment_form_data',[
        'class'        => '',
        'data-options' => '',
        'data-target'  => '',
        'title'	 	   => overcome_get_opts('header_donate_label', esc_html__('Donate Now','overcome')),	
        'url'		   => '#',
        'target'	   => '_self'	
    ],$post_id);
    ?>
    <a class="<?php echo esc_attr($data['class']); ?>"
       data-options="<?php echo esc_attr($data['data-options']) ?>"
       data-target="<?php echo esc_attr($data['data-target']) ?>"
       href="<?php echo esc_attr($data['url']); ?>" target="<?php echo esc_attr($data['target']); ?>" ><?php echo wp_kses_post($data['title']) ?></a>
    <?php
}