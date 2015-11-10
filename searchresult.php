<?php
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

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
	<title>Wizlyst</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

	<meta name="description" content="Looking for a job? Want to sell your house/apt? Need to hang out on Friday night, looking for a bar/club? Wizlyst.com is the place to satisfy your desires and dreams!! We are your neighborhood classifieds serving you to make your life simpler and bonding stronger. Wizlyst.com is the place where you can buy, sell, rent and exchange items within your local community and across the country.">
	
	<meta name="keywords" content="free classifieds in India, classified ads in India, Post Free Ads, online classified advertising, auto classified, classified ad posting, Musical Instruments sale, business classifieds, employment classifieds, online classifieds, Matrimonial classified ad, real estate classified ad, rental classifieds, travel classifieds, used car classifieds, house for rent, house for sale, house rentals, sell and buy, classified ad, classified ad India, classified ad posting, classified ad sites, classified advertising, classifieds listings, books store in Kolkata, rental services Kolkata, Apartments in Kolkata, College books">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">

	<script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	
	<script>
	$(document).ready(function(){
		$("#listView").button('toggle');
	});
	</script>
</head>
<body>

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"Zyh9i1acVE00W7", domain:"wizlyst.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
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
	<div class="container">
		<!--      Top Navigation Start     -->
		<?php
		include_once "header.php";
		?>
		<!--      Top Navigation End     -->
		<!--      Breadcrumb Start     -->
		<div class="row">  
			<div class="span12">  
				<ul class="breadcrumb">  
  					<li>  
    					<a href="index.php">Home</a> 
					<?php if(isset($_GET['cat'])){
						$category_details = getCategory($_GET['cat']);
						$category = mysqli_fetch_array($category_details);
					?>
						<span class="divider">/</span>
						<li><a href="category.php?catid=<?php echo $category['category_id']; ?>&cat=<?php echo $_GET['cat']; ?>"><?php echo $_GET['cat']; ?></a>
					<?php
						}
						
						if(isset($_GET['subcat'])){
					?>
						<span class="divider">/</span></li>
						<li><a href="searchresult.php?cat=<?php echo $_GET['cat']; ?>&subcat=<?php echo $_GET['subcat']; ?>"><?php echo $_GET['subcat']; ?></a></li>
					<?php
						}
						
						if(isset($_GET['s_string'])){
					?>
						<li>&nbsp; | <strong>You searched for : "<?php echo $_GET['s_string']; ?>"</strong></li>
					<?php
						}
					?>
  					</li> 
  					<li class="active"><?php echo $cat; ?></li>  
				</ul>  
			</div>  
		</div>
		<!--      Breadcrumb End     -->
		<div class="row">
			<div class="span3 search_thumbnail">
				<ul class="nav nav-list">
					<li class="nav-header">Categories</li>
					<li
					<?php
							if($_GET['cat'] == 'all'){
								echo "class='active'";
							}
						?>
					><a href="searchresult.php?cat=all<?php if(isset($_GET['s_string'])){ echo '&s_string='.$_GET['s_string']; } ?>">All</a></li>
					<?php
						$category_list = getAllCategories();
						while($row = mysqli_fetch_array($category_list)){
					?>
						<li 
						<?php
							if($_GET['cat'] == $row['category_name']){
								echo "class='active'";
							}
						?>
						><a href="searchresult.php?cat=<?php echo $row['category_name']; if(isset($_GET['s_string'])){ echo '&s_string='.$_GET['s_string']; } ?>"><?php echo $row['category_name']; ?></a></li>
					<?php
						}
					?>
					<li class="nav-header">Subcategories</li>
					<?php
						$cid = getCategoryId($_GET['cat']);
						if($cid != "") {
					?>
						<li
						<?php
							if($_GET['subcat'] == 'all' || !isset($_GET['subcat'])){
								echo "class='active'";
							}
						?>
						><a href="searchresult.php?cat=<?php echo $_GET['cat']; ?>&subcat=all<?php if(isset($_GET['s_string'])){ echo '&s_string='.$_GET['s_string']; } ?>">All</a></li>
					<?php
						$subcategory_list = getAllSubcategories($cid);
						while($row_sub = mysqli_fetch_array($subcategory_list)){
					?>
						<li
						<?php
							if($_GET['subcat'] == $row_sub['subcategory_name']){
								echo "class='active'";
							}
						?>
						><a href="searchresult.php?cat=<?php echo $_GET['cat']; ?>&subcat=<?php echo $row_sub['subcategory_name']; if(isset($_GET['s_string'])){ echo '&s_string='.$_GET['s_string']; } ?>"><?php echo $row_sub['subcategory_name']; ?></a></li>
					<?
						}
						}
					?>
				</ul>
				<br>
			</div>
			<div class="span9">
				<div class="btn-group pull-right" data-toggle="buttons-radio">
					<button class="btn" id="listView"><i class="icon-list" ></i> List</button>
					<button class="btn" id="gridView" disabled><i class="icon-th"></i> Grid</button>
				</div>
				<ul class="nav nav-tabs">   
					<li class="
					<?php if($_GET['s_type'] == "date" || $_GET['s_type'] == ""){
						echo "active"; 
						}
					?>	
					dropdown">  
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Posting Date 
					<?php
					if(($_GET['s_type'] == "date" || $_GET['s_type'] == "") && ($_GET['s_dir'] == "desc" || $_GET['s_dir'] == "")){
						echo "<i class='icon-chevron-down'></i>";
					}elseif(($_GET['s_type'] == "date" || $_GET['s_type'] == "") && $_GET['s_dir'] == "asc"){
						echo "<i class='icon-chevron-up'></i>";
					}
					?>
					</b></a>  
					<ul class="dropdown-menu bottom-up pull-right">  
						<li><a href="searchresult.php?
						<?php
						if(isset($_GET['cat'])){
							echo "cat=".$_GET['cat'];
						} 
						if(isset($_GET['subcat'])){
							echo "&subcat=".$_GET['subcat'];
						}
						if(isset($_GET['s_string'])){
							echo "s_string=".$_GET['s_string'];
						}
						?>
						&s_type=date&s_dir=asc">Old to New</a></li>  
						<li><a href="searchresult.php?
						<?php
						if(isset($_GET['cat'])){
							echo "cat=".$_GET['cat'];
						} 
						if(isset($_GET['subcat'])){
							echo "&subcat=".$_GET['subcat'];
						}
						if(isset($_GET['s_string'])){
							echo "s_string=".$_GET['s_string'];
						}
						?>
						&s_type=date&s_dir=desc">New to Old</a></li>  
					</ul>  
					</li>  
					<li class="
					<?php if($_GET['s_type'] == "price"){
						echo "active"; 
						}
					?>
					dropdown">  
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Price <?php
					if($_GET['s_type'] == "price" && ($_GET['s_dir'] == "desc" || $_GET['s_dir'] == "")){
						echo "<i class='icon-chevron-down'></i>";
					}elseif($_GET['s_type'] == "price" && $_GET['s_dir'] == "asc"){
						echo "<i class='icon-chevron-up'></i>";
					}
					?></b></a>  
					<ul class="dropdown-menu">  
						<li><a href="searchresult.php?
						<?php
						if(isset($_GET['cat'])){
							echo "cat=".$_GET['cat'];
						} 
						if(isset($_GET['subcat'])){
							echo "&subcat=".$_GET['subcat'];
						}
						if(isset($_GET['s_string'])){
							echo "s_string=".$_GET['s_string'];
						}
						?>
						
						&s_type=price&s_dir=asc">Low to High</a></li>  
						<li><a href="searchresult.php?
						<?php
						if(isset($_GET['cat'])){
							echo "cat=".$_GET['cat'];
						} 
						if(isset($_GET['subcat'])){
							echo "&subcat=".$_GET['subcat'];
						}
						if(isset($_GET['s_string'])){
							echo "s_string=".$_GET['s_string'];
						}
						?>
						&s_type=price&s_dir=desc">High to Low</a></li>  
					</ul>  
					</li>  
				</ul>
				<?php
				if(isset($_GET['cat']) && $_GET['cat'] != "all"){
					$scat = $_GET['cat'];
				}else{
					$scat = "";
				}
				
				if(isset($_GET['subcat']) && $_GET['subcat'] != "all"){
					$subcat = $_GET['subcat'];
				}else{
					$subcat = "";
				}
				
				if(isset($_GET['s_string'])){
					$query = $_GET['s_string'];
				}
				
				if($_GET['s_type'] == "date"){
					$sort_type = "date";
				}elseif($_GET['s_type'] == "price"){
					$sort_type = "price";
				}else{
					$sort_type = "date";
				}
				
				if($_GET['s_dir'] == "desc"){
					$sort_direction = "desc";
				}elseif($_GET['s_dir'] == "asc"){
					$sort_direction = "asc";
				}else{
					$sort_direction = "desc";
				}
				
				if(isset($_GET['s_string'])) {
					if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
						$post = stringSearch($scat,$subcat,$query,0,500,$sort_type,$sort_direction,$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
					}else{
						$post = stringSearch($scat,$subcat,$query,0,500,$sort_type,$sort_direction,"","");
					}
				} else {
					if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
						$post = searchList($scat,$subcat,0,500,$sort_type,$sort_direction,$_COOKIE["fblocType"],$_COOKIE["fbcity"]);
					}else{
						$post = searchList($scat,$subcat,0,500,$sort_type,$sort_direction,"","");
					}
				}
				$counter = 1;
				
				$rowcount = mysqli_num_rows($post);
						
				if($rowcount == 0) {
				?>
					<br /><center><img src='img/search_not_found.png' /><h4>Oops! No one is selling!</h4><strong>Try some other option</strong></center>
				<?php
				}
						
				
				while($row = mysqli_fetch_array($post)){
				?>
				<div class="media">
					<a class="pull-left" href="product.php?pid=<?php echo $row['Post_id']; ?>" title="<?php echo $row['Post_title']; ?>" >
						<img class="media-object" alt="<?php echo $row['Post_title']; ?>" style="width:80px; height:80px" src="<?php echo $row['Post_img1']; ?>">
					</a>
					<div class="media-body">
					<h5 class="media-heading"><a href="product.php?pid=<?php echo $row['Post_id']; ?>" title="<?php echo $row['Post_title']; ?>" ><?php echo $row['Post_title']; ?></a></h5>
					<h5 class="pull-right">
					<?php 
						if($row['Post_price'] != "0") {
							echo "Rs.".money_format('%!.0i', $row['Post_price']);
						} else {
							if($row['Post_free'] == "1") {
								echo "Free";
							} else if($row['Post_negotiable'] == "1") {
								echo "Negotiable";
							}
						}
					?>
					</h5>
					<span><strong>
					<?php 
					if($row['Post_locality'] != "Not Specified" && $row['Post_locality'] != ""){
						echo $row['Post_locality'].",";
					}
					echo $row['Post_city']; ?>, <?php echo $row['Post_state']; ?>
					</strong></span>
					<br />
					<span><a href="category.php?catid=<?php echo $category['category_id']; ?>&cat=<?php echo $_GET['cat']; ?>"><?php echo $row['Post_category']; ?></a> > 
					<a href="searchresult.php?cat=<?php echo $row['Post_category']; ?>&subcat=<?php echo $row['Post_subcategory']; ?>" title="<?php echo $row['Post_subcategory']; ?>" ><?php echo $row['Post_subcategory']; ?></a></span> 				
					<br /><br />Posted on <?php 
					$pieces = explode(" ", $row['Post_timestamp']);
					echo $pieces[0]; ?>
					</div>
				</div>
				<hr />
				<?php
				}
				?>
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
