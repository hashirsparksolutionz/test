<script type="text/javascript">
function dothat() {
   var div = document.getElementById('fileuploads');
	var field = div.getElementsByTagName('input')[0];
	
	div.appendChild(document.createElement("br"));
	div.appendChild(field.cloneNode(false));
}


function delete_pic(pic,pr_id,div_id) 
{	
	
	$.post("mod/post_images.php?pr_id="+pr_id+"&pic="+pic,{
		
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
function template(val){
		if(val!=' '){
			window.location.href ='?p=ManageProductsPages&id='+val;
		}
	 }

</script>
<?php 
if(isset($_GET['id'])){
	if($_GET['id']!='A'){
$pid=$_GET['id'];

$q=mysqli_query($con, "SELECT * FROM `products_pages` WHERE `id`='".$pid."'") or mysqli_error($con);
$r=mysqli_fetch_array($q);
	}
}
if(isset($_POST['submit']))
{
		$desc_en		=	mysqli_real_escape_string($con, htmlentities($_POST['desc_en']));
	
		$old_img		=	$_POST['old_img'];	
	if($category == '3'){
	$sp = 1;	
		}else{
			$sp=0;
			}
	
	 if($_FILES['file']['tmp_name'] == '')
	  {
	//	 echo $_FILES['file']['tmp_name'];
		//$images = ltrim($r['image'], '@');  
		 
 echo $query="UPDATE  `products_pages` SET `description` =  '".$_POST['desc_en']."' WHERE `id` ='".$pid."'";

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
	  $image->save('../images/product_pages/thumb_'.$_FILES["file"]["name"][$key]);
      move_uploaded_file($_FILES["file"]["tmp_name"][$key],'../images/product_pages/'.$_FILES["file"]["name"][$key]);
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
	  
	$que="UPDATE  `products_pages` SET  `description` =  '".$_POST['desc_en']."',`image` =  '".$dt_image."' WHERE `id` ='".$pid."'";
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
window.location.href = "?p=ManageProductsPages&mes=update";
</script>
<?php
}
?>

<h2 class="table table-striped">Edit Your Product Page <?php if($_GET['id'] != 'A'){echo $_GET['id'];}?></h2>
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
<form method="post" name="product_pages" action="" enctype="multipart/form-data">
  <table border="0" class="table table-striped">
     <tr><td width="100"><strong>Choose Product Page</strong></td>
       <td width="340"><select name="email_temp" id="email_temp" onchange="template(this.value);">
          <option value="A"<?php if($_GET['id']=='A' || $_GET['id']==''){ ?> selected="selected" <?php } ?>>Choose</option>
          <option value="1"<?php if($_GET['id']=='1'){ ?> selected="selected" <?php } ?>>Product Page 1</option>
		 <option value="2"<?php if($_GET['id']=='2'){ ?> selected="selected" <?php } ?>>Product Page 2</option>					
         <option value="3"<?php if($_GET['id']=='3'){ ?> selected="selected" <?php } ?>>Product Page 3</option>
         <option value="4"<?php if($_GET['id']=='4'){ ?> selected="selected" <?php } ?>>Product Page 4</option>					
         <option value="5"<?php if($_GET['id']=='5'){ ?> selected="selected" <?php } ?>>Product Page 5</option>
       </select></td>
    </tr>
  </table>
</form>
<?php if($_GET['id']!='A' && $_GET['id']!=' '){?>
<form method="post" name="add-product" action="" enctype="multipart/form-data">
  <table border="0" class="table table-striped">
    <tr>
      <td width="100" valign="middle"><strong><strong>Description :</strong></strong></td>
      <td width="340"><textarea name="desc_en" id="desc_en" cols="45" rows="5"><?php echo stripslashes(html_entity_decode($r['description']));?></textarea>
        <script type="text/javascript">CKEDITOR.replace("desc_en");
</script></td>
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
<?php }?>