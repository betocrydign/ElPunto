<?php
global $orangeThemes_fields;
$orangeThemes_general_options= array(



/* ------------------------------------------------------------------------*
 * HOME SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "homepage_blocks",
	"title" => __("Homepage Blocks:", THEME_NAME),
	"id" => $orangeThemes_fields->themeslug."_homepage_blocks",
	"blocks" => array(
		array(
			"title" => __("Latest News Blocks", THEME_NAME),
			"type" => "homepage_news_block",
			"image" => "icon-article.png",
			"description" => __("3 posts in row",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_subtitle", "title" => __("Subtitle:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_cat",
					"taxonomy" => "category",
					"title" => __("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_color", 
					"title" => __("Block Title Border Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),

			),
		),
		array(
			"title" => __("Latest News Blocks", THEME_NAME),
			"type" => "homepage_news_block_6",
			"image" => "icon-article.png",
			"description" => __("Large image left",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_6_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_6_subtitle", "title" => __("Subtitle:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_6_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_6_cat",
					"taxonomy" => "category",
					"title" => __("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_6_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_6_color", 
					"title" => __("Block Title Border Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),

			),
		),
		array(
			"title" => __("Popular News", THEME_NAME),
			"type" => "homepage_news_block_2",
			"image" => "icon-article-popular.png",
			"description" => __("3 posts in row",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_2_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_2_subtitle", "title" => __("Subtitle:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_2_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_2_cat",
					"taxonomy" => "category",
					"title" => __("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_2_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_2_color", 
					"title" => __("Block Title Border Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),

			),
		),
		array(
			"title" => __("Popular News", THEME_NAME),
			"type" => "homepage_news_block_7",
			"image" => "icon-article-popular.png",
			"description" => __("Large image left",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_7_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_7_subtitle", "title" => __("Subtitle:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_7_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_7_cat",
					"taxonomy" => "category",
					"title" => __("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_7_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_7_color", 
					"title" => __("Block Title Border Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),

			),
		),
		array(
			"title" => __("Reviews", THEME_NAME),
			"type" => "homepage_news_block_8",
			"image" => "icon-review.png",
			"description" => __("Latest/Top reviews.",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_8_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_8_subtitle", "title" => __("Subtitle:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_8_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"title" => __("Set Category", THEME_NAME),
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_8_cat",
					"taxonomy" => "category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_8_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array(
					"type" => "select",
					"title" => __("Type:", THEME_NAME),
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_8_type",
					"options"=>array(
						array("slug"=>"latest", "name"=>__("Latest Reviews", THEME_NAME)), 
						array("slug"=>"top", "name"=>__("Top Reviews", THEME_NAME)), 
					),
					"home" => "yes"
				),				
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_8_color", 
					"title" => __("Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),	
		array(
			"title" => __("Latest Galleries", THEME_NAME),
			"type" => "homepage_news_block_3",
			"image" => "icon-photo.png",
			"description" => __("Latest Galleries Slider",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_3_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_3_subtitle", "title" => __("Subtitle:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_3_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_3_cat",
					"taxonomy" => OT_POST_GALLERY.'-cat',
					"title" => __("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_3_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_3_color", 
					"title" => __("Block Title Border Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),

			),
		),
		array(
			"title" => __("Category News", THEME_NAME),
			"type" => "homepage_news_block_4",
			"image" => "icon-article-cateogry.png",
			"description" => __("Latest News By Categories",THEME_NAME),
			"options" => array(
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_4_count", "title" => __("Post Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "multiple_select",
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_4_cat",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),

			),

		),
		array(
			"title" => __("Shop", THEME_NAME),
			"type" => "homepage_news_block_5",
			"image" => "icon-shop.png",
			"description" => __("Shop Items",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_5_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_5_subtitle", "title" => __("Subtitle:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_5_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_5_cat",
					"taxonomy" => "product_cat",
					"title" => __("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_homepage_news_block_5_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array(
					"type" => "select",
					"title" => __("Type:", THEME_NAME),
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_5_type",
					"options"=>array(
						array("slug"=>"1", "name"=>__("Latest", THEME_NAME)), 
						array("slug"=>"2", "name"=>__("Featured", THEME_NAME)), 
					),
					"home" => "yes"
				),						
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_homepage_news_block_5_color", 
					"title" => __("Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => "HTML Code",
			"type" => "homepage_html",
			"image" => "icon-html.png",
			"description" => __("Custom HTML/Shortcodes Block",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $orangeThemes_fields->themeslug."_homepage_html", "title" => __("HTML Code:",THEME_NAME), "home" => "yes" ),
			),
		),
		array(
			"title" => "Banner Block",
			"type" => "homepage_banner",
			"image" => "icon-banner.png",
			"description" => __("Supports HTML,CSS and Javascript.",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $orangeThemes_fields->themeslug."_homepage_banner", "title" => __("HTML Code:",THEME_NAME), "home" => "yes","sample" => '<a href="http://www.orange-themes.com" target="_blank"><img src="'.THEME_IMAGE_URL.'no-banner-728x90.jpg" alt="" title="" /></a>', ),
			),
		),

	)
),


 
 );


$orangeThemes_fields->add_options($orangeThemes_general_options);
?>