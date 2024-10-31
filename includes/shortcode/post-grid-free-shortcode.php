<?php
	if( !defined( 'ABSPATH' ) ){
		exit;
	}

	function pic_postgrid_free_shortcode_attr( $atts, $content = null ) {
		global $post, $paged, $query;
		$atts = shortcode_atts(
			array(
				'id' => '',
		), $atts);
		$postid = $atts['id'];

		$pic_postgrid_catlist   					= get_post_meta($postid, 'pic_postgrid_catlist', true);
		$pic_postgrid_styles   						= get_post_meta($postid, 'pic_postgrid_styles', true);
		$pic_postgrid_orderby   					= get_post_meta($postid, 'pic_postgrid_orderby', true);
		$pic_postgrid_order   						= get_post_meta($postid, 'pic_postgrid_order', true);

		// title options settings
		$pic_postgrid_size_title   					= get_post_meta($postid, 'pic_postgrid_size_title', true);
		$pic_postgrid_height_title   				= get_post_meta($postid, 'pic_postgrid_height_title', true);
		$pic_postgrid_color_title   				= get_post_meta($postid, 'pic_postgrid_color_title', true);
		$pic_postgrid_color_title_hover   			= get_post_meta($postid, 'pic_postgrid_color_title_hover', true);
		$pic_postgrid_transform_title   			= get_post_meta($postid, 'pic_postgrid_transform_title', true);
		$pic_postgrid_fontweight_title   			= get_post_meta($postid, 'pic_postgrid_fontweight_title', true);
		$pic_postgrid_fontstyle_title   			= get_post_meta($postid, 'pic_postgrid_fontstyle_title', true);

		// settings
		$pic_postgrid_hide_author   				= get_post_meta($postid, 'pic_postgrid_hide_author', true);
		$pic_postgrid_color_author   				= get_post_meta($postid, 'pic_postgrid_color_author', true);
		$pic_postgrid_hide_postdate   				= get_post_meta($postid, 'pic_postgrid_hide_postdate', true);
		$pic_postgrid_color_postdate   				= get_post_meta($postid, 'pic_postgrid_color_postdate', true);

		// options
		$pic_postgrid_hide_readmore   				= get_post_meta($postid, 'pic_postgrid_hide_readmore', true);
		$pic_postgrid_color_readmore   				= get_post_meta($postid, 'pic_postgrid_color_readmore', true);
		$pic_postgrid_color_readmore_hover   		= get_post_meta($postid, 'pic_postgrid_color_readmore_hover', true);
		$pic_postgrid_size_readmore   				= get_post_meta($postid, 'pic_postgrid_size_readmore', true);

		// options
		$pic_postgrid_background_items   			= get_post_meta($postid, 'pic_postgrid_background_items', true);
		$pic_postgrid_bordercolor_items   			= get_post_meta($postid, 'pic_postgrid_bordercolor_items', true);
		$pic_postgrid_color_content   				= get_post_meta($postid, 'pic_postgrid_color_content', true);
		$pic_postgrid_size_content   				= get_post_meta($postid, 'pic_postgrid_size_content', true);
		$pic_postgrid_columns   					= get_post_meta($postid, 'pic_postgrid_columns', true);
		$pic_postgrid_pagesitems   					= get_post_meta($postid, 'pic_postgrid_pagesitems', true);

		if( is_array( $pic_postgrid_catlist ) ){
			$picgrid_query_cats =  array();
			$num = count($pic_postgrid_catlist);
			for($j=0; $j<$num; $j++){
				array_push($picgrid_query_cats, $pic_postgrid_catlist[$j]);
			}

			$args = array(
				'post_type' 	 	=> 'post',
				'post_status'	 	=> 'publish',
				'posts_per_page'	=> $pic_postgrid_pagesitems,
				'orderby'	   	   	=> $pic_postgrid_orderby,
				'order'			 	=> $pic_postgrid_order,
				    'tax_query' => [
				        'relation' => 'OR',
				        [
				            'taxonomy' => 'category',
				            'field' => 'id',
				            'terms' => $picgrid_query_cats,
				        ],
				    ],
			);
	    }else{
			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => $pic_postgrid_orderby,
				'order'          => $pic_postgrid_order,
			);
	    }

		$pic_postquery = new WP_Query( $args );

		ob_start();

		switch ($pic_postgrid_styles) {
		    case 1:

			include __DIR__ . '/template/theme-1.php';

		    break;
		    case 2:

			include __DIR__ . '/template/theme-2.php';

		    break;
		    case 3:

			include __DIR__ . '/template/theme-3.php';

		    break;
		}
		return ob_get_clean();
    }
	add_shortcode( 'picpostgirds', 'pic_postgrid_free_shortcode_attr' );