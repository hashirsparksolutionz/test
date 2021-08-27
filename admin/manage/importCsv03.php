<?php
	set_time_limit(90);	
	require_once "simplexlsx.class.php";
	function importCsvFile($csvFile,$tableName,$oldData,$Type,$order,$username,$userOrder){
			require_once "simplexlsx.class.php";
	
	
			if($Type =='csv'){
			if (($handle = fopen($csvFile, "rb")) === FALSE){
				return false;	
			}
		
		  	while(($data = fgetcsv($handle, ",")) !== FALSE) {
		    	$row++;
		    	if($row==1){
					$colmn="`points`,`email`";
		    		$insertStr .= "(".$colmn.") VALUES ";
			
		    		continue;
		    	}
			
				if(in_array($data[8], $oldData) || in_array($data[9], $username)){
				
//echo "UPDATE {$tableName} SET points = '".$data[5]."' WHERE email = '".$data[8]."' OR username ='".$data[9]."'";
 $query = mysqli_query($con, "UPDATE {$tableName} SET points = '".$data[6]."' WHERE email = '".$data[8]."' OR username ='".$data[9]."'");
		$valid .= '<tr>';
		$valid .= '<td>'.$data[0].'</td>'.'<td>'.$data[1].'</td>'.'<td>'.$data[2].'</td>'.'<td>'.$data[3].'</td>'.'<td>'.$data[4].'</td>'.'<td>'.$data[5].'</td>'.'<td>'.$data[6].'</td>'.'<td>'.$data[7].'</td>'.'<td>'.$data[8].'</td>'.'<td>'.$data[9].'</td></tr>';
			if(isset($order[$data[8]])||isset($userOrder[$data[9]])){
			
			//echo "UPDATE orders SET pendig = '1' WHERE (user_id='".$order[$data[8]]."' OR user_id='".$userOrder[$data[9]]."') AND pendig= '0'";
			
			$query = mysqli_query($con, "UPDATE orders SET pendig = '1' WHERE (user_id='".$order[$data[8]]."' OR user_id='".$userOrder[$data[9]]."') AND pendig= '0'");
			}
		
				}else{
				
			//	$query = mysqli_query($con, "UPDATE {$tableName} SET points = '".$r[9]."' WHERE email = '".$r[8]."'");
		$invalid .= '<tr>';
		$invalid .= '<td>'.$data[0].'</td>'.'<td>'.$data[1].'</td>'.'<td>'.$data[2].'</td>'.'<td>'.$data[3].'</td>'.'<td>'.$data[4].'</td>'.'<td>'.$data[5].'</td>'.'<td>'.$data[6].'</td>'.'<td>'.$data[7].'</td>'.'<td>'.$data[8].'</td>'.'<td>'.$data[9].'</td></tr>';
				}
		    }
		    
		
	    	fclose($handle);
			return array($invalid,$valid );
		
		}else if($Type =='xlsx'){
			$xlsx = new SimpleXLSX($csvFile);
			list($cols,) = $xlsx->dimension();
			foreach( $xlsx->rows() as $k => $r) {
		if ($k > 0) {
		
		if(in_array($r[8], $oldData) || in_array($r[9], $username)){
		//echo	"UPDATE {$tableName} SET points = '".$r[5]."' WHERE email = '".$r[8]."' OR username ='".$r[9]."'";	
		 $query = mysqli_query($con, "UPDATE {$tableName} SET points = '".$r[6]."' WHERE email = '".$r[8]."' OR username ='".$r[9]."'");
		$valid .= '<tr>';
		$valid .= '<td>'.$r[0].'</td>'.'<td>'.$r[1].'</td>'.'<td>'.$r[2].'</td>'.'<td>'.$r[3].'</td>'.'<td>'.$r[4].'</td>'.'<td>'.$r[5].'</td>'.'<td>'.$r[6].'</td>'.'<td>'.$r[7].'</td>'.'<td>'.$r[8].'</td>'.'<td>'.$r[9].'</td></tr>';
		
		
		if(isset($order[$r[8]])||isset($userOrder[$r[9]])){
		//echo "UPDATE orders SET pendig = '1' WHERE (user_id='".$order[$r[8]]."' OR user_id='".$userOrder[$r[9]]."') AND pendig= '0'";
			$query = mysqli_query($con, "UPDATE orders SET pendig = '1' WHERE (user_id='".$order[$r[8]]."' OR user_id='".$userOrder[$r[9]]."') AND pendig= '0'");
			
			
			}
		
				}else{	
		$invalid .= '<tr>';
		$invalid .= '<td>'.$r[0].'</td>'.'<td>'.$r[1].'</td>'.'<td>'.$r[2].'</td>'.'<td>'.$r[3].'</td>'.'<td>'.$r[4].'</td>'.'<td>'.$r[5].'</td>'.'<td>'.$r[6].'</td>'.'<td>'.$r[7].'</td>'.'<td>'.$r[8].'</td>'.'<td>'.$r[9].'</td></tr>';
				}
		

		}
	}
			$row= array($invalid,$valid );
			return $row;
			
			
		}
	}
	
