<?php
function rad_happyforms_styles() {
	wp_enqueue_style('rad-happyforms', get_template_directory_uri() . '/css/happyforms.css');
}
// happyforms filters
add_filter( 'happyforms_use_honeypot', '__return_false' );
// add_filter('happyforms_enqueue_style', '__return_false');