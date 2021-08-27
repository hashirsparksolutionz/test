<?php
require_once('../../../includes/myconn.php');

	
$filename ="Users";


//$sql= mysql_query("SELECT o.*,gen.* FROM `orders` o,`genvoucher` gen WHERE o.cat = 'Merchandise' AND o.certificate = gen.certificate ORDER BY o.id DESC");
$sql = mysqli_query($con, "select * from userinfo order by id desc");
//$sql=mysql_query("SELECT * FROM `orders` where `cat`='Merchandise';");
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
/*for ($i = 0; $i < mysql_num_fields($sql); $i++) {
echo mysql_field_name($sql,$i) . "\t";
}
print("\n"); */
//end of printing column names  
//start while loop to get data
 $schema_insert1 = "First Name".$sep."Last Name".$sep."Address1".$sep."Address2".$sep."City".$sep."State".$sep."Zip".$sep."Phone".$sep."Email".$sep."Vouchers".$sep."BeginRedemption".$sep."Expiration";
 echo $schema_insert1;
 print("\n"); 
    while($row = mysqli_fetch_array($sql))
    {
		
		
		$schema_insert = $row['fname'].$sep;
		$schema_insert .= $row['lname']."".$sep;
		$schema_insert .= $row['address1']."".$sep;
		$schema_insert .= $row['address2']."".$sep;
		$schema_insert .= $row['city']."".$sep;
		$schema_insert .= $row['state']."".$sep;
		$schema_insert .= $row['zip']."".$sep;
		$schema_insert .= $row['phone']."".$sep;
		$schema_insert .= $row['email']."".$sep;
		$schema_insert .= $row['vocher']."".$sep;

		$schema_insert .= $row['beginredemption']."".$sep;
		$schema_insert .= $row['expiration'].$sep;
	
	
       
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