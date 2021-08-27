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



<script type="text/javascript">
function reg_user()
{
	
	
	if(document.userinfo.csvFile.value=='')
	{
		document.userinfo.csvFile.focus();
		document.getElementById('csvFilex').innerHTML='Please Select file!';
		return false;
	}
	else
	{
		document.getElementById('csvFilex').innerHTML='';
	}	
	
	
	
	var str = document.userinfo.csvFile.value;
	var res = str.split(".");
	
	if(res[1] != 'xlsx'){
		//alert('not csv or xlsx');
		document.getElementById('csvFilex').innerHTML='Please select valid file!';
		return false;
		}
		else
		{
			//alert('csv or xlsx');
			document.getElementById('csvFilex').innerHTML='';
		}	
	
	return true;
} 

	</script>


<?php

//url(images/email_header.png);

set_time_limit(90);

$create=date('m-d-Y');
$url=$_SERVER['SERVER_NAME'];
$datetime = date('m/d/Y h:i:s a', time());

////////////////////////////////////////////////////// For FETCHING NEWSLETTER FROM DATABASE////////////////////////////////////////

$rslt=mysqli_query($con, "SELECT * FROM  `web_info` WHERE id ='1'");



$title=mysqli_fetch_array($rslt);



$web= $title['name'];



$link= $title['link'];

$mail= $title['mail'];



$color= $title['color'];

$mailinfo= $title['mail'];

if($_POST['emailchk'])

{

	echo 'Checked';

}



$rslt1=mysqli_query($con, "SELECT * FROM `users` WHERE  id ='1'");



$title1=mysqli_fetch_array($rslt1);



$admin= $title1['email'];





 




 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$voucher=array();

$job=array();
$dup=array();



function clean($string) {

	$string = str_replace("-", "", $string);

   $string = str_replace(" ", "", $string); // Replaces all spaces with hyphens.

   $string = preg_replace('/[^0-9\-]/', '', $string); // Removes special chars.



   return preg_replace('/-+/', '', $string); // Replaces multiple hyphens with single one.

}
function AlphaNumeric($string) {
	if(preg_match('/^[a-zA-Z0-9]+$/', $string)  || preg_match('/^[0-9]*$/', $string))
		{		
			$ch = strlen($string);
			if($ch <= 11)
				$res = "Valid";
			else
				$res = "inValid";
			}
		else	{	
			$res = "inValid";	
			}
		return $res;

}

function replace($string) {

	$string = str_replace("-",  " ", $string);

   $string = str_replace(".", " ", $string); // Replaces all spaces with hyphens.

   $string = preg_replace('/[^0-9\-]/', '', $string); // Removes special chars.



   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.

}

function onlyAlphabets($string) {

	$string = str_replace("-", " ", $string);

  // $string = str_replace(" ", "", $string); // Replaces all spaces with hyphens.

   $string = preg_replace('/[^a-zA-z]/s','',$string);// Removes special chars.



   return preg_replace('/-+/', '', $string); // Replaces multiple hyphens with single one.

}

function special_chars($string) {

	$string = str_replace("-", " ", $string);

  // $string = str_replace(" ", "", $string); // Replaces all spaces with hyphens.

   $string = preg_replace('/[^a-zA-z0-9 ]/s',' ',$string);// Removes special chars.



   return preg_replace('/-+/', '', $string); // Replaces multiple hyphens with single one.

}







$num=count($voucher);



