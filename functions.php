<?php
/**
 * Radical functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Radical
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

// Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';

// Enable breadcrumbs
require_once get_template_directory() . '/custom-blocks/blocks.php';

// Check if happyforms is active
if (class_exists('Happyforms')) {
	// if active, load happyforms functions 
	require_once get_template_directory() . '/inc/happyforms.php';
}

// Clean up header, remove bloaty stuff
require_once get_template_directory() . '/inc/performance.php';

// Enqueue scripts and styles
require_once get_template_directory() . '/inc/scripts-and-styles.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Get theme options
require_once get_template_directory() . '/inc/options-pages.php';

// Theme setup
require get_template_directory() . '/inc/theme-setup.php';

// Register widget area
require get_template_directory() . '/inc/widgets.php';

// Check if Woocommerce is active
if (class_exists('Woocommerce')) {
	// if active, load Woocommerce functions
	require_once get_template_directory() . '/inc/woocommerce.php';
}