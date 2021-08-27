<?php /*$con = mysql_connect("localhost","cmattox_capitol",")t7kh@w0rWi;");
mysql_select_db("cmattox_capitolmarketingdeals",$con) or trigger_error(mysql_error());*/


$con = mysqli_connect("localhost","cmattox_capitol",")t7kh@w0rWi;", "cmattox_capitolmarketingdeals") or trigger_error(mysqli_error($con));


extract($_REQUEST);

if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
{
	$sql = "select * from members where email='$email'";
	$rsd = mysqli_query($con,$sql);
	$msg = mysqli_num_rows($rsd); //returns 0 if not already exist
}
else
{
	$msg = "invalid";
}
echo $msg;
?>