if (isset($_POST['btnSbt']))
 {
/*
echo "<pre>";
	print_r($_POST);
echo "</pre>";
die();
*/

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

	

	

	 $date=date("m-d-Y [ g-i-s A ]",time());

	$up_date=date("m-d-Y, g:i:s A",time());

	$user_file	    = $_FILES['csvFile']['name'];

	$new_file_name  = $date.'-'.str_replace(' ','_',$user_file);

	move_uploaded_file($_FILES['csvFile']['tmp_name'],'uploads/'.$new_file_name);



	if(!mysqli_query($con, "INSERT INTO `upload` SET `type` = '1', `userData` = '".$new_file_name."',`date`='".$up_date."'")){

		echo mysqli_error($con);

	}

	

	

	

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

		 if($r[2] != ''){

			
			 

		$c=date('m-d-Y', mktime(0,0,0,1,$r[9]-1,1900));
		$br=date('m-d-Y', mktime(0,0,0,1,$r[10]-1,1900));
		$e=date('m-d-Y', mktime(0,0,0,1,$r[11]-1,1900));
		if($r[6]!=''){
		$shp=date('m-d-Y', mktime(0,0,0,1,$r[6]-1,1900));
		}

	

			if(AlphaNumeric($r[2]) == "inValid"){
				array_push($dup,$r[2]);
				$_SESSION['dup']=$dup;
				
			}else{
						$cant=$r[2];
						//echo "SELECT * FROM `capXlsx` WHERE certificate='".$cant."'";
						//echo "<br/>"; 
						
						$r25 = mysqli_query($con, "SELECT * FROM `capXlsx` WHERE certificate='".$cant."'");
						$num25 = mysqli_num_rows($r25);
						if($num25>0){
							
							array_push($dup,$cant);
							$_SESSION['dup']=$dup;

							}else{
		
								$sql="INSERT INTO `userinfo` SET `voucherNumber`='".$r[2]."',`vocher`='".$cant."', `jobnumber`='".clean($r[1])."', `fname`='".onlyAlphabets($r[16])."', `lname`='".onlyAlphabets($r[17])."', `address1`='".special_chars($r[18])."',`address2`='".special_chars($r[19])."',`city`='".onlyAlphabets($r[20])."',`state`='".onlyAlphabets($r[21])."',`zip`='".substr(clean($r[22]),0,5)."',`phone`='".clean($r[23])."',`email`='".$r[24]."',`CustomerOrder`='".$r[14]."',`Exported`='".$r[15]."',`Demonination`='".clean($r[25])."',`InvoiceNumber`='".$r[26]."',`createdOn`='".$c."', `beginredemption`='".$br."', `expiration`='".$e."',`todaydate`='".$orig_date."',`Timestamp_add`='".$datetime."'";	

								if(mysqli_query($con, $sql))
								{

									$id1 =mysqli_insert_id($con);

								  $certeficate="INSERT INTO `capXlsx` SET `cname`='".onlyAlphabets($r[0])."', `job`='".clean($r[1])."', `voucherNumber`='".$r[2]."', `certificate`='".$cant."', `concatenated`='".$cant."', `amount`='".clean($r[5])."', `shipCost`='".$shp."', `received`='".$r[7]."', `fulfilled`='".$r[8]."', `first`='".onlyAlphabets($r[16])."', `last`='".onlyAlphabets($r[17])."', `street`='".special_chars($r[18])."',`address2`='".special_chars($r[19])."', `city`='".onlyAlphabets($r[20])."', `state`='".special_chars($r[21])."', `zip`='".substr(clean($r[22]),0,5)."', 
								
								`choice01`='".mysqli_real_escape_string($con, $r[27])."',
								`choice02`='".mysqli_real_escape_string($con, $r[28])."', 
								`choice03`='".mysqli_real_escape_string($con, $r[29])."', 
								`choice04`='".mysqli_real_escape_string($con, $r[30])."', 
								`choice05`='".mysqli_real_escape_string($con, $r[31])."',
								`choice06`='".mysqli_real_escape_string($con, $r[32])."',
								`choice07`='".mysqli_real_escape_string($con, $r[33])."', 
								`choice08`='".mysqli_real_escape_string($con, $r[34])."', 
								`choice09`='".mysqli_real_escape_string($con, $r[35])."',
								`choice10`='".mysqli_real_escape_string($con, $r[36])."',
								`choice11`='".mysqli_real_escape_string($con, $r[37])."',
								`choice12`='".mysqli_real_escape_string($con, $r[38])."',
								`choice13`='".mysqli_real_escape_string($con, $r[39])."',
								`choice14`='".mysqli_real_escape_string($con, $r[40])."',
								`choice15`='".mysqli_real_escape_string($con, $r[41])."',
								`choice16`='".mysqli_real_escape_string($con, $r[42])."',
								`choice17`='".mysqli_real_escape_string($con, $r[43])."',
								`choice18`='".mysqli_real_escape_string($con, $r[44])."',
								`choice19`='".mysqli_real_escape_string($con, $r[45])."',
								`choice20`='".mysqli_real_escape_string($con, $r[46])."',
								
								`beginredemption`='".$br."',`expiration`='".$e."',`Timestamp_add`='".$datetime."'";

								mysqli_query($con, $certeficate);

		
								$im="yes";

				////////////////////////////////////////////////////////////////// FOR SENDING NEWSLETTER WITH VOUCHERS////////////////

						if($r[24]!='' && isset($_POST['confirm'])){
							

						$to      =  $r[24]; 

		

						mysqli_query($con, "UPDATE `userinfo` SET mailRe='1' WHERE `id`='".$id1."'");
							
						$subject = $web; 
						$headers 	= "From: ".$web."<".$mailinfo.">".PHP_EOL;
						$headers .= "MIME-Version: 1.0".PHP_EOL;
						$headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
						//$body = " $head <br />";

						$to  =  $r[24]; 
							
						$subject = $web; 
						$headers 	= "From: ".$web."<".$mailinfo.">".PHP_EOL;
						$headers .= "MIME-Version: 1.0".PHP_EOL;
						$headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
						
						$r = mysqli_query($con, "select * from newsletter") or die(mysqli_error($con));
						$body = "";
						if(mysqli_num_rows($r) > 0){
							
							$row = mysqli_fetch_assoc($r);
							$body = $row['body'];
						}else{
							
							$body = "";
						}
						
						$sitename="";
						$body=str_replace('$cert',$cant,$body);
						$body=str_replace('$url',$url,$body);
						$body=str_replace('$expiry date',$e,$body);
						$body=str_replace('$sitename',$sitename,$body);
							
						mail($to,$subject,$body,$headers);
						

			

			

					}


				$row_counter++; 

		

			}else{

				echo mysqli_error($con);
			}
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

  <form name="userinfo" id="userinfo" onSubmit="return reg_user();" method="post" enctype="multipart/form-data">

    <table width="100%" border="0" cellpadding="5" cellspacing="10">

      <tr align="center">

        <td colspan="2" align="center"></td>

      </tr>

      <tr align="center">

        <td width="250"><input class="btn btn-small btn-success" name="csvFile" type="file" /></td>

			<input type="hidden" name="check"  value="yes"/>
			<tr><td> <span style="color:red" id="csvFilex" ></span></td><td>&nbsp;</td></tr>
			<tr><td>&nbsp;&nbsp;&nbsp;<input type="checkbox" id="confirm" name="confirm" value="yes"><label for="confirm" style="
    float: right;
    margin-right: 97px;line-height: 23px;"><span>Send email to users</label></td></tr>
			<tr><td>&nbsp;&nbsp;&nbsp;</td></tr>
        <td >&nbsp;&nbsp;&nbsp;<input type="submit" name="btnSbt" class="btn" id="btnSbt" value="Submit" /></td>

        </tr>

        <!--<tr>

        <td> Send Email</td>

      

         <td><input type="checkbox" name="confirm" />	</td>

      </tr>-->

    </table>

  </form>

</div>
 <div style="margin-bottom:15px" ><a href="../sheet_sample/PYT_Sheet_Sample.xlsx" >Download Sample File</a></div>

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
<?php
if(isset($_SESSION['dup'])){
	?>
	<table style="width:500px;" border="1">
    <tr>
    	<td colspan="2">These certificate numbers are not saved due to duplication or invalid certificate.</td>
    </tr>
    	<tr>
    		<th>&nbsp;</th>
            <th>Certificate Number</th>
   		 </tr>
	<?php
	foreach($_SESSION['dup'] as $k=>$v){
		?>
		<tr>
        	<td><?php echo $k+1;?></td>
        	<td><?php echo $v;?></td>
        </tr>
		<?php
		}?>
		</table>
		<?php
	
    }
	unset($_SESSION['dup']);
 ?>

