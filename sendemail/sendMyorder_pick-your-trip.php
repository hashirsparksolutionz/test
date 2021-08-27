<?php 
set_time_limit(1500);	
//date_default_timezone_set('America/Denver');
date_default_timezone_set('America/New_York');
require_once('../includes/myconn.php');
require_once 'Classes/PHPExcel.php';
require_once('class.phpmailer.php');

 

$q=mysqli_query($con, "select * from `mail`");
$exp = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$today=date("m-d-Y", $exp);

$today2=explode("-",$today);
$today3=$today2[2].'-'.$today2[0].'-'.$today2[1];

$my_array= array();


$columns='First Name&!Last name&!Address&!City&!State&!Zip&!Phone&!Email&!Company&!Expire Date&!Choice&!Redemptiondate&!Certificate&!Job ID';
$query_Recordset1 = mysqli_query($con, "select * from userinfo WHERE `s_check`='1' AND regDate='".$today3."'");


$counter=1;	

while($cat_fetch_row=mysqli_fetch_array($query_Recordset1)){
			$counter++;
				$certi=$cat_fetch_row['vocher'];
			$Recordset2 = mysqli_query($con, "select * from capXlsx Where `certificate`='".$certi."'");
			$row1=mysqli_fetch_array($Recordset2);
  				
 	
	
	
	$fname=$cat_fetch_row['fname'];
	$lname=$cat_fetch_row['lname'];
	$add1=$cat_fetch_row['address1'];
	 
	 $city=$cat_fetch_row['city'];
	 $st=$cat_fetch_row['state'];
	 $zip=$cat_fetch_row['zip'];
	 $phn=$cat_fetch_row['phone'];
	 
	  $email=$cat_fetch_row['email'];
	 $cmp=$row1['cname'];
	 $date1=$row1['expiration'];
	 $choice=$cat_fetch_row['size'];
	 $date2=$cat_fetch_row['regDate'];
	$cer=$cat_fetch_row['vocher'];
	$jobid	=	$row1['job'];
	
$str1=$fname.'&!'.$lname.'&!'.$add1.'&!'.$city.'&!'.$st.'&!'.$zip.'&!'.$phn.'&!'.$email.'&!'.$cmp.'&!'.$date1.'&!'.$choice.'&!'.$date2.'&!'.$cer.'&!'.$jobid;
	  
	 
	

array_push($my_array,$str1);



				 
				
}














$my_file = "pick-your-trip Used certificats-".$today.".xlsx";
gen_excel("pick-your-trip.com","pick-your-trip Used certificats","pick-your-trip Used certificats-".$today,$columns,$my_array,"pick-your-trip Used certificats-".$today);







function gen_excel($creator,$subject,$desc,$columns,$data,$filename){

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




$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('Reports/'.$filename."."."xlsx");

}

$query= mysqli_query($con, "select * from users WHERE `id`='1'");
$row=mysqli_fetch_array($query);
$to=$row['email'];




$my_name = "pick-your-trip.com";
$my_mail = "sales@capitolmarketingdeals.com";

$my_subject = 'pick-your-trip Used Certificates'.$today;
$my_message ="This Email consist of those users who  put an order on pick-your-trip.com";



//echo 'this is email code';
$email_to = array('tcarroll@capitolmarketing.com' => 'Tcarroll ','waseem@pixiders.com' => 'Waseem ', 'tris@capitolmarketing.com' => 'Thomas ','nphillips@capitolmarketing.com' => 'Naomi',   'altonalvin9@gmail.com' => 'Alton Alvin',$to => 'admin');
while($rw=mysqli_fetch_array($q)){

$email_to[$rw['email']] = 'admin';
	
}



email_send($my_file,$email_to, $my_mail, $my_name, $my_subject, $my_message);





function email_send($filename,$mailto, $from_mail, $from_name,$subject, $message){

	$mail             = new PHPMailer(); 
	
	 $body             = $message;
	
	$mail->SetFrom($from_mail, $from_name);
	
	 foreach($mailto as $email => $name)
{
	
   $mail->AddBCC($email, $name);
} 

	//$mail->AddAddress("altonalvin9@gmail.com");
	
	$mail->Subject    = $subject;
	
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // Alt Body
	
	$mail->MsgHTML($body);
	
	$mail->AddAttachment('Reports/'.$filename);


	
	if(!$mail->Send()) {
	  return "Mailer Error: " . $mail->ErrorInfo;
	} else {
	 return "A test email sent to your email address '".$_POST['email']."' Please Check Email and Spam too.";

	}
}

?>
