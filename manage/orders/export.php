<?php
/*$con = mysql_connect("localhost","cmattox_capitol",")t7kh@w0rWi;");
mysql_select_db("cmattox_capitolmarketingdeals",$con) or trigger_error(mysql_error());*/

$count='0';
$info= array();
$query="select * from orders";
$rslt=mysqli_query($con,$query);

$fp = fopen('new.csv', 'w');
$columns = 'Order id,Name,Username,User points,Products Name,Product Quantity,Product Points';
fputcsv($fp,explode(',',$columns));
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



//echo $info['prd_name'];

$str=$info['id'].','.$info['fname'].','.$info['username'].','.$info['Upoints'].','.$info['prd_name'].','.$info['quantity'].','.$info['ppoints'];
 echo $str;
fputcsv($fp,explode(',',$str));
 //array_push($row,$str);           
}
//print_r($row);

// $fp = fopen('new.csv', 'w');
	/*	foreach ($row as $fields)
		{	
		 $fields.=$fields;
		//	fputcsv($fp, $fields);
		}*/
		//($fp, $row);
	    fclose($fp);

					
//echo $Content;  
//print_r($row);
/*$waqas= array();
$waqas['User Details']='Name:'.$info['fname'].','.'Username:'.$info['username'].','.'Points:'.$info['Upoints'];
$waqas['Order Details']='Order Points:'.$info['total_points'].','.'Quantity:'.$info['quantity'].','.'Order Date:'.$info['order_date'];
$waqas['Product Details']='Name:'.$info['prd_name'].','.'Products Points:'.$info['ppoints'];

foreach ($waqas as $key => $value)
{   
    $w=explode(",",$value);
	foreach ($w as $val)
	{
	echo $key;	
	}
	
}*/

//echo $key, $value."<br/>";




/*echo "<tr class='AltRowTwo'>
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
	 

echo "</table>";*/
?>
<script type="text/javascript">
  window.location.href = '?p=orders&download=dow';
  /*window.open('new.csv','_parent');
  setTimeout(fun,2000);
  function fun(){
  window.location.href = '?p=orders';
  }*/
    </script>


