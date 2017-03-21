<?php
	add_shortcode('ot-link', 'ot_link');

	function ot_link($atts, $content=null, $code="") {

		return '<a href="'.$atts['url'].'" class="ot-link" target="_blank">'.$content.'</a>';
	
	}
?>