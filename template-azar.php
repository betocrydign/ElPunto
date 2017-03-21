<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
wp_reset_query();
/*
Template Name: Azar Page
*/	
get_header(); ?>

<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php if (have_posts()) :  ?>
			<?php get_template_part(THEME_SINGLE."page-title"); ?>
			<?php get_template_part(THEME_SINGLE."image");?>
			<?php the_content();?>
			<?php get_template_part(THEME_SINGLE."share"); ?>
	<?php else: ?>
			<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
	<?php endif; ?>
 <div class="archive-single">
 	<div class="article-list-block">
           <?php	query_posts(array('orderby' => 'rand', 'showposts' => 9));
		if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="item">
			<div class="item-header">
				<a href="<?php the_permalink();?>" class="image-hover">
					<figure>
					<?php echo get_the_post_thumbnail();?>
					</figure>
				</a>

			</div>
			<div class="item-content">
				<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					<span class="item-meta">
					<?php the_time(get_option('date_format'));?></span>	
				<?php 
					add_filter('excerpt_length', 'new_excerpt_length_40');	
					the_excerpt();
				?>
		<a href="<?php the_permalink();?>" class="read-more-link"><?php _e("Read More" , THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
			</div>
		</div>		
		<?php endwhile; endif; ?>
	</div>
</div>

<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>