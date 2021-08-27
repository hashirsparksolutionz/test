<?php
require_once('../includes/myconn.php'); 
$certificate = $_REQUEST['certificate'];

$getDate 	= explode('/',date("m/d/Y"));
	$day  	= $getDate[0];
	$month		= $getDate[1];
	$year	  	= $getDate[2]+1;
	$Nextdate		= $day.'/'.$month.'/'.$year;
	

$job = $_REQUEST['job'];

$access_Code=$_REQUEST['job'];
$Certeficate_Number =  $_REQUEST['certificate'];
$redemption_period= date("m/d/Y") ."-". $Nextdate;

require_once('fpdf.php'); 
require_once('fpdi.php'); 
	 
	// initiate FPDI 
	$pdf = new FPDI(); 
	// add a page 
	$pdf->AddPage(); 
	// set the sourcefile 
	$pdf->setSourceFile('Reservation Request Form - NCL Sky.pdf'); 
	// import page 1 
	$page1= $pdf->importPage(1); 

// use the imported page and place it at point 10,10 with a width of 100 mm 
	$pdf->useTemplate($page1); 
	$pdf->AddPage();
	$page2 = $pdf->importPage(2); 
// use the imported page and place it at point 10,10 with a width of 100 mm 
	$pdf->useTemplate($page2); 
	 
	// now write some text above the imported page 
	$pdf->SetFont('Arial','B',6);
	//$pdf->SetTextColor(255,0,0); 
	$pdf->SetY(21);
	$pdf->SetX(181);
	//$pdf->Cell(0,5,$text,0,1);
	
	$pdf->Write(0, $access_Code); 
	$pdf->SetY(26.3);
	$pdf->SetX(181);
	//$pdf->Cell(0,5,$text,0,1);
	
	$pdf->Write(0, $Certeficate_Number);
	$pdf->SetY(122);
	$pdf->SetX(52);
	
	$pdf->SetFont('Arial','',12);
	
	$pdf->Write(0,$redemption_period); 
	
		$pdf->SetFont('Arial','B',6);
	
	
	
	
	
	 
	////////////////////////////////////////////////////////////////////////////3rd Page////////////////////////////
	
	$pdf->AddPage();
	$page3 = $pdf->importPage(3); 
// use the imported page and place it at point 10,10 with a width of 100 mm 
	$pdf->useTemplate($page3); 
	 
	// now write some text above the imported page 
	$pdf->SetFont('Arial','B',6);
	//$pdf->SetTextColor(255,0,0); 
	$pdf->SetY(15);
	$pdf->SetX(177);
	//$pdf->Cell(0,5,$text,0,1);
	
	$pdf->Write(0, $access_Code); 
	$pdf->SetY(21);
	$pdf->SetX(177);
	//$pdf->Cell(0,5,$text,0,1);
	
	$pdf->Write(0, $Certeficate_Number); 
	
	$pdf->SetY(21);
	$pdf->SetX(177);
	$pdf->Output($certificate.'-'.$job.'-Reservation Request Form - NCL Sky.pdf', 'F'); 
	
/*require("fpdf.php");
ob_start("callback");


$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();


$pdf->SetFont('Arial','B',8);

$pdf->SetXY(1,1.2);

$pdf->image('1st-img.jpg');

$pdf->SetFont('');

//$pdf->AddPage();
$text = "Code";



$pdf->image('2nd-img.jpg');
$pdf->SetXY(1,1.2);
$pdf->SetFont('Arial','B',8);

//$pdf->AddPage();
$pdf->SetY(33);
$pdf->SetX(180);
$pdf->Cell(0,5,$text,0,1);
$pdf->SetX(180);
$pdf->Cell(0,5,$text,0,1);


$pdf->image('2nd-img.jpg');

$pdf->SetY(33);
$pdf->SetX(180);
$pdf->Cell(0,5,$text,0,1);
$pdf->SetX(180);
$pdf->Cell(0,5,$text,0,1);
$pdf->Output('simple.pdf','F');*/
?>
<script language="javascript">window.location.href ="<?php echo $certificate  ?>-<?php echo $job  ?>-Reservation Request Form - NCL Sky.pdf";</script>
