<?php 
//set_time_limit(1500);	
require_once('includes/myconn.php');
require_once 'Classes/PHPExcel.php';
//error_reporting(E_ALL);
//date_default_timezone_set('Pacific/Easter');
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Pick Your Trip")
							 ->setLastModifiedBy("Pick Your Trip")
							 ->setTitle("Redeemed Certeficates")
							 ->setSubject("Redeemed Certeficates")
							 ->setDescription("Description of Redeemed Certeficates")
							 ->setKeywords(" ")
							 ->setCategory(" ");



//$today = date("m-d-Y");
// $Date = $EarningRecs1['$today']; $orderDate = explode('-',$Date); 
 //echo $orderDate[1].'-'.$orderDate[2].'-'.$orderDate[0];
 
$exp = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$today=date("m-d-Y", $exp);

$fp = @fopen("pick-your-trip Usedcertificate.csv","wb");

$columns='First Name,Last name,Address,City,State,Zip,Phone,Email,Company,Expire Date,Choice,Redemptiondate,Certificate,Job ID';
@fputcsv($fp,explode(',',$columns));

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'First Name')
            ->setCellValue('B1', 'Last name')
            ->setCellValue('C1', 'Address')
			 ->setCellValue('D1', 'City')
            ->setCellValue('E1', 'State')
            ->setCellValue('F1', 'Zip')
            ->setCellValue('G1', 'Phone')
			 ->setCellValue('H1', 'Email')
            ->setCellValue('I1', 'Company')
            ->setCellValue('J1', 'Expire Date')
			->setCellValue('K1', 'Choice')
			->setCellValue('L1', 'Redemptiondate')
            ->setCellValue('M1', 'Certificate')
            ->setCellValue('N1', 'Job ID');
           // ->setCellValue('D2', 'world!')













$query_Recordset1 = mysqli_query($con, "select * from userinfo WHERE `check`='2' AND date='".$today."' ");

$counter=1;				
while($cat_fetch_row=mysqli_fetch_array($query_Recordset1)){
			$counter++;
				$certi=$cat_fetch_row['vocher'];
			$Recordset2 = mysqli_query($con, "select * from capXlsx Where `certificate`='".$certi."'");
			$row1=mysqli_fetch_array($Recordset2);
  				
 	
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$counter, $cat_fetch_row['fname'])
            ->setCellValue('B'.$counter, $cat_fetch_row['lname'])
            ->setCellValue('C'.$counter, $cat_fetch_row['address1'])
			 ->setCellValue('D'.$counter, $cat_fetch_row['city'])
            ->setCellValue('E'.$counter, $cat_fetch_row['state'])
            ->setCellValue('F'.$counter, $cat_fetch_row['zip'])
            ->setCellValue('G'.$counter, $cat_fetch_row['phone'])
			 ->setCellValue('H'.$counter, $cat_fetch_row['email'])
            ->setCellValue('I'.$counter, $row1['cname'])
            ->setCellValue('J'.$counter, $row1['expiration'])
			->setCellValue('K'.$counter, $cat_fetch_row['size'])
			->setCellValue('L'.$counter, $cat_fetch_row['date'])
            ->setCellValue('M'.$counter, $cat_fetch_row['vocher'])
            ->setCellValue('N'.$counter, $row1['job']);
	
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
@fputcsv($fp,explode(',',$str1));




}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('Usedcerticate.xls');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('Usedcerticate.xls');


/*<!--$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
-->*/
/*
$objPHPExcel->disconnectWorksheets();
unset($objWriter, $objPHPExcel);*/





//echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME));
//echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds";


$query= mysqli_query($con, "select * from users WHERE `id`='1'");
$row=mysqli_fetch_array($query);
$to=$row['email'];

$to2="bareera@pixiders.com";
$to1="nadeemehsan9@pixiders.com";
$subject = 'pick your trip Used Certificate'.$today;
$random_hash = @md5(date('r', time()));
$headers = "From: Pick Your Trip <sales@pickyourtrip.com>".PHP_EOL;
$headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
$attachment = @chunk_split(@base64_encode(@file_get_contents('Usedcerticate.csv')));
$message = "
--PHP-mixed-$random_hash


Information Of Used certificates of ".$today."To Download as XLSX File Click or copy and paste the link in your browser. http://pick-your-trip.com/Usedcerticate.xls
--PHP-mixed-$random_hash
Content-Type: application/zip; name=pick-your-trip_Usedcertificate".$today.".csv
Content-Transfer-Encoding: base64
Content-Disposition: attachment

$attachment
--PHP-mixed-$random_hash--";
@mail($to1, $subject, $message, $headers);
@mail($to2, $subject, $message, $headers);
@mail($to, $subject, $message, $headers);






//flush();
//Content-Type: application/zip; name=Usedcerticate_".$today.".xlsx
?>
<script type="text/javascript">
 //window.open('Usedcerticate.csv','_parent');
  setTimeout(fun,1000);
  function fun(){
  //window.location.href ='?p=manageUsers';
  }
</script>
