<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();

$email = $_POST['email'];
$pass = $_POST['pass'];
$result = signIn($email, $pass);

if($result > 0){

	$_SESSION['umail'] = $email;
	
	$user_details = getUserDetails($result);
	$user = mysqli_fetch_array($user_details);
?>
<div class="alert alert-success" id="login-success">
<strong>Well Done!</strong> You are logged in successfully!
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
<h3>Existing User</h3>
<span id="post_sign_in">
<span id ="post_sign_in_notification">
<div class="alert alert-error">
<strong>Error!</strong> Wrong username/password
</div>
</span>
<form name="post_sign_in" method="POST" action="#">
<fieldset>
	<input name="signIn_email" type="email" id="signIn_email" placeholder="Email" required>
	<input name="signIn_password" type="password" id="signIn_password" placeholder="Password" required>
	<br />
	<button type="submit" class="btn btn-primary" onclick="post_signIn(); return false;">Sign In</button>
</fieldset>
</form>
</span>
<?php
}
?>