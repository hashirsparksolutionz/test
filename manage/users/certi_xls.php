<?php
require_once('../../../includes/myconn.php');

	
$filename ="pick-your-trip Used Cerificates";


//$sql= mysqli_query($con, "SELECT o.*,gen.* FROM `orders` o,`genvoucher` gen WHERE o.cat = 'Merchandise' AND o.certificate = gen.certificate ORDER BY o.id DESC");
$sql= mysqli_query($con, "select * from userinfo WHERE `check`='2' order by id DESC");
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

 $schema_insert1="First Name".$sep."Last name".$sep."Address".$sep."address2".$sep."City".$sep."State".$sep."Zip".$sep."Phone".$sep."Email".$sep."Company".$sep."Expire Date".$sep."Choice".$sep."Redemptiondate".$sep."Certificate".$sep."Job Number";
 echo $schema_insert1;
 print("\n"); 
   while($cat_fetch_row=mysqli_fetch_array($sql)){
		$certi=$cat_fetch_row['vocher'];
		$Recordset2 = mysqli_query($con, "select * from capXlsx Where `certificate`='".$certi."'");
			$row1=mysqli_fetch_array($Recordset2);
  				
 				
	
	$schema_insert=$cat_fetch_row['fname'].$sep;;
	$schema_insert .=$cat_fetch_row['lname'].$sep;;
	$schema_insert .=$cat_fetch_row['address1'].$sep;;
	$schema_insert .=$cat_fetch_row['address2'].$sep;;
	 
	 $schema_insert .=$cat_fetch_row['city'].$sep;;
	$schema_insert .=$cat_fetch_row['state'].$sep;;
	 $schema_insert .=$cat_fetch_row['zip'].$sep;;
	 $schema_insert .=$cat_fetch_row['phone'].$sep;;
	 
	  $schema_insert .=$cat_fetch_row['email'].$sep;;
	 $schema_insert .=$row1['cname'].$sep;;
	
	 $schema_insert .=$row1['expiration'].$sep;;
	$schema_insert .=$cat_fetch_row['size'].$sep;;
	 $schema_insert .=$cat_fetch_row['date'].$sep;;
	$schema_insert .=$cat_fetch_row['vocher'].$sep;;
	 $schema_insert .=$row1['job'].$sep;;
	
		
	
        $schema_insert = str_replace($sep."$$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    } 
}
	else{
mysqli_error($sql);	
}  

 ?>