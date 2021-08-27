<?php
        require_once('../../includes/myconn.php');
		$id 		= $_REQUEST['id'];
		
		$query_def 	= mysqli_query($con, "select * from orders where `id`='".$id."'");
		$update = mysqli_fetch_assoc($query_def);
		
		
		if(mysqli_query($con, "UPDATE `orders` SET `pendig`='2' WHERE `id`='".$id."'"))
		{	
		       /*$reciver = $_REQUEST['email'] ;
               $subject = $_REQUEST['subject'] ;
               $message = $_REQUEST['message'] ;
                mail("someone@example.com", $subject,
               $message, "From:" . $email);*/
			   echo "1";
		}
		
		
?>