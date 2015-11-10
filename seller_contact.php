<?php
include_once "email.php";

$r_email = $_POST['remail'];
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

//echo "Receiver's Email: ".$r_email."<br />Name: ".$name."<br />Sender's Email: ".$email."<br />Message: ".$message;

$send_email = contactSellerFromProfile($r_email,$message,$name,$email);
if($send_email) { 
	echo "<div class='alert alert-success'>Email sent successfully.</div>";
} else {
	echo "<div class='alert alert-danger'>Email not sent. Try again.</div>";
}

?>