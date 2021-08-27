<?php

/*$con = mysql_connect("localhost","cmattox_capitol",")t7kh@w0rWi;");
mysql_select_db("cmattox_capitolmarketingdeals",$con) or trigger_error(mysql_error());*/


$con = mysqli_connect("localhost","cmattox_capitol",")t7kh@w0rWi;", "cmattox_capitolmarketingdeals") or trigger_error(mysqli_error($con));


if(isset($_GET['q']))
{
	$sql="SELECT *FROM muni WHERE zipcode='".$_GET['q']."'";

    $res = mysqli_query($con, $sql);
	
    $vals=  "<select name=\"city\" id=\"city\"   onChange=\"showHint1(this.value)\">";

    while ($ary = mysqli_fetch_array($res))
    {
     $vals .="<option  value=\"" . $ary['cityname']  . "\">" . $ary ['cityname']  . "</option>";

    }
    if($vals != "<select name=\"city\">"){
    echo $vals."</select>";
    }
	
}

if(isset($_GET['p']))
{
	$sql1="SELECT *FROM muni WHERE cityname='".$_GET['p']."'";
	$res1 = mysqli_query($con, $sql1);
	$ary1 = mysqli_fetch_array($res1);
	echo "<input type='text' name=\"state\" id=\"state\" value='".$ary1['statename']."' />";
	
} 
	
	
	
	
?>


