<?php
set_time_limit(90);
if (isset($_FILES['file'])) {
	
	require_once "simplexlsx.class.php";
	
	$xlsx = new SimpleXLSX( $_FILES['file']['tmp_name'] );
	

	
	list($cols, $row) = $xlsx->dimension();
	//echo $row."<br>";
	//echo $cols."<br>";
	//$obj=$xlsx->row();
	//var_dump($xlsx->row());
	//print_r ($xlsx->rows());
	echo "<br>";
	//$var= $xlsx->rows();
	
	$arr=array();
	foreach( $xlsx->rows() as $k => $r)
	 {
		 if ($k == 0)
		 continue;
		 $var0=$r[0];
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
		 $var15=$r[15];
		 $var16=$r[16];
		 $var17=$r[17];
		 $var18=$r[18];
		 $var19=$r[19];
		 $var20=$r[20];
$sql="INSERT INTO `capXlsx` (`cname`, `job`, `certificate`, `concatenated`, `amount`, `shipped`, `received`, `fulfilled`, `first`, `last`, `street`, `city`, `zip`, `state`, `beginredemption`, `expiration`, `choice01`, `choice02`, `choice03`, `choice04`, `choice05`) VALUES ('".$var0."','".$var1."','".$var2."','".$var3."','".$var4."','".$var5."','".$var6."','".$var7."','".$var8."','".$var9."','".$var10."','".$var11."','".$var12."','".$var13."','".$var14."','".$var15."','".$var16."','".$var17."','".$var18."','".$var19."','".$var20."')";
		if(mysqli_query($con, $sql))
		{
			$im="yes";
		}
	}
	if(isset($im))
	{
		echo "xlsx import sucessfully";
	}
	//print_r( $xlsx->rowsEx());
	$count=1;
		echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';
	foreach( $xlsx->rows() as $k1 => $r1)
	 {
		
		echo '<tr>';
		echo '<td>'.$count.'</td>';
		for( $i = 0; $i < $cols; $i++)
		{
			
			echo '<td>'.( (isset($r1[$i])) ? $r1[$i] : '&nbsp;' ).'</td>';

		}
		echo '</tr>';
		$count++;
	}
	echo '</table>';
}
else
{
	echo "plz select file";
}

?>
<h1>Upload Xlsx</h1>
<form method="post" enctype="multipart/form-data">
Select File <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="import" />
</form>
