<!DOCTYPE html>
<html>
<head>
	<title>Testing</title>
</head>
<body>

<div id="test">
	<script type="text/javascript">
		function sendMail() {
             xmlhttp = new XMLHttpRequest();
             xmlhttp.open("GET","<?php echo site_url('Main/testing'); ?>",false);
             xmlhttp.send(null);
//                 console.log(xmlhttp.responseText);
//                document.getElementById("getdata").innerHTML = Date();
            document.getElementById("test").innerHTML = xmlhttp.responseText;
        }
        setInterval(function () {
            sendMail();
        }, 5000);
	</script>
</div>

</body>
</html>