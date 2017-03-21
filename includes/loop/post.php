<?php

 // by --> Betuel Lorenzo

	if ( is_archive( 'author' ) ) {?>

		<!-- <div class="article-list-block"> -->

<?php 

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$image = get_post_thumb($post->ID,0,0); 

	// type
	$videoCode = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true ); 


	//post details
	$postCategory = get_option(THEME_NAME."_post_category_single");
	$postCategorySingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_category", true ); 
	$imageStyle = get_option(THEME_NAME."_post_style");
	$imageStyleSingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_style", true ); 

	if((get_option(THEME_NAME."_show_first_thumb") != "on" || $image['show']!=true) && !$videoCode) {
		$class = " image-no";
	} else {
		$class = false;
	}

	if(ot_option_compare($imageStyle,$imageStyleSingle)==false) { 
		$class.= " image-left";
		$words = 16;
	} else {
		$class.= false;
		$words = 40;
	}



    $categories = get_the_category($post->ID);


    $averageRating = ot_avarage_rating($post->ID);
?>

			<div <?php

			$classes_autor = array(
							'item'.$class,
							'lista-autor',
			);

			 post_class($classes_autor); ?>>
				<?php if($class!=" image-no") { ?>
					<div class="item-header">
						<?php get_template_part(THEME_LOOP."image"); ?>
					</div>
				<?php } ?>
				<div class="item-content">
					<?php if(ot_option_compare($postCategory,$postCategorySingle)==true && !empty($categories)) { ?>
						<div class="content-category">
							<?php foreach($categories as $cat) { ?>
								<a href="<?php echo get_category_link($cat->term_id);?>" style="color: <?php ot_title_color($cat->term_id, 'category', true);?>;"><?php echo get_cat_name($cat->term_id);?></a>
							<?php } ?>
						</div>
					<?php } ?>
					<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					<?php if($averageRating!=false) { ?>
						<div class="ot-star-rating">
							<span style="width: <?php echo $averageRating[0];?>%;" class=""><strong class="rating"><?php echo $averageRating[1];?></strong> <?php _e("out of 5", THEME_NAME);?></span>
							<strong><?php _e("Rating:", THEME_NAME);?> <?php echo $averageRating[1];?> <?php _e("out of 5 stars", THEME_NAME);?></strong>
						</div>
					<?php } ?>
					<?php 
						add_filter('excerpt_length', 'new_excerpt_length_'.$words);	
						the_excerpt();
					?>
					<a href="<?php the_permalink();?>" class="read-more-link"><?php _e("Read More", THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
				</div>
			</div>
		
<!-- </div> -->
	<?php

};?>

 <!-- by-> Betuel Lorenzo -->
<?php

 

	if ( !is_archive( 'author' ) ) {?>



<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$image = get_post_thumb($post->ID,0,0); 

	// type
	$videoCode = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true ); 


	//post details
	$postCategory = get_option(THEME_NAME."_post_category_single");
	$postCategorySingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_category", true ); 
	$imageStyle = get_option(THEME_NAME."_post_style");
	$imageStyleSingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_style", true ); 

	if((get_option(THEME_NAME."_show_first_thumb") != "on" || $image['show']!=true) && !$videoCode) {
		$class = " image-no";
	} else {
		$class = false;
	}

	if(ot_option_compare($imageStyle,$imageStyleSingle)==false) { 
		$class.= " image-left";
		$words = 16;
	} else {
		$class.= false;
		$words = 40;
	}



    $categories = get_the_category($post->ID);


    $averageRating = ot_avarage_rating($post->ID);
?>

	<div <?php post_class("item".$class); ?>>
		<?php if($class!=" image-no") { ?>
			<div class="item-header">
				<?php get_template_part(THEME_LOOP."image"); ?>
			</div>
		<?php } ?>
		<div class="item-content">
			<?php if(ot_option_compare($postCategory,$postCategorySingle)==true && !empty($categories)) { ?>
				<div class="content-category">
					<?php foreach($categories as $cat) { ?>
						<a href="<?php echo get_category_link($cat->term_id);?>" style="color: <?php ot_title_color($cat->term_id, 'category', true);?>;"><?php echo get_cat_name($cat->term_id);?></a>
					<?php } ?>
				</div>
			<?php } ?>
			<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php if($averageRating!=false) { ?>
				<div class="ot-star-rating">
					<span style="width: <?php echo $averageRating[0];?>%;" class=""><strong class="rating"><?php echo $averageRating[1];?></strong> <?php _e("out of 5", THEME_NAME);?></span>
					<strong><?php _e("Rating:", THEME_NAME);?> <?php echo $averageRating[1];?> <?php _e("out of 5 stars", THEME_NAME);?></strong>
				</div>
			<?php } ?>
			<?php 
				add_filter('excerpt_length', 'new_excerpt_length_'.$words);	
				the_excerpt();
			?>
			<a href="<?php the_permalink();?>" class="read-more-link"><?php _e("Read More", THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
		</div>
	</div>
<?php }?>