<?php
		
	// about authors
	$aboutAuthor = get_option(THEME_NAME."_about_author");
	$aboutAuthorSingle = get_post_meta( $post->ID, "_".THEME_NAME."_about_author", true ); 
	
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

<?php if(ot_option_compare($aboutAuthor,$aboutAuthorSingle)==true) { ?>
		<div class="article-author-block">
			<div class="main-title">
				<h2><?php _e("About Author", THEME_NAME);?></h2>
				<span><?php _e("More info about author", THEME_NAME);?></span>
			</div>
			<div class="author-block-inner">
				<div class="author-block-header">
					<a href="<?php $user_info = get_userdata($user_ID); echo get_author_posts_url($user_ID, $user_info->user_nicename ); ?>">
						<img src="<?php echo ot_get_avatar_url(get_avatar( get_the_author_meta('user_email',$user_ID), 130));?>" alt="<?php echo get_the_author_meta('display_name',$user_ID); ?>" />
					</a>
				</div>
				<div class="author-block-content">
					<h3>
						<a href="<?php $user_info = get_userdata($user_ID); echo get_author_posts_url($user_ID, $user_info->user_nicename ); ?>"><?php echo get_the_author_meta('display_name',$user_ID); ?></a>
					</h3>
					<div class="author-soc-icons">
						<?php if($facebook) { ?><a href="<?php echo $facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>
						<?php if($twitter) { ?><a href="<?php echo $twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
						<?php if($youtube) { ?><a href="<?php echo $youtube;?>" target="_blank"><i class="fa fa-youtube"></i></a><?php } ?>
						<?php if($pinterest) { ?><a href="<?php echo $pinterest;?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php } ?>
						<?php if($linkedin) { ?><a href="<?php echo $linkedin;?>" target="_blank"><i class="fa fa-linkedin"></i></a><?php } ?>
						<?php if($google) { ?><a href="<?php echo $google;?>" target="_blank" rel="author"><i class="fa fa-google-plus"></i></a><?php } ?>
						<?php if($dribbble) { ?><a href="<?php echo $dribbble;?>" target="_blank" rel="author"><i class="fa fa-dribbble"></i></a><?php } ?>
					</div>
					<p>
						<span class="vcard author">
							<span class="fn">

								<?php 
								// Este codigo se modifico para mostrar un maximo de 350 caracteres en la descripcion del autor
								// By Betuel Lorenzo
								$descripcion_autor = get_the_author_meta('description');

								echo substr($descripcion_autor, 0, 350).'...'; ?>
							</span>
						</span>
					</p>
 					<a href="<?php $user_info = get_userdata($user_ID); echo get_author_posts_url($user_ID, $user_info->user_nicename ); ?>" class="read-more-link"><?php _e("More by", THEME_NAME);?> <?php echo get_the_author_meta('display_name',$user_ID); ?><i class="fa fa-angle-double-right"></i></a>
 				</div>
			</div>
		</div>
<br/>
<?php } ?>