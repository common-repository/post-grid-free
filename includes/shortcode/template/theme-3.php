<?php
    if( !defined( 'ABSPATH' ) ){
        exit;
    }
	?>

	<style>
		.picgrid-st3-area-<?php echo $postid;?> {
		    display: block;
		    overflow: hidden;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-single-items {
		    background: <?php echo $pic_postgrid_background_items;?>;
		    border: 1px solid <?php echo $pic_postgrid_bordercolor_items;?>;
		    transition: .3s all ease;
		}
		.picgrid-st3-area-<?php echo $postid;?> .pic-picgrid-thumbnail{
			position: relative;
			transition: .3s all ease;
			overflow: hidden;
		}
		.picgrid-st3-area-<?php echo $postid;?> .pic-picgrid-thumbnail img {
			transition: .3s all ease;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-single-items:hover .pic-picgrid-thumbnail img {
			transition: .3s all ease;
		    transform: scale(1.2);
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-single-items .overlay-post-tag {
		    position: absolute;
		    left: 30px;
		    bottom: 30px;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-single-items .overlay-post-tag a{
		    color: <?php echo $pic_postgrid_color_postdate;?>;
		    background: #fff;
		    padding: 8px 15px 8px 15px;
		    font-size: 15px;
		    text-transform: capitalize;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content {
		    display: block;
		    overflow: hidden;
		    padding: 25px;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content h2.picgrid-title {
		    line-height: unset;
		    margin-bottom:0;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content h2.picgrid-title a {
		    color: <?php echo $pic_postgrid_color_title;?>;
		    text-transform: <?php echo $pic_postgrid_transform_title;?>;
		    line-height: <?php echo $pic_postgrid_height_title;?>px;
		    font-size: <?php echo $pic_postgrid_size_title;?>px;
		    font-weight: <?php echo $pic_postgrid_fontweight_title;?>;
		    font-style: <?php echo $pic_postgrid_fontstyle_title;?>;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content h2.picgrid-title a:hover {
		  	color: <?php echo $pic_postgrid_color_title_hover;?>;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta{
		    margin:0;
		    padding:0;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li{
		    list-style: none;
		    display: inline-block;
		    margin-right:10px;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li:last-child{
		    margin-right:0px;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-author a{
		    font-size: 14px;
		    text-transform: capitalize;
		    color: <?php echo $pic_postgrid_color_author;?>;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-date {
		    font-size: 14px;
		    text-transform: capitalize;
		    color: <?php echo $pic_postgrid_color_postdate;?>;
		}
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-comments {
		    font-size: 14px;
		    text-transform: capitalize;
		    color: <?php echo $pic_postgrid_color_postdate;?>;
		}		
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-author i.fa,
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-date i.fa,
		.picgrid-st3-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-comments i.fa{
		    margin-right: 5px;
		    font-size: 15px;
		}
	</style>


	<div class="picgrid-st3-area-<?php echo $postid;?>">
		<?php
		while ( $pic_postquery->have_posts() ) : $pic_postquery->the_post();
			$content = get_the_content(get_the_ID());
		?>
		<div class="picgrids-col-lg-<?php echo $pic_postgrid_columns;?> picgrids-col-md-2 picgrids-col-sm-2 picgrids-col-xs-1">
			<div class="picgrid-single-items">
				<?php if(has_post_thumbnail()) { ?>
				<div class="pic-picgrid-thumbnail">
					<?php the_post_thumbnail(); ?>
		            <div class="overlay-post-tag">
		               	<?php the_category(' '); ?>
		            </div>
				</div>
				<?php } ?>
				<div class="picgrid-item-content">
					<ul class="picgrid-author-meta">
						<li class="post-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></li>
						<li class="post-date"><i class="fa fa-clock-o"></i><?php echo esc_html ( get_the_date() ); ?></li>
						<li class="post-comments"><i class="fa fa-comments"></i><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></li>
					</ul>
					<h2 class="picgrid-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>
			</div>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>