?>
<?php ?>
<?php
$mes  = $_GET['mes'];
if($mes=="imported"){ echo "<div id='ErrorMsg'>Your CSV File Has Been Imported Successfully</div>"; }
if(isset($_POST['btnSbt'])){

$allowed 	= array('csv','xlsx');	
	
$csvFile	=  $_FILES['csvFile']['name'];
$ext = end(explode('.',$csvFile));
/////////////////////////////////////////////////////////////





//////////////////////////////////////////////////////////////////
$extension  = pathinfo($csvFile, PATHINFO_EXTENSION);
//echo $ext;
if($ext!='csv' && $ext!='xlsx'){?>
<script type="text/javascript" language="javascript">
alert("Please Upload File With .csv or xlsx Extension Only");
//window.location.href = "?p=importCsv";
</script>
<?php

}else{
	

$old_data = array();
$userdata = array();
$orderdata = array();
$old_data_user= array();
$qry= mysqli_query($con, 'select * from members');

while($raw= mysqli_fetch_array($qry))
{	
	/*$order_qry= mysqli_query($con, 'select * from orders where user_id="'.$raw['id'].'" AND pendig= "0"');
	$order_row= mysqli_fetch_array($order_qry);*/
	
	$orderdata[$raw['email']] = $raw['id'];
	$orderdata_user[$raw['username']] = $raw['id'];
	
	//$userdata[$raw['email']] = $raw['id'];
	array_push($old_data,$raw['email']);
	array_push($old_data_user,$raw['username']);
	
}
/*for($i=0;$i<count($old_data);$i++){
	$order_qry= mysqli_query($con, 'select * from orders where user_id="'.$userdata[$old_data[$i]].'" AND pendig= "0"');
	$order_row= mysqli_fetch_array($order_qry);
	$orderdata[$old_data[$i]] = $order_row['id'];
	
}*/
//$truncateTable = mysqli_query($con, 'TRUNCATE TABLE active_test');

move_uploaded_file($_FILES['csvFile']['tmp_name'],'../csv/'.$csvFile);

$r = importCsvFile('../csv/'.$csvFile, 'members', $old_data,$ext,$orderdata,$old_data_user,$orderdata_user)or die();


	}
?>
<script type="text/javascript" language="javascript">
//window.location.href = "?p=importCsv&mes=imported";
</script>
<?php }?>
<div><strong style="font-size: 20px;">You Can Import CSV OR XLSX File</strong></div>
<div style="margin-top: 85px; width: 375px; margin-left: 245px; background-color: #EDEDED; margin-bottom: 85px;">

  <form action="" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" cellpadding="5" cellspacing="10">
      <tr align="center">
        <td colspan="2" align="center"></td>
      </tr>
      <tr align="center">
        <td width="250"><input class="btn btn-small btn-success" name="csvFile" type="file" /></td>
        <td ><input type="submit" name="btnSbt" class="btn" id="btnSbt" value="Submit" /></td>
      </tr>
    </table>
  </form>
</div>
 <?php if(isset($_POST['btnSbt'])){?>
 <div>
 <?php
 	 echo "<div class='alert alert-success'>Your ".$ext." File Has Been Imported Successfully </div><br/>"; ?>
 	<table  border="1" style="background-color: #EDEDED;">
   
  <?php if($r[1]!=''){?> 
  <tr align="center"><td colspan="10" align="center"><strong style="font-size: 20px;">Following Email Addresses Are Present In Database</strong></td></tr>
  <th>First Name</th><th>Last Name</th><th>Address 1</th><th>Address 2</th><th>City</th><th>State</th><th>Zip</th><th>Phone</th><th>Email</th><th>Points</th>
 	<?php 
   	echo $r[1];}
   if($r[0]!=''){?>
	<tr><td colspan="10" align="center"><strong style="font-size: 20px;">Following Email Addresses Are Not Present In Database</strong></td></tr>
    <th>First Name</th><th>Last Name</th><th>Address 1</th><th>Address 2</th><th>City</th><th>State</th><th>Zip</th><th>Phone</th><th>Email</th><th>Points</th>
    <?php
   	echo $r[0];
   }
   ?>
    </table>
 
 </div>
 
 <?php } ?>
