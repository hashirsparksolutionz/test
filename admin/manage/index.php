<?php
$con = mysqli_connect("localhost","cmattox_pacauser","wS]lcu7qs%.(");
mysqli_select_db("cmattox_pamperedchefus",$con) or trigger_error(mysqli_error($con));
//echo date('d-M-Y',$unixDateVal);
if(isset($_POST['check']))
{   
   
	$certi=$_POST['certi'];
	$sql="select * from capXlsx  where certificate='".$certi."'";
	$res=mysqli_query($con, $sql);
	$certificate=mysqli_fetch_assoc($res);
	//echo $certificate['certificate']; 
	if($certificate['certificate']==$certi)
	 {
		 //$date = date('Y-m-d', mktime(0,0,0,1,$certificate['expiration']-1,1900));
		 // $date = date('Y-m-d', mktime(0,0,0,1,$var15-1,1900));
		 $currentDate = date("d-m-Y");
         //echo $currentDate."<br/>";
		 //echo $certificate['expiration']."<br>";
		 if(strtotime($currentDate)<strtotime($certificate['expiration']))
		 {
		   echo "yes you are eligible";
		 }
		else
		{
		   echo "you are expired";
		 //echo $date;
		}
	 }
	 else
	 {
		 echo "Not Matched";
	 }
}
$rslt=mysqli_query($con, "SELECT * FROM  `web_info` where id ='1'");
$title=mysqli_fetch_array($rslt);
$web= $title['name'];
$color= $title['color'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $web ?></title>
<head>
    <link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
    <link href="css/generic.css" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
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
    <div class="slide-wrapper">
    	<div class="banner-cont-div">
            <div class="banner-cont"></div>    	        
        </div>
        <div class="cont-1">
        
        	<div class="slider-div-1">
            	<div id="sliderFrame">
                    <div id="slider" >
                        <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                        <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                        <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
                    </div>
        		</div>
            </div>
            <div class="slider-div">
            	<div id="sliderFrame2">
                    <div id="slider2" >
                        <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                        <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                        <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
                    </div>
        		</div>
            </div>
            <div class="slider-div">
            	<div id="sliderFrame3">
                    <div id="slider3" >
                        <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                        <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                        <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
                    </div>
        		</div>
            </div>
            <div class="slider-div">
            	<div id="sliderFrame4">
                    <div id="slider4" >
                        <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                        <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                        <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
                    </div>
        		</div>
            </div>
            <div class="clr"></div>
            <div class="slider-div-1">
            	<div id="sliderFrame5">
                    <div id="slider5" >

                        <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                        <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                        <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
                    </div>
        		</div>
            </div>
            <div class="slider-div">
            	<div id="sliderFrame6">
                    <div id="slider6" >
                        <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                        <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                        <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
                    </div>
        		</div>
            </div>
            <div class="slider-div">
            	<div id="sliderFrame7">
                    <div id="slider7" >
                        <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                        <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                        <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
                    </div>
        		</div>
            </div>
            <div class="slider-div">
            	<div id="sliderFrame8">
                    <div id="slider8" >
                        <img src="images/1.png" alt="Welcome to Menucool Video Slider"  />
                        <img src="images/2.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/3.png" alt="Welcome to Menucool Video Slider" />
                        <img src="images/4.png" alt="Welcome to Menucool Video Slider"/>
                        <img src="images/5.png" alt="Welcome to Menucool Video Slider"/>
                    </div>
        		</div>
            </div>
            <div class="clr"></div>
            <div style="margin-top:20px; width:auto; text-align:center;">
            	<h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:24px;">
                Please enter your Gift Card Voucher code into the box below and <br> follow the instructions
                </h1>
                <h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:18px;">
                <!--Please Enter Your Voucher/Certificate Number below to Pick Your Plastic--> 
                Please enter your Certificate Number below to redeem you item
                </h1>
                <form>
                    <table width="100%" border="0">
                        <tr>
                            <Td align="right" style="padding-top:10px;" width="45%">
                                <h1 style="font-family:Arial, Helvetica, sans-serif; color:#FFF; font-style:italic; font-size:18px;">
                                Voucher Number:
                                </h1>
                            </Td>
                            <td width="55%"> 
                                <input type="text"  name="certi" id="certi" >
                                <input type="submit" name="check" value="check" />
                            </td>
                        </tr>
                    </table>
                </form>
                <div style="margin-top:7px; width:300px; margin:0 auto;">
                	<img src="images/logo-1.gif" title="" border="0">
                </div>
            </div>
        </div>
    </div>
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
