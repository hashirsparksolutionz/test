<?php
session_start();
//$_SESSION['xyz'] Certificate
//$_SESSION['abc'] Shipping Cost
//if(!isset($_SESSION['abc'])){
require_once('includes/myconn.php'); 
//require_once('includes/https.php');
//echo $_SESSION['abc'];
//echo $var."<br>";
//echo $_SESSION['xyz']."value";
//$sql="select * from capXlsx  where certificate='".$_SESSION['xyz']."'";
//$res=mysqli_query($con,$sql);
//$data=mysqli_fetch_array($res);
//echo $data['choice01']."waqas";

if($_POST['submit1'])
{
    $fname=$_POST['fname'];
	//echo $fname."<br>";
	$lname=$_POST['lname'];	
	$p_address=mysqli_real_escape_string($con, htmlentities($_POST['p_address']));
	$a_address=mysqli_real_escape_string($con, htmlentities($_POST['t_address']));
	$city=mysqli_real_escape_string($con, $_POST['city']);
	$state=mysqli_real_escape_string($con, $_POST['state']);
	$zip   =$_POST['zip'];
	$phone			=	$_POST['phone'];
	$email			=	$_POST['email'];i
	$choicek  =  mysqli_real_escape_string($con, htmlentities($_POST['choicek']));
	$size  =  mysqli_real_escape_string($con, htmlentities($_POST['chk']));
	//echo $email."<br>";
	$que="INSERT INTO  `userinfo` (`fname`,`lname` ,`address1` ,`address2` ,`city`, `state`, `zip`, `phone`, `email`, `product`,`size`,`color`, `vocher`)VALUES ('".$fname."',  '".$lname."',  '".$p_address."',  '".$a_address."', '".$city."', '".$state."', '".$zip."', '".$phone."', '".$email."','".$data['choice01']."','".$choicek."','".$size."','".$data['certificate']."')";	
	//echo $que;
	
$var3=mysqli_query($con, $que);
$_SESSION['userid'] = mysqli_insert_id($con);
	  
$to      		  = $email; 
$headers 		  = "From: Capitol Marketing Concepts <sales@capitolmarketingdeals.com>".PHP_EOL;
$headers         .= "MIME-Version: 1.0".PHP_EOL;
$headers         .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
$subject	  	  = 'User Information';

$AdminBody = "<table width='585' border='0' height='20' cellpadding='0' cellspacing='0'> 
<tbody>
	<tr>
		<td style='padding-left:10px; padding-top:4px;'></td>
	</tr>
	<tr>
		<td style='padding:10px;'><table width='100%'>
<tbody>
	<tr>
		<td style='padding:7px;'><div>
Dear, ".$fname." ".$lname."<br />
Welcome To Capitol Marketing Concepts DBA Capitol Marketing Deals.<br />
This is the information you filled out in the website.<br />
First Name: ".$fname."<br />
Last Name: ".$lname."<br />
Address 1: ".$p_address."<br />";
if($_POST['t_address']!=''){
$AdminBody .= "Address 2: ".$a_address."<br />";
}
$AdminBody .= "City: ".$city."<br />
State: ".$state."<br />
Zip: ".$zip."<br />
Phone: ".$phone."<br />
Email: ".$email."<br />";
if($_POST['choice01']!=''){
$AdminBody .= "Option:1 :- ".$data['choice01']."<br />";
}
if($_POST['choicek']!=''){
$AdminBody .= "Option:2 :- ".$choicek."<br />";
}
if($_POST['chk']!=''){
$AdminBody .= "Option:3 :- ".$size."<br />";
}
$AdminBody .= "</div>
	</td>
		</tr>
			</tbody>
</table>
	</td>
		</tr>
			</tbody>
</table>";
  
//mail($to, $subject, $AdminBody, $headers);

	  if($var3)
	  {
		  //echo "Redirecting to pay shipping fee";
		       ?>
            <script language="javascript">
			   
			  window.location.href ="?p=Thankyou";
               </script>
               <?php 
	  } 
	  else
	  {
		  echo "Not Resgistered";
	  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMC</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
    <link href="css/generic.css" rel="stylesheet" type="text/css" />
    <link href="css/Plastic.css" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/mcVideoPlugin.js" type="text/javascript"></script>
    <script src="js/js-image-slider.js" type="text/javascript"></script>
    <script src="js/js-image-slider-2.js" type="text/javascript"></script>
    <script src="js/js-image-slider-3.js" type="text/javascript"></script>
    <script src="js/js-image-slider-4.js" type="text/javascript"></script>
    <script src="js/js-image-slider-5.js" type="text/javascript"></script>
    <script src="js/js-image-slider-6.js" type="text/javascript"></script>
    <script src="js/js-image-slider-7.js" type="text/javascript"></script>
    <script src="js/js-image-slider-8.js" type="text/javascript"></script>
    <script language="javascript">function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 30 && (charCode < 40 || charCode > 57))
	return false;
else
	return true;
}</script>
    <style type="text/css">
	.form-tables td{font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-top:10px;}
