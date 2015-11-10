<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";

$state = $_POST['state'];
?>
<div class="span6">
	<button class="btn btn-primary" onclick="getStateAgain()" >All States</button>
	<div class="thumbnail-header">
	<span class="cat_header">Cities in <?php echo $state; ?></span>
	</div>
	<br />
	<table class="city_table">  
	<?php
		$state_list = getCitiesFromStates($state);
		$rowcount = mysqli_num_rows($state_list);
		$counter = 2;
		
		while($row = mysqli_fetch_array($state_list)){
			if($counter == 2){
				echo "<tr>";
			}
	?>
		<td><a href="#" onclick="getLocality('<?php echo $row['name']; ?>','<?php echo $state; ?>')"><?php echo $row['name']; ?></a></td>  
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
</div>