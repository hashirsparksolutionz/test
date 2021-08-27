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
		mysqli_query($con, "Delete from cart where user_id='".$_SESSION['userid']."'");
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
	<!--/*######################slider##########################*/-->

	<link rel="stylesheet" type="text/css" href="css/slider-style.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />

	<!--/*######################slider##########################*/-->
	<link rel="stylesheet" href="css/styles.css"/>
	<link rel="stylesheet" type="text/css" href="css/wt-rotator.css"/>
	<script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
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
        <td width="60%"><span class="header-text"><strong>Points in Basket :</strong> </span></td>
        <td width="40%"><span class="cont-a">
          <?php if($consumed == ''){ echo "NILL"; }else{ echo $consumed; } ?>
          </span></td>
      </tr>
          <!-- <tr>
            	<td><span class="header-text"><strong>Points Left: </strong></span></td>
<?php  $UsersQuery			=	mysqli_query($con, "SELECT * FROM members WHERE id ='".$_SESSION['userid']."'");
		$UsersQuyrows		=	mysqli_fetch_assoc($UsersQuery);
		$userpoints			= 	$UsersQuyrows['points'];

?>
                <td><span class="cont-a"> <?php if($userpoints == ''){ echo "NILL"; }else{ echo $userpoints-$consumed; $_SESSION['points']	=$userpoints-$consumed; } ?> </span></td>
            </tr> --->
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
        <a href="?p=Logout" class="top-a">LOG-OUT</a>
        <?php }else{ ?>
        <a href="?p=Login" class="top-a">LOGIN</a>
        <?php } ?>
      </li>
          <li class="top-li">
        <?php
         if(!isset($_SESSION['userid']))	{
		?>
        <a href="?p=Register" class="top-a">REGISTER</a>
        <?php }else{ ?>
        <a href="?p=profile" class="top-a">PROFILE</a>
        <?php } ?>
      </li>
        </ul>
  </div>
    </div>
<div style="clear:both"></div>
<?php /*?><div class="slider">
  
    <div id="wowslider-container1">
	<div class="ws_images"><ul>
<li><img src="../images/1sky-blue.jpg" alt="Penguins" id="wows1_0"/></li>
<li><img src="../images/china.jpg" alt="Penguins"id="wows1_1"/></li>
<li><img src="../images/62Desert.jpg" alt="Penguins"id="wows1_0"/></li>
<li><img src="../images/49Chrysanthemum.jpg" alt="Penguins" id="wows1_1"/></li>
<li><img src="../images/1sky-blue.jpg" alt="Penguins"id="wows1_1"/></li>
<li><img src="../images/49Chrysanthemum.jpg" alt="Penguins" id="wows1_0"/></li>
<li><img src="../images/49Chrysanthemum.jpg" alt="Penguins" id="wows1_1"/></li>
<li><img src="../images/china.jpg" alt="Penguins"id="wows1_0"/></li>
<li><img src="../images/49Chrysanthemum.jpg" alt="Penguins" id="wows1_1"/></li>
<li><img src="../images/china.jpg" alt="Penguins" id="wows1_0"/></li>
<li><img src="../images/49Chrysanthemum.jpg" alt="Penguins" id="wows1_1"/></li>
</ul></div>
<div class="ws_bullets"><div>
<a href="#" title="Penguins"><img src="../images/thumb_1sky-blue.jpg" alt="Penguins"/>1</a>
<a href="#" title="Penguins"><img src="../images/thumb_china.jpg" alt="Penguins"/>2</a>
<a href="#" title="Penguins"><img src="../images/thumb_62Desert.jpg" alt="Penguins"/>3</a>
<a href="#" title="Tulips"><img src="../images/thumb_1sky-blue.jpg" alt="Tulips"/>4</a>
</div></div>

	<div class="ws_shadow"></div>
	</div>
    <script type="text/javascript" src="js/wowslider.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
    </div><?php */?>
<div class="slider">
      <?php $BannerQuery	=	mysqli_query($con, "SELECT * FROM bannerImages"); ?>
      <div id="wowslider-container1">
    <div class="ws_images">
          <?php while($BannerQueryrows	=	mysqli_fetch_assoc($BannerQuery)){ 
 	list($width, $height) = getimagesize('images/'.$BannerQueryrows['bannerImages']);  
 ?>
          <ul>
        <li><img  src=<?php if($width <= 960 && $height <= 300){ ?>"images/<?php echo $BannerQueryrows['bannerImages'].'"'; }else{?>"images/thumb_<?php echo $BannerQueryrows['bannerImages'].'"'; } ?> id="wows1_0" /></li>
      </ul>
          <?php /*?><div class="ws_bullets">
      <div> <a href="#"><img src="../images/thumb_<?php echo $BannerQueryrows['bannerImages'];?>" /></a>
</div>
    </div><?php */?>
          <?php } ?>
        </div>
    <div class="ws_shadow"></div>
  </div>
      <?php ?>
      <script type="text/javascript" src="js/wowslider.js"></script> 
      <script type="text/javascript" src="js/script.js"></script> 
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
				$ProductQuery			=	mysqli_query($con, "SELECT * FROM products");
				while($ProductQueryrows		=	mysqli_fetch_assoc($ProductQuery)){
		?>
    <li class="left-li"><a href="?p=ProductDetail&id=<?php echo $ProductQueryrows['id'];?>" class="cont-aa"><?php echo $ProductQueryrows['name'];?> </a> </li>
    <?php } ?>
  </ul>
    </div>
<?php } ?>
<div style="clear:both"></div>
