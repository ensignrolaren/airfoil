<?php
// 'sidebar' (or wherever the theme places them) area widgets
function rad_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'rad' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rad' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'rad_widgets_init' );

// footer area blocks
function footer_widgets_init() {
	register_sidebar(
		array(
			'id'				=> 'footer-blocks-area',
			'name'				=> esc_html__('Footer blocks', 'rad'),
			'description' 		=> esc_html__('These blocks appear at the bottom of every page.', 'rad'),
			'before_sidebar'	=> '<footer id="%1$s" class="site-footer %2$s">',
			'after_sidebar'		=> '</footer>',
			'before_widget'		=> '<div id="%1$s" class="footer-section %2$s">',
			'after_widget'		=> '</div>'
		)
	);
}
add_action('widgets_init', 'footer_widgets_init');

// optional custom Site credits blocks
function site_credits() {
	register_sidebar(
		array(
			'id'				=> 'site-credits-block-area',
			'name'				=> esc_html__('Site credits', 'rad'),
			'description'		=> esc_html__('This area displays below the footer and typically shows the site credits.', 'rad'),
			'before_sidebar'	=> '<div class="site-credits">',
			'after_sidebar'		=> '</div>',
			'before_widget'		=> '<span class="site-credits__block">',
			'after_widget'		=> '</span>'
		)
	);
}
add_action('widgets_init', 'site_credits');

// optional custom blog header blocks
function blog_header_init() {
	register_sidebar(
		array(
			'id'				=> 'blog-header-blocks-area',
			'name'				=> esc_html__('Blog header', 'rad'),
			'description'		=> esc_html__('This optional area is for a custom blog header.', 'rad'),
			'before_sidebar'	=> '<header id="%1$s" class="custom-blog-header %2$s">',
			'after_sidebar'		=> '</header>',
			'before_widget'		=> '<div id="%1$s" class="blog-header-section %2$s">',
			'after_widget'		=> '</div>'
		)
	);
}
add_action('widgets_init', 'blog_header_init');