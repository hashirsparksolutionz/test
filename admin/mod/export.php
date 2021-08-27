<?php
//"select o.*,p.*,m.*,od.* from orders o , products p, members m, order_detail od where m.id = o.user_id and o.user_id =m.id";

///////////////////////////////////////////////////////////////////////////////////////////////////////

$count='0';
$info= array();
$query="select * from orders";
$rslt=mysqli_query($con, $query);
$row= array();


array_push($row,$columns);
$fp = fopen('new.csv', 'w');
$columns = 'Name,Product,Quantity,Date,Points';
fputcsv($fp,explode(',',$columns));
while($rw=mysqli_fetch_assoc($rslt))
{ 
$count++;
$info['id']=$rw['id'];
$info['user_id']=$rw['user_id'];
$info['order_date']=$rw['order_date'];
$info['total_points']=$rw['total_points'];
$query1="select * from members  where id='".$rw['user_id']."'";
$rslt1=mysqli_query($con, $query1);
$rw1=mysqli_fetch_array($rslt1);
$info['fname']=$rw1['fname'];
$info['username']=$rw1['username'];
$info['Upoints']=$rw1['points'];

$query2="select * from order_detail where order_id='".$rw['id']."'";
$rslt2=mysqli_query($con, $query2);
$rw2=mysqli_fetch_array($rslt2);
$info['prd_name']=$rw2['prd_name'];
$info['prd_id']=$rw2['prd_id'];
$info['quantity']=$rw2['quantity'];

$query3="select * from `products`  where name='".$rw2['prd_name']."'";
$rslt3=mysqli_query($con, $query3);
$rw3=mysqli_fetch_array($rslt3);
$info['image']=$rw3['image'];
$info['ppoints']=$rw3['points'];

$str= $info['fname'].','.$info['prd_name'].','.$info['quantity'].','.$info['order_date'].','.$info['Upoints'];
 $row= array($info['fname'],$info['prd_name'],$info['quantity'],$info['order_date'],$info['Upoints']);
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


//print_r($row);
?>


