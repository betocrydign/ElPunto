<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	//meta settings
	$postDate = get_option(THEME_NAME."_post_date_single");


	
	//similar news
	$similarPosts = get_option(THEME_NAME."_similar_posts");
	$similarPostsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_similar_posts", true ); 

	if(ot_option_compare($similarPosts,$similarPostsSingle)==true) {
	
		wp_reset_query();
		$categories = get_the_category($post->ID);
	    $catCount = count($categories);
	    //select a random category id
	    $id = rand(0,$catCount-1);
	    //cat id
	    $catId = $categories[$id]->term_id;


		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts'=>4,
				'ignore_sticky_posts'=>1,
				'orderby' => 'rand'
			);

			$my_query = new wp_query($args);
			$postCount = $my_query->post_count;
			$counter = 1;
?>
	<div class="similar-articles-list" style="background: <?php ot_title_color($catId);?>">
		<div class="main-title" style="border-left: 4px solid #fff;">
			<h2><?php printf ( __( 'Related %1$s Articles', THEME_NAME ), get_cat_name( $catId));?></h2>
			<span><?php printf ( __( 'Similar Posts From %1$s Category', THEME_NAME ), get_cat_name( $catId ));?></span>
		</div>
		
		<div class="similar-articles">
			<?php									
				if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) {
						$my_query->the_post();
	                    //get all post categories
	                    $categories = get_the_category($my_query->post->ID);
	                    $catCount = count($categories);
	                    //select a random category id
	                    $id = rand(0,$catCount-1);
	                    //cat id
	                    $catId = $categories[$id]->term_id;
						$width = 173;
						$height = 130;
						$image = get_post_thumb($my_query->post->ID,$width,$height); 
						$postDateSingle = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_post_date", true ); 
			?>
					<div class="item">
						<div class="item-header">
							<a href="<?php the_permalink();?>" class="image-hover">
								<img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>" width="100%" />
							</a>
						</div>
						<div class="item-content">
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
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
<?php } ?>
<?php wp_reset_query();  ?>
