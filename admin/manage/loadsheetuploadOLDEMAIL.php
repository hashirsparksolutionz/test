<?php
set_time_limit(90);
////////////////////////////////////////////////////// For FETCHING NEWSLETTER FROM DATABASE////////////////////////////////////////
$rslt=mysqli_query($con, "SELECT * FROM  `web_info` WHERE id ='1'");

$title=mysqli_fetch_array($rslt);

$web= $title['name'];

$link= $title['link'];

$color= $title['color'];

$rslt1=mysqli_query($con, "SELECT * FROM `users` WHERE  id ='1'");

$title1=mysqli_fetch_array($rslt1);

$admin= $title1['email'];
$Recordset3 = mysqli_query($con, "SELECT * FROM `newsletter` WHERE `id`='1'");

$cat_fetch_row=mysqli_fetch_array($Recordset3);

 $url=$_SERVER['SERVER_NAME'];

 $body= stripslashes($cat_fetch_row['body']);

$body1= str_replace("Test.com",$url, $body);

 $body2= str_replace("web_name",$web, $body1);

  $head= str_replace("TestColor",$color, $body2);




 $footer= stripslashes($cat_fetch_row['footer']);

 $foot= str_replace("Test.com",$url, $footer);
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$voucher=array();

$num=count($voucher);

if (isset($_POST['btnSbt']))
 {
     if($_FILES['csvFile']['name']!="")
	 {
$q=mysqli_query($con, "SELECT * FROM `capXlsx` where status='2'");

echo 'Avaiable Vouchers '.$unused_vouchers = mysqli_num_rows($q);
		  
		  ///////////////////////////////////////////////FOR DATE CALCULATION 6 MONTHS ///////////////////////////////
	  require_once 'class.datetimecalc.php';	 
		 $orig_date = date("m-d-Y"); ;
		 $orig_mask = "m-d-Y";
		 $obj = new Date_Time_Calc($orig_date, $orig_mask);
		 $exp_date = $obj->add("month", 6); 
	 
	 /////////////////////////////////////////////////////////////////////////////////////////////////////////
	 require_once "simplexlsx.class.php";
	 $xlsx = new SimpleXLSX( $_FILES['csvFile']['tmp_name'] );	
	 list($cols, $row) = $xlsx->dimension();
	 echo 'Rows in EXCEL '.$row;
	if($unused_vouchers<$row-1){?>
<script type="text/javascript">
alert('The Number Of Records Are More Than The Number Of Unassigned Vouchers');
        window.location.href="?p=loadsheetupload";
        </script>
<?php }else{
	
	////////////// FOR FETCHING UN ASSIGNED VOUCHERS FROM DB //////////////////////////
	$row_counter=0;/////CONTROLS THE ARRAY INDEX OF VOUCHERS WITH RECORDS//////////
	$voucher_counts=0;
	while($fetch_voucher=mysqli_fetch_array($q)){
		if(!in_array($fetch_voucher['certificate'],$voucher)){
			if($voucher_counts<$row){
	array_push($voucher,$fetch_voucher['certificate']);
	$voucher_counts++;
			}
		}
	////////////////////////////////////////////////////////////////////////////////////
}
	
	///////////////////////////////////////////FOR FILE LOG///////////////////////////////////////////////
	 $date=date("m-d-Y [ g-i-s A ]",time());
	$up_date=date("m-d-Y, g:i:s A",time());
	$user_file	    = $_FILES['csvFile']['name'];
	$new_file_name  = $date.'-'.str_replace(' ','_',$user_file);
	move_uploaded_file($_FILES['csvFile']['tmp_name'],'uploads/'.$new_file_name);

	if(!mysqli_query($con, "INSERT INTO `upload` SET `type` = '1', `userData` = '".$new_file_name."',`date`='".$up_date."'")){
		echo mysqli_error($con);
	}
	
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	 foreach( $xlsx->rows() as $k => $r)
	 {
		 if ($k == 0)
		 continue;
		
		 $var='';
		 if($r[0] != ''){
		///beginredemption,beginredemption,vocher,exp_date
		 
		
		 
$sql="INSERT INTO `userinfo` (`fname`,`lname`,`address1`,`address2`,`city`,`state`,`zip`,`phone`,`email`,`vocher`,`beginredemption`,`expiration`) VALUES ('".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".$r[7]."','".$r[8]."','".$voucher[$row_counter]."','".$orig_date."','".$exp_date."')";

		if(mysqli_query($con, $sql))
		{
		
		////'".$voucher[$row_counter]."'beginredemption,expiration
			mysqli_query($con, "UPDATE `capXlsx` SET status='0',`beginredemption`='".$orig_date."',`expiration`='".$exp_date."' WHERE `certificate`='".$voucher[$row_counter]."'");
			$row_counter++; 

				$im="yes";
				////////////////////////////////////////////////////////////////// FOR SENDING NEWSLETTER WITH VOUCHERS////////////////
		if($r[8]!=''){
			$to      =  $r[8]; 
	$subject = 'GIFT VOUCHERS '; 
    $headers 	= "From:".$web."<".$admin.">".PHP_EOL;
	$headers .= "MIME-Version: 1.0".PHP_EOL;
	$headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
	$body = " $head <br />";
	$body .= 'A Gift Voucher from <a href="http://'.$url.'">'.$web.'</a> has been sent to you with the information given below. Please redeem your Gift Voucher on <a href="http://'.$url.'">'.$web.".com</a><br /><br /><br />

First Name: ".$r[0]."<br />
Last Name: ".$r[1]."<br />
Address 1: ".$r[2]."<br />
Address 2: ".$r[3]."<br />
City: ".$r[4]."<br />
State: ".$r[5]."<br />
Zip: ".$r[6]."<br />
Phone: ".$r[7]."<br />
Email: ".$r[8]."<br />
Voucher Code: ".$voucher[$row_counter]."<br />
Voucher Begin Redemption Date: ".$orig_date."<br />
Voucher Expiration Date: ".$exp_date."<br />";
$body .= " $foot <br />";

	mail($to,$subject,$body,$headers);
			
			
		}
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
	   }else{
		   echo mysqli_error($con);
		   
		   
	   }
		
	 }	
	 }
	 }
   }
   else
   {
	   $mes="imported";
   }
	 
}
?>

<div><strong style="font-size: 20px;">You Can Import XLSX File For Users</strong></div>
<div style="margin-top: 85px; width: 375px; margin-left: 245px; background-color: #EDEDED; margin-bottom: 85px;">
  <form action="" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" cellpadding="5" cellspacing="10">
      <tr align="center">
        <td colspan="2" align="center"></td>
      </tr>
      <tr align="center">
        <td width="250"><input class="btn btn-small btn-success" name="csvFile" type="file" /></td>
        <input type="hidden" name="check"  value="yes"/>
        <td ><input type="submit" name="btnSbt" class="btn" id="btnSbt" value="Submit" /></td>
      </tr>
    </table>
  </form>
</div>
<?php

if(isset($mes)){?>
<div>
  <?php
	 echo "<div class='alert alert-success'  id='ErrorMsg'>Please Select File</div>";
	 ?>
</div>
<?php } ?>
<?php
   if(isset($im)){?>
<div>
  <?php
 	 echo "<div class='alert alert-success'>File Has Been Imported Successfully</div><br/>"; ?>
</div>
<?php } ?>
