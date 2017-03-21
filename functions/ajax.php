<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* -------------------------------------------------------------------------*
 * 						CUSTOM FACEBOOK SHARE BUTTON						*
 * -------------------------------------------------------------------------*/
 
 
function OT_customFShare() {
	$link = $_POST['link'];
    $like_array = json_response('http://graph.facebook.com/fql?q=SELECT%20url,%20share_count%20FROM%20link_stat%20WHERE%20url="'. $link .'"');
    if($like_array!=false) {
		if(isset($like_array->data[0]->share_count)) {
			$like_count =  intval($like_array->data[0]->share_count);
		} else {
			$like_count = 0;
		}
		
		if(is_int($like_count)) {
			echo $like_count;
		} else {
			echo 0;
		}
	}
	die();
}

/* -------------------------------------------------------------------------*
 * 							UPDATE POST LIKE COUNT							*
 * -------------------------------------------------------------------------*/

function OT_setPostLike() {
	$postID = $_POST['post_ID'];
	if( isset($postID)) {
		$count_key = "_".THEME_NAME.'_post_likes_count';
		$count = get_post_meta($postID, $count_key, true);
		if (!isset($_SESSION[THEME_NAME."_post_likes_count_".$postID])) {
			if ( $count=='' ) {
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
			} else {
				$count++;
				update_post_meta($postID, $count_key, $count, $count-1);
			}
			$_SESSION[THEME_NAME."_post_likes_count_".$postID] = 1;
			echo "1";
		} else {
			$count--;
			update_post_meta($postID, $count_key, $count, $count+1);
			unset($_SESSION[THEME_NAME."_post_likes_count_".$postID]);
			echo "0";

		}

	}
	die();
}

/* -------------------------------------------------------------------------*
 * 							SLIDER ORDER									*
 * -------------------------------------------------------------------------*/
 
function update_slider() {
	$updateRecordsArray = $_POST['recordsArray'];
	
	if ( !get_option(THEME_NAME."-slide-order-set" ) ) {
		add_option(THEME_NAME."-slide-order-set", "1" );
	}
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		global $wpdb;

		$wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET menu_order = ".$listingCounter." WHERE ID = " . $recordIDValue  ) ); 

		$listingCounter = $listingCounter + 1;

	}

}

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE ORDER									*
 * -------------------------------------------------------------------------*/
 
function update_homepage() {
	$updateRecordsArray = $_POST['recordsArray'];
	$array = explode(',', $_POST['count']);
	$type = explode(',', $_POST['type']);
	$string = explode(',', $_POST['inputType']);
	$postID = explode(',', $_POST['post_id']);

	$strings = array();
	$array_count = sizeof($array);
	$e = 0;
	for($c = 0; $c < $array_count; $c++) {
		$items = array();
		for($i = 0; $i < $array[$c]; $i++) {
			array_push($items, $string[$e]);
			$e++;
		}
		
		if($array[$c] == 0) {
			$e++;
		}
		array_push($strings, $items);
		
		$items = "";
	}
	
	$homepage_layout = array();
	
	$a=0;
	
	if(!empty($updateRecordsArray)) {
		foreach($updateRecordsArray as $recordIDValue)  {
			$homepage_layout[$a]['type'] = $type[$a];
			$homepage_layout[$a]['inputType'] = $strings[$a];
			$homepage_layout[$a]['id'] = $recordIDValue;
			
			$a++;
		}
	}


	
	update_option(THEME_NAME."_homepage_layout_order_".$postID[0], $homepage_layout );

	die();

}
/* -------------------------------------------------------------------------*
 * 					HOMEPAGE SAVE DRAG&DROP OPTIONS							*
 * -------------------------------------------------------------------------*/
 
function ot_save_options() {
	$fields = $_REQUEST;
	if (current_user_can('edit_pages', get_current_user_id())) {
		foreach($fields as $key => $field) {
			if($key!="action") {
				update_option($key,$field);
			}
		}
	}


	die();

}

/* -------------------------------------------------------------------------*
 * 							SIDEBAR GENERATOR								*
 * -------------------------------------------------------------------------*/
 
