<?php 
//session_start();
//$user = $_SESSION['userid'];
require_once('includes/myconn.php');
require_once('includes/config.php');
//$SessionQuery		=	mysqli_query($con,"SELECT time FROM session WHERE id='4'");
//$SessionRows			=	mysqli_fetch_array($SessionQuery);

//$LoginLimit			=	mysqli_query($con,"SELECT * FROM  `limit` WHERE  `id` =1");
//$LoginRows			=	mysqli_fetch_array($LoginLimit);
$session = $_REQUEST['p'];
if(isset($_POST['signin_submit']))	{
	//$counter = 1;
	$mes				=	'';
	$admin_username		=	mysqli_real_escape_string($con, $_POST['email']);
	$admin_password		=	mysqli_real_escape_string($con, $_POST['pass']);

	$query 		=	mysqli_query($con,"Select * from members where email = '".$admin_username."'");
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
		$admin_query		=	mysqli_query($con,"SELECT * FROM members WHERE email = '$admin_username' AND password ='$admin_password'");
		//echo "SELECT * FROM members WHERE email = '$admin_username' AND password='$admin_password'";
		$admin_num_rows		=	mysqli_num_rows($admin_query);
		if($admin_num_rows > 0)	{
			$admin_rows								=	mysqli_fetch_array($admin_query);
			$_SESSION['userid']						=	$admin_rows['id'];
			$_SESSION['name']                    	=   $admin_rows['name'];
			$_SESSION['points']						=	$admin_rows['points'];
		mysqli_query($con,"Delete from cart where user_id='".$_SESSION['userid']."'");
		//	$_SESSION['type']                     =       $admin_rows['type']; ?>
	<script language="javascript">
	window.location.href='?p=Products'
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
$CartQuery 		=	mysqli_query($con,"Select * from cart where user_id='".$_SESSION['userid']."'");

//echo "Select * from cart where user_id='".$_SESSION['userid']."'";
//$CartRows 		= 	mysqli_fetch_array($CartQuery);
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
<title>Capitol Marketing Deals</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" src="js/cycle-plugin.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<link rel="stylesheet" href="css/styles.css"/>
<link rel="stylesheet" type="text/css" href="css/wt-rotator.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" language="javascript">
    $(function(){
    $('#gallery a').lightBox();
});
</script>

<script type="text/javascript" language="javascript">
	$(document).ready(function(){
	$('#fade_up').cycle();
});
</script>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('#fade_down').cycle();
});
</script>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('#fade_wep').cycle();
});
</script>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('#fade_new').cycle();
});
</script>
<style type="text/css">
#gallery ul {
	list-style: none;
}
#gallery ul li {
	display: inline;
}
#gallery ul img {
	border-width: 5px 5px 20px;
}
</style>
<style type="text/css">
#fade_up{
height: 135px;
} 
#fade_down{
height: 135px;
}
#fade_wep{
/*height: 135px;*/
}  
#fade_new{
height: 175px;
}
</style>
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
    <div style="float:left;font-size:70px;color:#174065;font-weight:bold;"><?php echo $cartTotalRows;?></div>
    <div class="header-text">Items <br>
      in basket<br>
      <a href="?p=Cart" style="font-size:12px;" class="cont-a">Check out</a></div>
  </div>
  <?php //} ?>
  <div style="clear:both"></div>
  <div style="width:180px; float:right;">
    <table width="100%">
      <tr>
        <td width="60%"><span class="header-text"><strong>Total Price in Basket tyrtdy:</strong> </span></td>
        <td width="40%"><span class="cont-a">
          <?php if($consumed == ''){ echo "NILL"; }else{ echo $consumed; } ?>
          </span></td>
      </tr>
      <!-- <tr>
            	<td><span class="header-text"><strong>Points Left: </strong></span></td>
<?php  $UsersQuery			=	mysqli_query($con,"SELECT * FROM members WHERE id ='".$_SESSION['userid']."'");
		$UsersQuyrows		=	mysqli_fetch_assoc($UsersQuery);
		$userpoints			= 	$UsersQuyrows['points'];

