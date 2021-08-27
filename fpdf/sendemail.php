<?php 
require_once('includes/myconn.php');
$today = date("Y-m-d");
$fp = @fopen("Usedcerticate.csv","wb");
//$columns='EmployeeNumber,fname,lname,address1,address2,city,state,zip, phone,email,points';
$columns='First Name,Last name,Address,address2,City,State,Zip,Phone,Email,Company,Expire Date,Choice,Redemptiondate,Certificate';
@fputcsv($fp,explode(',',$columns));

$query_Recordset1 = mysqli_query($con,"select * from userinfo WHERE `check`='2' AND date='".$today."' ");

				
while($cat_fetch_row=mysqli_fetch_array($query_Recordset1)){
				$certi=$cat_fetch_row['vocher'];
			$Recordset2 = mysqli_query($con,"select * from capXlsx Where `certificate`='".$certi."'");
			$row1=mysqli_fetch_array($Recordset2);
  				
 				
	
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
	$jobid	=	$cat_fetch_row['job'];
	
$str1=$fname.','.$lname.','.$add1.','.$add2.','.$city.','.$st.','.$zip.','.$phn.','.$email.','.$cmp.','.$date1.','.$choice.','.$date2.','.$cer.','.$jobid;
@fputcsv($fp,explode(',',$str1));



}
$to="bareera@pixiders.com";
$subject = 'Used Certificate'.@date('m-d-Y');
$random_hash = @md5(date('r', time()));
$headers = "From: Pick Your Trip <sales@pickyourtrip.com>".PHP_EOL;
$headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
$attachment = @chunk_split(@base64_encode(@file_get_contents('Usedcerticate.csv')));
$message = "
--PHP-mixed-$random_hash
Content-Type: text/plain; charset='iso-8859-1'

Information Of Used certificates of ".@date('m-d-Y')."


--PHP-mixed-$random_hash
Content-Type: application/zip; name=Usedcerticate_".@date('m-d-Y').".csv
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

