<?php 
session_start();
//$user = $_SESSION['userid'];
require_once('includes/myconn.php');
require_once('includes/config.php');
//$SessionQuery		=	mysqli_query($con, "SELECT time FROM session WHERE id='4'");
//$SessionRows			=	mysqli_fetch_array($SessionQuery);

//$LoginLimit			=	mysqli_query($con, "SELECT * FROM  `limit` WHERE  `id` =1");
//$LoginRows			=	mysqli_fetch_array($LoginLimit);
$session = $_REQUEST['p'];
$gtpoints=array();

If(isset($_SESSION['prepoints'])){
 foreach($_SESSION['prepoints'] as $key=>$value)
   {
		array_push($gtpoints,$value);
		$consumed = $value+$consumed;
		
    // and print out the values
   // echo 'The value of $_SESSION['."'".$key."'".'] is '."'".$value."'".' <br />';
    }
	print_r($gtpoints);
	/* */
}
	//array_push($points,$_SESSION['prdPOints']);
	
	//$_SESSION['prepoints']= $points;
	//$consumed = $_SESSION['prdPOints']+$consumed;
		
		
    // and print out the values
   // echo 'The value of $_SESSION['."'".$key."'".'] is '."'".$value."'".' <br />';
    
	
//	$consumed = $CartRows['prdPOints']+$consumed;
if(isset($_POST['signin_submit']))	{
	//$counter = 1;
	$mes				=	'';
	$admin_username		=	mysqli_real_escape_string($con, $_POST['username']);
	$admin_password		=	mysqli_real_escape_string($con, $_POST['userpass']);

	$query 		=	mysqli_query($con, "Select * from members where email = '".$admin_username."'");
	$EmailId 	= 	mysqli_fetch_array($query);
	$id			=	$EmailId['id'];
	//$blocked	=	$EmailId['block'];
	//echo $blocked;
	
	if($admin_username 	== '')	{
		$mes	=	"Please enter the Username.";
	}
	else if($admin_password == '')	{
		$mes	=	"Please enter the Password.";
	}
	else
	{
		$admin_query		=	mysqli_query($con, "SELECT * FROM members WHERE email = '$admin_username' AND password ='$admin_password'");
		//echo "SELECT * FROM members WHERE email = '$admin_username' AND password='$admin_password'";
		$admin_num_rows		=	mysqli_num_rows($admin_query);
		if($admin_num_rows > 0)	{
			$admin_rows								=	mysqli_fetch_array($admin_query);
			$_SESSION['userid']						=	$admin_rows['id'];
			$_SESSION['name']                    	=   $admin_rows['name'];
			$_SESSION['points']						=	$admin_rows['points'];
		
		//	$_SESSION['type']                     =       $admin_rows['type']; ?>
	<script language="javascript">
	window.location.href='?p=profile'
	</script>
<?php		}else{
			$mes		=	"email or Password Incorrect! Please re-type.";
			$counter	=	$EmailId['counter'];
			$limIt		=	$LoginRows['limitlength'];
			$block		=	$LoginRows['block'];			
			//$counter	=	$EmailId['block'];
			//$counter++;
		}
	}
}
$consumed=0;
$CartQuery 		=	mysqli_query($con, "Select * from cart where user_id='".$_SESSION['userid']."'");
//echo "Select * from cart where user_id='".$_SESSION['userid']."'";
//$CartRows 		= 	mysqli_fetch_array($CartQuery);
$_SESSION['totalProductsPoint'] = $_SESSION['prdPOints']+$consumed;
//echo $_SESSION['totalProductsPoint'];
while($CartRows =	mysqli_fetch_array($CartQuery)){
	$consumed = $CartRows['prdPOints']+$consumed;
}

$cartTotalRows	=	mysqli_num_rows($CartQuery);
// $CartRows['prdPOints'];
//echo $consumed;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ecomerce templte</title>
<link rel="stylesheet" href="css/styles.css"/>
<link rel="stylesheet" type="text/css" href="css/wt-rotator.css"/>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.wt-rotator.min.js"></script>    
	<script type="text/javascript" src="js/preview.js"></script>
    <!--[if lt IE 9]>
  	<style>
    	.panel {
	    	border-left:1px solid #444;
			border-right:1px solid #444;
        }
    </style>
    <![endif]-->    
</head>

