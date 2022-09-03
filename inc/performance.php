<?php
// clean up header– removes: really simple discovery link, wordpress version, rss feed links,
// extra rss feed links, relational links, emoji stuff
remove_action( 'wp_head', 'rsd_link' ); // remove really simple discovery link
remove_action( 'wp_head', 'wp_generator' ); // remove wordpress version
remove_action( 'wp_head', 'feed_links', 2 ); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action( 'wp_head', 'feed_links_extra', 3 ); // removes all extra rss feed links
remove_action( 'wp_head', 'index_rel_link' ); // remove link to index page
remove_action( 'wp_head', 'wlwmanifest_link' ); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // remove random post link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // remove parent post link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // remove the next and previous post links
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink

// Deregister scripts
function deregister_scripts() {
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'deregister_scripts' );

// Dequeue assets
function dequeue_scripts(){
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'dequeue_scripts', 100 );

// Add "nocookie" To WordPress oEmbeded Youtube Videos
function wpex_youtube_nocookie_oembed( $return ) {
	$return = str_replace( 'youtube', 'youtube-nocookie', $return );
	return $return;
}
add_filter( 'oembed_dataparse', 'wpex_youtube_nocookie_oembed' );

//Remove jQuery migrate
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
// add_filter('should_load_separate_core_block_assets', '__return_true');

// Filter the whole wp output to prevent lazy loading of first image
// improves LCP score by not delaying images that are likely above-the-fold
// https://bloggingcommerce.com/en/how-to-selectively-disable-lazy-load/
function selective_lazy_load($content) {
	if (is_single() || is_page() || is_front_page() || is_home()) {
		$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
		$document = new DOMDocument();
		libxml_use_internal_errors(true);
		$document-> loadHTML(utf8_decode ($content));
		$imgs = $document-> getElementsByTagName('img');
		$img = $imgs[0];
		if ($imgs->item(0)) {// We check first if it is the first image of the content
			$img-> removeAttribute('loading');
			$html = $document-> saveHTML();
			return $html;
		} else {
			return $content;
		}
	} else {
		return $content;
	}
}
add_filter ('the_content', 'selective_lazy_load');

// dequeue jquery conditionally
// add_action('wp_enqueue_scripts', 'enqueue_if_block_is_not_present');
// function enqueue_if_block_is_not_present() {
// 	// if we are not in the back end
// 	if (!is_admin()) {
// 		$id = get_the_ID();
// 		// and also if there's not HF or carousel and there's no woocommerce
// 		if (!has_block('thethemefoundry/happyforms', $id) && !has_block('acf/carousel', $id) && !class_exists('WooCommerce')) {
// 			wp_dequeue_script('jquery');
// 			wp_deregister_script('jquery');
// 		}
// 	}
// }