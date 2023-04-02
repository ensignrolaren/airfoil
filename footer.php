<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Radical
 */
// check if ACF is loaded (if not, let's just set the sidebar to not show)
if (!class_exists('ACF')) {
	$has_sidebar = 0;
} else {
	// check if we're on a post page
	if (is_archive() || is_single() || is_home() || is_404() || is_search()) {
		// check the site options page to see if we want all post pages to have sidebars
		$has_sidebar = get_field('show_sidebar_on_all_posts', 'option');
		// if the sidebar markup got loaded in the header, let's close those tags
		if ($has_sidebar == 1) :
			echo '</div>';
			echo '</div>';
		endif;
		// check if we're on a static page
	} elseif (is_page()) {
		// check the page options to see if this page has a sidebar
		global $post;
		$has_sidebar = get_field('show_page_sidebar', $post->ID);
		// if the sidebar markup got loaded in the header, let's close those tags
		if ($has_sidebar == 1) :
			echo '</div>';
			echo '</div>';
		endif;
	}
}
?>
<div class="site-footer-wrapper">
	<?php dynamic_sidebar('footer-blocks-area'); ?>
</div>
<div class="site-credits-wrapper">
	<?php dynamic_sidebar('site-credits-block-area'); ?>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>