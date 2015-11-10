<?php
include_once "dbinfo.inc.oop.php";
?>

<div class="thumbnail-header">
<span class="cat_header">Popular States</span>
</div>
<br />
<table class="city_table">  
<?php
	$state_list = getAllStates();
	$rowcount = mysqli_num_rows($state_list);
	$counter = 2;
	
	while($row = mysqli_fetch_array($state_list)){
		if($counter == 2){
			echo "<tr>";
		}
?>
	<td><a href="#" onclick="getCity('<?php echo $row['Name']; ?>'); return false;"><?php echo $row['Name']; ?></a></td>  
<?php
	if($counter == 0){
		echo "</tr>";
		$counter = 2;
	}else{
		$counter = $counter - 1;
	}
	}
?>
</table>
<a href="#" onclick="setCity('India','country');" title="All India" ><strong>All India</strong></a>