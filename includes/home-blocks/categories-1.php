<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $OT_builder = new OT_home_builder; 
    //get block data
    $data = $OT_builder->get_data(); 
    //extract array data
    extract($data[0]); 
    //meta settings
    $postDate = get_option(THEME_NAME."_post_date_single");
?>
    <!-- BEGIN .home-block -->
    <div class="home-block">
        <!-- BEGIN .article-links-block -->
        <div class="article-links-block">
        <?php 
            if(!empty($cat)) {
                foreach($cat as $category) { 
        ?>
            <?php 
                //set wp query
                $args = array(
                    'post_type' => "post",
                    'cat' => $category,
                    'showposts' => $count,
                    'ignore_sticky_posts' => "1"
                );
                $my_query = new WP_Query($args);
            ?>
            <div class="item">
                <h3 style="color: <?php ot_title_color($category, 'category', true);?>; border-bottom: 3px solid <?php ot_title_color($category, 'category', true);?>;"><?php echo get_cat_name($category);?></h3>
                <?php if ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php 
                    $postDateSingle = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_post_date", true ); 
                ?>
                    <div class="post-item">
                        <?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
                            <span class="itemdate left"><?php the_time(get_option('date_format'));?></span>
                        <?php } ?>
                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

                        <div class="item-details">
                            <div class="item-head">
                                <a href="<?php the_permalink();?>" class="image-hover">
                                    <?php echo ot_image_html($my_query->post->ID,273,180); ?>
                                </a>
                            </div>
                            <div class="item-content">

                                <a href="<?php the_permalink();?>" class="read-more-link"><?php _e("Read More", THEME_NAME);?><i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <div class="clear-float"></div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php 
                    $postDateSingle = get_post_meta ( $my_query->post->ID, "_".THEME_NAME."_post_date", true ); 
                ?>
                    <div class="post-item">
                        <?php if(ot_option_compare($postDate,$postDateSingle)==true) { ?>
                            <span class="itemdate left"><?php the_time(get_option('date_format'));?></span>
                        <?php } ?>
                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
                <a href="<?php echo get_category_link($category);?>" class="archive-button" style="background-color: <?php ot_title_color($category, 'category', true);?>;"><?php _e("More Articles", THEME_NAME);?></a>
            </div>
            <?php } ?>
        <?php } ?>
        <!-- END .article-links-block -->
        </div>
    <!-- END .home-block -->
    </div>
