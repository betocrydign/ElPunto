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
	<?php

 // condision para mostrar la info del autor en la paginas donde se muestran sus post by --> Betuel Lorenzo

	if ( is_archive( 'author' ) ) {?>
		<?php
			if(isset($_GET['author_name'])) :
				$curauth = get_userdatabylogin($author_name);
				else :
				$curauth = get_userdata(intval($author));
				endif;

				
				?>
				<div class="article-author-block" style="background: <?php ot_title_color($cat->term_id, 'category', true);?>;color: white;padding: 20px 10px;">
					<div  class="author-block-inner">
						<div class="author-block-header" id="autor-info">
						 	<div style="padding: 0px 10px 10px 5px;" id="autor-imagen">
						 		<a href="<?php echo $curauth->user_url; ?>">
						 			<?php echo get_avatar( $curauth->user_email, '80', '' ); ?></a>
							</div>
						</div>
						<div class="author-block-content" id="descripcion">
						 	<h3>Acerca de <?php echo $curauth->display_name; ?></h3>
						 	<p style="font-size: 14px!important;"><span class="vcard author">
									<span class="fn">
						 				<?php echo $curauth->user_description; ?>
						 			</span>
						 		</span>
						 		<br>
						 	</p>
							<p>
								<?php 

									// author id
									$user_ID = get_the_author_meta('ID');
									//social
									$pinterest = get_user_meta($user_ID, 'pinterest', true);
									$youtube = get_user_meta($user_ID, 'youtube', true);
									$twitter = get_user_meta($user_ID, 'twitter', true);
									$facebook = get_user_meta($user_ID, 'facebook', true);
									$google = get_user_meta($user_ID, 'googlepluss', true);
									$linkedin = get_user_meta($user_ID, 'linkedin', true);
									$dribbble = get_user_meta($user_ID, 'dribbble', true);
								 ?>
							 	<div class="author-soc-icons">
									<?php if($facebook) { ?><a style="background: white;color: <?php ot_title_color($cat->term_id, 'category', true);?>;" href="<?php echo $facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>
									<?php if($twitter) { ?><a style="background: white;color: <?php ot_title_color($cat->term_id, 'category', true);?>;" href="<?php echo $twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
									<?php if($youtube) { ?><a  style="background: white;color: <?php ot_title_color($cat->term_id, 'category', true);?>;" href="<?php echo $youtube;?>" target="_blank"><i class="fa fa-youtube"></i></a><?php } ?>
									<?php if($pinterest) { ?><a style="background: white;color: <?php ot_title_color($cat->term_id, 'category', true);?>;" href="<?php echo $pinterest;?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php } ?>
									<?php if($linkedin) { ?><a style="background: white;color: <?php ot_title_color($cat->term_id, 'category', true);?>;" href="<?php echo $linkedin;?>" target="_blank"><i class="fa fa-linkedin"></i></a><?php } ?>
									<?php if($google) { ?><a style="background: white;color: <?php ot_title_color($cat->term_id, 'category', true);?>;" href="<?php echo $google;?>" target="_blank" rel="author"><i class="fa fa-google-plus"></i></a><?php } ?>
									<?php if($dribbble) { ?><a  style="background: white;color: <?php ot_title_color($cat->term_id, 'category', true);?>;" href="<?php echo $dribbble;?>" target="_blank" rel="author"><i class="fa fa-dribbble"></i></a><?php } ?>
								</div>
							</p>
						 </div>
					</div>
				</div>
				<br/>
<?php

} else {
	echo 'Ocurrio un error con la funcion para mostrar el autor';
}?>
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
