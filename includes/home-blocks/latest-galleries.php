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
                <a href="<?php echo $link;?>" class="right button" style="background: <?php echo $pageColor;?>; color: <?php echo $pageColor;?>;"><?php _e("View More Galleries", THEME_NAME);?></a>
                <h2><?php echo $title; ?></h2>
                <span><?php echo $subtitle; ?></span>
            </div>
        <?php } ?>


            <div class="home-featured-article">
                <?php $i=1; ?>
                <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <?php 
                        $src = get_post_thumb($post->ID,853,420); 
                    ?>
                    <a href="<?php the_permalink();?>" class="home-featured-item<?php if($i==1) { echo ' active'; } ?>">
                        <span class="feature-text">
                            <strong><?php the_title();?></strong>
                            <span>
                                <?php 
                                    add_filter('excerpt_length', 'new_excerpt_length_20');
                                    the_excerpt();
                                ?>
                            </span>
                        </span>
                        <img src="<?php echo $src["src"]; ?>" alt="<?php echo esc_attr(get_the_title());?>" />
                    </a>
                    <?php $i++; ?>
                <?php endwhile; ?>
                <?php endif; ?>

                <div class="home-featured-menu">
                    <?php $i=1; ?>
                    <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                        <a href="#"<?php if($i==1) { echo 'class="active"'; } ?>><?php echo $i;?></a>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>

            </div>
        <!-- END .home-block -->
        </div>
