<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* Template Name: Photo Gallery */
?>
<?php get_header(); ?>
<?php
	wp_reset_query();
	$paged = get_query_string_paged();
	$posts_per_page = get_option(THEME_NAME.'_gallery_items');

	if($posts_per_page == "") {
		$posts_per_page = get_option('posts_per_page');
	}
	
	$catSlug = $wp_query->queried_object->slug;
	if(!$catSlug) {
		$my_query = new WP_Query(
			array(
				'post_type' => OT_POST_GALLERY, 
				'posts_per_page' => $posts_per_page, 
				'paged'=>$paged
			)
		);  
	} else {
		$my_query = new WP_Query(
			array(
				'post_type' => OT_POST_GALLERY, 
				'posts_per_page' => $posts_per_page, 
				'paged'=>$paged,
				'tax_query' => array(
					array(
						'taxonomy' => OT_POST_GALLERY.'-cat',
						'field' => 'slug',
						'terms' => $catSlug
					)
				)
			)
		); 

	}

	//meta settings
	$postDate = get_option(THEME_NAME."_post_date_single");

?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php get_template_part(THEME_SINGLE."page-title"); ?>
		<!-- BEGIN .photo-galleries -->
		<div class="photo-galleries">
			<?php 
															
				$args = array(
					'post_type'     	=> OT_POST_GALLERY,
					'post_status'  	 	=> 'publish',
					'showposts' 		=> -1
				);

				$myposts = get_posts( $args );	
				$count_total = count($myposts);

				$counter=1;	
			?>

			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<?php 
					$src = get_post_thumb($post->ID,381,277); 
					$postDateSingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_date", true ); 
					$term_list = wp_get_post_terms($post->ID, OT_POST_GALLERY.'-cat');

					$catCount=0;
					foreach($term_list as $term){
						$catCount++;
					}
					
					$randID = rand(0,$catCount-1);	

				
				?>
				<?php $gallery_style = get_post_meta ( $post->ID, "_".THEME_NAME."_gallery_style", true ); ?>
						<div class="item" data-id="gallery-<?php the_ID(); ?>">
							<div class="item-header">
								<a href="<?php the_permalink();?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>image-hover" data-path-hover="M 34,56 45,34 63,41 64,66 47,76 z" data-id="gallery-<?php the_ID(); ?>">
									<figure>
										<img src="<?php echo $src["src"]; ?>" alt="<?php echo esc_attr(get_the_title());?>"/>
										<svg viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M 0,100 0,99 50,97 100,99 100,100 z" <?php if(isset($term_list[$randID]->term_id)) { ?>fill="<?php ot_title_color($term_list[$randID]->term_id);?>"<?php } ?> /></svg>
										<figcaption>
											<span class="hover-text"><i class="fa fa-search"></i></span>
										</figcaption>
									</figure>
								</a>
							</div>
							<div class="item-content">
								<?php if(isset($term_list[$randID]->term_id)) { ?>
									<div class="content-category">
										<a href="<?php echo get_term_link((int)$term_list[$randID]->term_id, OT_POST_GALLERY.'-cat');?>" style="color: <?php ot_title_color($term_list[$randID]->term_id);?>;"><?php echo $term_list[$randID]->name;?></a>
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
								<a href="<?php the_permalink();?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>read-more-link" data-id="gallery-<?php the_ID(); ?>"><?php _e("View Gallery", THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
							</div>
						</div>
			<?php 
				if ( $paged != 0 ) {
					$a = ($paged-1)*$posts_per_page;
				} else {		
					$a = 1;
				}
			?>
						
			<?php $counter++; ?>
			<?php endwhile; ?>
			<?php else : ?>
				<h2 class="title"><?php _e( 'No galleries were found' , THEME_NAME );?></h2>
			<?php endif; ?>
		</div>
		<?php customized_nav_btns($paged, $my_query->max_num_pages); ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>