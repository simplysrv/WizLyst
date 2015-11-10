<?php
//Database Connectivity
include_once "dbinfo.inc.oop.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<!----------------------------------------
	Created by: Saurav Majumder
	All Rights Reserved to Wizlyst.com
------------------------------------------>
<head>
	<title>Wizlyst - Privacy Policy</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

	<meta name="robots" content="noindex, nofollow">
	<meta name="googlebot" content="noindex, nofollow">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
	<script src="js/bootstrap-modal.js"></script>
	<script src="js/bootstrap-transition.js"></script>
</head>
<body>

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"Zyh9i1acVE00W7", domain:"wizlyst.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=Zyh9i1acVE00W7" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


<div class="city-box">
		<div class="container">
			<div class="span5" id="search-title" >
				Search your city: 
				<form class="form-search" style="margin: 10px 0px;">
				<input id="searchTextField" type="text" placeholder="Kolkata">
				<button class="btn btn-primary" type="button" id="city-search-btn"><i class="icon-search icon-white"></i></button>
				</form>
				<div id="map-canvas"></div>
				<a href="#" style="color: #fff;" onclick="setCity('India','country');">All India</a>
			</div>
			<div class="span6" id="search-body">
				<table class="city_table">   
				  <?php
					$city_list = getAllCities();
					$rowcount = mysqli_num_rows($city_list);
					$counter = 4;
					
					while($row = mysqli_fetch_array($city_list)){
						if($counter == 4){
							echo "<tr>";
						}
				?>
					<td><a href="#" onclick="setCity('<?php echo $row['city_name']; ?>','city');"><?php echo $row['city_name']; ?></a></td>  
				<?php
					if($counter == 0){
						echo "</tr>";
						$counter = 4;
					}else{
						$counter = $counter - 1;
					}
					}
				?> 
				</table>
			</div>
		</div>
	</div>
	<!--  Header  Start  -->
	<?php
	include_once "header.php";
	?>
	<!--  Header  End  -->
	<div class="container">
		<div class="thumbnail-header">
			<span class="cat_header">Privacy Policies</span>
		</div>
		<br />
		<p>WIZLYST has set up fixed privacy policies. These privacy policies relate to www.Wizlyst.com with respect to collection, services, use and disclosure of personal information. Wizlyst reserves the right to modify the Privacy Policies without prior notice by posting on the website. The Privacy may be modified with respect to agreements between individuals and us from time to time. In this Privacy Statement, personal information means any information about a specific individual and also his/her contact and demographic details.</p>

		<h5>Collection of Personal Information</h5>
		<p>Quenchlist’s registration form requires users to provide contact information (full name, email address, phone number) and also demographic information (postal code, address) for us to provide services. Wizlyst has an online post advertisement form where a user is supposed to give product details for rent/sale. The user is also required to provide demographic details and contact information, which other customers would use to contact the user. We have no control over who views the online ad in our website. So contact information provided with the product details may be used to contact customers when necessary.</p>
		
		<p>Demographic and profile data is also collected at the Site through our online surveys. We use this data to tailor each visitor's experience at the website, showing the user content that we think he or she might be interested in, and displaying the content according to the user’s preferences. Users may opt-out of receiving future mailings (see the Opt-Out section below).</p>
		
		<p>We at Wizlyst use third-party advertising companies like Google to serve ads when you visit our website. Companies like Google may use user’s information (excluding name, phone number, email address, physical address) about number of hits on the website to provide advertisement and goods that interest the user and it may be displayed on the user’s account home page. For more information visit https://support.google.com/adsense/bin/answer.py?hl=en&answer=48182.</p>
 
		<h5>Disclosure of Personal Information</h5>
		<p>Wizlyst reserves the right to disclose certain personal information as per the following details:

		<ol>
		<li>We can publish ads either online and/or in print, as the case may be, in connection with items that are for sale/rent by customers.</li>
		<li>We may provide personal information (name, email address, phone number) to third party service providers and to affiliated entities in order to carry out work on our behalf.</li>
		<li>We may provide personal information if needed to law enforcement agencies for the purposes of investigating fraud or other offences, or to legal, financial, and other professional advisors or in connection with the sale or reorganization of all or part of its business or operations.</li>
		</ol>
		
		Excluding the above points, we agree not use or disclose personal information for purposes other than those for which it was collected, except with the consent of the individual or as required or permitted by law.</p>
 
		<h5>Cookies and IP Addresses</h5>
		<p>Our server will use your IP address to identify you and your membership, to gather broad demographic information about our users, diagnose problems with our server, and administer the Site. Wizlyst.com uses cookies to keep track of your membership tools, your points, clicks and to make sure you do not see the same ad repeatedly. We at Wizlyst are trying hard to make a good user-friendly experience for all the visitors. So we give an option to save your ID/display name and password in your home computer so that you do not have to re-enter it every time.</p>
		
		<p>Advertisements from other companies are also displayed on our website, so cookies received with banner ads are collected by our ad companies and we do not have access to that information.</p>
 
		<h5>Links</h5>
		<p>Wizlyst.com also contains links to other websites, such as websites providing national search capabilities and information resources designed to inform buyers and sellers about general aspects of property that is being sold. We are not responsible for the privacy practices or the content of such websites whose links are displayed on our website. Please review the privacy policies of the websites that you visit.</p>
 
		<h5>Security</h5>
		<p>We try to protect every possible personal information against loss, misuse and alteration. However it is quite possible that any personal information transmitted via the internet may be intercepted by unknown third parties and in such a case further investigation should settle down the matter.</p>
 
		<h5>Opt-Out</h5>
		<p>When appropriate, users of the Site are given the opportunity to (i) opt-out of receiving communications from us, (ii) remove their information from our database, or (iii) elect to no longer receive services from us. If you wish to opt-out of receiving further communications, please contact us.</p>
 
		<h5>Corrections/Contact</h5>
		<p>Users of this Site may contact Wizlyst to modify or correct any of their personal information that is under our control. An individual may also direct a written complaint regarding compliance with this Privacy Statement to us and, within a reasonable time upon receiving the written complaint, we will conduct an investigation into the matter, and we will take necessary measure/s to rectify the source of the complaint, as appropriate.</p>
 
		<h5>Contact Us</h5>
		<p>If you have any questions about this Privacy Statement, our privacy practices in connection with this Site, or our collection, use, disclosure, or retention of your personal information in connection with this website, please contact us at wecare@wizlyst.com.</p>
<br />
	</div>
		<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
</body>
</html>