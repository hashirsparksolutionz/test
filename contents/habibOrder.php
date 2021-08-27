<?php 
if(!isset($_SESSION['userid']))
{
?>
<script type="text/javascript">
//window.location.href = "?p=signin";
</script>
<?php } ?>
<?php	
	
$cartquery = mysql_query("select c.*,p.name,p.image,p.points from cart c , products p where c.session_id='".session_id()."' and c.prd_id=p.id");
echo $cartquery."<br>";
exit;
//echo "select c.*,p.name,p.image1 from cart c , products p where c.session_id='".session_id()."' and c.prd_id=p.id";
 $num = mysql_num_rows($cartquery);

?>

<div class="shape-featured">
  	<div class="text-haead"><strong>SHOPING CART DETAILS</strong></div>
</div>


  <form name="Form1" enctype="multipart/form-data" action="?p=PlaceOrder" method="post">
    
<table border="0" width="100%" style="margin-top:22px;" cellpadding="0" cellspacing="0">
      <tr>
      <?php if($num == 0){ ?>
    <td height="10" align="center" colspan="15"><h4>You Cart Is Empty</h4></td>
    </tr>
    <?php } ?>
  <tr>
  <?php if($num != 0){ ?>
    <td width="68" height="22" align="center">&nbsp;</td>
    <td width="74" height="22" align="left"><span class="des-text"><strong> No.</strong></span></td>
    <td width="104" height="22"><span class="des-text"><strong>Image</strong></span></td>
    <td width="217" height="22"><span class="des-text"><strong>Item Name</strong></span></td>
    <td width="128" height="22"><span class="des-text"><strong>Points</strong></span></td>
    <td width="132" height="22"><span class="des-text"><strong>Quantity</strong></span></td>
    <td width="129"><span class="des-text"><strong>Total</strong></span></td>
    </tr>
     <tr>
    <td colspan="15"><hr style="margin-top:0px;"></td>
    </tr>
    
   <?php 
   $counter	=	1;
   $subtotal=0;
   $i=0;
   $cartIdstr="";
   while($cartrs=mysql_fetch_array($cartquery)){
	   $itemtotal= $cartrs[points]*$cartrs[quantity];
	   $subtotal +=$itemtotal;
	   ?> 
  <tr>
    <td height="38" align="center">&nbsp;</td>
    <td align="left"><span class="des-text" bgcolor="#f3f4f5"><?php echo $counter; ?></span></td>
    <td width="104" height="50"><img src="images/thumb_<?php echo $cartrs[image];?>" width="45" height="55" style="border:1px solid #999; border-style:dotted" alt="thumb" /></td>
    <td align="left"><span class="des-text" bgcolor="#f3f4f5"><?php echo $cartrs[name]?></span></td>
    <td><span class="des-text" bgcolor="#f3f4f5"><?php echo $cartrs[points]?></span></td>
    <td align="left"><?php echo $cartrs[quantity]?></td>
    <td><span class="des-text" bgcolor="#f3f4f5"><?php echo $itemtotal;?></span></td>
  </tr>
  <tr>
    <td height="20" colspan="15"><a href="?p=home">

    </a></td>
    </tr>


    <?php if($i==0){ $cartIdstr=$cartIdstr.$cartrs["id"];}else{ $cartIdstr=$cartIdstr."~".$cartrs["id"];} ?>
	<?php 
	
	$i++;
	
	$counter++;}
	
	
	
//	mysql_query("INSERT INTO `order` SET `user_id`='$id_user',`order_date`='$date_time',`total_points`='$subtotal'");

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
    <td height="22" align="left"><span class="des-text"><strong><?php echo $subtotal;?>
    <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $subtotal;?>" />
    </strong></span></td>
    <td height="22" align="center">&nbsp;</td>
    <td height="22" colspan="2" align="center">&nbsp;</td>
    <td width="97" height="22" colspan="20" align="left"></span></td>
    <?php } ?>
     </tr>
      <tr>
    <td colspan="15"></td>
    </tr>
         <td height="31" colspan="15" align="right" valign="top">
         <div style="float:left"></div>
         
         <div style="float:right">
      <input type="button" onclick="window.location.href='?p=Cart'" name="continue_shopping"  class="btn-11" id="dispaly" value="« Go Back" alt="add_to_cart" style="width:80px;"/>
      <input type="button" onclick="window.location.href='?p=Products'" name="continue_shopping"  class="btn-11" id="dispaly" value="Continue Shopping" alt="add_to_cart" style="width:137px;"/>
         
         <?php if($num != 0){ ?>
         <input type="submit" name="dispaly"  class="btn-11" id="dispaly" value="Continue Order" alt="add_to_cart" style="width:137px"/>
         <?php } ?>
         </div>
         </td>         
    </tr>
</table>
</form>
