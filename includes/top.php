<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$page_layout = get_option(THEME_NAME."_page_layout");

	$menuStyle = get_option(THEME_NAME."_menu_style");

	//logo settings
	$logo = get_option(THEME_NAME.'_logo');	




	//social icons
	$facebook = get_option(THEME_NAME."_facebook_url");
	$twitter = get_option(THEME_NAME."_twitter_url");
	$google = get_option(THEME_NAME."_google_url");
	$youtube = get_option(THEME_NAME."_youtube_url");
	//$vimeo = get_option(THEME_NAME."_vimeo_url");

	//search
	$search = get_option(THEME_NAME."_search");
	
	//post style
	$postStyle = get_option(THEME_NAME."_single_post_style");
	$postStyleSingle = get_post_meta( ot_page_id(), "_".THEME_NAME."_single_post_style_single", true );	
	
	//main slider
	$mainSlider = get_post_meta ( OT_page_id(), "_".THEME_NAME."_main_slider", true ); 

?>		
		<a href="#dat-menu" class="ot-menu-toggle"><i class="fa fa-bars"></i><?php _e("Menu", THEME_NAME);?></a>
		<!-- BEGIN .boxed -->
		<div class="boxed<?php echo $page_layout=="boxed" ? " active" : false; ?>">
			
			<!-- BEGIN .header -->
			<header class="header<?php if($menuStyle=="on") { ?> willfix<?php } ?>">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">

					<div class="header-left<?php if(!has_nav_menu('seccond-menu')) { ?> no-bottom<?php } ?><?php if(!$twitter && !$facebook && !$google && !$youtube && !$vimeo) { ?> no-socials<?php } ?>">
						<div class="header-logo">
							<?php if($logo) { ?>
								<a href="<?php echo home_url(); ?>" class="otanimation">
									<img src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
								</a>
							<?php } else { ?>
								<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
							<?php } ?>
							<strong data-anim-in="fadeOutUpBig" data-anim-out="bounceIn"><i class="fa fa-home"></i> <?php _e("Inicio", THEME_NAME) ?></strong>
						</div>
						<?php if($twitter || $facebook || $google || $youtube || $vimeo) { ?>
							<div class="header-socials">
								<?php if($facebook) { ?><a href="<?php echo $facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>
								<?php if($twitter) { ?><a href="<?php echo $twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
								<?php if($google) { ?><a href="<?php echo $google;?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php } ?>
								<?php if($youtube) { ?><a href="<?php echo $youtube;?>" target="_blank"><i class="fa fa-youtube"></i></a><?php } ?>
								<?php if($vimeo) { ?><a href="<?php echo $vimeo;?>" target="_blank"><i class="fa fa-vimeo-square"></i></a><?php } ?>
							</div>
						<?php } ?>
					</div>
						

					<div class="header-right<?php if(!has_nav_menu('seccond-menu')) { ?> no-bottom<?php } ?>">
						<nav class="main-menu">
							<?php	
				
								wp_reset_query();
								if ( function_exists( 'register_nav_menus' )) {
									$walker = new OT_Walker;

									$args = array(
										'container' => '',
										'theme_location' => 'main-menu',
										'items_wrap' => '<ul class="load-responsive %2$s" rel="'.__("Páginas", THEME_NAME).'">%3$s</ul>',
										'depth' =>  4,
										"echo" => false,
										'walker' => $walker
									);
												
												
									if(has_nav_menu('main-menu')) {
										echo wp_nav_menu($args);		
									} else {
										echo "<ul class=\"load-responsive\" rel=\"".__("Main Menu", THEME_NAME)."\"><li class=\"navi-none\"><a href=\"".admin_url("nav-menus.php") ."\">Please set up ".THEME_FULL_NAME." menu!</a></li></ul>";
									}		

								}
							?>

						
							<?php if($search=="on") { ?>
								<div class="search-header">
									<form method="get" action="<?php echo home_url(); ?>" name="searchform">
										<input type="search" value="" placeholder="<?php _e("Buscar..", THEME_NAME);?>" autocomplete="off" required="required" name="s" id="s" />
										<input type="submit" value="<?php _e("Search", THEME_NAME);?>" />
									</form>
								</div>
							<?php } ?>
						</nav>
						

						<?php
							if ( function_exists( 'register_nav_menus' )) {
								$walker = new OT_Walker_Top;
								$args = array(
									'container' => '',
									'theme_location' => 'seccond-menu',
									'items_wrap' => '<ul class="load-responsive" rel="'.__("Secciones", THEME_NAME).'">%3$s</ul>',
									'depth' => 3,
									"echo" => false,
									'walker' => $walker
								);
											
											
								if(has_nav_menu('seccond-menu')) {
						?>
							<nav class="under-menu">
								<?php	echo wp_nav_menu($args); ?>
							</nav>
						<?php
								}		

							}	

						?>

						
					</div>

					<div class="clear-float"></div>
					
				<!-- END .wrapper -->
				</div>
				
			<!-- END .header -->
			</header>
			<!-- Start Top Banner -->
<div class="wrapper" style="margin-bottom:20px;">

					<div style="width:100%;" class="bannerSup">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('banner') ) : ?>
						<?php endif; ?>
					</div>
</div>
<!-- END Top Banner -->
<div style="clear:both;"></div>

<?php wp_reset_query(); ?>