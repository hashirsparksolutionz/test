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
$name 	= 	$_GET['name'];
$mes    =	$_GET['mes'];
$DelOrd =	$_GET['DelOrd'];
if($mes == 'del') { $mes = 'Record Has Been Deleted Successfully'; }

if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } 
if($DelOrd == 'DeleteRec'){
	
mysqli_query($con, "DELETE FROM orders WHERE user_id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'");
mysqli_query($con, "DELETE FROM order_detail WHERE order_id = '".$_GET['OrdDetID']."'");
/*echo "DELETE FROM orders WHERE user_id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'";
echo "DELETE FROM order_detail WHERE order_id = '".$_GET['OrdDetID']."'";*/
?>
<script type="text/javascript">
window.location.href='?p=my_order&name=<?php echo $name ?>&mes=del';
</script>
<?php }
$query1= mysqli_query($con, "select * from userinfo where EmployerNumber='".$name."'");
$rw1=mysqli_fetch_array($query1);
$id1=$rw1['id'];
//$rslt=mysqli_query($con, "select * from orders where pendig=0 OR pendig=1 ORDER BY id DESC");
$rslt=mysqli_query($con, "select * from orders where user_id='".$id1."'");
$totalRecs = mysqli_num_rows($rslt);
$fp = fopen('order.csv', 'w');
$columns = 'First Name,Last Name,Address 1,Address 2,City,State,Zip,Phone, Email,Employee Number,Points';
//$columns = 'ID,First Name,Last Name,Username,Address 1,Address 2,City,State,Zip Email,Points';
fputcsv($fp,explode(',',$columns));
if($totalRecs>0){?>

<table width="200" class="table table-striped">
<?php /*?><!--<tr>
    <td colspan="2"><a href='?p=orders&download_file=order.csv'>To Export  As CSV Click here</a></td>
  </tr>--><?php */?>
<tr>
    <td style="width: 65px;"><h2>&nbsp;</h2></td>
    <td align="center"><div align="center"><h2><strong>Orders</strong></h2></div></td>
  </tr>
<?php
$counter =1;
while($rw=mysqli_fetch_assoc($rslt)){

//$info['id']=$rw['id'];
$info['user_id']=$rw['user_id'];
$info['order_date']=$rw['order_date'];
$info['total_points']=$rw['total_points'];
$info['pendig']=$rw['pendig'];
////////////////////////// Uers Qry///////////////////

$P_counter=1;
$query2="select * from order_detail where order_id='".$rw['id']."'";
$order_detail=mysqli_query($con, $query2);

$query1= mysqli_query($con, "select * from userinfo where EmployerNumber='".$name."'");
$rw1=mysqli_fetch_array($query1);
$id1=$rw1['id'];
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
    <td colspan="3"><h2><strong>Profie Details:</strong></h2></td>
    <td colspan="3"><a style="float:right;" href="?p=my_order&DelOrd=DeleteRec&UserId=<?php echo $rw['user_id'];?>&OrdDetID=<?php echo $rw['id'];?>&name=<?php echo $name ?>" class="delete" onclick="return confirm('Do You Want To Delete This Record');"><img src="../images/cross.png" width="20" height="20" border="0">&nbsp;Delete</a></td>
  </tr>
  <tr>
    <td width="85"><strong>Name:</strong></td>
    <td width="71"><?php echo $rw1['fname'].' '.$rw1['lname'];?></td>
    <td width="92"><strong>Username:</strong></td>
    <td width="82"><?php echo $rw1['EmployeeNumber'];?></td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr id="<?php echo $rw1['id']; ?>" class="edit_tr">
<td><strong>Points:</strong></td>
<td class="edit_td">
<?php echo $rw1['points']; ?>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
  <tr>
    <td colspan="6"><h2><strong>Order Detail:</strong></h2></td>
  </tr>
  <tr>
    <td><strong>Order Date:</strong></td>
    <td><?php echo $rw['order_date'];?></td>
    <td><strong>Total Points:</strong></td>
    <td><?php echo $rw['total_points'];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><h2><strong>Product Detail:</strong></h2></td>
  </tr>
  
  <tr>
    <td height="38"><strong>Product No.</strong>:</td><td><strong>Product Name</strong>:</td>
    <td><strong>Product Name</strong>:</td>
    <td><strong>Quantity:</strong></td>
    <td><strong>Total Product Points:</strong></td>
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
$info['ppoints']=$product_row['PointCount'];
?>


    <td height="38"><?php echo $P_counter++;?></td>
    <td><?php echo $order_detail_row['prd_name'];?></td>
    <td></td>
    <td><?php echo $order_detail_row['quantity'];?></td>
    <td><?php echo $product_row['PointCount'].' x '.$order_detail_row['quantity'].' = '.$product_row['PointCount']*$order_detail_row['quantity'];?></td>
    <td><img src="../images/<?php echo $product_row['image']?>"; width='150' height="150" /></td>
  </tr>
  <?php } ?>
</table></td>
  
 <?php 
 if($_GET['download_file'])
{
//$columns = 'ID,First Name,Last Name,Address 1,Address 2,City,State,Zip,Phone, Email,Username,status';	

$str1=$rw1['fname'].','.$rw1['lname'].','.$rw1['address1'].','.$rw1['address2'].','.$rw1['city'].','.$rw1['state'].','.$rw1['zip'].','.$rw1['phone'].','.$rw1['email'].','.$rw1['EmployeeNumber'].','.$rw1['points'];

//$str=$info['id'].','.$rw1['fname'].','.$rw1['lname'].','.$rw1['username'].','.$rw1['address1'].','.$rw1['address2'].','.$rw1['city'].','.$rw1['state'].','.$rw1['zip'].','.$rw1['phone'].','.$rw1['city'].','.$rw1['email'].','.$rw1['points'];
fputcsv($fp,explode(',',$str1));

?>

<script type="text/javascript">
  //window.location.href = 'Waiting List.csv';
  window.open('order.csv','_parent');
  setTimeout(fun,1000);
  function fun(){
  window.location.href = '?p=my_order&name=<?php echo $name ?>';
  }
</script>
<?php

}
 
}

  ?>
<?php /*?><!-- <tr>
    <td colspan="2"><a href='?p=my_order&download_file=order.csv'>To Export  As CSV Click here</a></td>
  </tr>--?
</table><?php */?>

<?php }else{ ?><div style="margin-left: 215px;"><h2>Right Now, You Have No New Orders11</h2>
</div> <?php } ?>