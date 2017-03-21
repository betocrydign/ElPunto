<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_triple");'));

class OT_triple extends WP_Widget {
	function OT_triple() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Double Box');	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'count_r' => '3',
			'count_c' => '3',
			'cat_r' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );


		$count_r = esc_attr($instance['count_r']);
		$cat_r = esc_attr($instance['cat_r']);
		$count_c = esc_attr($instance['count_c']);
        ?>
			<p><label for="<?php echo $this->get_field_id('count_r'); ?>"><?php printf ( __( 'Recent Post Count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count_r'); ?>" name="<?php echo $this->get_field_name('count_r'); ?>" type="text" value="<?php echo $count_r; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('cat_r'); ?>"><?php printf ( __( 'Recent Post Category:' , THEME_NAME ));?>
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
			<select name="<?php echo $this->get_field_name('cat_r'); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value=""><?php _e("Latest News", THEME_NAME);?></option>
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo $ar->term_id; ?>" <?php if($ar->term_id==$cat_r)  {echo 'selected="selected"';} ?>><?php echo $ar->cat_name; ?></option>
				<?php } ?>
			</select>
			
			</label></p>
			<p><label for="<?php echo $this->get_field_id('count_c'); ?>"><?php printf ( __( 'Comment Count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count_c'); ?>" name="<?php echo $this->get_field_name('count_c'); ?>" type="text" value="<?php echo $count_c; ?>" /></label></p>

		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['count_r'] = strip_tags($new_instance['count_r']);
		$instance['count_c'] = strip_tags($new_instance['count_c']);
		$instance['cat_r'] = strip_tags($new_instance['cat_r']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$count_r = $instance['count_r'];
		$count_c = $instance['count_c'];
		$cat_r = $instance['cat_r'];

	
		if(!$count_r) $count_r = 4;
		if(!$count_c) $count_c = 4;
		$widget_id = $args['widget_id'];
		
		if($cat_r) {
			$link = get_category_link( $cat_r );
		} else {
			$blogID = get_option('page_for_posts');
			$link = get_page_link($blogID);
		}

		//post details
		$postCategory = get_option(THEME_NAME."_post_category_single");
		$postDate = get_option(THEME_NAME."_post_date_single");
		
?>		
	<?php echo $before_widget; ?>
		<div class="ot-tabbed">
			<h3 class="active"><?php _e("Comments", THEME_NAME);?></h3>
			<h3><?php _e("Latest News", THEME_NAME);?></h3>
		</div>
		<?php 

			$args_r = array(
				'cat'=> $cat_r,
				'posts_per_page'=> $count_r,
				'ignore_sticky_posts' => true
			);

			$args_c=	array(
				'status' => 'approve', 
				'order' => 'DESC',
				'number' => $count_c
			);
		?>
		<div class="comments-block ot-tab-block active">
			<?php				
				$comments = get_comments($args_c);
				$totalCount = count($comments);
				$counter = 1;
							
				foreach($comments as $comment) {
					if($comment->user_id && $comment->user_id!="0") {
						$authorName = get_the_author_meta('display_name',$comment->user_id );
					} else {
						$authorName = $comment->comment_author;
					}	
			 ?>			


				<div class="item">
					<div class="item-header">
						<a href="#" class="image-avatar"><img src="<?php echo ot_get_avatar_url(get_avatar( $comment, 60));?>" alt="<?php echo esc_attr($authorName); ?>" /></a>
					</div>
					<div class="item-content">
						<h4><a href="<?php echo get_comment_link($comment);?>"><?php echo $authorName; ?></a></h4>
						<p><?php echo WordLimiter(get_comment_excerpt($comment->comment_ID),10);?></p>
						<a href="<?php echo get_comment_link($comment);?>" class="read-more-link"><?php _e("View comment", THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
					</div>
				</div>
			<?php } ?>

		</div>
		<div class="article-block ot-tab-block">
			<?php
				//set recent post query
				$the_query = new WP_Query($args_r); 
				if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 

				$image = get_post_thumb($the_query->post->ID,0,0);
				$categories = get_the_category($the_query->post->ID); 
				$postCategorySingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_category", true ); 
				$postDateSingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_date", true ); 
			?>
					<div class="item<?php if($image['show']!=true) { ?> no-image<?php } ?>">
						<?php if($image['show']==true) { ?>
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
