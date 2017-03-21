<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $OT_builder = new OT_home_builder; 
    //get block data
    $data = $OT_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 

  

?>
<!-- BEGIN .home-block -->
    <div class="home-block">
        <?php if($title) { ?>
            <div class="main-title" style="border-left: 4px solid <?php echo $pageColor;?>">
                <?php if($link) { ?>
                    <a href="<?php echo $link;?>" class="right button"  style="background: <?php echo $pageColor;?>; color: <?php echo $pageColor;?>;"><?php _e("View More Posts", THEME_NAME);?></a>
                <?php } ?>
                <h2><?php echo $title; ?></h2>
                <span><?php echo $subtitle; ?></span>
            </div>
        <?php } ?>
        <!-- BEGIN .article-list-block -->
        <div class="article-list-block">
            <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php
                    //post details
                    $postCategory = get_option(THEME_NAME."_post_category_single");
                    $postCategorySingle = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_post_category", true ); 

                    $categories = get_the_category($my_query->post->ID);

                    $averageRating = ot_avarage_rating($my_query->post->ID);
                    $image = get_post_thumb($my_query->post->ID,381,260); 

                    $video = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_video_code", true ); 

                    //image icons
                    $icon = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_image_icon", true ); 
                    $iconText = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_image_text", true ); 

                    //get all post categories
                    $categories = get_the_category($my_query->post->ID);
                    $catCount = count($categories);
                    //select a random category id
                    $id = rand(0,$catCount-1);
                    //cat id
                    if(isset($categories[$id]->term_id)) {
                        $catId = $categories[$id]->term_id;     
                    }
                ?>
                <div class="item">
                    <div class="item-header">
                        <a href="<?php the_permalink();?>" class="image-hover"<?php if( $icon != false && $icon!="Select a Icon") { ?> data-path-hover="M 37,53 45,34 58.5,37.5 61,59 48.5,69 z"<?php } ?>>
                            <figure>
                                <img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>" />
                                <?php if( $icon != false && $icon != "Select a Icon") { ?>
                                    <svg viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M 0,100 0,99 50,97 100,99 100,100 z" fill="<?php ot_title_color($catId, 'category', true);?>" /></svg>
                                    <figcaption>
                                        <span class="hover-text"><i class="fa <?php echo $icon;?>"></i><span><?php echo $iconText;?></span></span>
                                    </figcaption>
                                <?php } ?>
                            </figure>
                        </a>
                    </div>
                    <div class="item-content">
                        <?php if(ot_option_compare($postCategory,$postCategorySingle)==true && !empty($categories)) { ?>
                            <div class="content-category">
                                <?php foreach($categories as $cat) { ?>
                                    <a href="<?php echo get_category_link($cat->term_id);?>" style="color: <?php ot_title_color($cat->term_id, 'category', true);?>;"><?php echo get_cat_name($cat->term_id);?></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <?php if($averageRating!=false) { ?>
                            <div class="ot-star-rating">
                                <span style="width: <?php echo $averageRating[0];?>%;" class=""><strong class="rating"><?php echo $averageRating[1];?></strong> <?php _e("out of 5", THEME_NAME);?></span>
                                <strong><?php _e("Rating:", THEME_NAME);?> <?php echo $averageRating[1];?> <?php _e("out of 5 stars", THEME_NAME);?></strong>
                            </div>
                        <?php } ?>
                        <?php 
                            add_filter('excerpt_length', 'new_excerpt_length_20'); 
                            the_excerpt();
                        ?>
                        <a href="<?php the_permalink();?>" class="read-more-link"><?php _e("Read More", THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>

                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        <!-- END .article-list-block -->
        </div>
    <!-- END .home-block -->
    </div>