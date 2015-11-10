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
	<title>Wizlyst - Jobs</title>
	
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
			<span class="cat_header">Wizlyst Jobs</span>
		</div>
		<h4>Why work at Wizlyst?</h4>
		<div style="padding-left: 30px">
		<ul>
			<li>At Wizlyst.com you get the opportunity to spend your summer exploring your creativity and technical skills by developing real-world applications.</li>
			<li>You won’t be developing just for gaining industrial experience, but you will get the opportunity to collaborate with fresh minds in your field in India and US to implement some exciting ideas and get credits for that.</li>
			<li>We don’t believe in working in black & white cubicles. Creativity comes out in comfortable environments. So our interns get the full independence to work in their preferred environment.</li>
			<li>We at Wizlyst.com give equivalent benefits to people who contribute to our business. So you will get monetary benefits and numerous goodies during this period.</li>
			<li>In the end you will get a certificate for adding in your career profile and a token of appreciation. You will have the opportunity to join us as a full-time employee once you are completed with your graduation.</li>
		</ul>
		</div>
		<hr />
		<h4 id="wad">Web Application Developer</h4>
		<br />
		<div class="job">
		<img src="img/comp.png" align="left" style="padding-right:15px; padding-bottom:15px;" />
		<strong>Job Description:</strong>
		<br />
		<p>Are you tired of building prototype web pages and desktop applications for your course projects? Do you want to make use of your technical knowledge and skills to develop some real-world application? Then you are certainly the person we are looking for. Wizlyst.com is a place where fresh minds collaborate to come up with new ideas to serve our community with some web applications that they have been anticipating for years.</p>
		<p>As a Web Application Developer at Wizlyst.com, you won’t be developing web application just for your experience. You will be given the opportunity to work on modules that will go live in few days and you will see daily users using your developed module every day. You will get a chance to collaborate with people in this field in India and US. </p>
		<br />
		<b>Background and Experience Required:</b>
		<br />
		<div style="padding-left: 30px">
		<ul>
		<li>B.Tech, BCA or MCA in Computer Science, Information Technology or equivalent.</li>
		<li>Experience with HTML/XHTML, CSS, PHP, MySQL.</li>
		<li>Some experience in JavaScript, AJAX including common libraries like JQuery. </li>
		<li>Knowledge of HTML 5 and CSS 3 is a plus.</li>
		<li>Experience with PHP Frameworks is a plus.</li>
		<li>Some experience with social media integration is preferred.</li>
		<li>Must be passionate, self-motivated programmer.</li>
		</ul>
		</div>
		</div>
		<a class="btn btn-success" href="#apply" title="Apply Now" >Apply Now</a>
		<hr />
		<h4>Android Mobile App Developer</h4>
		<br />
		<div class="job">
		<img src="img/Android.png" align="left" style="padding-right:15px; padding-bottom:15px;" />
		<strong>Job Description:</strong>
		<br />
		<p>Let’s be honest. Do you know why we still don’t have an Android app? Because we are waiting for a kick-ass Android developer like you, to develop our app. We provide you with the platform to explore your creativity and technical skills to develop our app which will be used by millions of users over the years.</p>
		<p>At Wizlyst.com you won’t be developing app just for your experience. But you will see your app being used by several users every day and you will get credits for that. You will be working in collaboration with developers in India and US. 
		</p>
		<br />
		<b>Background and Experience Required:</b>
		<br />
		<div style="padding-left: 30px">
		<ul>
		<li>B.Tech, BCA or MCA in Computer Science, Information Technology or equivalent.</li>
		<li>Experience in Android application development.</li>
		<li>Must be passionate, self-motivated programmer.</li>
		</ul>
		</div>
		</div>
		<a class="btn btn-success" href="#apply" title="Apply Now" >Apply Now</a>
		<hr />
		<h4>Marketing and Creative Personnel</h4>
		<br />
		<div class="job">
		<img src="img/marketing.png" align="left" style="padding-right:15px; padding-bottom:15px;" />
		<strong>Job Description:</strong>
		<br />
		<p>Do you have new marketing strategy? Want to apply them in a real-world scenario? Then there can’t be a better place than Flickbazar.com where we incubate new ideas with fresh minds. Join us and spend the summer exploring your marketing skills in real market out there. 
		</p>
		</div>
		<a class="btn btn-success" href="#apply" title="Apply Now" >Apply Now</a>
		<br /><br /><br />
		<hr />
		<div id="apply">
		<h4>How to apply?</h4>
		<div class="job">
		<p>We are already in search for potential candidates for these exciting positions in colleges. You know India is too big and it is difficult for us to reach out to everyone separately. But we believe that there are talents spread in all corners of India. So please send us your CV/ resume to below mentioned email address specifying which position(s) you are interested in. There is always someone waiting for you at Wizlyst.com to give you an equal opportunity.</p>
		<p>If your profile does not fit into our present requirements, still we are interested in you. Send us your CV/ resume with a brief explanation of what contributions you can make in our company. We would love to explore different areas of development.</p>
		<br />
		<b>Email us at: </b><a href="mailto:jobs@wizlyst.com">jobs@wizlyst.com</a>
		</div>
		</div>
		<br />
	</div>
		<!--      Footer Start     -->
		<?php
		include_once "footer.php";
		?>
		<!--      Footer End     -->
</body>
</html>