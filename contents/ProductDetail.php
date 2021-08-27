<?php

		
		$id					=	$_REQUEST['id'];
		//$Uid				=	$_REQUEST[$_SESSION['userid']];
		//echo $_SESSION['userid'];
		//echo $_SESSION['points'];
		$UsersQuery			=	mysqli_query($con,"SELECT * FROM members WHERE id ='".$_SESSION['userid']."'");
		$UsersQuyrows		=	mysqli_fetch_assoc($UsersQuery);
		$userpoints			= 	$UsersQuyrows['points'];
		
	//	echo $userpoints;
		$Images_query		=	mysqli_query($con,"SELECT image FROM products WHERE id ='".$id."'");
		$ImgRecs			=   mysqli_fetch_array($Images_query);
		$images             =   explode('@',$ImgRecs['image']);
		
		$admin_query		=	mysqli_query($con,"SELECT * FROM products WHERE id ='".$id."'");
		
		$adminQueryrows		=	mysqli_fetch_assoc($admin_query);
		$productPOints 		=  $adminQueryrows['points'];
		//echo $productPOints;
		
		if(isset($button))
		{
			$quantity			=	$_POST['count'];
			//echo $quantity;
			$sessionId			=	session_id();
			
			$prdPOints			=	$adminQueryrows['points'];
			//echo $prdPOints;
			$prdId				=	$id;
			$Userid				=	$_SESSION['userid'];
			$totalPoints		=	$prdPOints * $quantity;
			
			//echo $Userid;
			//if($totalPoints <=  $_SESSION['points']){
				
			//$_SESSION['points']	= $userpoints - $totalPoints;	
			mysqli_query($con,"INSERT INTO `cart` (`prd_id`, `prdPOints`,`TotalpointsLeft`, `user_id`, `quantity`, `session_id`) VALUES ('".$prdId."', '".$totalPoints."','".$_SESSION['points']."', '".$Userid."', '".$quantity."', '".$sessionId."')");
			
			
			?>
<script language="javascript">
    window.location.href='?p=Cart'
    </script>
<?php			//}else{?>
<script language="javascript">
alert("Sorry We Can't Add These Products Quantity Because You Have Exceeded Your Limit");
</script>
<?php } //} ?>
<div class="shape-featured">
  <div class="text-haead"><?php echo $adminQueryrows['name'];?></div>
</div>
<div class="des-img-div">
  <div id="fade_down">
    <?php if($ImgRecs['image']){ for($k=0;$k<count($images);$k++){ ?>
    <img src="images/thumb_<?php echo $images[$k];?>" style="margin-top: 5px;" height="132"/>
  <?php } }else{?>
  <img src="images/no_image.jpg" style="margin-top: 5px;" height="132"/>
  <?php }?>
  </div>
</div>
<div style="width:auto; height:auto; padding:10px;">
  <div class="des-h"> <strong> DESCRIPTION</strong>
    <hr style="margin-top:0px;" />
  </div>
  <p> <span class="des-text"> <?php echo stripslashes(html_entity_decode($adminQueryrows['description']));?> </span> </p>
  <div class="des-h" style="margin-top:40px;"> <strong>YOU MAY ALSO INTREESTED IN THESE PRODUCTS</strong>
    <hr style="margin-top:0px;" />
  </div>
</div>
<?php 
			$Count = 1;
	  		$admin_qu			=	mysqli_query($con,"SELECT * FROM products WHERE id !='".$id."' order by id LIMIT 4");
			while($adminQuery	=	mysqli_fetch_assoc($admin_qu)){
			if($adminQuery['image']){
			$Images 			=   explode('@',$adminQuery['image']);	
						}
		?>
<div class="des-img-div-2"> <a href="?p=ProductDetail&id=<?php echo $adminQuery['id'];?>">
  <div id="fade_up_<?php echo $Count;?>" style="left: 8px;">
    <?php if($adminQuery['image']){ for($c=0;$c<count($Images);$c++){ ?>
    <img src="images/thumb_<?php echo $Images[$c];?>" height="120" border="0" style="margin-top: 5px;"/>
    <?php } 
  }else{?>
  <img src="images/no_image.jpg" alt="." height="120" border="0" style="margin-top: 5px;"/>
  <?php }?>
  </div>
  </a> </div>
<?php $Count++; } ?>
</div>
<div class="right-col">
  <div class="right-shape">
    <div class="text-haead">Image</div>
  </div>
  <div class="des-wh-bg-div">
    <p class="des-text">
      <?php //echo $adminQueryrows['description'];?>
    </p>
    <div class="des-img-div2">
      <div id="fade_up" style="margin-right: 70px;">
        <?php if($ImgRecs['image']){ for($k=0;$k<count($images);$k++){ ?>
        <img src="images/thumb_<?php echo $images[$k];?>" style="margin-top: 5px;" height="132"/>
        <?php } 
  }else{?>
  <img src="images/no_image.jpg" style="margin-top: 5px;" height="132"/>
  <?php }?>
      </div>
    </div>
  </div>
  <div class="right-shape">
    <div class="text-haead" style="float:left;">Quantity</div>
    <div class="text-haead" style="float:right; margin-right:15px">Price</div>
  </div>
  <div class="des-wh-bg-div">
    <form method="post" enctype="multipart/form-data" name="ProductDetail" id="ProductDetail">
      <div style="float:left">
        <input type="text" value="1" class="Login_Field" style="width:85px" name="count" id="count" />
      </div>
      <div class="des-price">
        <p class="des-text" style="padding-left: 30px;"><?php echo "$".$adminQueryrows['points'];?></p>
      </div>
      <div style="clear:both"></div>
      <div class="des-btn-div">
        <?php //if(!isset($_SESSION['userid'])){?>
        <!---<strong><a class="cont-a" style="float:right; font-size:12px; font-weight:bold;margin-top: 5px;margin-right: 5px;" href="?p=Login">Please Login To Add in the Cart</a></strong> -->
        <?php //}else{//else if($_SESSION['points'] >= $productPOints){
				  ?>
        <input type="submit" class="btn" onclick="window.location.href='?p=Cart'" name="button" id="button" value="Add To Cart">
        <?php //} //}else{ ?>
        <!-- <a class="cont-a" style="float:right; font-size:12px; font-weight:bold;margin-top: 5px;margin-right: 5px;" href="javascript: void(0)
">You Can't Add This Item In The Cart Due To Your Current Points</a> -->
        <?php //} ?>
      </div>
      <div style="clear:both"></div>
    </form>
  </div>
</div>
<div style="clear:both"></div>
