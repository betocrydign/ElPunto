<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $OT_builder = new OT_home_builder; 
    //get block data
    $data = $OT_builder->get_data(); 
    //extract array data
    extract($data[0]); 


   
?>

		<!-- BEGIN .home-block -->
		<div class="home-block">
			<div class="banner">
				<?php echo $code;?>
			</div>
		<!-- END .home-block -->
		</div>

