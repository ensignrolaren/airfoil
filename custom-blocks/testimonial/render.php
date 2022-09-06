<?php

/**
 * Testimonial block rendering
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$classes = '';
if (!empty($block['className'])) {
	$classes .= sprintf(' %s', $block['className']);
}
if (!empty($block['align'])) {
	$classes .= sprintf(' align%s', $block['align']);
}
?>
<div class="rad-testimonial <?php echo esc_attr($classes); ?>">
	<!-- Testimonial text -->
	<div class="rad-testimonial__body">
		<?php
		$testimonial = get_field('testimonial');
		if ($testimonial) :
			echo $testimonial;
		endif;
		?>
	</div>
	<?php
	$image = get_field('image');
	?>
	<!-- Testimonial attribution -->
	<div class="rad-testimonial__attribution">
		<div class="rad-testimonial__image">
			<?php if ($image) : ?>
				<?php echo wp_get_attachment_image($image['id'], 'full'); ?>
			<?php endif; ?>
		</div>
		<div class="rad-testimonial__name">
			<?php
			$name_company = get_field('name_company');
			if ($name_company) :
				echo $name_company;
			endif;
			?>
		</div>
	</div>


</div>