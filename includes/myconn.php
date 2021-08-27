<?php
//localhost
//$con = mysql_connect("68.178.137.53","capitolmarketing","Capitol@1");
//mysql_select_db("capitolmarketing",$con) or trigger_error(mysql_error());
//server
$con = mysqli_connect("localhost","selectgi_pickvac","S)S!3kp+#MHk");
mysqli_select_db($con, "selectgi_picikyour-vacation") or trigger_error(mysqli_error($con));
if (!$con) {
	echo "Not connected";
}
// pixiders
/*$con = mysql_connect("50.63.104.142","shop4agent","Shop4agent@");
mysql_select_db("shop4agent",$con) or trigger_error(mysql_error());*/
?>