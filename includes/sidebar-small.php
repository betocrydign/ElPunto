<?php
	wp_reset_query();

	$sidebar = get_post_meta( OT_page_ID(), "_".THEME_NAME.'_sidebar_select_2', true );
	$sidebarPosition = get_post_meta( OT_page_ID(), "_".THEME_NAME.'_sidebar_position_2', true );


	if(is_category()) {
		$sidebar = ot_get_option( get_cat_id( single_cat_title("",false) ), 'sidebar_select_2', false );
	} elseif(is_tax()){
		$sidebar = ot_get_option( get_queried_object()->term_id, 'sidebar_select_2', false );
	}
	/*
	if($sidebar=='' && function_exists('is_woocommerce') && is_woocommerce()) {
		$sidebar = 'ot_woocommerce';
	}
	if($sidebar=='' && function_exists("is_bbpress") && is_bbpress()) {
		$sidebar = 'ot_bbpress';
	}

	if($sidebar=='' && function_exists("is_buddypress") && is_buddypress()) {
		$sidebar = 'ot_buddypress';
	}
	*/

	if ( $sidebar=='' || is_search()) {
		$sidebar='default';
	}	

	//default main sidebar position
	$defPosition_2 = get_option(THEME_NAME."_sidebar_position_2");
	if (($sidebarPosition == '' && $defPosition_2 != "custom") || ($sidebarPosition != '' && $defPosition_2 != "custom")) {
		$sidebarPosition = $defPosition_2;
	} else if ((!$sidebarPosition && $defPosition_2 == "custom") || ($sidebarPosition == '' && $defPosition_2 == "custom")) {
		$sidebarPosition = "right";
	}

	if($sidebar!="off") {
?>
	
	<!-- BEGIN .small-sidebar -->
	<div class="small-sidebar <?php echo $sidebarPosition;?>">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
		<?php endif; ?>
	<!-- END .small-sidebar -->
	</div>
<?php }  ?>
<?php wp_reset_query();  ?>