.starig{color:red; font-family:Arial, Helvetica, sans-serif;}
.slider-div-2{width:700px; height:auto; margin-top:5px; background-color:#999;padding:100px}
.registration{width:700px; height:476px; background-color:#fff}
.text-box{width: 225px;height:24px;border: 1px solid #666;border-radius: 3px; padding-left:3px}
.textfield{color:#000; font-family:Arial, Helvetica, sans-serif; font-size:12px}
.h1-deading{font-family:Arial, Helvetica, sans-serif; font-size:24px; }
.hr-margin{margin-top:-15px;}
.btn{ background-image: url(../images/buton.png); height:25px; border: none; color: #fff; border-radius:5px; padding-left:10px; padding-right:10px}
.regsitrationfarm{ font-family:Arial, Helvetica, sans-serif; color:#000; font-size:18px; float: left; margin-top:20px; margin-left:40px}
.cont-11{
	width: 510px;
height: auto;
margin-top: 10px;
background-color: #FFF;
padding-top: 20px;
padding-bottom: 20px;
margin: 0 auto;
	 -moz-border-radius:15px 15px 15px 15px;
    -webkit-border-radius:15px 15px 15px 15px;
    -khtml-border-radius:15px 15px 15px 15px;
    border-radius:15px 15px 15px 15px;
	}

.searchBox_deals{
	-webkit-border-radius:5px;
    -khtml-border-radius:5px;
    border-radius:5px;
	-moz-border-radius:5px;
    border:solid 1px #CCC;
    padding:5px;
	background-image:url(../images/men.png);
	background-repeat:no-repeat;
	background-position:5px;
	margin-left:10px;
	padding-left:40px; 
	color:#999;
}
.searchBox_street{
	-webkit-border-radius:5px;
    -khtml-border-radius:5px;
    border-radius:5px;
	-moz-border-radius:5px;
    border:solid 1px #CCC;
    padding:5px;
	background-image:url(../images/street.png);
	background-repeat:no-repeat;
	background-position:5px;
	margin-left:10px;
	padding-left:40px; 
	color:#999;
	margin-top: 10px;
}
#logo{
	margin-left:10px;
	width:270px;
	float:left;
	}
.button{
	border:none;
	background-color:#0B95F0;
	-moz-border-radius:5px;
 	border-radius:5px;
	width:90px;
	height:30px;
	color:#FFF;
	cursor:pointer;
	padding-right: 25px;
	background:#0B95F0 url(../images/go.png) no-repeat;
	background-position:71px;
	}
</style>
<script type="text/javascript">

function reg_user()
{
	
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var address = document.userinfo.email.value;
	
	if(document.userinfo.fname.value=='')
	{
		document.userinfo.fname.focus();
		document.getElementById('f_msg').innerHTML='Please Enter Your Frist Name!';
		return false;
	}
	else
	{
		document.getElementById('f_msg').innerHTML='';
	}	
	
	
	if(document.userinfo.lname.value=='')
	{
		document.userinfo.lname.focus();
		document.getElementById('lname_msg').innerHTML='Please Enter Your Last Name';
		return false;
	}
	else
	{
		document.getElementById('lname_msg').innerHTML='';
	}	
	
	
	
	if(document.userinfo.p_address.value=='')
	{
		document.userinfo.p_address.focus();
		document.getElementById('address_msg').innerHTML='Please Enter Permanent Address';
		return false;
	}
	else
	{
		document.getElementById('address_msg').innerHTML='';
	}
	
	if(document.userinfo.city.value=='')
	{
		document.userinfo.city.focus();
		document.getElementById('city_msg').innerHTML='Please Enter Your City';
		return false;
	}
	else
	{
		document.getElementById('city_msg').innerHTML='';
	}
	
	if(document.userinfo.state.value=='')
	{
		document.userinfo.state.focus();
		document.getElementById('state_msg').innerHTML='Please Enter Your State';
		return false;
	}
	else
	{
		document.getElementById('state_msg').innerHTML='';
	}
	
	
	
	if(document.userinfo.zip.value=='')
	{
		document.userinfo.zip.focus();
		document.getElementById('zip_msg').innerHTML='Please Enter Zip Code';
		return false;
	}
	else
	{
		document.getElementById('zip_msg').innerHTML='';
	}
	
	
	if(document.userinfo.phone.value=='')
	{
		document.userinfo.phone.focus();
		document.getElementById('phone_msg').innerHTML='Please Enter Phone Number';
		return false;
	}
	else
	{
		document.getElementById('phone_msg').innerHTML='';
	}
	
	if(document.userinfo.email.value=='')
	{
		document.userinfo.email.focus();
		document.getElementById('email_msg').innerHTML='Please Enter Your Email Address';
		return false;
	}
	else 
	if(reg.test(address) == false)
	{
		document.userinfo.email.focus();
		document.getElementById('email_msg').innerHTML='Please Enter Valid Email Address';
		return false;
	}
	else
	{
		document.getElementById('email_msg').innerHTML='';	
	}
	

	
chosen = ""
len = document.userinfo.chk.length

for (i = 0; i <len; i++) {
if (document.userinfo.chk[i].checked) {
chosen = document.userinfo.chk[i].value
}
}

if (chosen == "") {
alert("Please Select Option 3");
return false;
}
	
	return true;
} 
</script>
    </head>
    <body>
    
    
     <div id="logo"><a href="?p=home"><img src="images/logo.png" border="0"></a></div>
     <div class="clear"></div>
    <div class="slide-wrapper">
   
    	<div class="banner-cont-div">
        <div class="banner-cont"></div>    	        
        </div>
        
        <div class="cont-11">
        
            <h2 style="text-align:center">Please Enter Your Personal Information</h2>
       <form name="userinfo" id="userinfo" onSubmit="return reg_user();" method="post" action="">
       <div style="margin-left:120px;">
       
       
       		 <div><input type="text" name="fname" id="fname" value=""  style="height:20px; width:200px" class="searchBox_deals" placeholder="First Name"  /></div>
             <span style="color:red"  id="f_msg"></span>
                              <div><input type="text" name="lname" id="lname" value=""  style="height:20px; width:200px; margin-top:10px" class="searchBox_deals" placeholder="Last Name" /></div>
                              <span style="color:red"  id="lname_msg"></span>
                              <div><input type="text" name="p_address" id="p_address"  style="height:20px; width:200px" class="searchBox_street" placeholder="Address 1" /></div>
                              <span style="color:red"  id="address_msg"></span>
                              <div><input type="text" name="t_address" id="t_address"  style="height:20px; width:200px" class="searchBox_street" placeholder="Address 2" /></div>
                              
                              <div><input type="text" id="city" name="city" value="" style="height:20px; width:200px" class="searchBox2_city" placeholder="City" /></div>
                              <span style="color:red"  id="city_msg"></span>
                              <div><input type="text" id="state" name="state" value="" style="height:20px; width:200px" class="searchBox2_state" placeholder="State/Province" /></div>
                              <span style="color:red"  id="state_msg"></span>
                              <div><input type="text" id="zip" name="zip" value="" style="height:20px; width:200px; margin-top:10px" class=" searchBox2_zip" placeholder="Zip Code/Post Code" /></div>
                              <span style="color:red"  id="zip_msg"></span>
                              <div><input type="text" id="phone" name="phone"  style="height:20px; width:200px" value="" class="searchBox2_phone" placeholder="Telephone Number" /></div>
                              <span style="color:red"  id="phone_msg"></span>
                              <div><input type="text" name="email" id="email" value=""  style="height:20px; width:200px" class="searchBox2_deals" placeholder="E-Mail Address" /></div>
                              <span style="color:red"  id="email_msg"></span>
                              <div style="margin:20px 0 20px 145px;"><input type="submit" value="Submit" border="0" class="button" name="submit1" id="sbt_id"/></div>
                           </div>
                
                </form>
                </div>
       
			<?php /*?><table border="0" width="80%" class="form-tables" align="center" >
            	<tr>
            	  <td colspan="4">Fields with <strong style="color:red">( * )</strong> are mandatory</td>
           	  </tr>
            	<tr>
                	<td width="15%">
                    	First Name<span class="starig">*</span>
                    </td>
                    <td width="35%">
                    <input type="text" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" name="fname" id="fname" /><br />

     <span style="color:red" id="f_msg" ></span>
                   			
                    </td>
                    <td width="15%">
                    	Last Name <span class="starig">*</span>
                    </td>
                    <td width="35%">
                    <input type="text" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" name="lname" id="lname" /><br />
     <span style="color:red" id="lname_msg" ></span>
                    	
                    </td>
                </tr>	
                <tr>
                	<td width="15%">
                    	Address 1<span class="starig">*</span>
                    </td>
                    <td width="35%">
                    <input type="text" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" name="p_address" id="p_address" /><br />
     <span style="color:red"  id="address_msg"></span>
                   			
                    </td>
                    <td width="15%">
                    	Address 2</td>
                    <td width="35%"><br />
                    <input type="text" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" name="t_address" id="t_address" /><br />
     <span style="color:red"  id="address_msgp"></span> 
                    	
                    </td>
                </tr>
                <tr>
                	<td width="15%">
                    	City <span class="starig">*</span>
                    </td>
                    <td width="35%">
                    <input type="text" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" name="city" id="city" /><br />
     <span style="color:red" id="city_msg"></span>
                   			
                    </td>
                    <td width="15%">
                    	State <span class="starig">*</span>
                    </td>
                    <td width="35%">
                    <input type="text" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" name="state" id="state" /><br />
     <span style="color:red" id="state_msg"></span> 
                    	
                    </td>
                </tr>
                <tr>
                	<td width="15%">
                    	Zip<span class="starig">*</span>
                    </td>
                    <td width="35%">
                    <input name="zip" onKeyPress="return isNumberKey(event)" type="text" id="zip" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" maxlength="5" /><br />
     <span style="color:red" id="zip_msg"></span>
                   			
                    </td>
                    <td width="15%">
                    	Phone <span class="starig">*</span>
                    </td>
                    <td width="35%">
                    <input type="text" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" name="phone" id="phone" /><br />
     <span style="color:red"  id="phone_msg"></span> 
                    	
                    </td>
                </tr>
                <tr>
                	<td width="15%">
                    	Email<span class="starig">*</span>
                    </td>
                    <td width="35%">
                     <input type="text" style="border-radius: 5px;border:0.1em solid;height: 25px;width: 180px;" name="email" id="email" /><br />
     <span style="color:red" id="email_msg"></span>
                   			
                    </td>
                </tr>
  <!--             <tr>
                	<td colspan="4">
                    	<h1 class="h1-deading" style="height: 50px;"> Option:</h1>
                        <hr class="hr-margin" />
                    </td>
                </tr>
                
       
         
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><?php if($data['choice01']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
                   <?php echo $data['choice01']; ?>  
                   <input type="hidden" name="choice01" value="<?php echo $data['choice01']; ?>" />
			       </div> 
				 <?php 
			     }
				 ?></td>  
  </tr>
  <tr>
                	<td colspan="4">
                    	<h1 class="h1-deading" style="height: 50px;"> Option:2</h1>
                        <hr class="hr-margin" />
                    </td>
                </tr> 
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><?php 
				 if($data['choice02']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" checked="checked" name="choicek" id="choicekw" value="<?php echo $data['choice02']; ?>"><?php echo $data['choice02']; ?>
    
                   
                   </div><span style="color:red"  id="choicek_msg"></span> <?php 
			     }if($data['choice03']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="choicek" id="choicekq" value="<?php echo $data['choice03']; ?>"><?php echo $data['choice03']; ?>
                   
                   </div><span style="color:red"  id="choicek_msg"></span> <?php 
			     }if($data['choice04']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="choicek" id="choicekq" value="<?php echo $data['choice04']; ?>"><?php echo $data['choice04']; ?>
                   
                   </div><span style="color:red"  id="choicek_msg"></span> <?php 
			     }if($data['choice05']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="choicek" id="choicekq" value="<?php echo $data['choice05']; ?>"><?php echo $data['choice05']; ?>
                   
                   </div><span style="color:red"  id="choicek_msg"></span> <?php 
			     }
				 ?></td>
    
  </tr>
  <tr>
                	<td colspan="4">
                    	<h1 class="h1-deading" style="height: 50px;"> Option:3</h1>
                        <hr class="hr-margin" />
                    </td>
                </tr> 
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><?php if($data['choice06']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkt" value="<?php echo $data['choice06']; ?>"><?php echo $data['choice06']; ?>
                   
                   </div><span style="color:red"  id="chk_msg"></span> <?php 
			     }if($data['choice07']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chky" value="<?php echo $data['choice07']; ?>"><?php echo $data['choice07']; ?>
                   
                   </div> <?php 
			     }if($data['choice08']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chku" value="<?php echo $data['choice08']; ?>"><?php echo $data['choice08']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice09']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chki" value="<?php echo $data['choice09']; ?>"><?php echo $data['choice09']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice10']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chko" value="<?php echo $data['choice10']; ?>"><?php echo $data['choice10']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice11']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkp" value="<?php echo $data['choice11']; ?>"><?php echo $data['choice11']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice12']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chka" value="<?php echo $data['choice12']; ?>"><?php echo $data['choice12']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice13']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chks" value="<?php echo $data['choice13']; ?>"><?php echo $data['choice13']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice14']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkd" value="<?php echo $data['choice14']; ?>"><?php echo $data['choice14']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice15']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkf" value="<?php echo $data['choice15']; ?>"><?php echo $data['choice15']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice16']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkg" value="<?php echo $data['choice16']; ?>"><?php echo $data['choice16']; ?>
                   
                   </div> <?php 
			     }
				  if($data['choice17']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkh" value="<?php echo $data['choice17']; ?>"><?php echo $data['choice17']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice18']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkh" value="<?php echo $data['choice18']; ?>"><?php echo $data['choice18']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice19']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkj" value="<?php echo $data['choice19']; ?>"><?php echo $data['choice19']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice20']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkk" value="<?php echo $data['choice20']; ?>"><?php echo $data['choice20']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice21']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkl" value="<?php echo $data['choice21']; ?>"><?php echo $data['choice21']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice22']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkz" value="<?php echo $data['choice22']; ?>"><?php echo $data['choice22']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice23']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkx" value="<?php echo $data['choice23']; ?>"><?php echo $data['choice23']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice24']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkc" value="<?php echo $data['choice24']; ?>"><?php echo $data['choice24']; ?>
                   
                   </div> <?php 
			     }
				 if($data['choice25']!="")
				 {
					?>
                   <div style="float: left; width: 250px;">
    <input type="radio" name="chk" id="chkv" value="<?php echo $data['choice25']; ?>"><?php echo $data['choice25']; ?>
                   
                   </div> <?php 
			     }?></td>
    
  </tr>
  <tr>
    <td colspan="4" align="right"><input onClick="confirm('Please Select OK to proceed');" type="submit" name="submit1" style="border: none;
padding: 8px;
color: #fff;
font-family: Arial, Helvetica, sans-serif;
font-size: 14px;
margin-top: 7px;
width: 70px;
height: 32px;
background-image: url(images/boton.png);
border-radius: 3px;
pxmargin-top: 5px;
cursor: pointer;" value="Submit" class="btn-11"></td>
  </tr>-->
</table><?php */?>       
 
            <div class="clr"></div>
            
        </div>
        
        <div style="margin-top:20px; width:auto; text-align:center;">
            	<h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:24px;">&nbsp;</h1>
              
                <div style="margin-top:7px; width:300px; margin:0 auto;"></div>
          </div>
    </div>
        <div class="footer" style="
    width: auto;  height: 40px;  margin-top: 30px;  border-top: 1px solid;
    font-weight: bold;  color: white;  font-family: Arial, Helvetica, sans-serif;  font-size: 12px;  margin-top: 12px;  text-align: center;
">
  <div class="footer-text" style="color:white;">Copyright ?? Capitol Marketing Concepts - All Rights Reserved. </div>
</div>
    </body>
</html>
