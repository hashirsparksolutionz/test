<?php
//echo date('d-M-Y',$unixDateVal);
if(isset($_POST['check']))
{   
   
	$certi=$_POST['certi'];
	$sql="select * from capXlsx  where certificate='".$certi."'";
	$res=mysqli_query($con,$sql);
	$certificate=mysqli_fetch_assoc($res);
	//echo $certificate['certificate']; 
	if($certificate['certificate']==$certi)
	 {
		 //$date = date('Y-m-d', mktime(0,0,0,1,$certificate['expiration']-1,1900));
		 // $date = date('Y-m-d', mktime(0,0,0,1,$var15-1,1900));
		 $currentDate = date("d-m-Y");
         //echo $currentDate."<br/>";
		 //echo $certificate['expiration']."<br>";
		 if(strtotime($currentDate)<strtotime($certificate['expiration']))
		 {
		   echo "yes you are eligible";
		 }
		else
		{
		   echo "you are expired";
		 //echo $date;
		}
	 }
	 else
	 {
		 echo "Not Matched";
	 }
}
?>
<form action="" method="post" enctype="multipart/form-data" name="certificate">
<table>
<tr>
<td>
<label>Certificate</label>
</td>
<td>
<input type="text" name="certi" id="certi" />
</td>
</tr>
<tr>
<td>
<input type="submit" name="check" value="check" />
</td>
</tr>
</table>
</form>
<?php


?>