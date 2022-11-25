<?php
// clean up header– removes: really simple discovery link, wordpress version, rss feed links,
// extra rss feed links, relational links, emoji stuff, svg stuff, customizer support stuff
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
add_action('admin_bar_menu', function () {
	remove_action('wp_before_admin_bar_render', 'wp_customize_support_script');
}, 50);

// Deregister scripts
function deregister_scripts() {
	wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'deregister_scripts');

// Dequeue assets
function dequeue_scripts() {
	wp_dequeue_script('wp-embed');
}
add_action('wp_footer', 'dequeue_scripts', 100);

// Add "nocookie" To WordPress oEmbeded Youtube Videos
function wpex_youtube_nocookie_oembed($return) {
	$return = str_replace('youtube', 'youtube-nocookie', $return);
	return $return;
}
add_filter('oembed_dataparse', 'wpex_youtube_nocookie_oembed');

// Remove jQuery migrate
function remove_jquery_migrate($cripts) {
	if (!is_admin() && isset($cripts->registered['jquery'])) {
		$cript = $cripts->registered['jquery'];
		if ($cript->deps) {
			$cript->deps = array_diff($cript->deps, array('jquery-migrate'));
		}
	}
}
add_action('wp_default_scripts', 'remove_jquery_migrate');

// don't load the whole core block stylesheet on every page
add_filter('should_load_separate_core_block_assets', '__return_true');

// stay cool bro i add this back in the parent stylesheet
// Remove Gutenberg Block Library CSS from loading on the frontend
function remove_wp_block_library_css() {
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-block-style');
	wp_dequeue_style('global-styles');
}
add_action('wp_print_styles', 'remove_wp_block_library_css', 100);

// dequeue jquery conditionally
add_action('wp_enqueue_scripts', 'enqueue_if_block_is_not_present');
function enqueue_if_block_is_not_present() {
	// if we are not in the back end
	if (!is_admin()) {
		$id = get_the_ID();
		// and also if there's not HF or carousel and there's no woocommerce or Query Monitor
		if (!has_block('thethemefoundry/happyforms', $id) && !has_block('rad/carousel', $id) && !class_exists('WooCommerce') && !class_exists('QueryMonitor')) {
			wp_dequeue_script('jquery');
			wp_deregister_script('jquery');
		}
	}
}

// Conditionally skip lazy loading by checking for a class
function skip_lazy_load($value, $image, $context) {
	if (strpos($image, 'wp-block-cover__image-background') !== false) $value = 'eager';

	return $value;
}
add_filter('wp_img_tag_add_loading_attr', 'skip_lazy_load', 10, 3);