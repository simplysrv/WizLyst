<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();

$email = $_POST['email'];
$pass = $_POST['password'];
$remember = $_POST['remember'];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	header('Location: index.php?logerr=2');
}

$result = signIn($email, $pass);

if($result > 0){
	
	if($remember == "on") {
		setcookie("fbmail", $email);
		setcookie("fbpass", $pass);
	}

	$user_details = getUserDetails($result);
	$user = mysqli_fetch_array($user_details);
	$_SESSION['umail'] = $user['user_email'];
	header('Location: myprofile.php');
}else{
	header('Location: index.php?logerr=1');
}
?>