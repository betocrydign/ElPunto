<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Template Name: Archive Page
*/	
?>
<?php get_header(); ?>
<?php
	wp_reset_query();
	global $wpdb;
	$limit = 0;
	$months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,	YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date DESC");
	$cc=1;
	//meta settings
	$postDate = get_option(THEME_NAME."_post_date_single");
	$postComments = get_option(THEME_NAME."_post_comments_single");
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php get_template_part(THEME_SINGLE."page-title"); ?>
		<div class="archive-blocks">
			<?php 
				$args = array(
					'type'                     => 'post',
					'child_of'                 => 0,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'taxonomy'                 => 'category',
					'pad_counts'               => false );
						
				$categories = get_categories( $args );

				$count_total = count($categories );
				$firstColumnCount = round(($count_total/2), 0, PHP_ROUND_HALF_UP);
				$secondColumnCount = $count_total - $firstColumnCount;
				$counter = 1;
				foreach ( $categories as $category ) { 

					$cat_id = $category->term_id;
					$query='cat='.$cat_id.'&showposts=5';
					$my_query = new WP_Query($query);
					$titleColor = ot_title_color($cat_id, "category", false);
					$postCount = $my_query->post_count;
			?>
				<div class="archive-single">
					<h3 style="color: <?php echo $titleColor;?>; border-bottom: 3px solid <?php echo $titleColor;?>;"><?php echo get_cat_name($cat_id);?></h3>
					<div class="article-list">
						<?php if ( $my_query->have_posts() ) : $my_query->the_post(); ?>
							<?php 
								$postDateSingle = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_post_date", true );  
								$postCommentsSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_post_comments_single", true );
								//image icons
								$icon = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_image_icon", true ); 
								$iconText = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_image_text", true ); 
							?>
							<div class="item">
								<div class="item-header">
									<a href="<?php the_permalink();?>" class="image-hover" <?php if($icon!="Select a Icon") { ?>data-path-hover="M 34,56 45,34 63,41 64,66 47,76 z"<?php } ?>>
										<figure>
											<?php echo ot_image_html($my_query->post->ID,381,273); ?>
											<?php if($icon!="Select a Icon") { ?>
												<svg viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M 0,100 0,99 50,97 100,99 100,100 z" fill="<?php ot_title_color($cat_id, 'category', true);?>" /></svg>
												<figcaption>
													<span class="hover-text"><i class="fa <?php echo $icon;?>"></i><span><?php echo $iconText;?></span></span>
												</figcaption>
											<?php } ?>
										</figure>
									</a>

								</div>
								<div class="item-content">
									<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									<span class="item-meta">
										<?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
											<span><?php the_time(get_option('date_format'));?></span>
										<?php } ?>
										<?php if(comments_open() && ot_option_compare($postComments,$postCommentsSingle)==true) { ?>
											<span><?php comments_number(__('0 comments', THEME_NAME), __('1 comment', THEME_NAME), __('% comments', THEME_NAME)); ?></span>
										<?php } ?>
										
									</span>
									<?php 
										add_filter('excerpt_length', 'new_excerpt_length_40');	
										the_excerpt();
									?>
									<a href="<?php the_permalink();?>" class="read-more-link"><?php _e("Read More" , THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
								</div>
							</div>

						<?php endif; ?>

						<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
							<?php 
								$postDateSingle = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_post_date", true );  
								$postCommentsSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_post_comments_single", true );
							?>
							<div class="item">
								<div class="item-content">
									<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									<span class="item-meta">
										<?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
											<span><?php the_time(get_option('date_format'));?></span>
										<?php } ?>
										<?php if(comments_open() && ot_option_compare($postComments,$postCommentsSingle)==true) { ?>
											<span><?php comments_number(__('0 comments', THEME_NAME), __('1 comment', THEME_NAME), __('% comments', THEME_NAME)); ?></span>
										<?php } ?>
										
									</span>
								</div>
							</div>
						<?php endwhile; ?>
						<?php endif; ?>

						<a href="<?php echo get_category_link($cat_id);?>" class="archive-button" style="background-color: <?php echo $titleColor;?>;"><?php _e("More Articles" , THEME_NAME);?></a>

					</div>
				</div>

				<?php $counter++; ?>
			<?php } ?>
		</div>


<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>