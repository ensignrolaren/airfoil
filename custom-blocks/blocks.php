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

// Register custom blocks
function radical_load_blocks() {
	// Card
	register_block_type(get_template_directory() . '/custom-blocks/card/block.json');
	// Testimonial
	register_block_type(get_template_directory() . '/custom-blocks/testimonial/block.json');
	// FAQ
	register_block_type(get_template_directory() . '/custom-blocks/faq/block.json');
	// Copyright
	register_block_type(get_template_directory() . '/custom-blocks/copyright/block.json');
	// Query loop
	register_block_type(get_template_directory() . '/custom-blocks/query-loop/block.json');
}
add_action('init', 'radical_load_blocks');