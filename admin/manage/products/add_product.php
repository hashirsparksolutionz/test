<script type="text/javascript">
function dothat() {
   var div = document.getElementById('fileuploads');
	var field = div.getElementsByTagName('input')[0];
	
	div.appendChild(document.createElement("br"));
	div.appendChild(field.cloneNode(false));
}
function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 30 && (charCode < 40 || charCode > 57))
 return false;
else
 return true;
 }

</script>
<?php 
if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$for_sale=$_POST['for_sale'];	
	$name=mysqli_real_escape_string($con, htmlentities($_POST['name']));
	$name_ar=mysqli_real_escape_string($con, htmlentities($_POST['name_ar']));
	$desc_en=mysqli_real_escape_string($con, $_POST['desc_en']);
	$desc_ar=mysqli_real_escape_string($con, $_POST['desc_ar']);
	$price=$_POST['price'];
	////////////////////////////////////////
	$cost			=	$_POST['cost'];
	$tax			=	$_POST['tax'];
	$shipping		=	$_POST['shipping'];
	$charges		=	$_POST['charges'];
	/////////////////////////////////////
	
	/*if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 100000000))
  {*/
 // if ($_FILES["file"]["error"] > 0)
   // {
    //echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  //  }
 // else
    //{
    //if (file_exists("images/" . $_FILES["file"]["name"]))
    //  {
    //  echo $_FILES["file"]["name"] . " already exists. ";
     // }
   // else
     // {
	  include('SimpleImage.php');
      $image = new SimpleImage();
	  $image_name="";
	  foreach($_FILES['file']['tmp_name'] as $key => $tmp_name)
	  {

      $image->load($_FILES['file']['tmp_name'][$key]);
	  $image->resize(200,166);
	  $image->save('../images/thumb_'.$_FILES["file"]["name"][$key]);
	  //$image->save('../images/'.$_FILES["file"]["name"][$key]);
	  //$image_name=$_FILES["file"]["name"][$key];
	//  move_uploaded_file('thumb_'.$image_name,"../images/thumb_");
     // move_uploaded_file('../images/'.$_FILES["file"]["name"][$key]);
	  		   move_uploaded_file($_FILES["file"]["tmp_name"][$key],'../images/'.$_FILES["file"]["name"][$key]);
	  }
	   $image_name .= implode('@',$_FILES["file"]["name"]);
	  
	/*  
	echo $image_name;exit;
	*/
	 // }
	 //}
	/////////////////////////////////////////
	
	
	//echo "INSERT INTO  `products` (`name` ,`description` ,`points` ,`image`)VALUES ('".$name."',  '".$desc_en."',  '".$price."',  '".$image_name."')";
	$que="INSERT INTO  `products` (`name` ,`description` ,`points` ,`image`, `cost`, `tax`, `shipping`, `charges`)VALUES ('".$name."',  '".$desc_en."',  '".$price."',  '".$image_name."', '".$cost."', '".$tax."', '".$shipping."', '".$charges."')";	
	mysqli_query($con, $que) or mysqli_error($con);
	?>
<script language="javascript">
window.location.href = "?p=ManageProducts&mes=add";
</script>
<?php
	//}else{
		
		?>
<script language="javascript">

//window.location.href = "?p=ManageProducts&mes=err";
</script>
<?php
		
		//}
	/*$msg="Your Product Has Been Added Successfully";*/

}
?>

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
<h2 class="table table-striped">Add Your Product</h2>
<?php /*?><?php if($msg!=''){ ?><div id="ErrorMsg"><h3><?php echo $msg;?></h3></div><?php }?><?php */?>
<form method="post" name="add-product" action="" enctype="multipart/form-data">
  <table border="0" class="table table-striped">
    <tr>
      <td width="100"><strong>Name</strong></td>
      <td width="340"><input type="text" name="name" id="name" class="TextField" maxlength="50"></td>
    </tr>
    <tr>
      <td valign="middle"><strong>Description:</strong></td>
      <td><textarea name="desc_en" id="desc_en" cols="45" rows="5"></textarea>
        <script type="text/javascript">CKEDITOR.replace("desc_en");
        </script></td>
    </tr>
    <tr>
      <td><strong>Price: $</strong></td>
      <td><input type="text" name="price" id="price" onkeypress="return isNumberKey(event)" class="TextField" maxlength="50"></td>
    </tr>
    <tr>
      <td><strong>Cost :</strong></td>
      <td><input type="text" name="cost" id="cost" onkeypress="return isNumberKey(event)" class="TextField" maxlength="50" /></td>
    </tr>
    <tr>
      <td><strong>Tax :</strong></td>
      <td><input type="text" name="tax" id="tax" onkeypress="return isNumberKey(event)" class="TextField" maxlength="50" /></td>
    </tr>
    <tr>
      <td><strong>Handling Charges:</strong></td>
      <td><input type="text" name="charges" id="charges" onkeypress="return isNumberKey(event)" class="TextField" maxlength="50" /></td>
    </tr>
    <tr>
      <td><strong>Shipping :</strong></td>
      <td><input type="text" name="shipping" onkeypress="return isNumberKey(event)" id="shipping" class="TextField" maxlength="50" /></td>
    </tr>
    <tr>
      <td><strong>Image:</strong></td>
      <td><div style="float:right; margin-right: 315px;">
          <input class="btn" type="button" name="addmore" id="addmore" value="Add More" onClick="dothat();" />
        </div>
        <div id="fileuploads" style="width: 10px;">
          <input type="file" name="file[]" id="file" class="modal btn" maxlength="50">
        </div></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" style="float:right;" name="submit" value="Add" class="btn"></td>
    </tr>
  </table>
</form>
