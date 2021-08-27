<?php
	
	require_once('../../includes/myconn.php');
if(isset($_REQUEST['id'])){	
		$id	 	= $_REQUEST['id'];
		$emailChk	= $_REQUEST['emailChk'];
		$feat=mysqli_query($con, "SELECT * FROM `web_info` WHERE `id` = '".$id."'");
		$fetch_fest=mysqli_fetch_array($feat);
		if($fetch_fest['mail']=='1'){
			$emailChk1=0;
		}
		else{
			$emailChk1=1;
			
		}
	
		
		$q = "UPDATE `web_info` SET `mail`= '".$emailChk1."' WHERE `id` = '".$id."'";
			if(mysqli_query($con, $q)){	//echo $q;
			echo 1;

 }else{
		echo mysqli_error($con);
		echo 0; // invalid code
	
	}
		}
		
//}

	?>