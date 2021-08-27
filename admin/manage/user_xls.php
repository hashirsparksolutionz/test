<?php
require_once('../../../includes/myconn.php');

	
$filename ="Users";


//$sql= mysqli_query($con, "SELECT o.*,gen.* FROM `orders` o,`genvoucher` gen WHERE o.cat = 'Merchandise' AND o.certificate = gen.certificate ORDER BY o.id DESC");
$sql = mysqli_query($con, "select * from userinfo order by id desc");
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
 $schema_insert1 = "Certificate Number".$sep."Created On".$sep."Redemption Period Begin".$sep."Redemption Period End".$sep."Job Number (Order)".$sep."Status".$sep."Certificate Status".$sep."Customer (Order)".$sep."Exported".$sep."First Name".$sep."Last Name".$sep."Address1".$sep."City".$sep."State".$sep."Zip".$sep."Demonination".$sep."Invoice Number".$sep."email address";
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
	 
			
			
			
			
			
			
			$schema_insert = $row['vocher'].$sep;
			$schema_insert .= $row['createdOn'].$sep;
			$schema_insert .= $row['beginredemption']."".$sep;
			$schema_insert .= $row['expiration'].$sep;
			$schema_insert .= $row['jobnumber'].$sep;
			
			
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
	  else if($cat_fetch_row['s_check']==1){
		$st='Used';
	 
	  }
			
			
			
			
			
			$schema_insert .= $st.$sep;
			$schema_insert .= $st1.$sep;
			
			$schema_insert .= $row['CustomerOrder'].$sep;
			$schema_insert .= $row['Exported'].$sep;
		
		
		
		
		
		
		
		$schema_insert .= $row['fname'].$sep;
		$schema_insert .= $row['lname']."".$sep;
		$schema_insert .= $row['address1']."".$sep;
		$schema_insert .= $row['city']."".$sep;
		$schema_insert .= $row['state']."".$sep;
		$schema_insert .= $row['zip']."".$sep;
		$schema_insert .= $row['Demonination']."".$sep;
		$schema_insert .= $row['InvoiceNumber']."".$sep;
		$schema_insert .= $row['email']."".$sep;
		

		
	
	
       
        $schema_insert = str_replace($sep."$$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
		
		$my_excel_content = file_get_contents("https://pypvouchers.com/admin/manage/users/user_xls.php");
		$my_excel_filename = "https://pypvouchers.com/admin/manage/users/".md5(session_id().microtime(TRUE)).".xls";
		file_put_contents($my_excel_filename,$my_excel_content);
		
    } 
}
	else{
mysqli_error($con, $sql);	
}  

 ?>