<div class="">
	<?php
	$image = get_field('image');
	?>
	<!-- Card image -->
	<div class="card__image">
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
	<div class="card__body">
		<InnerBlocks template=" . esc_attr(wp_json_encode($template)) . " />
	</div>
</div>