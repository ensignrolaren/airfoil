<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Radical
 */

get_header();
if (class_exists('ACF')) :
	// if there's a custom post header, show it here
	if (get_field('custom_blog_header', 'option') == 1) {
		dynamic_sidebar('blog-header');
	}
endif;
if (class_exists('ACF')) {
	$has_sidebar = get_field('show_sidebar_on_all_posts', 'option');
} else {
	$has_sidebar = 0;
}
if ($has_sidebar == 1) :
	echo '<div class="sidebar-wrapper">';
	echo '<div class="sidebar-wrapper__inner-container">';
endif;

?>
<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', get_post_type());

		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'rad') . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'rad') . '</span> <span class="nav-title">%title</span>',
			)
		);

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
if ($has_sidebar == 1) :
	get_sidebar();
	echo '</div>';
	echo '</div>';
endif;
get_footer();
