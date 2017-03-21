<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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
						<div class="big-message">
							<div>
								<h3><?php _e("No Post Found",THEME_NAME);?></h3>
							</div>
							<p><?php _e("You must be lost or we just have lost this<br/>page You were looking for. Sorry about that.",THEME_NAME);?></p>
							<div class="msg-menu">
								<a href="<?php echo home_url();?>"><?php _e("Homepage",THEME_NAME);?></a>
								<?php if($contactUrl) { ?>
									<a href="<?php echo $contactUrl;?>"><?php _e("Contact Us",THEME_NAME);?></a>
								<?php }?>
							</div>
						</div>