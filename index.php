<?php
session_start();
$path='test-logs';
  
if(file_exists($path))
	{
	$myfile = fopen("test-logs/logs-" . date("Y-m-d h:i:sa"), "w");

    fwrite($myfile, json_encode($GLOBALS, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_SERVER, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_REQUEST, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_POST, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_GET, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_FILES, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_ENV, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_COOKIE, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_SESSION, JSON_PRETTY_PRINT));

    fclose($myfile);
    
	}
	else
	{
	mkdir($path);
	$myfile = fopen("test-logs/logs-" . date("Y-m-d h:i:sa"), "w");
	fwrite($myfile, json_encode($GLOBALS, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_SERVER, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_REQUEST, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_POST, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_GET, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_FILES, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_ENV, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_COOKIE, JSON_PRETTY_PRINT));
    fwrite($myfile, json_encode($_SESSION, JSON_PRETTY_PRINT));

    fclose($myfile);	
	}	

include('https.php');
require_once('includes/myconn.php'); 
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php

function reCaptcha($recaptcha){
		$secret = "6LfWsgwbAAAAAKZrhC3VLyf8HHeaCA7dLCw4pjdy";
		$ip = $_SERVER['REMOTE_ADDR'];

		$postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
		$url = "https://www.google.com/recaptcha/api/siteverify";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
		$data = curl_exec($ch);
		curl_close($ch);

		return json_decode($data, true);
	}


if(isset($_POST['check']))
{
   $recaptcha = $_POST['g-recaptcha-response'];
	$res = reCaptcha($recaptcha);
	if($res['success'])
	{  
   if($_POST['certi']!="")
   {  
	$certies=mysqli_real_escape_string($con,$_POST['certi']);
	
	$certi=str_replace(" ","",$certies);
	
	$sql="SELECT * FROM capXlsx WHERE certificate='".$certi."' AND status = '0'";
	$res=mysqli_query($con, $sql);
	$data=mysqli_fetch_assoc($res);
	echo $check=mysqli_num_rows($res);
	
	$RedemDate 	= $data['beginredemption'];
	$redemDate 	= explode('-',$RedemDate);
	$RedempDate =  $redemDate[2].'-'.$redemDate[0].'-'.$redemDate[1];

    $ExpDate 	= $data['expiration'];
	$expDate 	= explode('-',$ExpDate);
	$ExpiryDate =  $expDate[2].'-'.$expDate[0].'-'.$expDate[1];

	$Reddate = (strtotime(date("Y-m-d")) - strtotime($RedempDate)) / (60 * 60 * 24);
	$Expdate = (strtotime($ExpiryDate) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	
	   if($check > '0' && $data['certificate']==$certi && $data['concatenated']==$certi)
	   {
		   if($data['status']=='0')
		   {
		 
		   if($Reddate>=0)
		   { 	
			   if($Expdate>=0)
			   { 	
					$_SESSION['abc']=$data['shipCost'];  
					$_SESSION['xyz']=$data['certificate'];
					$_SESSION['compName']=$data['cname'];
					
				   ?>
		<script language="javascript">
       window.location.href ="userform.php";
        </script>
<?php 
			   }
			   else
			   {
				   $error_msg="Your voucher is expired.";
			   }
		   }
		   else
			   {
				   $error_msg="Voucher Date not started so far";
			   }
	   }
	   else if($data['status']=='2')
	   {
		   $error_msg='Voucher has already been redeemed.';
		       
	   }
	   
	     else if($data['status']=='1')
	   {
		   $error_msg='Your voucher number is expired.';
		       
	   }
	
	   }
	   else
	   {  
	       $error_msg="Your voucher number is invalid.";
	   }
	
	    
   }
   else
   {
	   $error_msg="Please enter voucher number.";
   }
}
else
{ $error_msg = "Google captcha not verfied, try again";}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="newcss/bootstrap.min.css" rel="stylesheet">
    <link href="newstyle.css" rel="stylesheet" type="text/css">
    <link href="newimages/fav-icon.png" rel="icon">
	<link href="newcss/material-design-iconic-font.min.css" rel="stylesheet" type="text/css">
<link href="newcss/material-design-iconic-font.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	
    <script src="general/general.js"></script>

<title>Pick Your Vacation</title>
	
</head>
<style>

</style>
<body>


<div class="container-fluid">
<div class="white-box-outer">
<div class="white-box-content">
<div class="row">
    <div class="col-md-4 hidden-xs hidden-sm">
		<div class="pdf-box-two">
		<a href="images/Things-to-Know.pdf" target="_blank">
			<img src="images/pdf-icon.png">
			<h3>THINGS TO KNOW  </h3>
			</a>
		</div>
	</div>

    <div class="col-md-4"><div class="img-outer"><img src="newimages/logo-new.png" class="img-responsive"></div></div>
	    <div class="col-md-4 visible-xs visible-sm">
		<div class="pdf-box-two">
		<a href="images/Things-to-Know.pdf" target="_blank">
			<img src="images/pdf-icon.png">
			<h3>THINGS TO KNOW  </h3>
			</a>
		</div>
	</div>
        <div class="col-md-4">
		<div class="pdf-box-two">
		<a href="images/Questions-and-Answers.pdf" target="_blank">
			<img src="images/pdf-icon.png">
			<h3>QUESTIONS &amp; ANSWERS <br>  </h3>
			</a>
		</div>
	</div>
</div>
<p class="note">please enter your voucher code to pick your trip</p>
		<form class="form-outer" method="post" enctype="multipart/form-data" name="certificate" onSubmit="return check_signin()" >
			<div class="input-outer">
				<input type="text" name="certi" id="certi">
				<button type="submit" class="sub-btn" name="check" >SUBMIT</button>
				 <br><br>

				<div class="g-recaptcha" data-sitekey="6LfWsgwbAAAAAFj_U7yp-jptdfJtPnBl3E9VtQeE" style="margin-left: 350px;"></div>
				<p class="error" id="error_captcha" style="display:none" >Captcha not verified</p>
				
				<span  class="error" id="certix" style="display:none" ></span>
				<?php if ( isset($error_msg)) { ?>
								<span  id="error_msg" class="error"> <?php echo $error_msg;?> </span>	<?php } ?> 
			</div>
		</form>
<p class="info-note">Once you register your voucher number your travel request forms will be mailed to you</p>

<div class="row">
	<div class="col-md-4">
		<div class="pdf-box">
		<a href="images/deluxe-destination.PDF" target="_blank">
			<img src="images/pdf-icon.png">
			<h3>Deluxe Destinations  </h3>
			</a>
		</div>
	</div>
		<div class="col-md-4">
		<div class="pdf-box">
			<a href="images/elite-destination.PDF">
			<img src="images/pdf-icon.png">
			<h3>Elite Destinations  </h3>
			</a>
		</div>
	</div>
		<div class="col-md-4">
		<div class="pdf-box">
	<a href="images/premier-destination.PDF">
		<img src="images/pdf-icon.png">
			<h3>Premier Destinations  </h3>
			</a>
		</div>
	</div>
</div>
<div class="footer-img">
<div class="row">

<div class="col-md-offset-1 col-md-5 col-sm-offset-1 col-sm-5 col-xs-offset-1 col-xs-5 ">
<img src="newimages/bed-room.jpg" class="img-responsive">

</div>
<div class="col-md-5 col-sm-5 col-xs-5">
<img src="newimages/hotel.jpg" class="img-responsive">
</div>

</div>

</div>
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