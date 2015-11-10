<?php
session_start();
//Database Connectivity
include_once "dbinfo.inc.oop.php";
include_once "cookie.php";

if(!isset($_GET['pid'])){
	header('Location: index.php');
}

$pid = $_GET['pid'];

$pviewed = viewPost($pid);

$result_cookie = addCookieProduct($cookie_identifier, $pid);

$product_details = getPost($pid);
$product = mysqli_fetch_array($product_details);
$uid = $product['Post_uid'];

$category_details = getCategory($product['Post_category']);
$category = mysqli_fetch_array($category_details);

$user_details = getUserDetails($uid);
$user = mysqli_fetch_array($user_details);

$title = str_replace(' & ',' and ', $product['Post_title']);

$new_title = str_replace('"', "", $title);
$new_title = str_replace("'", "", $new_title);

$fb_desc = substr($product['Post_desc'], 0, 85);
$fb_string='http://www.facebook.com/sharer.php?s=100&p[url]=http://flickecom.com/2013/php/product.php?pid='.$pid.'&p[images][0]=http://flickecom.com/2013/php/'.$product['Post_img1'].'&p[title]='.$new_title.'&p[summary]='.$fb_desc.'...';
?>
<!DOCTYPE html>
<html lang="en">
<!----------------------------------------
	Created by: Saurav Majumder
	All Rights Reserved to Wizlyst.com
