<?php

		
		$id					=	$_REQUEST['id'];
		//$Uid				=	$_REQUEST[$_SESSION['userid']];
		//echo $_SESSION['userid'];
		//echo $_SESSION['points'];
		$UsersQuery			=	mysql_query("SELECT * FROM members WHERE id ='".$_SESSION['userid']."'");
		$UsersQuyrows		=	mysql_fetch_assoc($UsersQuery);
		$userpoints			= 	$UsersQuyrows['points'];
		
	//	echo $userpoints;
		
		$admin_query		=	mysql_query("SELECT * FROM products WHERE id ='".$id."'");
		$adminQueryrows		=	mysql_fetch_assoc($admin_query);
		$productPOints 		=  $adminQueryrows['points'];
		//echo $productPOints;
		
		if(isset($button)){
			$quantity			=	$_POST['count'];
			$points = array();
			//echo $quantity;
			//$sessionId			=	session_id();
			//echo $sessionId;
			$prdPOints						=	$adminQueryrows['points'];
			
			//echo $prdPOints;
			$prdId							=	$id;
			//$_SESSION['prdId']				=	$prdId;
			
			$Userid							=	$_SESSION['userid'];
			$totalPoints					=	$prdPOints * $quantity;
			$_SESSION['totalPoints']		=	$totalPoints;
			//echo $Userid;
			if($_SESSION['totalPoints'] <=  $_SESSION['points']){
			$_SESSION['prdId']				=	$prdId;
			$_SESSION['prdPOints']			=	$prdPOints;
			$_SESSION['quantity']			=	$quantity;
			$_SESSION['points']	= $userpoints - $totalPoints;	
			If(isset($_SESSION['prepoints'])){
			foreach($_SESSION['prepoints'] as $key=>$value)
   			{
				array_push($points,$value);
				$consumed = $value+$consumed;
		
    // and print out the values
   // echo 'The value of $_SESSION['."'".$key."'".'] is '."'".$value."'".' <br />';
    }
	array_push($points,$prdPOints);
	/* */$_SESSION['prepoints']= $points;
}
	
			
			echo 'dsgfd0'.print_r($points);
	
			/*echo $_SESSION['prdId']."Product ID<br>";
			echo $_SESSION['prdPOints']."prd POints<br>";
			echo $_SESSION['quantity']."quantity<br>";
			echo $_SESSION['points']."points<br>";*/
			//echo $_SESSION['prdId']."Product ID<br>";
				
			
			//mysql_query("INSERT INTO `cart` (`prd_id`, `prdPOints`,`TotalpointsLeft`, `user_id`, `quantity`, `session_id`) VALUES ('".$prdId."', '".$totalPoints."','".$_SESSION['points']."', '".$Userid."', '".$quantity."', '".$sessionId."')");
			
			?>
            
	<script language="javascript">
    //window.location.href='?p=Cart'
    </script>		
		
<?php			}else{?>
				<script language="javascript">
                alert("Sorry We Can't Add These Products Quantity Because You Have Exceeded Your Limit");
                </script>
				
			<?php } } ?>
<div class="shape-featured">
   	<div class="text-haead"><?php echo $adminQueryrows['name'];?></div>
    </div>
      <div class="des-img-div">
        <img src="images/thumb_<?php echo $adminQueryrows['image'];?>" style="margin-top: 5px;" height="132"/>
      </div>
      <div class="des-h">
      <strong>DESCRIPTION</strong></div>
      <div>
       	  <p class="des-text">
		    <?php echo $adminQueryrows['description'];?>
        </p>
      </div>
      <div class="des-h">
      <strong>YOU MAY ALSO INTREESTED IN THESE PRODUCTS</strong></div>
      <?php 
	  		$admin_qu			=	mysql_query("SELECT * FROM products WHERE id !='".$id."' order by id LIMIT 4");
			while($adminQuery	=	mysql_fetch_assoc($admin_qu)){
		?>
      
      <div class="des-img-div-2">
      <a href="?p=ProductDetail&id=<?php echo $adminQuery['id'];?>">  <img src="images/thumb_<?php echo $adminQuery['image'];?>" style="margin-top: 5px;" height="120"/></a>
      </div>
      <?php } ?>
      </div>

      <div class="right-col">
       	  <div class="right-shape">
           	  <div class="text-haead">Description</div>
          </div>
          <div class="des-wh-bg-div">
            <p class="des-text">
                <?php echo $adminQueryrows['description'];?>
              </p>
              <div class="des-img-div2">
            	<img width="130" src="images/thumb_<?php echo $adminQueryrows['image'];?>" />
            </div>
          </div>
          <div class="right-shape">
           	  <div class="text-haead" style="float:left;">Quantity</div>
              <div class="text-haead" style="float:right; margin-right:15px">Points</div>
          </div>
          <div class="des-wh-bg-div">
            <form method="post" enctype="multipart/form-data" name="ProductDetail" id="ProductDetail">
            <div style="float:left">
              <input type="text" value="1" class="Login_Field" style="width:85px" name="count" id="count" />
            </div>
            <div class="des-price">
            	<p class="des-text" style="padding-left: 30px;"><?php echo $adminQueryrows['points'];?></p>
            </div>
            <div style="clear:both"></div>
            <div class="des-btn-div">
              <?php if(!isset($_SESSION['userid'])){?>
              <strong><a class="cont-a" style="float:right; font-size:12px; font-weight:bold;margin-top: 5px;margin-right: 5px;" href="?p=Login">Please Login To Add in the Cart</a></strong>
              <?php }else if($_SESSION['points'] >= $productPOints){
				  ?>
              <input type="submit" class="btn" onclick="window.location.href='?p=Cart'" name="button" id="button" value="Add To Cart">
              <?php }else{ ?>
              <a class="cont-a" style="float:right; font-size:12px; font-weight:bold;margin-top: 5px;margin-right: 5px;" href="javascript: void(0)
">You Can't Add This Item In The Cart Due To Your Current Points</a>
			  <?php } ?>
            </div>
            <div style="clear:both"></div>
            </form>
          </div>
            
      </div>
      <div style="clear:both"></div>
