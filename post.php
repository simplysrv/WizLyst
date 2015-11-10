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
	<title>Wizlyst - Post new ad</title>
	
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
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->  
    <!--[if lt IE 9]>  
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>  
    <![endif]-->

    <script>
	function category(category,Subcategory,idCount){
		document.getElementById("select_cat").innerHTML = category+" > "+Subcategory;
		document.getElementById("summary_category").innerHTML = category+" > "+Subcategory;
		$("#form_category").val(category);
		$("#form_subcategory").val(Subcategory);
		$(".subcat").css("font-weight", "normal");
		$("#"+idCount).css("font-weight", "bold");
		$("#category_table").slideUp("slow");
		$("#change_cat_selection").show();
	}

	function city () {
		var location = $("#searchTextField").val();
		var item = location.split(",");
		var len = item.length;
		
		if(len < 3){
			$("#location_notification").html("<div class='alert alert-danger'>Invalid location. Select a city.</div>");
			return false;
		}else{
			$("#location_notification").html("");
		}
			
		//alert("Country:"+item[len - 1]+" <br />State: "+item[len - 2]+" <br />City: "+item[len - 3]+" <br />Locality: "+item[len - 4]);
		if(len > 3){
			var local = item[len - 4];
		}else{
			var local = "Not Specified";
		}
		
		document.getElementById("local").innerHTML = local;
		document.getElementById("summary_locality").innerHTML = local;
		$("#form_locality").val(local);

		document.getElementById("city").innerHTML = item[len - 3];
		document.getElementById("summary_city").innerHTML = item[len - 3];
		$("#form_city").val(item[len - 3]);

		document.getElementById("state").innerHTML = item[len - 2];
		document.getElementById("summary_state").innerHTML = item[len - 2];
		$("#form_state").val(item[len - 2]);

		document.getElementById("country").innerHTML = item[len - 1];
		document.getElementById("summary_country").innerHTML = item[len - 1];
		$("#form_country").val(item[len - 1]);
		
		if(len > 3){
			document.getElementById("select_location").innerHTML = local+", "+item[len - 3]+", "+item[len - 2]+", "+item[len - 1];
		}else{
			document.getElementById("select_location").innerHTML = item[len - 3]+", "+item[len - 2]+", "+item[len - 1];
		}
		
		$("#location_table").slideUp("slow");
		$("#change_loc_selection").show();
	}
	
	function getCity(state){
		$("#location_box").html("<br><br><br><center><img src='img/loading.gif' /></center>");
 		$.ajax({
 			type: "POST",
 			url: "getCity.php",
 			data: {state:state}
		}).done(function( result ) {
			$("#location_box").html( result );
		});

	}
	
	function getStateAgain(){
		$("#location_box").html("<br><br><br><center><img src='img/loading.gif' /></center>");
		$('#location_box').load('city_state.php');
	}
	
	function getLocality(city, state){
		$("#location_box").html("<br><br><br><center><img src='img/loading.gif' /></center>");
 		$.ajax({
 			type: "POST",
 			url: "getLocaltiy.php",
 			data: {city:city, state:state}
		}).done(function( result ) {
			$("#location_box").html( result );
		});
	
	}
	
	function submitLocation(State,city){
		var locality = $("#locality").val();
		
		if(locality == ""){
			var locality = "Not Specified";
		}
				
		document.getElementById("local").innerHTML = locality;
		document.getElementById("summary_locality").innerHTML = locality;
		$("#form_locality").val(locality);

		document.getElementById("city").innerHTML = city;
		document.getElementById("summary_city").innerHTML = city;
		$("#form_city").val(city);

		document.getElementById("state").innerHTML = State;
		document.getElementById("summary_state").innerHTML = State;
		$("#form_state").val(State);

		document.getElementById("country").innerHTML = "India";
		document.getElementById("summary_country").innerHTML = "India";
		$("#form_country").val("India");
		
		if(locality != "Not Specified"){
			document.getElementById("select_location").innerHTML = locality+", "+city+", "+State+", India";
		}else{
			document.getElementById("select_location").innerHTML = city+", "+State+", India";
		}
		
		$("#location_table").slideUp("slow");
		$("#change_loc_selection").show();
		
		$('#message').modal('hide');
		$('body').removeClass('modal-open');
		$('.modal-backdrop').remove();
	}

	function signup_change(){
		$("#sign_up_1").hide();
		$("#sign_up_2").show();
	}
	
	function IsEmail(email) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
	
	function isNumber(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}

	function post_signIn(){

		var email = $('#signIn_email').val();
		var password = $('#signIn_password').val();
		
		if(email == "" || password == ""){
			$("#post_sign_in_notification").html("<div class='alert alert-danger'>Email/Password field empty.</div>");
			return false;
		}

		if(!IsEmail(email)){
			$("#post_sign_in_notification").html("<div class='alert alert-danger'>Invalid Email</div>");
			return false;
		}

 		$("#post_sign_in").html("<br><br><br><div class='span1 offset1'><img src='img/loading.gif' /></div>");

 		$.ajax({
 			type: "POST",
 			url: "post_sign_in.php",
 			data: {email:email, pass:password}
		}).done(function( result ) {
			$("#signIn").html( result );
			$("#signUp").hide();
			$("#publish").removeAttr("disabled");
			
			var uid = $("#User_id").text();
			if(uid < 1){
				$("#signUp").show();
				$("#publish").attr("disabled", "disabled");
			}else{
				$("#form_uid").val(uid);
			}
		});
	}

	function post_signUp(){

		$("#post_sign_up_notification").html("<center><img src='img/validating.gif' /></center>");

		var err_flag = 0;
		var err_message = "<ul>";
		
		var type = $('input:radio[name=user_type]:checked').val();
		if (type == "individual") {
			var l_name = document.getElementById('post_sign_up_last_name').value;
			var f_name = document.getElementById('post_sign_up_First_name').value;
			var c_name = "";
			
			if(f_name == "" || l_name == ""){
				err_flag = 1;
				err_message = err_message + "<li>First/Last Name field is empty.</li>";
			}
			
		}else if (type == "company") {
			var f_name = "";
			var l_name = "";
			var c_name = document.getElementById('post_sign_up_c_name').value;
			
			if(c_name == ""){
				err_flag = 1;
				err_message = err_message + "<li>Company Name field is empty.</li>";
			}
		}

		var email = document.getElementById('post_sign_up_Email').value;
		
		if(!IsEmail(email)){
			err_flag = 1;
			err_message = err_message + "<li>Invalid email address.</li>";
		}
		
		var password = document.getElementById('post_sign_up_Password').value;
		var conf_password = document.getElementById('post_sign_up_conf_Password').value;
		
		if(password == "" || conf_password == "" || password != conf_password){
			err_flag = 1;
			err_message = err_message + "<li>Password does not match.</li>";
		}
		
		var address = document.getElementById('post_sign_up_Address').value;
		
		var phone = document.getElementById('post_sign_up_Phone').value;
		
		if(phone == "" || !isNumber(phone)){
			err_flag = 1;
			err_message = err_message + "<li>Invalid phone number</li>";
		}
		
		var url = document.getElementById('post_sign_up_Website').value;

		if ($("#Tc").is(':checked')) {
        	var tc = 1;
        }else{ 
        	var tc = 0;
        }
		
		if(tc != 1){
			err_flag = 1;
			err_message = err_message + "<li>Terms & Conditions not checked.</li>";
		}
		
		if(err_flag == 1){
			err_message = err_message + "</ul>";
			$("#post_sign_up_notification").html("<div class='alert alert-danger'>"+err_message+"</div>");
			return false;
		}else{
			$("#post_sign_up_notification").html("");
		}

		if ($("#Newsletter").is(':checked')) {
        	var newsletter = 1;
        }else{
        	var newsletter = 0;
        }

        // Initializting loader icon
 		$.ajax({
 			type: "POST",
 			url: "post_sign_up.php",
 			data: {type:type, f_name:f_name, l_name:l_name, c_name:c_name, email:email, password:password, address:address, phone:phone, url:url, tc:tc, newsletter:newsletter}
		}).done(function( result ) {
			$("#post_sign_Up").html( result );
			$("#signIn").hide();
			var uid = $("#User_id").text();
			if(uid < 1){
				$("#signIn").show();
			}else{
				$("#form_uid").val(uid);
				$("#publish").removeAttr("disabled");
			}
		});
	}

	$(document).ready(function(){
		
		$("#contact_details").hide();
		$("#sign_up_2").hide();
		$("#co").hide();
		$("#change_cat_selection").hide();
		$("#change_loc_selection").hide();
		$("#publish").attr("disabled", "disabled");
		
		var tuid = $("#User_id").text();
		if(tuid > 0){
			$("#publish").removeAttr("disabled");
		}
		
		$("#change_cat_selection").click(function(){
			$("#category_table").slideToggle("slow");
  		});
		
		$("#change_loc_selection").click(function(){
			$("#location_table").slideToggle("slow");
  		});

  		$("#publish").click(function(){
			var uid = $("#User_id").text();
			if(uid < 1){
				$("#signUp").show();
				$("#publish").attr("disabled", "disabled");
				return false;
			}else{
				$("#form_uid").val(uid);
				$("#post_ad").submit();
			}
  		});
		
  		$("#next").click(function(){
		
			var err_message = "<ul>";
			var err_flag = 0;
			
			var cat = $("#form_category").val();
			var subcat = $("#form_subcategory").val();
			if(cat == "" || subcat == ""){
				err_flag = 1;
				err_message = err_message + "<li>Select category & subcategory.</li>";
			}
			
			var loc = $("#form_locality").val();
			var city = $("#form_city").val();
			var state = $("#form_state").val();
			var country = $("#form_country").val();
			if(loc == "" || city == "" || state == "" || country == ""){
				err_flag = 1;
				err_message = err_message + "<li>Select location.</li>";
			}
			
			var text = $("#ad_title").val();
			if(text == ""){
				err_flag = 1;
				err_message = err_message + "<li>Ad title is empty.</li>";
			}
			
			var desc = $("#ad_desc").val();
			if(desc == ""){
				err_flag = 1;
				err_message = err_message + "<li>Ad description is empty.</li>";
			}
			
			var price = $("#form_price").val();
			if(price == ""){
				err_flag = 1;
				err_message = err_message + "<li>Ad price is empty.</li>";
			}
			
			if(err_flag == 1){
				$("#summary_notification").html("<div class='alert alert-danger'>"+err_message+"</div>");
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			}else{
				$("#summary_notification").html("");
			}
				
    		$("#ad_details").fadeOut(function(){
    			$("#contact_details").fadeIn("slow");
    		});
  		});

  		$("#next_small").click(function(){
    		$("#ad_details").fadeOut(function(){
    			$("#contact_details").fadeIn("slow");
    			$("#bar").css("width","60%");
    		});
  		});

  		$("#previous").click(function(){
    		$("#contact_details").fadeOut(function(){
    			$("#ad_details").fadeIn("slow");
    			$("#bar").css("width","1%");
    		});
  		});

  		$("#ad_title").change(function(){
  			var text = $("#ad_title").val();
  			$("#summary_title").text(text);
			$("#form_title").val(text);
			
		});

		$("#price").change(function(){
  			var text = $("#price").val();
  			$("#summary_price").html("<span class='WebRupee'>Rs.</span>"+text);
			$("#form_price").val(text);
		});

		$("#free").click(function(){
			var $this = $(this);
    
    		if ($this.is(':checked')) {
        		$("#summary_price").text("Free");
				$("#form_price").val("0");
				$("#form_free").val("1");
				$("#price").val("");
				$("#price").prop('disabled', true);
        		$("#negotiable").attr("disabled", true);
    		}else{
    			$("#negotiable").attr("disabled", false);
				$("#price").prop('disabled', false);
    		}
		});

		$("#negotiable").click(function(){
			var $this = $(this);
    
    		if ($this.is(':checked')) {
        		$("#summary_price").text("Negotiable");
				$("#form_price").val("0");
				$("#form_negotiable").val("1");
				$("#price").val("");
        		$("#price").prop('disabled', true);
        		$("#free").attr("disabled", true);
    		}else{
    			$("#free").attr("disabled", false);
				$("#price").prop('disabled', false);
    		}
		});

		$("input:radio[name=user_type]").click(function(){
			var val = $('input:radio[name=user_type]:checked').val();
			if (val == "individual") {
				$("#co").hide();
    			$("#ind").show();
			}else if (val == "company") {
				$("#ind").hide();
    			$("#co").show();
			}
		});

	});

	</script>

	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

    <script>
	function initialize() {
	  var mapOptions = {
	    center: new google.maps.LatLng(-33.8688, 151.2195),
	    zoom: 13,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  var map = new google.maps.Map(document.getElementById('map-canvas'),
	    mapOptions);

	  var input =(document.getElementById('searchTextField'));
	var options = {
	  types: ['(cities)'],
	  componentRestrictions: {country: 'in'}
	};

	  var autocomplete = new google.maps.places.Autocomplete(input,options);

	  autocomplete.bindTo('bounds', map);

	  var infowindow = new google.maps.InfoWindow();
	  var marker = new google.maps.Marker({
	    map: map
	  });

	  google.maps.event.addListener(autocomplete, 'place_changed', function() {
	    infowindow.close();
	    marker.setVisible(false);
	    input.className = '';
	    var place = autocomplete.getPlace();
	    if (!place.geometry) {
	      input.className = 'notfound';
	      return;
	    }

	    var address = '';
	    if (place.address_components) {
	      address = [
	        (place.address_components[0] && place.address_components[0].short_name || ''),
	        (place.address_components[1] && place.address_components[1].short_name || ''),
	        (place.address_components[2] && place.address_components[2].short_name || '')
	      ].join(' ');
	    }

	    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
	    infowindow.open(map, marker);
	  });
	  // Autocomplete.
	  function setupClickListener(id, types) {
	    var textField= document.getElementById(id);
	    google.maps.event.addDomListener(textField, 'click', function() {
	      autocomplete.setTypes(types);
	    });
	  }

	  setupClickListener('searchTextField', []);
	}


    </script>
	<script type="text/javascript" src="js/nicEdit.js"></script>
	<script type="text/javascript">
		//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	</script>

</head>
<body onLoad="initialize();">

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
				<input id="searchText type="text" placeholder="Kolkata">
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
<!--      Top Navigation Start     -->
<?php
include_once "header.php";
?>
<!--      Top Navigation End     -->
	<div class="container">
		<div class="row">
			<div class="span9">
      			<div id="ad_details">
      			<!-- Product Category Start -->
 					<div class="thumbnail-header">
						<span class="cat_header">Select Category & Subcategory: <span id="select_cat" class="label"></span>&nbsp;<button class="btn btn-small" type="button" id="change_cat_selection" >Change Selection</button></span>
					</div>
					<div id="category_table">
					<table class="category_table" cellpadding="10" cellspacing="0">     
					  <tr>  
			          	<!--   Colum One Start   -->
			            <td width="33%" valign="top">
						<?php
							$category_list = getAllCategories();
							$rowcount = mysqli_num_rows($category_list);
							$idcount = 1;
							
							$counter = 3;
							while($row = mysqli_fetch_array($category_list)){
						?>
			            	<!--    Category Box Start   -->
			            	<div class="category_thumbnail">
			            		<legend><?php echo $row['category_name']; ?></legend>
			            		<ul>
									<?php
									$subcategory_list = getAllSubcategories($row['category_id']);
									while($row_sub = mysqli_fetch_array($subcategory_list)){
									?>
  									<li class="subcat" id="<?php echo $idcount; ?>" ><a href="#" onclick="category('<?php echo $row['category_name']; ?>','<?php echo $row_sub['subcategory_name']; ?>',<?php echo $idcount; ?>)"><?php echo $row_sub['subcategory_name']; ?></a></li>
  									<?php
										$idcount = $idcount + 1;
									}
									?>
								</ul>
			            	</div>
							<br />
			            	<!--    Category Box End   -->
							<?php
									if($counter <= 1){
										break;
									}
									$counter = $counter - 1;
								}
							?>
			            </td> 
			            <!--   Colum One End   -->

			            <!--   Colum Two Start   --> 
 						<td width="33%" valign="top">
			            	<?php
							
							$counter = $rowcount/3;;
							while($row = mysqli_fetch_array($category_list)){
						?>
			            	<!--    Category Box Start   -->
			            	<div class="category_thumbnail">
			            		<legend><?php echo $row['category_name']; ?></legend>
			            		<ul>
  									<?php
									$subcategory_list = getAllSubcategories($row['category_id']);
									while($row_sub = mysqli_fetch_array($subcategory_list)){
									?>
  									<li class="subcat" id="<?php echo $idcount; ?>" ><a href="#" onclick="category('<?php echo $row['category_name']; ?>','<?php echo $row_sub['subcategory_name']; ?>',<?php echo $idcount; ?>)"><?php echo $row_sub['subcategory_name']; ?></a></li>
  									<?php
										$idcount = $idcount + 1;
									}
									?>
								</ul>
			            	</div>
							<br />
			            	<!--    Category Box End   -->
							<?php
								if($counter <= 1){
									break;
								}
								$counter = $counter - 1;
								}
							?>
			            </td>
			            <!--   Colum Two End   -->

			            <!--   Colum Three Start   --> 
			             <td width="33%" valign="top">
			            	<?php
							$counter = $rowcount/3;;
							while($row = mysqli_fetch_array($category_list)){
							?>
			            	<!--    Category Box Start   -->
			            	<div class="category_thumbnail">
			            		<legend><?php echo $row['category_name']; ?></legend>
			            		<ul>
  									<?php
									$subcategory_list = getAllSubcategories($row['category_id']);
									while($row_sub = mysqli_fetch_array($subcategory_list)){
									?>
  									<li class="subcat" id="<?php echo $idcount; ?>" ><a href="#" onclick="category('<?php echo $row['category_name']; ?>','<?php echo $row_sub['subcategory_name']; ?>',<?php echo $idcount; ?>)"><?php echo $row_sub['subcategory_name']; ?></a></li>
  									<?php
										$idcount = $idcount + 1;
									}
									?>
								</ul>
			            	</div>
							<br />
			            	<!--    Category Box End   -->
							<?php
								if($counter <= 1){
										break;
								}
								$counter = $counter - 1;
								}
							?>
			            </td> 
			            <!--   Colum Three End  -->    	
			          </tr> 
					</table> 
					</div>
					<!-- Product Category End -->

					<!-- Popular Cities Box Start -->
					<div class="thumbnail-header">
					<span class="cat_header">Select Location: <span id="select_location" class="label"></span>&nbsp;<button class="btn btn-small" type="button" id="change_loc_selection" >Change Selection</button></span>
					</div> 
					<div id="location_table">
					<br />
					<span id="location_notification"></span>
					<div id="panel">
					<form class="form-search">
						Search location: 
 						<input id="searchTextField" type="text" placeholder="search location">
 						<button class="btn btn-primary" onclick="city(); return false;">Select</button>
						<a data-toggle="modal" href="#message" class="btn btn-inverse" ><i class="icon-th icon-white"></i> Popular Locations</a>
 					</form>
 					</div>
 					<div id="map-canvas"></div>

 					<table class="table table-bordered">
					 	<tr>  
            				<th>Locality</th>  
            				<th>City</th>  
            				<th>State</th>  
            				<th>Country</th>  
          				</tr>
          				<tr>
          					<td><span id="local"></span></td>
          					<td><span id="city"></span></td>
          					<td><span id="state"></span></td>
          					<td><span id="country"></span></td>
          				</tr>
					</table>
					</div>
 					<!-- Popular Cities Box End -->

 					<div class="thumbnail-header">
					<span class="cat_header">Product Details</span>
					</div>
					<br>
					<form class="form-horizontal" action="submit_ad.php" name="post_ad" id="post_ad" method="POST" enctype="multipart/form-data">
  						<div class="control-group">
    						<label class="control-label" for="inputEmail">Ad Title</label>
    						<div class="controls">
      							<input type="text" class="span6" name ="ad_title" id="ad_title" placeholder="VW Polo Classic 2012 1.6. Excellent condition!" required>
    						</div>
  						</div>
  						<div class="control-group">
    						<label class="control-label" for="inputEmail">Ad Description</label>
    						<div class="controls">
    							<textarea class="span6" rows="7" name="ad_desc" id="ad_desc" required></textarea>
    						</div>
  						</div>
  						<div class="control-group">
    						<label class="control-label" for="inputEmail">Price</label>
    						<div class="controls">
    							<div class="input-prepend input-append">
  									<span class="add-on"><span class="WebRupee">Rs.</span></span>
  									<input class="span2" id="price" type="text">
  									<span class="add-on">.00</span>
								</div>
    						</div>
  						</div>
  						<div class="control-group">
    						<label class="control-label" for="inputEmail"></label>
    						<div class="controls">
    							<label class="checkbox inline">
  									<input type="checkbox" id="free" value="free"> Free
								</label>
								<label class="checkbox inline">
  									<input type="checkbox" id="negotiable" value="negotiable"> Negotiable
								</label>
    						</div>
  						</div>
  						<div class="control-group">
    						<label class="control-label" for="inputEmail">Upload Photos</label>
    						<div class="controls">  			
								<input type="hidden" id="form_category" name="category" value="">
								<input type="hidden" id="form_subcategory" name="subcategory" value="">
								<input type="hidden" id="form_locality" name="locality" value="">
								<input type="hidden" id="form_city" name="city" value="">
								<input type="hidden" id="form_state" name="state" value="">
								<input type="hidden" id="form_country" name="country" value="">
								<input type="hidden" id="form_title" name="title" value="">
								<input type="hidden" id="form_price" name="f_price" value="">
								<input type="hidden" id="form_free" name="f_free" value="0">
								<input type="hidden" id="form_negotiable" name="f_negotiable" value="0">
								<input type="hidden" id="form_uid" name="form_uid" value="">
    							<input class="btn" type="file" name="image0" size="20">
    							<input class="btn" type="file" name="image1" size="20">
    							<input class="btn" type="file" name="image2" size="20">
    							<input class="btn" type="file" name="image3" size="20">
    							<input class="btn" type="file" name="image4" size="20">
    						</div>
  						</div>
  						<button class="btn btn-large btn-success pull-right" id="next" type="button">Next Step <i class="icon-chevron-right icon-white"></i></button>
						<br />
						<br />
						</form>
				</div>
				<div id="contact_details">
					<div class="row">
						<div class="span9">
							<button class="btn btn-small btn-inverse pull-left" id="previous" type="button"><i class="icon-chevron-left icon-white"></i> Previous Step</button>
						</div>
					</div>
					<div class="row">
						<div class="span9">
							<div class="thumbnail-header">
								<span class="cat_header">Personal Profile<span id="select_cat" class="label"></span></span>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
					<?php
						if(!isset($_SESSION['umail'])){
					?>
						<div clas="span9">
							<div class="span4" id="signIn">
								<h3>Existing User</h3>
								<span id="post_sign_in">
								<span id ="post_sign_in_notification"></span>
								<form name="post_sign_in" method="POST" action="#">
  								<fieldset>
									<input name="signIn_email" type="email" id="signIn_email" placeholder="Email" required>
									<input name="signIn_password" type="password" id="signIn_password" placeholder="Password" required>
									<br />
									<button type="submit" class="btn btn-primary" onclick="post_signIn(); return false;">Sign In</button>
  								</fieldset>
								</form>
								</span>
							</div>
							<div class="span4" id="signUp">
								<h3>New User</h3>
								<span id="post_sign_Up">
								<span id="post_sign_up_notification"></span>
								<form name="post_sign_up" method="POST" action="#">
  								<fieldset>
  										<label>I am</label>
  										<label class="radio">
										<input type="radio" name="user_type" id="individual" value="individual" checked>
										Individual
										</label>
										<label class="radio">
										<input type="radio" name="user_type" id="company" value="company">
  										Company
										</label>

										<span id="ind">
											<div class="controls controls-row">
  												<input class="span2" name="post_sign_up_First_name" id="post_sign_up_First_name" type="text" placeholder="First Name">
  												<input class="span2" name="post_sign_up_last_name" id="post_sign_up_last_name" type="text" placeholder="Last Name" />
											</div>
										</span>

										<span id="co">
											<input class="span4" name="post_sign_up_company_name" id="post_sign_up_c_name" type="text" placeholder="Company Name">
										</span>

										<input class="span4" name="post_sign_up_Email" id="post_sign_up_Email" type="email" placeholder="Email" required />

										<div class="controls controls-row">
											<input class="span2" name="post_sign_up_Password" id="post_sign_up_Password" type="password" placeholder="Password" placeholder="Confirm Password" required />
											<input class="span2" name="post_sign_up_conf_Password" id="post_sign_up_conf_Password" type="password" required />
										</div>
									
										<input class="span4" name="post_sign_up_Address" id="post_sign_up_Address" type="text" placeholder="Address" />
										<input class="span4" name="post_sign_up_Phone" id="post_sign_up_Phone" type="tel" placeholder="Phone Number" />
										<input class="span4" name="post_sign_up_Website" id="post_sign_up_Website" type="url" placeholder="Website URL" />
										<label class="checkbox">
										<input name="Tc" id="Tc" type="checkbox"> I agree to terms & conditions
    									</label>
    									<label class="checkbox">
  										<input name="Newsletter" id="Newsletter" type="checkbox" value="1" checked> I would like to receive updates & newsletters
    									</label>
										<br />
										<button type="button" class="btn btn-success" onclick="post_signUp();">Sign Up</button>
  								</fieldset>
								</form>
								</span>
							</div>
						</div>
					<?php
					}else{
						$user_details = getUserDetailsByEmail($_SESSION['umail']);
						$user = mysqli_fetch_array($user_details);
					?>
					<div class="alert alert-success" id="login-success">
					<strong>Well Done!</strong> You are already logged in!
					<br><br>
					<p>
						<strong>User ID:</strong> <span id="User_id"><?php echo $user['user_id']; ?></span>
						<br>
						<strong>Name:</strong> 
						<?php 
						if($user['user_type'] == "individual"){
							echo $user['user_fname']." ".$user['user_lname']; 
						}else{
							echo $user['user_cname'];
						}
						?> 
						<br>
						<strong>Phone:</strong> <?php echo $user['user_phone']; ?>
						<br>
						<strong>Email: </strong> <?php echo $user['user_email']; ?>
					</p>
					</div>
					<?php
					}
					?>
					</div>
					<div class="row">
						<div clas="span9">
							<center><button class="btn btn-large btn-success" id="publish" type="button">Publish</button></center>
						</div>
					</div>
					<br />
					<br />
				</div>
			</div>
			<div class="span3">
				<div class="thumbnail" style="padding:10px 10px;">
					<span id="summary_notification"></span>
					<div class="thumbnail-header">
						<span class="cat_header">Ad Summary</span>
					</div>
					<p>
						<strong>Category</strong>
						<br /><span id="summary_category"></span>
					</p>
					<p>
						<strong>Locality</strong>
						<br /><span id="summary_locality"></span>
					</p>
					<p>
						<strong>City</strong>
						<br /><span id="summary_city"></span>
					</p>
					<p>
						<strong>State</strong>
						<br /><span id="summary_state"></span>
					</p>
					<p>
						<strong>Country</strong>
						<br /><span id="summary_country"></span>
					</p>
					<p>
						<strong>Ad Title</strong>
						<br /><span id="summary_title"></span>
					</p>
					<p>
						<strong>Price</strong>
						<br /><span id="summary_price"></span>
					</p>
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
	<!--  Message Seller Box Start  -->
<div id="message" class="modal hide fade in" style="display: none; ">  
<div class="modal-header">  
<h3>Popular Locations</h3>  
</div>  
<div class="modal-body">  
<div class="row" id="location_box" >
<div class="span2">
	<div class="thumbnail-header">
	<span class="cat_header">Cities</span>
	</div>
	<br />
	<table class="city_table">   
	  <?php
		$city_list = getAllCities();
		$rowcount = mysqli_num_rows($city_list);
		$counter = 0;
		
		while($row = mysqli_fetch_array($city_list)){
			if($counter == 0){
				echo "<tr>";
			}
	?>
		<td><a href="#" onclick="getLocality('<?php echo $row['city_name']; ?>','<?php echo $row['city_state']; ?>')"><?php echo $row['city_name']; ?></a></td>  
	<?php
		if($counter == 0){
			echo "</tr>";
			$counter = 0;
		}else{
			$counter = $counter - 1;
		}
		}
	?> 
	</table>
	<!-- Popular Cities Box End -->
</div>
<div class="span4">
	<div class="thumbnail-header">
	<span class="cat_header">States</span>
	</div>
	<br />
	<table class="city_table">  
	<?php
		$state_list = getAllStates();
		$rowcount = mysqli_num_rows($state_list);
		$counter = 1;
		
		while($row = mysqli_fetch_array($state_list)){
			if($counter == 1){
				echo "<tr>";
			}
	?>
		<td><a href="#" onclick="getCity('<?php echo $row['Name']; ?>')"><?php echo $row['Name']; ?></a></td>  
	<?php
		if($counter == 0){
			echo "</tr>";
			$counter = 1;
		}else{
			$counter = $counter - 1;
		}
		}
	?>
	</table>
</div>

</div>         
</div>  
<div class="modal-footer">  
<a href="#" class="btn" data-dismiss="modal">Close</a> 
</div>  
</div> 
<!--  Message Seller Box End  -->
</body>
</html>