<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_social");'));

class OT_social extends WP_Widget {
	function OT_social() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Share Buttons');	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => "Socialize",
			'text' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$text = esc_attr($instance['text']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php  printf ( __( 'Text:' , THEME_NAME )); ?> <textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></label></p>


        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $text = wpautop($instance['text']);

		wp_reset_query();

		$link = home_url();
		

?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
			<div class="socialize-widget">
				<?php if($text) { ?>
					<?php echo $text;?>
				<?php } ?>
				<div class="ot-social-block">
					<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $link;?>" data-url="<?php echo $link;?>" data-url="<?php echo $link;?>" class="soc-link soc-facebook ot-share">
						<strong><span class="count">0</span><small><?php _e("likes", THEME_NAME);?></small></strong>
						<span><?php _e("facebook", THEME_NAME);?></span>
					</a>
					<a href="#" data-hashtags="" data-url="<?php echo $link;?>" data-via="<?php echo get_option(THEME_NAME.'_twitter_name');?>" data-text="<?php echo urlencode(remove_html(get_the_title()));?>" class="soc-link soc-twitter ot-tweet">
						<strong><span class="count">0</span><small><?php _e("tweets", THEME_NAME);?></small></strong>
						<span><?php _e("twitter", THEME_NAME);?></span>
					</a>
					<a href="https://plus.google.com/share?url=<?php echo $link; ?>" class="soc-link soc-google ot-pluss">
						<strong><?php echo OT_plusones($link);?><small><?php _e("+1's", THEME_NAME);?></small></strong>
						<span><?php _e("google+", THEME_NAME);?></span>
					</a>
					<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link;?>&title=<?php echo urlencode(remove_html(get_the_title()));?>" data-url="<?php echo $link;?>" class="soc-link soc-linkedin ot-link">
						<strong><span class="count">0</span><small><?php _e("shares", THEME_NAME);?></small></strong>
						<span><?php _e("linkedin", THEME_NAME);?></span>
					</a>
				</div>
			</div>

	<?php echo $after_widget; ?>
		
	
      <?php
	}
}

?>
