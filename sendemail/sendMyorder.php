<?php 
set_time_limit(1500);	
require_once('../includes/myconn.php');
require_once 'Classes/PHPExcel.php';
require_once('class.phpmailer.php');

 $today = date('m-d-Y');

$q=mysqli_query($con, "select * from `mail`");
$exp = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$today=date("m-d-Y", $exp);
$now=explode('-',$today);
$todayorder=$now[2]."-".$now[0]."-".$now[1];
echo $todayorder;

$my_array= array();
$my_array1= array();
$my_array2= array();
//$fp = @fopen("Furniture Row Orders_".$today.".csv","wb");

$columns = 'Certificate Number&!Created On&!Redemption Period Begin&!Redemption Period End&!Redemption Date&!Job Number (Order)&!Status&!Certificate Status&!Customer (Order)&!Exported&!First Name&!Last Name&!Address&!City&!State&!Zip&!Demonination&!Invoice Number&!email address';
$columns1 = 'Certificate Number&!Created On&!Redemption Period Begin&!Redemption Period End&!Job Number (Order)&!Status&!Certificate Status&!Customer (Order)&!Exported&!First Name&!Last Name&!Address&!City&!State&!Zip&!Demonination&!Invoice Number&!email address';

//@fputcsv($fp,split(',',$columns));
$query_Recordset3 = mysqli_query($con, "select * from `userinfo`  WHERE `beginredemption`='".$today."' and `mailRe`='0' ORDER By id");



$query_Recordset2 = mysqli_query($con, "select * from `userinfo`  WHERE `beginredemption`='".$today."' and `mailRe`='1' ORDER By id");



$query_Recordset1 = mysqli_query($con, "select * from `userinfo` WHERE `s_check`='1' and `regDate`='".$todayorder."' ORDER By id");
//echo "select * from `userinfo` WHERE `beginredemption`='".$todayorder."' AND `s_check`='1' ORDER By id";

$cat_fetcN=mysqli_num_rows($query_Recordset1);


while($row=mysqli_fetch_array($query_Recordset1)){
		
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
	  		$vocher= $row['vocher'];
			$createdOn = $row['createdOn'];
			$beginredemption = $row['beginredemption'];
			$expiration = $row['expiration'];
			$jobnumber = $row['jobnumber'];
			
			
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
			
			
			
			
			
		
			
			$CustomerOrder = $row['CustomerOrder'];
			$Exported = $row['Exported'];
		
		
		
		
		
		
		
		$fname = $row['fname'];
		$lname = $row['lname'];
		$address1 = $row['address1'].' '.$row['address2'];
		$city = $row['city'];
		$state = $row['state'];
		$zip = $row['zip'];
		$Demonination = $row['Demonination'];
		$InvoiceNumber = $row['InvoiceNumber'];
		$email = $row['email'];
		
//$str1=$fname.','.$lname.','.$add1.','.$add2.','.$city.','.$st.','.$zip.','.$phn.','.$voc.','.$job.','.$comp.','.$now;
$str1=$vocher.'&!'.$createdOn.'&!'.$beginredemption.'&!'.$expiration.'&!'.$todayorder.'&!'.$jobnumber.'&!'.$st.'&!'.$st1.'&!'.$CustomerOrder.'&!'.$Exported.'&!'.$fname.'&!'.$lname.'&!'.$address1.'&!'.$city.'&!'.$state.'&!'.$zip.'&!'.$Demonination.'&!'.$InvoiceNumber .'&!'.$email;
array_push($my_array,$str1);


//@fputcsv($fp,split(',',$str1));
				 
				

}

