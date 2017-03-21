<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $OT_builder = new OT_home_builder; 
    //get block data
    $data = $OT_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 

    if(function_exists('is_woocommerce')) {
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
        <div class="home-featured-shop-items woocommerce">
            <ul class="products">
                <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php 
                    $image = ot_image_html($my_query->post->ID,314,210); 
                    global $product;
                ?>
                    <li class="product">
                        <a href="<?php the_permalink();?>">
                            <?php if( $product && $product->is_on_sale()) { ?>
                                 <span class="onsale"><?php _e("Sale!", THEME_NAME);?></span>
                            <?php } ?>
                            <?php echo $image;?>
                            <h3><?php the_title();?></h3>
                            <?php
                                if( $product && $product->get_rating_html()) { 
                                    echo $product->get_rating_html();
                                } 
                            ?>
                            <?php if( $product && $product->get_price_html()) { ?>
                                <span class="price"><?php echo $product->get_price_html();?><span>
                            <?php } ?>
                        </a>
                        <?php  woocommerce_template_loop_add_to_cart(); ?>
                    </li>

                <?php endwhile; ?>
                <?php endif; ?>


            </ul>
        </div>
    <!-- END .home-block -->
    </div>

<?php } else { _e("<h2>Please set up woocommerce plugin</h2><br/>", THEME_NAME); } ?>