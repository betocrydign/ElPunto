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
    <!-- BEGIN .article-links-block -->
    <div class="article-links-block">
		<?php echo $code;?>
	</div>
</div>