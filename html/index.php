<?php
session_start();

require_once('../includes/myconn.php'); 

if(isset($_POST['check']))
{  
   if($_POST['certi']!="")
   {  
	$certies=mysqli_real_escape_string($con, $_POST['certi']);
	
	$certi=str_replace(" ","",$certies);
	
	$sql="SELECT * FROM capXlsx WHERE certificate='".$certi."' AND status = '0'";
	$res=mysqli_query($con, $sql);
	$data=mysqli_fetch_assoc($res);
	$check=mysqli_num_rows($res);
	
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
	
    <script src="../general/general.js"></script>

<title>Pickyourtrip.com</title>
	
</head>
<style>

</style>
<body>


<div class="container-fluid">
<div class="white-box-outer">
<div class="white-box-content">
<div class="img-outer"><img src="images/hotel-stay.jpg" class="img-responsive"></div>
<p class="note">please enter your voucher code to pick your trip</p>
		<form class="form-outer" method="post" enctype="multipart/form-data" name="certificate" onSubmit="return check_signin()" >
			<div class="input-outer">
				<input type="text" name="certi" id="certi">
				<button type="submit" class="sub-btn" name="check" >SUBMIT</button>
				<br/>
				<span style="color:red" class="error" id="certix" ></span>
				<?php if ( isset($error_msg)) { ?>	<br>
								<span style="color:red" id="error_msg"> <?php echo $error_msg;?> </span>	<?php } ?> 
			</div>
		</form>
<p class="info-note">Once you register your voucher number your travel request forms will be mailed to you</p>
<div class="footer-img">
<div class="row">

<div class="col-md-offset-1 col-md-5 col-sm-offset-1 col-sm-5 col-xs-offset-1 col-xs-5 ">
<img src="images/bed-room.jpg" class="img-responsive">

</div>
<div class="col-md-5 col-sm-5 col-xs-5">
<img src="images/hotel.jpg" class="img-responsive">
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