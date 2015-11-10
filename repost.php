<?php
include_once "dbinfo.inc.oop.php";
	
$pid = $_GET['pid'];
if($pid == ""){
	header('Location: myprofile.php');
}

$repost = repost($pid);
if($repost){
	header('Location: myprofile.php?success');
}else{
	header('Location: myprofile.php?error');
}
?>