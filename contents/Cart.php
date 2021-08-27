<?php 
	$del = $_GET['del'];
	//$msg	=	"";
	
	if($del){
		mysqli_query($con, "DELETE from cart where id = $del LIMIT 1;");?>
<script language="javascript">
		window.location.href="?p=Cart";
		</script>
<?php }
	
	if(isset($_REQUEST['empty'])){
		
		mysqli_query($con, "DELETE FROM cart where session_id = '".session_id()."'");?>
<SCRIPT language="javascript">
			window.location.href="?p=Cart";
		</SCRIPT>
<?php }
	
	
	
	if(isset($_REQUEST['update'])){
	$cartIDSrt = $_POST['cartIDSrt'];
	//echo $cartIDSrt."<br>";
	$CartIDs=explode("~",$cartIDSrt);
//	echo count($CartIDs)."<br>";
	
	for($i=0;$i<count($CartIDs);$i++){

	$quantity = "quantity".$i;
	
	$quantity = $_POST[$quantity];
	
//	echo "UPDATE cart SET quantity= $quantity WHERE id=".$CartIDs[$i]."<br>";
	mysqli_query($con, "UPDATE cart SET quantity= $quantity WHERE id=".$CartIDs[$i]); ?>
<script language="javascript">
    window.location.href="?p=Cart";
    </script>
<?php }

	}

	$id_user		=	$_SESSION['userid'];
	$date_time    	= date("Y-m-d H:i:s");

$cartquery = mysqli_query($con, "select c.*,p.name,p.image,p.points from cart c , products p where c.session_id='".session_id()."' and c.prd_id=p.id");

//exit;
 $num = mysqli_num_rows($cartquery);

?>
<script type="text/javascript">

function checkAll(checkbox, theCommonNodeName) {
theCommonNodeName = theCommonNodeName.toLowerCase();
var theCommonNode = checkbox.parentNode;
while(theCommonNode.nodeName.toLowerCase() != theCommonNodeName && theCommonNode != document) {
theCommonNode = theCommonNode.parentNode;
}

if(theCommonNode.nodeName.toLowerCase() != theCommonNodeName) {
alert("Common parent node could not be found");
return;
}

var inputs = theCommonNode.getElementsByTagName("input");
for(var i=0; inputs[i]; i++) {
if(inputs[i].type == "checkbox") {
inputs[i].checked = checkbox.checked;
}
}
}

function SubmitOrder(){
	window.location.href='?p=display';
}
</script>

<div class="shape-featured">
  <div class="text-haead"><strong>SHOPPING CART DETAILS</strong></div>
</div>
<?php
	$page_id = $_SESSION['page_id'];
	$array = explode("+",$page_id);
	$page_name = $array[0];
	$p_id = $array[1];
	$paging = $array[2];
	 ?>
