<?php if (get_field('enable_mega_menu', 'option') == 1) : ?>
	<?php // echo 'true';
	if (!function_exists('mega_menu')) {

		// Register Custom Post Type
		function mega_menu() {

			$labels = array(
				'name'                  => _x('Mega Menus', 'Post Type General Name', 'text_domain'),
				'singular_name'         => _x('Mega Menu', 'Post Type Singular Name', 'text_domain'),
				'menu_name'             => __('Mega Menus', 'text_domain'),
				'name_admin_bar'        => __('Mega Menus', 'text_domain'),
				'archives'              => __('All Mega Menus', 'text_domain'),
				'attributes'            => __('Mega Menu Attributes', 'text_domain'),
				'parent_item_colon'     => __('Parent Mega Menu:', 'text_domain'),
				'all_items'             => __('All Mega Menus', 'text_domain'),
				'add_new_item'          => __('Add New Mega Menus', 'text_domain'),
				'add_new'               => __('Add New', 'text_domain'),
				'new_item'              => __('New Item', 'text_domain'),
				'edit_item'             => __('Edit Item', 'text_domain'),
				'update_item'           => __('Update Mega Menu', 'text_domain'),
				'view_item'             => __('View Mega Menu', 'text_domain'),
				'view_items'            => __('View Mega Menus', 'text_domain'),
				'search_items'          => __('Search Mega Menus', 'text_domain'),
				'not_found'             => __('Not found', 'text_domain'),
				'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
				'featured_image'        => __('Featured Image', 'text_domain'),
				'set_featured_image'    => __('Set featured image', 'text_domain'),
				'remove_featured_image' => __('Remove featured image', 'text_domain'),
				'use_featured_image'    => __('Use as featured image', 'text_domain'),
				'insert_into_item'      => __('Insert into Mega Menu', 'text_domain'),
				'uploaded_to_this_item' => __('Uploaded to this Mega Menu', 'text_domain'),
				'items_list'            => __('Mega Menus list', 'text_domain'),
				'items_list_navigation' => __('Mega Menus list navigation', 'text_domain'),
				'filter_items_list'     => __('Filter Mega Menus list', 'text_domain'),
			);
			$args = array(
				'label'                 => __('Mega Menu', 'text_domain'),
				'description'           => __('Mega menus', 'text_domain'),
				'labels'                => $labels,
				'supports'              => array('title', 'editor'),
				'taxonomies'            => array('category', 'post_tag'),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'page',
			);
			register_post_type('mega-menu', $args);
		}
		add_action('init', 'mega_menu', 0);
	}
	?>
<?php else : ?>
	<?php // echo 'false'; 
	?>
<?php endif; ?>