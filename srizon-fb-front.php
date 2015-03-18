<?php
add_action( 'wp_enqueue_scripts', 'srz_fb_enqueue_script' );
function srz_fb_enqueue_script() {
	wp_enqueue_script('srzmodernizr', srz_fb_get_resource_url('js/modernizr.js'));
	wp_enqueue_script('jquery');
	wp_enqueue_script('srzmp', srz_fb_get_resource_url('js/mag-popup.js'), array('jquery'));
	wp_enqueue_script('srzcollage', srz_fb_get_resource_url('js/jquery.collagePlus.min.js'), array('jquery'));
	wp_enqueue_script('srzelastislide', srz_fb_get_resource_url('js/jquery.elastislide.min.js'), array('jquery'));
	wp_enqueue_script('srzcustom', srz_fb_get_resource_url('js/srizon.custom.min.js'), array('jquery'));
	wp_enqueue_style('srzmpcss', srz_fb_get_resource_url('css/mag-popup.min.css'));
	wp_enqueue_style('srzelastislidercss', srz_fb_get_resource_url('css/elastislide.min.css'));
	wp_enqueue_style('srzcustomcss', srz_fb_get_resource_url('css/srizon.custom.min.css'));
}