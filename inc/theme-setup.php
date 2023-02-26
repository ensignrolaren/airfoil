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

		// Support core custom logo
		add_theme_support(
			'custom-logo',
			array(
				'flex-width' 	=> true,
				'flex-height'	=> true,
			)
		);

		function airfoil_customize_register($wp_customize) {
			$wp_customize->add_setting('custom_logo_width', array(
				'default'			=> '250',
				'type'				=> 'theme_mod',
				'capability'		=> 'edit_theme_options',
				'transport'			=> 'refresh',
				'sanitize_callback'	=> 'absint', // Ensure value is a positive integer
			));
			$wp_customize->add_control('custom_logo_width', array(
				'label'				=> __('Custom Logo Width', 'airfoil'),
				'section'			=> 'title_tagline', // ID of the existing custom logo section
				'settings'			=> 'custom_logo_width',
				'type'				=> 'number',
				'input_attrs'		=> array(
					'min'			=> 0,
					'step'			=> 1,
				),
				'active_callback'	=> function () {
					return has_custom_logo();
				},
			));
			// Add custom height and width fields to the existing custom logo section
			$wp_customize->add_setting('custom_logo_height', array(
				'default'			=> '100',
				'type'				=> 'theme_mod',
				'capability'		=> 'edit_theme_options',
				'transport'			=> 'refresh',
				'sanitize_callback'	=> 'absint', // Ensure value is a positive integer
			));
			$wp_customize->add_control('custom_logo_height', array(
				'label'				=> __('Custom Logo Height', 'airfoil'),
				'section'			=> 'title_tagline', // ID of the existing custom logo section
				'settings'			=> 'custom_logo_height',
				'type'				=> 'number',
				'input_attrs'		=> array(
					'min'			=> 0,
					'step'			=> 1,
				),
				'active_callback'	=> function () {
					return has_custom_logo();
				},
			));
		}
		add_action('customize_register', 'airfoil_customize_register');

		// Get the custom logo and set its dimensions manually
		function rad_site_branding() {
			if (function_exists('the_custom_logo')) {
				$custom_logo_id = get_theme_mod('custom_logo');
				$custom_logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
				$custom_logo_height = get_theme_mod('custom_logo_height');
				$custom_logo_height = ($custom_logo_height === null) ? '240' : esc_attr($custom_logo_height);

				$custom_logo_width = get_theme_mod('custom_logo_width');

				if ($custom_logo_url) {
					$custom_logo_dimensions = 'width="' . esc_attr($custom_logo_width) . '" height="' . esc_attr($custom_logo_height) . '"';
					echo '<a href="' . esc_url(home_url('/')) . '" rel="home"><img src="' . esc_url($custom_logo_url) . '" alt="' . get_bloginfo('name') . '" ' . $custom_logo_dimensions . '></a>';
				}
				// display the appropriate site title and tagline markup if that option is set
				if (is_front_page() && display_header_text()) {
					echo '<div class="branding-text"><h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></h1><p class="site-description">' . get_bloginfo('description') . '</p></div>';
				}
				elseif (!is_front_page() && display_header_text()) {
					echo '<div class="branding-text"><p class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></p><p class="site-description">' . get_bloginfo('description') . '</p></div>';
				}
			}
		}

		// Let WordPress manage the document title	.
		// By adding theme support, we declare that this theme does not use 	a
		// hard-coded <title> tag in the document head, and expect WordPress to
		// provide it for us.
		add_theme_support('title-tag');

		// Register nav menu(s)
		register_nav_menus(
			array(
				'menu-1'	=> esc_html__( 'Primary', 'rad' ),
				'menu-2'	=> esc_html__( 'Second', 'rad' ),
				'menu-3'	=> esc_html__( 'Third', 'rad' ),
				'menu-4'	=> esc_html__( 'Fourth', 'rad' ),
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
				'name'	=> esc_attr__('Small', 'rad'),
				'size'	=> 12,
				'slug'	=> 'small'
			),
			array(
				'name'	=> esc_attr__('Regular', 'rad'),
				'size'	=> 16,
				'slug'	=> 'regular'
			),
			array(
				'name'	=> esc_attr__('Extra Regular', 'rad'),
				'size'	=> 22,
				'slug'	=> 'extra-regular'
			),
			array(
				'name'	=> esc_attr__('Medium', 'rad'),
				'size'	=> 26,
				'slug'	=> 'medium'
			),
			array(
				'name'	=> esc_attr__('Extra Medium', 'rad'),
				'size'	=> 31,
				'slug'	=> 'extra-medium'
			),
			array(
				'name'	=> esc_attr__('Large', 'rad'),
				'size'	=> 40,
				'slug'	=> 'large'
			),

			array(
				'name'	=> esc_attr__('Extra Large', 'rad'),
				'size'	=> 50,
				'slug'	=> 'x-large'
			),
			array(
				'name'	=> esc_attr__('Huge', 'rad'),
				'size'	=> 60,
				'slug'	=> 'huge'
			),
			array(
				'name'	=> esc_attr__('Big McLargeHuge', 'rad'),
				'size'	=> 72,
				'slug'	=> 'big-mclargehuge'
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

		// support wide and full alignments
		add_theme_support('align-wide');
		
		// disable full screen editor by default
		// another great decision, matt. 🙄
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

		// Don't support stupid freaking new block layout classes
		// Apparently breaking CSS changes are just something Wordpress does now
		function rad_filter_block_type_metadata($metadata) {
			if (isset($metadata['supports']['__experimentalLayout'])) {
				$metadata['supports']['__experimentalLayout'] = false;
			}
			return $metadata;
		}
		add_filter('block_type_metadata', 'rad_filter_block_type_metadata');
	}
endif;
add_action( 'after_setup_theme', 'rad_setup' );

// let's call this 'lowercase_p_dangit'...
// wordpress really shouldn't silently edit user content
// this is really basic, obvious stuff, matt.
// I cannot believe I have to add this to prevent my own 🤬 software from secretly editing my content 
remove_filter( 'the_title', 'capital_P_dangit', 11 );
remove_filter( 'the_content', 'capital_P_dangit', 11 );
remove_filter( 'comment_text', 'capital_P_dangit', 31 );
