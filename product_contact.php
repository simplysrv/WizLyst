<?php
include_once "dbinfo.inc.oop.php";
include_once "email.php";

$product_id = $_POST['pid'];
$product_title = strip_tags($_POST['ptitle']);
$receiver_email = strip_tags($_POST['remail']);
$message = strip_tags($_POST['message']);
$name = strip_tags($_POST['name']);
$senders_email = strip_tags($_POST['semail']);
$phone = strip_tags($_POST['phone']);

//echo "Title: ".$product_title."<br />Receiver's Email: ".$receiver_email."<br />Message: ".$message."<br />Name: ".$name."<br />Sender's Email: ".$senders_email."<br />Phone: ".$phone;

if($product_title == "" || $receiver_email == "" || $message == "" || $name == "" || $senders_email == "") {
	if($product_id != "") {
		header("Location: product.php?pid=$product_id&con_err=1");
	} else {
		header("Location: index.php");
	}
}

//$sendEmail = contactSellerFromProduct($product_title,$receiver_email,$message,$name,$senders_email,$phone);

$storeEmail = submitProductContact($product_id, $product_title, $receiver_email, $message, $name, $senders_email, $phone);

if($storeEmail) { 
	header("Location: product.php?pid=$product_id&con_err=0");
} else {
	header("Location: product.php?pid=$product_id&con_err=1");
}
?>