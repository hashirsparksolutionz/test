<?php
session_start();
require_once('myconn.php');
if(isset($_POST['check']))
{  
   if($_POST['certi']!="")
   {  
	$certi=mysqli_real_escape_string($con, $_POST['certi']);
	//echo $certi."<br>";
	$sql="select * from capXlsx  where certificate='".$certi."'";
	//echo $sql."<br>";
	//echo "waqas"."<br>";
	$res=mysqli_query($con,$sql);
	$data=mysqli_fetch_assoc($res);
	//echo $data['certificate']."<br>";
	$check=mysqli_num_rows($res);
	//echo $check."<br>";
	   if($check > 0 && $data['certificate'] == $certi )
	   {
		   if($data['flage']==0)
		   {
		   $currentDate = date("d-m-Y");
		   if(strtotime($currentDate)<strtotime($data['expiration']))
		   {
			  // echo $data['shipped']."<br>";
			   
			   $_SESSION['abc']=$data['shipped'];  
	// $que="UPDATE  `capXlsx` SET  `flage` = '1' WHERE  `certificate`='".$data['certificate']."'";
	  	       mysqli_query($con,$que) or mysqli_error($con);
			   
			   
			   ?>
               <script language="javascript">
			   window.location.href ="userfrom.php";
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
		       ?>
               <script language="javascript">
			   window.location.href ="exp.php";
               </script>
               <?php 
	   }
	
	   }
	   else
	   {  
	       $set1="invalid";
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
		$ProductQuery			 =	mysqli_query($con,"SELECT * FROM products ");
		
		//echo $record;
		//exit;
		while($ProductQueryrows	 =	mysqli_fetch_assoc($ProductQuery) )
		{
			
			if($ProductQueryrows['image']!='')
			{
		        $images	=  explode('@',$ProductQueryrows['image']);
				?>
                <div class="slider-div-1">
            	<div id="sliderFrame<?php if($counter!=1){ echo $counter;} ?>">
                <div id="slider<?php if($counter!=1){ echo $counter;} ?>" >
                <?php
				 for($y=0;$y<count($images);$y++)
			     {
					 ?>
                     <img src="images/thumb_<?php echo $images[$y]; ?>" alt="waqas" />  
                     <?php
				 }
				 ?>
			     </div>
        		 </div>
                 </div>
            <?php
			}
			
			$counter++;
		}
		
		//exit;
		?>
            <div class="clr"></div>
            <div style="margin-top:20px; width:auto; text-align:center;">
            	<h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:24px;">
                Please enter your Voucher code into the box below and <br> follow the instructions
                </h1>
                <h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:18px;">
                <!--Please Enter Your Voucher/Certificate Number below to Pick Your Plastic--> 
                Please enter your Voucher Number below to redeem you item
                </h1>
<form action="" method="post" enctype="multipart/form-data" name="certificate">
                    <table border="0" align="center" cellpadding="5">
                        <tr>
                          <Td align="right" style="padding-top:10px;"><span style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:18px;"> Voucher Number: </span></Td>
                          <td><input type="text" name="certi" id="certi" style="border-radius: 5px;border: none;height: 30px;width: 180px;" /></td>
                        </tr>
                        <tr>
                            <Td align="right" style="padding-top:10px;" width="45%">
                                <h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:18px;">&nbsp;</h1>
                            </Td>
                            <td width="55%" align="right"><input type="submit" name="check" value="Submit" style="height: 30px;width: 65px;">
                            </td>
                        </tr>
    </table>
            </form>
            <?php
              if(isset($set))
			  {
				   ?>
                   <div style="float: right; margin-right: 80px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;">
                   Your voucher is expired
                   </div>
                   <?php
			  }
			  else
			  if(isset($set1))
			  {
				   ?>
                   <div style="float: right; margin-right: 50px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;">
                   Your voucher number is invalid
                   </div>
                   <?php  
			  }
			   else
			  if(isset($set2))
			  {
				   ?>
                   <div style="float: right; margin-right: 60px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;">
                   Please enter voucher number
                   </div>
                   <?php  
			  }
			   else
			  if(isset($used))
			  {
				   ?>
                   <div style="float: right; margin-right: 60px; margin-top: -95px; font-family:Arial,                    Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:16px;">
                    Voucher has been used before!!!!!!
                   </div>
                   <?php  
			  }
			   
			  
			?>
                <div style="margin-top:7px; width:300px; margin:0 auto;">
                	<img src="images/logo-1.gif" title="" border="0">
                </div>
            </div>
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
