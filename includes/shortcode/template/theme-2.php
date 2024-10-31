<?php
    if( !defined( 'ABSPATH' ) ){
        exit;
    }
	?>

	<style>
		.picgrid-st2-area-<?php echo $postid;?>{
		    display: block;
		    overflow: hidden;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-single-items {
		    background: <?php echo $pic_postgrid_background_items;?>;
		    border: 1px solid <?php echo $pic_postgrid_bordercolor_items;?>;
		    transition: .3s all ease;
		}
		.picgrid-st2-area-<?php echo $postid;?> .pic-picgrid-thumbnail{
			position: relative;
			transition: .3s all ease;
			overflow: hidden;
		}
		.picgrid-st2-area-<?php echo $postid;?> .pic-picgrid-thumbnail img{
			transition: .3s all ease;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-single-items:hover .pic-picgrid-thumbnail img {
			transition: .3s all ease;
		    transform: scale(1.2);
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-single-items .overlay-post-date {
		    position: absolute;
		    width: 55px;
		    height: 50px;
		    top: 30px;
		    left: 30px;
		    display: flex;
		    flex-direction: column;
		    justify-content: center;
		    align-items: center;
		    color: <?php echo $pic_postgrid_color_postdate;?>;
		    background: #fff;
		    font-size: 22px;
		    font-weight: 700;
		    text-transform: uppercase;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-single-items .overlay-post-date > span {
		    font-size: 14px;
		    line-height: 1;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-single-items .overlay-post-date::after {
		    content: "";
		    position: absolute;
		    right: 0;
		    bottom: -10px;
		    width: 0;
		    height: 0;
		    border-style: solid;
		    border-width: 0 10px 10px 0;
		    border-color: transparent #fff transparent transparent;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content {
		    display: block;
		    overflow: hidden;
		    padding: 25px;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content h2.picgrid-title {
		    line-height: unset;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content h2.picgrid-title a {
		    color: <?php echo $pic_postgrid_color_title;?>;
		    text-transform: <?php echo $pic_postgrid_transform_title;?>;
		    line-height: <?php echo $pic_postgrid_height_title;?>px;
		    font-size: <?php echo $pic_postgrid_size_title;?>px;
		    font-weight: <?php echo $pic_postgrid_fontweight_title;?>;
		    font-style: <?php echo $pic_postgrid_fontstyle_title;?>;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content h2.picgrid-title a:hover {
		  	color: <?php echo $pic_postgrid_color_title_hover;?>;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta{
		    margin:0;
		    padding:0;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li{
		    list-style: none;
		    display: inline-block;
		    margin-right:10px;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li:last-child{
		    margin-right:0px;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-author a{
		    font-size: 14px;
		    text-transform: capitalize;
		    color: <?php echo $pic_postgrid_color_author;?>;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-comments {
		    font-size: 14px;
		    text-transform: capitalize;
		    color: <?php echo $pic_postgrid_color_postdate;?>;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-author i.fa,
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-date i.fa,
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content ul.picgrid-author-meta li.post-comments i.fa{
		    margin-right: 5px;
		    font-size: 15px;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content .picgrid-post-content p {
		    font-size: <?php echo $pic_postgrid_size_content;?>px;
		    color: <?php echo $pic_postgrid_color_content;?>;
		    margin-bottom: 15px;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content .picgrid-readmore-btn a {
		    color: <?php echo $pic_postgrid_color_readmore;?>;
		    font-size: <?php echo $pic_postgrid_size_readmore;?>px;
		    font-weight: 500;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content .picgrid-readmore-btn a:hover {
		    color: <?php echo $pic_postgrid_color_readmore_hover;?>;
		}
		.picgrid-st2-area-<?php echo $postid;?> .picgrid-item-content .picgrid-readmore-btn a i.fa{
		    margin-left:5px;
		    font-size: 12px;
		}
	</style>


	<div class="picgrid-st2-area-<?php echo $postid;?>">
		<?php
		while ( $pic_postquery->have_posts() ) : $pic_postquery->the_post();
			$content = get_the_content(get_the_ID());
		?>
		<div class="picgrids-col-lg-<?php echo $pic_postgrid_columns;?> picgrids-col-md-2 picgrids-col-sm-2 picgrids-col-xs-1">
			<div class="picgrid-single-items">
				<?php if(has_post_thumbnail()) { ?>
				<div class="pic-picgrid-thumbnail">
					<?php the_post_thumbnail(); ?>
					<div class="overlay-post-date"><?php echo get_the_date('j');?><span><?php echo get_the_date('M');?></span></div>
				</div>
				<?php } ?>
				<div class="picgrid-item-content">
					<ul class="picgrid-author-meta">
						<li class="post-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></li>
						<li class="post-date"><i class="fa fa-clock-o"></i><?php echo esc_html ( get_the_date() ); ?></li>
						<li class="post-comments"><i class="fa fa-comments"></i><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></li>
					</ul>
					<h2 class="picgrid-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="picgrid-post-content">
						<p><?php echo wp_trim_words( $content, '20', '' ); ?></p>
					</div>
					<?php if( $pic_postgrid_hide_readmore == 1 ){ ?>
					<div class="picgrid-readmore-btn">
						<a href="<?php the_permalink();?>"><?php echo esc_html__( 'Read More', 'post-grid-free' ); ?> <i class="fa fa-arrow-right"></i></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>