<?php set_time_limit(3000); ?>



<script type="text/javascript">
function status_check(id) 
{	
	
	$.post("mod/post2.php?id="+id,{
		
			}, function(response){
			
			//	alert(response);
			if(response==1)
			{
				$("#release"+id).show();
			//	$("#lbl"+id).html('');
				
				
			//	change_captcha();
			//	clear_form();
			}
			else if(response==0)
			{
				$("#release"+id).hide();
			    $("#after_submit").html('');
				//$("#Send").after('<label class="error" id="after_submit"> .</label>');
				
			}
			return false;
			
		});
				
	
	
}
function status_release(id) 
{	
	
	$.post("mod/post2.php?id_release="+id,{
		
			}, function(response){
			
			//	alert(response);
			if(response==1)
			{
				//$("#release"+id).show();
				$("#lbl"+id).html('Awaiting For Shipment');	
			//	change_captcha();
			//	clear_form();
			}
			else if(response==0)
			{
				/*$("#release"+id).hide();
			    $("#lbl"+id).html('');*/
				//$("#Send").after('<label class="error" id="after_submit"> .</label>');
				
			}
			return false;
			
		});
				
	
	
}
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
$("#first_"+ID).hide();
$("#first_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var first=$("#first_input_"+ID).val();
var dataString = 'id='+ ID +'&firstname='+first;
$("#first_"+ID).html('<img src="load.gif" />'); // Loading image

if(first.length>0)
{

$.ajax({
type: "POST",
url: "manage/orders/hi.php",
data: dataString,
cache: false,
success: function(html)
{
$("#first_"+ID).html(first);
}
});
}
else
{
alert('Enter something.');
}

});

// Edit input box click action
$(".editbox").mouseup(function() 
{
return false
});

// Outside click action
$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});
</script>
<?php //$query="select * from orders";

$mes    =	$_GET['mes'];
$DelOrd =	$_GET['DelOrd'];
if($mes == 'del') { $mes = 'Record Has Been Deleted Successfully'; }

if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } 
if($DelOrd == 'DeleteRec'){
	
//mysqli_query($con, "DELETE FROM userinfo WHERE id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'");
mysqli_query($con, "DELETE FROM userinfo WHERE userinfo = '".$_GET['OrdDetID']."'");
/*echo "DELETE FROM userinfo WHERE user_id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'";
echo "DELETE FROM order_detail WHERE order_id = '".$_GET['OrdDetID']."'";*/
?>
<script type="text/javascript">
window.location.href='?p=orders&mes=del';
</script>
<?php }

$rslt="select * from `userinfo`";
if(mysqli_query($con, $rslt)){
	echo "sddsf";
	exit();
}
else{
 echo mysqli_error($con, $rslt);	
	
}