function update_sidebar() {
	$updateRecordsArray = $_POST['recordsArray'];
	$last = array_pop($updateRecordsArray);
	$updateRecordsArray = implode ("|*|", $updateRecordsArray)."|*|".$last."|*|";
	update_option( THEME_NAME."_sidebar_names", $updateRecordsArray);
	echo $updateRecordsArray;
}
function delete_sidebar() {
	$sidebar_name = $_POST['sidebar_name']."|*|";
	$sidebar_names = get_option( THEME_NAME."_sidebar_names" );
	$sidebar_names = explode( "|*|", $sidebar_names );
	$sidebar_name = explode( "|*|", $sidebar_name );
	$result = array_diff($sidebar_names, $sidebar_name);
	$last = array_pop($result);
	$update_sidebar = implode ("|*|", $result)."|*|".$last."|*|";
	update_option( THEME_NAME."_sidebar_names", $update_sidebar);
	echo $update_sidebar;
}
function edit_sidebar() {
	$new_sidebar_name = sanitize_title($_POST['sidebar_name']);
	$old_name = $_POST['old_name'];

	$sidebar_names = get_option( THEME_NAME."_sidebar_names" );
	$sidebar_names = explode( "|*|", $sidebar_names );
	$new_sidebar_names=array();
	foreach ($sidebar_names as $sidebar_name) {
		if($sidebar_name!="") {
			if ($sidebar_name==$old_name) {
				$new_sidebar_names[]=$new_sidebar_name;
			} else {
				$new_sidebar_names[]=$sidebar_name;
			}
		}
	}
	$last = array_pop($new_sidebar_names);
	$update_sidebar = implode ("|*|", $new_sidebar_names)."|*|".$last."|*|";
	
	update_option( THEME_NAME."_sidebar_names", $update_sidebar);
	echo $update_sidebar;
}



/* -------------------------------------------------------------------------*
 * 							DYNAMIC CSS LOAD								*
 * -------------------------------------------------------------------------*/
 
function ot_dynamic_css() {
  	require_once(get_template_directory().'/css/dynamic-css.php');
  	require_once(get_template_directory().'/css/fonts.php');
  	die();
}
/* -------------------------------------------------------------------------*
 * 							DYNAMIC JS LOAD								*
 * -------------------------------------------------------------------------*/
 
function ot_dynamic_js() {
  	require_once(get_template_directory().'/js/scripts.php');
  	die();
}

/* -------------------------------------------------------------------------*
 * 						LOAD NEXT IMAGE IN GALLERY							*
 * -------------------------------------------------------------------------*/
 
function load_next_image(){
	$g = $_POST['gallery_id'];
	$next_image = $_POST['next_image'];

	$galleryImages = get_post_meta ($g, THEME_NAME."_gallery_images", true );  
	$imageIDs = explode(",",$galleryImages);


	$c=0;
	$images = array();
	
	foreach($imageIDs as $imgId) {
		if(isset($imgId)) {
			$file = wp_get_attachment_url($imgId);
			$image = get_post_thumb(false, 1140, 0, false, $file);
			$images[] = $image['src'];
			$c++;
		}
	}
						
	if(isset($images[$next_image-1])) {		
		echo $images[$next_image-1];
	}
	die();
}

/* -------------------------------------------------------------------------*
 * 							LIGHTBOX GALLERY								*
 * -------------------------------------------------------------------------*/
 
function OT_lightbox_gallery(){
	$g = $_POST['gallery_id'];
	$next_image = $_POST['next_image'];

	$galleryImages = get_post_meta ( $g, THEME_NAME."_gallery_images", true ); 
	$imageIDs = explode(",",$galleryImages);

	//get gallery category info
	$categories = get_the_terms($g, OT_POST_GALLERY.'-cat');
	$categoriesNew = array();
	$i=0;
	foreach ($categories as $category) {
		$categoriesNew[$i]['term_id'] = $category->term_id;
		$categoriesNew[$i]['name'] = $category->name;
		$i++;
	}
	$categories = $categoriesNew;
	$count = count($categories)-1;
	$randID = rand(0,$count);


	$c=0;
	$images = array();
	$thumbs = array();

	foreach($imageIDs as $id) {
		if($id) {
			$file = wp_get_attachment_url($id);
			$image = get_post_thumb(false, 1200, 0, false, $file);
			$images[] = $image['src'];
			$thumb = get_post_thumb(false, 84, 84, false, $file);
			$thumbs[$c] = $thumb['src'];
			$c++;
		}
	}

	$thispost = get_post( $g );
	$content = do_shortcode($thispost->post_content);
	
	$return = array();
	$return['next'] = $images[$next_image-1];
	$return['thumbs'] = $thumbs;
	$return['title'] = get_the_title($g);
	$return['content'] = $content;
	$return['total'] = $c;
	$return['cat'] = $categories[$randID]['name'];
	$return['term_id'] = $categories[$randID]['term_id'];
	$return['color'] = ot_title_color($categories[$randID]['term_id'], 'category', false);	
	$return['cat_url'] = get_term_link($categories[$randID]['term_id'], OT_POST_GALLERY.'-cat');


	echo json_encode($return);
	die();
}


/* -------------------------------------------------------------------------*
 * 									AWeber									*
 * -------------------------------------------------------------------------*/
 
