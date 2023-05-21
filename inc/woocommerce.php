<?php
// ADMIN: remove admin woocommerce bloat
if (!empty(get_option('rad_wc_status_meta_box_disable')) && (get_option('rad_wc_status_meta_box_disable') == 'yes')) {
	add_action('wp_dashboard_setup', 'rad_disable_woocommerce_status');
}

function rad_disable_woocommerce_status() {
	remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal');
}
// Remove woo products helper nag
add_action('init', 'rad_remove_woo_nag');
function rad_remove_woo_nag() {
	remove_action('admin_notices', 'woothemes_updater_notice');
}
// Remove incredibly annoying marketing hub, move coupons back to old spot
if (!empty(get_option('rad_marketing_disable', 'yes')) && (get_option('rad_marketing_disable', 'yes') == 'yes')) {
	add_filter('woocommerce_marketing_menu_items', '__return_empty_array');
	add_filter('woocommerce_admin_features', 'rad_disable_features');

	function rad_disable_features($features) {
		$marketing = array_search('marketing', $features);
		unset($features[$marketing]);
		return $features;
	}
}
// Remove extensions ad
if (!empty(get_option('rad_remove_addon_submenu')) && (get_option('rad_remove_addon_submenu') == 'yes')) {
	add_action('admin_menu', 'rad_remove_admin_addon_submenu', 999);
	function rad_remove_admin_addon_submenu() {
		remove_submenu_page('woocommerce', 'wc-addons');
		remove_submenu_page('woocommerce', 'wc-addons&section=helper');
	}
}
// Remove woo store helper
if (!empty(get_option('rad_wc_helper_disable', 'yes')) && (get_option('rad_wc_helper_disable', 'yes') == 'yes')) {
	add_filter('woocommerce_helper_suppress_admin_notices', '__return_true');
}
// Disable jetpack cross promotion
if (!empty(get_option('rad_jetpack_disable')) && (get_option('rad_jetpack_disable') == 'yes')) {
	add_filter('jetpack_just_in_time_msgs', '__return_false', 20);
	add_filter('jetpack_show_promotions', '__return_false', 20);
}
// FRONT END: move around various stuff in the front end
// ##########################################
// remove woocommerce related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Declare woocommerce support
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// support lightbox
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Reposition WooCommerce breadcrumb
function woocommerce_remove_breadcrumb(){
remove_action(
	'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action(
	'woocommerce_before_main_content', 'woocommerce_remove_breadcrumb'
);

function woocommerce_custom_breadcrumb(){
	// woocommerce_breadcrumb();
}
add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );


// Remove 'description' tab  from Product Summary area on product pages
add_filter( 'woocommerce_product_tabs', 'moonframe_remove_description_tab', 11 );
function moonframe_remove_description_tab( $tabs ) {
	unset( $tabs['description'] );
	return $tabs;
}
// Remove 'additional info' tab  from Product Summary area on product pages
add_filter( 'woocommerce_product_tabs', 'moonframe_remove_product_tabs', 9999 );
function moonframe_remove_product_tabs( $tabs ) {
	unset( $tabs['additional_information'] );
	return $tabs;
}

// Remove short description if product tabs are not displayed
function rad_reorder_product_page() {
    if ( get_option('woocommerce_product_tabs') == false ) {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    }
}
add_action( 'woocommerce_before_main_content', 'rad_reorder_product_page' );

// Display product description the_content
function rad_do_product_desc() {
    global $woocommerce, $post;
    if ( $post->post_content ) : ?>
        <div itemprop="description" class="item-description">
            <?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', 'woocommerce')); ?>
            <!-- <h2><?php echo $heading; ?></h2> -->
            <?php the_content(); ?>
        </div>
    <?php endif;
}
add_action( 'woocommerce_single_product_summary', 'rad_do_product_desc', 20 );

// move price under description
function moonframe_move_price() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
}
add_action( 'woocommerce_single_product_summary', 'moonframe_move_price', 1 );

// Remove woocommerce front end styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');
function woo_frontend_assets() {
	wp_enqueue_script('woo-styles', get_template_directory_uri() . '/css/woocommerce.css', array(), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'woo_frontend_assets', 100);
// show or hide sidebar based on options page under woocommerce menu
// add_action('woocommerce_before_main_content', 'show_sidebar_open', 10);
// function show_sidebar_open() {
// 	if ( get_field( 'show_sidebar_woocommerce', 'option' ) == 1 ) :
// 		echo '<div class="sidebar-wrapper">';
// 		echo '<div class="sidebar-wrapper__inner-container">';
// 	else :
// 		// echo 'false';
// 	endif;
// }
// add_action('woocommerce_after_main_content', 'show_sidebar_close', 10);
// function show_sidebar_close() {
// 	if (get_field('show_sidebar_woocommerce', 'option') == 1) :
// 		echo '</div>';
// 		echo '</div>';
// 	else :
// 	// echo 'false';
// 	endif;
// }