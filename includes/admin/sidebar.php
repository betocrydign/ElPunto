<?php
global $orange_themes_managment;
$orangeThemes_sidebar_options= array(
 array(
	"type" => "navigation",
	"name" => "Sidebar Settings",
	"slug" => "sidebars"
),

array(
	"type" => "tab",
	"slug"=>'sidebar_settings'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
			array("slug"=>"sidebar", "name"=>__("Sidebar", THEME_NAME))
		)
),

/* ------------------------------------------------------------------------*
 * SIDEBAR GENERATOR
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=>'sidebar'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Main Sidebar Position", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_sidebar_position",
	"radio" => array(
		array("title" => __("Left:", THEME_NAME), "value" => "left"),
		array("title" => __("Right:", THEME_NAME), "value" => "right"),
		array("title" => __("Custom For Each Page:", THEME_NAME), "value" => "custom")
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
	"title" => __("Second Sidebar Position", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_sidebar_position_2",
	"radio" => array(
		array("title" => __("Left:", THEME_NAME), "value" => "left"),
		array("title" => __("Right:", THEME_NAME), "value" => "right"),
		array("title" => __("Custom For Each Page:", THEME_NAME), "value" => "custom")
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
	"title" => __("Show The Sticky Sidebar Under Main Sidebar", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => __("Show:", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_sticky_sidebar"
),
   

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Add Sidebar", THEME_NAME),
),

array(
	"type" => "add_text",
	"title" => __("Add New Sidebar:", THEME_NAME),
	"id" => THEME_NAME."_sidebar_name"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => __("Sidebar Sequence", THEME_NAME),
	"info" => __("To sort the slides just drag and drop them!", THEME_NAME)
),

array(
	"type" => "sidebar_order",
	"title" => __("Order Sidebars", THEME_NAME),
	"id" => THEME_NAME."_sidebar_name"
),
  
array(
	"type" => "close"
),
 
array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
);

$orange_themes_managment->add_options($orangeThemes_sidebar_options);
?>