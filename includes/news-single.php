<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	// author id
	$user_ID = get_the_author_meta('ID');

	//single page titile
	$showTitle = get_post_meta ( $post->ID, "_".THEME_NAME."_title_show", true ); 


	//meta settings
	$postDate = get_option(THEME_NAME."_post_date_single");
	$postDateSingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_date", true ); 

	$postAuthor = get_option(THEME_NAME."_post_author_single");
	$postAuthorSingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_author", true ); 

	$postCategory = get_option(THEME_NAME."_post_category_single");
	$postCategorySingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_category", true ); 


	//post details

	$postComments = get_option(THEME_NAME."_post_comments_single");
	$postCommentsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_post_comments_single", true );



	$categories = get_the_category($post->ID);

	$spotlight = get_post_meta( $post->ID, "_".THEME_NAME."_spotlight", true );
	$spotlightColor = get_option(THEME_NAME."_spotlight_color");
?>

	<?php get_template_part(THEME_LOOP."loop-start"); ?>
			<?php get_template_part(THEME_SINGLE."page-title"); ?>
			<?php get_template_part(THEME_SINGLE."post-header"); ?>
				<?php if (have_posts()) : ?>
					<div class="article-header">
						<?php get_template_part(THEME_SINGLE."image");?>
						<?php if(ot_option_compare($postCategory,$postCategorySingle)==true && !empty($categories)) { ?>
							<div class="content-category">
								<?php foreach($categories as $cat) { ?>
									<a href="<?php echo get_category_link($cat->term_id);?>" style="color: <?php ot_title_color($cat->term_id, 'category', true);?>;"><?php echo get_cat_name($cat->term_id);?></a>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if($showTitle!="no") { ?>
							<h1><?php the_title();?></h1>
						<?php } ?>
						<span>
							<?php if(ot_option_compare($postAuthor,$postAuthorSingle)==true) { ?>
								<span>
									<?php 
										remove_filter('the_author_posts_link','the_author_posts_link_css_class');
									 	add_filter('the_author_posts_link','the_author_posts_link_css_class_single'); 
										echo the_author_posts_link(); 
									?>
								</span>
							<?php } ?>
							<?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
								<span><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time(get_option('date_format'));?></a></span>
							<?php } ?>
							<?php if(comments_open() && ot_option_compare($postComments,$postCommentsSingle)==true) { ?>
								<span><a href="<?php the_permalink();?>#comments"><?php comments_number(__('0 comments', THEME_NAME), __('1 comment', THEME_NAME), __('% comments', THEME_NAME)); ?></a></span>
							<?php } ?>
						</span>
					</div>
					<?php if($spotlight) { ?>
						<div class="postside widget right">
							<h3 style="color: #<?php echo $spotlightColor;?>; border-bottom: 3px solid #<?php echo $spotlightColor;?>;"><?php _e("Spotlight", THEME_NAME);?></h3>
							<div class="article-block">
								<?php
									$postArray = explode(",",$spotlight);
									$args=array(
										'post__in' => $postArray,
										'post_type' => 'post',
									);

									$my_query = new wp_query($args);

								?>
								<?php									
									if( $my_query->have_posts() ) {
										while ($my_query->have_posts()) {
											$my_query->the_post();
											$postDateSingle = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_post_date", true ); 
								?>
										<div class="item no-image">
											<div class="item-content">
												<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
												<?php 
													add_filter('excerpt_length', 'new_excerpt_length_10');	
													the_excerpt();
													remove_filter('excerpt_length', 'new_excerpt_length_10');	
												?>
												<?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
													<span><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time(get_option('date_format'));?></a></span>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					<?php } ?>

					<?php wp_reset_query();?>		
					<?php the_content();?>		
					<?php 
						$args = array(
							'before'           => '<div class="post-pages"><p>' . __('Pages:', THEME_NAME),
							'after'            => '</p></div>',
							'link_before'      => '',
							'link_after'       => '',
							'next_or_number'   => 'number',
							'nextpagelink'     => __('Next page', THEME_NAME),
							'previouspagelink' => __('Previous page', THEME_NAME),
							'pagelink'         => '%',
							'echo'             => 1
						);

						wp_link_pages($args); 
					?>	
				<?php get_template_part(THEME_SINGLE."post-footer"); ?>
<div class="post-stars"><span>VALORA ESTA NOTICIA</span><?php if(function_exists('ec_stars_rating')) {ec_stars_rating();} ?></div>
				<?php get_template_part(THEME_SINGLE."post-ratings"); ?>
				<?php get_template_part(THEME_SINGLE."post-tags"); ?>
				<?php get_template_part(THEME_SINGLE."share"); ?>
				<?php get_template_part(THEME_SINGLE."about-author"); ?>
				<?php get_template_part(THEME_SINGLE."post-banner"); ?>
				<?php get_template_part(THEME_SINGLE."post-related"); ?>


			<?php else: ?>
				<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
			<?php endif; ?>

	

		<?php wp_reset_query(); ?>
		<?php if ( comments_open() ) : ?>
			<?php comments_template(); // Get comments.php template ?>
		<?php endif; ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>