<body>
<div id="wrapper">
  <div id="header">
    <div class="logo"> </div>
    <?php
         //if(isset($_SESSION['userid']))	{
		?>
    <div style="float: right;margin-top: 36px; width:250px">
      <div style="width: 90px;height: 70px;background-image: url(images/cart.png);margin-left: 60px;float: left; margin-top:10px;"></div>
      <div style="float:left;font-size:70px;color:#174065;font-weight:bold;"><?php echo count($points);?></div>
      <div class="header-text">Items <br>
        in basket<br>
        <a href="?p=Cart" style="font-size:12px;" class="cont-a">Check out</a></div>
    </div>
    <?php //} ?>
    <div style="clear:both"></div>
    <div style="width:180px; float:right;">
    	<table width="100%">
        	<tr>
            	<td width="60%"><span class="header-text"><strong>Points in Basket :</strong> </span></td>
                <td width="40%"><span class="cont-a"> <?php if($_SESSION['totalProductsPoint'] == ''){ echo "NILL"; }else{ echo $_SESSION['totalProductsPoint']; } ?> </span></td>
            </tr>
            <tr>
            	<td><span class="header-text"><strong>Points Left: </strong></span></td>
<?php  $UsersQuery			=	mysqli_query($con, "SELECT * FROM members WHERE id ='".$_SESSION['userid']."'");
		$UsersQuyrows		=	mysqli_fetch_assoc($UsersQuery);
		$userpoints			= 	$UsersQuyrows['points'];

?>
                <td><span class="cont-a"> <?php if($userpoints == ''){ echo "NILL"; }else{ echo $userpoints-$_SESSION['totalProductsPoint']; $_SESSION['points']	=$userpoints-$consumed; } ?> </span></td>
            </tr>
        </table>
    </div>
    <div style="clear:both"></div>
    <div class="navigation">
      <ul class="top-ul">
        <li class="top-li"><a href="?p=home" class="top-a">HOME</a></li>
        <li class="top-li"><a href="?p=aboutUs" class="top-a">ABOUT US</a></li>
        <li class="top-li"><a href="?p=Products" class="top-a">PRODUCTS</a></li>
        <li class="top-li">
        <?php
         if(isset($_SESSION['userid']))	{
		?>
        <a href="?p=Logout" class="top-a">LOG-OUT</a><?php }else{ ?><a href="?p=Login" class="top-a">LOGIN</a> <?php } ?></li> 
        <li class="top-li">
        <?php
         if(!isset($_SESSION['userid']))	{
		?>
        <a href="?p=Register" class="top-a">REGISTER</a><?php }else{ ?><a href="?p=profile" class="top-a">PROFILE</a> <?php } ?></li>
      </ul>
    </div>
  </div>
  <div style="clear:both"></div>
  <div class="slider"><div class="panel">
	<div class="title"></div>
 	<div class="container">
      <div class="wt-rotator" style="width:960px !important;" >
            <div class="screen" style="width:960px!important;>
                <noscript><img src="images/triworks_abstract17.jpg"/></noscript>
            </div>
            <div class="c-panel">
                <div class="thumbnails">
                    <ul>
                    <?php
                    $BannerQuery				=	mysqli_query($con, "SELECT * FROM bannerImages");
					while($BannerQueryrows		=	mysqli_fetch_assoc($BannerQuery)){
					?>
                        <li>
                      <a href="images/thumb_<?php echo $BannerQueryrows['bannerImages'];?>" title="temple"><img  width="150" height="150" src="images/thumbnew_<?php echo $BannerQueryrows['bannerImages'];?>" border="0"/></a>
                      </li>
                      <?php } ?>
                    </ul>
              </div>  
              	<div class="buttons">
                <div class="prev-btn"></div>
                    <div class="play-btn"></div>    
                    <div class="next-btn"></div>               
                </div>
            </div>
        </div>	
  	</div></div> </div>
  <div style="clear:both"></div>
  <div id="content">
    <div class="left-col">
	<?php include $includepage; ?>
    </div>
    
   
     <?php if(($_REQUEST[p] != 'ProductDetail')){?><div class="right-col"> <div class="right-shape">  <?php }?>
     <?php if(($_REQUEST[p] != 'ProductDetail')){?>   
     <div class="text1-product">Products</div><?php } ?>
      </div><?php if(($_REQUEST[p] != 'ProductDetail')){
		  //echo $p= $_REQUEST[p];
		  ?>
      <div class="right-shape2">
        <ul class="left-ul">
        <?php 
				$ProductQuery			=	mysqli_query($con, "SELECT * FROM products");
				while($ProductQueryrows		=	mysqli_fetch_assoc($ProductQuery)){
		?>
          <li class="left-li"><a href="?p=ProductDetail&id=<?php echo $ProductQueryrows['id'];?>" class="cont-aa"><?php echo $ProductQueryrows['name'];?> &nbsp; »</a> </li>
          <?php } ?>
        </ul>
</div>
<?php } ?>
      <div style="clear:both"></div>
