<div class="container">
<?php
	include_once "top_navigation.php";
?>
<script>
$(document).ready(function(){
	$("#search_btn").click(function(){
		var search_string = $(".search_input").val();
		window.location.href = "searchresult.php?s_string="+search_string;
	});
});
</script>
<!--    Logo & Search Section Start     -->
		<div class="row">
			<div class="span3">
				<a href="index.php" title="Wizlyst.com" ><img src="img/new_logo.png" alt="Wizlyst logo" style="margin:auto; height: 80px;"></a>
			</div>
			<div class="span6">
			<br />
				<div class="input-append">
  					<input class="span5 search_input" id="appendedDropdownButton" style="padding: 11px 11px;" type="text" placeholder="Enter what you are looking for.">
  					<button class="btn btn-large btn-primary"  id="search_btn" type="button"><i class="icon-search icon-white"></i> Search</button>
  				</div>
  			</div>
			<div class="span3">
			<br />
					<a class="btn btn-success btn-large pull-right" href="post.php?#ad_details" title="Sell your product now" >Post Free Ad</a>
			</div>
		</div>
</div>
<hr />
<!--    Logo & Search Section End     -->
