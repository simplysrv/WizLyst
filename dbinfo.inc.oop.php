<?php
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

setlocale(LC_MONETARY, 'en_IN');

error_reporting(0);

class db_class{
	private $host_string = "";
	private $username = "";
	private $password = "";
	private $db_name = "";

	function connect(){
		$con = mysqli_connect($this->host_string,$this->username,$this->password,$this->db_name);
		if (mysqli_connect_errno($con)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}else{
			return $con;
		}
	}
}

//Database Connection Establishment
function db_connect(){
	try{
		$db = new db_class();
		$Connection = $db->connect();
	} catch (Exception $e) {
		echo "Database Connection class not found";
	}
	return $Connection;
}

//Database Connection Termination
function db_close($con){
	mysqli_close($con);
}


function clearEmptyPosts(){
	$connection = db_connect();
	$sql = "CALL validate_post()";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
}

function getAllCategories(){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_Category`";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function getCategory($cat_name){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_Category` WHERE `category_name` = '$cat_name'";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function getCategoryId($cat_name){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_Category` WHERE `category_name` = '$cat_name'";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	$row = mysqli_fetch_array($result);
	return $row['category_id'];
}

function getAllSubcategories($cat_id){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_Subcategory` WHERE `subcategory_cat_id` = $cat_id";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function getAllStates(){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_Allstates`";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function getCitiesFromStates($state){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_Allcities` WHERE `state` = '$state';";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function getAllCities(){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_City`";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function signUp($type, $fname, $lname, $cname, $email, $password, $address, $phone, $website, $newsletter){
	$connection = db_connect();
	$sql = "INSERT INTO `FlickBazar_User` (
	`user_id` ,`user_type` ,`user_fname` ,`user_lname` ,`user_cname` ,`user_email` ,`user_password` ,`user_address` ,`user_phone` ,`user_website` ,`user_newsletter` ,`user_timestamp`)
	VALUES ('',  '$type',  '$fname',  '$lname', '$cname' ,  '$email', MD5(  '$password' ) ,  '$address',  '$phone',  '$website',  '$newsletter', CURRENT_TIMESTAMP);";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

function signIn($email, $password){
	$connection = db_connect();
	$sql = "SELECT * FROM  `FlickBazar_User` WHERE  `user_email` =  '$email' AND  `user_password` = MD5('$password' ) LIMIT 1;";
	$result = mysqli_query($connection,$sql);
	$rowcount = mysqli_num_rows($result);
	
	if($rowcount == 1){
		db_close($connection);
		$row = mysqli_fetch_array($result);
		return $row['user_id'];
	} else {
		db_close($connection);
		return -1;
	}
}

function getUserDetails($user_id){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_User` WHERE `user_id` = $user_id";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function getUserDetailsByEmail($email){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_User` WHERE  `user_email` =  '$email' LIMIT 1;";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function submitPost($category, $subcategory, $locality, $city, $state, $country, $price, $free, $negotiable, $desc, $title, $uid, $img1, $img2, $img3, $img4, $img5){
	$connection = db_connect();
	$sql = "INSERT INTO `FlickBazar_Post` (
	`Post_id` ,`Post_category` ,`Post_subcategory` ,`Post_locality` ,`Post_city` ,`Post_state` ,`Post_country` ,`Post_title` ,`Post_desc` ,`Post_price` , `Post_free`, `Post_negotiable`, `Post_img1` , `Post_img2` ,`Post_img3` ,`Post_img4` ,`Post_img5` ,`Post_uid` ,`Post_timestamp`, `Post_isapproved`)
	VALUES (
	'',  '$category',  '$subcategory',  '$locality',  '$city',  '$state',  '$country',  '$title',  '$desc',  '$price',  '$free', '$negotiable', '$img1',  '$img2',  '$img3',  '$img4',  '$img5',  '$uid', CURRENT_TIMESTAMP, '0');";

	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

function deletePost($pid){
	$connection = db_connect();
	$sql = "INSERT INTO `FlickBazar_Deleted_Post` SELECT p.* FROM `FlickBazar_Post` p WHERE `Post_id` = $pid";
	
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		$connection = db_connect();
		$sql2 = "DELETE FROM `FlickBazar_Post` WHERE `Post_id` = $pid;";
		$result2 = mysqli_query($connection,$sql2);
			if($result2){
				db_close($connection);
				return true;
			}else{
				db_close($connection);
				return false;
			}
	} else {
		db_close($connection);
		return false;
	}
}

function repost($pid){
	$connection = db_connect();
	$sql = "UPDATE `FlickBazar_Post` SET `Post_timestamp` = CURRENT_TIMESTAMP WHERE `Post_id` = $pid LIMIT 1 ;";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	}else{
		db_close($connection);
		return false;
	}
}

