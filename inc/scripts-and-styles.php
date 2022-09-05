<?php
// Enqueue scripts and styles for front end
function rad_frontend_assets() {
	wp_enqueue_style(get_template_directory_uri() . '/style.css');

	// wp_style_add_data('rad-style', 'rtl', 'replace');

	// enqueue scripts
	wp_enqueue_script('rad-scrollbar-fix', get_template_directory_uri() . '/js/scrollbar-fix.js', array(), _S_VERSION, true);
	// todo use wordpress function rather than ACF
	if (get_field('responsive_menu_behavior', 'option') == 'responsive-menu') {
		wp_enqueue_script('rad-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	}
	if (get_field('sticky_header', 'option') == 'sticky-header') {
		wp_enqueue_script('rad-sticky-nav', get_template_directory_uri() . '/js/sticky.js', array(), _S_VERSION, true);
	}
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'rad_frontend_assets', 100);

function rad_defer_scripts($tag, $handle, $src) {
	$defer = array(
		'rad-navigation',
		'rad-sticky-nav'
	);
	if (in_array($handle, $defer)) {
		return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
	}
	return $tag;
}
add_filter('script_loader_tag', 'rad_defer_scripts', 10, 3);

// Enqueue scripts and styles for admin
function rad_admin_assets() {
	wp_enqueue_style('rad-custom', get_template_directory_uri() . '/css/block-editor.css');

	// Enqueue fontawesome for block library icons
	echo '<link href="https://kit.fontawesome.com/b657cfd03b.js"  rel="stylesheet">';
}
add_action('admin_head', 'rad_admin_assets');

//enqueue block editor assets
function rad_block_editor_scripts() {
	wp_enqueue_script('theme-editor', get_template_directory_uri() . '/js/editor.js', array('wp-blocks', 'wp-dom'), filemtime(get_template_directory() . '/js/editor.js'), true);
}
add_action('enqueue_block_editor_assets', 'rad_block_editor_scripts');

// generates faq schema for the FAQ block
function rad_generate_faq_schema($schema) {
	global $schema;
	if (has_block('acf/frequently-asked-questions')) :
		echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
	endif;
}
add_action('wp_footer', 'rad_generate_faq_schema', 100);