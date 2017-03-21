<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $OT_builder = new OT_home_builder; 
    //get block data
    $data = $OT_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 

    //meta settings
    $postDate = get_option(THEME_NAME."_post_date_single");

?>


    <!-- BEGIN .home-block -->
    <div class="home-block">
        <?php if($title) { ?>
            <div class="main-title" style="border-left: 4px solid <?php echo $pageColor;?>">
                <h2><?php echo $title; ?></h2>
                <span><?php echo $subtitle; ?></span>
            </div>
        <?php } ?>

        <!-- BEGIN .article-review-block -->
        <div class="article-review-block">
            <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php

                    $averageRating = ot_avarage_rating($my_query->post->ID);
                    $image = get_post_thumb($my_query->post->ID,271,400,THEME_NAME.'_reviews_image'); 

                    $postDateSingle = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_post_date", true ); 


                ?>
                <div class="item">
                    <a href="<?php the_permalink();?>">
                        <span>
                            <?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
                                <small><?php the_time(get_option('date_format'));?></small>
                            <?php } ?>
                            <?php if($averageRating!=false) { ?>
                                <span class="star-rating" title="<?php _e("Rated", THEME_NAME);?> <?php echo $averageRating[1];?> <?php _e("out of 5 stars", THEME_NAME);?>">
                                    <span style="width:<?php echo $averageRating[0];?>%">
                                        <strong class="rating"><?php echo $averageRating[1];?></strong> <?php _e("out of 5 stars", THEME_NAME);?>
                                    </span>
                                </span>
                            <?php } ?>
                            <span><?php the_title();?></span>
                        </span>
                        <img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>" />
                    </a>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>

        <!-- END .article-review-block -->
        </div>

    <!-- END .home-block -->
    </div>
