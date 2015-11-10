<?php
//Database Connectivity..
include_once "dbinfo.inc.oop.php";
?>
<div class="span2">
	<div class="thumbnail-header">
	<span class="cat_header">Cities</span>
	</div>
	<br />
	<table class="city_table">   
	  <?php
		$city_list = getAllCities();
		$rowcount = mysqli_num_rows($city_list);
		$counter = 0;
		
		while($row = mysqli_fetch_array($city_list)){
			if($counter == 0){
				echo "<tr>";
			}
	?>
		<td><a href="#" onclick="getLocality('<?php echo $row['city_name']; ?>','<?php echo $row['city_state']; ?>')"><?php echo $row['city_name']; ?></a></td>  
	<?php
		if($counter == 0){
			echo "</tr>";
			$counter = 0;
		}else{
			$counter = $counter - 1;
		}
		}
	?> 
	</table>
	<!-- Popular Cities Box End -->
</div>
<div class="span4">
	<div class="thumbnail-header">
	<span class="cat_header">States</span>
	</div>
	<br />
	<table class="city_table">  
	<?php
		$state_list = getAllStates();
		$rowcount = mysqli_num_rows($state_list);
		$counter = 1;
		
		while($row = mysqli_fetch_array($state_list)){
			if($counter == 1){
				echo "<tr>";
			}
	?>
		<td><a href="#" onclick="getCity('<?php echo $row['Name']; ?>')"><?php echo $row['Name']; ?></a></td>  
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