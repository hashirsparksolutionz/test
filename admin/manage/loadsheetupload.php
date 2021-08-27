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
	$subject = 'GIFT VOUCHERS'; 
    $headers 	= "From:".$web."<".$admin.">".PHP_EOL;
	$headers .= "MIME-Version: 1.0".PHP_EOL;
	$headers .= "Content-Type: text/html; charset=UTF-8".PHP_EOL;
	$body = " $head <br />";
	$body	=	'<div align="center" style="background-image: url(http://pypvouchers.com/images/bgEmail2.png);
	background-repeat: no-repeat;
	background-position: center top;
	height: 634px;
	width: 960px;
	position: relative;
	margin-top: 150px;
	padding-top: 150px;width: 960px;
height: auto;
margin-top: 90px !important;
margin: 0 auto;
background-color: #fff;">
<div style="height: 215px;
	width: 540px;
	position: absolute;
	left: 210px;
	top: -66px;"><a href="https://www.pypvouchers.com" target="_blank"><img src="http://pypvouchers.com/images/Emaillogo.png" alt="some descripiton" height="215px" title="Logo" border="0" /></a></div>
<table width="820" align="center" border="0">
  <tbody><tr>
    <td colspan="2">
<div id="header" style="width: auto;
height: auto;">
		<div class="logo-div" style="text-align: center; line-height:0px;">
			<a href="https://www.pypvouchers.com" target="_blank"></a></div>
		
		<div style="width: auto;
height: auto;
: white;
padding-left: 5px;
padding-top: 4px;">
			<div class="left-text-div" style="float: left;
margin-top: 8px;">
		

		<div style="padding-left:100px; padding-right:100px; line-height:0px"><img border="0" width="650ox" src="http://pypvouchers.com/images/font.png" title="Home"></div>

</div>
			<div class="clr" style="clear: both;">
			</div>
		</div>
<table width="100%" cellpadding="0" cellspacing="0">
			  <tr>
                <td colspan="4">[6:43:45 PM] Nadeem Ehsan: <div style="font-family:Verdana,Tahoma,Arial,sans-serif; color:#444444;font-weight: bold; font-size: 14px;">The Specialty Stores at</div>
    <div style="font-family:Verdana,Tahoma,Arial,sans-serif; color:#B13427;font-weight: bold;font-size:42px;">Furniture Row</div></td>
               
              </tr>

  <tr>
    <td width="28%" align="right"><h2>Certificate #:  '.$voucher[$row_counter].'</h2> </td>
    <td width="19%">&nbsp;</td>
    <td width="18%" align="right"><h2>Certificate Value: $500</h2></td>
    <td width="35%">&nbsp;</td>
  </tr>
  <tr>
    <td><h1 style="color:#b0352b;font-size: 40px;">Home Depot</h1></td>
    <td><h1 style="color:#b0352b;font-size: 40px;">• Kohl’s </h1></td>
    <td><h1 style="color:#b0352b;font-size: 40px;">• Target </h1></td>
    <td><h1 style="color:#b0352b;font-size: 40px;">• Visa Gift Card</h1></td>
  </tr>
</table>
<div class="clr" style="clear: both;">
</div>
<div title="Page 1">
  <div>
    <div>
      <div> 
        <h2 align="center">To redeem your gift card go to <a href="https://pypvouchers.com" style="color:black; text-decoration:none;" target="_blank">https://pypvouchers.com</a></h2>
        <p style="margin-left:15px">Gift Card Terms &amp; Conditions: </p>
        <ul>
          <li>
            <p>Capitol Marketing Concepts reserves the right to substitute a comparable gift card. </p>
          </li>
          <li>
            <p>You have received this certificate as part of a business promotion. The business promoter who granted the certificate to you specifically conditions its redemption upon full payment to Capitol Marketing Concepts. </p>
          </li>
          <li>
            <p>All taxes are the responsibility of the person receiving the redemption. </p>
          </li>
          <li>
            <p>Certificates are completely transferable, but may not be resold under any circumstances. Notice of resell will void the certificate. </p>
          </li>
          <li>
            <p>Once your certificate is received allow 2-4 weeks for processing and delivery. The package you selected will be sent to you via the US Postal Service. Failure to adhere to all Terms &amp; Conditions may hinder the processing of your certificate. </p>
          </li>
          <li>
            <p>Offer not valid after expiration date under any circumstance.          </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div></td>
  </tr>
    <tr>
      <td colspan="2"><h3 align="center">For Questions related to gift cards please call 1-800-238-5659 x2333</h3></td>
    </tr>
    <tr>
      <td width="408" style="padding-left: 150px;">Florida Seller of Travel Numbers for<br />
        Capitol Marketing Concepts: ST36176 </td>
      <td width="444" style="padding-right: 150px;" align="right"><strong>Expiration Date:</strong>'.$exp_date.'</td>
    </tr>
    <tr>
      <td style="padding-left: 150px;">&nbsp;</td>
      <td style="padding-right: 150px;" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td style="padding-left: 150px;">&nbsp;</td>
      <td style="padding-right: 150px;" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td style="padding-left: 150px;">&nbsp;</td>
      <td style="padding-right: 150px;" align="right">&nbsp;</td>
    </tr>
	<tr>
      <td style="padding-left: 150px;">&nbsp;</td>
      <td style="padding-right: 150px;" align="right">&nbsp;</td>
    </tr>
	<tr>
      <td style="padding-left: 150px;">&nbsp;</td>
      <td style="padding-right: 150px;" align="right">&nbsp;</td>
    </tr><tr>
      <td style="padding-left: 150px;">&nbsp;</td>
      <td style="padding-right: 150px;" align="right">&nbsp;</td>
    </tr><tr>
      <td style="padding-left: 150px;">&nbsp;</td>
      <td style="padding-right: 150px;" align="right">&nbsp;</td>
    </tr>
  </tbody>
</table>
</div>';
	
//$body .= " $foot <br />";

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
