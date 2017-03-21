<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	//blog banner	
	$blogBanner = get_option(THEME_NAME."_blog_banner");
	$blogBannerCount = get_option(THEME_NAME."_blog_banner_count");
	$blogBannerCode = stripslashes(get_option(THEME_NAME."_blog_banner_code"));
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>

	<?php get_template_part(THEME_SINGLE."page-title"); ?>
	<?php $counter = 1;?>
	<?php get_template_part(THEME_SINGLE."blog-start"); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if($counter==1 && 0==$blogBannerCount && $blogBanner=="on") { ?>
				<div class="item">
					<div class="banner">
						<?php echo $blogBannerCode;?>
					</div>
				</div>
			<?php } ?>
			<?php get_template_part(THEME_LOOP."post"); ?>
			<?php if($counter==$blogBannerCount && $blogBanner=="on") { ?>
				<div class="item">
					<div class="banner">
						<?php echo $blogBannerCode;?>
					</div>
				</div>
			<?php } ?>
		<?php $counter++; ?>
		<?php endwhile; else: ?>
			<?php get_template_part(THEME_LOOP."no-post"); ?>
		<?php endif; ?>
	<?php get_template_part(THEME_SINGLE."blog-end"); ?>
	<?php customized_nav_btns($paged, $wp_query->max_num_pages); ?>

<?php get_template_part(THEME_LOOP."loop-end"); ?>
