<?php
	if ( ! defined('ABSPATH')) exit;  // if direct access

	// Register Custom Post Type
	function pic_postgrid_free_mainpost_register() {
		$labels = array(
			'name'                  => _x( 'Post Grid', 'Post Type General Name', 'post-grid-free' ),
			'singular_name'         => _x( 'Post Grid', 'Post Type Singular Name', 'post-grid-free' ),
			'menu_name'             => __( 'Post Grid', 'post-grid-free' ),
			'name_admin_bar'        => __( 'Post Grid', 'post-grid-free' ),
			'archives'              => __( 'Post Grid Archives', 'post-grid-free' ),
			'attributes'            => __( 'Post Grid Attributes', 'post-grid-free' ),
			'parent_item_colon'     => __( 'Parent Grid:', 'post-grid-free' ),
			'all_items'             => __( 'All Grid', 'post-grid-free' ),
			'add_new_item'          => __( 'Add New Grid', 'post-grid-free' ),
			'add_new'               => __( 'Add New Grid', 'post-grid-free' ),
			'new_item'              => __( 'New Grid', 'post-grid-free' ),
			'edit_item'             => __( 'Edit Grid', 'post-grid-free' ),
			'update_item'           => __( 'Update Grid', 'post-grid-free' ),
			'view_item'             => __( 'View Grid', 'post-grid-free' ),
			'view_items'            => __( 'View Grid', 'post-grid-free' ),
			'search_items'          => __( 'Search Grid', 'post-grid-free' ),
			'not_found'             => __( 'Grid Not found', 'post-grid-free' ),
			'not_found_in_trash'    => __( 'Grid Not found in Trash', 'post-grid-free' ),
			'featured_image'        => __( 'Grid Featured Image', 'post-grid-free' ),
			'set_featured_image'    => __( 'Set Post Grid featured image', 'post-grid-free' ),
			'remove_featured_image' => __( 'Remove Post Grid featured image', 'post-grid-free' ),
			'use_featured_image'    => __( 'Use as Post Grid featured image', 'post-grid-free' ),
			'insert_into_item'      => __( 'Insert into Grid', 'post-grid-free' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'post-grid-free' ),
			'items_list'            => __( 'Grid list', 'post-grid-free' ),
			'items_list_navigation' => __( 'Grid list navigation', 'post-grid-free' ),
			'filter_items_list'     => __( 'Filter Grid list', 'post-grid-free' ),
		);
		$args = array(
			'label'                 => __( 'Post Grid Settings', 'post-grid-free' ),
			'description'           => __( 'Post Grid Post Description.', 'post-grid-free' ),
			'labels'                => $labels,
			'supports'              => array( 'title'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'picgridfree', $args );
	}
	add_action('init', 'pic_postgrid_free_mainpost_register');

	# Post Grid Free Register Column
	function pic_postgrid_free_add_shortcode_column( $columns ) {
		$order='asc';
		if($_GET['order']=='asc') {
			$order='desc';
		}
		$columns = array(
			"cb"        => "<input type=\"checkbox\" />",
			"title"     => __('Shortcode Name', 'post-grid-free'),
			"shortcode" => __('Shortcode', 'post-grid-free'),
			"date"      => __('Date', 'post-grid-free'),
		);
		return $columns;
	}
	add_filter( 'manage_picgridfree_posts_columns' , 'pic_postgrid_free_add_shortcode_column' );

	# Post Grid Free Display Shortcode or Do Shortcode
	function pic_postgrid_free_add_posts_shortcode_display( $column, $post_id ) {
		 if ( $column == 'shortcode' ){
			?>
			<input style="background:#ddd" type="text" onClick="this.select();" value="[picpostgirds <?php echo 'id=&quot;'.$post_id.'&quot;';?>]" />
			<?php
		}
	}
	add_action( 'manage_picgridfree_posts_custom_column' , 'pic_postgrid_free_add_posts_shortcode_display', 10, 2 );