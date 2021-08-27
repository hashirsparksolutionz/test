<?php
require_once('../../includes/myconn.php');

	
$filename ="Furniture Row Unassigned Cerificates";


//$sql= mysqli_query("SELECT o.*,gen.* FROM `orders` o,`genvoucher` gen WHERE o.cat = 'Merchandise' AND o.certificate = gen.certificate ORDER BY o.id DESC");
$sql = mysqli_query($con, "select * from capXlsx where status='2' ORDER BY id DESC");
//$sql=mysqli_query("SELECT * FROM `orders` where `cat`='Merchandise';");
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
 $schema_insert1 = "Company Name".$sep."Job #".$sep."Cert #".$sep."Concatenated".$sep."Amount".$sep."Shipped".$sep."Received".$sep."Fulfilled".$sep."First ".$sep."Last".$sep."Street".$sep."City".$sep."State".$sep."Zip".$sep."BeginRedemption".$sep."Expiration".$sep."Demonination".$sep."Choice1".$sep."Choice2".$sep."Choice3".$sep."Choice4";
 echo $schema_insert1;
 print("\n"); 
    while($row = mysqli_fetch_array($sql))
    {
		
		
		$schema_insert = $row['cname'].$sep;
		$schema_insert .= $row['job']."".$sep;
		$schema_insert .= $row['certificate']."".$sep;
		$schema_insert .= $row['concatenated']."".$sep;
		$schema_insert .= $row['amount']."".$sep;
		$schema_insert .= $row['shipped']."".$sep;
		$schema_insert .= $row['received']."".$sep;
		$schema_insert .= $row['fulfilled']."".$sep;
		$schema_insert .= $row['first']."".$sep;
		$schema_insert .= $row['last']."".$sep;
		$schema_insert .= $row['street']."".$sep;
		$schema_insert .= $row['city']."".$sep;
		$schema_insert .= $row['state']."".$sep;
		$schema_insert .= $row['zip']."".$sep;
		$schema_insert .= $row['beginredemption']."".$sep;
		$schema_insert .= $row['expiration'].$sep;
		$schema_insert .= mysqli_real_escape_string($con, $row['choice01'])."".$sep;
		//$schema_insert .=preg_replace('/[^A-Za-z0-9\-]/', '', $row['choice02']);
		$schema_insert .= $row['choice02']."".$sep;
		$schema_insert .= $row['choice03']."".$sep;
		$schema_insert .= $row['choice04']."".$sep;
		$schema_insert .= $row['choice05'];
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