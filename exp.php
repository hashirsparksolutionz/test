<?php


session_start();
require_once('myconn.php');
$var=$_SESSION['abc'];
$sql="select * from capXlsx  where shipped='".$var."'";
$res=mysqli_query($con, $sql);
$data=mysqli_fetch_assoc($res);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pick Your Plastic</title>
<head>
    <link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
    <link href="css/generic.css" rel="stylesheet" type="text/css" />
    <link href="css/Plastic.css" rel="stylesheet" type="text/css" />
    <script src="js/mcVideoPlugin.js" type="text/javascript"></script>
    <script src="js/js-image-slider.js" type="text/javascript"></script>
    <script src="js/js-image-slider-2.js" type="text/javascript"></script>
    <script src="js/js-image-slider-3.js" type="text/javascript"></script>
    <script src="js/js-image-slider-4.js" type="text/javascript"></script>
    <script src="js/js-image-slider-5.js" type="text/javascript"></script>
    <script src="js/js-image-slider-6.js" type="text/javascript"></script>
    <script src="js/js-image-slider-7.js" type="text/javascript"></script>
    <script src="js/js-image-slider-8.js" type="text/javascript"></script>
    <style type="text/css">.form-tables td{font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-top:10px;}
.starig{color:#900; font-family:Arial, Helvetica, sans-serif;}
.slider-div-2{width:700px; height:auto; margin-top:5px; background-color:#999;padding:100px}
.registration{width:700px; height:476px; background-color:#fff}
.text-box{width: 225px;height:24px;border: 1px solid #666;border-radius: 3px; padding-left:3px}
.textfield{color:#000; font-family:Arial, Helvetica, sans-serif; font-size:12px}
.h1-deading{font-family:Arial, Helvetica, sans-serif; font-size:24px; }
.hr-margin{margin-top:-15px;}
.btn{ background-image: url(../images/buton.png); height:25px; border: none; color: #fff; border-radius:5px; padding-left:10px; padding-right:10px}
.regsitrationfarm{ font-family:Arial, Helvetica, sans-serif; color:#000; font-size:18px; float: left; margin-top:20px; margin-left:40px}
.cont-11{width:auto; height:350px; margin-top:10px; background-color:#FFF; padding-top:20px; padding-bottom:20px;}
</style>
    </head>
    <body>
    
    
    <center>
    <div class="slide-wrapper">
    	<div class="banner-cont-div">
        <div class="banner-cont"></div>    	        
        </div>
        <div class="cont-11">
        <?php
		$v=$_GET['voch'];
        $sql="select * from userinfo where vocher='".$v."'";
		$res=mysqli_query($con, $sql);
		$row=mysqli_fetch_array($res);
		
		$sql1="select * from orders where user_id='".$row['id']."'";
		$res1=mysqli_query($con, $sql1);
		$row1=mysqli_fetch_array($res1);
		echo "<h1>Thank you</h1>"."<strong>".$row['fname']."</strong>"."&nbsp;&nbsp;&nbsp;"."<strong>".$row['lname']."<strong>"."<br>";
		//echo "Vou".$v."<br>";
		echo "<h3>Your Purchased Products are Below</h3>"."<br>";
		$sql2="select * from order_detail where order_id='".$row1['id']."'";
		$res2=mysqli_query($con, $sql2);
		$counter=1;
		while($row2=mysqli_fetch_array($res2))
		{
		echo $row2['prd_name']."<br>";
		$counter++;
		}
		echo "<strong>Your Purchased Products were mailed to: </strong><br />";
		echo $row['fname']."<br>";
		echo $row['lname']."<br>";
		echo $row['address1']."<br>";
		echo $row['address2']."<br>";
		echo $row['city']."<br>";
		echo $row['state']."<br>";
		echo $row['zip']."<br>";
		
		echo "<strong>If you have any questions, please call (900) 1234-5678 ext. 2333 and one of our gift card specialists will get back to you.</strong>";
		?>
        </div>
        
    </div>
    </center>
        <!--<div id="sliderFrame">
            <div id="slider" >
                <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
            </div>
        </div>-->
    </body>
</html>
