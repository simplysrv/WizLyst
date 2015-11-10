<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";

$state = $_POST['state'];
?>
	<div class="thumbnail-header">
	<span class="cat_header">Cities in <?php echo $state; ?></span><span class="pull-right cat_header"><a href="#" onclick="getStateAgain(); return false;">Back</a></span>
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
		<td><a href="#" onclick="setCity('<?php echo $row['name']; ?>','city'); return false;"><?php echo $row['name']; ?></a></td>  
	<?php
		if($counter == 0){
			echo "</tr>";
			$counter = 2;
		}else{
			$counter = $counter - 1;
		}
		}
	?>
	<tr>
	<td colspan="3"><a href="#" onclick="setCity('<?php echo $state; ?>','state'); return false;"><strong>All cities in <?php echo $state; ?></strong></a></td>
	</table>