?>
                <td><span class="cont-a"> <?php 
				if($userpoints == '')
				{ 
				echo "NILL";
				 }
				else
				{
					 echo $userpoints-$consumed."wew"; 
					 $_SESSION['points']	=$userpoints-$consumed; 
					 } 
					 ?> </span></td>
            </tr> --->
    </table>
  </div>
  <div style="clear:both"></div>
  <div class="navigation">
    <ul class="top-ul">
      <li class="top-li"><a href="?p=home" class="top-a">HOME</a></li>
      <li class="top-li"><a href="?p=aboutUs" class="top-a">ABOUT US</a></li>
      <li class="top-li"><a href="?p=Products" class="top-a">PRODUCTS</a></li>
      <li class="top-li"><a href="?p=AboutUs" class="top-a">ABOUT US</a></li>
      <li class="top-li"><a href="?p=Faq" class="top-a">FAQ</a></li>
  <!---    <li class="top-li">
        <?php
        // if(isset($_SESSION['userid']))	{
		?>
        <a href="?p=Logout" class="top-a">LOG-OUT</a>
        <?php //}else{ ?>
        <a href="?p=Login" class="top-a">LOGIN</a>
        <?php //} ?>
      </li> -->
  <!---    <li class="top-li">
        <?php
        // if(!isset($_SESSION['userid']))	{
		?>
        <a href="?p=Register" class="top-a">REGISTER</a>
        <?php //}else{ ?>
        <a href="?p=profile" class="top-a">PROFILE</a>
        <?php //} ?>
      </li>  --->
    </ul>
  </div>
</div>
<div style="clear:both"></div>
<div class="slider">
  <div class="panel">
    <div class="title"></div>
    <div class="container">
      <div class="wt-rotator" style="width:960px !important;">
        <div class="screen" style="width:960px !important;">
          <noscript>
          <img src="images/triworks_abstract17.jpg"/>
          </noscript>
        </div>
        <div class="c-panel">
          <div class="thumbnails">
            <ul>
              <?php
                    $BannerQuery				=	mysqli_query($con,"SELECT * FROM bannerImages");
					while($BannerQueryrows		=	mysqli_fetch_assoc($BannerQuery)){
					?>
              <li> <a href="images/thumb_<?php echo $BannerQueryrows['bannerImages'];?>" title="temple"><img  width="150" height="150" src="images/thumbnew_<?php echo $BannerQueryrows['bannerImages'];?>" border="0"/></a> </li>
              <?php } ?>
            </ul>
            <?php /*?><ul>
                    <?php
                    $BannerQuery				=	mysqli_query($con,"SELECT * FROM bannerImages");
					while($BannerQueryrows		=	mysqli_fetch_assoc($BannerQuery)){
					list($width, $height) = getimagesize('images/'.$BannerQueryrows['bannerImages']);  	
					?>
                        <li>
                       <?php if($width <= 960 && $height <= 300){ ?> 
                      <a href="images/<?php echo $BannerQueryrows['bannerImages'];?>" title="temple"><img  width="150" height="150" src="images/thumbnew_<?php echo $BannerQueryrows['bannerImages'];?>" border="0"/></a>
                      <?php }else{?><a href="images/thumb_<?php echo $BannerQueryrows['bannerImages'];?>" title="temple"><img  width="150" height="150" src="images/thumbnew_<?php echo $BannerQueryrows['bannerImages'];?>" border="0"/></a><?php } ?>
                      </li>
                      <?php } ?>
                    </ul><?php */?>
          </div>
          <div class="buttons">
            <div class="prev-btn"></div>
            <div class="play-btn"></div>
            <div class="next-btn"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="clear:both"></div>
<div id="content">
<div class="left-col">
  <?php include $includepage; ?>
</div>
<?php if(($_REQUEST[p] != 'ProductDetail')){?>
<div class="right-col">
<div class="right-shape">
  <?php }?>
  <?php if(($_REQUEST[p] != 'ProductDetail')){?>
  <div class="text1-product">Products</div>
  <?php } ?>
</div>
<?php if(($_REQUEST[p] != 'ProductDetail')){
		  //echo $p= $_REQUEST[p];
		  ?>
<div class="right-shape2">
  <ul class="left-ul">
    <?php 
				$ProductQuery			=	mysqli_query($con,"SELECT * FROM products");
				while($ProductQueryrows		=	mysqli_fetch_assoc($ProductQuery)){
		?>
    <li class="left-li"><a href="?p=ProductDetail&id=<?php echo $ProductQueryrows['id'];?>" class="cont-aa"><?php echo $ProductQueryrows['name'];?> &nbsp; »</a> </li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
<div style="clear:both"></div>
