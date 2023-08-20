<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Radical
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	// if it's an archive page
	if (!is_singular()) {
		the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" ' . (get_field('open_posts_in_new_tab', 'option') == 1 ? 'target="_blank" rel="noreferrer"' : '') . '>', '</a></h2>');
	} elseif (class_exists('ACF') && get_field('custom_blog_header', 'option') == 1) {
		// nothing
	} elseif (class_exists('ACF') && get_field('custom_blog_header', 'option') == 0 || !class_exists('ACF')) { ?>
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>');

			if ('post' === get_post_type()) :
			?>
				<div class="entry-meta">
					<?php
					rad_posted_on();
					rad_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<?php rad_post_thumbnail(); ?>
	<?php } ?>

	<div class="entry-content">
		<?php
		if (is_singular()) {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'rad'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
		} else {
			the_excerpt();
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'rad'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php rad_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->