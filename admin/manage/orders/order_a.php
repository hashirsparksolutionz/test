<script type="text/javascript">

function status_awaiting(id) 
{	
	
	$.post("mod/post2.php?id_awaiting="+id,{
		
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
function status_send(id) 
{	
	
	$.post("mod/post2.php?id_send="+id,{
		
			}, function(response){
			
			//	alert(response);
			if(response==1)
			{
				//$("#release"+id).show();
				$("#lbl"+id).html('shipment sent');
				//$("#lb2"+id).show()	;
				$("#awaiting"+id).hide();
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
<?php //$query="select * from orders";
$rslt=mysqli_query($con, "select * from orders where pendig=2 ORDER BY id DESC");
$totalRecs = mysqli_num_rows($rslt);
$fp = fopen('awaiting.csv', 'w');
$columns = 'First Name,Last Name,Address 1,Address 2,City,State,Zip,Phone, Email,Username,status';
//$columns = 'ID,First Name,Last Name,Username,Address 1,Address 2,City,State,Zip Email,Points';
fputcsv($fp,explode(',',$columns));
if($totalRecs>0){?>

<table width="200" class="table table-striped">
<tr>
    <td colspan="2"><a href='?p=orders_a&download_file=awaiting.csv'>To Export  As CSV Click here</a></td>
  </tr>
<tr>
    <td style="width: 65px;"><h2><strong>No</strong></h2></td>
    <td align="center"><div align="center">
      <h2><strong>Awaiting Orders</strong></h2></div></td>
  </tr>
<?php
$counter =1;
while($rw=mysqli_fetch_assoc($rslt))
{ 
//$info['id']=$rw['id'];
$info['user_id']=$rw['user_id'];
$info['order_date']=$rw['order_date'];
$info['total_points']=$rw['total_points'];
$info['pendig']=$rw['pendig'];
////////////////////////// Uers Qry///////////////////
$query1= mysqli_query($con, "select * from members  where id='".$rw['user_id']."'");
$rw1=mysqli_fetch_array($query1);
$info['fname']=$rw1['fname'];
$info['username']=$rw1['username'];
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
    <td colspan="6"><h2><strong>Profie Details:</strong></h2></td>
  </tr>
  <tr>
    <td width="85"><strong>Name:</strong></td>
    <td width="71"><?php echo $rw1['fname'].' '.$rw1['lname'];?></td>
    <td width="92"><strong>Username:</strong></td>
    <td width="82"><?php echo $rw1['username'];?></td>
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
    <td><strong>Price:</strong></td>
    <td><?php echo $rw1['points'];?></td>
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
    <td><strong>Order Status:</strong></td>
    <td>
	<?php 
	if($rw['pendig'] == '2')
	{ 
	     ?>
         <label id="lbl<?php echo $rw['id'];?>">
         <input type="button" onclick="status_send('<?php echo $rw['id'];?>')" name="send<?php echo         $rw['id'];?>" id="send<?php echo $rw['id'];?>" value="send shipment" />
         </label>
       
         <label id="lb2<?php echo $rw['id'];?>">
          <input type="button" onclick="status_awaiting('<?php echo $rw['id'];?>')" name="awaiting<?php echo         $rw['id'];?>" id="awaiting<?php echo $rw['id'];?>" value="Put to awaiting" />
         </label>
           <script type="text/javascript"> 
	
        </script>
		 <?php
		  
	}
    else
	{ 
		echo "Delivered Shipment ";
		?>
        
        <?php
		
		
		             
	}
	    ?>
		<?php 
		/*if($rw['pendig'] == '0' || $rw['pendig'] == '2')
		{
		?>
		<script type="text/javascript">
		 $("#release<?php echo $rw['id'];?>").hide();
         </script>
		 <?php 
		 }*/
		 ?>
        <?php 
		if($rw['pendig'] == '3')
		{
		?>
		<script type="text/javascript"> 
		$("#send<?php echo $rw['id'];?>").hide();
        </script>
       
		<?php
		 }
		 ?>
        </td>
  </tr>
  <tr>
    <td colspan="6"><h2><strong>Product Detail:</strong></h2></td>
  </tr>
  
  <tr>
    <td height="38"><strong>Product Sr#</strong>:</td><td><strong>Product Name</strong>:</td>
    <td><strong>Product Name</strong>:</td>
    <td><strong>Quantity:</strong></td>
    <td><strong>Total Product Points:</strong></td>
    <td><strong>Product Image:</strong></td>
    </tr>
  <tr>
<?php 
$P_counter=1;
$query2="select * from order_detail where order_id='".$rw['id']."'";
$order_detail=mysqli_query($con, $query2);
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
?>


    <td height="38"><?php echo $P_counter++;?></td>
    <td><?php echo $order_detail_row['prd_name'];?></td>
    <td></td>
    <td><?php echo $order_detail_row['quantity'];?></td>
    <td><?php echo $product_row['points'].' x '.$order_detail_row['quantity'].' = '.$product_row['points']*$order_detail_row['quantity'];?></td>
    <td><img src="../images/<?php echo $product_row['image']?>"; width='150' height="150" /></td>
  </tr>
  <?php } ?>
</table></td>
  
 <?php 
 if($_GET['download_file'])
{
	$str1=$rw1['fname'].','.$rw1['lname'].','.$rw1['address1'].','.$rw1['address2'].','.$rw1['city'].','.$rw1['city'].','.$rw1['state'].','.$rw1['zip'].','.$rw1['phone'].','.$rw1['email'].','.$rw1['username'].','.$var;
	
		 
//$str=$info['id'].','.$rw1['fname'].','.$rw1['lname'].','.$rw1['username'].','.$rw1['address1'].','.$rw1['address2'].','.$rw1['city'].','.$rw1['state'].','.$rw1['zip'].','.$rw1['phone'].','.$rw1['city'].','.$rw1['email'].','.$rw1['points'];
fputcsv($fp,explode(',',$str1));

?>

<script type="text/javascript">
  //window.location.href = 'Waiting List.csv';
  window.open('awaiting.csv','_parent');
  setTimeout(fun,1000);
  function fun(){
  window.location.href = '?p=orders_a';
  }
</script>
<?php

}
 
 
 
 } ?>
 <tr>
    <td colspan="2"><a href='?p=orders_a&download_file=awaiting.csv'>To Export  As CSV Click here</a></td>
  </tr>
</table>

<?php }else{?><div style="margin-left: 215px;"><H2>Right Now, You Have No New Awating Orders</H2></div><?php }?>
