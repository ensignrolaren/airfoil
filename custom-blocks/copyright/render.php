<?php

/**
 * copyright block rendering
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
?>
<div class="rad-copyright">
<?php
	echo '&copy; ' . date("Y");
	echo ' ';
	echo bloginfo('name');