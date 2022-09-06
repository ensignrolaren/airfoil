<?php

/**
 * Card block rendering
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
<div class="rad-card <?php echo esc_attr($classes); ?>">
	<?php
	$image = get_field('image');
	?>
	<!-- Card image -->
	<div class="rad-card__image">
		<?php if ($image) : ?>
			<?php echo wp_get_attachment_image($image['id'], 'full'); ?>
		<?php endif; ?>
	</div>
	<?php
	$template = array(
		array('core/heading', array(
			'level' => 2,
			'content' => 'Title Goes Here',
		)),
		array('core/paragraph', array(
			'content' => 'Some text here',
		))
	);
	?>
	<!-- Card text -->
	<div class="rad-card__body">
		<InnerBlocks template=" . esc_attr(wp_json_encode($template)) . " />
	</div>
</div>