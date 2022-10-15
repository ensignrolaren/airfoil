<?php

/**
 * Social Icons block rendering
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
?>
<?php
// Create class attribute allowing for custom "className" and "align" values.
$classes = ['rad-social-icons'];
if (!empty($block['className'])) {
	$classes = array_merge($classes, explode(' ', $block['className']));
}
if (!empty($block['align'])) {
	$classes[] = 'align' . $block['align'];
}
if (!empty($block['align_text'])) {
	$classes[] = 'has-text-align-' . $block['align_text'];
}
if (!empty($block['backgroundColor'])) {
	$classes[] = 'has-background';
	$classes[] = 'has-' . $block['backgroundColor'] . '-background-color';
}
if (!empty($block['textColor'])) {
	$classes[] = 'has-text-color';
	$classes[] = 'has-' . $block['textColor'] . '-color';
}
if (!empty($block['linkColor'])) {
	$classes[] = 'has-link-color';
	$classes[] = 'has-' . $block['linkColor'] . '-color';
}
?>
<div class="<?php printf('"%s"%s>',	esc_attr(join(' ', $classes)), !empty($block['anchor']) ? ' id="' . esc_attr(sanitize_title($block['anchor'])) . '"' : '',); ?>
	<?php if ( have_rows( 'social_icons' ) ) : ?>
		<?php while ( have_rows( 'social_icons' ) ) : the_row(); ?>
			<?php if ( have_rows( 'icon' ) ) : ?>
				<?php while ( have_rows( 'icon' ) ) : the_row(); ?>
					<?php $link = get_sub_field( 'link' ); ?>
					<?php if ( $link ) : ?>
						<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
					<?php endif; ?>
					<?php the_sub_field( 'account' ); ?>
				<?php endwhile; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // No rows found ?>
	<?php endif; ?>
	<?php if ( get_field( 'show_labels' ) == 1 ) : ?>
		<?php // echo 'true'; ?>
	<?php else : ?>
		<?php // echo 'false'; ?>
	<?php endif; ?>
</div>