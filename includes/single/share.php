<?php


	//social share icons
	$shareAll = get_option(THEME_NAME."_share_all");
	$shareSingle = get_post_meta( $post->ID, "_".THEME_NAME."_share_single", true ); 
	$image = get_post_thumb($post->ID,0,0); 
?>

		<?php if(ot_option_compare($shareAll,$shareSingle)==true && (!function_exists("is_bbpress") || (function_exists("is_bbpress") && !is_bbpress()))) {?>
			<div class="share-article-body">
				<div class="main-title">
					<h2><?php _e("Share This Article", THEME_NAME);?></h2>
					<span><?php _e("Do the sharing thingy", THEME_NAME);?></span>
				</div>
				<div class="right">
					<a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" class="share-body ot-facebook ot-share">
						<i class="fa fa-facebook"></i>
						<span class="count">0</span>
					</a>
					<a href="#" data-url="<?php the_permalink();?>" data-via="<?php echo get_option(THEME_NAME.'_twitter_name');?>" data-text="<?php the_title();?>" class="share-body ot-twitter ot-tweet">
						<i class="fa fa-twitter"></i>
						<span class="count">0</span>
					</a>
					<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="share-body ot-google ot-pluss">
						<i class="fa fa-google-plus"></i>
						<span class="count"><?php echo OT_plusones(get_permalink());?></span>
					</a>
					<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php the_title();?>" data-url="<?php the_permalink();?>" class="share-body ot-linkedin ot-link">
						<i class="fa fa-linkedin"></i>
						<span class="count">0</span>
					</a>
					<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image['src']; ?>&description=<?php the_title(); ?>" data-url="<?php the_permalink();?>" class="share-body ot-pinterest ot-pin">
						<i class="fa fa-pinterest"></i>
						<span class="count">0</span>
					</a>
				</div>
			</div>


		<?php } ?>

