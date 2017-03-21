<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	//post banner	
	$postBanner = get_option(THEME_NAME."_post_banner");
	$postBannerCode = stripslashes(get_post_meta ( $post->ID, "_".THEME_NAME."_post_banner_code", true )); 
	if(!$postBannerCode) {
		$postBannerCode = stripslashes(get_option(THEME_NAME."_post_banner_code"));
	}
	

	if($postBanner=="on" || $postBannerCode) {
?>						
	<div class="article-body-banner banner">
		<?php echo do_shortcode($postBannerCode);?>
	</div>
<?php } ?> 