<form name="Form1" enctype="multipart/form-data" action="" method="post">
  <table border="0" width="100%" style="margin-top:22px;" cellpadding="0" cellspacing="0">
    <tr>
      <?php if($num == 0){ ?>
      <td height="10" align="center" colspan="15"><h4> <strong>Shipping Price :</strong>
          <?php if(isset($_SESSION['abc'])){  $shippingPrice = $_SESSION['abc']; echo "$".$shippingPrice; }?>
        </h4></td>
    </tr>
    <?php } ?>
    <tr>
      <?php if($num != 0){ ?>
      <td width="68" height="22" align="center">&nbsp;</td>
      <td width="74" height="22" align="left"><span class="des-text"><strong> No.</strong></span></td>
      <td width="104" height="22"><span class="des-text"><strong>Image</strong></span></td>
      <td width="217" height="22"><span class="des-text"><strong>Item Name</strong></span></td>
      <td width="128" height="22"><span class="des-text"><strong>Price:</strong></span></td>
      <td width="132" height="22"><span class="des-text"><strong>Quantity</strong></span></td>
      <td width="129"><span class="des-text"><strong>Total</strong></span></td>
      <td colspan="17"><span class="des-text"><strong>Actions</strong></span></td>
    </tr>
    <tr>
      <td colspan="15"><hr style="margin-top:0px;"></td>
    </tr>
    <?php 
   $counter	=	1;
   $subtotal=0;
   $i=0;
   $cartIdstr="";
   while($cartrs=mysqli_fetch_array($cartquery)){
	   $itemtotal= $cartrs[points]*$cartrs[quantity];
	   $subtotal +=$itemtotal;
	   ?>
    <?php 
       $img   =   explode('@',$cartrs['image']);
	   /*if($img != ''){ echo "Not empty";}else{
		   echo "Not empty";
		   
		   }*/
      ?>
    <tr>
      <td height="38" align="center">&nbsp;</td>
      <td align="left"><span class="des-text" bgcolor="#f3f4f5"><?php echo $counter; ?></span></td>
      <td width="104" height="50"><img src="images/thumb_<?php echo $img['0'];?>" width="45" height="55" style="border:1px solid #999; border-style:dotted" alt="thumb" /></td>
      <td align="left"><span class="des-text" bgcolor="#f3f4f5"><?php echo $cartrs[name]?></span></td>
      <td><span class="des-text" bgcolor="#f3f4f5"><?php echo "$".$cartrs[points]; ?></span></td>
      <td align="left"><input name="quantity<?php echo $i?>" type="text" style="width: 65px;" class="textBox-2" value="<?php echo $cartrs[quantity]?>" size="5" /></td>
      <td><span class="des-text" bgcolor="#f3f4f5"><?php echo  "$".$itemtotal;?></span></td>
      <td width="129"><a href="?p=<?php echo $p; ?>&del=<?php echo $cartrs['id']; ?>" class="cont-aa" onclick="return confirm('Are you sure you want to delete <?php echo $cartrs['name']; ?>')"><img src="../images/cross.png" border="0"  />Delete</a></td>
    </tr>
    <tr>
      <td height="20" colspan="15"><a href="?p=home"> </a></td>
    </tr>
    <?php if($i==0)
	{ 
	$cartIdstr=$cartIdstr.$cartrs["id"];
	}
	else
	{ 
	$cartIdstr=$cartIdstr."~".$cartrs["id"];
	}
	 ?>
    <?php 
	
	$i++;
	
	$counter++;}
	
	
	
//	mysqli_query($con, "INSERT INTO `order` SET `user_id`='$id_user',`order_date`='$date_time',`total_points`='$subtotal'");

//echo "INSERT INTO `order` SET  `user_id`='$id_user',`order_date`='$date_time',`total_points`='$subtotal'"; 
	
	
	?>
    <tr>
      <td height="22" colspan="8" align="center"><hr style="margin-top:12px;"></td>
      <td height="22" colspan="2" align="center">&nbsp;</td>
      <td height="22" colspan="20" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="left"><span class="des-text" style="padding-right:5px;"><strong>Sub Total : </strong></span></td>
      <td height="22" align="left"><span class="des-text"><strong>
        <?php $_SESSION['SUBTOTAL']=$subtotal; echo "$".$subtotal;?>
        </strong>
        <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $subtotal;?>" />
        </span></td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" colspan="2" align="center">&nbsp;</td>
      <td width="97" height="22" colspan="20" align="left"></span></td>
    </tr>
    <tr>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="left"><span class="des-text" style="padding-right:5px;"><strong>Shipped:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ </strong></span></td>
      <td height="22" align="left"><span class="des-text"><strong>
        <?php
	 
	$ship=$_SESSION['abc'];
	echo "$".$ship;
	
	?>
        </strong></span></td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" colspan="2" align="center">&nbsp;</td>
      <td width="97" height="22" colspan="20" align="left"></span></td>
    </tr>
    <tr>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" align="left"><span class="des-text" style="padding-right:5px;"><strong>Total</strong></span></td>
      <td height="22" align="left"><span class="des-text"> <strong>
        <?php 
	      $var=$_SESSION['abc']+$subtotal;
		  echo "$".$var;
	?>
        </strong> </span></td>
      <td height="22" align="center">&nbsp;</td>
      <td height="22" colspan="2" align="center">&nbsp;</td>
      <td width="97" height="22" colspan="20" align="left"></span></td>
      <?php } ?>
    </tr>
    <tr>
      <td colspan="15"></td>
    </tr>
    
      <td height="31" colspan="15" align="right" valign="top"><div style="float:left">
          <?php if($num != 0){ ?>
          <input name="update" type="submit" class="btn-11" id="Add to cart" value="Update" alt="add_to_cart"/>
          <input type="hidden" name="cartIDSrt" value= <?php echo $cartIdstr?>>
          <?php } ?>
          <?php if($num != 0){ ?>
          <input name="empty" type="submit" class="btn-11" id="Add to cart" value="Empty Cart" alt="add_to_cart"/>
          <?php } ?>
        </div>
        <div style="float:right">
          <input type="button" onclick="window.location.href='?p=Products&subtotal=<?php echo $subtotal;?>'" name="continue_shopping"  class="btn-11" id="dispaly" value="Continue Shopping" alt="add_to_cart" style="width:137px;"/>
          <?php
      if($num == 0){?>
          <input type="button" onclick="window.location.href='?p=PlaceOrder'" name="dispaly"  class="btn-11" id="dispaly" value="Order" alt="add_to_cart" style="width:137px"/>
          <?php } ?>
          <?php if($num != 0){ ?>
          <input type="button" onclick="window.location.href='?p=PlaceOrder'" name="dispaly"  class="btn-11" id="dispaly" value="Order" alt="add_to_cart" style="width:137px"/>
          <input type="hidden" name="total" value= <?php $_SESSION['TOTAL']=$var; echo $var?>>
          <?php /*?><a href="?p=PlaceOrder"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right: 7px; float: right; margin-top: 7px; height: 56px; width: 160px;"></a><?php */?>
          <?php } ?>
        </div></td>
    </tr>
  </table>
</form>
