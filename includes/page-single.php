<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php get_template_part(THEME_SINGLE."post-header"); ?>
		<?php if (have_posts()) :  ?>
			<?php get_template_part(THEME_SINGLE."page-title"); ?>
			<?php get_template_part(THEME_SINGLE."image");?>
			<?php the_content();?>
			<?php get_template_part(THEME_SINGLE."share"); ?>
		<?php else: ?>
			<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
		<?php endif; ?>
	<?php get_template_part(THEME_SINGLE."post-footer"); ?>
	<?php wp_reset_query(); ?>
	<?php if ( comments_open() ) : ?>
		<?php comments_template(); // Get comments.php template ?>
	<?php endif; ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
				