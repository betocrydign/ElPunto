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

	$galleryImages = get_post_meta ( $post->ID, THEME_NAME."_gallery_images", true ); 
	$imageIDs = explode(",",$galleryImages);
	$count = count($imageIDs);

	//main image
	$file = wp_get_attachment_url($imageIDs[$i-1]);
	$image = get_post_thumb(false, 1140, 0, false, $file);	

	$term_list = wp_get_post_terms($post->ID, OT_POST_GALLERY.'-cat');

	$catCount=0;
	foreach($term_list as $term){
		$catCount++;
	}
	
	$randID = rand(0,$catCount-1);	
	//similar news
	$similarPosts = get_option(THEME_NAME."_similar_posts_gallery");
	$similarPostsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_similar_posts", true ); 

	//meta settings
	$postDate = get_option(THEME_NAME."_post_date_single");
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
		<?php get_template_part(THEME_SINGLE."page-title"); ?>
		<?php if (have_posts()): ?>
			<div class="single-photo-gallery ot-slide-item gallery-full-photo" id="<?php echo $post->ID;?>">
				<span class="next-image" data-next="<?php echo $i+1;?>"></span>

				<div class="single-photo-main the-image loading waiter">
					<a href="javascript:void(0);" class="prev" rel="<?php if($i>1) { echo $i-1; } else { echo $i-1; } ?>"></a>
					<a href="javascript:void(0);" class="next" rel="<?php if($i<$count) { echo $i+1; } else { echo $i; } ?>"></a>
					<img class="image-big-gallery ot-gallery-image" data-id="<?php echo $i;?>" style="display:none;" src="<?php echo $image['src'];?>" alt="<?php the_title();?>" />
				</div>

				<div class="single-photo-thumbs">
					<div class="thumb-wrapper the-thumbs">
	            		<?php 
		            		$c=1;
		            		foreach($imageIDs as $id) { 
		            			if($id) {
			            			$file = wp_get_attachment_url($id);
			            			$image = get_post_thumb(false, 100, 100, false, $file);
		            	?>
							<a href="javascript:;" rel="<?php echo $c;?>" class="gal-thumbs<?php if($c==$i) { ?> active<?php } ?>" data-nr="<?php echo $c;?>">
								<img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>"/>
							</a>
			                <?php $c++; ?>
		               	 	<?php } ?>
		                <?php } ?>
					</div>
				</div>

				<div class="single-photo-content">
					<?php if(isset($term_list[$randID]->term_id)) { ?>
						<div class="content-category">
							<a href="<?php echo get_term_link((int)$term_list[$randID]->term_id, OT_POST_GALLERY.'-cat');?>" style="color: <?php ot_title_color($term_list[$randID]->term_id);?>;"><?php echo $term_list[$randID]->name;?></a>
						</div>
					<?php } ?>
					<h3><?php the_title();?></h3>
					<?php 
						if (get_the_content() != "") { 				
							add_filter('the_content','remove_images');
							add_filter('the_content','remove_objects');
							the_content();
						} 
					?>	
				</div>
			</div>
			<?php if(ot_option_compare($similarPosts,$similarPostsSingle)==true) { ?>
				<?php
					$categories = get_the_terms($post->ID, OT_POST_GALLERY.'-cat');
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
					<h2><?php _e("Related photo galleries", THEME_NAME);?></h2>
					<span><?php _e("Galleries from the same category", THEME_NAME);?></span>
				</div>

				<!-- BEGIN .photo-galleries -->
				<div class="photo-galleries">
						<?php

							$counter=1;
							$my_query = new WP_Query( 
								array( 
									'post__not_in' => array($post->ID),
									'post_type' => 'gallery', 
									'showposts' => 3, 
									'tax_query' => array(
										array(
											'taxonomy' => 'gallery-cat',
											'field' => 'id',
											'terms' => $categories[$randID]['term_id'],
										)
									),
									'orderby' => 'rand'
								)
							);
							
							if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); 
								$src = get_post_thumb($post->ID,365,262);
								$gallery_style = get_post_meta ( $post->ID, THEME_NAME."_gallery_style", true );
								$postDateSingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_date", true ); 
						?>
							<div class="item" data-id="gallery-<?php the_ID(); ?>">
								<div class="item-header">
									<a href="<?php the_permalink();?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>image-hover" data-path-hover="M 34,56 45,34 63,41 64,66 47,76 z" data-id="gallery-<?php the_ID(); ?>">
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
											<a href="<?php echo get_term_link((int)$categories[$randID]['term_id'], OT_POST_GALLERY.'-cat');?>" style="color: <?php ot_title_color($categories[$randID]['term_id']);?>;"><?php echo $categories[$randID]['name'];?></a>
										</div>
									<?php } ?>
									<h3><a href="<?php the_permalink();?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>" data-id="gallery-<?php the_ID(); ?>"><?php the_title();?></a></h3>
									<p>
										<?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
											<?php the_time(get_option('date_format'));?> /
										<?php } ?> 

										<?php echo OT_image_count($post->ID);?> 
										<?php 
											if(OT_image_count()==1) {
												_e("photo", THEME_NAME);
											} else {
												_e("photos", THEME_NAME);
											}
										?>
									</p>
									<a href="<?php the_permalink();?>" data-id="gallery-<?php the_ID(); ?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>read-more-link"><?php _e("View Gallery", THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
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
<?php
	$sidebar = get_post_meta ( OT_page_ID(), "_".THEME_NAME."_sidebar_select", true ); 
	$sidebar_2 = get_post_meta ( OT_page_ID(), "_".THEME_NAME."_sidebar_select_2", true ); 
	$sidebarCount = 0;
	if($sidebar!="off") {
		$sidebarCount++;
	}
	if($sidebar_2!="off") {
		$sidebarCount++;
	}
?>
<script>
	jQuery(document).ready(function() {
		jQuery(".single-photo-thumbs > .thumb-wrapper").owlCarousel({
			<?php
				switch ($sidebarCount) {
					case '0':
						echo "items : 10,";
						break;
					case '1':
						echo "items : 7,";
						break;
					case '2':
						echo "items : 5,";
						break;
					default:
						echo "items : 10,";
						break;
				}
			?>
			itemsDesktop : [1199,9],
			itemsDesktopSmall : [979,7],
			itemsTablet : [768,5],
			itemsMobile : [479,2],
			autoPlay : false,
			navigation : false,
			pagination : false
		});
	});
</script>
<?php get_footer(); ?>