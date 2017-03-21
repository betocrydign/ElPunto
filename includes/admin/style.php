<?php
global $orange_themes_managment;
$orangeThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => __("Style Settings", THEME_NAME),
	"slug" => "custom-styling"
),

array(
	"type" => "tab",
	"slug"=>'custom-styling'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"font_style", "name"=>__("Font Style", THEME_NAME)),
		array("slug"=>"page_colors", "name"=>__("Page Colors/Style", THEME_NAME)),
		array("slug"=>"page_layout", "name"=>__("Layout", THEME_NAME))
		)
),

/* ------------------------------------------------------------------------*
 * PAGE FONT SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'font_style'
),

array(
	"type" => "row"
),

array(
	"type" => "google_font_select",
	"title" => __("Main font family:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_google_font_1",
	"sort" => "alpha",
	"info" => __("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>", THEME_NAME),
	"default_font" => array('font' => "Open Sans", 'txt' => "(default)")
),
array(
	"type" => "google_font_select",
	"title" => __("Titles font family:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_google_font_2",
	"sort" => "alpha",
	"info" => __("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>", THEME_NAME),
	"default_font" => array('font' => "Montserrat", 'txt' => "(default)")
),
array(
	"type" => "google_font_select",
	"title" => __("Article titles font family:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_google_font_3",
	"sort" => "alpha",
	"info" => __("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>", THEME_NAME),
	"default_font" => array('font' => "PT Sans Narrow", 'txt' => "(default)")
),

array(
	"type" => "scroller",
	"title" =>__("Main font size:", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_font_size_1",
	"max" => "30",
	"info" => __("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>", THEME_NAME),
),


array(
	"type" => "close"

),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Font Character Sets", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => __("Cyrillic Extended (cyrillic-ext):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_cyrillic_ex"
),
array(
	"type" => "checkbox",
	"title" => __("Cyrillic (cyrillic):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_cyrillic"
),
array(
	"type" => "checkbox",
	"title" => __("Greek Extended (greek-ext):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_greek_ex"
),
array(
	"type" => "checkbox",
	"title" => __("Greek (greek):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_greek"
),
array(
	"type" => "checkbox",
	"title" => __("Vietnamese (vietnamese):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_vietnamese"
),
array(
	"type" => "checkbox",
	"title" => __("Latin Extended (latin-ext):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_latin_ex"
),
array(
	"type" => "close",

),
array(
	"type" => "save",
	"title" => "Save Changes"
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE COLORS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_colors'
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Default Category/News page Color", THEME_NAME)
),

array( 
	"type" => "color", 
	"id" => $orange_themes_managment->themeslug."_default_cat_color", 
	"title" => __("Color:", THEME_NAME),
	"std" => "373737",
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Main color scheme", THEME_NAME)
),

array( 
	"type" => "color", 
	"id" => $orange_themes_managment->themeslug."_color_1", 
	"title" => __("Color:", THEME_NAME),
	"std" => "e14420",
),



array(
	"type" => "close"
),


array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => __("Body Backgrounds (only boxed view)",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_body_bg_type",
	"radio" => array(
		array("title" => __("Pattern:",THEME_NAME), "value" => "pattern"),
		array("title" => __("Custom Image:",THEME_NAME), "value" => "image"),
		array("title" => __("Color:",THEME_NAME), "value" => "color"),
	),
	"std" => "pattern"
),

array(
	"type" => "select",
	"title" => "Patterns ",
	"id" => $orange_themes_managment->themeslug."_body_pattern",
	"options"=>array(
		array("slug"=>"texture-1", "name"=>__("Texture 1",THEME_NAME)), 
		array("slug"=>"texture-2", "name"=>__("Texture 2",THEME_NAME)), 
		array("slug"=>"texture-3", "name"=>__("Texture 3",THEME_NAME)), 
		array("slug"=>"texture-4", "name"=>__("Texture 4",THEME_NAME)), 
		array("slug"=>"texture-5", "name"=>__("Texture 5",THEME_NAME)), 
		array("slug"=>"texture-6", "name"=>__("Texture 6",THEME_NAME)), 
	),
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_body_bg_type", "value" => "pattern")
	)
),

array(
	"type" => "color",
	"title" => __("Body Background Color:",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_body_color",
	"std" => "f1f1f1",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_body_bg_type", "value" => "color")
	)
),

array(
	"type" => "upload",
	"title" => __("Body Background Image:",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_body_image",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),

array(
	"type" => "close",

),

array(
	"type" => "save",
	"title" => __("Save Changes", THEME_NAME),
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE LAYOUT
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_layout'
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Enable Responsive", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => __("Enable", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_responsive"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Fixed Menu", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => __("Enable", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_menu_style"
),

array(
	"type" => "close"
),


array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Page Layout", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_page_layout",
	"radio" => array(
		array("title" => __("Boxed:", THEME_NAME), "value" => "boxed"),
		array("title" => __("Wide:", THEME_NAME), "value" => "wide"),
	),
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => __("Blog Post Images/Video/Audio Size", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_post_style",
	"radio" => array(
		array("title" => __("Large Images:", THEME_NAME), "value" => "show"),
		array("title" => __("Small Images:", THEME_NAME), "value" => "hide"),
		array("title" => __("Custom in Each Post:", THEME_NAME), "value" => "custom"),
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

array(
	"type" => "closetab"
)
 
);

$orange_themes_managment->add_options($orangeThemes_slider_options);
?>