------------------------------------------>
<head>
	<title><?php echo $product['Post_title']; ?></title>
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

	<meta name="description" content="Looking for a job? Want to sell your house/apt? Need to hang out on Friday night, looking for a bar/club? Wizlyst.com is the place to satisfy your desires and dreams!! We are your neighborhood classifieds serving you to make your life simpler and bonding stronger. Wizlyst.com is the place where you can buy, sell, rent and exchange items within your local community and across the country.">
	
	<meta name="keywords" content="free classifieds in India, classified ads in India, Post Free Ads, online classified advertising, auto classified, classified ad posting, Musical Instruments sale, business classifieds, employment classifieds, online classifieds, Matrimonial classified ad, real estate classified ad, rental classifieds, travel classifieds, used car classifieds, house for rent, house for sale, house rentals, sell and buy, classified ad, classified ad India, classified ad posting, classified ad sites, classified advertising, classifieds listings, books store in Kolkata, rental services Kolkata, Apartments in Kolkata, College books">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
	<meta property="og:title" content="<?php echo $product['Post_title']; ?> at Wizlyst" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.wizlyst.com/product.php?pid=<?php echo $pid; ?>" />
	<meta property="og:image" content="http://www.wizlyst.com/<?php echo $product['Post_img1']; ?>" />
	<meta property="og:description" content="<?php echo $product['Post_desc']; ?>" />

	<script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap-affix.js"></script>
	<script type="text/javascript" src="js/jquery.magnifier.js"></script>
	
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>

	<script>
	$(document).ready(function(){
  		$(".thumb_img").mouseenter(function(){

  			var src = $(this).attr("src");
    		$("#main_img").attr("src",src);
  		});

  		$("#contact_form").submit(function(){

  			var error_flag = 0;
  			var error_msg = "<ul>";

  			var pid = $("#contact_id").val();
			var contact_title = $("#contact_title").val();
  			var r_email = $("#contact_r_email").val();
  			var message = $("#contact_message").val();
  			var s_email = $("#contact_s_email").val();
  			var name = $("#contact_name").val();
  			var phone = $("#contact_phone").val();

  			//alert(pid+" "+r_email+" "+s_email+" "+name+" "+phone);
  			if(pid == "" || contact_title == "" || r_email == "" || !IsEmail(r_email)){
  				error_msg = error_flag + "<li>Internal Error. Refresh Again.</li>";
  				error_flag = 1;
  				error_msg = error_msg + "</ul>";
  				$("#contact_notification").html("<div class='alert alert-danger'>"+error_msg+"</div>");
  				return false;
  			}

  			if (message == "") {
  				error_msg = error_msg + "<li>Message is empty.</li>";
  				error_flag = 1;
  			}

  			if(name == ""){
  				error_msg = error_msg + "<li>Full name is required.</li>";
  				error_flag = 1;	
  			}

  			if(!IsEmail(s_email)){
  				error_msg = error_msg + "<li>Emplty/Invalid email.</li>";
  				error_flag = 1;
  			}

  			if(phone != "" && !isNumber(phone)){
  				error_msg = error_msg + "<li>Invalid Phone number</li>";
  				error_flag = 1;
  			}
  			
  			if(error_flag == 1){
  				error_msg = error_msg + "</ul>";
  				$("#contact_notification").html("<div class='alert alert-danger'>"+error_msg+"</div>");
  				return false;
  			}
		});
 	});

 	function isNumber(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}

	function IsEmail(email) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
	
	function fbs_click(str){
		document.title;window.open(str,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	}
	</script>

</head>
<body itemscope itemtype="http://schema.org/Product">

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"Zyh9i1acVE00W7", domain:"wizlyst.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=Zyh9i1acVE00W7" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=100662213458552";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
  					<li><a href="index.php">Home</a> <span class="divider">/</span></li>
					<li><a href="category.php?catid=<?php echo $category['category_id']; ?>&cat=<?php echo $product['Post_category']; ?>"><?php echo $product['Post_category']; ?></a> <span class="divider">/</span></li>
					<li><a href="searchresult.php?cat=<?php echo $product['Post_category']; ?>&subcat=<?php echo $product['Post_subcategory']; ?>"><?php echo $product['Post_subcategory']; ?></a> <span class="divider">/</span></li>
 					<li class="active"><?php echo $product['Post_title']; ?></li>
				</ul>
			</div>
		</div>
		<!--      Breadcrumb End     -->
		<!-- Body Star -->
		<div clas="row">
			<div class="span12">
				<h3 itemprop="name"><?php echo $product['Post_title']; ?></h3>
				<div class="row">
					<div class="span8">
						<img id="main_img" itemprop="image" alt="Product Image-<?php echo $i; ?>" title="Click to zoom in" src="<?php echo $product['Post_img1']; ?>" style="width:600px;" class="img-polaroid magnify">
					</div>
					<div class="span4">
					<div class="thumbnail-header">
						<span class="cat_header">Details</span> 
					</div>
					<table class="table table-striped" cellpadding="10" cellspacing="0">
						<tr>
							<td>Price</td><td><strong><?php 
								if($product['Post_price'] != "0") {
									echo "Rs.".money_format('%!.0i', $product['Post_price']);
								} else {
									if($product['Post_free'] == "1") {
										echo "Free";
									} else if($product['Post_negotiable'] == "1") {
										echo "Negotiable";
									}
								}
							?></strong> &nbsp; &nbsp; <a href="" class="btn btn-small  btn-primary">Bid Now</a>	</td>
						</tr>
						<tr>
							<td>Seller Name</td><td>
								<a href="profile.php?uid=<? echo $user['user_id']; ?>" title="View User Profile">
								<?php 
								if($user['user_type'] == "individual"){
									echo $user['user_fname']." ".$user['user_lname']; 
								}else{
									echo $user['user_cname'];
								}
								?>
								</a>
							</td>
						</tr>
						<tr>
							<td>Location</td><td><?php echo $product['Post_city']; ?>, <?php echo $product['Post_state']; ?>, <?php echo $product['Post_country']; ?></td>
						</tr>
						<tr>
							<td>Phone</td><td><?php echo $user['user_phone']; ?></td>
						</tr>
						<tr>
							<td>Email</td><td><?php echo $user['user_email']; ?></td>
						</tr>
						<tr>
							<td>URL</td><td><a href="<?php echo $user['user_website']; ?>"><?php echo $user['user_website']; ?></a></td>
						</tr>
					</table>
					<div class="thumbnail-header">
						<span class="cat_header">Other Photos</span>						
					</div>
						<br />
						<?php 
						 for($i=1; $i<5; $i++){
							if($product['Post_img'.$i] != ""){
						?>
						<img id="img<?php echo $i; ?>" alt="Product Image-<?php echo $i; ?>" src="<?php echo $product['Post_img'.$i]; ?>" style="width:120px; height:100px; margin: 5px 5px;" class="thumb_img img-polaroid magnify">
						<?php
							}
						}
						?>
					</div>
				</div>
				<div class="row">
					<div class="span8">
						<div class="thumbnail-header">
							<span class="cat_header">Description</span> 
						</div>
						<div itemprop="description">
						<?php echo $product['Post_desc']; ?>
						<br><br><span style="color:red;"><strong>Tips:</strong></span> While contacting the seller, mention Wizlyst for convenience.
						</div>
						<div class="fb-comments" data-href="http://flickecom.com/2013/php/product.php?pid=<?php echo $product['Post_id']; ?>" data-width="620"></div>
						<a href="#" onclick="fbs_click('<?php echo $fb_string; ?>');" ><img src="img/facebook.png" alt="Facebook"></a>
						<a href="#contact_seller" class="btn btn-small  btn-primary">Contact Seller</a>
						<a href="profile.php?uid=<? echo $user['user_id']; ?>" class="btn btn-small  btn-primary">View Seller's Profile</a>						
					</div>
					<div class="span4">
						<div class="thumbnail sponsored" id="contact_seller">
							<div class="thumbnail-header">
								<span class="cat_header">Reply to this post</span>
							</div>		
							<center><h4><img src="img/phone.png"> Call Now: <?php echo $user['user_phone']; ?></h4></center>
							<center><h5>OR</h5></center>
							<span id="contact_notification">
							<?php
							if(isset($_GET['con_err'])) {
								if($_GET['con_err'] == '0') {
									echo "<div class='alert alert-success'>Email sent successfully.</div>";
								} else if($_GET['con_err'] == '1') {
									echo "<div class='alert alert-danger'>Email not sent. Try again.</div>";
								}
							}
							?>
							</span>
							<div style="padding-left:20px;">
							<form name="contact_form" id="contact_form" method="POST" action="product_contact.php">
								<fieldset>
									<input type="hidden" name="pid" id="contact_id" value="<?php echo $product['Post_id']; ?>">
									<input type="hidden" name="ptitle" id="contact_title" value="<?php echo $product['Post_title']; ?>">
									<input type="hidden" name="remail" id="contact_r_email" value="<?php echo $user['user_email']; ?>" >
									<textarea rows="5" name="message" id="contact_message" required></textarea>
									<input type="text" name="name" id="contact_name" placeholder="Full Name" required>
									<input type="email" name="semail" id="contact_s_email" placeholder="Email" required>
									<input type="tel" name="phone" id="contact_phone" placeholder="Phone (Optional)">
									<br>
									<button type="submit" class="btn btn-primary">Reply</button>
								</fieldset>
							</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="span8">
						<?php
						include_once "product_similar_post.php";
						?>
						<?php
						include_once "product_similar_seller.php";
						?>
					</div>
					<div class="span4">
					<br>
				<center><img src="img/ad1.jpg" border="1" style="width:300px; height:250px; border: 1px;"></center>
				<br />

				<br />
					</div>
				</div>
			</div>
		</div>
		<!-- Body End -->
	</div>
<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
	
	<script type="text/javascript">stLight.options({publisher: "a7a09e22-a4ef-4ea8-9279-52204fbad195", doNotHash: false, doNotCopy: false, hashAddressBar: true});</script>
<script>
var options={ "publisher": "a7a09e22-a4ef-4ea8-9279-52204fbad195", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "pinterest", "email"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>
</body>
</html>