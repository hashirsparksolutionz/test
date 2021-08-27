<?php
set_time_limit(90);
$desc = array();
if (isset($_POST['btnSbt']))
 {
	$Db_cat = array();
	$Db_sub_cat = array();
	$Db_sub_cat_id = array();
	$Excel_cat = array(); 
	$Db_cat_id = array(); 
	$Db_cat_name = array();
	$Excel_subcat = array();
	$cat_qry= mysqli_query($con, "Select * from catagories WHERE parent_id ='0'");
	  while($cat_qry_rec= mysqli_fetch_array($cat_qry))
	{
		array_push($Db_cat,$cat_qry_rec['sponsername']);
		$Db_cat_id[$cat_qry_rec['sponsername']]= $cat_qry_rec['id'];
		
		$Db_cat_name[$cat_qry_rec['id']]= $cat_qry_rec['sponsername'];
	}
	
	$sub_cat_qry= mysqli_query($con, "Select * from catagories WHERE parent_id !='0'");
	  while($sub_cat_qry_rec= mysqli_fetch_array($sub_cat_qry))
	{
		array_push($Db_sub_cat,$sub_cat_qry_rec['sponsername'] .' '.$Db_cat_name[$sub_cat_qry_rec['parent_id']]);
		
		
		
		$Db_sub_cat_id[$sub_cat_qry_rec['sponsername']]= $sub_cat_qry_rec['id'];
	}

	 
     if($_FILES['csvFile']['name']!="")
	 {
		 $file_src='csv';
    move_uploaded_file($_FILES['csvFile']['tmp_name'],'./'.$_FILES['csvFile']['name']); 
	 require_once "simplexlsx.class.php";
	 $xlsx = new SimpleXLSX($_FILES['csvFile']['name']);	
	 list($num_cols, $num_rows) = $xlsx->dimension(2);
	$old_data = array();
//$csvFile= 'Sandiego12.csv';
	$qry= mysqli_query($con, 'Select cmc_number from products');

	while($raw= mysqli_fetch_array($qry))
	{
		array_push($old_data,$raw['cmc_number']);
		
		
		
		
	}
 
     foreach( $xlsx->rows(2) as $m => $r ) 
	 {
		
		  if ($m == 0)
		 continue;
		
		array_push($desc,$r[0]);
		
     }
    
	 

	 $counter=0;
	 $record=0;
	 
	 
	 list($cols, $row) = $xlsx->dimension();
	 foreach($xlsx->rows() as $k => $r)
	 {
		 
		 
		
		 if ($k == 0)
		 continue;
		
		if($r[0] !='' && mysqli_real_escape_string($con,$r[1]) !='' && mysqli_real_escape_string($con,$r[3]) !='' ){ 
	if(!in_array($r[3],$old_data)){
		$image =$r[13].".jpg";
	
		$sqlo="INSERT INTO `products` (`category`,`sub_cat`,`model_number`,`cmc_number`,`subcategory_desc`,`itemcost`,`handling_cost`,`freight_cost`,`tax`,`markup`,`sale_price`,`retail_cost`,`PointCount`,long_des, image) VALUES ('".mysqli_real_escape_string($con,$r[0])."','".mysqli_real_escape_string($con,$r[1])."','".mysqli_real_escape_string($con,$r[2])."','".mysqli_real_escape_string($con,$r[3])."','".mysqli_real_escape_string($con,$r[4])."','".mysqli_real_escape_string($con,$r[5])."','".mysqli_real_escape_string($con,$r[6])."','".mysqli_real_escape_string($con,$r[7])."','".mysqli_real_escape_string($con,$r[8])."','".mysqli_real_escape_string($con,$r[9])."','".mysqli_real_escape_string($con,$r[10])."','".mysqli_real_escape_string($con,$r[11])."','".number_format(mysqli_real_escape_string($con,$r[12]))."','".mysqli_real_escape_string($con,$desc[$counter])."','".$image."')";
		if(!mysqli_query($con, $sqlo)){
			echo mysqli_error($con);
		}else{
			array_push($Excel_cat,mysqli_real_escape_string($con,$r[0]));
			array_push($Excel_subcat,$r[1]);
			
		}
$record++;
	}
$counter++;


		 
		
		
		 }
	 }	
	 for($i=0;$i<count($Excel_cat); $i++)
	 {
		// $qry1= mysqli_query($con, "Select * from catagories WHERE sponsername='$cat[$i]' AND parent_id ='0'");
		// $count =mysqli_num_rows($qry1);
		 if(!in_array($Excel_cat[$i],$Db_cat)){
			 
		//$var=$Excel_cat[$i];
		$total_gens = mysqli_query($con, "select * from catagories where parent_id='0'");
			$totalcats = mysqli_num_rows($total_gens);
			$totalcats++;
			
			$sql="INSERT INTO `catagories` (`sponsername`, `parent_id`, `cat_order`) VALUES ('".$Excel_cat[$i]."', '0', '".$totalcats."')";
	//	$sql="INSERT INTO `catagories` (`sponsername`, `parent_id`) VALUES ('".$Excel_cat[$i]."', '0')";
		mysqli_query($con, $sql);
		array_push($Db_cat,$Excel_cat[$i]);
		$Db_cat_id[$Excel_cat[$i]]= mysqli_insert_id($con);
		//mysqli_insert_id($con); 
		 }
		 }
		 
	 for($j=0;$j<count($Excel_subcat); $j++)
	 {
		$rec = $Excel_subcat[$j].' '. $Excel_cat[$j];
		
		 if(!in_array($rec,$Db_sub_cat)){
			 
			 
			 
			 
			 
			 array_push($Db_sub_cat,$rec);
			// $var1=mysqli_real_escape_string($con,htmlentities($_POST['s_cata']));
			// $var2=mysqli_real_escape_string($con,htmlentities($_POST['cato']));

			$total_gens = mysqli_query($con, "select * from catagories where parent_id='".$Db_cat_id[$Excel_cat[$j]]."'");
			$total = mysqli_num_rows($total_gens);
			$total++;
			 
		//$var=$Excel_cat[$i];
		$sql2="INSERT INTO `catagories` (`sponsername`, `parent_id`, `cat_order`) VALUES ('".$Excel_subcat[$j]."', '".$Db_cat_id[$Excel_cat[$j]]."', '".$total."')";
		mysqli_query($con, $sql2);
		 }
		 }
		 
   }
   else
   {
	   $mes=$record." imported";
   }
}
?>
<div class="inner_cat_div">
<div class="go-back-div" style=" margin-right:5px;"><a href="javascript:history.go(-1)">« Go Back </a></div><div class="clr"></div>
<div class="cat-heding">You Can Import CSV OR XLSX File for Uploading Products</div>
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
	 echo "<div class='alert alert-success'  id='alert alert-success'>Please Select File</div>";
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
 </div>