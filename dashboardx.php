<h1>Welcome to Test Administration Panel</h1>
<div class="span6">
<div class="well well-small">
<div class="module-title nav-header">waqas</div>
<div class="row-striped">
<div class="row-fluid">
  <div class="span9"> <strong class="row-title">
    <table border="1">
      <tr>
        <td>Username</td>
        <td>Order Date</td>
        <td>Total Points</td>
      </tr>
    </table>
    </strong> </div>
</div>
<?php


if(isset($_POST['submit']))
{
$info= array();
$query="select * from members";
$rslt=mysqli_query($con, $query);

	while($rw=mysqli_fetch_assoc($rslt))
	{
		
		$info['id']=$rw['id'];
$info['name']=$rw['fname'];
$query1="select * from `orders`  where user_id='".$rw['id']."'";
$rslt1=mysqli_query($con, $query1);
$rw1=mysqli_fetch_array($rslt1);
$info['order_date']=$rw1['order_date'];
$info['total_points']=$rw1['total_points'];



$query2="select * from order_detail where order_id='".$rw1['id']."'";
$rslt2=mysqli_query($con, $query2);
$rw2=mysqli_fetch_array($rslt2);
$info['prd_name']=$rw2['prd_name'];
$info['prd_id']=$rw2['prd_id'];
$info['quantity']=$rw2['quantity'];



$query3="select * from `products`  where name='".$rw2['prd_name']."'";
$rslt3=mysqli_query($con, $query3);
$rw3=mysqli_fetch_array($rslt3);
$info['image']=$rw3['image'];

$waitingList = array();
$waitingList[] = array('Name','Products','Quantity','Order Id','Order Date');
$waitingList[] = array($info['name'],$info['prd_name'],$info['quantity'],$info['prd_id'],$info['order_date']);

echo $info['name']."Name".'<br />';
echo $info['prd_name']."Product name".'<br />';
echo $info['quantity']."Quantity".'<br />';
echo $info['prd_id']."Product Id".'<br />';
echo $info['order_date']."Ordaer Date".'<br />';
exit;


       $fp = fopen('new.csv', 'w');
		foreach ($waitingList as $fields)
		{
			fputcsv($fp, $fields);
		}
	    fclose($fp);
		
	}
	
	   
 

}
echo "<form action='' method='post'>";

echo "<input type='hidden' name='name' value='".$info['name']."'>";
echo "<input type='hidden' name='prdname' value='".$info['prd_name']."'>";
echo "<input type='hidden' name='qnt' value='".$info['quantity']."'>";
echo "<input type='hidden' name='pid' value='".$info['prd_id']."'>";
echo "<input type='hidden' name='odte' value='".$info['order_date']."'>";
echo "<input type='submit' name='submit' value='Click Me'>";
echo "</form>";
?>
