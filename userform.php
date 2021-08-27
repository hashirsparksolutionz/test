<?php
@session_start();
//$_SESSION['xyz'] = "testttestt3";
require_once('includes/myconn.php'); 
//require_once('includes/https.php');
$var=@$_SESSION['xyz'];
	if(!isset($_SESSION['xyz'])){?>
		<script language="javascript" type="text/javascript">
		window.location.href = "index.php";
</script>
		
<?php 	  } 

$fileInfo=mysqli_query($con, "select * from web_info");
$webinfo=mysqli_fetch_array($fileInfo);
$name=$webinfo['name'];
$email=$webinfo['email'];
$url=$_SERVER['SERVER_NAME'];
$var=@$_SESSION['xyz'];

$job="select * from capXlsx  where certificate='".$var."'";
$ressqljob=mysqli_query($con, $job);
$dataressqljob=mysqli_fetch_array($ressqljob);
$jobcer= $dataressqljob['job'];

$sql="select * from capXlsx  where certificate='".$var."'";
$res=mysqli_query($con, $sql);
$data=mysqli_fetch_array($res);
$datetime=date("m-d-Y");
if($_POST['submit1']){

	unset($_SESSION['abc']);
	unset($_SESSION['compName']);
    $fname=$_POST['fname'];
	$lname=$_POST['lname'];	
	$date=date("m-d-Y");
	$p_address=mysqli_real_escape_string($con,htmlentities($_POST['p_address']));
	$a_address=mysqli_real_escape_string($con,htmlentities($_POST['t_address']));
	$city=mysqli_real_escape_string($con,$_POST['city']);
	$state=mysqli_real_escape_string($con,$_POST['state']);
	$zip   =$_POST['zip'];
	$phone			=	$_POST['phone'];
	$emailu			=	$_POST['email'];
	$choicek  =  mysqli_real_escape_string($con,htmlentities($_POST['choicek']));
	$size  =  mysqli_real_escape_string($con,htmlentities($_POST['choicew']));
	
  $q ="update `userinfo` SET fname='".$fname."',`lname`='".$lname."',address1='".$p_address."',`city`='".$city."',state='".$state."',`zip`='".$zip."',`phone`='".$phone."',email='".$emailu."',`product`='".$data['choice01']."',`size`='".$choicek."',`regDate`='".date('Y-m-d')."',`s_check`='1',`Timestamp_used`='".$datetime."' where `vocher`='".$var."' limit 1";
	
	//die();
	
	mysqli_query($con, $q);
	

	$_SESSION['userid'] = $data['certificate'];
	mysqli_query($con, "UPDATE  `capXlsx` SET  `status` =  '1',`Timestamp_used`='".$datetime."' WHERE  `certificate` = '".$var."'");


 /////////////////////////////Mail TO User/////////////////////////// 
$to      		  = $emailu; 
$headers 		  = "From: ".$name." <".$email.">".PHP_EOL;
$headers         .= "MIME-Version: 1.0".PHP_EOL;
$headers         .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
$subject	  	  = $name.' - Trip Promotion';

$AdminBody 	=	'<div align="center" style="width: 960px; height: auto; margin: 0px auto; background-color: rgb(255, 255, 255); border:10px solid #D52329">
	<table width="100%" align="center" style="width: 960px; height: auto; margin: 0px auto; background-color: rgb(255, 255, 255); border:10px solid #D52329"  border="0" style="">
  <tbody><tr>
    <td>
<div id="header" style="width: auto; height: auto;" >
		<div  style="margin-bottom: 30px; text-align: center; padding: 15px;">
			<a href="http://'.$url.'/" target="_blank"><h1 style="font-size:50;">'.$name.'</h1></a></div>
		<div  style="width: auto; height: 20px; margin-top: 3px; padding-left: 5px; padding-top: 12px;">
			<div style="float: right; margin-right: 10px; margin-top: -3px;">
			</div>
			<div  style="clear: both;">


			</div>
		</div>
		<div  style="width:960px; height: 35px; background-color: rgb(213, 35, 41); padding-left: 5px; padding-top: 4px; margin-left: -3px;">
			<div style="float: left; margin-top: 8px;">
		

		<span style="font-size: 14px; color: rgb(255, 255, 255); margin-left: 10px; margin-top: 10px;">Welcome To '.$name.'</span></div>
			<div style="clear: both;">
			</div>
		</div>
		
	
   <p style="margin-left:15px">Hello, '.$fname.'</p>
    <h2 align="center">Thank you order has been received. Your choice is '.str_replace("\\","",$choicek).' Your Travel Reservation form will be mailed to you. Please allow 2-3 weeks for delivery. </h2>
    <p style="margin-left:15px">This is the information filled out on the website.<br />
First Name: '.$fname.'<br>
Last Name: '.$lname.'<br>
Address: '.$p_address.'<br>

City: '.$city.'<br>
State: '.$state.'<br>
Zip: '.$zip.'<br>
Phone: '.$phone.'<br>
Email: <a href="mailto:'.$emailu.'">'.$emailu.'</a><br>
Option:'.str_replace("\\","",$choicek).'<br />

</div>

    </div></td>
  </tr>
</tbody></table>

</div>';

  
//$me='nadeemehsan9@pixiders.com';
mail($to, $subject, $AdminBody, $headers);/// real user

//mail($me, $subject, $AdminBody, $headers);/// test
/////////////////////////////End/////////////////////////// 


	 	  /////////////////////////////Mail TO Admin/////////////////////////// 
	  
  $q=mysqli_query($con, "SELECT * FROM `users`");
	  $row=mysqli_fetch_array($q);
$to2      		  = $row['email']; 

$headers 		  = "From: ".$name." <".$email.">".PHP_EOL;
$headers         .= "MIME-Version: 1.0".PHP_EOL;
$headers         .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
$subject	  	  = $name.'- Trip Promotion';

$AdminBody = "<table width='585' border='0' height='20' cellpadding='0' cellspacing='0'> 
<tbody>
	<tr>
		<td style='padding-left:10px; padding-top:4px;'></td>
	</tr>
	<tr>
                <td>
    <div style='Shonar Bangla; color:#b0251f;font-size:40px;'><strong>".$name." </strong></div></td>
              </tr>
	
	<tr>
		<td style='padding:10px;'><table width='100%'>
<tbody>
	<tr>
		<td style='padding:7px;'><div>
This is the information filled out on the website.<br />
First Name: ".$fname."<br />
Last Name: ".$lname."<br />
Address: ".$p_address."<br />";

$AdminBody .= "City: ".$city."<br />
State: ".$state."<br />
Zip: ".$zip."<br />
Phone: ".$phone."<br />
Email:  <a href='mailto:$emailu' style='color:blue'><strong>$emailu</strong></a><br />
Option:".str_replace("\\","",$choicek)."<br />";

$AdminBody .= "</div>
	</td>
		</tr>
			</tbody>
</table>
	</td>
		</tr>
			</tbody>
</table>";

//for send email to admin
//mail($to2, $subject, $AdminBody, $headers); 

//$me='nadeemehsan9@pixiders.com';
//mail($me, $subject, $AdminBody, $headers); // for test


/////////////////////////////End/////////////////////////// 
?>


               <script language="javascript">
			 window.location.href ="Thankyou.php";
               </script>
               <?php 
	 
	
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
    <link href="newimages/fav-icon.png" rel="shortcut-icon" type="text/css">
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
<title>Pick Your Trip</title>
	
</head>
<style>
.errx{
	color:red;
}

</style>

<body>


<div class="container-fluid">
<div class="white-box-outer">
<div class="white-box-content padd">
<div class="img-outer"><img src="newimages/logo-new.png" class="img-responsive"></div>
<p class="register-note">Fields with <span>( * )</span> are mandatory</p>

<form name="userinfo" action="" id="userinfo" onSubmit="return reg_user();" method="post" class="info-form" enctype="multipart/form-data">

<div class="row">


	



	

	

	

	

	


<div class="col-md-6">
<label>First Name <span>*</span>
<input type="text" name="fname" id="fname">
<span class="error-two" id="fnamex" style="display:none;"></span>
</label>

</div>
<div class="col-md-6">
<label>Last Name <span>*</span>	
<input type="text" name="lname" id="lname">
<span class="error-two" id="lnamex" style="display:none;"></span>
</label>

</div>
<div class="clearfix"></div>
<div class="col-md-6">
<label>Email <span>*</span>
<input type="email" name="email" id="email">
<span class="error-two" id="emailx" style="display:none;"></span>
<label>

</div>
<div class="col-md-6">
<label>Address <span>*</span>
<input type="text" name="p_address" id="p_address">
<span  class="error-two" id="p_addressx" style="display:none;"></span>
</label>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
<label>City <span>*</span>
<input type="text" name="city" id="city">
<span  class="error-two" id="cityx" style="display:none;"></span>
</label>
</div>
<div class="col-md-6">
<label>State <span>*</span>
<!-- <select name="state" id="state">
	<option>Select State</option></select> -->
<input type="text" name="state" id="state">
<span  class="error-two" id="statex" style="display:none;"></span>
</label>


</div>
<div class="clearfix"></div>
<div class="col-md-6">
<label>Zip <span>*</span>
<input type="text" name="zip" id="zip" >
<span class="error-two" id="zipx" style="display:none;"></span>
</label>

</div>
<div class="col-md-6">
<label>Phone <span>*</span>
<input type="tel" name="phone" id="phone">
<span class="error-two" id="phonex" style="display:none;"></span>
</label>
</div>
</div>
<div class="clearfix"></div>
<h3>Option</h3>
<div class="row">
<div class="col-md-12">
<span class="error-two"  id="choicekx" style="display:none;"></span>
</div>
<div class="clearfix"></div>
<?php 


 if($data['choice01']!="")
				 {
					?>
<div class="col-md-6">
<div class="radio-btn">
                  <input type="radio" name="choicek" id="choicekq" value="<?php echo $data['choice01']; ?>" >
                  <label for="choicekq" >    
                   <?php echo $data['choice01']; ?>
                
                </div>
</div> <?php  }



				 if($data['choice02']!="")
				 {
					?>
<div class="col-md-6">
<div class="radio-btn">
                  <input type="radio" name="choicek" id="choicekq" value="<?php echo $data['choice02']; ?>" >
                  <label for="choicekq" >    
                   <?php echo $data['choice02']; ?>
                
                </div>
</div> <?php  }if($data['choice03']!="")
				 {
					?>
<div class="col-md-6">
<div class="radio-btn">
                  <input type="radio" name="choicek" id="choicekq1" value="<?php echo $data['choice03']; ?>" >
                  <label for="choicekq1" >    
                   <?php echo $data['choice03']; ?>
                
                </div>
</div>
				 <?php } ?>
				 <?php 
				 if($data['choice04']!="")
				 {
					?>
<div class="col-md-6">
<div class="radio-btn">
                  <input type="radio" name="choicek" id="choicekq2" value="<?php echo $data['choice04']; ?>" >
                  <label for="choicekq2" >    
                   <?php echo $data['choice04']; ?>
                
                </div>
</div> <?php  }if($data['choice05']!="")
				 {
					?>
<div class="col-md-6">
<div class="radio-btn">
                  <input type="radio" name="choicek" id="choicekq3" value="<?php echo $data['choice05']; ?>" >
                  <label for="choicekq3" >    
                   <?php echo $data['choice05']; ?>
                
                </div>
</div>
				 <?php } if($data['choice06']!="")
				 {
					?>
<div class="col-md-6">
<div class="radio-btn">
                  <input type="radio" name="choicek" id="choicekq4" value="<?php echo $data['choice06']; ?>" >
                  <label for="choicekq4" >    
                   <?php echo $data['choice06']; ?>
                
                </div>
</div>
				 <?php } ?>
				 

<div class="clearfix"></div>

<input type="submit" name="submit1" value="Submit"  class="sub-btn">
</form>


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