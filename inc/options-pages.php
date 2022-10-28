<?php
// add the options page
function rad_acf_options_page() {
	if (class_exists('ACF')) {
		if (function_exists('acf_add_options_sub_page')) {
			acf_add_options_sub_page(array(
				'title'      => 'Theme Options',
				'parent'     => 'options-general.php',
				'capability' => 'manage_options'
			));
			acf_add_options_sub_page(array(
				'title'      => 'Posts Options',
				'parent'     => 'edit.php',
				'capability' => 'manage_options',
			));
		}
	}
}
add_action('init', 'rad_acf_options_page');

// add some css variables in the header
function rad_body_open() {
	if (class_exists('ACF')) {
		$normal_width = get_field('normal_content_width', 'option');
	}
	?>
	<style>
		:root {
			--normal-width: <?php echo $normal_width; ?>px;
		}
	</style>
<?php }
add_action('wp_body_open', 'rad_body_open');
