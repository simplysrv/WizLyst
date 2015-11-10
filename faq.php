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
	<title>Wizlyst - Frequently Asked Questions</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	
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
		<div class="row">
			<div class="span12">
				<h3>Frequently Asked Questions</h3>
				<h4>For Renters and Buyers</h4>
				<ul>
					<li><a href="#faq1">Can I buy or sell in Wizlyst?</a></li>
					<li><a href="#faq2">How do I rent/buy something?</a></li>
					<li><a href="#faq3">Who pays for the service?</a></li>
					<li><a href="#faq4">How do I take control of my account?</a></li>
					<li><a href="#faq5">What if I damage any item which I rent?</a></li>
					<li><a href="#faq6">Can an item be available for rent and also for sell?</a></li>
					<li><a href="#faq7">Do I have to list my items to take rent from other people?</a></li>
					<li><a href="#faq8">Do I need to live near the owner / renter item?</a></li>
					<li><a href="#faq9">What if I can't find what I am looking for?</a></li>
					<li><a href="#faq10">What if I don't find my answer in FAQ section?</a></li>
				</ul>
				<h4>For Owners: <small>People who have listed their items to rent or to sell out to other people.</small></h4>
				<ul>
					<li><a href="#faq11">Can I buy things on Wizlyst?</a></li>
					<li><a href="#faq12">What items can I list?</a></li>
					<li><a href="#faq13">How do I know I will get my things back in good condition?</a></li>
					<li><a href="#faq14">Does it cost anything to list my items?</a></li>
					<li><a href="#faq15">What is social media engagement?</a></li>
					<li><a href="#faq16">How much money should I fix for the renter as deposit for an item?</a></li>
					<li><a href="#faq17">What should I do if I have a company and many products?</a></li>
					<li><a href="#faq18">Will it be safe to rent out an item to an unknown person?</a></li>
					<li><a href="#faq19">How does a customer pay me?</a></li>
					<li><a href="#faq20">Do I need to live near the owner / renter item?</a></li>
					<li><a href="#faq10">What if I don't find my answer in FAQ section?</a></li>
				</ul>
				<hr />
				<div id="faq1"><strong>Can I buy or sell in Wizlyst?</strong></div>
				<div>
					Yes. Wizlyst is all about renting, buying & selling. Unlike others, in Wizlyst everybody can buy, sell or rent stuffs. We provide contact address of the renters and owners, but we are not responsible for any items nor do we charge any money for using our service.
				</div>
				<br/>
				<div id="faq2"><strong>How do I rent/buy something?</strong></div>
				<div>
					Four simple <strong>steps</strong> to renting/buying something: 
					<ol>
						<li>Sign up in Wizlyst (free & easy) to join.</li>
						<li>Select your city, category and search for your item using specific keywords.</li>
						<li>Find the item you want to rent/buy from the search listing page and then click on the item for more details.</li>
						<li>Once on the item details page, the contact details and the price will be displayed and then the user can contact the owner for the specific stuff.</li>
					</ol>
				</div>
				<br/>
				<div id="faq3"><strong>Who pays for the service?</strong></div>
				<div>
					Wizlyst doesn't charge anything for the service provided. Initially membership is completely <strong>free</strong> to put stuffs for sell/rent. The user pays directly for renting or buying the actual item.
				</div>
				<br/>
				<div id="faq4"><strong>How do I take control of my account?</strong></div>
				<div>
					When you sign in with your username and password you will be directed to Wizlyst homepage. From 'My Account' you can edit your personal details and can update it. From the same account you can later post an advertisement for an item (rent/sale). In this way only one Wizlyst account will be maintained against one email ID. You can share your ad in social media platforms and we are building on these features.
				</div>
				<br/>
				<div id="faq5"><strong>What if I damage any item which I rent?</strong></div>
				<div>
					Wizlyst is not responsible for any item or its condition whether it gets damaged or lost. You have to deal with the owner of the item in such a case and its completely between you and the owner.
				</div>
				<br/>
				<div id="faq6"><strong>Can an item be available for rent and also for sell?</strong></div>
				<div>
					Certain products/services are available for sell as well as rent. Please contact the owner and discuss in details. Due to complexity the renting price will not be displayed.
				</div>
				<br/>
				<div id="faq7"><strong>Do I have to list my items to take rent from other people?</strong></div>
				<div>
					Not necessarily, you can take stuffs out for rent without listing your item. But you can choose to rent/buy or sell stuffs with your same username.
				</div>
				<br/>
				<div id="faq8"><strong>Do I need to live near the owner / renter item?</strong></div>
				<div>
					That's up to what you need and how important is it. If you want to travel 10 km for a bunch of DVDs, we can't stop you. Wizlyst doesn't have any control on how you contact the owner/renter.  For smaller items like books, DVDs, the owner may choose to send them to you by post if the user agrees.
				</div>
				<br/>
				<div id="faq9"><strong>What if I can't find what I am looking for?</strong></div>
				<div>
					Wizlyst homepage consists of a 'What do you need' section where you can always submit your details along with the item you need and we will try to respond to your answer as. We will let our buyers know about your need so that you can get your item as soon as possible. In this way we will make a better and larger community by helping each other.
				</div>
				<br/>
				<div id="faq10"><strong>What if I don't find my answer in FAQ section?</strong></div>
				<div>
					You can contact us by dropping an email from the Contact Us page at <i><strong>wecare@wizlyst.com</strong></i> and we will try to solve your query. For technical problems email us at <i><strong>wizlyst@gmail.com</strong></i>.
				</div>
				<br/>
				<!-- ----- -->
				<div id="faq11"><strong>Can I buy things on Wizlyst?</strong></div>
				<div>
					Yes. In Wizlyst owners put stuffs to sell and to rent. Certain items are available both for rent and sale. From the item details you can check the rates for rent and sale and its status. We just connect owners of stuff with buyers of stuff.
				</div>
				<br/>
				<div id="faq12"><strong>What items can I list?</strong></div>
				<div>
					You can list anything that you are comfortable renting out or selling.
				</div>
				<br/>
				<div id="faq13"><strong>How do I know I will get my things back in good condition?</strong></div>
				<div>
					You should deal with the renter when you rent out. You should list your phone number and deal with the renter face to face. Based on the price of the item we suggest keeping some deposit from the renter before renting out. That's the best way to protect your item in case of loss or damage. In no way Wizlyst is responsible for the condition of your item. Also you can make the renter of your item pay you upfront before you rent them the item.
				</div>
				<br/>
				<div id="faq14"><strong>Does it cost anything to list my items?</strong></div>
				<div>
					We don't charge any anything to list your item. You can list as many item as you can from your Wizlyst Account at no cost.
				</div>
				<br/>
				<div id="faq15"><strong>What is social media engagement?</strong></div>
				<div>
					Wizlyst is working to build a social touch. You can share your listing in Facebook/Google Plus/Twitter/Pinterest to reach out to more audiences. The social sharing is available from the product details page on the left sidebar. Also you can comment under a product or you can email the details of the product using different social platforms. We think this way the involvement increase and sellers can reach out to more customers.
				</div>
				<br/>
				<div id="faq16"><strong>How much money should I fix for the renter as deposit for an item?</strong></div>
				<div>
					It's tough to say but make sure that it is enough so that the renter looks after your stuff. But do not ask for too much deposit, or else you will turn the renter off renting from you. If you know the renter personally then you can also rent out an item without a deposit.
				</div>
				<br/>
				<div id="faq17"><strong>What should I do if I have a company and many products?</strong></div>
				<div>
					Sorry, you have to list all your products and it would be displayed in your account. Any buyer interested in your item will also be able to see all your products at the same time. So it's a benefit to you. You can build your own brand.
				</div>
				<br/>
				<div id="faq18"><strong>Will it be safe to rent out an item to an unknown person?</strong></div>
				<div>
					It depends. If the item is costly then you should ask the renter to deposit money before renting and you should give him some receipt if he asks for it. You should keep a photocopy of his identity (driver's license, pan card, voter card or any other form of identity proof with his physical address). But if it's a person from your locality whom you know than you can deal it in your own way.
				</div>
				<br/>
				<div id="faq20"><strong>How does a customer pay me?</strong></div>
				<div>
					It depends on which form of payment you accept. It may be credit card, debit card or cash but let the customer know about it before selling or renting out.
				</div>
				<br/>
				<div id="faq10"><strong>Do I need to live near the owner / renter item?</strong></div>
				<div>
					That's up to you. If you want to travel 10 km to rent out your minivan, who are we to stop you? For smaller items like books, CDs or novelty ties, you might be better off sending it in the post and asking for the money before it.
				</div>
				<br />	
			</div>
		</div>
	</div>
		<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
</body>
</html>