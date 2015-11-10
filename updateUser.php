<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";

$result = updateUser($_POST['edit_uid'], $_POST['edit_f_name'], $_POST['edit_l_name'], $_POST['edit_c_name'], $_POST['edit_address'], $_POST['edit_phone'], $_POST['edit_website'], $_POST['edit_facebook'], $_POST['edit_twitter'], $_POST['edit_linkedin'], $_POST['edit_gplus']);
if($result){
	header('Location: myprofile.php');
}else{
	header('Location: myprofile.php?err=1');
}
?>