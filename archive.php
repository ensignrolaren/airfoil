<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radical
 */

get_header();
?>
<?php
$has_sidebar = get_post_meta(get_the_ID(), 'show_sidebar_on_all_posts', true);
if ($has_sidebar == 1) :
	echo '<div class="sidebar-wrapper">';
	echo '<div class="sidebar-wrapper__inner-container">';
endif;
?>
<main id="primary" class="site-main">

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<?php
			the_archive_title('<h1 class="page-title">', '</h1>');
			the_archive_description('<div class="archive-description">', '</div>');
			?>
		</header><!-- .page-header -->

	<?php
		/* Start the Loop */
		while (have_posts()) :
			the_post();

			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			get_template_part('template-parts/content', get_post_type());

		endwhile;

		the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
if ($has_sidebar == 1) :
	get_sidebar();
	echo '</div>';
	echo '</div>';
endif;
get_footer();
