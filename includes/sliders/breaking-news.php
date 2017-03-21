<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	//braking slider		
	$breakingSlider = get_post_meta( ot_page_id(), "_".THEME_NAME.'_breaking_slider', true );
	
	if(is_category()) {
		$breakingSliderCat = ot_get_option( get_cat_id( single_cat_title("",false) ), 'breaking_slider', false );
	}

	//post comments
	$postComments = get_option(THEME_NAME."_post_comment");


?>
<?php if((is_array($breakingSlider) && !empty($breakingSlider) && !in_array("slider_off",$breakingSlider)) || (is_category() && $breakingSliderCat=="show")) { ?>
	<?php
		if(is_category()) {
			$catId = get_cat_id( single_cat_title("",false) );
			$category_in = $catId;
		} else {
			$category_in = $breakingSlider;
		}

		$args=array(
			'category__in' => $category_in,
			'posts_per_page' => 6,
			'order'	=> 'DESC',
			'orderby'	=> 'date',
			'meta_key'	=> "_".THEME_NAME.'_breaking_post',
			'meta_value'	=> 'on',
			'post_type'	=> 'post',
			'ignore_sticky_posts '	=> 1,
			'post_status '	=> 'publish'
		);
		$the_query = new WP_Query($args);
		$postCategory = get_option(THEME_NAME."_post_category_single");
		$postComments = get_option(THEME_NAME."_post_comments_single");
	?>


					<!-- BEGIN .breaking-news -->
					<div class="breaking-news">
						<div class="breaking-title">
							<h3><?php _e("Breaking News", THEME_NAME);?></h3>
						</div>
						<div class="breaking-block">
							<ul>

								<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
								<?php
				                    //get all post categories
				                    $categories = get_the_category($the_query->post->ID);
				                    $catCount = count($categories);
				                    //select a random category id
				                    $id = rand(0,$catCount-1);
				                    //cat id
				                    $catId = $categories[$id]->term_id;		
									//post details
									$postCategorySingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_category", true );
									$postCommentsSingle = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_post_comments_single", true );		
				                   ?>
								<li>
									<?php if(ot_option_compare($postCategory,$postCategorySingle)==true && !empty($categories)) { ?>
										<a href="<?php echo get_category_link($catId);?>" class="break-category" style="background-color: <?php ot_title_color($catId, 'category', true);?>;"><?php echo get_cat_name($catId);?></a>
									<?php } ?>
									<h4>
										<a href="<?php the_permalink();?>"><?php the_title();?></a>
									</h4>
									<?php if(comments_open() && ot_option_compare($postComments,$postCommentsSingle)==true) { ?>
										<a href="<?php the_permalink();?>#comments" class="comment-link">
											<i class="fa fa-comment-o"></i><?php comments_number('0','1','%'); ?>
										</a>
									<?php } ?>
								</li>
								<?php endwhile; else: ?>
									<li><?php  _e( 'No posts where found' , THEME_NAME);?></li>
								<?php endif; ?>

							</ul>
						</div>
					<!-- END .breaking-news -->
					</div>

	<?php } ?>
<?php wp_reset_query();  ?>