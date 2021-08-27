<?php
//localhost
//$con = mysql_connect("68.178.137.53","capitolmarketing","Capitol@1");
//mysql_select_db("capitolmarketing",$con) or trigger_error(mysql_error());
//server
/*$con = mysql_connect("localhost","cmattox_capitol",")t7kh@w0rWi;");
mysql_select_db("cmattox_capitolmarketingdeals",$con) or trigger_error(mysql_error());*/


$con = mysqli_connect("localhost","cmattox_capitol",")t7kh@w0rWi;", "cmattox_capitolmarketingdeals") or trigger_error(mysqli_error($con));

// pixiders
/*$con = mysql_connect("50.63.104.142","shop4agent","Shop4agent@");
mysql_select_db("shop4agent",$con) or trigger_error(mysql_error());*/
?>