<?php
 require_once('../../../includes/myconn.php');

$now=date('m-d-Y');

$filename = "Orders_".$now;
//$columns='Employee Number,Last Name,First Name,Company Name,Email Address,Position,Date,Item description,Quantity,Point Price,Website,Redeemed';
//$sql = mysqli_query($con, "SELECT o.*,od.*,u.*,cp.*,ur.* FROM `orders` o, `order_detail` od, `products` u, `capXlsx` cp , `userinfo` ur  WHERE o.id = od.order_id AND u.id = od.prd_id AND ur.vocher=o.certificate AND cp.certificate=o.certificate ORDER BY o.id DESC");
//$sql = mysqli_query($con, "SELECT o.*,cp.*,ur.* FROM `orders` o, `order_detail` od, `products` u, `capXlsx` cp , `userinfo` ur  WHERE   ur.vocher=o.certificate AND cp.certificate=o.certificate ORDER BY o.id DESC");
$sql=mysqli_query($con, "select * from orders where pendig=0 OR pendig=1 ORDER BY id DESC");
if($sql){
$file_ending = "xls";

//header info for browser
@header("Content-Type: application/xls");    
@header("Content-Disposition: attachment; filename=$filename.xls");  
@header("Pragma: no-cache"); 
@header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
//$schema_insert1 = 'Name'.$sep.'Address'.$sep.'City'.$sep.'State'.$sep.'Zip'.$sep.'Email'.$sep.'Product Name'.$sep.'Quantity'.$sep.'CMC-number'.$sep.'Model-number'.$sep.'Price'.$sep.'Redeemed'.$sep.'Date';
$schema_insert1= 'Vouchers'.$sep.'Job Number'.$sep.'First Name'.$sep.'Last Name'.$sep.'Address 1'.$sep.'Address 2'.$sep.'City'.$sep.'State'.$sep.'Zip'.$sep.'Phone'.$sep.' Email'.$sep.'Product Name'.$sep.'Choice 1'.$sep.'Choice 2'.$sep.'Amount'.$sep.'Redemption Date';
//end of printing column names  
//start while loop to get data
 echo $schema_insert1;
 print("\n"); 
    while($rw = mysqli_fetch_array($sql))
    {
		$pd_name="";
		$query2="select * from order_detail where order_id='".$rw['id']."'";
		$order_detail=mysqli_query($con, $query2);
		$query3="select * from capXlsx where certificate='".$rw['certificate']."'";
		$job1=mysqli_query($con, $query3);
		$job=mysqli_fetch_array($job1);
		
		$query1= mysqli_query($con, "select * from userinfo where vocher='".$rw['certificate']."'");
		$rw1=mysqli_fetch_array($query1);
		
		while($order_detail_row=mysqli_fetch_assoc($order_detail)){
		$product_query=mysqli_query($con, "select * from `products`  where id='".$order_detail_row['prd_id']."'");
		$product_row=mysqli_fetch_array($product_query);	
		 $pd_name =mysqli_real_escape_string($con, $order_detail_row['prd_name']);
		}
			
			
			
			
		
		//$query2="select * from order_detail where order_id='".$rw['id']."'";
		
		//$order_detail=mysqli_query($con, $query2);
		//while($order_detail_row=mysqli_fetch_assoc($order_detail)){
			//$product_query=mysqli_query($con, "select * from `products`  where id='".$order_detail_row['prd_id']."'");
			//$product_row=mysqli_fetch_array($product_query);
		$schema_insert=$rw['certificate'].$sep;
		$schema_insert.=$job['job'].$sep;
		$schema_insert.=$rw1['fname'].$sep;
		$schema_insert.=$rw1['lname'].$sep;
		$schema_insert.=$rw1['address1'].$sep;
		$schema_insert.=$rw1['address2'].$sep;
		
		//$TransDate = explode('-',$rw['order_date']); $orderDate = $TransDate[1].'-'.$TransDate[2].'-'.$TransDate[0];
		//$schema_insert.=$orderDate."".$sep;
		
		$schema_insert.=$rw1['city'].$sep;
		$schema_insert.=$rw1['state'].$sep;
		
		$schema_insert.=$rw1['zip'].$sep;
		$schema_insert.=$rw1['phone'].$sep;
		
		$schema_insert.=$rw1['email'].$sep;
		$schema_insert.=$pd_name."".$sep;
		
		//$Redempted = $rw['PointCount']*$rw['quantity'];
		//$schema_insert.=$Redempted."".$sep;
		$schema_insert.=$rw1['size'].$sep;
		$schema_insert.=$rw1['color'].$sep;
		$schema_insert.=$rw['total_points'].$sep;
		$schema_insert.=$rw['order_date'].$sep;
		
        //$schema_insert = "";
		//$str1=str_replace(',','',$rw1['EmployeeNumber']).','.str_replace(',','',$rw1['fname']).','.str_replace(',','',$rw1['lname']).','.str_replace(',','',$rw1['address1']).','.str_replace(',','',$rw1['company']).','.$rw1['email'].','.str_replace(',','',$rw1['position']).','.str_replace(',','',$orderDate).','.str_replace(',','',$check['prd_name']).','.$check['quantity'].','.$product_row1['cmc_number'].','.$product_row1['model_number'].','.$product_row1['PointCount'].','.str_replace(',','',$web).','.str_replace(',','',$Redempted);
		 //$schema_insert = $emp."".$sep."".$fname."".$sep."".$lname."".$sep;
      // $schema_insert = $point."".$sep;
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    } 
}

//}
	else{
mysqli_error($con, $sql);	
}  



  
  ?>