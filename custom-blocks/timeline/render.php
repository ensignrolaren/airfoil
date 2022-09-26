<?php

/**
 * Timeline block rendering
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
<div class="rad-timeline <?php echo esc_attr($classes); ?>">
	<!-- timeline event -->
	<?php if (have_rows('timeline')) : ?>
		<?php while (have_rows('timeline')) : the_row(); ?>
			<div class="rad-timeline__event">
				<div class="rad-timeline__event-content">
					<?php $event = get_sub_field('event'); ?>
					<?php if ($event) : ?>
						<InnerBlocks />
					<?php endif; ?>
				</div>
				<div class="rad-timeline__event-spacer">
					<!-- stuff -->
				</div>
			</div>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // no rows found 
		?>
	<?php endif; ?>
</div>