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
	
mysqli_query($con, "DELETE FROM orders WHERE user_id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'");
mysqli_query($con, "DELETE FROM order_detail WHERE order_id = '".$_GET['OrdDetID']."'");
/*echo "DELETE FROM orders WHERE user_id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'";
echo "DELETE FROM order_detail WHERE order_id = '".$_GET['OrdDetID']."'";*/
?>
<script type="text/javascript">
window.location.href='?p=orders&mes=del';
</script>
<?php }

$rslt=mysqli_query($con, "select * from userinfo");
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
    <td align="center"><div align="center"><h2><strong>Users</strong></h2></div></td>
  </tr>
<?php
$counter =1;
while($rw=mysqli_fetch_assoc($rslt))
{ 

?>
  
  <tr>

    <td><table>
  <tr>
    <td colspan="3"><h2><strong>Profile Details:</strong></h2></td>
    <td colspan="3"><a style="float:right;" href="?p=orders&DelOrd=DeleteRec&UserId=<?php echo $rw['user_id'];?>&OrdDetID=<?php echo $rw['id'];?>" class="delete" onclick="return confirm('Do You Want To Delete This Record');"><img src="../images/cross.png" width="20" height="20" border="0">&nbsp;Delete</a></td>
  </tr>
  <tr>
    <td width="85"><strong>Name:</strong></td>
    <td width="71"><?php echo $rw1['fname'].' '.$rw1['lname'];?></td>

    <td width="87"><strong>Email:</strong></td>
    <td width="169"><?php echo $rw1['email'];?></td>
  </tr>
  <tr>
    <td><strong>Address1:</strong></td>
    <td><?php echo $rw1['address1'];?></td>
    <td><strong>Address2:</strong></td>
    <td><?php echo $rw1['address2'];?></td>
  
  </tr>
  <tr>
    <td><strong>Phone:</strong></td>
    <td><?php echo $rw1['phone'];?></td>
    <td><strong>Zip Code:</strong></td>
    <td><?php echo $rw1['zip']?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>City/State</strong></td>
    <td><?php echo $rw1['city'].'/'.$rw1['state'];?></td>
  
  
  
  
  
  
  
 
  <tr>
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

<?php }else{?><div style="margin-left: 215px;"><H2>Right Now, You Have No New user</H2></div><?php }?>