<?php
if ( ! function_exists( 'rad_setup' ) ) :

	// this function runs initially as the theme is activated, before the init hook
	function rad_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let Wordpress manage the document title
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages
		add_theme_support( 'post-thumbnails' );

		function rad_site_branding() {
			if (has_custom_logo()) {
				the_custom_logo();
			}
			if (is_front_page() ) { 
				echo '<div class="branding-text"><h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">'. get_bloginfo('name') . '</a></h1><p class="site-description">' . get_bloginfo('description') . '</p></div>';
			} else {
				echo '<div class="branding-text"><p class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></p><p class="site-description">' . get_bloginfo('description') . '</p></div>';
			}
			if ( ! display_header_text() ) {
				// nuffin
			}
		}

		// Register nav menu(s)
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'rad' ),
				'menu-2' => esc_html__( 'Second', 'rad' ),
				'menu-3' => esc_html__( 'Third', 'rad' ),
				'menu-4' => esc_html__( 'Fourth', 'rad' ),
			)
		);

		// Output HTML5 in theme markup
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Support custom font sizes
		add_theme_support('editor-font-sizes', array(
			array(
				'name' => esc_attr__('Small', 'rad'),
				'size' => 12,
				'slug' => 'small'
			),
			array(
				'name' => esc_attr__('Regular', 'rad'),
				'size' => 16,
				'slug' => 'regular'
			),
			array(
				'name' => esc_attr__('Extra Regular', 'rad'),
				'size' => 22,
				'slug' => 'extra-regular'
			),
			array(
				'name' => esc_attr__('Medium', 'rad'),
				'size' => 26,
				'slug' => 'medium'
			),
			array(
				'name' => esc_attr__('Extra Medium', 'rad'),
				'size' => 31,
				'slug' => 'extra-medium'
			),
			array(
				'name' => esc_attr__('Large', 'rad'),
				'size' => 40,
				'slug' => 'large'
			),

			array(
				'name' => esc_attr__('Extra Large', 'rad'),
				'size' => 50,
				'slug' => 'x-large'
			),
			array(
				'name' => esc_attr__('Huge', 'rad'),
				'size' => 60,
				'slug' => 'huge'
			),
			array(
				'name' => esc_attr__('Big McLargeHuge', 'rad'),
				'size' => 72,
				'slug' => 'big-mclargehuge'
			)
		));

		// Support Colors (grabs colors from the child theme > theme-colors.php)
		function radical_colors_css() {
			$colors = get_theme_support('editor-color-palette');
			if (!empty($colors)) {
				echo '<style type="text/css">';
				echo ':root {';
				foreach ($colors[0] as $color) {
					echo '--wp--preset--color--' . $color['slug'] . ': ' . $color['color'] . '; ';
				}
				echo '}';
				foreach ($colors[0] as $color) {
					echo '.has-' . $color['slug'] . '-background-color{background-color: ' . $color['color'] . ' !important;}.has-' . $color['slug'] . '-color{color: ' . $color['color'] . ' !important;}';
				}
				echo '</style>';
			}
		}
		add_action('wp_head', 'radical_colors_css');

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Support core custom logo
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 350,
				'width'       => 150,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// support wide and full alignments
		add_theme_support('align-wide');
		
		// disable full screen editor by default
		if (is_admin()) {
			function rad_disable_editor_fullscreen_by_default() {
				$script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
				wp_add_inline_script('wp-blocks', $script);
			}
			add_action('enqueue_block_editor_assets', 'rad_disable_editor_fullscreen_by_default');
		}

		// add theme support for choosing medium-large images in the block editor
		add_filter('image_size_names_choose', function () {
			return [
				'thumbnail'		=> __('Thumbnail', 'textdomain'),
				'medium'		=> __('Medium', 'textdomain'),
				'medium_large'	=> __('Medium Large', 'textdomain'),
				'large'			=> __('Large', 'textdomain'),
				'full'			=> __('Full Size', 'textdomain'),
			];
		});

		// adds a class to the body if there's js enabled or not
		// function rad_html_js_class() {
		// 	echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>' . "\n";
		// }
		// add_action('wp_head', 'rad_html_js_class', 1);
	} endif;
add_action( 'after_setup_theme', 'rad_setup' );

// let's call this 'lowercase_p_dangit'...
// wordpress really shouldn't use its power to silently force edits to the users content
// this is really basic, obvious stuff, matt.
remove_filter( 'the_title', 'capital_P_dangit', 11 );
remove_filter( 'the_content', 'capital_P_dangit', 11 );
remove_filter( 'comment_text', 'capital_P_dangit', 31 );