$totalRecs = mysqli_num_rows($rslt);
$fp = fopen('order.csv', 'w');
$columns = 'Vouchers,Job Number,First Name,Last Name,Address 1,Address 2,City,State,Zip,Phone, Email,Product Name,Choice 1,Choice 2,Amount,Redemption Date';
//$columns = 'ID,First Name,Last Name,Username,Address 1,Address 2,City,State,Zip Email,Points';
fputcsv($fp,explode(',',$columns));
if($totalRecs>0){?>

<table width="200" class="table table-striped">
<tr>
    <td colspan="2"><a href='manage/orders/Orders_xls.php'>To Export  As Excel Click here</a></td>
  </tr>
<tr>
    <td style="width: 65px;"><h2>&nbsp;</h2></td>
    <td align="center"><div align="center"><h2><strong>Orders</strong></h2></div></td>
  </tr>
<?php
$counter =1;
while($rw=mysqli_fetch_assoc($rslt))
{ 
echo $rw1['address1'];
exit();
//$info['id']=$rw['id'];
$info['user_id']=$rw['user_id'];
$info['order_date']=$rw['order_date'];
$info['total_points']=$rw['total_points'];
$info['pendig']=$rw['pendig'];
////////////////////////// Uers Qry///////////////////

$P_counter=1;
$query2="select * from order_detail where order_id='".$rw['id']."'";
$order_detail=mysqli_query($con, $query2);
$query3="select * from capXlsx where certificate='".$rw['certificate']."'";
$job=mysqli_query($con, $query3);


$query1= mysqli_query($con, "select * from userinfo where vocher='".$rw['certificate']."'");
$rw1=mysqli_fetch_array($query1);
$info['fname']=$rw1['fname'];
$info['username']=$rw1['EmployeeNumber'];
$info['Upoints']=$rw1['points'];
$var="";
if($rw['pendig']=='1' || $rw['pendig']=='0')
{
	$var ="pending";
}
else if($rw['pendig']=='2')
{
	$var="Awaiting For Delivery";
}
else if($rw['pendig']=='3')
{
	$var="Order Delivered";
}
?>
  
  <tr>
    <td><h2><strong><?php echo $counter++;?>:</strong></h2></td>
    <td><table>
  <tr>
    <td colspan="3"><h2><strong>Profile Details:</strong></h2></td>
    <td colspan="3"><a style="float:right;" href="?p=orders&DelOrd=DeleteRec&UserId=<?php echo $rw['user_id'];?>&OrdDetID=<?php echo $rw['id'];?>" class="delete" onclick="return confirm('Do You Want To Delete This Record');"><img src="../images/cross.png" width="20" height="20" border="0">&nbsp;Delete</a></td>
  </tr>
  <tr>
    <td width="85"><strong>Name:</strong></td>
    <td width="71"><?php echo $rw1['fname'].' '.$rw1['lname'];?></td>
    <td width="92"><strong>Job Number:</strong></td>
    <td width="82"><?php $jobs=mysqli_fetch_array($job); echo $jobs['job'];?></td>
    <td width="87"><strong>Email:</strong></td>
    <td width="169"><?php echo $rw1['email'];?></td>
  </tr>
  <tr>
    <td><strong>Address1:</strong></td>
    <td><?php echo $rw1['address1'];?></td>
    <td><strong>Address2:</strong></td>
    <td><?php echo $rw1['address2'];?></td>
    <td><strong>City/State</strong></td>
    <td><?php echo $rw1['city'].'/'.$rw1['state'];?></td>
  </tr>
  <tr>
    <td><strong>Phone:</strong></td>
    <td><?php echo $rw1['phone'];?></td>
    <td><strong>Zip Code:</strong></td>
    <td><?php echo $rw1['zip']?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr class="edit_tr">
    <td><strong>Product</strong></td>
    <td class="edit_td" colspan="3"><?php echo str_replace("-PLEASE SELECT EACH OPTION","",$rw1['product']);?></td>
    <td>&nbsp;</td>
  </tr>
  <tr class="edit_tr">
    <td><strong>Choice 1:</strong></td>
    <td class="edit_td" colspan="2"><?php echo $rw1['size'];?></td>
    <td><strong>Choice 2:</strong></td>
    <td><?php echo $rw1['color'];?></td>
  </tr>
  <tr id="<?php echo $rw1['id']; ?>" class="edit_tr">
<td><strong>Voucher:</strong></td>
<td class="edit_td" colspan="2">
<?php echo $rw['certificate']; ?>
</td>

<td><strong>Used Voucher Date:</strong></td>
<td><?php $dt=explode('-',$rw['order_date']); echo $dt[1]."-".$dt[2]."-".$dt[0]; ?></td>


</tr>
  <tr>
    <td colspan="6"><h2><strong>Order Detail:</strong></h2></td>
  </tr>
  <tr>
    <td><strong>Order Date:</strong></td>
    <td><?php $dt=explode('-',$rw['order_date']); echo $dt[1]."-".$dt[2]."-".$dt[0]; ?></td>
    <td><strong>Total Amount:</strong></td>
    <td><?php if($rw['total_points']!=""){ echo "$".$rw['total_points'];}?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><h2><strong>Product Detail:</strong></h2></td>
  </tr>
  
  <tr>
    <td height="38"><strong>Product No.</strong>:</td><td><strong>Product Name</strong>:</td>
    
    <td><strong>Quantity:</strong></td>
    <td><strong>Total Amount:</strong></td>
    <td><strong>Product Image:</strong></td>
    </tr>
  <tr>
<?php 

while($order_detail_row=mysqli_fetch_assoc($order_detail)){
/////////////////////////////////////////////////////////////
$info['prd_name']=$order_detail_row['prd_name'];
$info['prd_id']=$order_detail_row['prd_id'];
$info['quantity']=$order_detail_row['quantity'];
///////////////////////////////Product Table////////////////////////////////////
$product_query=mysqli_query($con, "select * from `products`  where id='".$order_detail_row['prd_id']."'");
$product_row=mysqli_fetch_array($product_query);
$info['image']=$product_row['image'];
$info['ppoints']=$product_row['points'];
$image=explode('@',$product_row['image']);
?>


    <td height="38"><?php echo $P_counter++;?></td>
    <td><?php echo $order_detail_row['prd_name'];?></td>
   
    <td><?php echo $order_detail_row['quantity'];?></td>
    <td><?php echo $product_row['points'].' x '.$order_detail_row['quantity'].' = '.$product_row['points']*$order_detail_row['quantity'];?></td>
    <td><img src="../images/thumb_<?php echo $image[0]?>"; width='150' height="150" /></td>
  </tr>
  <?php } ?>
</table></td>
  
 <?php 
 /*if($_GET['download_file'])
{
	$prd_name=str_replace("-PLEASE SELECT EACH OPTION","",$rw1['product']);
	if($order_detail_row['prd_name']!=''){
	$prd_name=	str_replace("-PLEASE SELECT EACH OPTION","",$rw1['product']).'|'.$order_detail_row['prd_name'];
		
		}
//$columns = 'ID,First Name,Last Name,Address 1,Address 2,City,State,Zip,Phone, Email,Username,status';	

$str1=$rw['certificate'].','.$jobs['job'].','.$rw1['fname'].','.$rw1['lname'].','.$rw1['address1'].','.$rw1['address2'].','.$rw1['city'].','.$rw1['state'].','.$rw1['zip'].','.$rw1['phone'].','.$rw1['email'].','.str_replace(',',' ',$prd_name).','.$rw1['size'].','.$rw1['color'].','.$rw['total_points'].','.$rw['order_date'];
if($str1!=',,,,,,,,,,'){
//$str=$info['id'].','.$rw1['fname'].','.$rw1['lname'].','.$rw1['username'].','.$rw1['address1'].','.$rw1['address2'].','.$rw1['city'].','.$rw1['state'].','.$rw1['zip'].','.$rw1['phone'].','.$rw1['city'].','.$rw1['email'].','.$rw1['points'];
fputcsv($fp,explode(',',$str1));
}
?>


<script type="text/javascript">
  //window.location.href = 'Waiting List.csv';
  window.open('order.csv','_parent');
  setTimeout(fun,6000);
  function fun(){
  window.location.href = '?p=orders';
  }
</script>
<?php

 }*/
 
 
 
 } ?>
 <tr>
    <td colspan="2"><a href='admin/manage/orders/Orders_xls.php'>To Export  As Excel Click here</a></td>
  </tr>
</table>

<?php }else{?><div style="margin-left: 215px;">
  <H2>Right Now, You Have No New Orders1111</H2></div><?php }?>