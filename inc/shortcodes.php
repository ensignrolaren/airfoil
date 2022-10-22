<?php
// Useful custom shortcodes

// Copyright Current Year shortcode
function copyright_year() {
	return '&copy; ' . date("Y");
}
// Add shortcode
add_shortcode('copyright', 'copyright_year');

// Timezone shortcode
function my_current_time() {
	date_default_timezone_set('MST');
	return date('h:i A (l)');
}
// Add shortcode
add_shortcode('current_time', 'my_current_time');