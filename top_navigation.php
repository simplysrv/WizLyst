<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43945704-1', 'wizlyst.com');
  ga('send', 'pageview');

</script>

<script type="text/javascript">
function setCookie(c_name,value,exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function setCity(city_name,loc_type){
	
	setCookie('fbcity',city_name,365);
	if(loc_type == "country"){
		setCookie('fblocType','',365);
	}else{
		setCookie('fblocType',loc_type,365);
	}
	
	window.location = location.href;
	
	//$("#city-name").html(city_name);
	//$(".city-box").slideToggle("fast");
}

$(document).ready(function(){

	<?php
	if (isset($_COOKIE["fbcity"])){
	?>
	$(".city-box").hide();
	<?php
	}
	?>
	
	$(".top-city-box").click(function(){
		$(".city-box").slideToggle("fast");
	});
	
	$("#city-search-btn").click(function(){
		var location = $("#searchTextField").val();
		var item = location.split(",");
		var len = item.length;
		var city = item[len - 3];
		
		setCookie('fbcity',city,365);
		window.location = "index.php";
		
		//$("#city-name").html(city);
		//$(".city-box").slideToggle("fast");
	});
	
	var val = $('input:radio[name=sign_up_user_type]:checked').val();
	if (val == "individual") {
		$("#top_co").hide();
		$("#top_ind").show();
	}else if (val == "company") {
		$("#top_ind").hide();
		$("#top_co").show();
	}

    $("input:radio[name=sign_up_user_type]").click(function(){
		var val = $('input:radio[name=sign_up_user_type]:checked').val();
		if (val == "individual") {
			$("#top_co").hide();
			$("#top_ind").show();
		}else if (val == "company") {
			$("#top_ind").hide();
			$("#top_co").show();
		}
    });
	
	$("#sign_in").submit(function(){
		var email = $('#email').val();
		var password = $('#password').val();
		
		if(!IsEmail(email)){
			$("#sign_in_notification").html("<div class='alert alert-danger'>Invalid Email</div>");
			return false;
		}
    });
	
	$("#sign_up").submit(function(){
		
		$("#sign_up_notification").html("<center><img src='img/validating.gif' /></center>");
		
		var error_flag = 0;
		var error_msg = "<ul>";

		var val = $('input:radio[name=sign_up_user_type]:checked').val();
		
		if (val == "individual") {
			var fname = $('#sign_up_f_name').val();
			var lname = $('#sign_up_l_name').val();

			if(fname == "" || lname == ""){
				error_flag = 1;
				error_msg = error_msg + "<li>First/Last Name field is empty.</li>";
			}
		}else if (val == "company") {
			var cname = $('#sign_up_c_name').val();
			if(cname == ""){
				error_flag = 1;
				error_msg = error_msg + "<li>Company Name field is empty.</li>";
			}
		}
		
		var email = $('#sign_up_email').val();
		
		if(!IsEmail(email)){
			error_flag = 1;
			error_msg = error_msg + "<li>Invalid email address.</li>";
		}
		
		var pass = $('#sign_up_password').val();
		var pass_check = $('#sign_up_conf_password').val();
		
		if(pass == "" || pass_check == "" || pass != pass_check){
			error_flag = 1;
			error_msg = error_msg + "<li>Password does not match.</li>";
		}
		
		var phone = $('#sign_up_phone').val();
		
		if(phone == "" || !isNumber(phone)){
			error_flag = 1;
			error_msg = error_msg + "<li>Invalid phone number</li>";
		}
		
		if(!$('#sign_up_tc').is(':checked')){
			error_flag = 1;
			error_msg = error_msg + "<li>Terms & Conditions not checked.</li>";
		}
		
		if(error_flag == 1){
			error_msg = error_msg + "</ul>";
			$("#sign_up_notification").html("<div class='alert alert-danger'>"+error_msg+"</div>");
			return false;
		}
    });
	
	$("#recov_pass_form").submit(function(){
		var pemail = $("#recov_pass_email").val();
		if(pemail == "" || !IsEmail(pemail)){
			$("#recov_pass_notification").html("<div class='alert alert-danger'>Invalid Email</div>");
			return false;
		}
		
		$("#recov_pass_body").html("<br><br><center><img src='img/loading.gif' /></center><br><br>");

		$.ajax({
			type: "POST",
			url: "recoverPassword.php",
			data: {email:pemail}
		}).done(function( result ) {
			$("#recov_pass_body").html( result );
		});
		return false;
	});	

});
  
function IsEmail(email) {
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
</script>

<div class="row">
			<div class="span12">
			<div class="top-city-box"><span id="city-name">
			<?php
				if (isset($_COOKIE["fbcity"]) && isset($_COOKIE["fblocType"])){
					echo $_COOKIE["fbcity"];
				}else{
					echo "India";
				}
			?>
			</span> <i class="icon-chevron-down pull-right icon-white"></i></div>
				<ul class="nav nav-pills pull-right">
				
					<?php
						if(!isset($_SESSION['umail'])){
					?>
  					<li class="dropdown">
    					<a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Create your account to start selling">
        					Sign Up
      					</a>
    					<div class="dropdown-menu" id="sign_up_box" style="padding: 20px 20px;">
						<span id="sign_up_notification">
						<?php
							if(isset($_GET['logerr']) && $_GET['logerr'] == 3){
								echo "<div class='alert alert-danger'>".$_SESSION['error_msg']."</div>";
							}
						?>
						</span>
							<form name="sign_up" id="sign_up" method="POST" action="sign_up.php">
					<fieldset>
                      <label>I am</label>
                      <label class="radio">
                    <input type="radio" name="sign_up_user_type" id="individual" value="individual" checked>
                    Individual
                    </label>
                    <label class="radio">
                    <input type="radio" name="sign_up_user_type" id="company" value="company">
                      Company
                    </label>

                    <span id="top_ind">
                      <div class="controls controls-row">
                          <input class="span2" name="sign_up_f_name" id="sign_up_f_name" type="text" placeholder="First Name" />
                          <input class="span2" name="sign_up_l_name" id="sign_up_l_name" type="text" placeholder="Last Name" />
                      </div>
                    </span>

                    <span id="top_co">
                      <input class="span4" name="sign_up_c_name" id="sign_up_c_name" type="text" placeholder="Company Name">
                    </span>

                    <input class="span4" name="sign_up_email" id="sign_up_email" type="email" placeholder="Email" required />

                    <div class="controls controls-row">
                      <input class="span2" name="sign_up_password" id="sign_up_password" type="password" placeholder="Password" required />
                      <input class="span2" name="sign_up_conf_password" id="sign_up_conf_password" type="password" placeholder="Confirm Password" required />
                    </div>
                  
                    <input class="span4" name="sign_up_address" id="sign_up_address" type="text" placeholder="Address" />
                    <input class="span4" name="sign_up_phone" id="sign_up_phone" type="tel" placeholder="Phone Number" required />
                    <input class="span4" name="sign_up_website" id="sign_up_website" type="url" placeholder="Website URL" />
                    <label class="checkbox">
                    <input name="sign_up_tc" id="sign_up_tc" type="checkbox"> I agree to terms & conditions
                      </label>
                      <label class="checkbox">
                      <input name="sign_up_newsletter" id="sign_up_newsletter" type="checkbox" checked> I would like to receive updates & newsletters
                      </label>
                    <br />
                    <button type="submit" class="btn btn-success" onclick="signUp(); return false;">Sign Up</button>
                  </fieldset>
                </form>
    					</div>
  					</li>

            <li class="dropdown">
              <a class="dropdown-toggle" id="sign_in_toggle" data-toggle="dropdown" href="#" title="Sign in to your account" >
                  Sign In
                </a>
              <div class="dropdown-menu" style="padding: 20px 20px;">
				<span id="sign_in_notification">				
				</span>
              <form name="sign_in" id="sign_in" method="POST" action="sign_in.php">
                  <fieldset>
                  <input name="email" type="email" id="email" placeholder="Email" value="<?php echo $_COOKIE['fbmail']; ?>" required>
                  <input name="password" type="password" id="password" placeholder="Password" value="<?php echo $_COOKIE['fbpass']; ?>" required>
                    <label class="checkbox">
                    <input name="remember" id="remember" type="checkbox"> Remember Me
                    </label>
                  <button type="submit" class="btn btn-primary">Sign In</button>
                  </fieldset>
                </form>
                <center><a data-toggle="modal" href="#recov_pass" title="Recover Password" >Forgot Password</a></center>
              </div>
            </li>
			<?php
			}else{
			?>
			<li><a href="myprofile.php" title="My Account" ><strong><?php echo $_SESSION['umail']; ?></strong></a></li>
			<li><a href="myprofile.php" title="My Account" >My Account</a></li>
			<li><a href="logout.php" title="Logout" >Logout</a></li>
			<?php
			}
			?>
			<li><a href="contact.php" title="Customer Support" >Customer Support</a></li>
            <li><a href="index.php" title="Home" >Home</a></li>
            <li><a href="" title="India" ><img src="img/in.png"></a></li>
				</ul>
			</div>
		</div>
		<?php
			if(isset($_GET['logerr'])){
		?>
			<div class='alert alert-danger'><button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php
				if($_GET['logerr'] == 1){
		?>
			<strong>Sign-In Failed!</strong> Incorrect Email or Password
		<?php
				}elseif($_GET['logerr'] == 2){
		?>
			<strong>Sign-In Failed!</strong> Invalid Email
		<?php
				}elseif($_GET['logerr'] == 3){
		?>
			<strong>ERROR</strong> Sign-Up Failed. Please try again
		<?php
				}elseif($_GET['logerr'] == 4){
		?>
			<strong>ERROR</strong> Sign-Up Failed. Please try again
		<?php
				}
		?>
			</div>
		<?php
			}
		?>
<div id="recov_pass" class="modal hide fade in" style="display: none; ">  
<div class="modal-header">  
<h3>Recover Password</h3>  
</div>  
<div class="modal-body" id="recov_pass_body">  
<span id="recov_pass_notification"></span>
Please enter the email address you used to sign up / post ad on FlickBazar. We will email you the password.
<form class="form-horizontal" method="POST" name="recov_pass_form" id="recov_pass_form" action="">
  <fieldset>
	<div class="control-group">
		<label class="control-label" for="recov_pass_email">Email</label>
		<div class="controls">
			<input type="text" id="recov_pass_email"  name="recov_pass_email">
		</div>
	</div>
  </fieldset>              
</div>  
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Submit</button> 
<a href="#" class="btn" data-dismiss="modal">Close</a> 
</form>  
</div>  
</div> 