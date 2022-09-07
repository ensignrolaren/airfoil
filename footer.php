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