<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_query();

	global $query_string;
	$query_vars = explode('&',$query_string);
									
	foreach($query_vars as $key) {
		if(strpos($key,'page=') !== false) {
			$i = substr($key,8,12);
			break;
		}
	}
	
	if(!isset($i)) {
		$i = 1;
	}

	$portfolioImages = get_post_meta ( $post->ID, THEME_NAME."_portfolio_images", true ); 
	$imageIDs = explode(",",$portfolioImages);
	$count = count($imageIDs);

	$term_list = wp_get_post_terms($post->ID, OT_POST_GALLERY.'-cat');

	$catCount=0;
	foreach($term_list as $term){
		$catCount++;
	}
	
	$randID = rand(0,$catCount-1);	
	//similar news
	$similarPosts = get_option(THEME_NAME."_similar_posts_portfolio");
	$similarPostsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_similar_posts", true ); 


	//custom information
	$date = strtotime(get_post_meta ( $post->ID, "_".THEME_NAME."_date", true ));
	$features = get_post_meta ( $post->ID, "_".THEME_NAME."_features", true );
	$btnTitle = get_post_meta ( $post->ID, "_".THEME_NAME."_btnTitle", true );
	$btnSubtitle = get_post_meta ( $post->ID, "_".THEME_NAME."_btnSubtitle", true );
	$btnUrl = get_post_meta ( $post->ID, "_".THEME_NAME."_btnUrl", true );
	$price = get_post_meta ( $post->ID, "_".THEME_NAME."_price", true );
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
		<?php get_template_part(THEME_SINGLE."page-title"); ?>

			<?php if (have_posts()): ?>


			<div class="portfolio-single paragraph-row">

				<div class="column8">
					<div class="portfolio-single-images">
						<div class="portfolio-single-images-frame">
		            		<?php 
			            		$c=1;
			            		foreach($imageIDs as $id) { 
			            			if($id) {
				            			$file = wp_get_attachment_url($id);
				            			$image = get_post_thumb(false, 784, 580, false, $file);
			            	?>
								<span<?php if($c==$i) { ?> class="active"<?php } ?>>
									<img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>"/>
								</span>
				                <?php $c++; ?>
			               	 	<?php } ?>
			                <?php } ?>
						</div>
						<div class="portfolio-single-images-thumbnails">
		            		<?php 
			            		$c=1;
			            		foreach($imageIDs as $id) { 
			            			if($id) {
				            			$file = wp_get_attachment_url($id);
				            			$image = get_post_thumb(false, 90, 90, false, $file);
			            	?>
								<a href="javascript:;"<?php if($c==$i) { ?> class="active"<?php } ?>>
									<img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>"/>
								</a>
				                <?php $c++; ?>
			               	 	<?php } ?>
			                <?php } ?>
						</div>
					</div>
				</div>

				<div class="column4">
					<div class="portfolio-content-info">
						<div class="portfolio-content-header">
							<span><?php _e("Project Name", THEME_NAME);?></span>
							<h2><?php the_title();?></h2>
						</div>
						<?php if($date) { ?>
							<div class="portfolio-content-body">
								<span><?php _e("Date Created", THEME_NAME);?></span>
								<b><?php echo date(get_option('date_format'), $date);?></b>
							</div>
						<?php } ?>
						<div class="portfolio-content-body">
							<span><?php _e("About Project", THEME_NAME);?></span>
							<?php 
								if (get_the_content() != "") {
									remove_filter('the_content', 'BigFirstChar'); 				
									add_filter('the_content','remove_images');
									add_filter('the_content','remove_objects');
									the_content();
								} 
							?>	
						</div>

						<?php if($features) { ?>
							<?php $features = explode(";", $features); ?>
							<div class="portfolio-content-body">
								<span><?php _e("Some Features", THEME_NAME);?></span>
								<ul>
									<?php foreach($features as $feature) { ?>
										<?php if($feature) { ?>
											<li class="styled"><i class="fa fa-gear"></i><?php echo $feature;?></li>
										<?php } ?>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>

						<?php if($btnTitle || $btnSubtitle) { ?>
							<div class="portfolio-content-foot">
								<a href="<?php echo $btnUrl;?>" target="_blank"<?php if(($btnTitle && !$btnSubtitle) || (!$btnTitle && $btnSubtitle)) { ?> class="single-line"<?php } ?>>
									<?php if($btnTitle) { ?><b><?php echo $btnTitle;?></b><?php } ?>
									<?php if($btnSubtitle) { ?><span><?php echo $btnSubtitle;?></span><?php } ?>
								</a>
								<?php if($price) { ?>
									<h4><?php echo $price;?></h4>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>

			</div>

			<?php if(ot_option_compare($similarPosts,$similarPostsSingle)==true) { ?>
				<?php
					$categories = get_the_terms($post->ID, OT_POST_PORTFOLIO.'-cat');
					$categoriesNew = array();
					$i=0;
					foreach ($categories as $category) {
						$categoriesNew[$i]['term_id'] = $category->term_id;
						$categoriesNew[$i]['name'] = $category->name;
						$i++;
					}
					$categories = $categoriesNew;
					if($i==1) {
						$randID = 0;
					} else {
						$randID = rand(0,$i-1);
					}
					
				?>
				<div class="main-title" style="border-left: 4px solid <?php ot_title_color($categories[$randID]['term_id']);?>;">
					<h2><?php _e("Similar Portfolio Items", THEME_NAME);?></h2>
					<span><?php _e("Items from the same category", THEME_NAME);?></span>
				</div>

				<!-- BEGIN .photo-galleries -->
				<div class="photo-galleries">
						<?php

							$counter=1;
							$my_query = new WP_Query( 
								array( 
									'post__not_in' => array($post->ID), 
									'post_type' => OT_POST_PORTFOLIO, 
									'showposts' => 3, 
									'tax_query' => array(
										array(
											'taxonomy' => OT_POST_PORTFOLIO.'-cat',
											'field' => 'id',
											'terms' => $categories[$randID]['term_id'],
										)
									),
									'orderby' => 'rand'
								)
							);
							
							if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); 
								$src = get_post_thumb($post->ID,365,262);

						?>
							<div class="item">
								<div class="item-header">
									<a href="<?php the_permalink();?>" class="image-hover" data-path-hover="M 34,56 45,34 63,41 64,66 47,76 z">
										<figure>
											<img src="<?php echo $src["src"]; ?>"  alt="<?php echo esc_attr(get_the_title());?>"/>
											<svg viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M 0,100 0,99 50,97 100,99 100,100 z" fill="<?php ot_title_color($categories[$randID]['term_id']);?>" /></svg>
											<figcaption>
												<span class="hover-text"><i class="fa fa-search"></i></span>
											</figcaption>
										</figure>
									</a>
								</div>
								<div class="item-content">
									<?php if(isset($categories[$randID]['term_id'])) { ?>
										<div class="content-category">
											<a href="<?php echo get_term_link((int)$categories[$randID]['term_id'], OT_POST_PORTFOLIO.'-cat');?>" style="color: <?php ot_title_color($categories[$randID]['term_id']);?>;"><?php echo $categories[$randID]['name'];?></a>
										</div>
									<?php } ?>
									<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									<?php 
										add_filter('excerpt_length', 'new_excerpt_length_30');	
										the_excerpt();
									?>
									<a href="<?php the_permalink();?>" class="read-more-link"><?php _e("More Info", THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
								</div>
							</div>

							<?php $counter++; ?>
						<?php endwhile;?>
						<?php else: ?>
							<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
						<?php endif; ?>

				<!-- END .photo-galleries -->
				</div>


			<?php } ?>
			
		<?php else: ?>
			<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
		<?php endif; ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>