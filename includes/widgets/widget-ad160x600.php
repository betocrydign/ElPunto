<?php
/*
 * Plugin Name: Custom 160x600 Ad Unit
 * Plugin URI: http://www.orange-themes.com
 * Description: A widget that allows the selection and configuration of a single 160x600 Banner
 * Version: 1.0
 * Author URI: http://www.orange-themes.com
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'tz_ad600_widgets' );

/*
 * Register widget.
 */
function tz_ad600_widgets() {
	register_widget( 'TZ_Ad600_Widget' );
}

/*
 * Widget class.
 */
class tz_ad600_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function TZ_Ad600_Widget() {
	
		/* Widget settings */
		$widget_ops = array( 'classname' => 'tz_ad300_widget', 'description' => __('A widget that allows the display and configuration of of a single 160x600 Banner.', THEME_NAME) );

		/* Widget control settings */
		$control_ops = array( 'width' => 160, 'height' => 600, 'id_base' => 'tz_ad600_widget' );

		/* Create the widget */
		parent::__construct( 'tz_ad600_widget', __(THEME_FULL_NAME.' Custom 160x600 Ad', THEME_NAME), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$ad = $instance['ad'];
		$link = $instance['link'];


		/* Before widget (defined by themes). */
		echo $before_widget;
		//if($title) echo $before_title.$title.$after_title;

		$contactID = ot_get_page("contact");
									
		/* Display the widget title if one was input (before and after defined by themes). */
		//echo $before_title.$title.$after_title;
		echo '<div class="banner">';
			/* Display Ad */
			if ( $link ) {
				echo '<a href="'.$link.'" target="_blank"><img src="'.$ad.'" alt="Banner"/></a>';
			} elseif ( $ad ) {
				echo '<img src="'.$ad.'" alt="Banner"/>';
			}
			if($contactID) {
				//echo '<a href="'.get_page_link($contactID[0]).'" class="banner-meta">'.__("Contact us about advert spaces", THEME_NAME).'<i class="fa fa-angle-double-up"></i></a>';
			}

		echo '</div>';
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['ad'] = $new_instance['ad'];
		$instance['link'] = $new_instance['link'];

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => '',
		'ad' => get_template_directory_uri()."/images/no-banner-160x600.jpg",
		'link' => 'http://www.orange-themes.com',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', THEME_NAME) ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		 -->
		<!-- Ad image url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'ad' ); ?>"><?php _e('Ad image url:', THEME_NAME) ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad' ); ?>" name="<?php echo $this->get_field_name( 'ad' ); ?>" value="<?php echo $instance['ad']; ?>" />
		</p>
		
		<!-- Ad link url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Ad link url:', THEME_NAME) ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
		</p>
		
	<?php
	}
}
?>