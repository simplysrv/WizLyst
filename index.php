<?php
session_start();
//Database Connectivity
include_once "dbinfo.inc.oop.php";
include_once "cookie.php";
?>
<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<!----------------------------------------
	Created by: Saurav Majumder
	All Rights Reserved to Wizlyst.com
------------------------------------------>
<head>
	<title>Wizlyst</title>

	<meta name="description" content="Looking for a job? Want to sell your house/apt? Need to hang out on Friday night, looking for a bar/club? Wizlyst.com is the place to satisfy your desires and dreams!! We are your neighborhood classifieds serving you to make your life simpler and bonding stronger. Wizlyst.com is the place where you can buy, sell, rent and exchange items within your local community and across the country.">
	
	<meta name="keywords" content="free classifieds in India, classified ads in India, Post Free Ads, online classified advertising, auto classified, classified ad posting, Musical Instruments sale, business classifieds, employment classifieds, online classifieds, Matrimonial classified ad, real estate classified ad, rental classifieds, travel classifieds, used car classifieds, house for rent, house for sale, house rentals, sell and buy, classified ad, classified ad India, classified ad posting, classified ad sites, classified advertising, classifieds listings, books store in Kolkata, rental services Kolkata, Apartments in Kolkata, College books">
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	
	<meta property="og:title" content="Wizlyst - One stop buy sell and rent" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.wizlyst.com/" />
	<meta property="og:image" content="http://www.wizlyst.com/img/new_logo.png" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	

	<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">
	<script src=http://cdn.webrupee.com/js type=”text/javascript”></script>

	<script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>

	<script>
	
	function getCity(state){
		$("#popular-locations").html("<br><br><br><center><img src='img/loading.gif' /></center>");
 		$.ajax({
 			type: "POST",
 			url: "getCityHome.php",
 			data: {state:state}
		}).done(function( result ) {
			$("#popular-locations").html( result );
		});

	}
	
	function getStateAgain(){
		$("#popular-locations").html("<br><br><br><center><img src='img/loading.gif' /></center>");
		$('#popular-locations').load('city_state_home.php');
	}
		
	$(document).ready(function(){
	
		$("#search_btn").click(function(){
			var search_string = $(".search_input").val();
			window.location.href = "searchresult.php?s_string="+search_string;
		});

		(function recentFadeOut() {
			$("#recent").html("<br><br><br><center><img src='img/loading.gif' /></center><br><br><br>");

			$.ajax({
				type: "POST",
				url: "recent_ad.php"
			}).done(function( result ) {
				$("#recent").html( result );
			});
			setTimeout(recentFadeOut, 20000);
		})();

		(function viewedFadeOut() {
			$("#viewed").html("<br><br><br><center><img src='img/loading.gif' /></center><br><br><br>");

			$.ajax({
				type: "POST",
				url: "viewed_ad.php"
			}).done(function( result ) {
				$("#viewed").html( result );
			});
			setTimeout(viewedFadeOut, 20000);
		})();

	});
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

    <script>
	function initialize() {
	  var mapOptions = {
	    center: new google.maps.LatLng(-33.8688, 151.2195),
	    zoom: 13,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  var map = new google.maps.Map(document.getElementById('map-canvas'),
	    mapOptions);

	  var input =(document.getElementById('searchTextField'));
	var options = {
	  types: ['(cities)'],
	  componentRestrictions: {country: 'in'}
	};

	  var autocomplete = new google.maps.places.Autocomplete(input,options);

	  autocomplete.bindTo('bounds', map);

	  var infowindow = new google.maps.InfoWindow();
	  var marker = new google.maps.Marker({
	    map: map
	  });

	  google.maps.event.addListener(autocomplete, 'place_changed', function() {
	    infowindow.close();
	    marker.setVisible(false);
	    input.className = '';
	    var place = autocomplete.getPlace();
	    if (!place.geometry) {
	      input.className = 'notfound';
	      return;
	    }

	    var address = '';
	    if (place.address_components) {
	      address = [
	        (place.address_components[0] && place.address_components[0].short_name || ''),
	        (place.address_components[1] && place.address_components[1].short_name || ''),
	        (place.address_components[2] && place.address_components[2].short_name || '')
	      ].join(' ');
	    }

	    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
	    infowindow.open(map, marker);
	  });
	  // Autocomplete.
	  function setupClickListener(id, types) {
	    var textField= document.getElementById(id);
	    google.maps.event.addDomListener(textField, 'click', function() {
	      autocomplete.setTypes(types);
	    });
	  }

	  setupClickListener('searchTextField', []);row
	}


    </script>

    <script type="text/javascript">
var infolinks_pid = 2153156;
var infolinks_wsid = 1;
</script>
</head>
<body onLoad="initialize();">

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"Zyh9i1acVE00W7", domain:"wizlyst.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=Zyh9i1acVE00W7" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->

<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=Zyh9i1acVE00W7" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<!--  -----------------Top Location Selection Box Start----------------- -->
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
<!--  -----------------Top Location Selection Box End----------------- -->

<!--  -----------------Header Start----------------- -->
	<div class="container">
		<!--      Top Navigation Start     -->
		<?php
		include_once "top_navigation.php";
		?>
		<!--      Top Navigation End     -->

		<!--      Logo & Search Section Start     -->
		<div class="row">
			<div class="span3">
				<a href="index.php" title="Wizlyst.com" ><img src="img/new_logo.png" alt="Wizlyst logo" style="margin:auto; height: 80px;"></a>
			</div>
			<div class="span6">
			<br />
				<div class="input-append">
  					<input class="span5 search_input" id="appendedDropdownButton" style="padding: 11px 11px;" type="text" placeholder="Enter what you are looking for.">
  					<button class="btn btn-large btn-primary"  id="search_btn" type="button"><i class="icon-search icon-white"></i> Search</button>
  				</div>
  			</div>
			<div class="span3">
					<br />
					<a class="btn btn-success btn-large pull-right" href="post.php?#ad_details" title="Sell your product now" >Post Free Ad</a>
			</div>
		</div>
		<!--      Logo & Search Section End     -->
	</div>
<!--  -----------------Header End----------------- -->
	<hr />
	<div class="container">
		<!--      Main Body Start     -->
		<div class="row">
			<div class="span8">
					<!-- Product Category Start -->
 					<div class="thumbnail-header">
						<span class="cat_header">Product Categories</span>
					</div>
					<table class="category_table" cellpadding="10" cellspacing="0">   
			          <tr>  
			          	<!--   Colum One Start   -->
			            <td width="33%" valign="top">
						<?php
							$category_list = getAllCategories();
							$rowcount = mysqli_num_rows($category_list);
							
							$counter = 3;
							while($row = mysqli_fetch_array($category_list)){
						?>
			            	<!--    Category Box Start   -->
			            	<div class="category_thumbnail">
			            		<legend><a style="color: #000;" href="category.php?catid=<?php echo $row['category_id']; ?>&cat=<?php echo $row['category_name']; ?>" title="<?php echo $row['category_name']; ?>" ><?php echo $row['category_name']; ?></a></legend>
			            		<ul>
									<li><a href="category.php?catid=<?php echo $row['category_id']; ?>&cat=<?php echo $row['category_name']; ?>" title="All" ><strong>All</strong></a></li>
									<?php
									$subcategory_list = getAllSubcategories($row['category_id']);
									while($row_sub = mysqli_fetch_array($subcategory_list)){
									?>
  									<li><a href="searchresult.php?cat=<?php echo $row['category_name']; ?>&subcat=<?php echo $row_sub['subcategory_name']; ?>" title="<?php echo $row_sub['subcategory_name']; ?>" ><?php echo $row_sub['subcategory_name']; ?></a></li>
  									<?php
									}
									?>
								</ul>
			            	</div>
							<br />
			            	<!--    Category Box End   -->
							<?php
									if($counter <= 1){
										break;
									}
									$counter = $counter - 1;
								}
							?>
			            </td> 
			            <!--   Colum One End   -->

			            <!--   Colum Two Start   --> 
 						<td width="33%" valign="top">
			            	<?php
							
							$counter = $rowcount/3;;
							while($row = mysqli_fetch_array($category_list)){
						?>
			            	<!--    Category Box Start   -->
			            	<div class="category_thumbnail">
			            		<legend><a style="color: #000;" href="category.php?catid=<?php echo $row['category_id']; ?>&cat=<?php echo $row['category_name']; ?>" title="<?php echo $row['category_name']; ?>" ><?php echo $row['category_name']; ?></a></legend>
			            		<ul>
									<li><a href="category.php?catid=<?php echo $row['category_id']; ?>&cat=<?php echo $row['category_name']; ?>" title="All" ><strong>All</strong></a></li>
  									<?php
									$subcategory_list = getAllSubcategories($row['category_id']);
									while($row_sub = mysqli_fetch_array($subcategory_list)){
									?>
  									<li><a href="searchresult.php?cat=<?php echo $row['category_name']; ?>&subcat=<?php echo $row_sub['subcategory_name']; ?>" title="<?php echo $row_sub['subcategory_name']; ?>" ><?php echo $row_sub['subcategory_name']; ?></a></li>
  									<?php
									}
									?>
								</ul>
			            	</div>
							<br />
			            	<!--    Category Box End   -->
							<?php
								if($counter <= 1){
									break;
								}
								$counter = $counter - 1;
								}
							?>
			            </td>
			            <!--   Colum Two End   -->

			            <!--   Colum Three Start   --> 
			             <td width="33%" valign="top">
			            	<?php
							$counter = $rowcount/3;;
							while($row = mysqli_fetch_array($category_list)){
							?>
			            	<!--    Category Box Start   -->
			            	<div class="category_thumbnail">
			            		<legend><a style="color: #000;" href="category.php?catid=<?php echo $row['category_id']; ?>&cat=<?php echo $row['category_name']; ?>" title="<?php echo $row['category_name']; ?>" ><?php echo $row['category_name']; ?></a></legend>
			            		<ul>
									<li><a href="category.php?catid=<?php echo $row['category_id']; ?>&cat=<?php echo $row['category_name']; ?>" title="All" ><strong>All</strong></a></li>
  									<?php
									$subcategory_list = getAllSubcategories($row['category_id']);
									while($row_sub = mysqli_fetch_array($subcategory_list)){
									?>
  									<li><a href="searchresult.php?cat=<?php echo $row['category_name']; ?>&subcat=<?php echo $row_sub['subcategory_name']; ?>" title="<?php echo $row_sub['subcategory_name']; ?>" ><?php echo $row_sub['subcategory_name']; ?></a></li>
  									<?php
									}
									?>
								</ul>
			            	</div>
							<br />
			            	<!--    Category Box End   -->
							<?php
								if($counter <= 1){
										break;
								}
								$counter = $counter - 1;
								}
							?>
			            </td> 
			            <!--   Colum Three End  -->    	
			          </tr>  
					</table> 
					<!-- Product Category End -->

					<!-- Popular Cities Box Start -->
					<div class="row">
						<div class="span3">
							<div class="thumbnail-header">
							<span class="cat_header">Popular Cities</span>
							</div>
							<br />
							<table class="city_table">   
					          <?php
								$city_list = getAllCities();
								$rowcount = mysqli_num_rows($city_list);
								$counter = 1;
								
								while($row = mysqli_fetch_array($city_list)){
									if($counter == 1){
										echo "<tr>";
									}
							?>
					            <td><a href="#" onclick="setCity('<?php echo $row['city_name']; ?>','city'); return false;" title="<?php echo $row['city_name']; ?>" ><?php echo $row['city_name']; ?></a></td>  
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
						<!-- Popular Cities Box End -->
 						</div>

 						<div class="span5" id="popular-locations">
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
					            <td><a href="#" onclick="getCity('<?php echo $row['Name']; ?>'); return false;" title="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></a></td>  
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
 						</div>

 					</div>
					<!--  -----------------Buy/Sell/Trade Product Listing Start----------------- -->
					<div class="thumbnail-header">
						<span class="cat_header">Buy/Sell/Trade</span><span class="pull-right cat_header"><a href="category.php?catid=1&cat=Buy/Sell/Trade">More</a></span>
					</div>
					<table class="category_table" cellpadding="10" cellspacing="0">   
			          <?php
						if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
							$post = randomPost("Buy/Sell/Trade",$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
						}else{
							$post = randomPost("Buy/Sell/Trade","","");
						}
						
						$rowcount = mysqli_num_rows($post);
						
						if($rowcount == 0) {
						?>
							<br /><center><img src='shopping.png' alt="No ads"/><h4>Oops! No one is selling!</h4><strong>Try some other location</strong></center>
						<?php
						}
						
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
						<div class="category_thumbnail" style="height: 230px;">
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
					<!--  -----------------Buy/Sell/Trade Product Listing End----------------- -->

					<!--  -----------------Real Estate-Housing Product Listing Start----------------- -->
					<div class="thumbnail-header">
						<span class="cat_header">Real Estate-Housing</span><span class="pull-right cat_header"><a href="category.php?catid=6&cat=Real Estate-Housing">More</a></span>
					</div>
					<table class="category_table" cellpadding="10" cellspacing="0">   
			          <?php
						if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
							$post = randomPost("Real Estate-Housing",$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
						}else{
							$post = randomPost("Real Estate-Housing","","");
						}
						
						$rowcount = mysqli_num_rows($post);
						
						if($rowcount == 0) {
						?>
							<br /><center><img src='shopping.png' alt="No ad"/><h4>Oops! No one is selling!</h4><strong>Try some other location</strong></center>
						<?php
						}
						
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
						<div class="category_thumbnail" style="height: 230px;">
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
					<!--  -----------------Real Estate-Housing Product Listing End----------------- -->		

					<!--  -----------------Recently Viewed Product Listing Start----------------- -->
					<?php
						$cookie_details = userViewedPosts($cookie_identifier);
						$rowcount = mysqli_num_rows($cookie_details);
						
						if($rowcount > 0){
					?>
					<div class="thumbnail-header">
						<span class="cat_header">You Recently Viewed</span>
					</div>
					<table class="category_table" cellpadding="10" cellspacing="0">   
			          <?php
						$counter = 4;
						
						while($row = mysqli_fetch_array($cookie_details)){
							$post_details = getPost($row['pid']);
							$post = mysqli_fetch_array($post_details);
							$title = substr($post['Post_title'], 0, 60);
							if(strlen($post['Post_title']) > 60){
								$title = $title."...";
							}
							
							if($counter == 4){
								echo "<tr>";
							}
					?>  
					<td width="25%" valign="top">
						<div class="category_thumbnail" style="height: 230px;">
							<a href="product.php?pid=<?php echo $post['Post_id']; ?>" title="<?php echo $post['Post_title']; ?>"  >
							<div style="background:url(<?php echo $post['Post_img1']; ?>); background-size:auto 128px; background-repeat:no-repeat; width:100%; height:128px" class="img-rounded">
							<span class="label label-inverse" style="position: relative; top:10px; left:-5px">
							<?php 
								if($post['Post_price'] != "0") {
									if($post['Post_price'] > 100000) {
										$disp_amount = round(($post['Post_price']/100000), 2);
										echo "Rs.".$disp_amount."Lacs";
									} else {
										echo "Rs.".money_format('%!.0i', $post['Post_price']);
									}
								} else {
									if($post['Post_free'] == "1") {
										echo "Free";
									} else if($post['Post_negotiable'] == "1") {
										echo "Negotiable";
									}
								}
							?>
							</span>
							</div>
							</a>
							<a href="product.php?pid=<?php echo $post['Post_id']; ?>" title="<?php echo $post['Post_title']; ?>"  ><?php echo $title; ?></a>
							<br />
							<?php echo $post['Post_city']; ?> 
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
					<?php
						}
					?>
					<!--  -----------------Recently Viewed Product Listing End----------------- -->
			</div>

			<div class="span4">
				
				<center><a href="post.php?#ad_details" title="Sell your product now" ><img src="why_wizlyst.jpg" border="0" alt="Why Wizlyst?"></a></center>
				<br />

				<!--  -----------------Recent Ads Listing Start----------------- -->
				<div onload="recentFadeOut()">
					<div class="thumbnail-header">
	    				<span class="cat_header">Recent Ads</span>
	  				</div>
	  				<br>
	  				<span id="recent1">
					<?php
						if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
							$post = recentPost("",$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
						}else{
							$post = recentPost("","","");
						}
						$counter = 1;
						
						while($row = mysqli_fetch_array($post)){
					?>
	  				<div id="recent_<?echo $counter; ?>">
	  				<div class="media">
	  					<a class="pull-left" href="product.php?pid=<?php echo $row['Post_id']; ?>"  title="<?php echo $row['Post_title']; ?>"  >
	    					<img class="media-object"  alt="<?php echo $row['Post_title']; ?>"   src="<?php echo $row['Post_img1']; ?>" style="width:64px; height:64px">
	  					</a>
	  					<div class="media-body">
	    					<a href="product.php?pid=<?php echo $row['Post_id']; ?>"  title="<?php echo $row['Post_title']; ?>"  ><?php echo $row['Post_title']; ?></a>
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
					</span>
				</div>
				<a class="btn btn-small pull-right" href="searchresult.php?cat">More <i class="icon-chevron-right"></i></a>
				<!--  -----------------Recent Ads Listing End----------------- -->
				<br>
				<br>
				<!--  -----------------Most Viewed Ads Listing Start----------------- -->
				<div onload="viewedFadeOut()">
					<div class="thumbnail-header">
	    				<span class="cat_header">Most Viewed Ads</span>
	  				</div>
	  				<br>
	  				<span id="viewed1">
	  				<?php
						if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
							$post = viewedPost("",$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
						}else{
							$post = viewedPost("","","");
						}
						$counter = 1;
						
						while($row = mysqli_fetch_array($post)){
					?>
	  				<div id="viewed_<?echo $counter; ?>">
	  				<div class="media">
	  					<a class="pull-left" href="product.php?pid=<?php echo $row['Post_id']; ?>">
	    					<img class="media-object" alt="<?php echo $row['Post_title']; ?>" src="<?php echo $row['Post_img1']; ?>" style="width:64px; height:64px">
	  					</a>
	  					<div class="media-body">
	    					<a href="product.php?pid=<?php echo $row['Post_id']; ?>"><?php echo $row['Post_title']; ?></a>
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
					</span>
				</div>
				<a class="btn btn-small pull-right" href="searchresult.php?cat">More <i class="icon-chevron-right"></i></a>
				<!--  -----------------Most Viewed Ads Listing End----------------- -->
				<br />
				<br />
				<img src="ad1.jpg" border="1" alt="Ad Region 2" />	

				<!-- Jhatkadeal Offer Start -->
			<?php
				//include_once "offers.php";
			?>
			<!-- Jhatkadeal offer End -->
			</div>
		</div>
		<!--      Main Body End     -->
	</div>
			<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
</body>
</html>
