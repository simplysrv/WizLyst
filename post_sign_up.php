<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";

// Retrieving input values
$type = $_POST['type'];
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$c_name = $_POST['c_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$url = $_POST['url'];
$tc = $_POST['tc'];
$newsletter = $_POST['newsletter'];

//echo $type." - ".$f_name." - ".$l_name." - ".$c_name." - ".$email." - ".$password." - ".$address." - ".$phone." - ".$url." - ".$tc." - ".$newsletter;

$result = signUp($type, $f_name, $l_name, $c_name, $email, $password, $address, $phone, $url, $newsletter);

if($result){
	$_SESSION['umail'] = $email;
	
	$user_details = getUserDetailsByEmail($email);
	$user = mysqli_fetch_array($user_details);
?>
<div class="alert alert-success" id="login-success">
<strong>Well Done!</strong> You are signed up successfully!
<br><br>
<p>
	<strong>User ID:</strong> <span id="User_id"><?php echo $user['user_id']; ?></span>
	<br>
	<strong>Name:</strong> 
	<?php 
	if($user['user_type'] == "individual"){
		echo $user['user_fname']." ".$user['user_lname']; 
	}else{
		echo $user['user_cname'];
	}
	?> 
	<br>
	<strong>Phone:</strong> <?php echo $user['user_phone']; ?>
	<br>
	<strong>Email: </strong> <?php echo $user['user_email']; ?>
</p>
</div>
<?php
}else{
?>
<span id="post_sign_up_notification">
<div class="alert alert-error">
<strong>Error!</strong> You have signed up unsuccessful!
<br>
</div>
</span>
<form name="post_sign_up" method="POST" action="#">
<fieldset>
		<label>I am</label>
		<label class="radio">
		<input type="radio" name="user_type" id="individual" value="individual" checked>
		Individual
		</label>
		<label class="radio">
		<input type="radio" name="user_type" id="company" value="company">
		Company
		</label>

		<span id="ind">
			<div class="controls controls-row">
				<input class="span2" name="post_sign_up_first_name" id="post_sign_up_first_name" type="text" placeholder="First Name" />
				<input class="span2" name="post_sign_up_last_name" id="post_sign_up_last_name" type="text" placeholder="Last Name" />
			</div>
		</span>

		<span id="co">
			<input class="span4" name="post_sign_up_company_name" id="post_sign_up_c_name" type="text" placeholder="Company Name">
		</span>

		<input class="span4" name="post_sign_up_Email" id="post_sign_up_Email" type="email" placeholder="Email" required />

		<div class="controls controls-row">
			<input class="span2" name="post_sign_up_Password" id="post_sign_up_Password" type="password" placeholder="Password" placeholder="Confirm Password" required />
			<input class="span2" name="post_sign_up_conf_Password" id="post_sign_up_conf_Password" type="password" required />
		</div>
	
		<input class="span4" name="post_sign_up_Address" id="post_sign_up_Address" type="text" placeholder="Address" />
		<input class="span4" name="post_sign_up_Phone" id="post_sign_up_Phone" type="tel" placeholder="Phone Number" />
		<input class="span4" name="post_sign_up_Website" id="post_sign_up_Website" type="url" placeholder="Website URL" />
		<label class="checkbox">
		<input name="Tc" id="Tc" type="checkbox"> I agree to terms & conditions
		</label>
		<label class="checkbox">
		<input name="Newsletter" id="Newsletter" type="checkbox" value="1"> I would like to receive updates & newsletters
		</label>
		<br />
		<button type="button" class="btn btn-success" onclick="post_signUp();">Sign Up</button>
</fieldset>
</form>
<?php
}
?>