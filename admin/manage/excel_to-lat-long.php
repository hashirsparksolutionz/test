<?php
include("../includes/myconn.php");
/*$con = mysqli_connect("localhost","root","");
mysqli_select_db("devshop4_shop4agents",$con) or trigger_error(mysqli_error($con));*/
if (isset($_FILES['file'])) {
	
	require_once "simplexlsx.class.php";
	//echo 'dgdfgs'.$_FILES['file']['tmp_name'];
	$File	=  $_FILES['file']['name'];
	//$xlsx = new SimpleXLSX($_FILES['file']['tmp_name']);
	
	echo '<h1>Parsing Result</h1>';
	echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';
	?>
    <th>City</th><th>NW</th><th>NE</th><th>SE</th><th>SW</th>
    <?php
	$xlsx = new SimpleXLSX($File);
			list($cols,) = $xlsx->dimension();
			foreach( $xlsx->rows() as $k => $r) {
		if ($k > 0) {
		echo '<tr>';
		echo '<td>'.$r[0].'</td>';
	//	for( $i = 3; $i < $cols; $i++)
	//	{
				$k=lat_long($r[3]);
				echo '<td>'.$k[0].",-".$k[1].'</td>';
				$nw=$k[0].",-".$k[1];
				$l=lat_long($r[4]);
				echo '<td>'.$l[0].",-".$l[1].'</td>';
				$ne=$l[0].",-".$l[1];
				$m=lat_long($r[5]);
				echo '<td>'.$m[0].",-".$m[1].'</td>';
				$se=$m[0].",-".$m[1];
				$n=lat_long($r[6]);
				echo '<td>'.$n[0].",-".$n[1].'</td>';
				$sw=$n[0].",-".$n[1];
	//	}
		echo '</tr>';
	mysqli_query($con, "INSERT INTO `cities` SET `city_name`='".$r[0]."',`nw`='".$nw."',`ne`='".$ne."',`se`='".$se."',`sw`='".$sw."'");
		
		}
	}
	echo '</table>';
}
function lat_long($val)
{
	$lat=explode(' ',$val);
	$lat_val=$lat[0];
	$long_val=$lat[1];
	////////////////////////////////////////////////////////////////////////////// latitude
	$lat_d=explode('°',$lat_val);
	if($lat_d[0]<0)
	{
	$latsign=-1;
	}else{
		$latsign=1;
		}
	$lat_d1=$lat_d[0];
	$lat_m=explode("'",$lat_d[1]);
	$lat_m1=$lat_m[0];
	
	$str=str_replace('"','-',$lat_m[1]);
	$lat_s=explode('-',$str);
	$lat_sec=$lat_s[0]/3600;
	$lat_final_value=$lat_d1+(($lat_m1/60)+$lat_sec);
	$lat_final_value=round($lat_final_value,'5');
	////////////////////////////////////////////////////////////////////////////// Longitude
	$long_d=explode('°',$long_val);
	if($long_d[0]<0)
	{
	$longsign=-1;
	}else{
		$longsign=1;
		}
	$long_d2=$long_d[0];
	$long_m=explode("'",$long_d[1]);
	$long_m2=$long_m[0];
	$str2=str_replace('"','-',$long_m[1]);
	$long_s=explode('-',$str2);
	$long_s2=$long_s[0]/3600;
	$long_final_value=$long_d2+(($long_m2/60)+$long_s2);
	$long_final_value=round($long_final_value,'5');
	$result=array($lat_final_value,$long_final_value);
	//$result=array($lat_final_value,$lat_d1,$lat_m1/60,$lat_sec);
	return($result);
}
?>
<h1>Upload</h1>
<form method="post" enctype="multipart/form-data">
*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>
