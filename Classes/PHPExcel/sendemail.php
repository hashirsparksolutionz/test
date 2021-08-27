<?php 
require_once('includes/myconn.php');
require_once 'Classes/PHPExcel.php';
error_reporting(E_ALL);
$objPHPExcel = new PHPExcel();
//$today = date("m-d-Y");
// $Date = $EarningRecs1['$today']; $orderDate = explode('-',$Date); 
 //echo $orderDate[1].'-'.$orderDate[2].'-'.$orderDate[0];
$exp = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$today=date("m-d-Y", $exp);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$fp = @fopen("Usedcerticate.csv","wb");
//$columns='EmployeeNumber,fname,lname,address1,address2,city,state,zip, phone,email,points';
$columns='First Name,Last name,Address,address2,City,State,Zip,Phone,Email,Company,Expire Date,Choice,Redemptiondate,Certificate,Job ID';
@fputcsv($fp,split(',',$columns));

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B1', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D1', 'world!')
			 ->setCellValue('E1', 'Hello')
            ->setCellValue('F1', 'world!')
            ->setCellValue('G1', 'Hello')
            ->setCellValue('H1', 'world!')
			 ->setCellValue('I1', 'Hello')
            ->setCellValue('J1', 'Hello')
            ->setCellValue('L1', 'world!')
			->setCellValue('M1', 'Hello')
            ->setCellValue('N1', 'world!')
            ->setCellValue('O1', 'Hello');
           // ->setCellValue('D2', 'world!')


$objWriter->save('Usedcerticate.xlsx');














$query_Recordset1 = mysql_query("select * from userinfo WHERE `check`='2' AND date='".$today."' ");

				
while($cat_fetch_row=mysql_fetch_array($query_Recordset1)){
				$certi=$cat_fetch_row['vocher'];
			$Recordset2 = mysql_query("select * from capXlsx Where `certificate`='".$certi."'");
			$row1=mysql_fetch_array($Recordset2);
  				
 				
	
	$fname=$cat_fetch_row['fname'];
	$lname=$cat_fetch_row['lname'];
	$add1=$cat_fetch_row['address1'];
	$add2=$cat_fetch_row['address2'];
	 
	 $city=$cat_fetch_row['city'];
	 $st=$cat_fetch_row['state'];
	 $zip=$cat_fetch_row['zip'];
	 $phn=$cat_fetch_row['phone'];
	 
	  $email=$cat_fetch_row['email'];
	 $cmp=$row1['cname'];
	 $date1=$row1['expiration'];
	 $choice=$cat_fetch_row['size'];
	 $date2=$cat_fetch_row['date'];
	$cer=$cat_fetch_row['vocher'];
	$jobid	=	$row1['job'];
	
$str1=$fname.','.$lname.','.$add1.','.$add2.','.$city.','.$st.','.$zip.','.$phn.','.$email.','.$cmp.','.$date1.','.$choice.','.$date2.','.$cer.','.$jobid;
@fputcsv($fp,split(',',$str1));



}
$query= mysql_query("select * from users WHERE `id`='1'");
$row=mysql_fetch_array($query);
//$to=$row['email'];

$to="bareera@pixiders.com";
$subject = 'Used Certificate'.$today;
$random_hash = @md5(date('r', time()));
$headers = "From: Pick Your Trip <sales@pickyourtrip.com>".PHP_EOL;
$headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
//$attachment = @chunk_split(@base64_encode(@file_get_contents('Usedcerticate.csv')));
$message = "
--PHP-mixed-$random_hash
Content-Type: text/plain; charset='iso-8859-1'

Information Of Used certificates of ".$today."


--PHP-mixed-$random_hash
Content-Type: application/zip; name=Usedcerticate_".$today.".csv
Content-Transfer-Encoding: base64
Content-Disposition: attachment

$attachment
--PHP-mixed-$random_hash--";
@mail($to, $subject, $message, $headers);


?>
<script type="text/javascript">
 //window.open('Usedcerticate.csv','_parent');
  setTimeout(fun,1000);
  function fun(){
  //window.location.href ='?p=manageUsers';
  }
</script>

