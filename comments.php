<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php printf ( __( 'This post is password protected. Enter the password to view comments.' , THEME_NAME ));?></p>
	<?php
		return;
	}
	$post_type = get_post_type();
	
	add_action('comment_form_top', 'OT_fields_rules' );
?>
<?php //You can start editing here. ?>
		<?php if (comments_open()) : ?>
			<!-- BEGIN .comment-list -->
			<div class="comment-list">
		<?php endif; ?>	

			<?php if (comments_open() || have_comments() ) : ?>

				<!--<div class="main-title">
					<h2><?php comments_number(__('No Comments so far', THEME_NAME), __('1 Comment so far', THEME_NAME), __('% Comments so far', THEME_NAME)); ?></h2>
					<span><?php _e("Jump into a conversation", THEME_NAME);?></span>
				</div>-->


				<?php if ( have_comments()) : ?>
					<div class="block-comments">
						<ol id="comments">
							<?php 
								global $orangeThemesCommentID;
								$orangeThemesCommentID = 0;
								wp_list_comments('type=comment&callback=orangethemes_comment'); 

							?>
						</ol>
						
						<div class="pagination"><?php paginate_comments_links(array('prev_text' => '<i class="fa fa-caret-left"></i>','next_text' => '<i class="fa fa-caret-right"></i>')); ?></div>
					<!-- END .panel-block -->
					</div>
				<?php endif; ?>
				<?php if (!have_comments()) : ?>
					<div class="block-comments">
						
						<div class="no-comments-yet">
							<h3><?php _e("No Comments Yet!", THEME_NAME);?></h3>
							<span><?php _e("You can be the one to <a href=\"#writecomment\">start a conversation</a>.", THEME_NAME);?></span>
						</div>

					</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( comments_open() ) : ?>
				<div id="writecomment" class="writecomment">
					<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
						<p class="registered-user-restriction"><?php printf ( __( 'Only <a href="%1$s"> registered </a> users can comment.', THEME_NAME ), wp_login_url( get_permalink() ));?> </p>
					<?php else : ?>
						<a href="#" name="respond"></a>
						<?php 
							$defaults = array(
								'comment_field'       	=> '<p class="contact-form-message"><!--<label for="c_message">'.__("Comment", THEME_NAME).'<span class="required">*</span></label>--><textarea name="comment" id="comment" placeholder="'.__("Comment text..",THEME_NAME).'"></textarea></p>',
								'comment_notes_before' 	=> '',
								'comment_notes_after'  	=> '',
								'id_form'              	=> '',
								'id_submit'            	=> 'submit',
								'title_reply'          => '',
								'title_reply_to'       => '',
								'cancel_reply_link'    	=> '',
								'label_submit'         	=> ''.__( 'Post a Comment', THEME_NAME ).'',
							);
							comment_form($defaults);			
						?>
					<?php endif; // if you delete this the sky will fall on your head ?>
				<!-- END #writecomment -->
				</div>
			<?php endif; ?>		
		<?php if (comments_open()) : ?>
			<!-- END .comment-list -->
			</div>
		<?php endif; ?>	