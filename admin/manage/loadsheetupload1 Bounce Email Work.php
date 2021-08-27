<script type="text/javascript" language="javascript">

function changeData1(id){

		var fieldset = id.split('_');
		fieldset_id =fieldset[1];
		var emailChk=0;
		if($('#emailChk1_'+fieldset_id).attr("checked")=='checked'){
		emailChk=1;
		
		}else{
			emailChk=0;
			
		}
		//alert(emailChk);
	
	$.post("manage/email.php?id="+fieldset_id+'&emailChk='+emailChk, {
		
			}, function(response){
			
			//	alert(response);
			if(response==1)
			{	$('#after_submit').remove();
				$("#"+id).after('<label  style="color:#105ea6" id="after_submit">Record Updated .</label>');
				$('#after_submit').fadeOut(1500);
			}
			else if(response==0)
			{
				$("#"+id).after('<label class="error" id="after_submit">Record Cannot Be Updated .</label>');
			}
			else if(response==2)
			{
				$("#"+id).after('<label class="error" id="after_submit">Record Cannot Be Updated because 3 featured deals Already Selected.</label>');
				//alert('Record Cannot Be Updated because 3 featured deals Already Selected')
			}
			
			
		});
		//bigMap();
       // return false;

	
}
		  
		  
		  
		  
</script>
<?php
//url(images/email_header.png);
set_time_limit(90);
$create=date('m-d-Y');
////////////////////////////////////////////////////// For FETCHING NEWSLETTER FROM DATABASE////////////////////////////////////////
$rslt=mysqli_query($con, "SELECT * FROM  `web_info` WHERE id ='1'");

$title=mysqli_fetch_array($rslt);

$web= $title['name'];

$link= $title['link'];

$color= $title['color'];
$mail= $title['mail'];
if($_POST['emailchk'])
{
	echo 'Checked';
}

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
$job=array();

