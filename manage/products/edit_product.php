<script type="text/javascript">
function dothat() {
   var div = document.getElementById('fileuploads');
	var field = div.getElementsByTagName('input')[0];
	
	div.appendChild(document.createElement("br"));
	div.appendChild(field.cloneNode(false));
}


function delete_pic(pic,pr_id,div_id) 
{	
	
	$.post("mod/post.php?pr_id="+pr_id+"&pic="+pic,{
		
			}, function(response){
			
			//	alert(response);
			if(response==1)
			{
				$("#"+div_id).remove();
			//	$("#lbl"+id).html('');
				
				
			//	change_captcha();
			//	clear_form();
			}
			else if(response==0)
			{
				//$("#release"+id).hide();
				alert(' There is Some Error ');
		//	$("#after_submit").html('');
				//$("#Send").after('<label class="error" id="after_submit"> .</label>');
				
			}
			return false;
			
		});
				
	
	
}


</script>
<?php 
$pid=$_GET['pid'];
$q=mysqli_query($con, "SELECT * FROM `products` WHERE `id`='".$pid."'") or mysqli_error($con);
$r=mysqli_fetch_array($q);
if(isset($_POST['submit']))
{
		
	$cost			=	$_POST['cost'];
	$tax			=	$_POST['tax'];
	$shipping		=	$_POST['shipping'];
	$charges		=	$_POST['charges'];
	$name_en		=	mysqli_real_escape_string($con, htmlentities($_POST['name_en']));
	$desc_en		=	mysqli_real_escape_string($con, htmlentities($_POST['desc_en']));
	$price			=	$_POST['price'];	
	$old_img		=	$_POST['old_img'];	
	if($category == '3'){
	$sp = 1;	
		}else{
			$sp=0;
			}
	
	///////////////////////////////////
	/*if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000000))
  {*/
  /*if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {*/
	 if($_FILES['file']['tmp_name'] == '')
	  {
		 echo $_FILES['file']['tmp_name'];
		//$images = ltrim($r['image'], '@');  
		 
 $query="UPDATE  `products` SET  `name` =  '".$_POST['name_en']."',`description` =  '".$_POST['desc_en']."',`points` =  '".$_POST['price']."', `cost` = '$cost' , `tax` = '$tax', `shipping` = '$shipping', `charges` = '$charges' WHERE  `products`.`id` ='".$pid."'";

mysqli_query($con, $query) or mysqli_error($con);

}else{
	// echo $_FILES['file']['tmp_name'];
	  $new_image= $r['image'];
	 include('SimpleImage.php');
      $image = new SimpleImage();
	  $image_name="";
	  foreach($_FILES['file']['tmp_name'] as $key => $tmp_name)
	  {
		  
      $image->load($_FILES['file']['tmp_name'][$key]);
	  $image->resize(200,166);
	  $image->save('../images/thumb_'.$_FILES["file"]["name"][$key]);
      move_uploaded_file($_FILES["file"]["tmp_name"][$key],'../images/'.$_FILES["file"]["name"][$key]);
		  }
		$image_name .= implode('@',$_FILES["file"]["name"]);
	   $images = $r['image'];  
	   if($images!='' && $image_name !=''){
		  
	 $new_image = $image_name.'@'.$images;
		   
		   }else if($image_name !='')
		   {
			    $new_image = $image_name;
		   }
	  //unlink("../images/thumb_".$r['image']);
	  //unlink("../images/".$r['image']);
	  
	  $dt_image= str_ireplace('@@','',$new_image);
	//  echo "UPDATE  `products` SET  `name` =  '".$_POST['name_en']."',`description` =  '".$_POST['desc_en']."',`points` =  '".$_POST['price']."',`image` =  '".$dt_image."' , `cost` = '$cost' , `tax` = '$tax', `shipping` = '$shipping', `charges` = '$charges' WHERE  `products`.`id` ='".$pid."'";
	  
	$que="UPDATE  `products` SET  `name` =  '".$_POST['name_en']."',`description` =  '".$_POST['desc_en']."',`points` =  '".$_POST['price']."',`image` =  '".$dt_image."' , `cost` = '$cost' , `tax` = '$tax', `shipping` = '$shipping', `charges` = '$charges' WHERE  `products`.`id` ='".$pid."'";
	  	mysqli_query($con, $que) or mysqli_error($con);
  }
	/*  
	echo $image_name;exit;
	*/
	/* }
  }else{
	  
	  $query="UPDATE `products` SET `name_en`='".mysqli_real_escape_string($con, htmlentities($_POST['name_en']))."',`name_ar`='".mysqli_real_escape_string($con, htmlentities($_POST['name_ar']))."',`desc_en`='".mysqli_real_escape_string($con, htmlentities($_POST['desc_en']))."',`desc_ar`='".mysqli_real_escape_string($con, htmlentities($_POST['desc_ar']))."',`price`='".$_POST['price']."',`image`='".$old_img."' WHERE `id`='".$pid."'";
	mysqli_query($con, $query) or mysqli_error($con);
	  
	  
	  
	  }*/
	
	//////////////////////////////////
	
	/*$msg="Your Product Has Been Added Successfully";*/
		?>
<script language="javascript">
window.location.href = "?p=ManageProducts&mes=update";
</script>
<?php
}
?>

