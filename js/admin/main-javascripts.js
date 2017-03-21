/* Bottom aligned dynamic height footer */

jQuery(document).ready(function(){
	var mainfooterwrapper = jQuery('.main-footer-wrapper');
	jQuery('.main-content-wrapper').css({ paddingBottom: mainfooterwrapper.height() });
});


 
/* Input row description position */

jQuery(document).ready(function(){
	var labelwidth = jQuery('form label');
	jQuery('form > div .description').css({ marginLeft: labelwidth.width() + 13 });
});


/* Bottom aligned dynamic height footer */

jQuery(document).ready(function(){
	var contentheight = jQuery('.main-wrapper');
	jQuery('.sidebar').css({ height: contentheight.height() - 86 });
});

jQuery('ul li a.config_tab').click(function() {
	var id = jQuery(this).attr('href');
    var contentheight = jQuery(id);
	jQuery('.sidebar').css({ height: contentheight.height() - 46 });
 });
 
jQuery('ul li a.config_stab').click(function() {
	var id = jQuery(this).attr('href');
    var contentheight = jQuery(id);
	jQuery('.sidebar').css({ height: contentheight.height() + 86 });
 });
 
 
/* Uniform */

jQuery(function(){
	jQuery("input, textarea, select, button").uniform();
});
