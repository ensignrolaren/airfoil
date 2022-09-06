<?php
// Set new ACF Save and Load points
add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
function set_acf_json_save_folder( $path ) {
	$path = dirname(__FILE__) . '/acf-json';
	return $path;
}
add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
function add_acf_json_load_folder( $paths ) {
	unset($paths[0]);
	$paths[] = dirname(__FILE__) . '/acf-json';
	return $paths;
}
// Don't export dynamic values via Local JSON
// add_filter('acf/prepare_field_for_export', function($field) {
// check field key against an array of field values to see if we're in the right field
// if(isset($field['key']) && in_array($field['key'], array(
// 'FIELD_ID_GOES_HERE',
// 'FIELD_ID_GOES_HERE'
// ))) {
//Blank out the select options with an empty array
// 		$field['choices'] = array();
// 	}
// 	return $field;
// });


// Register custom blocks
function radical_load_blocks() {
	// Card
	register_block_type(get_template_directory() . '/custom-blocks/card/block.json');
	// Testimonial
	register_block_type(get_template_directory() . '/custom-blocks/testimonial/block.json');
	// FAQ
	register_block_type(get_template_directory() . '/custom-blocks/faq/block.json');
}
add_action('init', 'radical_load_blocks');