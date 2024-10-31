<?php
	if ( ! defined('ABSPATH')) exit;  // if direct access 	

	function pic_postgrid_register_metaarea(){
		add_meta_box(
			'pic_postgrid_all_metaboxes_id', 						# Metabox
			__( 'Post Grid Settings', 'post-grid-free' ),  		# Title
			'pic_postgrid_free_metaboxes', 							# $callback
			'picgridfree', 										# $page
			'normal'
		);

		add_meta_box(
			'pic_postgrid_all_metaboxes_id0', 						# Metabox
			__( 'Post Grid Shortcode', 'post-grid-free' ),  		# Title
			'pic_postgrid_free_shortcodes', 				# $callback
			'picgridfree', 										# $page
			'side'
		);

		add_meta_box(
			'pic_postgrid_all_metaboxes_id1', 						# Metabox
			__( 'Need Support', 'post-grid-free' ),  				# Title
			'pic_postgrid_free_ratings', 							# $callback
			'picgridfree', 										# $page
			'side'
		);
	}
	add_action('add_meta_boxes', 'pic_postgrid_register_metaarea');

	# Shortcode Page MetaBox Options
	function pic_postgrid_free_metaboxes( $post, $args ) {

		$pic_postgrid_catlist 			= get_post_meta($post->ID, 'pic_postgrid_catlist', true);
		if(empty($pic_postgrid_catlist)){
			$pic_postgrid_catlist = array();
		}
		$pic_postgrid_styles               = get_post_meta($post->ID, 'pic_postgrid_styles', true);
		$pic_postgrid_orderby              = get_post_meta($post->ID, 'pic_postgrid_orderby', true);
		$pic_postgrid_order                = get_post_meta($post->ID, 'pic_postgrid_order', true);
		
		# Title 
		$pic_postgrid_size_title           = get_post_meta($post->ID, 'pic_postgrid_size_title', true);
		$pic_postgrid_height_title         = get_post_meta($post->ID, 'pic_postgrid_height_title', true);
		$pic_postgrid_color_title          = get_post_meta($post->ID, 'pic_postgrid_color_title', true);
		$pic_postgrid_color_title_hover    = get_post_meta($post->ID, 'pic_postgrid_color_title_hover', true);
		$pic_postgrid_transform_title      = get_post_meta($post->ID, 'pic_postgrid_transform_title', true);
		$pic_postgrid_fontweight_title     = get_post_meta($post->ID, 'pic_postgrid_fontweight_title', true);
		$pic_postgrid_fontstyle_title      = get_post_meta($post->ID, 'pic_postgrid_fontstyle_title', true);
		
		# Designation
		$pic_postgrid_hide_author          = get_post_meta($post->ID, 'pic_postgrid_hide_author', true);
		$pic_postgrid_color_author         = get_post_meta($post->ID, 'pic_postgrid_color_author', true);
		$pic_postgrid_hide_postdate        = get_post_meta($post->ID, 'pic_postgrid_hide_postdate', true);
		$pic_postgrid_color_postdate       = get_post_meta($post->ID, 'pic_postgrid_color_postdate', true);
		
		# Social
		$pic_postgrid_hide_readmore        = get_post_meta($post->ID, 'pic_postgrid_hide_readmore', true);
		$pic_postgrid_size_readmore        = get_post_meta($post->ID, 'pic_postgrid_size_readmore', true);
		$pic_postgrid_color_readmore       = get_post_meta($post->ID, 'pic_postgrid_color_readmore', true);
		$pic_postgrid_color_readmore_hover = get_post_meta($post->ID, 'pic_postgrid_color_readmore_hover', true);
		
		# Pagination
		$pic_postgrid_background_items     = get_post_meta($post->ID, 'pic_postgrid_background_items', true);
		$pic_postgrid_bordercolor_items    = get_post_meta($post->ID, 'pic_postgrid_bordercolor_items', true);
		$pic_postgrid_color_content        = get_post_meta($post->ID, 'pic_postgrid_color_content', true);
		$pic_postgrid_size_content         = get_post_meta($post->ID, 'pic_postgrid_size_content', true);
		$pic_postgrid_columns              = get_post_meta($post->ID, 'pic_postgrid_columns', true);
		$pic_postgrid_pagesitems           = get_post_meta($post->ID, 'pic_postgrid_pagesitems', true);
		$pic_postgrid_navtab               = get_post_meta($post->ID, 'pic_postgrid_navtab', true);
		?>

		<div class="pic_postgrid_settings post-grid-metabox">
			<!-- <div class="wrap"> -->
			<ul class="tab-nav">
				<li nav="1" class="nav1 <?php if($pic_postgrid_navtab == 1){echo "active";}?>"><?php _e('Post Query','post-grid-free'); ?></li>
				<li nav="2" class="nav2 <?php if($pic_postgrid_navtab == 2){echo "active";}?>"><?php _e('General Settings ','post-grid-free'); ?></li>
				<li nav="3" class="nav3 <?php if($pic_postgrid_navtab == 3){echo "active";}?>"><?php _e('Grid Settings ','post-grid-free'); ?></li>
			</ul> <!-- tab-nav end -->
			<?php
				$getNavValue = "";
				if(!empty($pic_postgrid_navtab)){ $getNavValue = $pic_postgrid_navtab; } else { $getNavValue = 1; }
			?>
			<input type="hidden" name="pic_postgrid_navtab" id="pic_postgrid_navtab" value="<?php echo $getNavValue; ?>">

			<ul class="box">
				<!-- Tab 2  -->
				<li style="<?php if($pic_postgrid_navtab == 1){echo "display: block;";} else{ echo "display: none;"; }?>" class="box1 tab-box <?php if($pic_postgrid_navtab == 1){echo "active";}?>">

					<div class="option-box">
						<p class="option-title"><?php _e('Grid Settings','post-grid-free'); ?></p>

						<div class="wrap">
							<div class="pic-postgrid-customizer-areas">
								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Choose Post Categories', 'post-grid-free'); ?></span>
										<span class="sub-description"><?php _e('Select Post Categories to display Post Grid. If you did not select any categories it shows all the posts.', 'post-grid-free'); ?> </span>
									</div>

									<div class="pic-postgrid-customizer-selected">
										<ul>
											<?php
												$args = array(
													'taxonomy'     => 'category',
													'orderby'      => 'name',
													'show_count'   => 1,
													'pad_counts'   => 1,
													'hierarchical' => 1,
													'echo'         => 0
												);
												$acpluscats = get_categories( $args );
											?>
											<?php
												foreach( $acpluscats as $category ):
												    $cat_id = $category->cat_ID;
												    $checked = ( in_array($cat_id,(array)$pic_postgrid_catlist)? ' checked="checked"': "" );
												    echo'<li id="cat-'.$cat_id.'"><input type="checkbox" name="pic_postgrid_catlist[]" id="'.$cat_id.'" value="'.$cat_id.'"'.$checked.'> <label for="'.$cat_id.'">'.__( $category->cat_name, 'post-grid-free' ).'</label></li>';
												endforeach;
											?>
										</ul>
									</div>
								</div><!-- End Categories -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Choose Grid Style', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Select Post Categories to display Post Grid. If you did not select any categories it shows all the posts.', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_styles" id="pic_postgrid_styles" class="timezone_string">
											<option value="1" <?php if ( isset ( $pic_postgrid_styles ) ) selected( $pic_postgrid_styles, '1' ); ?>><?php _e('Style 1', 'post-grid-free')?></option>
											<option value="2" <?php if ( isset ( $pic_postgrid_styles ) ) selected( $pic_postgrid_styles, '2' ); ?>><?php _e('Style 2', 'post-grid-free')?></option>
											<option value="3" <?php if ( isset ( $pic_postgrid_styles ) ) selected( $pic_postgrid_styles, '3' ); ?>><?php _e('Style 3', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Style -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Order By', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid order By: Date, Menu Order or Random.', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_orderby" id="pic_postgrid_orderby" class="timezone_string">
											<option value="date" <?php if ( isset ( $pic_postgrid_orderby ) ) selected( $pic_postgrid_orderby, 'date' ); ?>><?php _e('Publish Date', 'post-grid-free')?></option>
											<option value="menu_order" <?php if ( isset ( $pic_postgrid_orderby ) ) selected( $pic_postgrid_orderby, 'menu_order' ); ?>><?php _e('Order', 'post-grid-free')?></option>
											<option value="rand" <?php if ( isset ( $pic_postgrid_orderby ) ) selected( $pic_postgrid_orderby, 'rand' ); ?>><?php _e('Random', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Order By -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Order', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid order: Descending or Ascending.', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_order" id="pic_postgrid_order" class="timezone_string">
											<option value="DESC" <?php if ( isset ( $pic_postgrid_order ) ) selected( $pic_postgrid_order, 'DESC' ); ?>><?php _e('Descending', 'post-grid-free')?></option>
											<option value="ASC" <?php if ( isset ( $pic_postgrid_order ) ) selected( $pic_postgrid_order, 'ASC' ); ?>><?php _e('Ascending', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Order -->
							</div>
						</div>
					</div>
				</li>
				<!-- Tab 2  -->
				<li style="<?php if($pic_postgrid_navtab == 2){echo "display: block;";} else{ echo "display: none;"; }?>" class="box2 tab-box <?php if($pic_postgrid_navtab == 2){echo "active";}?>">

					<div class="option-box">
						<p class="option-title"><?php _e('General Settings','post-grid-free'); ?></p>

						<div class="wrap">
							<div class="pic-postgrid-customizer-areas">
								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Title Font Size', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Title font size. default font size:20px ', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="number" name="pic_postgrid_size_title" id="pic_postgrid_size_title" maxlength="4" class="timezone_string" value="<?php  if($pic_postgrid_size_title !=''){echo $pic_postgrid_size_title; }else{ echo '20';} ?>">
									</div>
								</div><!-- End Title Font Size -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Title Line Height', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Title line height. default:25px ', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="number" name="pic_postgrid_height_title" id="pic_postgrid_height_title" maxlength="4" class="timezone_string" value="<?php  if($pic_postgrid_height_title !=''){echo $pic_postgrid_height_title; }else{ echo '25';} ?>">
									</div>
								</div><!-- End Title Font Size -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Title Font Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Title text color. default color: #333333', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_color_title" id="pic_postgrid_color_title" class="timezone_string" value="<?php  if($pic_postgrid_color_title !=''){echo $pic_postgrid_color_title; }else{ echo '#333333';} ?>">
									</div>
								</div><!-- End Title Text Color -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Title Hover Font Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Title Hover text color. default color: #0949e6', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_color_title_hover" id="pic_postgrid_color_title_hover" class="timezone_string" value="<?php  if($pic_postgrid_color_title_hover !=''){echo $pic_postgrid_color_title_hover; }else{ echo '#0949e6';} ?>">
									</div>
								</div><!-- End Title Text Color -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Title Text Transform', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Title Text Transform. Default Text Transform: Capitalize', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_transform_title" id="pic_postgrid_transform_title" class="timezone_string">
											<option value="unset" <?php if ( isset ( $pic_postgrid_transform_title ) ) selected( $pic_postgrid_transform_title, 'unset' ); ?>><?php _e('Default', 'post-grid-free')?></option>
											<option value="capitalize" <?php if ( isset ( $pic_postgrid_transform_title ) ) selected( $pic_postgrid_transform_title, 'capitalize' ); ?>><?php _e('Capitilize', 'post-grid-free')?></option>
											<option value="lowercase" <?php if ( isset ( $pic_postgrid_transform_title ) ) selected( $pic_postgrid_transform_title, 'lowercase' ); ?>><?php _e('Lowercase', 'post-grid-free')?></option>
											<option value="uppercase" <?php if ( isset ( $pic_postgrid_transform_title ) ) selected( $pic_postgrid_transform_title, 'uppercase' ); ?>><?php _e('Uppercase', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Text Transform -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Title Font Weight', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Title Font Weight. Default Font-Weight: 600', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_fontweight_title" id="pic_postgrid_fontweight_title" class="timezone_string">
											<option value="unset" <?php if ( isset ( $pic_postgrid_fontweight_title ) ) selected( $pic_postgrid_fontweight_title, 'unset' ); ?>><?php _e('Default', 'post-grid-free')?></option>
											<option value="400" <?php if ( isset ( $pic_postgrid_fontweight_title ) ) selected( $pic_postgrid_fontweight_title, '400' ); ?>><?php _e('400', 'post-grid-free')?></option>
											<option value="500" <?php if ( isset ( $pic_postgrid_fontweight_title ) ) selected( $pic_postgrid_fontweight_title, '500' ); ?>><?php _e('500', 'post-grid-free')?></option>
											<option value="600" <?php if ( isset ( $pic_postgrid_fontweight_title ) ) selected( $pic_postgrid_fontweight_title, '600' ); ?>><?php _e('600', 'post-grid-free')?></option>
											<option value="700" <?php if ( isset ( $pic_postgrid_fontweight_title ) ) selected( $pic_postgrid_fontweight_title, '700' ); ?>><?php _e('700', 'post-grid-free')?></option>
											<option value="800" <?php if ( isset ( $pic_postgrid_fontweight_title ) ) selected( $pic_postgrid_fontweight_title, '800' ); ?>><?php _e('800', 'post-grid-free')?></option>
											<option value="900" <?php if ( isset ( $pic_postgrid_fontweight_title ) ) selected( $pic_postgrid_fontweight_title, '900' ); ?>><?php _e('900', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Text Transform -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Title Font Style', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose post Grid title text Style. default: Normal', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_fontstyle_title" id="pic_postgrid_fontstyle_title" class="timezone_string">
											<option value="normal" <?php if ( isset ( $pic_postgrid_fontstyle_title ) ) selected( $pic_postgrid_fontstyle_title, 'normal' ); ?>><?php _e('Normal', 'post-grid-free')?></option>
											<option value="italic" <?php if ( isset ( $pic_postgrid_fontstyle_title ) ) selected( $pic_postgrid_fontstyle_title, 'italic' ); ?>><?php _e('Italic', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Text Style -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Author (Show/Hide)', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Show or Hide Post Grid Author Information. Default : Show.', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_hide_author" id="pic_postgrid_hide_author" class="timezone_string">
											<option value="1" <?php if ( isset ( $pic_postgrid_hide_author ) ) selected( $pic_postgrid_hide_author, '1' ); ?>><?php _e('Show', 'post-grid-free')?></option>
											<option value="2" <?php if ( isset ( $pic_postgrid_hide_author ) ) selected( $pic_postgrid_hide_author, '2' ); ?>><?php _e('Hide', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Readmore -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Author Font Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Author Font Color. default font color: #333333', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_color_author" id="pic_postgrid_color_author" class="timezone_string" value="<?php  if($pic_postgrid_color_author !=''){echo $pic_postgrid_color_author; }else{ echo '#333333';} ?>">
									</div>
								</div><!-- End Text Color -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Date (Show/Hide)', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Show or Hide Post Grid Date Information. Default : Show.', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_hide_postdate" id="pic_postgrid_hide_postdate" class="timezone_string">
											<option value="1" <?php if ( isset ( $pic_postgrid_hide_postdate ) ) selected( $pic_postgrid_hide_postdate, '1' ); ?>><?php _e('Show', 'post-grid-free')?></option>
											<option value="2" <?php if ( isset ( $pic_postgrid_hide_postdate ) ) selected( $pic_postgrid_hide_postdate, '2' ); ?>><?php _e('Hide', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Readmore -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Date Text Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose post Grid date color. default: #333333', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_color_postdate" id="pic_postgrid_color_postdate" class="timezone_string" value="<?php  if($pic_postgrid_color_postdate !=''){echo $pic_postgrid_color_postdate; }else{ echo '#333333';} ?>">
									</div>
								</div><!-- End Color -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Read More (Show/Hide)', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Show or Hide Post Grid Read More Button. Default : Show.', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<select name="pic_postgrid_hide_readmore" id="pic_postgrid_hide_readmore" class="timezone_string">
											<option value="1" <?php if ( isset ( $pic_postgrid_hide_readmore ) ) selected( $pic_postgrid_hide_readmore, '1' ); ?>><?php _e('Show', 'post-grid-free')?></option>
											<option value="2" <?php if ( isset ( $pic_postgrid_hide_readmore ) ) selected( $pic_postgrid_hide_readmore, '2' ); ?>><?php _e('Hide', 'post-grid-free')?></option>
										</select>
									</div>
								</div><!-- End Readmore -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Read More Text Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose post Grid read more text color. default color: #333333', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_color_readmore" id="pic_postgrid_color_readmore" class="timezone_string" value="<?php  if($pic_postgrid_color_readmore !=''){echo $pic_postgrid_color_readmore; }else{ echo '#333333';} ?>">
									</div>
								</div><!-- End Text Color -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Read More Text Hover Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose post Grid read more hover text color. default color: #0949e6', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_color_readmore_hover" id="pic_postgrid_color_readmore_hover" class="timezone_string" value="<?php  if($pic_postgrid_color_readmore_hover !=''){echo $pic_postgrid_color_readmore_hover; }else{ echo '#0949e6';} ?>">
									</div>
								</div><!-- End Text Color -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Button Font Size', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post details Button font size. default size: 15px', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="number" name="pic_postgrid_size_readmore" id="pic_postgrid_size_readmore" maxlength="4" class="timezone_string" value="<?php if($pic_postgrid_size_readmore !=''){echo $pic_postgrid_size_readmore; }else{ echo '15';} ?>">
									</div>
								</div><!-- End Text Size -->


								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Content Text Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose post Grid details text color. default color: #333333', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_color_content" id="pic_postgrid_color_content" class="timezone_string" value="<?php  if($pic_postgrid_color_content !=''){echo $pic_postgrid_color_content; }else{ echo '#333333';} ?>">
									</div>
								</div><!-- End Text Color -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Content Font Size', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post details text size. default size: 15px', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="number" name="pic_postgrid_size_content" id="pic_postgrid_size_content" maxlength="4" class="timezone_string" value="<?php if($pic_postgrid_size_content !=''){echo $pic_postgrid_size_content; }else{ echo '15';} ?>">
									</div>
								</div><!-- End Text Size -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Grid Background Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Items Background color. default color: #fdfdfd', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_background_items" id="pic_postgrid_background_items" class="timezone_string" value="<?php  if($pic_postgrid_background_items !=''){echo $pic_postgrid_background_items; }else{ echo '#fdfdfd';} ?>">
									</div>
								</div><!-- End Color -->

								<div class="pic-postgrid-customizer-inner">
									<div class="pic-postgrid-customizer-heading">
										<span class="sub-heading"><?php _e('Grid Border Color', 'post-grid-free')?></span>
										<span class="sub-description"><?php _e('Choose Post Grid Items Border color. default color: #dddddd', 'post-grid-free')?> </span>
									</div>
									<div class="pic-postgrid-customizer-selected">
										<input type="text" name="pic_postgrid_bordercolor_items" id="pic_postgrid_bordercolor_items" class="timezone_string" value="<?php  if($pic_postgrid_bordercolor_items !=''){echo $pic_postgrid_bordercolor_items; }else{ echo '#dddddd';} ?>">
									</div>
								</div><!-- End Color -->

							</div>
						</div>
					</div>
				</li>

				<!-- Tab 4  -->
				<li style="<?php if($pic_postgrid_navtab == 3){echo "display: block;";} else{ echo "display: none;"; }?>" class="box3 tab-box <?php if($pic_postgrid_navtab == 3){echo "active";}?>">

					<!-- Start Tab Two -->
					<div class="option-box">
						<p class="option-title">Grid Settings</p>
							<div class="pic-postgrid-customizer-inner">
								<div class="pic-postgrid-customizer-heading">
									<span class="sub-heading"><?php _e('Select Grid Column', 'post-grid-free')?></span>
									<span class="sub-description"><?php _e('Choose Post Grid Total Column. default', 'post-grid-free')?> </span>
								</div>

								<div class="pic-postgrid-customizer-selected">
									<select name="pic_postgrid_columns" id="pic_postgrid_columns" class="timezone_string">
										<option value="3" <?php if ( isset ( $pic_postgrid_columns ) ) selected( $pic_postgrid_columns, '3' ); ?>><?php _e('3 Column', 'post-grid-free')?></option>
										<option value="4" <?php if ( isset ( $pic_postgrid_columns ) ) selected( $pic_postgrid_columns, '4' ); ?>><?php _e('4 Column', 'post-grid-free')?></option>
									</select>
								</div>
							</div><!-- End Order By -->

							<div class="pic-postgrid-customizer-inner">
								<div class="pic-postgrid-customizer-heading">
									<span class="sub-heading"><?php _e('Total Items Display', 'post-grid-free')?></span>
									<span class="sub-description"><?php _e('Select Grid Post Total items you want to display. default: 12. if you do not want to show Pagination use (-1)', 'post-grid-free')?> </span>
								</div>

								<div class="pic-postgrid-customizer-selected">
									<input type="number" name="pic_postgrid_pagesitems" id="pic_postgrid_pagesitems" maxlength="4" class="timezone_string" value="<?php if($pic_postgrid_pagesitems !=''){echo $pic_postgrid_pagesitems; }else{ echo '12';} ?>">
								</div>
							</div><!-- End Text Size -->

					</div>

				</li>
			</ul>
		</div>

		<script>
			jQuery(document).ready(function(){
				jQuery("#company_website_input, #pic_postgrid_color_title, #pic_postgrid_color_title_hover, #pic_postgrid_background_items, #pic_postgrid_bordercolor_items, #pic_postgrid_color_content, #pic_postgrid_color_author, #pic_postgrid_color_postdate, #pic_postgrid_color_readmore_hover, #pic_postgrid_color_readmore").wpColorPicker();
			});
		</script>
	<?php
	}

	# Accordion Plus Shortcode page MetaBox Options Save
	function pic_postgrid_free_metainfo_saves($post_id){
		# Doing autosave then return.
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_catlist'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_catlist', $_POST[ 'pic_postgrid_catlist' ]  );
		} else {
            update_post_meta( $post_id, 'pic_postgrid_catlist', 'unchecked' );
        }

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_styles'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_styles', $_POST[ 'pic_postgrid_styles' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_orderby'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_orderby', $_POST[ 'pic_postgrid_orderby' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_order'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_order', $_POST[ 'pic_postgrid_order' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_size_title'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_size_title', $_POST[ 'pic_postgrid_size_title' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_height_title'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_height_title', $_POST[ 'pic_postgrid_height_title' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_color_title'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_color_title', $_POST[ 'pic_postgrid_color_title' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_color_title_hover'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_color_title_hover', $_POST[ 'pic_postgrid_color_title_hover' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['ppoint_title_alignment'] ) ) {
			update_post_meta( $post_id, 'ppoint_title_alignment', $_POST[ 'ppoint_title_alignment' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_transform_title'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_transform_title', $_POST[ 'pic_postgrid_transform_title' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_fontweight_title'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_fontweight_title', $_POST[ 'pic_postgrid_fontweight_title' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_fontstyle_title'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_fontstyle_title', $_POST[ 'pic_postgrid_fontstyle_title' ]  );
		}




		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_color_author'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_color_author', $_POST[ 'pic_postgrid_color_author' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_hide_author'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_hide_author', $_POST[ 'pic_postgrid_hide_author' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_hide_postdate'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_hide_postdate', $_POST[ 'pic_postgrid_hide_postdate' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_hide_readmore'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_hide_readmore', $_POST[ 'pic_postgrid_hide_readmore' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_color_readmore'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_color_readmore', $_POST[ 'pic_postgrid_color_readmore' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_color_readmore_hover'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_color_readmore_hover', $_POST[ 'pic_postgrid_color_readmore_hover' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_size_readmore'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_size_readmore', $_POST[ 'pic_postgrid_size_readmore' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_color_postdate'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_color_postdate', $_POST[ 'pic_postgrid_color_postdate' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_background_items'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_background_items', $_POST[ 'pic_postgrid_background_items' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_bordercolor_items'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_bordercolor_items', $_POST[ 'pic_postgrid_bordercolor_items' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_color_content'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_color_content', $_POST[ 'pic_postgrid_color_content' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_size_content'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_size_content', $_POST[ 'pic_postgrid_size_content' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_columns'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_columns', $_POST[ 'pic_postgrid_columns' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['pic_postgrid_pagesitems'] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_pagesitems', $_POST[ 'pic_postgrid_pagesitems' ]  );
		}

		#Value check and saves if needed
		if( isset( $_POST[ 'pic_postgrid_navtab' ] ) ) {
			update_post_meta( $post_id, 'pic_postgrid_navtab', $_POST['pic_postgrid_navtab'] );
		} else {
			update_post_meta( $post_id, 'pic_postgrid_navtab', 1 );
		}
	}
	add_action('save_post', 'pic_postgrid_free_metainfo_saves');

	function pic_postgrid_free_shortcodes( $post, $args ) { ?>
		<p class="option-info"><?php _e('Copy this shortcode and paste on page, post or widget section where you want to display Post Grid.','post-grid-free'); ?></p>
		<textarea cols="35" rows="1" onClick="this.select();" >[picpostgirds <?php echo 'id="'.$post->ID.'"';?>]</textarea>
		<?php
	}

	function pic_postgrid_free_ratings( $post, $args ) { ?>
		<div class="support-area">
			<p><?php _e( 'If you need any help or found any bugs in our plugin please do not hesitate to post it on plugin support section. we are happy to solve our plugin issues.', 'post-grid-free' ); ?></p>
			<div class="pick-review">
				<a target="_blank" class="pick-btn" href="https://pickelements.com/contact"><?php _e( 'Support', 'post-grid-free'); ?></a>
			</div>
		</div>
		<?php
	}	
