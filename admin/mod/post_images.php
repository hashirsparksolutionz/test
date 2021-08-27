<?php


	require_once('../../includes/myconn.php');

	//////////////////////////////////Update Insert Default Domain Start////////////////////////////////////////////////////////////////////
		if($_REQUEST['pr_id']){
		
		 $id 		= $_REQUEST['pr_id'];
			
		    $q=i_query($con, "SELECT * FROM `products_pages` WHERE `id`='".$id."'") or mysqli_error($con);
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

		if(mysqli_query($con, "UPDATE `products_pages` SET `image`='".$images_array."' WHERE `id`='".$id."'")){	//echo $q;
			echo 1;
		}else{
			
			
			echo 0;
			
			}
		}
		
	?>