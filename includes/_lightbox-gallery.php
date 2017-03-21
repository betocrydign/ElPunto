<?php require_once( '../../../../wp-load.php' );?>

<a href="#" onclick="javascript:lightboxclose();" class="light-close"><i class="fa fa-times-circle-o"></i><?php _e("Close Window",THEME_NAME);?></a>
<div class="main-block">
	
	<div class="single-photo-gallery ot-slide-item gallery-full-photo">
		<span class="next-image" data-next="0"></span>
		<a href="javascript:void(0);" class="prev"></a>
		<a href="javascript:void(0);" class="next"></a>

		<div class="single-photo-main the-image loading waiter">

			<img class="image-big-gallery ot-gallery-image" data-id="0" style="display:none;" src="#" alt="" />
		</div>
		<div class="single-photo-thumbs">
			<div class="thumb-wrapper the-thumbs" data-total="" id="ot-lightbox-thumbs"></div>
		</div>
		<div class="single-photo-content">
			<div class="content-category">
				<a href="#" style="" id="ot-gal-cat"></a>
			</div>
			<h3 class="ot-light-title"></h3>
			<p id="ot-lightbox-content"></p>
		</div>
	</div>
</div>
