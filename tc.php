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
	<title>Wizlyst - Terms & Conditions</title>

	<meta name="description" content="">
	<meta name="keywords" content="">

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
			<span class="cat_header">Terms & Conditions</span>
		</div>
		<br />
		<p>Please read and accept these terms and conditions before you can list & rent items in Wizlyst.com
		<ol>
		<li><h5>Legal</h5> 

		<p>We don’t do anything illegal and nothing illegal from your part would be tolerated in our platform. If found guilty then your membership will be revoked and you may not be able to use Wizlyst.com ever again. We advise you to read our terms and condition and privacy policies before using our platform.</p></li>
 
		<li><h5>Modifications To This Agreement</h5>

		<p>We hold the right, at our sole discretion, to change and modify or otherwise alter these terms and conditions at any time. Any modification to this agreement will be put into effect immediately after placing it in the website. So you are advised to read this agreement if anything has been changed.</p></li>

		<li><h5>Fees and Services</h5>

		<p>Wizlyst.com is completely free to use and we do not charge for any listing or rental from our website. In this way we provide a platform, which every common man can use and get benefited. Creating your own personal profile, posting ads, replying to an post are all completely free. Even social sharing in facebook and other social media are free. We do not charge anything.</p></li>

		<li><h5>Content</h5>

		<p>All postings, ads, messages, text, files, images or other materials, which are a part of the content posted on, transmitted through, or linked from the service, are the sole responsibility of the person from whom such content originated. Additionally, you are entirely responsible for all your post, email or otherwise make available via the service. Quenchlist.com does not control, and is not responsible for content made available through the service.</p>
		
		<p>Furthermore, the Wizlyst.com site and content available through the service may contain links to other websites, which are completely independent of Wizlyst.com</p>
		
		<p>Wizlyst.com makes no promises or warranty as to the accuracy, completeness or authenticity of the information contained in any third party website.</p>
		
		<p>Your linking to any other website is at your own risk. You agree that you must evaluate, and bear all risks associated with, the use of any content, that you may not rely on said content, and that under no circumstances will Wizlyst.com be liable in any way for any content or for any loss or damage of any kind incurred as a result of the use of any content posted, emailed or otherwise made available via the service. By providing your mobile number and item location address listed on Wizlyst.com, you agree to be contacted from other persons who are in need of your item. You acknowledge that Wizlyst.com does not always pre-screen or approve content (unless specified), but that Wizlyst.com shall have the right (but not the obligation) in its sole discretion to refuse, delete or move any content that is available via the service, for violating the terms and conditions listed on this page or for any other reason.</p></li>
 
		<li><h5>Third party content sites and service</h5>

		<p>The third party website content in Wizlyst.com is completely independent of Wizlyst and we are not responsible for any content provided by them. Your interactions with such kind of organizations/individuals including payment and delivery of goods or services, and any other terms, conditions, warranties or representations associated with such dealings, are solely between you and such organizations and/or individuals.</p>
		
		<p>You agree that Wizlyst shall not be responsible or liable for any loss or damage of any sort incurred as the result of any such dealings. If there is a dispute between participants on this site, or between users and any third party, you understand and agree that Wizlyst is under no obligation to become involved.</p></li>
 
		<li><h5>Copyright Protection</h5>

		<p>If you believe that your work has been copied in a way that constitutes copyright infringement, or your intellectual property rights have been otherwise violated, please notify us at wecare@Wizlyst.com</p></li>
		
		<li><h5>Conduct</h5>

		<p>Those who post ad in Wizlyst.com should agree not to post, email, or otherwise make available content:
		<ul>
			<li>that is unlawful, harmful, threatening, abusive, harassing, defamatory, libelous, invasive of another's privacy, or is harmful to minors in any way.</li>
			<li>that is pornographic in nature.</li>
			<li>hat harasses, degrades, intimidates or is hateful toward an individual or group of individuals on the basis of religion, gender, sexual orientation, race, ethnicity, age, or disability.</li>
			<li>should not target to a specific person especially public figures.</li>
			<li>that infringes any patent, trademark, trade secret, copyright or other proprietary rights of any party, or content that you do not have a right to make available under any law or under contractual or fiduciary relationships.</li>
			<li>that constitutes or contains "affiliate marketing," "link referral code," "junk mail," "spam," "chain letters," "pyramid schemes," or unsolicited commercial advertisement.</li>
			<li>that includes links to commercial services or web sites, except as allowed in "services".</li>
			<li>that advertises any illegal service or the sale of any items the sale of which is prohibited or restricted by any applicable law, including without limitation items the sale of which is prohibited or regulated by indian law.</li>
			<li>that contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment.</li>
			<li>that disrupts the normal flow of services.</li>
			<li>that employs misleading email addresses, or forged headers or otherwise manipulated identifiers in order to disguise the origin of content transmitted through the service.</li>
		</ul>

		Additionally, members should agree not to: 
		
		<ul>
			<li>contact or harass anyone who has asked not to be disturbed.</li>
			<li>collect personal data about other users for commercial or unlawful purposes.</li>
			<li>post non-local or otherwise irrelevant content, repeatedly post the same or similar content or otherwise impose an unreasonable or disproportionately large load on our infrastructure;</li>
			<li>attempt to gain unauthorized access to our system or engage in any activity that disrupts, diminishes the quality of, interferes with the performance of, or impairs the functionality of, the service of our website; or</li>
			<li>use any form of automated device or computer program that enables the submission of postings on Wizlyst without each posting being manually entered by the author thereof (an "automated posting device"), including without limitation, the use of any such automated posting device to submit postings in bulk, or for automatic submission of postings at regular intervals.</li>
		</ul>
		</p>
		</li>
 
		<li><h5>Communication</h5>

		<p>We will be communicating with our registered members through the email id that is specified in your account. We shall use this email address to send emails related to your account, introduction of new features in Wizlyst.com, newsletters if you are subscribed to and updates in our privacy policies. You may opt out of the newsletters or promotional announcements anytime at your wish.</p></li>
 
		<li><h5>Limitations On Service</h5>

		<p>You agree that Wizlyst has no responsibility or liability for the deletion or failure to store any content maintained or transmitted by the service. Quenchlist reserves the right at any time to modify or discontinue the service (or any part thereof) with or without notice, if found guilty of harming our system by any means and legal action would be taken there off.</p>
		
		<p>Quenchlist grants you a limited, revocable, non-exclusive license to access the service for your own personal use. This license does not include any collection, aggregation, copying, duplication, display or derivative use of the service. Quenchlist permits you to display on your website, or create a hyperlink on your website too, individual postings on the service so long as such use is for non-commercial and/or news reporting purposes only (e.g., for use in personal web blogs or personal online media). You may also create a hyperlink to the home page of Wizlyst sites so long as the link does not portray Wizlyst.com, its employees, or its affiliates in a false, misleading, derogatory, or otherwise offensive matter.</p>
		
		<p>Use of the service beyond the scope of authorized access granted to you by Wizlyst immediately terminates said permission/license/memberships/accounts. In order to collect, aggregate, copy, duplicate, display or make derivative use of the service or any content made available via the service for other purposes (including commercial purposes) not stated herein, you must first contact Wizlyst through the contact us form.</p></li>
		
		<li><h5>Termination Of Service</h5>

		<p>Wizlyst, in its sole discretion, has the right (but not the obligation) to delete or deactivate your account, block your email or ip address, or otherwise terminate your access to or use of the service (or any part thereof), immediately and without notice, and remove and discard any content within the service, for any reason, including, without limitation, if we believe that you have acted inconsistently with the letter or spirit of the terms. Further, you agree that Wizlyst shall not be liable to you or any third-party for any termination of your access to the service.</p></li>
 
		<li><h5>Proprietary Rights</h5>

		<p>The service is protected to the maximum extent permitted by copyright laws and international treaties. Content displayed on or through the service is protected by copyright as a collective work and/or compilation, pursuant to copyrights laws, and international conventions. Any reproduction, modification, creation of derivative works from or redistribution of the site or the collective work, and/or copying or reproducing the sites or any portion thereof to any other server or location for further reproduction or redistribution is prohibited without the express written consent of Wizlyst. It should not to reproduced, duplicated or copied content from the service without the express written consent of Wizlyst, and agree to abide by any and all copyright notices displayed on the service. You may not decompile or disassemble, reverse engineer or otherwise attempt to discover any source code contained in the service. Without limiting the foregoing, you agree not to reproduce, duplicate, copy, sell, resell or exploit for any commercial purposes, any aspect of the service. Although Wizlyst does not claim ownership of content that its users post, by posting content to any public area of the service, you automatically grant, and you represent and warrant that you have the right to grant, to Wizlyst an irrevocable, perpetual, non-exclusive, fully paid, worldwide license to use, copy, perform, display, and distribute said content and to prepare derivative works of, or incorporate into other works, said content, and to grant and authorize sublicenses (through multiple tiers) of the foregoing. Furthermore, by posting content to any public area of the service, you automatically grant Wizlyst all rights necessary to prohibit any subsequent aggregation, display, copying, duplication, reproduction, or exploitation of the content on the service by any party for any purpose.</p></li>
 
		<li><h5>Disclaimer Of Warranties</h5>

		<p>You agree that use of the Wizlyst service is entirely at your own risk. It is provided on an "as is" or "as available" basis, without any warranties of any kind. All express and implied warranties, including, without limitation, the warranties of merchantability, fitness for a particular purpose, and non-infringement of proprietary rights are expressly disclaimed to the fullest extent permitted by law. To the fullest extent permitted by law, Wizlyst disclaims any warranties for the security, reliability, timeliness, accuracy, and performance of the website and the service. To the fullest extent permitted by law, Wizlyst disclaims any warranties for other services or goods received through or advertised on the website or the sites or service, or accessed through any links Wizlyst website. To the fullest extent permitted by law, Wizlyst disclaims any warranties for viruses or other harmful components in connection with the clickindia site or the service.</p></li>
 
		<li><h5>Limitations Of Liability</h5>

		<p>Under no circumstances shall Wizlyst be liable for direct, indirect, incidental, special, consequential or exemplary damages resulting from any aspect of your use of the Wizlyst site or the service, whether the damages arise from use or misuse of the Wizlyst website or the service, from inability to use the Wizlyst website or the service, or the interruption, suspension, modification, alteration, or termination of the Wizlyst website or the service. Such limitation shall also apply with respect to damages incurred by reason of other services or products received through or advertised in connection with the Wizlyst website or the service or any links on the Wizlyst website, as well as by reason of any information or advice received through or advertised in connection with the Wizlyst website or the service or any links on the Wizlyst site. These limitations shall apply to the fullest extent permitted by law.</p></li>
 
		<li><h5>Indemnity</h5>

		<p>You agree to indemnify and hold Wizlyst, its officers, subsidiaries, affiliates, successors, assigns, directors, officers, agents, service providers, suppliers and employees, harmless from any claim or demand, including reasonable attorney fees and court costs, made by any third party due to or arising out of content you submit, post or make available through the service, your use of the website, your violation of the terms, your breach of any of the representations and warranties herein, or your violation of any rights of another.</p></li>
 
		<li><h5>General information</h5>

		<p>The terms constitute the entire agreement between you and Wizlyst and govern your use of the service, superseding any prior agreements between you and Wizlyst. The terms and the relationship between you and Wizlyst shall be governed by the indian laws without regard to its conflict of law provisions.</p></li> 

		<li><h5>Violation Of Terms And Liquidated Damages</h5>

		<p>Please report any violations of the terms, by flagging the posting(s) for review, or by emailing to wecare@Wizlyst.com. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches.</p>
		
		<p>You understand and agree that, because damages are often difficult to quantify, if it becomes necessary for Wizlyst to pursue legal action to enforce these terms, you will be liable to pay Wizlyst as liquidated damages, which you accept as reasonable estimates of quenchlist’s damages for the specified breaches of these terms:</p>
		
		<p>If you post a message that (1) impersonates any person or entity; (2) falsely states or otherwise misrepresents your affiliation with a person or entity; or (3) that includes personal or identifying information about another person without that person's explicit consent,(4) if Wizlyst establishes limits on the frequency with which you may access the service, or terminates your access to or use of the service,(5)if you send unsolicited email advertisements to Wizlyst email addresses or through Wizlyst computer systems,(6)if you post messages in violation of these terms of use, other than as described above,(7) if you aggregate, display, copy, duplicate, reproduce, or otherwise exploit for any purpose any content (except for your own content) in violation of these terms without quenchlist’s express written permission.</p></li>
	</ol>

		<br />
	</div>
		<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
</body>
</html>