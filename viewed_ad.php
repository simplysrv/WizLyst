<?php
	include_once "dbinfo.inc.oop.php";
	
	if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
		$post = viewedPost("",$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
	}else{
		$post = viewedPost("","","");
	}
	
	$rowcount = mysqli_num_rows($post);
						
	if($rowcount == 0) {
	?>
		<br /><center><img src='shopping.png' /><h4>Oops! No one is selling!</h4><strong>Try some other location</strong></center>
	<?php
	}
						
	$counter = 1;
	
	while($row = mysqli_fetch_array($post)){
?>
<div id="viewed_<?echo $counter; ?>">
<div class="media">
	<a class="pull-left" href="product.php?pid=<?php echo $row['Post_id']; ?>" title="<?php echo $row['Post_title']; ?>"  >
		<img class="media-object" alt="<?php echo $row['Post_title']; ?>" src="<?php echo $row['Post_img1']; ?>" style="width:64px; height:64px">
	</a>
	<div class="media-body">
		<a href="product.php?pid=<?php echo $row['Post_id']; ?>" title="<?php echo $row['Post_title']; ?>"  ><?php echo $row['Post_title']; ?></a>
		<br /><span class="label label-inverse">
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
		<br /><?php echo $row['Post_category']; ?> | <?php echo $row['Post_city']; ?>, <?php echo $row['Post_state']; ?>
	</div>
</div>
<hr />
</div>
<?php
	$counter = $counter + 1;
}
?>