<?php
function passwordRecoveryEmail($email,$password){
	$to = $email; 
	$from = "wecare@wizlyst.com"; 
	$subject = "Your Password Recovery Information"; 

	//begin of HTML message 
	$message = "
	<html> 
	<body> 
		<p><img border='0' src='http://www.wizlyst.com/img/new_logo.png' height='54'></p>
		<hr>
		<p>Below is the requested login information:</p>
		<p>Username : $email</p>
		<p>Password : $password</p>
		<p>If you find any problem accessing your account, feel free to email us at wecare@wizlyst.com</p>
		<p>Thank you,<br>
		<b>Wizlyst</b></font></p>
		<hr>
		<p><small>You are receiving this email because you requested for password reset in the website.
		<br />Wizlyst.com India
		</p>
	</body> 
	</html>";		
	//end of message 

	$headers  = "From: $from\r\n"; 
	$headers .= "Content-type: text/html\r\n"; 

	//options to send to cc+bcc 
	//$headers .= "Cc: flickbazar@gmail.com"; 
 
	// now lets send the email. 
	if(mail($to, $subject, $message, $headers)){
		return true;
	} else {
		return false;
	}
}

function contactSellerFromProduct($title,$remail,$message,$name,$semail,$phone){
	$to = $remail; 
	$from = $semail; 
	$subject = "Buyer interested in your product"; 

	//begin of HTML message 
	$message = "
	<html> 
	<body> 
		<p><img border='0' src='http://www.wizlyst.com/img/new_logo.png' height='54'></p>
		<hr>
		<p>Below is the buyer's	information:</p>
		<p>Full Name : $name</p>
		<p>Email : $semail</p>
		<p>Phone : $phone</p>
		<p>Message : $message</p>
		<p>If you find any problem feel free to email us at wecare@wizlyst.com</p>
		<p>Thank you,<br>
		<b>Wizlyst</b></font></p>
		<hr>
		<p><small>You are receiving this email because you have listed your product in the website with this contact email.
		<br />Wizlyst.com India
		</p>
	</body> 
	</html>";		
	//end of message 

	$headers  = "From: $from\r\n"; 
	$headers .= "Content-type: text/html\r\n"; 

	//options to send to cc+bcc 
	//$headers .= "Cc: flickbazar@gmail.com"; 
 
	// now lets send the email. 
	if(mail($to, $subject, $message, $headers)){
		return true;
	} else {
		return false;
	}
}

function contactSellerFromProfile($remail,$message,$name,$semail){
	$to = $remail; 
	$from = $semail; 
	$subject = "Buyer interested in you."; 

	//begin of HTML message 
	$message = "
	<html> 
	<body> 
		<p><img border='0' src='http://www.wizlyst.com/img/new_logo.png' height='54'></p>
		<hr>
		<p>Below is the buyer's	information:</p>
		<p>Full Name : $name</p>
		<p>Email : $semail</p>
		<p>Message : $message</p>
		<p>If you find any problem feel free to email us at wecare@wizlyst.com</p>
		<p>Thank you,<br>
		<b>Wizlyst</b></font></p>
		<hr>
		<p><small>You are receiving this email because you have listed your product in the website with this contact email.
		<br />Wizlyst.com India
		</p>
	</body> 
	</html>";		
	//end of message 

	$headers  = "From: $from\r\n"; 
	$headers .= "Content-type: text/html\r\n"; 

	//options to send to cc+bcc 
	//$headers .= "Cc: flickbazar@gmail.com"; 
 
	// now lets send the email. 
	if(mail($to, $subject, $message, $headers)){
		return true;
	} else {
		return false;
	}
}
?>