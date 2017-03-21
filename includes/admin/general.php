<?php
global $orange_themes_managment;
$orangeThemes_general_options= array(
 array(
	"type" => "navigation",
	"name" => "General",
	"slug" => "general"
),

array(
	"type" => "tab",
	"slug"=>'general'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"page", "name"=>__("General", THEME_NAME)), 
		array("slug"=>"blog", "name"=>__("Blog", THEME_NAME)),
		array("slug"=>"gallery", "name"=>__("Gallery/Portfolio", THEME_NAME)),
		array("slug"=>"contact", "name"=>__("Contact/Footer", THEME_NAME)),
		array("slug"=>"banner_settings", "name"=>__("Banners", THEME_NAME))
	)
),

/* ------------------------------------------------------------------------*
 * PAGE SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=>'page'
),

array(
	"type" => "homepage_set_test",
	"title" => "Set up Your Homepage and post page!",
	"desc" => "	<p><b>You have not selected the correct template page for homepage.</b></p>
	<p>Please make sure, you choose template \"Drag & Drop Page Builder\".</p>
	<br/>
	<ul>
		<li>Current front page: <a href='".get_permalink(get_option('page_on_front'))."'>".get_the_title(get_option('page_on_front'))."</a></li>
		<li>Current blog page: <a href'".get_permalink(get_option('page_for_posts'))."'>".get_the_title(get_option('page_for_posts'))."</a></li>
	</ul>",
	"desc_2" => "<p><b>You have NOT enabled homepage.</b></p>
	<p>To use custom homepage, you must first create two <a href='".home_url()."/wp-admin/post-new.php?post_type=page'>new pages</a>, and one of them assign to \"<b>Homepage</b>\" template.Give each page a title, but avoid adding any text.</p>
	<p>Then enable homepage  in <a href='".home_url()."/wp-admin/options-reading.php'>wordpress reading settings</a> (See \"Front page displays\" option). Select your previously created pages from both dropdowns and save changes.</p>"
),
   
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Add logo image", THEME_NAME)
),
   
array(
	"type" => "upload",
	"title" => __("Add Header Logo Image", THEME_NAME),
	"info" => __("Suggested image size is 467x60px", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_logo",
),      

array(
	"type" => "close"
),
 array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Export/Import Theme Settings", THEME_NAME)
),
   
array(
	"type" => "export_content",
	"title" => __("Export Settings", THEME_NAME),
	"section" => "management",
	"id" => $orange_themes_managment->themeslug."_export"
),      
   
array(
	"type" => "import_content",
	"title" => __("Import Settings", THEME_NAME),
	"section" => "management",
	"id" => $orange_themes_managment->themeslug."_import"
),      

array(
	"type" => "close"
),  
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Favicon"
),
   
array(
	"type" => "upload",
	"title" => "Favicon",
	"info" => "Favicons are the small 16 pixel by 16 pixel pictures you see beside some URLs in your browser's address bar.",
	"id" => $orange_themes_managment->themeslug."_favicon"
),   

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Unit Settings", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => __("Show Search In Menu:", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_search"
),
   

array(
	"type" => "close"
),


array(
	"type" => "save",
	"title" => "Save Changes"
),
   
array(
	"type" => "closesubtab"
),

/* ------------------------------------------------------------------------*
 * BLOG SETTINGS
 * ------------------------------------------------------------------------*/   
  
array(
	"type" => "sub_tab",
	"slug"=>'blog'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Blog Page Title in Singel News")
),

array(
	"type" => "checkbox",
	"title" => __("Show"),
	"id"=>$orange_themes_managment->themeslug."_singlePostBlogTitle"
),


array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Unit Settings"
),

array(
	"type" => "checkbox",
	"title" => "Show thumbnails in blog post list:",
	"id"=>$orange_themes_managment->themeslug."_show_first_thumb"
),

array(
	"type" => "checkbox",
	"title" => "Show \"no image\" thumbnail, when no thumbnail is available:",
	"id"=>$orange_themes_managment->themeslug."_show_no_image_thumb"
),
array(
	"type" => "close"
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Show thumbnail in open post/page", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_show_single_thumb",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Show Post Author In Single Post", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_post_author_single",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Show Post Date In Single Post", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_post_date_single",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Show Post Categories In Single Post", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_post_category_single",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Show \"About Author\" In Single Post", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_about_author",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Show \"Similar News\" In Single Post", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_similar_posts",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),



array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Show Share Buttons", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_share_all",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Post/Page:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Show Post Comment Count", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_post_comments_single",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "save",
	"title" => __("Save Changes", THEME_NAME)
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * CONTACT SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "sub_tab",
	"slug"=>'contact'
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Twitter Account", THEME_NAME)
),

