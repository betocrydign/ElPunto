<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_cat_posts");'));

class OT_cat_posts extends WP_Widget {
	function OT_cat_posts() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' '.__("Latests News", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __("Latests News", THEME_NAME),
			'cat' => '',
			'count' => '3',
			'images' => 'show',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$cat = esc_attr($instance['cat']);
		$count = esc_attr($instance['count']);
		$images = esc_attr($instance['images']);
        ?>
         	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php printf ( __( 'Category:' , THEME_NAME ));?>
			<?php
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'taxonomy'                 => 'category');
				$args = get_categories( $args ); 
			?> 	
			<select name="<?php echo $this->get_field_name('cat'); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value=""><?php _e("Latest News", THEME_NAME);?></option>
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo $ar->term_id; ?>" <?php if($ar->term_id==$cat)  {echo 'selected="selected"';} ?>><?php echo $ar->cat_name; ?></option>
				<?php } ?>
			</select>
			
			</label></p>			
			<p><label for="<?php echo $this->get_field_id('images'); ?>"><?php printf ( __( 'Images:' , THEME_NAME ));?>
			<select name="<?php echo $this->get_field_name('images'); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value="show" <?php if("show"==$images)  {echo 'selected="selected"';} ?>><?php _e("Show", THEME_NAME);?></option>
				<option value="hide" <?php if("hide"==$images)  {echo 'selected="selected"';} ?>><?php _e("Hide", THEME_NAME);?></option>
			</select>
			
			</label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Post count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['images'] = strip_tags($new_instance['images']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$count = $instance['count'];
		$cat = $instance['cat'];
		$images = $instance['images'];


	
	$args=array(
		'cat'=> $cat,
		'posts_per_page'=> $count,
		'ignore_sticky_posts' => true
	);
	
	$the_query = new WP_Query($args);
		$counter = 1;

	$blogID = get_option('page_for_posts');

	if($cat) {
		$link = get_category_link( $cat );
	} else {
		$link = get_page_link($blogID);
	}
		//post details
		$postCategory = get_option(THEME_NAME."_post_category_single");
		$postDate = get_option(THEME_NAME."_post_date_single");
?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>

			<div class="article-block">
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php

					// post details
					$categories = get_the_category($the_query->post->ID); 
					$postCategorySingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_category", true ); 
					$postDateSingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_date", true ); 
					$image = get_post_thumb($the_query->post->ID,0,0); 

				?>
					<div class="item<?php if($image['show']==false) { echo " no-image"; } ?>">
						<?php if($image['show']==true && $images!="hide") { ?>
							<div class="item-header">
								<a href="<?php the_permalink();?>" class="image-hover">
									<?php echo ot_image_html($the_query->post->ID,161,161); ?>
								</a>
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
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<?php 
								add_filter('excerpt_length', 'new_excerpt_length_10');	
								the_excerpt();
							?>
							<?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
								<span><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time(get_option('date_format'));?></a></span>
							<?php } ?>
						</div>
					</div>
				<?php endwhile; else: ?>
					<p><?php  _e( 'No posts where found' , THEME_NAME);?></p>
				<?php endif; ?>
			</div>

	<?php echo $after_widget; ?>

      <?php
	}
}
?>