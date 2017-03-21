<?php
	wp_reset_query();
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php get_template_part(THEME_SINGLE."post-header"); ?>
	    <?php if (have_posts()) : ?>
	        <?php woocommerce_content(); ?>
		<?php else: ?>
			<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
		<?php endif; ?>
	<?php get_template_part(THEME_SINGLE."post-footer"); ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
