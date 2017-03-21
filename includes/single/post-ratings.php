<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	//ratings
	$ratings = get_post_meta( $post->ID, "_".THEME_NAME."_ratings", true );
	$overall = get_post_meta( $post->ID, "_".THEME_NAME."_overall", true );
	//custom colors
	$categories = get_the_category($post->ID);
    $catCount = count($categories);
    $id = rand(0,$catCount-1);

	$titleColor = ot_title_color($categories[$id],"category", false);
?>
<?php 
	if($ratings) { 
?>
	<div class="review-article-detail" style="background: <?php echo $titleColor;?>;" itemscope itemtype="http://data-vocabulary.org/Review">
		<div class="main-title" style="border-left: 4px solid #fff;">
			<h2><?php _e("Review Summary", THEME_NAME);?></h2>
			<span><?php _e("Details about this item", THEME_NAME);?></span>
		</div>
		
		<div class="review-summary-list">
		<?php 
				$totalRate = array();
				$rating = explode(";", $ratings);
		?>
		<?php 
				foreach($rating as $rate) { 
					$ratingValues = explode(":", $rate);
					if(isset($ratingValues[1])) {
						$ratingPrecentage = (str_replace(",",".",$ratingValues[1]))*20;
					}
					$totalRate[] = $ratingPrecentage;
					if($ratingValues[0]) {

		?>
			<div class="review-item-line">
				<strong><?php echo $ratingValues[0];?></strong>
				<div class="ot-star-rating">
					<span style="width: <?php echo $ratingPrecentage;?>%;" class=""><strong class="rating"><?php echo round($ratingPrecentage/20, 2);?></strong><?php _e("out of 5", THEME_NAME);?></span>
				</div>
			</div>
		<?php 
					} 
				}
	 	?>
			
		</div>
			
		<div class="review-item-bottomline">
			<?php if($overall) { ?>
			<div class="left-bottom">
				<strong><?php _e("Overall", THEME_NAME);?></strong>
				<p itemprop="summary"><?php echo nl2br(stripslashes($overall));?></p>
			</div>
			<?php } ?>
			<?php 
				if(!empty($totalRate)) { 
					$rateCount = count($totalRate);	
					$total = 0;
					foreach ($totalRate as $val) {
						$total = $total + $val;
					}

					$avaragePrecentage = round($total/$rateCount,2);
					$avarageRate = round((($total/$rateCount)/20),2);

					if($avarageRate>=4.75) {
						$rateText = __("Excellent",THEME_NAME);
					} else if($avarageRate<4.75 && $avarageRate>=3.75) {
						$rateText = __("Good",THEME_NAME);
					} else if($avarageRate<3.75 && $avarageRate>=2.75) {
						$rateText = __("Average",THEME_NAME);
					} else if($avarageRate<2.75 && $avarageRate>=1.75) {
						$rateText = __("Fair",THEME_NAME);
					} else if($avarageRate<1.75 && $avarageRate>=0.75) {
						$rateText = __("Poor",THEME_NAME);
					} else if($avarageRate<0.75) {
						$rateText = __("Very Poor",THEME_NAME);
					}
			?>
				<div class="right-bottom">
					<h2 itemprop="rating"><?php echo $avarageRate;?></h2>
					<span><?php echo $rateText;?></span>
					<div class="ot-star-rating">
						<span style="width: <?php echo $ratingPrecentage;?>%;" class=""><strong class="rating"><?php echo $avarageRate;?></strong> <?php _e("out of 5", THEME_NAME);?></span>
					</div>
	                <meta itemprop="itemreviewed" content="<?php echo esc_attr(get_the_title()); ?>"/>
	                <meta itemprop="reviewer" content="<?php echo esc_attr(get_the_author());?>"/>
	                <meta itemprop="dtreviewed" content="<?php echo esc_attr(get_the_time("F d, Y")); ?>"/>
				</div>
			<?php } ?>
		</div>
	</div>


<?php } ?>