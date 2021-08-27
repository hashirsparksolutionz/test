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
$com=$_REQUEST['com'];
$mes    =	$_GET['mes'];
$DelOrd =	$_GET['DelOrd'];
$id =	$_GET['id'];
if($mes == 'up') { $mes1 = 'Record Has Been Update Successfully'; }
if($mes == 'del') { $mes1 = 'Record Has Been Deleted Successfully'; }
if($mes ==	'alldelete') { $mes1	='You Have Deleted All The Records Of This Table'; }
if($com=='empty'){
	
	//mysqli_query($con, "TRUNCATE TABLE `userinfo`");
	mysqli_query($con, "DELETE FROM userinfo WHERE WHERE `archive`='1' and s_check='1'");
	goUrl('?p=archOrder&mes=alldelete');
	
	
	
}
if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes1; ?></strong></div>
<?php } 
if($DelOrd == 'DeleteRec'){
	
//mysqli_query($con, "DELETE FROM userinfo WHERE id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'");
mysqli_query($con, "UPDATE `userinfo` SET `archive`='1'  WHERE id = '".$id."'");
/*echo "DELETE FROM userinfo WHERE user_id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'";
echo "DELETE FROM order_detail WHERE order_id = '".$_GET['OrdDetID']."'";*/
?>
<script type="text/javascript">
window.location.href='?p=archOrder&mes=up';
</script>
<?php }
if($DelOrd == 'DeleteRec1'){
	
mysqli_query($con, "DELETE FROM userinfo WHERE  id = '".$_GET['OrdDetID']."'");
//mysqli_query($con, "DELETE FROM order_detail WHERE order_id = '".$_GET['OrdDetID']."'");
/*echo "DELETE FROM archOrder WHERE user_id = '".$_GET['UserId']."' AND id = '".$_GET['OrdDetID']."'";
echo "DELETE FROM order_detail WHERE order_id = '".$_GET['OrdDetID']."'";*/
?>
<script type="text/javascript">
window.location.href='?p=archOrder&mes=del';
</script>
<?php }

$rslt=mysqli_query($con, "select * from `userinfo` WHERE `archive`='1' and s_check='1' ORDER BY id DESC");
?>

<div> <td colspan="2"><a href='?p=orders'>Show Unarchive Orders</a></div>
<?php
$totalRecs = mysqli_num_rows($rslt);
//$fp = fopen('order.csv', 'w');
//$columns = 'Vouchers,Job Number,First Name,Last Name,Address 1,Address 2,City,State,Zip,Phone, Email,Product Name,Choice 1,Choice 2,Amount,Redemption Date';
//$columns = 'ID,First Name,Last Name,Username,Address 1,Address 2,City,State,Zip Email,Points';
//fputcsv($fp,expplode(',',$columns));
if($totalRecs>0){?>

<table width="553" class="table table-striped">
<tr>
    <td colspan="2"><a href='manage/orders/Orders1_xls.php'>To Export  As Excel Click here</a></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?p=archOrder&com=empty" onClick= "return confirm('Do You Want To Delete All Records From The System?')">Delete All Records</a></td>
  </tr>
 
<tr>
    <td width="65" style="width: 65px;"><h2>&nbsp;</h2></td>
    <td width="476" align="center"><div align="center"><h2><strong>Orders</strong></h2></div></td>
  </tr>
 </table> 
<?php
$counter =1;
while($rw1=mysqli_fetch_assoc($rslt))
{ 

?>
  <table>

  <tr>
    <td height="63" colspan="3"><h2><strong>Profile Details <?php echo $counter++;?>:</strong></h2></td>
  <?php /*?>  <td colspan="3"><a style="float:right;" href="?p=archOrder&DelOrd=DeleteRec&id=<?php echo $rw1['id'];?>" class="delete" onclick="return confirm('Do You Want To Makes This Record Archive');"><img src="../images/arch.png" width="20" height="20" border="0">&nbsp;Archive</a></td><?php */?>
	<td colspan="3" align="right" valign="top" style="padding-top:25px;"><a href="?p=archOrder&DelOrd=DeleteRec1&OrdDetID=<?php echo $rw1['id'];?>" class="delete" onclick="return confirm('Do You Want To Delete This Record');"><img src="../images/cross.png" border="0" style="
    height: 27px;
    width: 25px;
">Delete</a>&nbsp;&nbsp;
  </td>  
  </tr>
  <tr>
    <td width="85"><strong>Name:</strong></td>
    <td width="177"><?php echo $rw1['fname'].' '.$rw1['lname'];?></td>
    
    <td width="146"><strong>Email:</strong></td>
    <td width="222"><?php echo $rw1['email'];?></td>
     <td width="186"><strong>City/State</strong></td>
    <td width="85"><?php echo $rw1['city'].'/'.$rw1['state'];?></td>
  </tr>
  <tr>
    <td><strong>Address:</strong></td>
    <td><?php echo $rw1['address1'];?></td>
   
    <td><strong>Phone:</strong></td>
    <td><?php echo $rw1['phone'];?></td>
    <td><strong>Zip Code:</strong></td>
    <td><?php echo $rw1['zip']?></td>
   
  </tr>
  <tr>
    
   
    <td><strong>Choice 1:</strong></td>
   <td class="edit_td"><?php echo $rw1['size']."&nbsp;$".$rw1['Demonination'];?></td>
   <td><strong>Voucher:</strong></td>
<td class="edit_td">
<?php echo $rw1['vocher']; ?>
</td>

<td><strong>Used Voucher Date:</strong></td>
<td><?php $dt=explode('-',$rw1['regDate']); echo $dt[1]."-".$dt[2]."-".$dt[0]; ?></td>
  </tr>
  
  
 
  
  
  
  
  
  <?php } ?>
</table>
  


    <!--<td colspan="2"><a href='admin/manage/archOrder/Orders_xls.php'>To Export  As Excel Click here</a></td>
--> 

<?php }else{?><div style="margin-left: 215px;">
  <H2>Right Now, You Have No New Orders</H2></div><?php }?>