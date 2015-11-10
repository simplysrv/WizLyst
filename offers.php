<div class="thumbnail-header">
<span class="cat_header">Offers</span><span class="pull-right cat_header"><a href="http://www.jhatkadeal.com" target="_blank" title="More Offers" >More</a></span>
</div>
<table class="category_table" cellpadding="10" cellspacing="0"> 
	<?php
		$result_deals = Deals();
		$counter = 1;
		
		while($row = mysqli_fetch_array($result_deals)){
			$discount_percent = round((($row['o_price'] - $row['n_price']) * 100) / $row['o_price']);
			$title = $row['title'];
			$new_title = str_replace(' & ',' and ', $title);
			$new_title = substr($new_title, 0, 40);
			$new_title = wordwrap($new_title, 20, "<br />\n", true);
							
			$image = "http://www.jhatkadeal.com/control/".$row['img'];
	
			if($counter == 1){
				echo "<tr>";
			}
	?>   
	<td width="50%" valign="top">
		<div class="category_thumbnail">
			<a class="pull-center" target="_blank" href="http://www.jhatkadeal.com" title="<?php echo $row['title']; ?>" ><img alt="<?php echo $row['title']; ?>" src="<?php echo $image; ?>" style="width:100%; height:100px" class="img-rounded"></a>
			<a target="_blank" href="http://www.jhatkadeal.com/product.php?id=<?php echo $row['id']; ?>" title="<?php echo $row['title']; ?>" ><?php echo $new_title; ?></a>
			<br />
			<span class="label label-important"><?php echo $discount_percent; ?>% off</span>
    	</div>
    </td>
	<?php
		if($counter == 0){
			echo "</tr>";
			$counter = 1;
		}else{
			$counter = $counter - 1;
		}
		}
		if($counter != 0){
			while($counter != 0){
	?>
			<td width="20%" valign="top">
			</td>
	<?php
				$counter = $counter - 1;
			}
			echo "</tr>";
		}
	?>  	
</table>
<div class="row">
<img src="img/jd.jpg" title="Powered by JhatkaDeal.com" class="span2 pull-right">
</div>