<?php
include_once "dbinfo.inc.oop.php";

$myId = $_POST['myId'];
$othersId = $_POST['othersId'];

$result = follow($myId, $othersId);
if($result){
	echo '1';
}else{
	echo '-1';
}
?>