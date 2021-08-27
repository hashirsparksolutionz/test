<?php
session_start();
if(!isset($_SESSION['xyz'])){
	?>
	<script language="javascript">
  window.location.href="/html/index.php"
    </script>
<?php 
}


require_once('../includes/myconn.php');
$q=mysqli_query($con, "SELECT * FROM `userinfo` WHERE `vocher`='".$_SESSION['xyz']."'");
$row=mysqli_fetch_array($q);
$Number	=	mysqli_num_rows($q);
 
$q1=mysqli_query($con, "SELECT * FROM `web_info` WHERE `id`='1'");
$row1=mysqli_fetch_array($q1);
$email=$row1['email'];
$phone=$row1['phone'];
$extension=$row1['extension'];


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="images/fav-icon.png" rel="shortcut-icon" type="text/css">
	<link href="css/material-design-iconic-font.min.css" rel="stylesheet" type="text/css">
<link href="css/material-design-iconic-font.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	

<title>Pickyourtrip.com</title>
	
</head>
<style>

</style>
<body>


<div class="container-fluid">
<div class="white-box-outer">
<div class="white-box-content padd">
<div class="img-outer"><img src="images/hotel-stay.jpg" class="img-responsive"></div>
<h1>THANK YOU</h1>
<i class="zmdi zmdi-assignment-check circle"></i>
<p class="thank-txt">Thank you order has been received. <br>Your choice is <?php echo $row['size']; ?><br> Your Travel Reservation form will be mailed to you. <span><i class="zmdi zmdi-time"></i> Please allow 2-3 weeks for delivery</span></p>

</div>
<div class="footer-info">
<ul class="info-list clearfix">
<li><a href="tel:1-800-238-5659">1-800-238-5659</a> <span>ext. 2232</span></li>
<li><a href="mailto:help@pick-your-trip.com">help@pick-your-trip.com</a></li>
</ul>
</div>
</div>
</div>    
<div class="footer"><p>Copyright © Capitol Marketing Concepts - All Rights Reserved.</p></div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<!--My Custom Jquery File-->

<script>
$(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

});
</script>
</body>
</html>
<?
if($Number > 0){
unset($_SESSION['xyz']);
}
mysqli_close($con);
?>