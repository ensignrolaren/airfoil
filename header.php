<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Radical
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if (has_site_icon()) : ?>
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<meta name="msapplication-TileColor" content="#777777">
		<meta name="theme-color" content="#777777">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'rad'); ?></a>
		<div class="pre-header-wrapper">
			<?php dynamic_sidebar('preheader'); ?>
		</div>
		<div class="site-header__wrapper">
			<header id="masthead" class="site-header">
				<div class="site-header__inner-container">
					<div class="site-branding">
						<?php rad_site_branding(); ?>
					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo wp_get_nav_menu_name('menu-1'); ?> <span aria-hidden="true">&#9776;</span></button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'items_wrap' 	 => '<button id="close" class="close-button">Close</button><ul id="%1$s" class="%2$s">%3$s</ul>'
							)
						);
						?>
					</nav><!-- #site-navigation -->
				</div>
			</header>
		</div><!-- #masthead -->
		<?php
		// check if ACF is loaded (if not, let's just set the sidebar to not show)
		if (!class_exists('ACF')) {
			$has_sidebar = 0;
		} else {
			// check if we're on a post page
			if (is_archive() || is_single() || is_home() || is_404() || is_search()) {
				// check the site options page to see if we want all post pages to have sidebars
				$has_sidebar = get_field('show_sidebar_on_all_posts', 'option');
				// if we want the sidebar to show on all posts, do that
				if ($has_sidebar == 1) :
					echo '<div class="sidebar-wrapper">';
					echo '<div class="sidebar-wrapper__inner-container">';
					get_sidebar();
				endif;
				// check if we're on a static page
			} elseif (is_page()) {
				global $post;
				// check the page options for if this page should have a sidebar
				$has_sidebar = get_field('show_page_sidebar', $post->ID);
				// if we want the sidebar to show on this particular page, do that
				if ($has_sidebar == 1) :
					echo '<div class="sidebar-wrapper">';
					echo '<div class="sidebar-wrapper__inner-container">';
					get_sidebar();
				endif;
			}
		}
		?>