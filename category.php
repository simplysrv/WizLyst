<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();

if(!isset($_GET['cat'])){
	header('Location: index.php');
}

$cat = $_GET['cat'];
$catid = $_GET['catid'];

?>
<!DOCTYPE html>
<html lang="en">
<!----------------------------------------
	Created by: Saurav Majumder
	All Rights Reserved to Wizlyst.com
------------------------------------------>
<head>
	<title><?php echo $cat; ?></title>
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

	<meta name="description" content="Looking for a job? Want to sell your house/apt? Need to hang out on Friday night, looking for a bar/club? Wizlyst.com is the place to satisfy your desires and dreams!! We are your neighborhood classifieds serving you to make your life simpler and bonding stronger. Wizlyst.com is the place where you can buy, sell, rent and exchange items within your local community and across the country.">
	
	<meta name="keywords" content="free classifieds in India, classified ads in India, Post Free Ads, online classified advertising, auto classified, classified ad posting, Musical Instruments sale, business classifieds, employment classifieds, online classifieds, Matrimonial classified ad, real estate classified ad, rental classifieds, travel classifieds, used car classifieds, house for rent, house for sale, house rentals, sell and buy, classified ad, classified ad India, classified ad posting, classified ad sites, classified advertising, classifieds listings, books store in Kolkata, rental services Kolkata, Apartments in Kolkata, College books">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
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
	<!--      Top Navigation Start     -->
	<?php
	include_once "header.php";
	?>
	<!--      Top Navigation End     -->
	<div class="container">
		<!--      Breadcrumb Start     -->
		<div class="row">  
			<div class="span12">  
				<ul class="breadcrumb">  
  					<li>  
    					<a href="index.php">Home</a> <span class="divider">></span>  
  					</li> 
  					<li class="active"><?php echo $cat; ?></li>  
				</ul>  
			</div>  
		</div>
		<!--      Breadcrumb End     -->
		<div class="row">
			<div class="span12">
				<center><h3><?php echo $cat; ?></h3></center>
			</div>
		</div>
		<div class="row">
			<div class="span8">
				<!--      Subcategory Box Start     -->
				<div class="thumbnail">
					<legend><?php echo $cat; ?> Subcategories</legend>
					<table class="city_table">   
					<?php
						$subcategory_list = getAllSubcategories($catid);
						$counter = 2;
						
						while($row = mysqli_fetch_array($subcategory_list)){
							if($counter == 2){
								echo "<tr>";
							}
					?>
					<td><a href="searchresult.php?cat=<?php echo $cat; ?>&subcat=<?php echo $row['subcategory_name']; ?>"  title="<?php echo $row['subcategory_name']; ?>"  ><?php echo $row['subcategory_name']; ?></a></td>
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
				<!--      Subcategory Box End     -->
			</div>
			<div class="span4">
				<!--      Category Box Start     -->
				<?php
				include_once "popular_categories.php";
				?>
				<!--      Category Box End     -->
			</div>
		</div>
		<br />
		<div class="row">
			<div class="span8">
					<div class="thumbnail-header">
						<span class="cat_header">Recent Posts</span>
						<span class="pull-right cat_header"><a href="searchresult.php?l_type=recent&cat=<?php echo $cat; ?>">More</a></span>
					</div>
					<table class="category_table" cellpadding="10" cellspacing="0">   
					<?php
						if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
							$post = recentPost($cat,$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
						}else{
							$post = recentPost($cat,"","");
						}
						
						$rowcount = mysqli_num_rows($post);
						
						if($rowcount == 0) {
						?>
							<br /><center><img src='shopping.png' /><h4>Oops! No one is selling!</h4><strong>Try some other location</strong></center>
						<?php
						}
						
						$counter = 3;
						
						while($row = mysqli_fetch_array($post)){
							
							$title = substr($row['Post_title'], 0, 60);
							if(strlen($row['Post_title']) > 60){
								$title = $title."...";
							}
							
							if($counter == 3){
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
							$counter = 3;
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

					<div class="thumbnail-header">
						<span class="cat_header">Most Viewed Posts</span>
						<span class="pull-right cat_header"><a href="searchresult.php?l_type=recent&cat=<?php echo $cat; ?>">More</a></span>
					</div>
					<table class="category_table" cellpadding="10" cellspacing="0">   
			          <?php
						if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
							$post = viewedPost($cat,$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
						}else{
							$post = viewedPost($cat,"","");
						}
						
						$rowcount = mysqli_num_rows($post);
						
						if($rowcount == 0) {
						?>
							<br /><center><img src='shopping.png' /><h4>Oops! No one is selling!</h4><strong>Try some other location</strong></center>
						<?php
						}
						
						$counter = 3;
						
						while($row = mysqli_fetch_array($post)){
						
							$title = substr($row['Post_title'], 0, 60);
							if(strlen($row['Post_title']) > 60){
								$title = $title."...";
							}
							
							if($counter == 3){
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
							$counter = 3;
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
			</div>
			<div class="span4">
			<center><a class="btn btn-large btn-success" href="post.php" >Sell Now</a></center>
			<br />
			<!-- 
			<img src="img/ad.png" class="ad250x250">
			-->
			<center><img src="img/ad1.jpg" border="1" style="width:300px; height:250px; border: 1px;"></center>
			<br />
			<!-- Jhatkadeal Offer Start -->
			<?php
				//include_once "offers.php";
			?>
			<!-- Jhatkadeal offer End -->

          	<!-- Top Sellers Start -->
			<?php /*
				include_once "top_sellers.php";
				*/
			?>
			<!-- Top Sellers End -->
			</div>
		</div>
	</div>
	<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
</body>
</html>