array(
	"type" => "input",
	"title" => __("Twitter Account Name:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_twitter_name"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Contact Information", THEME_NAME),
),

array(
	"type" => "input",
	"title" => __("Facebook Account URL:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_facebook_url"
),

array(
	"type" => "input",
	"title" => __("Twitter Account URL:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_twitter_url"
),
array(
	"type" => "input",
	"title" => __("Google+ Account URL:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_google_url"
),
array(
	"type" => "input",
	"title" => __("Youtube Account URL:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_youtube_url"
),
array(
	"type" => "input",
	"title" => __("Vimeo Account URL:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_vimeo_url"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Footer CopyRight", THEME_NAME),
),

array(
	"type" => "textarea",
	"title" => __("Text:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_copyright"
),

array(
	"type" => "close"
),


array(
	"type" => "save",
	"title" => __("Save Changes", THEME_NAME),
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * GALLERY SETTINGS
 * ------------------------------------------------------------------------*/   
array(
	"type" => "sub_tab",
	"slug"=>'gallery'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title"=> __('Gallery Settings', THEME_NAME)
),

array(
	"type" => "input",
	"title" => __("Items per gallery page:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_gallery_items",
	"number" => "yes",
	"std" => "6"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title"=> __('Portfolio Settings', THEME_NAME)
),

array(
	"type" => "input",
	"title" => __("Items per gallery page:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_portfolio_items",
	"number" => "yes",
	"std" => "6"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Show \"Similar Posts\" In Single Galley", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_similar_posts_gallery",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Gallery Page:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Show \"Similar Posts\" In Single Portfolio", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_similar_posts_portfolio",
	"radio" => array(
		array("title" => __("Show:", THEME_NAME), "value" => "show"),
		array("title" => __("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom For Each Portfolio Page:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),


array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * BANNER SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "sub_tab",
	"slug"=>'banner_settings'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Blog Page Banner", THEME_NAME)
),

array(
	"type" => "checkbox",
	"title" => __("Enable Banner", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_blog_banner",
	"std" => "off"
),

array(
	"type" => "textarea",
	"title" => __("Banner HTML Code", THEME_NAME),
	"sample" => '<a href="http://www.orange-themes.com" target="_blank"><img src="'.THEME_IMAGE_URL.'no-banner-468x60.jpg" alt="" title="" /></a>',
	"id" => $orange_themes_managment->themeslug."_blog_banner_code",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_blog_banner", "value" => "on")
	)
),
array(
	"type" => "select",
	"title" => __("Show banner after", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_blog_banner_count",
	"options"=>array(
		array("slug"=>"0", "name"=>"0 Posts"), 
		array("slug"=>"1", "name"=>"1 Post"),
		array("slug"=>"2", "name"=>"2 Posts"),
		array("slug"=>"2", "name"=>"3 Posts"),
		array("slug"=>"4", "name"=>"4 Posts"),
		array("slug"=>"5", "name"=>"5 Posts"),
		array("slug"=>"7", "name"=>"7 Posts"),
		array("slug"=>"8", "name"=>"8 Posts"),
		array("slug"=>"9", "name"=>"9 Posts"),
		array("slug"=>"10", "name"=>"10 Posts"),
		),
	"std" => "1",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_blog_banner", "value" => "on")
	)
),
array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Default Single Post Banner", THEME_NAME)
),

array(
	"type" => "checkbox",
	"title" => __("Enable Banner", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_post_banner",
	"std" => "off"
),

array(
	"type" => "textarea",
	"title" => __("Banner HTML Code", THEME_NAME),
	"sample" => '<a href="http://www.orange-themes.com" target="_blank"><img src="'.THEME_IMAGE_URL.'no-banner-728x90.jpg" alt="" title="" /></a>',
	"id" => $orange_themes_managment->themeslug."_post_banner_code",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_post_banner", "value" => "on")
	)
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Select Pop Up Banner Type"
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_banner_type",
	"radio" => array(
		array("title" => "Off", "value" => "off"),
		array("title" => "Banner With Image", "value" => "image"),
		array("title" => "Banner With Text Or HTML Code", "value" => "text"),
		array("title" => "Banner With Image &amp; Text", "value" => "text_image")
	),
	"std" => "off"
),

array(
	"type" => "upload",
	"title" => "Add Banner Image",
	"id" => $orange_themes_managment->themeslug."_banner_image",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_banner_type", "value" => "image")
	)
),

array(
	"type" => "textarea",
	"title" => "Banner content",
	"info" => "You can copy also some HTML code here.",
	"id" => $orange_themes_managment->themeslug."_banner_text",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_banner_type", "value" => "text")
	)
),

array(
	"type" => "upload",
	"title" => "Add Banner Image",
	"id" => $orange_themes_managment->themeslug."_banner_text_image_img",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_banner_type", "value" => "text_image")
	)
),

array(
	"type" => "textarea",
	"title" => "Banner text",
	"info" => "You add only text.",
	"id" => $orange_themes_managment->themeslug."_banner_text_image_txt",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_banner_type", "value" => "text_image")
	)
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Banner Settings",
),

array(
	"type" => "select",
	"title" => "Start Time",
	"id" => $orange_themes_managment->themeslug."_banner_start",
	"options"=>array(
		array("slug"=>"0", "name"=>"0 Secconds"), 
		array("slug"=>"5", "name"=>"5 Secconds"),
		array("slug"=>"10", "name"=>"10 Secconds"),
		array("slug"=>"15", "name"=>"15 Secconds"),
		array("slug"=>"20", "name"=>"20 Secconds"),
		array("slug"=>"25", "name"=>"25 Secconds"),
		array("slug"=>"30", "name"=>"30 Secconds"),
		array("slug"=>"60", "name"=>"1 Minute"),
		array("slug"=>"120", "name"=>"2 Minute"),
		array("slug"=>"180", "name"=>"3 Minute"),

		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Close Time",
	"id" => $orange_themes_managment->themeslug."_banner_close",
	"options"=>array(
		array("slug"=>"0", "name"=>"Off"), 
		array("slug"=>"5", "name"=>"5 Secconds"),
		array("slug"=>"10", "name"=>"10 Secconds"),
		array("slug"=>"15", "name"=>"15 Secconds"),
		array("slug"=>"20", "name"=>"20 Secconds"),
		array("slug"=>"25", "name"=>"25 Secconds"),
		array("slug"=>"30", "name"=>"30 Secconds"),
		array("slug"=>"60", "name"=>"1 Minute"),
		array("slug"=>"120", "name"=>"2 Minute"),
		array("slug"=>"180", "name"=>"3 Minute"),

		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Fly In From",
	"id" => $orange_themes_managment->themeslug."_banner_fly_in",
	"options"=>array(
		array("slug"=>"off", "name"=>"Off"), 
		array("slug"=>"top", "name"=>"Top"),
		array("slug"=>"top-left", "name"=>"Top Left"),
		array("slug"=>"top-right", "name"=>"Top Right"),
		array("slug"=>"left", "name"=>"Left"),
		array("slug"=>"bottom", "name"=>"Bottom"),
		array("slug"=>"bottom-left", "name"=>"Bottom Left"),
		array("slug"=>"bottom-right", "name"=>"Bottom Right"),
		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Fly Out To",
	"id" => $orange_themes_managment->themeslug."_banner_fly_out",
	"options"=>array(
		array("slug"=>"off", "name"=>"Off"), 
		array("slug"=>"top", "name"=>"Top"),
		array("slug"=>"top-left", "name"=>"Top Left"),
		array("slug"=>"top-right", "name"=>"Top Right"),
		array("slug"=>"left", "name"=>"Left"),
		array("slug"=>"bottom", "name"=>"Bottom"),
		array("slug"=>"bottom-left", "name"=>"Bottom Left"),
		array("slug"=>"bottom-right", "name"=>"Bottom Right"),
		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Show Banner after",
	"info" => "How many times site may be viewed until the popup will be shown again",
	"id" => $orange_themes_managment->themeslug."_banner_views",
	"options"=>array(
		array("slug"=>"0", "name"=>"0 Click"), 
		array("slug"=>"1", "name"=>"1 Click"),
		array("slug"=>"2", "name"=>"2 Clicks"),
		array("slug"=>"2", "name"=>"3 Clicks"),
		array("slug"=>"4", "name"=>"4 Clicks"),
		array("slug"=>"5", "name"=>"5 Clicks"),
		array("slug"=>"10", "name"=>"10 Clicks"),
		array("slug"=>"20", "name"=>"20 Clicks"),
		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "How offen show the banner",
	"id" => $orange_themes_managment->themeslug."_banner_timeout",
	"options"=>array(
		array("slug"=>"0", "name"=>"One time per visit"), 
		array("slug"=>"1", "name"=>"Once a day"), 
		array("slug"=>"2", "name"=>"Once in 2 days"),
		array("slug"=>"3", "name"=>"Once in 3 days"),
		),
	"std" => "off"
),

array(
	"type" => "checkbox",
	"title" => "Enable Background Overlay:",
	"id" => $orange_themes_managment->themeslug."_banner_overlay",
	"std" => "off"
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
 );


$orange_themes_managment->add_options($orangeThemes_general_options);
?>