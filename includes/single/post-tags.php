<?php
	//post tags
	$posttags = get_the_tags();
	$tagCount = count($posttags);
?>
<?php if ($posttags) { ?>
	<div class="tag-cloud-body">
		<?php	
			$i=1;
			foreach($posttags as $tag) {
				echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name . '</a>'; 
				if($i!=$tagCount) echo " ";
				$i++;
			}
		?>
	</div>
<?php } ?>
