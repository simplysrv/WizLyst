<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<!----------------------------------------
	Created by: Saurav Majumder
	All Rights Reserved to Wizlyst.com
------------------------------------------>
<head>
	<title>Wizlyst - About Us</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

	<meta name="robots" content="noindex, nofollow">
	<meta name="googlebot" content="noindex, nofollow">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
	<script src="js/bootstrap-modal.js"></script>
	<script src="js/bootstrap-transition.js"></script>
</head>
<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"Zyh9i1acVE00W7", domain:"wizlyst.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=Zyh9i1acVE00W7" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->

<div class="city-box">
		<div class="container">
			<div class="span5" id="search-title" >
				Search your city: 
				<form class="form-search" style="margin: 10px 0px;">
				<input id="searchTextField" type="text" placeholder="Kolkata">
				<button class="btn btn-primary" type="button" id="city-search-btn"><i class="icon-search icon-white"></i></button>
				</form>
				<div id="map-canvas"></div>
				<a href="#" style="color: #fff;" onclick="setCity('India','country');">All India</a>
			</div>
			<div class="span6" id="search-body">
				<table class="city_table">   
				  <?php
					$city_list = getAllCities();
					$rowcount = mysqli_num_rows($city_list);
					$counter = 4;
					
					while($row = mysqli_fetch_array($city_list)){
						if($counter == 4){
							echo "<tr>";
						}
				?>
					<td><a href="#" onclick="setCity('<?php echo $row['city_name']; ?>','city');"><?php echo $row['city_name']; ?></a></td>  
				<?php
					if($counter == 0){
						echo "</tr>";
						$counter = 4;
					}else{
						$counter = $counter - 1;
					}
					}
				?> 
				</table>
			</div>
		</div>
	</div>
	<!--  Header  Start  -->
	<?php
	include_once "header.php";
	?>
	<!--  Header  End  -->
	<div class="container">
		<center><a href="index.php" title="Wizlyst.com" ><img src="img/new_logo.png" style="margin:auto; height:100px; "></a></center>
		<p>Looking for a job? Want to sell your house/apt? Need to hang out on Friday night, looking for a bar/club? <strong>Wizlyst.com</strong> is the place to satisfy your desires and dreams!! We are your neighborhood classifieds serving you to make your life simpler and bonding stronger. <strong>Wizlyst.com</strong> is the place where you can buy, sell, rent and exchange items within your local community and across the country.</p>
		
		<p><strong>Wizlyst.com</strong> is a new generation classifieds advertisement platform, which is easy to use because of its responsive design, quick search and browsing abilities. <strong>Wizlyst.com</strong> has an extended category list, fast response of ads and quick contact features that is beneficial for the advertiser and customers.</p>
		
		<p>From local events to automotive, services to education classes, jobs to real estate you will always find a reason to post an Ad in <strong>Wizlyst.com</strong>. With its strong social features advertisers can now share their Ads in Facebook, Tweeter and Google+ to reach out to their customers easily</p>
		
		<p>Just choose your category/subcategory, find your location, describe your item, upload images and post your Ad. We take care of the rest. Its fast, easy and simple. </p>

		<p>Contact us at <i><strong>wecare@wizlyst.com</strong></i></p>
		<br />
	</div>
		<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
</body>
</html>