<?php
 require_once('../../../includes/myconn.php');

$now=date('m-d-Y');
$fileInfo=mysqli_query($con, "select * from web_info");
$webinfo=mysqli_fetch_array($fileInfo);
$name=$webinfo['name'];
$email=$webinfo['email'];

$filename = $name." Orders-".$now;

$sql=mysqli_query($con, "select * from `userinfo` WHERE `archive`='0' and s_check='1' ORDER BY id DESC");
if($sql){
$file_ending = "xls";

//header info for browser
@header("Content-Type: application/xls");    
@header("Content-Disposition: attachment; filename=$filename.xls");  
@header("Pragma: no-cache"); 
@header("Expires: 0");

$sep = "\t"; //tabbed character
$schema_insert1= 'Company Name'.$sep.'Job #'.$sep.'Voucher Number'.$sep.'Cert #'.$sep.'Concatenated'.$sep.'Amount'.$sep.'Shipped'.$sep.'Received'.$sep.'Fulfilled'.$sep.'Created On'.$sep.'Redemption Period Begin'.$sep.'Redemption Period End'.$sep.'Redemption Date'.$sep.'Status'.$sep.'Certificate Status'.$sep.'Customer (Order)'.$sep.'Exported'.$sep.'First'.$sep.'Last'.$sep.'Address'.$sep.'City'.$sep.'State'.$sep.'Zip'.$sep.'Phone Number'.$sep.'Email'.$sep.'Demonination'.$sep.'Invoice Number'.$sep.'Choice1'.$sep.'Choice2'.$sep.'Choice3'.$sep.'Choice4'.$sep.'Choice5'.$sep.'Choice6'.$sep.'Choice7'.$sep.'Choice8'.$sep;

//$schema_insert1= 'First Name'.$sep.'Last Name'.$sep.'Address'.$sep.'City'.$sep.'State'.$sep.'Zip'.$sep.'Phone'.$sep.' Email'.$sep.'Choice 1'.$sep.'Certificate'.$sep.'Job'.$sep.'Company'.$sep.'Redemption Date';
//end of printing column names  
//start while loop to get data
 echo $schema_insert1;
 print("\n"); 
    while($row = mysqli_fetch_array($sql))
    {
	
			
		$Recordset2 = mysqli_query($con, "select * from capXlsx where certificate='".$row['vocher']."'");
			$cat_fetch_row = mysqli_fetch_array($Recordset2);
			 $exprydate = $cat_fetch_row['expiration'];
		  if($exprydate!=''){
		  	  $exdate=explode('-',$exprydate);
		  $date=$exdate['2']."-".$exdate['0']."-".$exdate['1'];
		  //echo $date."<br/>";
		  //echo date("Y-m-d");
		  
		   
		   $days = (strtotime($date) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);;
		   
		//echo $days;
		 //exit();
			 if($days<0){
			 $ex1 =1;
		 }else{
			  $ex1 =0;
		 }
		  }
  if($ex1==1)
  {
	  $st1='Expired';
         
          
  
  }
 else if($cat_fetch_row['status']==0){

	  $st1='Assigned';
	 
	  }
	   else if($cat_fetch_row['status']==1){

	  $st1='Used';
	 
	  }
	   else if($cat_fetch_row['status']==2){

	  $st1='Unassigned';
	 
	  }
	  	
		
		
		$schema_insert = $cat_fetch_row['cname'].$sep;
		$schema_insert .= $row['jobnumber']."".$sep;
		$schema_insert .= $cat_fetch_row['voucherNumber']."".$sep;
		$schema_insert.= $cat_fetch_row['certificate']."".$sep;
		$schema_insert.= $cat_fetch_row['concatenated']."".$sep;
		$schema_insert.= $cat_fetch_row['amount']."".$sep;
		$schema_insert.= $cat_fetch_row['shipCost']."".$sep;
		$schema_insert.= $cat_fetch_row['received']."".$sep;
		$schema_insert.= $cat_fetch_row['fulfilled']."".$sep;
		$schema_insert.= $row1['createdOn'].$sep;
		$schema_insert.= $row['beginredemption']."".$sep;
		$schema_insert.= $cat_fetch_row['expiration'].$sep;
		$regDate= $row['regDate'];

				  $exdate1=explode('-',$regDate);
		  $regDate1=$exdate1['1']."-".$exdate1['2']."-".$exdate1['0'];
	  	$schema_insert.=  $regDate1.$sep;
	  
	  
	  
			
			
			  if($row['s_check']==0){
		  $exprydate = $row['expiration'];
		  if($exprydate!=''){
		  	  $exdate=explode('-',$exprydate);
		  $date=$exdate['2']."-".$exdate['0']."-".$exdate['1'];
		  //echo $date."<br/>";
		  //echo date("Y-m-d");
		  
		   
		   $days = (strtotime($date) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);;
		   
		//echo $days;
		 //exit();
			 if($days<0){
			 $ex =1;
		 }else{
			  $ex =0;
		 }
		  }
		  }
		  
  if($ex==1)
  {
	
          $st='Expired';
          
  
  }
 else if($row['s_check']==0){
		$st='Valid';
	  
	  }
	  else if($row['s_check']==1){
		$st='Used';
	 
	  }
			
			
			
			
			$schema_insert.= $st.$sep;
			$schema_insert.= $st1.$sep;
		
			
		$schema_insert.= $row['CustomerOrder'].$sep;
		$schema_insert.= $row['Exported'].$sep;
		$schema_insert.= $row['fname'].$sep;
		$schema_insert.= $row['lname'].$sep;
		$schema_insert.= $row['address1'].$sep;
		$schema_insert.= $row['city'].$sep;
		$schema_insert.= $row['state'].$sep;
		$schema_insert.= $row['zip'].$sep;
		$schema_insert.= $row['phone'].$sep;
		$schema_insert.= $row['email'].$sep;
		$schema_insert.= $row['Demonination'].$sep;
		$schema_insert.= $row['InvoiceNumber'].$sep;
	
		
		$schema_insert.= $row['size'].$sep;
		$schema_insert.= $row['color'].$sep;
		
		
        
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