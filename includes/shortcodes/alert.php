<?php
add_shortcode('alert', 'alert_handler');

function alert_handler($atts, $content=null, $code="") {
	extract(shortcode_atts(array('color' => null, 'icon' => null, 'title' => null), $atts) );
	
	if(isset($icon) && $icon!="Select a Icon" ) {
		$icon = '<i class="fa '.$icon.'"></i>';
	} else {
		$icon = false;
	}
		

	return '<div class="coloralert" style="background-color: #'.$color.';">
				'.$icon.'
				<p>'.$title.'<br>'.do_shortcode($content).'</p>
				<a href="#close-alert"><i class="fa fa-times-circle"></i></a>
			</div>';		


}

?>