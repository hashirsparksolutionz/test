<h2 style="  color: #30B54B;">File Has been Exported Sccessfully </h2>
<br/>

<a href="javascript:window.close()">Close Window</a>

<script type="text/javascript">
var myVar;

function myFunction() {
	//alert();
    myVar = setInterval(alertFunc, 3000);
}

function alertFunc() {
	//alert();
    window.close();
}

myFunction();
</script>
<?php

require_once('../../includes/myconn.php');


include('PHPExcel.php');



$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Faisal");
$objPHPExcel->getProperties()->setLastModifiedBy("Faisal");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX orders export Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX orders export Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHPExcel classes.");




$objPHPExcel->setActiveSheetIndex(0);

//$objPHPExcel->getActiveSheet()->getStyle('B1:B97')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);


	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);

	
	
	
		
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1','Company Name');
	$objPHPExcel->getActiveSheet()->setCellValue('B1','Job'); 
	$objPHPExcel->getActiveSheet()->setCellValue('C1','Voucher Number'); 
	$objPHPExcel->getActiveSheet()->setCellValue('D1','Cert #');
	$objPHPExcel->getActiveSheet()->setCellValue('E1','Concatenated');
	$objPHPExcel->getActiveSheet()->setCellValue('F1','Amount');
	
	$objPHPExcel->getActiveSheet()->setCellValue('G1','Shipped'); 
	$objPHPExcel->getActiveSheet()->setCellValue('H1','Received'); 
	$objPHPExcel->getActiveSheet()->setCellValue('I1','Fulfilled');
	$objPHPExcel->getActiveSheet()->setCellValue('J1','Created On');
	$objPHPExcel->getActiveSheet()->setCellValue('K1','Redemption Period Begin');
	$objPHPExcel->getActiveSheet()->setCellValue('L1','Redemption Period End');
	$objPHPExcel->getActiveSheet()->setCellValue('M1','Status');
	$objPHPExcel->getActiveSheet()->setCellValue('N1','Certificate Status');
	$objPHPExcel->getActiveSheet()->setCellValue('O1','Customer (Order)');
	$objPHPExcel->getActiveSheet()->setCellValue('P1','Exported');
	
	
	
	$objPHPExcel->getActiveSheet()->setCellValue('Q1','First');
	$objPHPExcel->getActiveSheet()->setCellValue('R1','Last');
	$objPHPExcel->getActiveSheet()->setCellValue('S1','Address');
	$objPHPExcel->getActiveSheet()->setCellValue('T1','City');
	$objPHPExcel->getActiveSheet()->setCellValue('U1','State');
	$objPHPExcel->getActiveSheet()->setCellValue('V1','Zip');
	$objPHPExcel->getActiveSheet()->setCellValue('W1','Phone Number');
	$objPHPExcel->getActiveSheet()->setCellValue('X1','Email');
	$objPHPExcel->getActiveSheet()->setCellValue('Y1','Demonination');
	
	$objPHPExcel->getActiveSheet()->setCellValue('Z1','Invoice Number');
	$objPHPExcel->getActiveSheet()->setCellValue('AA1','Trip 1');
	$objPHPExcel->getActiveSheet()->setCellValue('AB1','Trip 2');
	$objPHPExcel->getActiveSheet()->setCellValue('AC1','Trip 3');
	$objPHPExcel->getActiveSheet()->setCellValue('AD1','Trip 4');

	
	




function str_show($str){
		return stripslashes(html_entity_decode($str));
		}
		
		
//include('../includes/myconn.php');

$rowNumber = 2;

$sql = mysqli_query($con, "select * from capXlsx where status='0' ORDER BY id DESC");


//$sql=mysqli_query($con, "select * from `userinfo` WHERE `archive`='0' ORDER BY id DESC") or die(mysqli_error($con));

 while($row = mysqli_fetch_assoc($sql))
    {
		
		$Recordset2 = mysqli_query($con, "select * from userinfo where vocher='".$row['certificate']."'");

			$row1=mysqli_fetch_array($Recordset2);
		
		 $exprydate = $row['expiration'];
		  if($exprydate!=''){
		  	  $exdate=explode('-',$exprydate);
		  $date=$exdate['2']."-".$exdate['0']."-".$exdate['1'];
		 
		  
		   
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
 else if($row['status']==0){

	  $st1='Assigned';
	 
	  }
	   else if($row['status']==1){

	  $st1='Used';
	 
	  }

	  
	  
	  			  if($row1['s_check']==0){
		  $exprydate = $row1['expiration'];
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
 else if($row1['s_check']==0){
		$st='Valid';
	  
	  }
	  else if($row1['s_check']==1){
		$st='Used';
	 
	  }
			
			
		
			$objPHPExcel->getActiveSheet()->getStyle('W1:W256')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(20);
			
				
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowNumber, $row['cname'] );
				
				
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$rowNumber, $row['job']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowNumber, str_show($row['voucherNumber']));
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowNumber,str_show( $row['certificate']));
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowNumber, $row['concatenated']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowNumber, $row['amount']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowNumber, $row['shipCost']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowNumber, $row['received']);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowNumber, $row['fulfilled']);
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowNumber, $row1['createdOn']);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowNumber, $row['beginredemption']);
				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowNumber, $row['expiration']);
				$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowNumber, $st);
				$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowNumber, $st1);
				$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowNumber, str_show($row1['CustomerOrder']));
				$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowNumber, str_show($row1['Exported']));
				
				
	
				$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowNumber, str_show($row['first']));
				//$objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowNumber, str_show($rw1['zip']));
				$objPHPExcel->getActiveSheet()->setCellValueExplicit('R'.$rowNumber, $row['last']);

				$objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowNumber, str_show($row1['address1']));
				$objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowNumber, $row1['city']);
				$objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowNumber, $row1['state']);
				$objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowNumber, $row1['zip']);
				$objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowNumber, $row1['phone']);
				$objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowNumber, $row1['email']);
				$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$rowNumber, $row['choice01']);
				
				$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowNumber, $row1['InvoiceNumber']);
				$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$rowNumber, $row['choice02']);
				$objPHPExcel->getActiveSheet()->SetCellValue('AB'.$rowNumber, $row['choice03']);
				$objPHPExcel->getActiveSheet()->SetCellValue('AC'.$rowNumber, $row['choice04']);
				
				
				
				
				
				$rowNumber++;
				
				
			}

		
		
		
	
	

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$n = 'Pick Your Trip Used Certificates-'.date("m-d-Y");

$objWriter->save('output/'.$n.'.xlsx');



 $path = 'http://pick-your-trip.com/admin/manage/output/'.$n.'.xlsx';


?>



<script type="text/javascript">
window.location.href="<?php echo $path; ?>";

</script>