function aweber_form() {
		
	$keys = get_option(THEME_NAME."_aweber_keys"); 
	if(isset($_POST["email"])){
		$email = is_email($_POST["email"]);
	}
	if(isset($_POST["u_name"])){
		$u_name = esc_textarea($_POST["u_name"]);
	}
	if(isset($_POST["listID"])){
		$listID = remove_html_slashes($_POST["listID"]);
	}
			
	$ip = $_SERVER['REMOTE_ADDR'];

	extract($keys);

	if($email && $u_name && $listID) {
				 

		try {
			$aweber = new AWeberAPI($consumer_key, $consumer_secret);
			$account = $aweber->getAccount($access_key, $access_secret);
			$account_id = $account->id;
			$listURL = "/accounts/{$account_id}/lists/{$listID}";
			$list = $account->loadFromUrl($listURL);
				
			# create a subscriber
			$params = array(
				'email' => $email,
				'ip_address' => $ip,
				'name' => $u_name,

			);
			$subscribers = $list->subscribers;
			$new_subscriber = $subscribers->create($params);
			

		} catch(AWeberAPIException $exc) {
			print 'Error: '.$exc->message.'';
			exit(1);
		}	
				
	}
	 
	die();

}


/* -------------------------------------------------------------------------*
 * 							FOOTER CONTACT FORM								*
 * -------------------------------------------------------------------------*/
 
function footer_contact_form() {

	if(isset($_POST["post_id"])){
		$mail_to = get_post_meta ( $_POST["post_id"],  "_".THEME_NAME."_contact_mail", true ); 
	}

	if(isset($_POST["email"]) && is_email($_POST["email"])){
		$email = is_email($_POST["email"]);
	}
	if(isset($_POST["u_name"])){
		$u_name = esc_textarea($_POST["u_name"]);
	}
	if(isset($_POST["message"])){
		$message = stripslashes(esc_textarea($_POST["message"]));
	}

	if(isset($_POST["url"])){
		$url = esc_textarea($_POST["url"]);
	}
	
	$ip = $_SERVER['REMOTE_ADDR'];

	
	if(isset($_POST["form_type"])) {	
		
		$subject = ( __( 'From' , THEME_NAME ))." ".get_bloginfo('name')." ".( __( 'Contact Page' , THEME_NAME ));
				
		$eol="\n";
		$mime_boundary=md5(time());
		$headers = "From: ".$email." <".$email.">".$eol;
		//$headers .= "Reply-To: ".$email."<".$email.">".$eol;
		$headers .= "Message-ID: <".time()."-".$email.">".$eol;
		$headers .= "X-Mailer: PHP v".phpversion().$eol;
		$headers .= 'MIME-Version: 1.0'.$eol;
		$headers .= "Content-Type: text/html; charset=UTF-8; boundary=\"".$mime_boundary."\"".$eol.$eol;

		ob_start(); 
		?>
<?php printf ( __( 'Message:' , THEME_NAME ));?> <?php echo nl2br($message);?>
<div style="padding-top:100px;">
<?php printf ( __( 'Name:' , THEME_NAME ));?> <?php echo $u_name;?><br/>
<?php printf ( __( 'Url:' , THEME_NAME ));?> <?php echo $url;?><br/>
<?php printf ( __( 'E-mail:' , THEME_NAME ));?> <?php echo $email;?><br/>
<?php printf ( __( 'IP Address:' , THEME_NAME ));?> <?php echo $ip;?><br/>
</div>
<?php
		$message = ob_get_clean();
		wp_mail($mail_to,$subject,$message,$headers);
			
	}
	 
	die();

}
add_action('wp_ajax_ot_dynamic_js', 'ot_dynamic_js');
add_action('wp_ajax_nopriv_ot_dynamic_js', 'ot_dynamic_js'); 

add_action('wp_ajax_ot_dynamic_css', 'ot_dynamic_css');
add_action('wp_ajax_nopriv_ot_dynamic_css', 'ot_dynamic_css'); 

add_action('wp_ajax_update_slider', 'update_slider');
add_action('wp_ajax_update_homepage', 'update_homepage');

add_action('wp_ajax_ot_save_options', 'ot_save_options');

add_action('wp_ajax_OT_setPostLike', 'OT_setPostLike');
add_action('wp_ajax_nopriv_OT_setPostLike', 'OT_setPostLike');


add_action('wp_ajax_update_sidebar', 'update_sidebar');
add_action('wp_ajax_delete_sidebar', 'delete_sidebar');
add_action('wp_ajax_edit_sidebar', 'edit_sidebar');
add_action('wp_ajax_load_next_image', 'load_next_image');
add_action('wp_ajax_nopriv_load_next_image', 'load_next_image');
add_action('wp_ajax_OT_lightbox_gallery', 'OT_lightbox_gallery');
add_action('wp_ajax_nopriv_OT_lightbox_gallery', 'OT_lightbox_gallery');
add_action('wp_ajax_OT_customFShare', 'OT_customFShare');
add_action('wp_ajax_nopriv_OT_customFShare', 'OT_customFShare');

add_action('wp_ajax_aweber_form', 'aweber_form');
add_action('wp_ajax_nopriv_aweber_form', 'aweber_form');
add_action('wp_ajax_nopriv_footer_contact_form', 'footer_contact_form');
add_action('wp_ajax_footer_contact_form', 'footer_contact_form');
?>