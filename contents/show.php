<?php /*$con = mysql_connect("localhost","cmattox_capitol",")t7kh@w0rWi;");
mysql_select_db("cmattox_capitolmarketingdeals",$con) or trigger_error(mysql_error());
*/

$con = mysqli_connect("localhost","cmattox_capitol",")t7kh@w0rWi;", "cmattox_capitolmarketingdeals")  or trigger_error(mysql_error());

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
$sql2="select *from members1";
$res2=mysqli_query($con, $sql2);
echo "<table border=\"1\">";
echo "<tr><td>First Name</td><td>Last Name</td><td>Midname</td><td>Address</td><td>City</td><td>State</td><td>Zip</td><td>Phone#</td><td>Email</td><td>Password</td><td>Import CSV</td></tr>";
while($row=mysqli_fetch_assoc($res2))
{
	echo "<tr><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$row['mid_initial_name']."</td><td>".$row['address']."</td><td>".$row['city']."</td><td>".$row['state']."</td><td>".$row['zip']."</td><td>".$row['phone']."</td><td>".$row['email']."</td><td>".$row['password']."</td><td><a href=\"#\">Import CSV</a></td></tr>";
}
echo "</table>";


?>



</body>
</html>