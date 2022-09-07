<?php
function radical_guten_colors() {
	// Disable Custom Colors
	add_theme_support('disable-custom-colors');

	// Get custom colors from the theme options page
	if (have_rows('color_palette', 'option')) :
		while (have_rows('color_palette', 'option')) : the_row();
			
			$color = get_sub_field('color', 'option');
			// Loop over colors in the palette.
			if (have_rows('color', 'option')) :
				while (have_rows('color', 'option')) : the_row();
					$colors = get_field('color_palette', 'option');
					// Get sub values
					$color_name = get_sub_field('color_name', 'option');
					$color_slug = strtolower(str_replace(' ', '-', $color_name));
					$color_hex = get_sub_field('color_hex', 'option');

					// Build the color palette array
					add_theme_support('editor-color-palette', array(
						array(
							'name'	=> $color_name,
							'slug'	=> $color_slug,
							'color'	=> $color_hex,
						),
					));

					// print for debugging
					$color_array = array(
							'name'	=> $color_name,
							'slug'	=> $color_slug,
							'color'	=> $color_hex,
					);
					print_r($color_array);
				endwhile;
			endif;
		endwhile;
	endif;

	// Editor Color Palette
	// if (have_rows('color_palette', 'option')) :
	// 	while (have_rows('color_palette', 'option')) : the_row();
			// $color_value_1 	= get_sub_field('color_1');
			// $color_value_2 	= get_sub_field('color_2');
			// $color_value_3 	= get_sub_field('color_3');
			// $color_value_4 	= get_sub_field('color_4');
			// $color_value_5 	= get_sub_field('color_5');
			// $color_value_6 	= get_sub_field('color_6');
			// $color_value_7 	= get_sub_field('color_7');
			// $color_value_8 	= get_sub_field('color_8');
			// $color_value_9 	= get_sub_field('color_9');
			// $color_value_10 = get_sub_field('color_10');
			// $color_value_11 = get_sub_field('color_11');
			// $color_value_12 = get_sub_field('color_12');
			// $color_name_1 	= get_sub_field('color_name_1');
			// $color_name_2 	= get_sub_field('color_name_2');
			// $color_name_3 	= get_sub_field('color_name_3');
			// $color_name_4 	= get_sub_field('color_name_4');
			// $color_name_5 	= get_sub_field('color_name_5');
			// $color_name_6 	= get_sub_field('color_name_6');
			// $color_name_7 	= get_sub_field('color_name_7');
			// $color_name_8 	= get_sub_field('color_name_8');
			// $color_name_9 	= get_sub_field('color_name_9');
			// $color_name_10 	= get_sub_field('color_name_10');
			// $color_name_11 	= get_sub_field('color_name_11');
			// $color_name_12 	= get_sub_field('color_name_12');
			// $color_slug_1	= strtolower(str_replace(' ', '-', $color_name_1));
			// $color_slug_2	= strtolower(str_replace(' ', '-', $color_name_2));
			// $color_slug_3	= strtolower(str_replace(' ', '-', $color_name_3));
			// $color_slug_4	= strtolower(str_replace(' ', '-', $color_name_4));
			// $color_slug_5	= strtolower(str_replace(' ', '-', $color_name_5));
			// $color_slug_6	= strtolower(str_replace(' ', '-', $color_name_6));
			// $color_slug_7	= strtolower(str_replace(' ', '-', $color_name_7));
			// $color_slug_8	= strtolower(str_replace(' ', '-', $color_name_8));
			// $color_slug_9	= strtolower(str_replace(' ', '-', $color_name_9));
			// $color_slug_10	= strtolower(str_replace(' ', '-', $color_name_10));
			// $color_slug_11	= strtolower(str_replace(' ', '-', $color_name_11));
			// $color_slug_12	= strtolower(str_replace(' ', '-', $color_name_12));
	// 	endwhile;
	// endif;
	// add_theme_support('editor-color-palette', array(

	// 	array(
	// 		'name'	=> $color_name_1,
	// 		'slug'	=> $color_slug_1,
	// 		'color'	=> $color_value_1,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_2,
	// 		'slug'	=> $color_slug_2,
	// 		'color'	=> $color_value_2,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_3,
	// 		'slug'	=> $color_slug_3,
	// 		'color'	=> $color_value_3,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_4,
	// 		'slug'	=> $color_slug_4,
	// 		'color'	=> $color_value_4,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_5,
	// 		'slug'	=> $color_slug_5,
	// 		'color'	=> $color_value_5,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_6,
	// 		'slug'	=> $color_slug_6,
	// 		'color'	=> $color_value_6,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_7,
	// 		'slug'	=> $color_slug_7,
	// 		'color'	=> $color_value_7,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_8,
	// 		'slug'	=> $color_slug_8,
	// 		'color'	=> $color_value_8,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_9,
	// 		'slug'	=> $color_slug_9,
	// 		'color'	=> $color_value_9,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_10,
	// 		'slug'	=> $color_slug_10,
	// 		'color'	=> $color_value_10,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_11,
	// 		'slug'	=> $color_slug_11,
	// 		'color'	=> $color_value_11,
	// 	),
	// 	array(
	// 		'name'	=> $color_name_12,
	// 		'slug'	=> $color_slug_12,
	// 		'color'	=> $color_value_12,
	// 	)
	// ));
}
add_action('after_setup_theme', 'radical_guten_colors');
