<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();

$error_flag = 0;
$error_msg = "<ul>";

// Retrieving input values
$type = $_POST['sign_up_user_type'];
$f_name = $_POST['sign_up_f_name'];
$l_name = $_POST['sign_up_l_name'];
$c_name = $_POST['sign_up_c_name'];
$email = $_POST['sign_up_email'];
$password = $_POST['sign_up_password'];
$password_check = $_POST['sign_up_conf_password'];
$address = $_POST['sign_up_address'];
$phone = $_POST['sign_up_phone'];
$url = $_POST['sign_up_website'];
$tc = $_POST['sign_up_tc'];
$newsletter = $_POST['sign_up_newsletter'];

if ($type == "individual") {
	if($f_name == "" || $l_name == ""){
		$error_flag = 1;
		$error_msg = $error_msg."<li>First/Last Name field is empty.</li>";
	}
}elseif ($type == "company") {
	if($c_name == ""){
		$error_flag = 1;
		$error_msg = $error_msg."<li>Company Name field is empty.</li>";
	}
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$error_flag = 1;
	$error_msg = $error_msg."<li>Invalid email address.</li>";
}

if($password == "" || $password_check == "" || $password != $password_check){
	$error_flag = 1;
	$error_msg = $error_msg."<li>Password does not match.</li>";
}

if($phone == "" || !is_numeric($phone)){
	$error_flag = 1;
	$error_msg = $error_msg."<li>Invalid phone number</li>";
}
		
if($tc == ""){
	$error_flag = 1;
	$error_msg = $error_msg."<li>Terms & Conditions not checked.</li>";
}
		
if($error_flag == 1){
	$error_msg = $error_msg."</ul>";
	$_SESSION['error_msg'] = $error_msg;
	header('Location: index.php?logerr=3');
}else{
	//echo $type." - ".$f_name." - ".$l_name." - ".$c_name." - ".$email." - ".$password." - ".$address." - ".$phone." - ".$url." - ".$tc." - ".$newsletter;

	$result = signUp($type, $f_name, $l_name, $c_name, $email, $password, $address, $phone, $url, $newsletter);
	if($result){
		$_SESSION['umail'] = $email;
		header('Location: myprofile.php');
	}else{
		header('Location: index.php?logerr=4');
	}
}
?>