<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();

$category = trim(strip_tags($_POST['category']));
//echo "Category: ".$category;
$subcategory = trim(strip_tags($_POST['subcategory']));
//echo "<br />Subcategory: ".$subcategory;
$locality = trim(strip_tags($_POST['locality']));
//echo "<br />Locality: ".$locality;
$city = trim(strip_tags($_POST['city']));
//echo "<br />City: ".$city;
$state = trim(strip_tags($_POST['state']));
//echo "<br />State: ".$state;
$country = trim(strip_tags($_POST['country']));
//echo "<br />Country: ".$country;
$price = trim(strip_tags($_POST['f_price']));
//echo "<br />Price: ".$price;
$free = trim(strip_tags($_POST['f_free']));
//echo "<br />Free: ".$free;
$negotiable = trim(strip_tags($_POST['f_negotiable']));
//echo "<br />Negotiable: ".$negotiable;
$desc = trim(strip_tags($_POST['ad_desc']));
//echo "<br />Desc: ".$desc;
$title = trim(strip_tags($_POST['ad_title']));
//echo "<br />Title: ".$title;
$uid = trim(strip_tags($_POST['form_uid']));
//echo "<br />Uid: ".$uid;

if($category == "" || $subcategory == "" || $city == "" || $state == "" || $country =="" || $title == "" || $uid == "") {
	header('Location: post.php?err=1');
}
define ("MAX_SIZE","1024");

function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

for($index = 0; $index <= 4; $index++){
	$image_name = "image".$index;
	$image = $_FILES[$image_name]['name'];

	if ($image) {
		$filename = stripslashes($_FILES[$image_name]['name']);
		$extension = getExtension($filename);
		$extension = strtolower($extension);
		
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
			$error =  1;
			$error_msg .= "<li>Image #".$index." is invalid.</li>";
		} else {
			$size=filesize($_FILES[$image_name]['tmp_name']);
			if ($size > MAX_SIZE*1024) {
				$error =  1;
				$error_msg .= "<li>Image #".$index." exceeds size limit.</li>";
			}

			$image_nm = $index."_".$user_id.'_'.time().'.'.$extension;
			$newname="Post_images/".$image_nm;
			$copied = copy($_FILES[$image_name]['tmp_name'], $newname);

			if (!$copied) {
				$error =  1;
				$error_msg .= "<li>Image #".$index." was not saved properly.</li>";
			} else {
				$ad_photo[$index] = $newname;
			}
		}
	}
}
	
if($ad_photo[0] == NULL){
	$ad_photo[0] = "Post_images/photo_not_available.jpg";
} 

$result = submitPost($category, $subcategory, $locality, $city, $state, $country, $price, $free, $negotiable, $desc, $title, $uid, $ad_photo[0], $ad_photo[1], $ad_photo[2], $ad_photo[3], $ad_photo[4]);

if($result){
	$udetails = getUserDetails($uid);
	$user = mysqli_fetch_array($udetails);
	$_SESSION['umail'] = $user['user_email'];
	header('Location: myprofile.php');
}else{
	header('Location: post.php?err=1');
}
?>