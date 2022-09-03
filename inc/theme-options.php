<?php
// add the options page
function rad_acf_options_page() {
	if (function_exists('acf_add_options_sub_page')) {
		acf_add_options_sub_page(array(
			'title'      => 'Theme Options',
			'parent'     => 'options-general.php',
			'capability' => 'manage_options'
		));
	}
}
add_action('init', 'rad_acf_options_page');

// add some css variables in the header
function rad_body_open() { ?>
	<style>
		:root {
			--normal-width: <?php the_field('normal_content_width', 'option'); ?>px;
			--padding: <?php the_field('padding', 'option'); ?>rem;
		}

		@media screen and (max-width: 768px) {
			:root {
				--padding: calc(<?php the_field('padding', 'option'); ?>rem / 2);
			}
		}
	</style>
<?php }
add_action('wp_body_open', 'rad_body_open');
