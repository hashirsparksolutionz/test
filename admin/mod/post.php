<?php


	require_once('../../includes/myconn.php');

	//////////////////////////////////Update Insert Default Domain Start////////////////////////////////////////////////////////////////////
		if(isset($_REQUEST['id'])){
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
		}else if($_REQUEST['pr_id']){
		
		 $id 		= $_REQUEST['pr_id'];
			
		    $q=mysqli_query($con, "SELECT * FROM `products` WHERE `id`='".$id."'") or mysqli_error($con );
			$r=mysqli_fetch_array($q);
			$update_img= array();
		    $images = explode('@',html_entity_decode($r['image']));
		
		
		$yes=""; 
		for($y=0;$y<count($images);$y++)
		{
			/*if($images[$y] != $_REQUEST['pic'])
			{
				$yes.=$images[$y]."@";
					
			}*/
			if($images[$y] != $_REQUEST['pic'])
			array_push($update_img,$images[$y]);
			
			
		}
		
		//$yes1=rtrim($yes, '@');
		//Asubstr_replace($yes ,"",-1);
		//print_r($yes1);
		//exit;
		$images_array= implode('@',$update_img);

		if(mysqli_query($con, "UPDATE `products` SET `image`='".$images_array."' WHERE `id`='".$id."'")){	//echo $q;
			echo 1;
		}else{
			
			
			echo 0;
			
			}
		}
		
	?>