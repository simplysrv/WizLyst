<div class="thumbnail-header">
<span class="cat_header">Other Posts Of This Seller</span>
</div>
<table class="category_table" cellpadding="10" cellspacing="0">   
<?php
	$post = getSameUserPost($user['user_id']);
	$counter = 4;
	
	while($row = mysqli_fetch_array($post)){
		$title = substr($row['Post_title'], 0, 60);
		if(strlen($row['Post_title']) > 60){
			$title = $title."...";
		}
		
		if($counter == 4){
			echo "<tr>";
		}
?>  
<td width="25%" valign="top">
	<div class="category_thumbnail" id="post_<?php echo $row['Post_id']; ?>" style="height: 230px;">
		<a href="product.php?pid=<?php echo $row['Post_id']; ?>" title="<?php echo $row['Post_title']; ?>"  >
		<div style="background:url(<?php echo $row['Post_img1']; ?>); background-size:auto 128px; background-repeat:no-repeat; width:100%; height:128px" class="img-rounded">
		<span class="label label-inverse" style="position: relative; top:10px; left:-5px">
		<?php 
			if($row['Post_price'] != "0") {
				if($row['Post_price'] > 100000) {
					$disp_amount = round(($row['Post_price']/100000), 2);
					echo "Rs.".$disp_amount."Lacs";
				} else {
					echo "Rs.".money_format('%!.0i', $row['Post_price']);
				}
			} else {
				if($row['Post_free'] == "1") {
					echo "Free";
				} else if($row['Post_negotiable'] == "1") {
					echo "Negotiable";
				}
			}
		?>
		</span>
		</div>
		</a>
		<a href="product.php?pid=<?php echo $row['Post_id']; ?>" title="<?php echo $row['Post_title']; ?>"  ><?php echo $title; ?></a>
		<br />
		<?php echo $row['Post_city']; ?> 
	</div>
</td> 
<?php
	if($counter == 0){
		echo "</tr>";
		$counter = 4;
	}else{
		$counter = $counter - 1;
	}
	}
	if($counter >= 0){
		while($counter >= 0){
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