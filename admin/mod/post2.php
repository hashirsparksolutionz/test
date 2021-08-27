<?php
        require_once('../../includes/myconn.php');
		if(isset($_REQUEST['ids']))
		{
		$id 		= $_REQUEST['ids'];
		
		$query_def 	= mysqli_query($con, "select * from orders where `id`='".$id."'");
		$update = mysqli_fetch_assoc($query_def);
		if(mysqli_query($con, "UPDATE `orders` SET `pendig`='3' WHERE `id`='".$id."'"))
		{	
			   echo "1";
		}
			
		}
		else if(isset($_REQUEST['id_delivery']))
		{
		$id 		= $_REQUEST['id_delivery'];
		
		$query_def 	= mysqli_query($con, "select * from orders where `id`='".$id."'");
		$update = mysqli_fetch_assoc($query_def);
		if(mysqli_query($con, "UPDATE `orders` SET `pendig`='2' WHERE `id`='".$id."'"))
		{	
			   echo "1";
		}
				
			
		}
		else if(isset($_GET['id_send']))
		{
		$message="";
		$admin_message="";	
		$id 		    = $_REQUEST['id_send'];
		$query_def   	= mysqli_query($con, "select * from orders where `id`='".$id."'");
		$update         = mysqli_fetch_assoc($query_def);
		$query_order   	= mysqli_query($con, "select * from order_detail where `order_id`='".$id."'");
		$order_detail   = mysqli_fetch_assoc($query_order);
		$query_mail 	= mysqli_query($con, "select * from members where `id`='".$update['user_id']."'");
		$mail           = mysqli_fetch_assoc($query_mail);
		$query_admin 	= mysqli_query($con, "select * from users where `id`='1'");
		$mail_admin     = mysqli_fetch_assoc($query_admin);
		$admin          = $mail_admin['email'];
		$reciver        = $mail['email'];
		$subject        = "You are going to recive shipment";
        $message       .= "Thank you for your order. Once the point amount is confirmed this order will be released.Your shipment has been ordered please allow up to 3 weeks for delivery."."\n";
		$message       .="Below is the following Information"."\n";
		$message       .="Order Id=".$update['id']."\n";
		$message       .="Order Date=".$update['order_date']."\n";
		$message       .="Ponits=".$update['total_points']."\n";
		$message       .="Product Name=".$order_detail['prd_name']."\n";
		$message       .="Product Quantity=".$order_detail['quantity']."\n";
		//$message       .="Ponits=".$update['total_points']."<br/>";
		mail($reciver, $subject, $message,"From:".$admin);
		$admin_message.="Person Information"."\n";
		$admin_message.="First Name =".$mail['fname']."\n";
		$admin_message.="Last Name =".$mail['lname']."\n";
		$admin_message.="Address1 =".$mail['address1']."\n";
		if(empty($mail['address2']))
		{
			$ad="not given";
		}
		else
		{
			$ad=$mail['address2'];
		}
		$admin_message.="Address2 =".  $ad."\n";
		$admin_message.="State =  ".$mail['state']."\n";
		$admin_message.="City =  ".$mail['city']."\n";
		$admin_message.="Zip =  ".$mail['zip']."\n";
		$admin_message.="Email =  ".$mail['email']."\n";
		$admin_message.="Point Program Username =  ".$mail['username']."\n"."\n";
		$admin_message.="Product Information"."\n";
		$admin_message.="Product Name =  ".$order_detail['prd_name']."\n";
		$admin_message.="Product Quantity =  ".$order_detail['quantity']."\n"."\n";
		$admin_message.="Order Information"."\n";
		$admin_message.="Order Id =  ".$update['id']."\n";
		$admin_message.="Order Date =  ".$update['order_date']."\n";
		mail($admin,"Order Sent",$admin_message,"Capitol Marketing Concepts");
		if(mysqli_query($con, "UPDATE `orders` SET `pendig`='3' WHERE `id`='".$id."'"))
		{	
			   echo "1";
		}
				
			
		}
		else if(isset($_REQUEST['id_awaiting']))
		{
		$id 		= $_REQUEST['id_awaiting'];
		
		$query_def 	= mysqli_query($con, "select * from orders where `id`='".$id."'");
		$update = mysqli_fetch_assoc($query_def);
		if(mysqli_query($con, "UPDATE `orders` SET `pendig`='1' WHERE `id`='".$id."'"))
		{	
			   echo "1";
		}
				
			
		}
		else if(isset($_REQUEST['id_release']))
		{
		$id 		= $_REQUEST['id_release'];
		
		$query_def 	= mysqli_query($con, "select * from orders where `id`='".$id."'");
		$update = mysqli_fetch_assoc($query_def);
		
		
		if(mysqli_query($con, "UPDATE `orders` SET `pendig`='2' WHERE `id`='".$id."'"))
		{	
		       
			   echo "1";
		}
		}
		else if(isset($_REQUEST['id']))
		{
		$id 		= $_REQUEST['id'];
		$query_def 	= mysqli_query($con, "select * from orders where `id`='".$id."'");
		$update = mysqli_fetch_assoc($query_def);
		if($update['pendig']=='0'){
		$r = "UPDATE `orders` SET `pendig`='1' WHERE `id`='".$id."'";
		if(mysqli_query($con, "UPDATE `orders` SET `pendig`='1' WHERE `id`='".$id."'")){	//echo $q;
			echo 1;
		}
		
		}else if($update['pendig']=='1'){			
			//$r = "UPDATE `orders` SET `pendig`='0' WHERE `id`='".$id."'";
		if(mysqli_query($con, "UPDATE `orders` SET `pendig`='0' WHERE `id`='".$id."'")){	//echo $q;
			echo 0;
		}
		}
		}
?>