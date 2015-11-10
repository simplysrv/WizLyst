<div class="thumbnail">
<legend>Popular Categories</legend>
<table class="city_table">   
	<?php
		$category_list = getAllCategories();
		$counter = 1;
		
		while($row = mysqli_fetch_array($category_list)){
			if($counter == 1){
				echo "<tr>";
			}
	?>
	<td><a href="category.php?catid=<?php echo $row['category_id']; ?>&cat=<?php echo $row['category_name']; ?>" title="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></a></td>
	<?php
		if($counter == 0){
			echo "</tr>";
			$counter = 1;
		}else{
			$counter = $counter - 1;
		}
		}
	?>
</table>
</div>