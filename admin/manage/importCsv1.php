<?php
set_time_limit(90);

if (isset($_POST['btnSbt']))
 {
     if($_FILES['csvFile']['name']!="")
	 {
		 
	 require_once "simplexlsx.class.php";
	 $xlsx = new SimpleXLSX( $_FILES['csvFile']['tmp_name'] );	
	 
	 $date=date("m-d-Y [ g-i-s A ]",time());
	$up_date=date("m-d-Y, g:i:s A",time());
	$user_file	    = $_FILES['csvFile']['name'];
	$new_file_name  = $date.'-'.str_replace(' ','_',$user_file);
	move_uploaded_file($_FILES['csvFile']['tmp_name'],'uploads/'.$new_file_name);
	if(!mysqli_query($con, "INSERT INTO `upload` SET `type` = '2', `userData` = '".$new_file_name."',`date`='".$up_date."'")){
		echo mysqli_error($con);
	}
	 list($cols, $row) = $xlsx->dimension();
	 foreach( $xlsx->rows() as $k => $r)
	 {
		 if ($k == 0)
		 continue;
		
		 $var='';
		 if($r[0] != ''){
$sql="INSERT INTO `capXlsx` (`cname`, `job`, `certificate`, `concatenated`, `amount`, `shipCost`, `received`, `fulfilled`, `first`, `last`, `street` ,`city`, `state`, `zip`,`choice01`, `choice02`, `choice03`, `choice04`, `choice05`, `choice06`, `choice07`, `choice08`, `choice09`, `choice10`, `choice11`, `choice12`, `choice13`, `choice14`, `choice15`, `choice16`, `choice17`, `choice18`, `choice19`, `choice20`, `choice21`, `choice22`, `choice23`, `choice24`, `choice25`) VALUES ('".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".$r[7]."','".$r[8]."','".$r[9]."','".$r[10]."','".$r[11]."','".$r[12]."','".$r[13]."','".$r[16]."','".$r[17]."','".$r[18]."','".$r[19]."','".$r[20]."','".$r[21]."','".$r[22]."','".$r[23]."','".$r[24]."','".$r[25]."','".$r[26]."','".$r[27]."','".$r[28]."','".$r[29]."','".$r[30]."','".$r[31]."','".$r[32]."','".$r[33]."','".$r[34]."','".$r[35]."','".$r[36]."','".$r[37]."','".$r[38]."','".$r[39]."','".$r[40]."')";

		if(mysqli_query($con, $sql))
		{
				$im="yes";
	   }else{
		   echo mysqli_error($con);
		   
		   
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

<div><strong style="font-size: 20px;">You Can Import XLSX File For Certificates</strong></div>
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