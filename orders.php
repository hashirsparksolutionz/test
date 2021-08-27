
<!--<form action="?p=orders" method="post" enctype="multipart/form-data" name="csv">
<input type="hidden" name="waqas" value="yes" />
<input type="submit" name="submit" value=" Import csv" />
</form>-->
<?php


///////////////////////////////////////////////////////////////////////////////////////////////////////





$fp = fopen('new.csv', 'w');
$columns = 'Order id,Name,Username,User points,Products Name,Product Quantity,Product Points';
fputcsv($fp,explode(',',$columns));




$count='0';
$info= array();
$query="select * from orders";
$rslt=mysqli_query($con,$query);
$fp = fopen('new.csv', 'w');
$columns = 'Order id,Name,Username,User points,Products Name,Product Quantity,Product Points';
fputcsv($fp,explode(',',$columns));

echo "<table border='0' width='100%' class='TableHeader'>
    <tr>
<td width='44' align='left' valign='middle' ><strong><font style='font-family:Arial, Helvetica, sans-serif; '>Sr#</font></strong></td>
      <td width='170' align='left' valign='middle' ><strong>User Details</strong></td>
      <td width='210' align='left' valign='middle' ><strong><font style='font-family:Arial, Helvetica, sans-serif; '>Order Details</font></strong></td>
     <td width='200' align='left' valign='middle' ><strong><font style='font-family:Arial, Helvetica, sans-serif; '>Product Details</font></strong></td>
    </tr>
  </table>";
echo "<table width='100%' class='table table-striped' border='0'>";
while($rw=mysqli_fetch_assoc($rslt))
{ 
$count++;
$info['id']=$rw['id'];
$info['user_id']=$rw['user_id'];
$info['order_date']=$rw['order_date'];
$info['total_points']=$rw['total_points'];
$query1="select * from members  where id='".$rw['user_id']."'";
$rslt1=mysqli_query($con,$query1);
$rw1=mysqli_fetch_array($rslt1);
$info['fname']=$rw1['fname'];
$info['username']=$rw1['username'];
$info['Upoints']=$rw1['points'];

$query2="select * from order_detail where order_id='".$rw['id']."'";
$rslt2=mysqli_query($con,$query2);
$rw2=mysqli_fetch_array($rslt2);
$info['prd_name']=$rw2['prd_name'];
$info['prd_id']=$rw2['prd_id'];
$info['quantity']=$rw2['quantity'];

$query3="select * from `products`  where name='".$rw2['prd_name']."'";
$rslt3=mysqli_query($con,$query3);
$rw3=mysqli_fetch_array($rslt3);
$info['image']=$rw3['image'];
$info['ppoints']=$rw3['points'];







echo "<tr class='AltRowTwo'>
      <td width='28' align='center' valign='top'>".$count."</td>
	  <td width='28' align='center' valign='top'>
	        <table border='0'>
			<tr><td align='center'  ><h>Name:</h></td><td>".$info['fname']."</td></tr>
	        <tr><td align='center'  ><h>Username:</h></td><td>".$info['username']."</td></tr>
			<tr><td  align='center'><h>Points:</h></td><td>".$info['Upoints']."</td></tr>
			</table>
	 </td>
	 <td width='28' align='center' valign='top'>
	        <table border='0'>
	        <tr><td align='center'><h>Order Points:</h></td><td>".$info['total_points']."</td></tr>
			<tr><td align='center'><h>Quantity:</h></td><td>".$info['quantity']."</td></tr>
			<tr><td align='center'><h>Order Date:</h></td><td>".$info['order_date']."</td></tr>
			</table> 
	 </td>
	 <td width='28' align='center' valign='top'>
	        <table border='0'>
			<tr><td align='center'><h>Name:</h></td><td>".$info['prd_name']."</td></tr>
			<tr><td align='center'><h>Products Points:</h></td><td>".$info['ppoints']."</td></tr>
			<tr><td align='center' ><h>Image:</h></td><td><img src='../images/".$info['image']."'              width='26' height='26' /></td></tr>
			</table> 
	 </td>
	 </tr>";	 
if($_POST['download_file'])
{	 
$str=$info['id'].','.$info['fname'].','.$info['username'].','.$info['Upoints'].','.$info['prd_name'].','.$info['quantity'].','.$info['ppoints'];
fputcsv($fp,explode(',',$str));

// place this code inside a php file and call it f.e. "download.php"
$path = $_SERVER['DOCUMENT_ROOT']."/admin/"; // change the path to fit your websites document structure
$fullPath = $path.$_GET['download_file'];

if ($fd = fopen ($fullPath, "r")) {
$fsize = filesize($fullPath);
$path_parts = pathinfo($fullPath);
$ext = strtolower($path_parts["extension"]);
switch ($ext) {
case "csv":
header("Content-type: application/csv"); // add here more headers for diff. extensions
header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
break;
default;
header("Content-type: application/octet-stream");
header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
}
header("Content-length: $fsize");
header("Cache-control: private"); //use this to open files directly
while(!feof($fd)) {
$buffer = fread($fd, 2048);
echo $buffer;
}
}
fclose ($fd);
exit;
// example: place this kind of link into the document where the file download is offered:





}
}

echo "</table>";
echo " <a href='?p=orders&download_file=new.csv'>Download here</a>";
  fclose($fp);
?>





