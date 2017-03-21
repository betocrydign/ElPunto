<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_query();

	if (is_pagetemplate_active("template-contact.php")) {
		$contactPages = ot_get_page("contact");
		if($contactPages[0]) {
			$contactUrl = get_page_link($contactPages[0]);
		}
	} else {
		$contactUrl = false;
	}
?>
			<!-- BEGIN .content -->
			<section class="content">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					


					<!-- <div class="main-content has-sidebar"> -->
					<!-- <div class="main-content has-double-sidebar"> -->
					<div class="main-content">

						<div class="big-message">
							<h2><?php _e("404",THEME_NAME);?></h2>
							<div>
								<h3><?php _e("Page Not Found",THEME_NAME);?></h3>
							</div>
							<p><?php _e("You must be lost or we just have lost this<br/>page You were looking for. Sorry about that.",THEME_NAME);?></p>
							<div class="msg-menu">
								<a href="<?php echo home_url();?>"><?php _e("Homepage",THEME_NAME);?></a>
								<?php if($contactUrl) { ?>
									<a href="<?php echo $contactUrl;?>"><?php _e("Contact Us",THEME_NAME);?></a>
								<?php }?>
							</div>
						</div>

					</div>
					
				<!-- END .wrapper -->
				</div>
				
			<!-- BEGIN .content -->
			</section>


<?php get_footer(); ?>