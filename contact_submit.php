<?php
include_once "dbinfo.inc.oop.php";

$topic = $_POST['topic'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$name = $_POST['name'];
$email = $_POST['email'];

if($topic != "" && $subject != "" && $message != "" && $name != "" && $email != "") {
	$result = customerContact($topic, $subject, $message, $email, $name);
	if($result){
		header('Location: contact.php?contact=1');
	}else{
		header('Location: contact.php?contact=2');
	}
} else {
	header('Location: contact.php?contact=3');
}
?>