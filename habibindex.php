<?php
session_start();
//require_once('http.php');
/*require_once('myconn.php');
require_once('https.php');*/
require_once('includes/myconn.php'); 
require_once('includes/https.php'); 

if(isset($_POST['check']))
{  
   if($_POST['certi']!="")
   {  
	$certi=mysqli_real_escape_string($con, $_POST['certi']);
	$sql="SELECT * FROM capXlsx WHERE certificate='".$certi."' AND status = '0'";
	$res=mysqli_query($con, $sql);
	$data=mysqli_fetch_assoc($res);
	$check=mysqli_num_rows($res);
	
	$RedemDate 	= $data['beginredemption'];
	$redemDate 	= explode('-',$RedemDate);
	$RedempDate =  $redemDate[2].'-'.$redemDate[0].'-'.$redemDate[1];
	//echo $RedempDate.' beginredemption<br />';

    $ExpDate 	= $data['expiration'];
	$expDate 	= explode('-',$ExpDate);
	$ExpiryDate =  $expDate[2].'-'.$expDate[0].'-'.$expDate[1];
	//echo $ExpiryDate.' expiration<br />';

	$Reddate = (strtotime(date("Y-m-d")) - strtotime($RedempDate)) / (60 * 60 * 24);
	$Expdate = (strtotime($ExpiryDate) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	
	   if($check > '0' && $data['certificate']==$certi && $data['concatenated']==$certi)
	   {
		   if($data['status']=='0')
		   {
		   //echo $currentDate = date("d-m-Y");
		   if($Reddate>=0)
		   { 	/*echo 'beginredemption<br />';
		   		echo $currentDate.'<'.$data['beginredemption'].'<br />';*/
			   if($Expdate>=0)
			   { 	/*echo 'expiration<br />';
			   		echo $currentDate.'<'.$data['expiration'].'<br />';*/
				  // echo $data['shipped']."<br>";
					$_SESSION['abc']=$data['shipCost'];  
					$_SESSION['xyz']=$data['certificate'];
					$_SESSION['compName']=$data['cname'];
		 //$que="UPDATE  `capXlsx` SET  `flage` = '1' WHERE  `certificate`='".$data['certificate']."'";
				  // mysqli_query($con, $que) or mysql_error();
				   ?>
		<script language="javascript">
       window.location.href ="userfrom.php";
	   //alert('sds');
        </script>
<?php 
			   }
			   else
			   {
				   $set="ex";
				   //echo "Expirated voucher";
			   }
		   }
		   else
			   {
				   $start="start";
				   //echo "Expirated voucher";
			   }
	   }
	   else
	   {
		       ?>
<script language="javascript">
			   window.location.href ="exp.php?voch=<?php echo $certi; ?>";
               </script>
<?php 
	   }
	
	   }
	   else
	   {  
	       $set1="invalid Or Expired";
		   //echo "Invalid  voucher number";   
	   }
	
	    
   }
   else
   {
	   $set2="insert";
	   //echo "please insert voucher number";
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
<script src="js/mcVideoPlugin.js" type="text/javascript"></script>
<script src="js/js-image-slider.js" type="text/javascript"></script>
<script src="js/js-image-slider-2.js" type="text/javascript"></script>
<script src="js/js-image-slider-3.js" type="text/javascript"></script>
<script src="js/js-image-slider-4.js" type="text/javascript"></script>
<script src="js/js-image-slider-5.js" type="text/javascript"></script>
<script src="js/js-image-slider-6.js" type="text/javascript"></script>
<script src="js/js-image-slider-7.js" type="text/javascript"></script>
<script src="js/js-image-slider-8.js" type="text/javascript"></script>
</head>
<body>
<center>
  <div class="slide-wrapper">
    <div class="banner-cont-div">
      <div class="banner-cont"></div>
    </div>
    <div class="cont-1">
      <?php
        $counter = 1;
		$ProductQuery	         =	mysqli_query($con, "SELECT * FROM `products` WHERE `image` !='' ORDER BY rand() LIMIT 8");
		while($ProductQueryrows	 =	mysqli_fetch_array($ProductQuery))
		{
			
			if($ProductQueryrows['image']!='')
			{
		        $images	=  explode('@',$ProductQueryrows['image']);
				?>
      <div class="slider-div-1">
        <div id="sliderFrame<?php if($counter!=1){ echo $counter;} ?>">
        <div style="height:166px !important; width:192px;" id="slider<?php if($counter!=1){echo $counter;} ?>">
            <?php
				 for($y=0;$y<=count($images);$y++)
			     {
					 ?>
            <img src="images/thumb_<?php echo $images[$y]; ?>"/>
            <?php
				 }
				 ?>
          </div>
        </div>
      </div>
      <?php
			}else{?>
            <div class="slider-div-1">
        <div id="sliderFrame<?php if($counter!=1){ echo $counter;} ?>">
        <div style="height:166px !important; width:192px;" id="slider<?php if($counter!=1){echo $counter;} ?>">
            <img src="images/NoImage.jpg" width="192" height="166" />
          </div>
        </div>
      </div>
            <?php }
			
			$counter++;
		}
		/*if($counter <= 8)
		{
			//$now=$counter-1;
			///echo "vgxzgzsdghzsdg";
			//exit;
		$ProductQuery1			 =	mysqli_query($con, "SELECT * FROM products");
		while($ProductQueryrows1 =	mysqli_fetch_assoc($ProductQuery1))
		{
			if($counter<=8)
			{
				if($ProductQueryrows1['image']!='')
				{
					$images1	=  explode('@',$ProductQueryrows1['image']);
					?>
      <div class="slider-div-1">
        <div id="sliderFrame<?php if($counter!=1){ echo $counter;} ?>">
          <div style="height:166px !important; width:192px;" id="slider<?php if($counter!=1){                  echo $counter;} ?>" >
            <?php
					 for($a=0;$a<count($images1);$a++)
					 {
						 ?>
            <img src="images/thumb_<?php echo $images1[$a]; ?>"/>
            <?php
					 }
					 ?>
          </div>
        </div>
      </div>
      <?php
				}
		   }
			$counter++;
		}
			
			
			
	    }*/
		/*echo $counter."waqas";
		echo $con;*/
		?>
      <div class="clr"></div>
      <div style="margin-top:20px; width:auto; text-align:center;">
        <h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:24px;"> Please enter your Voucher code into the box below and <br>
          follow the instructions </h1>
        <h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:18px;"> 
          <!--Please Enter Your Voucher/Certificate Number below to Pick Your Plastic--> 
          Please enter your Voucher Number below to redeem you item </h1>
        <form action="" method="post" enctype="multipart/form-data" name="certificate">
          <table border="0" align="center" cellpadding="5">
            <tr>
              <Td align="right" style="padding-top:10px;"><span style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:18px;"> Voucher Number: </span></Td>
              <td><input type="text" name="certi" id="certi" style="border-radius: 5px;border: none;height: 30px;width: 180px;" /></td>
            </tr>
            <tr>
              <Td align="right" style="padding-top:10px;" width="45%"><h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:18px;">&nbsp;</h1></Td>
              <td width="55%" align="right"><input type="submit" class="btn-11" name="check" value="Submit" style="border: none;
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
cursor: pointer;"></td>
            </tr>
          </table>
        </form>
        <?php
              if(isset($set))
			  {
				   ?>
        <div style="float: right; margin-right: 80px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;"> Your Voucher Is Expired </div>
        <?php
			  }
			  else
			  if(isset($set1))
			  {
				   ?>
        <div style="float: right; margin-right: -50px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;"> Your Voucher Number Is Invalid Or Expired </div>
        <?php  
			  }
			   else
			  if(isset($set2))
			  {
				   ?>
        <div style="float: right; margin-right: 60px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;"> Please Enter Voucher Number </div>
        <?php  
			  }
			   else
			  if(isset($used))
			  {
				   ?>
        <div style="float: right; margin-right: 60px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;"> Voucher Has Been Used Before </div>
        <?php  
			  }
			   else
			  if(isset($start))
			  {
				   ?>
        <div style="float: right; margin-right: 25px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;"> Voucher Date Not Started So Far</div>
        <?php  
			  }
			   
			  
			?>
        <div style="margin-top:7px; width:300px; margin:0 auto;"></div>
      </div>
    </div>
  </div>
  <div class="footer" style="
    width: auto;  height: 40px;  margin-top: 30px;  border-top: 1px solid;
    font-weight: bold;  color: white;  font-family: Arial, Helvetica, sans-serif;  font-size: 12px;  margin-top: 12px;  text-align: center;
">
    <div class="footer-text">Copyright © Capitol Marketing Concepts - All Rights Reserved. </div>
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