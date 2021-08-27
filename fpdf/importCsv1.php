<?php
set_time_limit(90);

if (isset($_POST['btnSbt']))
 {
     if($_FILES['csvFile']['name']!="")
	 {
		 
	 require_once "simplexlsx.class.php";
	 $xlsx = new SimpleXLSX( $_FILES['csvFile']['tmp_name'] );	
	 list($cols, $row) = $xlsx->dimension();
	 foreach( $xlsx->rows() as $k => $r)
	 {
		 if ($k == 0)
		 continue;
		 /*$var0=$r[0];
		 $var1=$r[1];
		 $var2=$r[2];
		 $var3=$r[3];
		 $var4=$r[4];
		 $var5=$r[5];
		 $var6=$r[6];
		 $var7=$r[7];
		 $var8=$r[8];
		 $var9=$r[9];
		 $var10=$r[10];
		 $va11=$r[11];
		 $var12=$r[12];
		 $var13=$r[13];
		 $var14=$r[14];
		 $date2=date('d-m-Y', mktime(0,0,0,1,$var14-1,1900));
		 $var15=$r[15];
		 $date = date('d-m-Y', mktime(0,0,0,1,$var15-1,1900));
		 $var16=$r[16];
		 $var17=$r[17];
		 $var18=$r[18];
		 $var19=$r[19];
		 $var20=$r[20];
		 $var21=$r[21];*/
		 $var='';
		 if($r[0] != ''){
		 $d=date('m-d-Y', mktime(0,0,0,1,$r[14]-1,1900));
		 
		$e=date('m-d-Y', mktime(0,0,0,1,$r[15]-1,1900));
		
		$xpiryDate =date('Y-m-d', mktime(0,0,0,1,$r[15]-1,1900));
		$dateToday = date_create('now'); 
	  	 
		$days = (strtotime($xpiryDate) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
		
			 if($days<0){
			 $status =1;
		 }else{
			  $status =0;
		 }
		// $current_date =  $d=date('m-d-Y','now');
		 
		 
		 
$sql="INSERT INTO `capXlsx` (`cname`, `job`, `certificate`, `concatenated`, `amount`, `shipCost`, `received`, `fulfilled`, `first`, `last`, `street` ,`city`, `state`, `zip`, `beginredemption`, `expiration`, `choice01`, `choice02`, `choice03`, `choice04`, `choice05`, `choice06`, `choice07`, `choice08`, `choice09`, `choice10`, `choice11`, `choice12`, `choice13`, `choice14`, `choice15`, `choice16`, `choice17`, `choice18`, `choice19`, `choice20`, `choice21`, `choice22`, `choice23`, `choice24`, `choice25`, `status`) VALUES ('".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".$r[7]."','".$r[8]."','".$r[9]."','".$r[10]."','".$r[11]."','".$r[12]."','".$r[13]."','".$d."','".$e."','".$r[16]."','".$r[17]."','".$r[18]."','".$r[19]."','".$r[20]."','".$r[21]."','".$r[22]."','".$r[23]."','".$r[24]."','".$r[25]."','".$r[26]."','".$r[27]."','".$r[28]."','".$r[29]."','".$r[30]."','".$r[31]."','".$r[32]."','".$r[33]."','".$r[34]."','".$r[35]."','".$r[36]."','".$r[37]."','".$r[38]."','".$r[39]."','".$r[40]."','".$status."')";

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

<div><strong style="font-size: 20px;">You Can Import CSV OR XLSX File</strong></div>
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