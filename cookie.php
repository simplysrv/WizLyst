<?php
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

if(!isset($_COOKIE["fbidentifier"])){
	$client_ip = $_SERVER['REMOTE_ADDR'];
	$date = date_create();
	$timestamp = date_timestamp_get($date);
	$cookie_identifier = $timestamp."_".$client_ip;
	
	$expire=time()+60*60*24*30;
	setcookie("fbidentifier", $cookie_identifier, $expire);
	
	$result = addCookieIdentifier($cookie_identifier);
}else{
	$cookie_identifier = $_COOKIE["fbidentifier"];
}
?>