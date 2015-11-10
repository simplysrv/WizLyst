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
	<title>Wizlyst - Contact</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

	<meta name="description" content="">
	<meta name="keywords" content="">

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
		$("#contact_form").submit(function(){
			var name = $('#contact_name').val();
			var email = $('#contact_email').val();
			var topic = $('#contact_topic').val();
			var subject = $('#contact_subject').val();
			var message = $('#contact_msg').val();
			
			var error_flag = 0;
			var error_msg = "<ul>";
			
			if(name == "" || email == "" || topic == "" || subject == "" || message == "") {
				error_flag = 1;
				error_msg += "<li>One or more required fields are empty.</li>";
			}
	
			if(email != "" && !IsEmail(email)){
				error_flag = 1;
				error_msg += "<li>Email is invalid.</li>";
			}
			
			if(error_flag == 1) {
				error_msg += "</ul>";
				$("#contact_notification").html("<div class='alert alert-danger'>"+error_msg+"</div>");
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
		<div class="thumbnail-header">
			<span class="cat_header">Contact Wizlyst</span>
		</div>
		<br />
		<!-- Block Start -->
        <div id="contact_us">
          <div class="thumbnail deal_feed"> 
			<span id="contact_notification">
			<?php
				if($_GET['contact'] == 1) {
					echo "<div class='alert alert-success'>Thank you for contacting us. We will get back to you soon.</div>";
				} else if($_GET['contact'] == 2) {
					echo "<div class='alert alert-danger'>One or more fields are invalid or empty.</div>";
				} else if($_GET['contact'] == 3) {
					echo "<div class='alert alert-danger'>Internal Problem. Please try again.</div>";
				}
			?>
			</span>
              <br/>
              <form class="form-horizontal" method="POST" name="contact_form" id="contact_form" action="contact_submit.php">
                <fieldset>
                <div class="control-group">
                  <label class="control-label" for="topic">Topic</label>
                  <div class="controls">
                    <select id="contact_topic" name="topic" required>
						<option selected value="Advertising Related">Advertising Related</option>
						<option value="Account Related">Account Related</option>
						<option value="Ad Approval Related">Ad Approval Related</option>
						<option value="Ad Options">Ad Options</option>
						<option value="General Feedback">General Feedback</option>
						<option value="Spam/Abuse Complaints">Spam/Abuse Complaints</option>
						<option value="Suggestion">Suggestion</option>
						<option value="Others">Others</option>
                    </select>
                  </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="subject">Subject</label>
                    <div class="controls">
                      <input type="text" id="contact_subject"  name="subject" placeholder="Type your subject here" required>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="message">Message</label>
                    <div class="controls">
                      <textarea rows="3" col="90" id="contact_msg" name="message" required></textarea>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls">
                      <input type="text" id="contact_name"  name="name" placeholder="Type your name here" required>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                      <input type="email" id="contact_email"  name="email" placeholder="Type your email address here" required>
                    </div>
                  </div>  
				  <div class="control-group">
                    
                    <div class="controls">
                       <button type="submit" class="btn btn-success">Submit</button> 
                    </div>
                  </div> 
                </fieldset>           
              </form>  
          </div> 
        </div>
        <!-- Block End -->
		<br />
	</div>
		<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
</body>
</html>