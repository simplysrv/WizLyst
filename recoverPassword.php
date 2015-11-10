<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
include_once "email.php";

$email = $_POST['email'];
$result = getUserDetailsByEmail($email);
$count = mysqli_num_rows($result);

if($count > 0) {
	$user = mysqli_fetch_array($result);
	$new_password = randomPassword();
	$result2 = recovPassword($user['user_id'], $new_password);
	if($result && passwordRecoveryEmail($email, $new_password)){
?>
<div class='alert alert-success'>Your password has been sent to <strong><?php echo $email; ?></strong>.</div>

<?php
	}else{
?>
<span id="recov_pass_notification">
<div class='alert alert-danger'>Internal Error Occured. Try Again.</div>
</span>
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
<?php
	}
} else {
?>
<span id="recov_pass_notification">
<div class='alert alert-danger'>No account is there with this email.</div>
</span>
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
<?php
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>