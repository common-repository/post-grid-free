<?php
	/*
	Plugin Name: Post Grid Free
	Plugin URI: https://pickelements.com/postgrid
	Description: Post Grid Free is a fully Responsive WordPress Plugin to display your WordPress post with different styles.
	Version: 1.0.5
	Author: Pickelements
	Author URI: https://pickelements.com
	License: GPLv2
	Text Domain: post-grid-free
	Domain Path: /languages
	*/

	#Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) )
	die("Can't load this file directly");

	define('PIC_POSTGRID_FREE_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
	define('pic_postgrid_free_plugin_dir', plugin_dir_path( __FILE__ ) );
	add_filter('widget_text', 'do_shortcode');

	# load plugin style & scripts
	function pic_postgrid_free_init_scripts(){
		wp_enqueue_style('pic-grid-font', plugins_url( '/public/css/font-awesome.css' , __FILE__ ) );
		wp_enqueue_style('pic-grid-public-css', plugins_url( '/public/css/post-grid-free-public.css' , __FILE__ ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('pic-postgrid-public-js', plugins_url( '/public/js/post-grid-free-public.js', __FILE__ ), array('jquery'), '1.0.0', false);
	}
	add_action('wp_enqueue_scripts', 'pic_postgrid_free_init_scripts');

	# load plugin textdomain
	function pic_postgrid_free_load_textdomain(){
		load_plugin_textdomain('post-grid-free', false, dirname(plugin_basename( __FILE__ )) . '/languages/');
	}
	add_action('plugins_loaded', 'pic_postgrid_free_load_textdomain');

	# Admin enqueue scripts
	function pic_grid_admin_enqueue_scripts(){
		wp_enqueue_style('pic-post-grid-admin-css', plugins_url( '/admin/css/post-grid-free-admin.css' , __FILE__ ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'pic-post-grid-admin-js', plugins_url( '/admin/js/post-grid-free-admin.js' , __FILE__ ) , array( 'jquery' ), '1.0.0', true  );
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script( 'post_grid_free_color_picker', plugins_url('admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}
	add_action('admin_enqueue_scripts', 'pic_grid_admin_enqueue_scripts');

	# Post Type
	require_once( 'includes/post-types/post-grid-free-post-type.php' );

	# Metaboxes
	require_once( 'includes/meta-boxes/post-grid-free-metaboxes.php' );

	# Shortcode
	require_once( 'includes/shortcode/post-grid-free-shortcode.php' );