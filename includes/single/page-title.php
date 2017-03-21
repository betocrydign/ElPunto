<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	$post_type = get_post_type();

	$singlePostBlogTitle = get_option(THEME_NAME."_singlePostBlogTitle");

	//single page titile
	$titleShow = get_post_meta ( OT_page_id(), "_".THEME_NAME."_title_show", true ); 

	if($post_type==OT_POST_GALLERY || $post_type==OT_POST_PORTFOLIO) {
		if($post_type==OT_POST_GALLERY) {
			$subID = ot_get_page(OT_POST_GALLERY);
		} 		
		if($post_type==OT_POST_PORTFOLIO) {
			$subID = ot_get_page(OT_POST_PORTFOLIO);
		} 
		$subtitle = get_post_meta ( $subID[0], "_".THEME_NAME."_subtitle", true ); 
	} else {
		$subtitle = get_post_meta ( OT_page_id(), "_".THEME_NAME."_subtitle", true ); 	
	}
	

	if(is_category()) {
		//custom colors
		$catId = get_cat_id( single_cat_title("",false) );
		$titleColor = ot_title_color($catId, "category", false);
	} else {
		//custom colors
		$titleColor = ot_title_color(OT_page_id(),"page", false);
	}


?>					

<?php if($post_type=="post" && is_single()) { ?>
	<?php if($singlePostBlogTitle == "on") { ?>
		<?php $subtitle = get_post_meta ( get_option('page_for_posts'), "_".THEME_NAME."_subtitle", true ); ?>
		<div class="main-title" style="border-left: 4px solid <?php echo $titleColor;?>;">
			<h2><?php echo get_the_title(get_option('page_for_posts')); ?></h2>
			<?php if($subtitle) { ?>
				<span><?php echo $subtitle;?></span>
			<?php } ?>
		</div>
	<?php } ?>
<?php } elseif($titleShow!="no"){ ?>

	<div class="main-title" style="border-left: 4px solid <?php echo $titleColor;?>;">
		<h2><?php echo ot_page_title(); ?></h2>
		<?php if($subtitle) { ?>
			<span><?php echo $subtitle;?></span>
		<?php } ?>
	</div>
<?php } ?> 