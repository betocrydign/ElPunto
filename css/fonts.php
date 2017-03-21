<?php

	//fonts
	$google_font_1 = get_option(THEME_NAME."_google_font_1");
	$google_font_2 = get_option(THEME_NAME."_google_font_2");
	$google_font_3 = get_option(THEME_NAME."_google_font_3");
	$font_size_1 = get_option(THEME_NAME."_font_size_1");

?>


/* Main Font Family */
body {
	font-family: "<?php echo $google_font_1;?>", sans-serif;
}

/* Main Font Size */
body {
	font-size: <?php echo $font_size_1;?>px;
}

/* Titles font */
.widget .list-group,
.ot-slider .ot-slider-layer strong,
h1, h2, h3,
h4, h5, h6 {
	font-family: '<?php echo $google_font_2;?>', sans-serif;
}

/* Article titles font */
.woocommerce .products .product h3,
.breaking-news a.break-category,
.breaking-news .breaking-block h4,
.photo-gallery-widget h4,
.comments-block .item-content h4,
.widget .article-block .content-category,
.widget .article-block h4,
.small-sidebar .widget .article-block .item h4,
.single-photo-gallery .single-photo-content h3,
.single-photo-gallery .single-photo-content .content-category,
.photo-galleries .item .item-content h3,
.photo-galleries .item .item-content .content-category,
ol#comments .comment-text .user-nick,
.category-default-block .item .item-content h3,
.category-default-block .item-main .item-content h3,
.category-default-block .item-main .item-content .content-category,
.article-links-block .item .post-item h3,
.article-list-block .item .item-content .content-category,
.article-list-block .item .item-content h3,
.similar-articles-list .similar-articles .item h4,
.article-list .item .item-content h3,
.article-list .item .item-content .content-category,
.home-featured-article .home-featured-item .feature-text strong {
	font-family: '<?php echo $google_font_3;?>', sans-serif;
}