function viewPost($pid){
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_Post` WHERE `Post_id` = $pid LIMIT 1";
	$result = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($result);
	db_close($connection);
	
	$new_view = $row['Post_view'] + 1;
	
	$connection = db_connect();
	$sql = "UPDATE `FlickBazar_Post` SET `Post_view` =  '$new_view' WHERE `Post_id` = $pid LIMIT 1 ;";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	}else{
		db_close($connection);
		return false;
	}
}

function countView($uid){
	$connection = db_connect();
	$sql = "SELECT SUM(  `Post_view` ) AS  `Post_vsum` FROM  `FlickBazar_Post` WHERE  `Post_uid` =  '$uid';"; 
	$result = mysqli_query($connection,$sql);
	$result_details = mysqli_fetch_array($result);
	return $result_details['Post_vsum'];
}

function countPost($uid){
	$connection = db_connect();
	$sql = "SELECT COUNT(*) AS `Post_sum` FROM  `FlickBazar_Post` WHERE  `Post_uid` =  '$uid';"; 
	$result = mysqli_query($connection,$sql);
	$result_details = mysqli_fetch_array($result);
	return $result_details['Post_sum'];
}

function countFollowing($uid){
	$connection = db_connect();
	$sql = "SELECT COUNT(*) AS `following_sum` FROM  `FlickBazar_follow` WHERE  `follow_myid` =  '$uid';"; 
	$result = mysqli_query($connection,$sql);
	$result_details = mysqli_fetch_array($result);
	return $result_details['following_sum'];
}

function countFollower($uid){
	$connection = db_connect();
	$sql = "SELECT COUNT(*) AS `following_sum` FROM  `FlickBazar_follow` WHERE  `follow_othid` =  '$uid';"; 
	$result = mysqli_query($connection,$sql);
	$result_details = mysqli_fetch_array($result);
	return $result_details['following_sum'];
}

function updateUser($uid, $fname, $lname, $cname, $address, $phone, $website, $facebook, $twitter, $linkedin, $gplus){
	$connection = db_connect();
	$sql = "UPDATE `FlickBazar_User` SET
	`user_fname` =  '$fname', `user_lname` =  '$lname', `user_cname` =  '$cname', `user_address` =  '$address', `user_phone` =  '$phone', `user_website` =  '$website', `user_facebook` =  '$facebook', `user_twitter` =  '$twitter', `user_linkedin` =  '$linkedin', `user_gplus` =  '$gplus' WHERE `user_id` = $uid LIMIT 1 ;";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

function resetPassword($uid, $cpass, $npass){
	$md5cpass = md5($cpass);
	$md5npass = md5($npass);
	
	$connection = db_connect();
	$sql = "SELECT * FROM `FlickBazar_User` WHERE `user_id` = '$uid' AND `user_password` = '$md5cpass'";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	$count = mysqli_num_rows($result);
	
	if($count > 0){
		$connection = db_connect();
		$sql = "UPDATE `FlickBazar_User` SET `user_password` = '$md5npass' WHERE `user_id` = $uid AND `user_password` = '$md5cpass' LIMIT 1 ;";
		$result = mysqli_query($connection,$sql);
		if($result){
			db_close($connection);
			return true;
		} else {
			db_close($connection);
			return false;
		}
	}else{
		return false;
	}
}

function recovPassword($uid, $npass){
	$md5npass = md5($npass);
	
	$connection = db_connect();
	$sql = "UPDATE `FlickBazar_User` SET `user_password` = '$md5npass' WHERE `user_id` = $uid LIMIT 1 ;";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

function submitProductContact($product_id, $product_title, $receiver_email, $message, $name, $senders_email, $phone){
	$connection = db_connect();
	$sql = "INSERT INTO ` FlickBazar_ProductContact` (
`contact_id` ,`contact_pid` ,`contact_title` ,`contact_r_email` ,`contact_message` ,`contact_name` ,`contact_s_email` ,`contact_phone` ,`contact_timestamp`) VALUES (
'',  '$product_id',  '$product_title',  '$receiver_email',  '$message',  '$name',  '$senders_email',  '$phone', CURRENT_TIMESTAMP);";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

function getUserPost($user_id){
	$connection = db_connect();
	$sql = "SELECT * FROM  `FlickBazar_Post` WHERE  `Post_uid` = $user_id";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function getPost($pid){
	$connection = db_connect();
	$sql = "SELECT * FROM  `FlickBazar_Post` WHERE  `Post_id` = $pid LIMIT 1";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function recentPost($cat, $locType, $locName){
	$connection = db_connect();
	if($cat == ""){
		$sql = "SELECT * FROM  `FlickBazar_Post` WHERE `Post_isapproved` = '1' ";
		
		if($locType == "city" && $locName != ""){
			$sql = $sql."AND `Post_city` = '$locName' ";
		}else if($locType == "state" && $locName != ""){
			$sql = $sql."AND `Post_state` = '$locName' ";
		}
		
		$sql = $sql."ORDER BY `Post_timestamp` DESC LIMIT 6";
		
	}else{
		$sql = "SELECT * FROM  `FlickBazar_Post` WHERE  `Post_isapproved` = '1' AND `Post_category` = '$cat' ";
		
		if($locType == "city" && $locName != ""){
			$sql = $sql."AND `Post_city` = '$locName' ";
		}else if($locType == "state" && $locName != ""){
			$sql = $sql."AND `Post_state` = '$locName' ";
		}
		
		$sql = $sql."ORDER BY `Post_timestamp` DESC LIMIT 8";
	}

	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function stringSearch($cat, $subcat, $query, $start, $limit, $sort_type, $sort_direction, $locType, $locName){
	$connection = db_connect();

	$sql = "SELECT * FROM  `FlickBazar_Post` WHERE `Post_isapproved` = '1' AND `Post_title` LIKE '%".$query."%' ";
	
	if($cat != ""){
		$sql = $sql."AND `Post_category` = '$cat' ";
	}
	
	if($subcat != ""){
		$sql = $sql."AND `Post_subcategory` = '$subcat' ";
	}

	if($locType == "city" && $locName != ""){
		$sql = $sql."AND `Post_city` = '$locName' ";
	}else if($locType == "state" && $locName != ""){
		$sql = $sql."AND `Post_state` = '$locName' ";
	}
	
	if($sort_type == "date"){
		$sql = $sql."ORDER BY `Post_timestamp` ";
	}elseif($sort_type == "price"){
		$sql = $sql."AND `Post_price`<> '0' ORDER BY `Post_price` ";
	}else{
		$sql = $sql."ORDER BY `Post_timestamp` ";
	}
	
	if($sort_direction == "desc"){
		$sql = $sql."DESC ";
	}elseif($sort_direction == "asc"){
		$sql = $sql."ASC ";
	}else{
		$sql = $sql."DESC ";
	}
	
	$sql = $sql."LIMIT ".$start.",".$limit.";";

	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function searchList($cat, $subcat, $start, $limit, $sort_type, $sort_direction, $locType, $locName){
	$connection = db_connect();
	
	if($cat == ""){
		$sql = "SELECT * FROM  `FlickBazar_Post` WHERE  `Post_isapproved` = '1' AND `Post_category` LIKE '%' ";
	}else{
		$sql = "SELECT * FROM  `FlickBazar_Post` WHERE  `Post_isapproved` = '1' AND `Post_category` = '$cat' ";
	}
	
	if($subcat != ""){
		$sql = $sql."AND `Post_subcategory` = '$subcat' ";
	}
	
	if($locType == "city" && $locName != ""){
		$sql = $sql."AND `Post_city` = '$locName' ";
	}else if($locType == "state" && $locName != ""){
		$sql = $sql."AND `Post_state` = '$locName' ";
	}
	
	if($sort_type == "date"){
		$sql = $sql."ORDER BY `Post_timestamp` ";
	}elseif($sort_type == "price"){
		$sql = $sql."AND `Post_price`<> '0' ORDER BY `Post_price` ";
	}else{
		$sql = $sql."ORDER BY `Post_timestamp` ";
	}
	
	if($sort_direction == "desc"){
		$sql = $sql."DESC ";
	}elseif($sort_direction == "asc"){
		$sql = $sql."ASC ";
	}else{
		$sql = $sql."DESC ";
	}
	
	$sql = $sql."LIMIT ".$start.",".$limit.";";

	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function string_search($str, $cat, $subcat, $loc_type,$loc_val, $start, $limit, $sort_type, $sort_direction){
} 

function viewedPost($cat, $locType, $locName){
	$connection = db_connect();
	
	if($cat == ""){
		$sql = "SELECT * FROM  `FlickBazar_Post` WHERE `Post_isapproved` = '1' ";
		
		if($locType == "city" && $locName != ""){
			$sql = $sql."AND `Post_city` = '$locName' ";
		}else if($locType == "state" && $locName != ""){
			$sql = $sql."AND `Post_state` = '$locName' ";
		}
		
		$sql = $sql."ORDER BY `Post_view` DESC LIMIT 6";
		
	}else{
		$sql = "SELECT * FROM  `FlickBazar_Post` WHERE  `Post_isapproved` = '1' AND `Post_category` = '$cat' ";
		
		if($locType == "city" && $locName != ""){
			$sql = $sql."AND `Post_city` = '$locName' ";
		}else if($locType == "state" && $locName != ""){
			$sql = $sql."AND `Post_state` = '$locName' ";
		}
		
		$sql = $sql."ORDER BY `Post_view` DESC LIMIT 8";
	}
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function randomPost($cat, $locType, $locName){
	$connection = db_connect();
	$sql = "SELECT * FROM  `FlickBazar_Post` WHERE  `Post_isapproved` = '1' AND `Post_category` = '$cat' ";
	
	if($locType == "city" && $locName != ""){
		$sql = $sql."AND `Post_city` = '$locName' ";
	}else if($locType == "state" && $locName != ""){
		$sql = $sql."AND `Post_state` = '$locName' ";
	}
	
	$sql = $sql."ORDER BY RAND() LIMIT 4";

	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function getSameUserPost($user_id){
	$connection = db_connect();
	$sql = "SELECT * FROM  `FlickBazar_Post` WHERE  `Post_isapproved` = '1' AND `Post_uid` = $user_id ORDER BY RAND() LIMIT 4";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function follow($my_id, $follow_id){
	$connection = db_connect();
	$sql = "INSERT INTO `FlickBazar_follow` (`follow_id` ,`follow_myid` ,`follow_othid`) VALUES ('',  '$my_id',  '$follow_id');";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

function checkfollow($my_id, $follow_id){
	$connection = db_connect();
	$sql = "SELECT * FROM  `FlickBazar_follow` WHERE  `follow_myid` = $my_id AND  `follow_othid` = $follow_id;";
	$result = mysqli_query($connection,$sql);
	$count = mysqli_num_rows($result);
	if($count > 0){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

function addCookieIdentifier($cookie_name){
	$connection = db_connect();
	$sql = "INSERT INTO `FlickBazar_CookieIdentifier` (
	`id` ,`identifier` ,`timestamp`) VALUES ('',  '$cookie_name', CURRENT_TIMESTAMP);";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

function addCookieProduct($cookie_name, $pid){

	$flag = 0;
	$connection = db_connect();
	$sql = "SELECT * FROM  `FlickBazar_ProductView` WHERE `cid` = '$cookie_name' ORDER BY  `FlickBazar_ProductView`.`timestamp` DESC LIMIT 0 , 4";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	
	while($row = mysqli_fetch_array($result)){
		if($row['pid'] == $pid){
			$flag = 1;
		}
	}
	
	if($flag != 1){
		$connection = db_connect();
		$sql = "INSERT INTO `FlickBazar_ProductView` (`id` ,`cid` ,`pid` ,`timestamp`) VALUES ('',  '$cookie_name',  '$pid', CURRENT_TIMESTAMP);";
		$result = mysqli_query($connection,$sql);
		if($result){
			db_close($connection);
			return true;
		} else {
			db_close($connection);
			return false;
		}
	}
}

function userViewedPosts($cookie_identifier){
	$connection = db_connect();
	$sql = "SELECT * FROM  `FlickBazar_ProductView` WHERE `cid` = '$cookie_identifier' ORDER BY  `FlickBazar_ProductView`.`timestamp` DESC LIMIT 0 , 4";
	$result = mysqli_query($connection,$sql);
	db_close($connection);
	return $result;
}

function signup_confirmation($name, $email, $confirmationString){
	$emailSubject = "Welcome to FlickBazar.com. Just one step to sell.";
	$webMaster = "flickbazarindia@gmail.com";
	
	$body = "<h3>Welcome to FlickBazar.com</h3>
	<strong>You are just one step away from earning by selling.</strong>
	<br /><br />Please <a href='$confirmationString' target='_blank'>click here</a> to confirm your email address.
	<br />If you find any difficulty in the above link please copy the URL below:
	<br /><a href='$confirmationString' target='_blank'>$confirmationString<a/>";
	
	$headers = "From: $email\r\n";
	$headers .= "Content-type: text/html\r\n";
	
	$success = mail($webMaster, $emailSubject, $body, $headers);
	if($success) {
		echo "Mail sent";
	} else {
		echo "Delivery failed.";
	}
}

function customerContact($topic, $subject, $message, $email, $name){
	$connection = db_connect();
	$sql = "INSERT INTO `FlickBazar_CustomerContact` (
			`contact_id` ,`contact_topic` ,`contact_subject` ,`contact_message` ,`contact_name` ,`contact_email` ,`contact_timestamp`)
			VALUES ('',  '$topic',  '$subject',  '$message',  '$name',  '$email', CURRENT_TIMESTAMP);";
	$result = mysqli_query($connection,$sql);
	if($result){
		db_close($connection);
		return true;
	} else {
		db_close($connection);
		return false;
	}
}

//echo "Email Testing..";
//signup_confirmation("Saurav Majumder","sauravmajumder.it@gmail.com","http://www.flickecom.com/2013/php/index.php");

/* ----------------- JhatkaDeal Connection ------------------- */

class jd_class{
	private $host_string = "jd2013.db.9023873.hostedresource.com";
	private $username = "jd2013";
	private $password = "Jd@671989";
	private $db_name = "jd2013";

	function connect(){
		$con = mysqli_connect($this->host_string,$this->username,$this->password,$this->db_name);
		if (mysqli_connect_errno($con)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}else{
			return $con;
		}
	}
}

//Database Connection Establishment
function jd_connect(){
	try{
		$jd = new jd_class();
		$Connection = $jd->connect();
	} catch (Exception $e) {
		echo "Database Connection class not found";
	}
	return $Connection;
}

//Database Connection Termination
function jd_close($con){
	mysqli_close($con);
}

function Deals(){
	$connection = jd_connect();
	$sql = "SELECT * FROM  `jd_dealDb` ORDER BY  RAND() LIMIT 4";

	$result_deals = mysqli_query($connection,$sql);
	jd_close($connection);

	return $result_deals;
}
?>