function clean($string) {
	$string = str_replace("-", "", $string);
   $string = str_replace(" ", "", $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '', $string); // Replaces multiple hyphens with single one.
}
function replace($string) {
	$string = str_replace("-",  " ", $string);
   $string = str_replace(".", " ", $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}


$num=count($voucher);

if (isset($_POST['btnSbt']))
 {
     if($_FILES['csvFile']['name']!="")
	 {



		  
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
	
	
	
	///////////////////////////////////////////FOR FILE LOG///////////////////////////////////////////////
	
	
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$flag=0;
	$getUnusedcerti=0;
	$row_counter=0;
	$voucher_counts=0;
	 foreach( $xlsx->rows() as $k => $r)
	 {
		 if ($k == 0)
		 continue;
		
		 $var='';
		 if($r[9] != ''){
			 
			
		//	 echo $r[16];
		if($flag==0){
			
			 $q=mysqli_query($con, "SELECT * FROM `capXlsx` WHERE status='2' AND job='".clean($r[4])."' AND choice01='".clean($r[16])."'");
			 echo 'Avaiable Certeficates '.$unused_vouchers = mysqli_num_rows($q).'<br/>';
			  echo 'Rows in EXCEL '.$row;
			 
		
			 if($unused_vouchers<$row-1){?>
<script type="text/javascript">
alert('The Number Of Records Are More Than The Number Of Unassigned Certeficates');
        window.location.href="?p=loadsheetupload1";
        </script>
<?php }else{
	
	 $date=date("m-d-Y [ g-i-s A ]",time());
	$up_date=date("m-d-Y, g:i:s A",time());
	$user_file	    = $_FILES['csvFile']['name'];
	$new_file_name  = $date.'-'.str_replace(' ','_',$user_file);
	move_uploaded_file($_FILES['csvFile']['tmp_name'],'uploads/'.$new_file_name);

	if(!mysqli_query($con, "INSERT INTO `upload` SET `type` = '1', `userData` = '".$new_file_name."',`date`='".$up_date."'")){
		echo mysqli_error($con);
	}
	////////////// FOR FETCHING UN ASSIGNED VOUCHERS FROM DB //////////////////////////
	/////CONTROLS THE ARRAY INDEX OF VOUCHERS WITH RECORDS//////////
	
	while($fetch_voucher=mysqli_fetch_array($q)){
		if(!in_array($fetch_voucher['certificate'],$voucher)){
			if($voucher_counts<$row){
	array_push($voucher,$fetch_voucher['certificate']);
	//array_push($job,$fetch_voucher['job']);
	$voucher_counts++;
			}
		}
	////////////////////////////////////////////////////////////////////////////////////
}
	
	
			 
}
	 $flag=1;
		 }
		 
$sql="INSERT INTO `userinfo` (`jobnumber`,`fname`,`lname`,`address1`,`city`,`state`,`zip`,`phone`,`email`,`vocher`,`beginredemption`,`expiration`,`createdOn`,`CustomerOrder`,`Exported`,`Demonination`,`InvoiceNumber`) VALUES ('".clean($r[4])."','".preg_replace('/[^a-zA-z0-9 ]/s',' ',$r[9])."','".preg_replace('/[^a-zA-z0-9 ]/s',' ',$r[10])."','".preg_replace('/[^a-zA-z0-9 ]/s',' ',$r[11])."','".preg_replace('/[^a-zA-z0-9 ]/s',' ',$r[12])."','".preg_replace('/[^a-zA-z0-9 ]/s','',$r[13])."','".substr(clean($r[14]),0,5)."','".replace($r[15])."','".$r[18]."','".$voucher[$row_counter]."','".$orig_date."','".$exp_date."','".$create."','".$r[7]."','".$r[8]."','".clean($r[16])."','".preg_replace('/[^a-zA-z0-9 ]/s',' ',$r[17])."')";

		//exit();
		if(mysqli_query($con, $sql))
		{
			$id1 =mysqli_insert_id($con);
		
		////'".$voucher[$row_counter]."'beginredemption,expiration
			mysqli_query($con, "UPDATE `capXlsx` SET status='0',`beginredemption`='".$orig_date."',`expiration`='".$exp_date."' WHERE `certificate`='".$voucher[$row_counter]."'");
			

		//		$im="yes";
				////////////////////////////////////////////////////////////////// FOR SENDING NEWSLETTER WITH VOUCHERS////////////////
		if($r[18]!='' && $mail=='1'){
		$to      =  $r[18]; 
		mysqli_query($con, "UPDATE `userinfo` SET mailRe='1' WHERE `id`='".$id1."'");
			
	$subject = 'Furniture Row '; 
    $headers 	= "From: Furniture Row <".$admin.">".PHP_EOL;
	$headers .= "MIME-Version: 1.0".PHP_EOL;
	$headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
	//$body = " $head <br />";
	$body	='<div style="width: 960px; margin: auto;">
  <div style="background-image: url(https://www.pypvouchers.com/images/email_header.png); background-repeat: no-repeat; background-position: center top; height: 300px;"></div>
   <div style="background-image: url(https://www.pypvouchers.com/images/border.png); background-repeat: repeat-y; background-position: center center;">
    <table width="820" border="0" align="center" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td colspan="2"><div class="logo-div" style="text-align: center; line-height:0px;"> <a href="https://www.pypvouchers.com" target="_blank"></a></div>
            <table width="100%" cellpadding="0" cellspacing="0">
              
			  <tr>
                <td colspan="4" style="padding-left:100px;"><div style="font-family:Verdana,Tahoma,Arial,sans-serif; color:#444444;font-weight: bold; font-size: 14px;">The Specialty Stores at</div>
    <div style="font-family:Verdana,Tahoma,Arial,sans-serif; color:#B13427;font-weight: bold;font-size:42px;">Furniture Row</div></td>
               
              </tr>
			  <tr>
                <td width="35%" align="right"><h2>Certificate #: <div style="color:#B13427;">'.$voucher[$row_counter].'</div></h2></td>
                <td width="12%">&nbsp;</td>
                <td width="25%" align="right"><h2>Certificate Value: <div style="color:#B13427;">$'.$r[16].'</div></h2></td>
                <td width="28%">&nbsp;</td>
              </tr>
              <tr>
                <td><h1 style="color:#b0352b;font-size: 40px;">Home&nbsp;Depot&nbsp;</h1></td>
                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;Kohl&rsquo;s&nbsp;</h1></td>
                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;&nbsp;Target&nbsp;</h1></td>
                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;&nbsp;Visa&nbsp;Gift&nbsp;Card</h1></td>
              </tr>
            </table>
            <div class="clr" style="clear: both;"> </div>
            <div title="Page 1">
              <div>
                <div>
                  <div>
                    <h2 align="center">To redeem your gift card go to <a href="https://pypvouchers.com" style="color:#B13427; text-decoration:underline;" target="_blank">https://pypvouchers.com</a></h2>
                    <p style="margin-left:15px">Gift Card Terms &amp; Conditions: </p>
                    <ul>
                      <li> Capitol Marketing Concepts reserves the right to substitute a comparable gift card. </li>
                      <li> You have received this certificate as part of a business promotion. The business promoter who granted the certificate to you specifically conditions its redemption upon full payment to Capitol Marketing Concepts. </li>
                      <li> All taxes are the responsibility of the person receiving the redemption. </li>
                      <li> Certificates are completely transferable, but may not be resold under any circumstances. Notice of resell will void the certificate. </li>
                      <li> Once your certificate is received allow 2-4 weeks for processing and delivery. The package you selected will be sent to you via the US Postal Service. Failure to adhere to all Terms &amp; Conditions may hinder the processing of your certificate. </li>
                      <li> Offer not valid after expiration date under any circumstance. </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div></td>
        </tr>
        <tr>
          <td colspan="2"><h3 align="center">For Questions related to gift cards please call 1-888-411-7447</h3></td>
        </tr>
        <tr>
          <td width="408" style="padding-left: 150px;">Florida Seller of Travel Numbers for<br />
            Capitol Marketing Concepts: ST36176 </td>
          <td width="444" style="padding-right: 150px;" align="right"><strong>Expiration Date:</strong>'.$exp_date.'</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="background-image: url(https://www.pypvouchers.com/images/bottom.png); background-repeat: no-repeat; background-position: center top; height: 36px;"></div>
</div>'; 

	
//$body .= " $foot <br />";

	mail($to,$subject,$body,$headers);
	
			
			
		}
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$row_counter++; 
		
	   }else{
		   echo mysqli_error($con);
		   
		   
	   }
		
	 
	 
	 
	 
	// }
	 
	 
	 
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
        <tr>
        <td> Send Email</td>
         <!--<td><input type="checkbox" name="emailchk"     value="1" />	</td>-->
         <td><input type="checkbox" name="emailChk1_<?php echo $title['id']; ?>" onchange="changeData1(this.id)" id="emailChk1_<?php echo $title['id']; ?>" <?php  if($title['mail']=='1'){?> checked="checked" <?php }?> value="1" />	</td>
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
