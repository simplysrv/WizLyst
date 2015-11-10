<?php
	echo "PHP IP Fetch: ".$_SERVER['REMOTE_ADDR'].",".$_SERVER['HTTP_X_FORWARDED_FOR'];
	
	$result = 23400/43;
	echo "<br />Test: ".round($result, 2)."<br />";
?>
<html>
<head>
<script type="text/javascript">
    window.onload = function () {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://jsonip.appspot.com/?callback=DisplayIP";
        document.getElementsByTagName("head")[0].appendChild(script);
    };
    function DisplayIP(response) {
        document.getElementById("ipaddress").innerHTML = "Your IP Address is " + response.ip;
    }
</script>
</head>
<body>
<span id = "ipaddress"></span>
</body>
</html>

