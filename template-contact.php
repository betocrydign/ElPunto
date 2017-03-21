<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Template Name: Contact Page
*/	
?>
<?php get_header(); ?>
<?php 
	wp_reset_query();
	$mail_to = get_post_meta ( $post->ID, "_".THEME_NAME."_contact_mail", true ); 
	$map = get_post_meta ( $post->ID,  "_".THEME_NAME."_map", true ); 

?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php if($mail_to) { ?>
		<?php if (have_posts()) :  ?>
				<?php get_template_part(THEME_SINGLE."page-title"); ?>
				<div class="article-content">
					<?php if($map) { ?>
						<div class="google-maps">
							<?php echo $map;?>
						</div>
					<?php } ?>
					<?php the_content();?>
				</div>
				<!-- BEGIN .writecomment -->
				<div class="writecomment">

					<div class="coloralert" style="display:none; background: #68a117;">
						<i class="fa fa-check contact-success-block"></i>
						<p><?php _e("Great Success",THEME_NAME);?><br><?php _e("Your comment went through!",THEME_NAME);?></p>
						<a href="#close-alert"><i class="fa fa-times-circle"></i></a>
					</div>

					<form id="writecomment" name="writecomment" class="contact-form" action="">
						<p class="comment-info" style="display:none;">
							<i class="fa fa-info"></i>
							<strong><?php _e("Your data will be safe!",THEME_NAME);?></strong>
							<span><?php _e("Your e-mail address will not be published. Also other data will not be shared with third person.<br/>Required fields are marked",THEME_NAME);?></span>
						</p>

						<input type="hidden"  name="form_type" value="contact" />
						<input type="hidden"  name="post_id" value="<?php echo $post->ID;?>" />

						<p class="contact-form-user">
							<!--<label for="c_name"><?php _e("Nickname", THEME_NAME);?><span class="required">*</span></label>-->
							<input type="text" name="u_name" id="contact-name-input" placeholder="<?php _e("Nickname", THEME_NAME);?>" title="<?php _e("Nickname", THEME_NAME);?>" />
							<span class="error-msg" id="contact-name-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="ot-error-text"></font></span>
						</p>
						<p class="contact-form-email">
							<!--<label for="c_name"><?php _e("E-mail", THEME_NAME);?><span class="required">*</span></label>-->
							<input type="text" name="email" id="contact-mail-input" placeholder="<?php _e("E-mail", THEME_NAME);?>" title="<?php _e("E-mail", THEME_NAME);?>" />
							<span class="error-msg" id="contact-mail-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="ot-error-text"></font></span>
						</p>
						<p class="contact-form-website" style="display:none;">
							<!--<label for="c_website"><?php _e("Website", THEME_NAME);?></label>-->
							<input type="text" placeholder="<?php _e("Website", THEME_NAME);?>" name="url" id="contact-url-input" title="<?php _e("Website", THEME_NAME);?>" />
						</p>
						<p class="contact-form-message">
							<!--<label for="c_name"><?php _e("Your message", THEME_NAME);?><span class="required">*</span></label>-->
							<textarea name="message" placeholder="<?php _e("Your message", THEME_NAME);?>" id="contact-message-input"></textarea>
							<span class="error-msg" id="contact-message-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="ot-error-text"></font></span>
						</p>
						<p>
							<input name="submit" type="submit" class="button" id="contact-submit" value="<?php printf ( __( 'Send a Message' , THEME_NAME ));?>" />
						</p>
					</form>
				<!-- END #writecomment -->
				</div>

		<?php else: ?>
			<p><?php printf ( __('Sorry, no posts matched your criteria.' , THEME_NAME )); ?></p>
		<?php endif; ?>
	<?php } else { echo "<span style=\"color:#000; font-size:14pt;\">You need to set up Your contact mail!</span>"; } ?>
<?php get_template_part(THEME_LOOP."loop","end"); ?>
<?php get_footer(); ?>