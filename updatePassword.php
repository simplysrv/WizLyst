<?php
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

$userId = $_POST['conf_pass__uid'];
$current_password = $_POST['conf_pass_curr_pass'];
$new_password = $_POST['conf_pass_new_pass'];
$conf_password = $_POST['conf_pass_copy_pass'];

if($userId == "" || $current_password == "" || $new_password == "" || $conf_password == ""){
	header('Location: index.php');
}

if($new_password != $conf_password){
	header('Location: myprofile.php?resetpass=1');
}

include_once "dbinfo.inc.oop.php";
$result = resetPassword($userId, $current_password, $new_password);
if($result){
	header('Location: myprofile.php?resetpass=0');
}else{
	header('Location: myprofile.php?resetpass=2');
}
?>	