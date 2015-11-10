<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();
if(!isset($_GET['uid'])){
	header('Location: index.php');
}
$user_details = getUserDetails($_GET['uid']);
$u_count = mysqli_num_rows($user_details);
if($u_count < 1){
	header('Location: index.php');
}

$user = mysqli_fetch_array($user_details);
$uid = $user['user_id'];

if(isset($_SESSION['umail'])){
	$mydetails = getUserDetailsByEmail($_SESSION['umail']);
	$my = mysqli_fetch_array($mydetails);
}
$post = getUserPost($uid);
$post_count = mysqli_num_rows($post);
?>
<!DOCTYPE html>
<html lang="en">
<!----------------------------------------
	Created by: Saurav Majumder
	All Rights Reserved to Wizlyst.com
------------------------------------------>
<head>
	<title>
	<?php 
	if($user['user_type'] == "individual"){
		echo $user['user_fname']." ".$user['user_lname']; 
	}else{
		echo $user['user_cname'];
	}
	?> 
	</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

	<meta name="description" content="Looking for a job? Want to sell your house/apt? Need to hang out on Friday night, looking for a bar/club? Wizlyst.com is the place to satisfy your desires and dreams!! We are your neighborhood classifieds serving you to make your life simpler and bonding stronger. Wizlyst.com is the place where you can buy, sell, rent and exchange items within your local community and across the country.">
	
	<meta name="keywords" content="free classifieds in India, classified ads in India, Post Free Ads, online classified advertising, auto classified, classified ad posting, Musical Instruments sale, business classifieds, employment classifieds, online classifieds, Matrimonial classified ad, real estate classified ad, rental classifieds, travel classifieds, used car classifieds, house for rent, house for sale, house rentals, sell and buy, classified ad, classified ad India, classified ad posting, classified ad sites, classified advertising, classifieds listings, books store in Kolkata, rental services Kolkata, Apartments in Kolkata, College books">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
	<script src="js/bootstrap-modal.js"></script>
	<script src="js/bootstrap-transition.js"></script>
	
	<script>
	function follow(myId,othersId){
		$.ajax({
 			type: "POST",
 			url: "follow.php",
 			data: {myId:myId, othersId:othersId}
		}).done(function( result ) {
			if(result == '1'){
				$("#follow_box").html("<button class='btn btn-small btn-success' type='button'><i class='icon-ok icon-white'></i> Following</button>");
			}
		});
	}
	
	$(document).ready(function(){
		var prev = document.referrer;
		var a =prev.split("=");
		if(a[1] != ""){
			$("#post_"+a[1]+"").css({"border-width":"3px","border-color":"#000"});
		}
		
		$("#message_seller").submit(function(){
			var remail = $("#ms_remail").val();
			var name = $("#ms_name").val();
			var email = $("#ms_email").val();
			var message = $("#ms_message").val();
			
			if(remail == "" || name == "" || email == "" || message == "") {
				$("#message_seller_notification").html("<div class='alert alert-danger'>One or more required field is empty.</div>");
				return false;
			}
			
			if(!IsEmail(email)) {
				$("#message_seller_notification").html("<div class='alert alert-danger'>Invalid email.</div>");
				return false;
			}
			
			$.ajax({
			type: "POST",
			url: "seller_contact.php",
			data: {remail:remail, name:name, email:email, message:message}
			}).done(function( result ) {
				$("#message_seller_body").html( result );
			});
			return false;
		});
	});
	
	function IsEmail(email) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
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
		<!-- Body Star -->	
		<div class="row">
			<div class="thumbnail span12">
				<legend><span style="padding-left:10px;">
				<?php 
				if($user['user_type'] == "individual"){
					echo $user['user_fname']." ".$user['user_lname']; 
				}else{
					echo $user['user_cname'];
				}
				?> 
				<?php
					if($post_count > 20){
						echo "<img src='img/award_star_gold.png' class='pull-right' title='Gold Member'/>";
					}elseif($post_count > 10){
						echo "<img src='img/award_star_silver.png' class='pull-right' title='Silver Member'/>";
					}elseif($post_count > 5){
						echo "<img src='img/award_star_bronze.png' class='pull-right' title='Bronze Member'/>";
					}
				?>
				</span></legend>
				<table class="category_table" cellpadding="10" cellspacing="0">   
          		<tr>
          			<td width="60%" valign="top">
          				<strong>Address: </strong><?php echo $user['user_address']; ?>
          				<br>
						<strong>Phone: </strong><?php echo $user['user_phone']; ?>
          				<br />
						<span id="follow_box">
						<?php
						if(isset($_SESSION['umail']) && $uid != $my['user_id']){
							$following = checkfollow($my['user_id'], $uid);
							if($following){
								echo "<button class='btn btn-small btn-success' type='button'><i class='icon-ok icon-white'></i> Following</button>";
							}else{
						?>
							<button onclick="follow(<?php echo $my['user_id']; ?>,<?php echo $uid; ?>);" class="btn btn-small btn-primary" type = "button" title="Follow Seller" >Follow</button>
						<?php
							}
						}elseif(!isset($_SESSION['umail']) && $uid != $my['user_id']){
						?>
							<button class="btn btn-small  btn-primary" type="button" title="Sign In or Sign Up to start following" disabled>Login/Register to Follow</button>
						<?php
							}
						?>
						</span>
      				 	<a class="btn btn-small  btn-primary" data-toggle="modal" href="#message" title="Contact seller instantly" >Instant Message</a>
		            </td> 
		            <td width="40%" valign="top" style="border-left: 1px solid #e5e5e5;">
		            	<strong>Email: </strong><?php echo $user['user_email']; ?>
		            	<br>
		            	<strong>Website: </strong><a href="<?php echo $user['user_website']; ?>"><?php echo $user['user_website']; ?></a>
		            	<br>
		            	<div class="pull-right">
							<a title="Facebook Account" href="<?php echo $user['user_facebook']; ?>"><img alt="Facebook Link" src="img/facebook.png"></a>
							<a title="Twitter Account" href="<?php echo $user['user_twitter']; ?>"><img alt="Twitter Link" src="img/twitter.png"></a>
							<a title="LinkedIn Account" href="<?php echo $user['user_linkedin']; ?>"><img alt="LinkedIn Link" src="img/linkedin.png"></a>
							<a title="Google+ Account" href="<?php echo $user['user_gplus']; ?>"><img alt="Googleplus Link" src="img/plus.png"></a>
		            	</div>
		            </td> 
          		</tr>
          		</table>			
			</div>
		</div>
		<div class="row">
			<div class="span9">				
 					<div class="thumbnail-header">
						<span class="cat_header">Posts</span>
					</div>
					<table class="category_table" cellpadding="10" cellspacing="0">   
			          <?php
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
			            <td width="20%" valign="top">
							<div class="category_thumbnail" id="post_<?php echo $row['Post_id']; ?>" style="height: 230px;">
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
			<div class="span3">
				<br />
				<center><img src="img/ad1.jpg" border="1" style="width:300px; height:250px; border: 1px;"></center>
				<br />
			</div>
		</div>
		<!-- Body End -->
	</div>
		<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->

<!--  Message Seller Box Start  -->
<div id="message" class="modal hide fade in" style="display: none; ">  
<div class="modal-header">  
<h3>Message</h3>  
</div>  
<div class="modal-body" id="message_seller_body">
<span id="message_seller_notification"></span>  
<form class="form-horizontal" method="POST" name="message_seller" id="message_seller" action="">
  <fieldset>
	<div class="control-group">
		<label class="control-label" for="name">Full Name</label>
		<div class="controls">
			<input type="text" id="ms_name"  name="name" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<input type="email" id="ms_email"  name="email" >
		</div>
	</div>	
	<div class="control-group">
		<label class="control-label" for="message">Message</label>
		<div class="controls">
			<textarea rows="5" id="ms_message" name="message" ></textarea>
		</div>
	</div>
	<input type="hidden" id="ms_remail" name="remail" value="<?php echo $user['user_email']; ?>" >
  </fieldset>              
</div>  
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Send</button> 
<a href="#" class="btn" data-dismiss="modal">Close</a> 
</form>  
</div>  
</div> 
<!--  Message Seller Box End  -->

</body>
</html>