/////////////////////////////FOr mailed Certi////////////////////////
while($row2=mysqli_fetch_array($query_Recordset2)){
		
			
$Recordset3 = mysqli_query($con, "select * from capXlsx where certificate='".$row2['vocher']."'");
			$cat_fetch_row = mysqli_fetch_array($Recordset3);
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
	  $st1='Assigned';
         
          
  
  }
 else if($cat_fetch_row['status']==0){

	  $st1='Assigned';
	 
	  }
	   else if($cat_fetch_row['status']==1){

	  $st1='Assigned';
	 
	  }
	   else if($cat_fetch_row['status']==2){

	  $st1='Un Assigned';
	 
	  }
	 
			
			
			
			
			
			
			$vocher= $row2['vocher'];
			$createdOn = $row2['createdOn'];
			$beginredemption = $row2['beginredemption'];
			$expiration = $row2['expiration'];
			$jobnumber = $row2['jobnumber'];
			
			
			  if($row2['s_check']==0){
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
	
          $st='Valid';
          
  
  }
 else if($row['s_check']==0){
		$st='Valid';
	  
	  }
	  else if($cat_fetch_row['s_check']==1){
		$st='Valid';
	 
	  }
			
			
			
			
			
		
			
			$CustomerOrder = $row2['CustomerOrder'];
			$Exported = $row2['Exported'];
		
		
		
		
		
		
		
		$fname = $row2['fname'];
		$lname = $row2['lname'];
		$address1 = $row2['address1'];
		$city = $row2['city'];
		$state = $row2['state'];
		$zip = $row2['zip'];
		$Demonination = $row2['Demonination'];
		$InvoiceNumber = $row2['InvoiceNumber'];
		$email = $row2['email'];
		
//$str1=$fname.','.$lname.','.$add1.','.$add2.','.$city.','.$st.','.$zip.','.$phn.','.$voc.','.$job.','.$comp.','.$now;
$str2=$vocher.'&!'.$createdOn.'&!'.$beginredemption.'&!'.$expiration.'&!'.$jobnumber.'&!'.$st.'&!'.$st1.'&!'.$CustomerOrder.'&!'.$Exported.'&!'.$fname.'&!'.$lname.'&!'.$address1.'&!'.$city.'&!'.$state.'&!'.$zip.'&!'.$Demonination.'&!'.$InvoiceNumber.'&!'.$email;
array_push($my_array1,$str2);

//@fputcsv($fp,split(',',$str1));

				 
				



}
////////////////////////////END/////////////////////////////////

////////////////////////////Certi not Mailed///////////////////////
while($row3=mysqli_fetch_array($query_Recordset3)){
	
$Recordset4 = mysqli_query($con, "select * from capXlsx where certificate='".$row3['vocher']."'");
			$cat_fetch_row = mysqli_fetch_array($Recordset4);
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

	  $st1='Assigned';
	 
	  }
	   else if($cat_fetch_row['status']==2){

	  $st1='Un Assigned';
	 
	  }
	 
			
			
			
			
			
			
			$vocher= $row3['vocher'];
			$createdOn = $row3['createdOn'];
			$beginredemption = $row3['beginredemption'];
			$expiration = $row3['expiration'];
			$jobnumber = $row3['jobnumber'];
			
			
			  if($row3['s_check']==0){
		  $exprydate = $row3['expiration'];
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
 else if($row3['s_check']==0){
		$st='Valid';
	  
	  }
	  else if($cat_fetch_row['s_check']==1){
		$st='Used';
	 
	  }
			
			
			
			
			
		
			
			$CustomerOrder = $row3['CustomerOrder'];
			$Exported = $row3['Exported'];
		
		
		
		
		
		
		
		$fname = $row3['fname'];
		$lname = $row3['lname'];
		$address1 = $row3['address1'];
		$city = $row3['city'];
		$state = $row3['state'];
		$zip = $row3['zip'];
		$Demonination = $row3['Demonination'];
		$InvoiceNumber = $row3['InvoiceNumber'];
		$email = $row3['email'];
		
//$str1=$fname.','.$lname.','.$add1.','.$add2.','.$city.','.$st.','.$zip.','.$phn.','.$voc.','.$job.','.$comp.','.$now;
$str3=$vocher.'&!'.$createdOn.'&!'.$beginredemption.'&!'.$expiration.'&!'.$jobnumber.'&!'.$st.'&!'.$st1.'&!'.$CustomerOrder.'&!'.$Exported.'&!'.$fname.'&!'.$lname.'&!'.$address1.'&!'.$city.'&!'.$state.'&!'.$zip.'&!'.$Demonination.'&!'.$InvoiceNumber.'&!'.$email;
array_push($my_array2,$str3);

}













//////////////////////////////////////////////////////////











