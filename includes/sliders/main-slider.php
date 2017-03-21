<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();


	//main slider
	$mainSlider = get_post_meta ( OT_page_id(), "_".THEME_NAME."_main_slider", true ); 

	if(is_category()) {
		$mainSlider = get_post_meta ( OT_page_id(), "_".THEME_NAME."_main_slider", true ); 
	}

	//post details
	$postCategory = get_option(THEME_NAME."_post_category_single");


?>
<?php if((is_array($mainSlider) && !empty($mainSlider) && !in_array("slider_off",$mainSlider)) || (is_category() && $mainSlider=="on")) { ?>
		<?php
		if(is_category()) {
			$catId = get_cat_id( single_cat_title("",false) );
			$category_in = $catId;
		} else {
			$category_in = $mainSlider;
		}

		$args=array(
			'category__in' => $category_in,
			'posts_per_page' => 4,
			'order'	=> 'DESC',
			'orderby'	=> 'date',
			'meta_key'	=> "_".THEME_NAME.'_main_slider_post',
			'meta_value'	=> 'on',
			'post_type'	=> 'post',
			'ignore_sticky_posts '	=> 1,
			'post_status '	=> 'publish'
		);


			$the_query = new WP_Query($args);
		?>

	<!-- BEGIN .ot-slider -->
	<div class="ot-slider owl-carousel">

		<!-- BEGIN .ot-slide -->
		<div class="ot-slide">
			<?php 
				$i=0;
				$counter=1;
				$itemClasses = array('first','second','third','fourth');
				$imageSizes = array(array('width'=>516,'height'=>368),array('width'=>247,'height'=>368),array('width'=>406,'height'=>180),array('width'=>406,'height'=>180));
			?>
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<?php
				$image = get_post_thumb($post->ID,$imageSizes[$i]['width'],$imageSizes[$i]['height'],THEME_NAME.'_homepage_image');
				$postCategorySingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_category", true );
                //get all post categories
                $categories = get_the_category($the_query->post->ID);
                $catCount = count($categories);
                //select a random category id
                $id = rand(0,$catCount-1);
                //cat id
                $catId = $categories[$id]->term_id;		
			?>
				<div class="ot-slider-layer <?php echo $itemClasses[$i];?>">
					<a href="<?php the_permalink();?>">
						<strong>
							<?php if(ot_option_compare($postCategory,$postCategorySingle)==true && !empty($categories)) { ?>
								<i style="background-color: <?php ot_title_color($catId, 'category', true);?>; color: #fff;"><?php echo get_cat_name($catId);?></i>
							<?php } ?>
							<?php the_title();?>
						</strong>
						<img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>" />
					</a>
				</div>
				<?php if(($i+1)%4==0 && $the_query->post_count!=$counter) { ?>
					<!-- END .ot-slide -->
					</div>
					<!-- BEGIN .ot-slide -->
					<div class="ot-slide">
					<?php $i=-1; ?>
				<?php } ?>
			<?php $i++; ?>
			<?php $counter++; ?>
			<?php endwhile;?>
			<?php endif; ?>
		<!-- END .ot-slide -->
		</div>
	<!-- END .ot-slider -->
	</div>
	<?php } ?>
<?php wp_reset_query();  ?>