<h2 class="table table-striped">Edit Your Product</h2>
<div class="navbar" style="
    float: right;
    margin-top: 15px;
">
  <div class="navbar-inner">
    <ul class="nav">
      <li class="active"><a href="javascript:history.go(-1)">« Go Back </a></li>
    </ul>
  </div>
</div>
<?php /*?><?php if($msg!=''){ ?><div id="ErrorMsg"><h3><?php echo $msg;?></h3></div><?php }?><?php */
if($r['image'] !=''){
$images = explode('@',html_entity_decode($r['image'])); 
}
?>
<form method="post" name="add-product" action="" enctype="multipart/form-data">
  <table border="0" class="table table-striped">
    <tr>
      <td width="100"><strong>Name:</strong></td>
      <td width="340"><input type="text" name="name_en" value="<?php echo stripslashes(html_entity_decode($r['name']));?>" id="name_en" class="TextField" maxlength="50"></td>
    </tr>
    <tr>
      <td valign="middle"><strong><strong>Description :</strong></strong></td>
      <td><textarea name="desc_en" id="desc_en" cols="45" rows="5"><?php echo stripslashes(html_entity_decode($r['description']));?></textarea>
        <script type="text/javascript">CKEDITOR.replace("desc_en");
</script></td>
    </tr>
    <tr>
      <td><strong>Price $:</strong></td>
      <td><input type="text" name="price" id="price" value="<?php echo $r['points'];?>" class="TextField" maxlength="50"></td>
    </tr>
    <tr>
      <td><strong>Cost :</strong></td>
      <td><input type="text" name="cost" id="cost" value="<?php echo $r['cost'];?>" class="TextField" maxlength="50" /></td>
    </tr>
    <tr>
      <td><strong>Tax :</strong></td>
      <td><input type="text" name="tax" id="tax" class="TextField" value="<?php echo $r['tax'];?>"  /></td>
    </tr>
    <tr>
      <td><strong>Handling Charges:</strong></td>
      <td><input type="text" name="charges" id="charges" value="<?php echo $r['charges'];?>" class="TextField" /></td>
    </tr>
    <tr>
      <td><strong>Shipping :</strong></td>
      <td><input type="text" name="shipping" id="shipping" class="TextField" value="<?php echo $r['shipping'];?>" /></td>
    </tr>
	<tr>
      <td><strong>Product Images :</strong></td>
      <td><?php if($r['image'] !=''){ for($y=0;$y<count($images);$y++){ ?>
        <div id='<?php echo $y;?>'><div style="float: left; width: 105px; padding: 2px;"><div style="float: right;"><img src='../images/cross.png' width='20' height='20' onclick="delete_pic('<?php echo $images[$y];?>','<?php echo $pid;?>',<?php echo$y;?>)"/></div><img src="../images/thumb_<?php echo $images[$y];?>" alt="<?php echo $images[$y]; ?>" width="105" height="90" border="0" /></div></div>
          <?php }}?></td>
    </tr>

    <tr>
      <td></td>
      <td><div style="float:right; margin-right: 270px;">
          <input class="btn" type="button" name="addmore" id="addmore" value="Add More Images" onClick="dothat();" />
        </div>
        <div id="fileuploads" style="width: 10px;">
          <input type="file" name="file[]" id="file" class="modal btn" maxlength="50">
        </div></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="Update" class="btn"></td>
    </tr>
  </table>
</form>
