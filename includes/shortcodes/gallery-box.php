<?php
add_shortcode('ot-gallery', 'gallery_handler');
function gallery_handler($atts, $content=null, $code="") {
	if(isset($atts['url'])) {
		if(substr($atts['url'],-1) == '/') {
			$atts['url'] = substr($atts['url'],0,-1);
		}
		$vars = explode('/',$atts['url']);
		$slug = $vars[count($vars)-1];
		$page = get_page_by_path($slug,'OBJECT','gallery');
		if(is_object($page)) {
			$id = $page->ID;
			if(is_numeric($id)) {
				$gallery_style = get_post_meta ( $id, "_".THEME_NAME."_gallery_style", true );
				$galleryImages = get_post_meta ( $id, THEME_NAME."_gallery_images", true ); 
				$imageIDs = explode(",",$galleryImages);
				$count = count($imageIDs);
				if($gallery_style=="lightbox") { $classL = 'light-show '; } else { $classL = false; }

				$content.=	'<div class="gallery-shortcode">';
					$content.=	'<div class="gallery-shortcode-photos">';
	            		$counter=1;
	            		foreach($imageIDs as $imgID) { 
	            			if ($counter==8) break;
	            			if($imgID) {
		            			$file = wp_get_attachment_url($imgID);
		            			$image = get_post_thumb(false, 367, 263, false, $file);

								$content.=	'<a href="'.$atts['url'].'?page='.$counter.'" class="'.$classL.'image-hover" data-id="gallery-'.$id.'" data-path-hover="M 34,56 45,34 63,41 64,66 47,76 z">
												<figure>
													<img src="'.$image['src'].'" alt="'.esc_attr($page->post_title).'" title="'.esc_attr($page->post_title).'" data-id="'.$counter.'"/>
													<svg viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M 20,100 60,100 50,100 80,100 z" fill="#2E73BE" /></svg>
													<figcaption>
														<span class="hover-text"><i class="fa fa-search"></i></span>
													</figcaption>
												</figure>
											</a>';
								$counter++;
							}
						} 

						$content.=	'</div>'; 
						$content.=	'<div class="gallery-shortcode-content" style="background: #2E73BE;">
										<strong><a href="'.$atts['url'].'" class="'.$classL.'" data-id="gallery-'.$id.'">'.$page->post_title.'</a></strong>';
											
								if($page->post_excerpt) { 
									//$content.=	'<p>'.$page->post_excerpt.'</p>'; 
								} else {
									//$content.=	'<p>'.WordLimiter($page->post_content, 15).'</p>'; 
								}
						$content.=	'</div>'; 
					$content.=	'</div>'; 

							//$content.=	'<a href="'.$atts['url'].'" class="'.$classL.'" data-id="gallery-'.$id.'"><i class="fa fa-angle-double-left"></i> '.__("View gallery", THEME_NAME).'</a>'; 
							//$content.=	'<a href="'.$atts['url'].'" class="right"><i class="fa fa-camera"></i>'.OT_image_count($id).' '.__("Photos", THEME_NAME).'</a>'; 


			} else {
				$content.= "Incorrect URL attribute defined";
			}
		} else {
			$content.= "Incorrect URL attribute defined";
		}
		
	} else {
		$content.= "No url attribute defined!";
	
	}
	return $content;
}


?>