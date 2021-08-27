
<script type="text/javascript" language="javascript">
window.location.href = window.location.hostname;
</script>
<?php  }
//echo $_SESSION['abc'];
//print_r($_POST);
include_once("Authpayment.class.php");

$pay =  new authorize_gateway();

// SET AUTHORIZE.NET VALUES HERE
$pay->gateway_api_login_test='84H3xcUs3';
$pay->gateway_api_key_test='6Z8XD37kj4q6PvCp';
 
//$pay->gateway_api_login_live='23Uw6ZW2z9';
//$pay->gateway_api_key_live='9qbDcU62k293W3Dn';

$pay->test_mode = "Y";

$Response = $pay->process_now();
//echo $Response; 

$TransChk = explode('Payment / Authorization Successful', $Response);

if($TransChk[0]!='')
{
	echo $Response;
 }
else if($TransChk[1]!=''){
//UPDATE  `cmattox_capitolmarketingdeals`.`userinfo` SET  `check` =  '1' WHERE  `userinfo`.`id` =85;
//echo "UPDATE  `userinfo` SET  `check` =  '1' WHERE  `id` ='".$_SESSION['userid']."'";
$id  = session_id();
//$id	=	$_SESSION['userid'];
$idi = $_SESSION['xyz'];
$sql = mysqli_query($con, "select * from userinfo where vocher='".$idi."'");
$row = mysqli_fetch_array($sql);

$UsersPoints	 = mysqli_query($con, "select * from userinfo where id='".$_SESSION['userid']."'");
$UsersPointsrow  = mysqli_fetch_assoc($UsersPoints);

$firstName 	= 	$UsersPointsrow['fname'];
$lastName  	= 	$UsersPointsrow['lname'];
$street	   	= 	$UsersPointsrow['address1'].' & '.$UsersPointsrow['address2'];
$state 	 	= 	$UsersPointsrow['state'];
$city 	 	= 	$UsersPointsrow['city'];
$zip 		= 	$UsersPointsrow['zip'];
$email	 	= 	$UsersPointsrow['email'];

$date  		= date("Y-m-d H:i:s");

$_SESSION['FINALPOINTS'] = $FinalPOints = $userpoints-$_SESSION['SUBTOTAL'];

$cartquery1 		= 	mysqli_query($con, "select * from cart where session_id='".session_id()."'");
$TotalCartItems		=  	mysqli_num_rows($cartquery1);

if($TotalCartItems != '0'){
	mysqli_query($con, "INSERT INTO `orders` SET `user_id`='".$row['id']."',`order_date`='$date',`total_points`='".$_SESSION['TOTAL']."', certificate = '".$_SESSION['xyz']."',`shipchk`='1'"); 
	$_SESSION['ORDERID'] = $order_id = mysqli_insert_id($con);
//echo "INSERT INTO `orders` SET `user_id`='".$row['id']."',`order_date`='$date',`total_points`='".$_SESSION['SUBTOTAL']."',`shipchk`='1'";
	}else{
		
	mysqli_query($con, "INSERT INTO `orders` SET `user_id`='".$row['id']."',`order_date`='$date',`total_points`='".$_SESSION['abc']."',certificate = '".$_SESSION['xyz']."',`shipchk`='0'");
	$_SESSION['ORDERID'] = $order_id = mysqli_insert_id($con);
//echo "INSERT INTO `orders` SET `user_id`='".$row['id']."',`order_date`='$date',`total_points`='".$_SESSION['abc']."',`shipchk`='0'";	
	}
	
while($row 			=  	mysqli_fetch_assoc($cartquery1)){
	$order_id 		= 	$order_id;
	//$prd_id 		= 	;
	$productsQuery 	= 	mysqli_query($con, "select * from products where id='".$row['prd_id']."'");
	$prdrow 		=  	mysqli_fetch_assoc($productsQuery);
	$item_name 		= 	$prdrow['name'];
	$quantity 		= 	$row['quantity'];
	
	//echo "INSERT INTO `order_detail` SET `order_id`='$order_id',`prd_id`='".$prdrow['id']."',`prd_name`='$item_name',`quantity`='$quantity'";
	mysqli_query($con, "INSERT INTO `order_detail` SET `order_id`='$order_id',`prd_id`='".$prdrow['id']."',`prd_name`='$item_name',`quantity`='$quantity'");
	 }  
	//mysqli_query($con, "DELETE FROM cart where session_id = '".session_id()."'");   
	
$UsersPoints	 = mysqli_query($con, "SELECT * FROM `userinfo` WHERE `id` ='".$_SESSION['userid']."'");
$UsersPointsrow  = mysqli_fetch_assoc($UsersPoints);

$UfirstName = $UsersPointsrow['fname'];
$UlastName  = $UsersPointsrow['lname'];
$Ustreet	= $UsersPointsrow['address1'];
if($UsersPointsrow['address2']!=''){
$Ustreet	.= ' & '.$UsersPointsrow['address2'];
}
$Ustate 	= $UsersPointsrow['state'];
$Ucity 	 	= $UsersPointsrow['city'];
$Uzip 		= $UsersPointsrow['zip'];
$Uphone  	= $UsersPointsrow['phone'];
$Uemail	 	= $UsersPointsrow['email'];
$product	= $UsersPointsrow['product'];
$size		= $UsersPointsrow['size'];
$color		= $UsersPointsrow['color'];

mysqli_query($con, "UPDATE `userinfo` SET `check` =  '1' WHERE `id` ='".$_SESSION['userid']."'");
$query_Recordset1 = mysqli_query($con, "SELECT * FROM users where id = 1");
$email			  =	mysqli_fetch_array($query_Recordset1);
$Email			  = $email['email'];
$to      		  = $Email; 
$headers 		  = "From: Capitol Marketing Concepts <sales@capitolmarketingdeals.com>".PHP_EOL;
$headers         .= "MIME-Version: 1.0".PHP_EOL;
$headers         .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
$subject 		  = 'Order Information'; 
$Custsubject	  = 'New Order Information';

$AdminBody = "<table width='100%' border='0' height='20' cellpadding='0' cellspacing='0'> 
<tbody>
	<tr>
		<td style='padding-left:10px; padding-top:4px;'></td>
	</tr>
	<tr>
		<td style='padding:10px;'><table width='100%'>
<tbody>
	<tr>
		<td style='padding:7px;'><div>
A new order has been placed by the following person. Here is the information of the User.<br />
First Name: ".$UfirstName."<br />
Last Name: ".$UlastName."<br />
Address: ".$Ustreet."<br />
State: ".$Ustate."<br />
City: ".$Ucity."<br />
Zip: ".$Uzip."<br />
Please Go in the admin side to review this Order. 
Thank you.<br />
</div>
	</td>
		</tr>
			</tbody>
</table>
	</td>
		</tr>
			</tbody>
</table>";
  
mail($to, $subject, $AdminBody, $headers);


$rslt = mysqli_query($con, "select * from orders where id = '".$_SESSION['ORDERID']."'");
$body = '<strong>Dear '.$UfirstName.' '.$UlastName.',</strong><br /><br />';
$body .= '<strong>You Have Placed New Order In Capitol Marketing Deals With The Following Information.</strong><br /><br />';
$body .= '<table width="100%" border="0">';
$body .= '<tr>
    <td align="center"><div align="center"><h2><strong>Orders</strong></h2></div></td>
  </tr>';
$counter ='1';
$p_name="";
while($rw=mysqli_fetch_assoc($rslt))
{ 
$info['order_date']=$rw['order_date'];
$info['total_points']=$rw['total_points'];
$info['pendig']=$rw['pendig'];
$info['shipchk']=$rw['shipchk'];
////////////////////////// Uers Qry///////////////////
$query1= mysqli_query($con, "select * from userinfo where id='".$_SESSION['userid']."'");
$rw1=mysqli_fetch_array($query1);
$info['fname']=$rw1['fname'];
$info['vocher']=$rw1['vocher'];
$info['product']=$rw1['product'];
$info['size']=$rw1['size'];
$info['color']=$rw1['color'];
$info['cell']=$rw1['cell'];
$info['Upoints']=$rw1['points'];

$body .= '<tr>
    <td><table>
  <tr>
    <td colspan="6"><h2><strong>Order Detail:</strong></h2></td>
  </tr>
  <tr>
    <td width="85"><strong>Order Date:</strong></td>
    <td width="71">'.$rw['order_date'].'</td>
    <td width="92"><strong>Total Price:</strong></td>
    <td width="82">$ '.$rw['total_points'].'</td>
  </tr>
  <tr>
    <td colspan="6"><h2><strong>Option Selected:</strong></h2></td>
  </tr>
  <tr> 	
    <td width="87"><strong>Option 1:</strong></td>
    <td width="169">'.$product.'</td>';
	if($UsersPointsrow['size']!=''){
$body .='<td width="87"><strong>Option 2:</strong></td>';
$body .='<td width="169">'.$size.'</td>';
	}if($UsersPointsrow['color']!=''){
$body .='<td width="87"><strong>Option 3:</strong></td>';
$body .='<td width="169">'.$color.'</td>';
	}
$body .='</tr>';
 if($rw['shipchk']=="1"){
  $body .= '<tr>
    <td colspan="6"><h2><strong>Product Detail:</strong></h2></td>
  </tr>
  <tr>
    <td height="38"><strong>Product Sr#</strong>:</td>
	<td><strong>Product Name</strong>:</td>
    <td><strong></strong></td>
    <td><strong>Quantity:</strong></td>
    <td><strong>Total Product Price:</strong></td>
    <td><strong>Product Image:</strong></td>
    </tr>
  <tr>';
$P_counter='1';
$query2="select * from order_detail where order_id='".$rw['id']."'";
$order_detail=mysqli_query($con, $query2);
while($order_detail_row=mysqli_fetch_assoc($order_detail))
{
$info['prd_name']=$order_detail_row['prd_name'];
$info['prd_id']=$order_detail_row['prd_id'];
$info['quantity']=$order_detail_row['quantity'];
$product_query=mysqli_query($con, "select * from `products` where id='".$order_detail_row['prd_id']."'");
$product_row=mysqli_fetch_array($product_query);
$info['image']=$product_row['image'];
$info['ppoints']=$product_row['points'];
$img   =   explode('@',$product_row['image']);

    $body .= '<td height="38">'.$P_counter++.'</td>
    <td>'.$order_detail_row['prd_name'].'</td>
    <td></td>
    <td>'.$order_detail_row['quantity'].'</td>
    <td>$ '.$product_row['points'].' x '.$order_detail_row['quantity'].' = $'.$product_row['points']*$order_detail_row['quantity'].'</td>';
    $body .= '<td><img src="http://'.$_SERVER['HTTP_HOST'].'/images/'.$img[0].'" width="150" height="150" /></td>
  </tr>';
   } 
 }
$body .= '</table></td>';
 } 
$body .= '</table>';

mail($Uemail, $Custsubject, $body, $headers);


$To      		  = $Uemail; 
$headers 		  = "From: Capitol Marketing Concepts <sales@capitolmarketingdeals.com>".PHP_EOL;
$headers         .= "MIME-Version: 1.0".PHP_EOL;
$headers         .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
$Ordersubject	  = 'Client Order Information'; 

$OrderBody = "<table width='100%' border='0' height='20' cellpadding='0' cellspacing='0'> 
<tbody>
	<tr>
		<td style='padding-left:10px; padding-top:4px;'></td>
	</tr>
	<tr>
		<td style='padding:10px;'><table width='100%'>
<tbody>
	<tr>
		<td style='padding:7px;'><div>
Thank you for completing your Deal with ".$_SESSION['compName']." and Capitol Marketing Concepts DBA Capitol Marketing Deals.
This is the information you filled out on our website. Your order will arrive in 3-4 weeks.<br />

First Name: ".$UfirstName."<br />
Last Name: ".$UlastName."<br />
Address : ".$Ustreet."<br />
State: ".$Ustate."<br />
City: ".$Ucity."<br />
Zip: ".$Uzip."<br />
Phone: ".$Uphone."<br />
Email: ".$Uemail."<br />";
if($UsersPointsrow['choice01']!=''){
$OrderBody .= "Option:1 :- ".$UsersPointsrow['choice01']."<br />";
}
if($size!=''){
$OrderBody .= "Option:2 :- ".$size."<br />";
}
if($color!=''){
$OrderBody .= "Option:3 :- ".$color."<br />";
}
$OrderBody .= "<br />
</div>
	</td>
		</tr>
			</tbody>
</table>
	</td>
		</tr>
			</tbody>
</table>";
  
mail($To, $Ordersubject, $OrderBody, $headers);
mysqli_query($con, "UPDATE orders SET chk = '1' WHERE certificate = '".$_SESSION['xyz']."'");
mysqli_query($con, "UPDATE capXlsx SET status = '1' WHERE certificate = '".$_SESSION['xyz']."'");
mysqli_query($con, "DELETE FROM cart where session_id = '".session_id()."'");
?>
<script type="text/javascript" language="javascript">
//alert('sdsds');
window.location.href = "?p=Thankyou";
</script>
<?php } ?>