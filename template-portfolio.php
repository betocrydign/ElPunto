<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* Template Name: Portfolio */
?>
<?php get_header(); ?>
<?php
	wp_reset_query();
	$paged = get_query_string_paged();
	$posts_per_page = get_option(THEME_NAME.'_portfolio_items');

	if($posts_per_page == "") {
		$posts_per_page = get_option('posts_per_page');
	}
	
	$catSlug = $wp_query->queried_object->slug;
	if(!$catSlug) {
		$my_query = new WP_Query(
			array(
				'post_type' => OT_POST_PORTFOLIO, 
				'posts_per_page' => $posts_per_page, 
				'paged'=>$paged
			)
		);  
	} else {
		$my_query = new WP_Query(
			array(
				'post_type' => OT_POST_PORTFOLIO, 
				'posts_per_page' => $posts_per_page, 
				'paged'=>$paged,
				'tax_query' => array(
					array(
						'taxonomy' => OT_POST_PORTFOLIO.'-cat',
						'field' => 'slug',
						'terms' => $catSlug
					)
				)
			)
		); 

	}

	//meta settings
	$postDate = get_option(THEME_NAME."_post_date_single");
	$categories = get_terms( OT_POST_PORTFOLIO.'-cat', 'orderby=name&hide_empty=0' );
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php get_template_part(THEME_SINGLE."page-title"); ?>
		<div class="category-select">
			<span class="category-meta"><?php _e("Select a category:", THEME_NAME);?></span>
			<span class="category-links">
				<a href="<?php echo get_page_link(ot_get_page("gallery", false));?>"<?php if(!$catSlug) { ?> class="active"<?php } ?>><?php _e("All", THEME_NAME);?></a>
				<?php foreach ($categories as $category) { ?>
					<?php if(isset($category->term_id)) { ?>
						<a href="<?php echo get_term_link((int)$category->term_id,OT_POST_PORTFOLIO.'-cat');?>" style="background: <?php ot_title_color($category->term_id, 'category', true);?>;" <?php if($catSlug==$category->slug) { ?> class="active"<?php } ?>><?php echo $category->name;?></a>
					<?php } ?>
				<?php } ?>
			</span>
		</div>

		<div class="portfolio-layout">
			<?php 
															
				$args = array(
					'post_type'     	=> OT_POST_PORTFOLIO,
					'post_status'  	 	=> 'publish',
					'showposts' 		=> -1
				);

				$myposts = get_posts( $args );	
				$count_total = count($myposts);

				$counter=1;	
			?>

			<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<?php 
					$src = get_post_thumb($my_query->post->ID,381,277); 
					$term_list = wp_get_post_terms($my_query->post->ID, OT_POST_PORTFOLIO.'-cat');

					$catCount=0;
					foreach($term_list as $term){
						$catCount++;
					}
					if($catCount>1) {
						$randID = rand(0,$catCount-1);
					} else {
						$randID = rand(0,$catCount-1);
					}
						

					$term = get_term( $term_list[$randID]->term_id, OT_POST_PORTFOLIO.'-cat' );
				
			?>
				<!-- BEGIN .item -->
				<div class="item">
					<div class="item-header">
						<a href="<?php the_permalink();?>" class="image-hover" data-path-hover="M 34,56 45,34 63,41 64,66 47,76 z">
							<figure>
								<img src="<?php echo $src["src"]; ?>" alt="<?php echo esc_attr(get_the_title());?>"/>
								<svg viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M 0,100 0,99 50,97 100,99 100,100 z" fill="<?php ot_title_color($term_list[$randID]->term_id);?>" /></svg>
								<figcaption>
									<span class="hover-text"><i class="fa fa-search"></i></span>
								</figcaption>
							</figure>
						</a>
					</div>
					<div class="item-content">
						<?php if($term->name) { ?>
							<div class="content-category">
								<a href="<?php echo get_term_link((int)$term->term_id,OT_POST_PORTFOLIO.'-cat');?>" style="color: <?php ot_title_color($term->term_id, 'category', true);?>;"><?php echo $term->name;?></a>
							</div>
						<?php } ?>
						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<?php 
							add_filter('excerpt_length', 'new_excerpt_length_30');	
							the_excerpt();
						?>
						<a href="<?php the_permalink();?>" class="read-more-link">
							<?php _e("More Info", THEME_NAME);?><i class="fa fa-angle-double-right"></i>
						</a>
					</div>
				<!-- END .item -->
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
				<h2 class="title"><?php _e( 'No items were found' , THEME_NAME );?></h2>
			<?php endif; ?>
		</div>

		<?php customized_nav_btns($paged, $my_query->max_num_pages); ?>


		
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>