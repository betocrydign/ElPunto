<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	//post details
	$imageStyle = get_option(THEME_NAME."_post_style");
	$imageStyleSingle = get_post_meta ( $post->ID, "_".THEME_NAME."_post_style", true ); 

	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true ); 

	//image icons
	$icon = get_post_meta( $post->ID, "_".THEME_NAME."_image_icon", true ); 
	$iconText = get_post_meta( $post->ID, "_".THEME_NAME."_image_text", true ); 

    //get all post categories
    $categories = get_the_category($post->ID);
    $catCount = count($categories);
    //select a random category id
    $id = rand(0,$catCount-1);
    //cat id
    if(isset($categories[$id]->term_id)) {
 	    $catId = $categories[$id]->term_id;   	
    }


	if(ot_option_compare($imageStyle,$imageStyleSingle)==false) { 
		$width = 347;
		$height = 249;
		$path1= "M 34,56 45,34 63,41 64,66 47,76 z";
		$path2= "M 0,100 0,99 50,97 100,99 100,100 z";
	} else {
		$width = 817;
		$height = 404;
		$path1= "M 41,53 46,34 56.5,37.5 58,59 48.5,68.2 z";
		$path2= "M 0,100 0,99 50,97 100,99 100,100 z";
	}







	$image = get_post_thumb($post->ID,$width,$height); 
	if(get_option(THEME_NAME."_show_first_thumb") == "on" && $image['show']==true && !$video) {
?>
	<a href="<?php the_permalink();?>" class="image-hover"<?php if( $icon != false && $icon!="Select a Icon") { ?> data-path-hover="<?php echo $path1;?>"<?php } ?>>
		<figure>
			<img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>"/>
			<?php if( $icon != false && $icon != "Select a Icon") { ?>
				<svg viewBox="0 0 100 100" preserveAspectRatio="none"><path d="<?php echo $path2;?>" fill="<?php ot_title_color($catId, 'category', true);?>" /></svg>
				<figcaption>
					<span class="hover-text"><i class="fa <?php echo $icon;?>"></i><span><?php echo $iconText;?></span></span>
				</figcaption>
			<?php } ?>
		</figure>
	</a>

<?php } else if(get_option(THEME_NAME."_show_first_thumb") == "on" && $video) { ?>
		<?php if(get_video_type($video)!="mixcloud" && get_video_type($video)!="soundcloud" ) { ?>
			<div class="video-embed">
		<?php } ?>
			<?php echo stripslashes($video);?>
		<?php if(get_video_type($video) != "mixcloud" && get_video_type($video) != "soundcloud" ) { ?>
			</div>
		<?php } ?>
		
<?php } ?>