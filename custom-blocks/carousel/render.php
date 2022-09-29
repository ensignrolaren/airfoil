<?php

/**
 * Carousel block rendering
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
<?php
// max height
if (get_field('crop_to_max_height')  == 1) :
	$max_height = get_field('max_height');
endif;

// autoplay
if (get_field('autoplay') == 1) :
	$autoplay = 'true';
else :
	$autoplay = 'false';
endif;

// arrows
if (get_field('arrows') == 1) :
	$arrows = 'true';
else :
	$arrows = 'false';
endif;

// dots
if (get_field('dots') == 1) :
	$dots = 'true';
else :
	$dots = 'false';
endif;

// speed in ms
$speed = get_field('speed');

// slides to show
$slides_to_show = get_field('slides_to_show');
if ($slides_to_show > 1) {
	$fade = 'false';
	$variablewidth = 'true';
	$multi_slide = 'has-multiple-slides';
} else {
	$fade = 'true';
	$variablewidth = 'false';
	$multi_slide = 'has-single-slide';
}
if (get_field('fade') == 1) {
	$fade = 'true';
} else {
	$fade = 'false';
}
if ($slides_to_show < 1) {
	$fade = 'false';
}

// pause on hover
if (get_field('pause_on_hover') == 1) :
	$pause_on_hover = 'true';
else :
	$pause_on_hover = 'false';
endif;

// adaptive height
if (get_field('adaptive_height') == 1) :
	$adaptiveheight = 'true';
else :
	$adaptiveheight = 'false';
endif;
?>
<div class="rad-carousel <?php echo esc_attr($classes); ?>">
	<!-- carousel -->
	<InnerBlocks class="rad-carousel__inner" />
</div>
<?php
if (get_field('crop_to_max_height') == 1) : ?>
<style type="text/css">
	.rad-carousel__item {
		height: <?php echo $max_height; ?>px;
		max-height: 100vh;
	}
</style>
<?php endif; ?>

<script type="text/javascript">
	var autoPlay = <?php echo $autoplay; ?>;
	var arrows = <?php echo $arrows; ?>;
	var fade = <?php echo $fade; ?>;
	var dots = <?php echo $dots; ?>;
	var speed = <?php echo $speed; ?>;
	var slidesToShow = <?php echo $slides_to_show; ?>;
	var pause = <?php echo $pause_on_hover; ?>;
	var variableWidth = <?php echo $variablewidth ?>;
	var adaptiveHeight = <?php echo $adaptiveheight; ?>;
</script>