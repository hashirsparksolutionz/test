<?php
require_once('../../includes/myconn.php');
$fileInfo=mysqli_query($con, "select * from web_info");
$webinfo=mysqli_fetch_array($fileInfo);
$name=$webinfo['name'];
$email=$webinfo['email'];
	
$filename = $name." Assigned Cerificates";


//$sql= mysqli_query($con, "SELECT o.*,gen.* FROM `orders` o,`genvoucher` gen WHERE o.cat = 'Merchandise' AND o.certificate = gen.certificate ORDER BY o.id DESC");
$sql = mysqli_query($con, "select * from capXlsx where status='0' ORDER BY id DESC");
//$sql=mysqli_query($con, "SELECT * FROM `orders` where `cat`='Merchandise';");
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
/*for ($i = 0; $i < mysqli_num_fields($sql); $i++) {
echo mysqli_field_name($sql,$i) . "\t";
}
print("\n"); */
//end of printing column names  
//start while loop to get data
 $schema_insert1 = "Company Name".$sep."Job #".$sep."Voucher Number".$sep."Cert #".$sep."Concatenated".$sep."Amount".$sep."Shipped".$sep."Received".$sep."Fulfilled".$sep."Created On".$sep."Redemption Period Begin".$sep."Redemption Period End".$sep."Status".$sep."Certificate Status".$sep."Customer (Order)".$sep."Exported".$sep."First ".$sep."Last".$sep."Address".$sep."Address 2".$sep."City".$sep."State".$sep."Zip".$sep."Phone Number".$sep."Email".$sep."Demonination".$sep."Invoice Number".$sep."Trip 1".$sep."Trip 2".$sep."Trip 3".$sep."Trip 4";
 echo $schema_insert1;
 print("\n"); 
    while($row = mysqli_fetch_array($sql))
    {
		
		$Recordset2 = mysqli_query($con, "select * from userinfo where vocher='".$row['certificate']."'");
		
		$row1=mysqli_fetch_array($Recordset2);
		
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

	  
	  
	  			  if($row1['s_check']==0){
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
	  else if($cat_fetch_row['s_check']==1){
		$st='Used';
	 
	  }
		
		
		
		
		
		
		
		
		
		
		
		$schema_insert = $row['cname'].$sep;
		$schema_insert .= $row['job']."".$sep;
		$schema_insert .= $row['voucherNumber']."".$sep;
		$schema_insert .= $row['certificate']."".$sep;
		$schema_insert .= $row['concatenated']."".$sep;
		$schema_insert .= $row['amount']."".$sep;
		$schema_insert .= $row['shipCost']."".$sep;
		$schema_insert .= $row['received']."".$sep;
		$schema_insert .= $row['fulfilled']."".$sep;
		$schema_insert .= $row1['createdOn'].$sep;
		$schema_insert .= $row['beginredemption']."".$sep;
		$schema_insert .= $row['expiration'].$sep;
		
		$schema_insert .= $st."".$sep;
		$schema_insert .= $st1.$sep;
		$schema_insert .= $row1['CustomerOrder']."".$sep;
		$schema_insert .= $row1['Exported']."".$sep;
		
		$schema_insert .= $row['first']."".$sep;
		$schema_insert .= $row['last']."".$sep;
		$schema_insert .= $row1['address1']."".$sep;
		$schema_insert .= $row['address2']."".$sep;
		$schema_insert .= $row1['city']."".$sep;
		$schema_insert .= $row1['state']."".$sep;
		$schema_insert .= $row1['zip']."".$sep;
		$schema_insert .= $row1['phone']."".$sep;
		$schema_insert .= $row1['email']."".$sep;
		
		$schema_insert .= $row['choice01']."".$sep;
		$schema_insert .= $row1['InvoiceNumber']."".$sep;


		$schema_insert .= $row['choice02']."".$sep;
		$schema_insert .= $row['choice03']."".$sep;
		$schema_insert .= $row['choice04']."".$sep;
		$schema_insert .= $row['choice05']."".$sep;
		//$schema_insert .= $row['job']."".$sep;
		//$schema_insert = $row['certificate']."".$sep;
		//$schema_insert .= $row['concatenated']."".$sep;
       
        $schema_insert = str_replace($sep."$$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    } 
}
	else{
mysqli_error($con, $sql);	
}  

 ?>