<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	
	$width = 1440;
	$height = 564;
	$image = get_post_thumb($post->ID,$width,$height); 
	

	//post details
	$singleImage = get_option(THEME_NAME."_show_single_thumb");
	$singleImageSingle = get_post_meta( $post->ID, "_".THEME_NAME."_show_single_thumb", true );


	// type
	$videoCode = get_post_meta( OT_page_id(), "_".THEME_NAME."_video_code", true ); 
	if($videoCode ) {
		ot_video_thumbnail($videoCode, OT_page_id());
		$image = get_post_thumb($post->ID,$width,$height); 
	}
	
?>

		<?php 
			if(ot_option_compare($singleImage,$singleImageSingle)==true && $image['show']==true  && !$videoCode || (!$singleImage && $image['show']==true  && !$videoCode)) {
		?>
			<?php echo ot_image_html($post->ID,$width,$height); ?>
		<?php } elseif (ot_option_compare($singleImage,$singleImageSingle)==true && $videoCode) { ?>
			<?php if(get_video_type($videoCode)!="mixcloud" && get_video_type($videoCode)!="soundcloud" ) { ?>
				<div class="video-embed">
			<?php } ?>
					<?php echo $videoCode; ?>
			<?php if(get_video_type($videoCode)!="mixcloud" && get_video_type($videoCode)!="soundcloud" ) { ?>
				</div>
			<?php } ?>
		<?php }  ?>