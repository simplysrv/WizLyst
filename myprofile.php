<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();
if(!isset($_SESSION['umail'])){
	header('Location: index.php');
}
$user_details = getUserDetailsByEmail($_SESSION['umail']);
$user = mysqli_fetch_array($user_details);
$uid = $user['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<!----------------------------------------
	Created by: Saurav Majumder
	All Rights Reserved to Wizlyst.com
------------------------------------------>
<head>
	<title>My Account - 
	<?php 
	if($user['user_type'] == "individual"){
		echo $user['user_fname']." ".$user['user_lname']; 
	}else{
		echo $user['user_cname'];
	}
	?>
	</title>
	
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
	
	<script>
	$(document).ready(function(){
	
		$("#edit_info").submit(function(){
		
			var type = $("#edit_type").val();
		
			if(type == "individual"){
				var fname = $("#edit_f_name").val();
				var lname = $("#edit_l_name").val();
				if(fname == "" || lname == ""){
					$("#edit_notification").html("<div class='alert alert-danger'>First/Last name cannot be empty.</div>");
					return false;
				}
			}else if(type == "company"){
				var cname = $("#edit_c_name").val();
				if(cname == ""){
					$("#edit_notification").html("<div class='alert alert-danger'>Company name cannot be empty.</div>");
					return false;
				}
			}
		});
		
		$("#conf_pass_form").submit(function(){
		
			var cpass = $("#conf_pass_curr_pass").val();
			var npass = $("#conf_pass_new_pass").val();
			var dpass = $("#conf_pass_copy_pass").val();
		
			if(cpass == "" || npass == "" || dpass == ""){
				$("#conf_pass_notification").html("<div class='alert alert-danger'>All the fields are required.</div>");
				return false;
			}
			
			if(npass != dpass){
				$("#conf_pass_notification").html("<div class='alert alert-danger'>New Password and Confirm Password didn't match.</div>");
				return false;
			}
		});
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
		<?php
			if(isset($_GET['resetpass'])){
				if($_GET['resetpass'] == 0){
		?>
			<div class='alert alert-success'><button type="button" class="close" data-dismiss="alert">&times;</button>Password Reset Successful</div>
		<?php
				}elseif($_GET['resetpass'] == 1){
		?>
			<div class='alert alert-danger'><button type="button" class="close" data-dismiss="alert">&times;</button>New Password & Confirm Password didn't match</div>
		<?php
				}elseif($_GET['resetpass'] == 2){
		?>
			<div class='alert alert-danger'><button type="button" class="close" data-dismiss="alert">&times;</button>Password Reset Failed. Please try again.</div>
		<?php
				}
			}
		?>
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
					$post_count = countPost($uid);
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
						<br>
  						<a class="btn btn-success" href="post.php" title="Sell your product" >Post New Ad</a>
						<div class="btn-group">
  							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-cog"></i> Settings
    							<span class="caret"></span>
  							</a>
  							<ul class="dropdown-menu">
    							<li><a data-toggle="modal" href="#message" title="Edit Personal Information" >Edit Info</a></li>
    							<li><a data-toggle="modal" href="#con_pass" title="Reset Existing Password" >Reset Password</a></li>
    							<li><a href="logout.php" title="Logout" >Logout</a></li>
  							</ul>
						</div>
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
			<div class="span3">				
 					<div class="thumbnail-header">
						<span class="cat_header">Updates</span> 
					</div>
					<table class="table table-striped" cellpadding="10" cellspacing="0">
						<tr>
							<td>Posts</td><td><?php echo countPost($uid); ?></td>
						</tr>
						<tr>
							<td>View</td><td><?php echo countView($uid); ?></td>
						</tr>
						<tr>
							<td>Followers</td><td><?php echo countFollower($uid); ?></td>
						</tr>
						<tr>
							<td>Following</td><td><?php echo countFollowing($uid); ?></td>
						</tr>
					</table>
			</div>
			<div class="span9">				
 					<div class="thumbnail-header">
						<span class="cat_header">Overview</span> 
					</div>
					<img alt="overview" title="Graphical Overview Coming Soon" src="img/chart_sample.jpg" style="width: 100%; height: 100%">
			</div>
		</div>
		<div class="row">
			<div class="span12">				
 					<div class="thumbnail-header">
						<span class="cat_header">My Posts</span> 
					</div>
					<table class="category_table" cellpadding="10" cellspacing="0">   
					<?php
						$post = getUserPost($uid);
						$counter = 4;
						
						if(countPost($uid) < 1) {
							echo "<center><h3>No post found!</h3><h2><small>Millions of buyers are waiting for you.</small></h2>
							<a class=\"btn btn-success\" href=\"post.php\" title=\"Sell your product\" >Post New Ad</a>
							</center>";
						}

						while($row = mysqli_fetch_array($post)){
							$title = substr($row['Post_title'], 0, 35);
							if(strlen($row['Post_title']) > 35){
								$title = $title."...";
							}
							
							if($counter == 4){
								echo "<tr>";
							}
					?>  
			            <td width="20%" valign="top">

			            	<div class="category_thumbnail">
			            		<a title="<?php echo $row['Post_title']; ?>" class="pull-center" href="product.php?pid=<?php echo $row['Post_id']; ?>"><img alt="<?php echo $row['Post_title']; ?>" src="<?php echo $row['Post_img1']; ?>" style="width:100%; height:150px" class="img-rounded"></a>
			           			<a href="product.php?pid=<?php echo $row['Post_id']; ?>" title="<?php echo $row['Post_title']; ?>"><?php echo $title; ?></a>	
			           			
			           			<?php  	
			           				if($row['Post_isapproved'] == '1') {
		           				?>
  									<span class="label label-success">Approved!</span>
								<?php
		           					} else {
			           			?>
			           				<span class="label label-warning">Pending Approval</span>
		           				<?php
		           					}
	           					?>
	           					
			           			<span class="pull-right">
									<ul class="nav nav-pills">
  										<li class="dropdown">
    										<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i>
    										<b class="caret"></b>
											</a>
    										<ul class="dropdown-menu">
												<li><a title="Re-post your ad" href="repost.php?pid=<?php echo $row['Post_id']; ?>">Repost</a></li>
    											<li><a title="Preview your ad" target="_blank" href="product.php?pid=<?php echo $row['Post_id']; ?>">Preview</a></li>
				    							<li><a title="Delete your ad" href="postDelete.php?pid=<?php echo $row['Post_id']; ?>">Delete</a></li>
    										</ul>
										</li>
									</ul>
			           			</span>
			           			<br>
			           			<br/>
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
			</div>
		</div>
	</div>
<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
		
<!--  Message Seller Box Start  -->
<div id="message" class="modal hide fade in" style="display: none; ">  
<div class="modal-header">  
<h3>Update Personal Information</h3>  
</div>  
<div class="modal-body">  
<span id="edit_notification"></span>
<form class="form-horizontal" method="POST" name="edit_info" id="edit_info" action="updateUser.php">
	<input type="hidden" name="edit_uid" id="edit_uid" value="<?php echo $user['user_id']; ?>" >
  <fieldset>
	<div class="control-group">
		<label class="control-label" for="edit_type">Account Type</label>
		<div class="controls">
			<input type="text" id="edit_type"  name="edit_tye" value="<?php echo $user['user_type']; ?>" disabled>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_f_name">First Name</label>
		<div class="controls">
			<input type="text" id="edit_f_name"  name="edit_f_name" value="<?php echo $user['user_fname']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_l_name">Last Name</label>
		<div class="controls">
			<input type="text" id="edit_l_name"  name="edit_l_name" value="<?php echo $user['user_lname']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_c_name">Company Name</label>
		<div class="controls">
			<input type="text" id="edit_c_name"  name="edit_c_name" value="<?php echo $user['user_cname']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_address">Address</label>
		<div class="controls">
			<input type="text" id="edit_address"  name="edit_address" value="<?php echo $user['user_address']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_phone">Phone</label>
		<div class="controls">
			<input type="tel" id="edit_phone"  name="edit_phone" value="<?php echo $user['user_phone']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_email">Email</label>
		<div class="controls">
			<input type="text" id="edit_email"  name="edit_email" value="<?php echo $user['user_email']; ?>" disabled>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_website">Website</label>
		<div class="controls">
			<input type="url" id="edit_website"  name="edit_website" value="<?php echo $user['user_website']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_facebook">Facebook</label>
		<div class="controls">
			<input type="url" id="edit_facebook"  name="edit_facebook" value="<?php echo $user['user_facebook']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_twitter">Twitter</label>
		<div class="controls">
			<input type="url" id="edit_twitter"  name="edit_twitter" value="<?php echo $user['user_twitter']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_linkedin">Linkedin</label>
		<div class="controls">
			<input type="url" id="edit_linkedin"  name="edit_linkedin" value="<?php echo $user['user_linkedin']; ?>" >
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="edit_gplus">Google+</label>
		<div class="controls">
			<input type="url" id="edit_gplus"  name="edit_gplus" value="<?php echo $user['user_gplus']; ?>" >
		</div>
	</div>
  </fieldset>              
</div>  
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Update</button> 
<a href="#" class="btn" data-dismiss="modal">Close</a> 
</form>  
</div>  
</div> 
<!--  Message Seller Box End  -->


<div id="con_pass" class="modal hide fade in" style="display: none; ">  
<div class="modal-header">  
<h3>Reset Password</h3>  
</div>  
<div class="modal-body">  
<span id="conf_pass_notification"></span>
<form class="form-horizontal" method="POST" name="conf_pass_form" id="conf_pass_form" action="updatePassword.php">
	<input type="hidden" name="conf_pass__uid" id="conf_pass__uid" value="<?php echo $user['user_id']; ?>" >
  <fieldset>
	<div class="control-group">
		<label class="control-label" for="conf_pass_curr_pass">Current Password</label>
		<div class="controls">
			<input type="password" id="conf_pass_curr_pass"  name="conf_pass_curr_pass">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="conf_pass_new_pass">New Password</label>
		<div class="controls">
			<input type="password" id="conf_pass_new_pass"  name="conf_pass_new_pass">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="conf_pass_copy_pass">Confirm New Password</label>
		<div class="controls">
			<input type="password" id="conf_pass_copy_pass"  name="conf_pass_copy_pass">
		</div>
	</div>
  </fieldset>              
</div>  
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Update</button> 
<a href="#" class="btn" data-dismiss="modal">Close</a> 
</form>  
</div>  
</div> 


</body>
</html>