$my_files = "Furniture Row Sent Certificate NotEmail_".$today.".xlsx";
gen_excel("PYPvouchers.com","Sent Certificate NotEmail File","Furniture Row Sent Certificate NotEmail_".$today,$columns1,$my_array2,"Furniture Row Sent Certificate NotEmail_".$today);






$my_file = "Furniture Row Orders_".$today.".xlsx";
gen_excel("PYPvouchers.com","Orders File","Furniture Row Orders_".$today,$columns,$my_array,"Furniture Row Orders_".$today);

$my_file1 = "Furniture Row Sent Certificate Email_".$today.".xlsx";
gen_excel("PYPvouchers.com","Sent Certificate Email File","Furniture Row Sent Certificate Email_".$today,$columns1,$my_array1,"Furniture Row Sent Certificate Email_".$today);



$query= mysqli_query($con, "select * from users WHERE `id`='1'");
$row=mysqli_fetch_array($query);
$to=$row['email'];


$to1="bareera@pixiders.com";
$to2="nadeemehsan9@pixiders.com";




function gen_excel($creator,$subject,$desc,$columns,$data,$filename){
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator($creator)
				   ->setLastModifiedBy("")
					->setTitle("")
					->setSubject($subject)
					->setDescription($desc)
					->setKeywords(" ")
					->setCategory(" ");
	
	
	$heads= explode('&!',$columns);
	$colm_Count= count($heads);
	/////////////////////////////////For Column Heads
	for($i=0;$i< $colm_Count ;$i++){
		
		$records[0][$i]= $heads[$i];
	}
//////////////////////////////////////////////////////////
		$row_count = count($data);	

	for($j=1;$j <= $row_count ;$j++){
		$row_rec= array();
		$row_rec =explode('&!',$data[$j-1]);
		for($i=0;$i< count($row_rec) ;$i++){
		
			$records[$j][$i]= $row_rec[$i];
			}
	}
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->fromArray($records);
	$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel2007)

/*header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
header('Cache-Control: max-age=0');*/

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('Reports/'.$filename."."."xlsx");
//exit;	
}

$query= mysqli_query($con, "select * from users WHERE `id`='1'");
$row=mysqli_fetch_array($query);
$too=$row['email'];




$my_name = "Furniture Row";
$my_mail = "FurnitureRow@pypvouchers.com";

$my_subject = 'Furniture Row Roports'.$today;
$my_message ="This Email consist of those users who used their vouchers and put an order on PYPvouchers.com and  those users who got vouchers Via Email and also those users who got vouchers but not received any Email.";



echo 'this is email code';
email_send($my_file,$my_file1,$my_files,'bareera@pixiders.com', $my_mail, $my_name, $my_subject, $my_message);
email_send($my_file,$my_file1,$my_file2,'nadeemehsan9@pixiders.com', $my_mail, $my_name, $my_subject, $my_message);

email_send($my_file,$my_file1,$my_file2,$too,$my_mail, $my_name, $my_subject, $my_message);

while($rw=mysqli_fetch_array($q)){

email_send($my_file,$my_file1,$my_file2,$rw['email'], $my_mail, $my_name, $my_subject, $my_message);
	
}
function email_send($filename,$filename1,$filename2,$mailto, $from_mail, $from_name,$subject, $message){

	$mail             = new PHPMailer(); // defaults to using php "mail()"
	
	echo $body             = $message;
	
	$mail->SetFrom($from_mail, $from_name);
	

	$mail->AddAddress($mailto, $mailto);
	
	$mail->Subject    = $subject;
	
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // Alt Body
	
	$mail->MsgHTML($body);
	
	$mail->AddAttachment('Reports/'.$filename);
	$mail->AddAttachment('Reports/'.$filename1);
	$mail->AddAttachment('Reports/'.$filename2);
	
	//$mail->AddAttachment("images/bottom.png");
	//$mail->AddAttachment("images/email.png");
	//$mail->AddAttachment("images/email_header.png");      // attachment
	//$mail->AddAttachment("images/engr mudasir.jpg"); // attachment
	
	if(!$mail->Send()) {
	  return "Mailer Error: " . $mail->ErrorInfo;
	} else {
	 return "A test email sent to your email address '".$_POST['email']."' Please Check Email and Spam too.";
	 // echo '<meta http-equiv="refresh" content="5;url=http://www.computersneaker.com">';
	}
}

?>
