<?php

$sql="select * from capXlsx";
$res=mysqli_query($con, $sql);
echo "<table  border=\"1\" class=\"table table-striped\" >";
echo "<tr>
          <td>Sr#</td>
          <td>Company Name</td>
		  <td>Job #</td>
		  <td>Cert #</td>
		  <td>Concatenated</td>
		  <td>Amount</td>
		  <td>Shipped</td>
		  <td>Received</td>
		  <td>Fulfilled</td>
		  <td>First</td>
		  <td>Last</td>
		  <td>Street</td>
		  <td>City</td>
		  <td>State</td>
		  <td>Zip</td>
		  <td>BeginRedemption</td>
		  <td>Expiration</td>
		  <td>Choice01</td>
		  <td>Choice02</td>
		  <td>Choice03</td>
		  <td>Choice04</td>
		  <td>Choice05</td>
      </tr>";
$count=1;
while($row=mysqli_fetch_assoc($res))
{
	?>   
  <tr>
     <td><?php echo $count; ?></td>
    <td><?php echo $row['cname']; ?></td>
    <td><?php echo $row['job']; ?></td>
    <td><?php echo $row['certificate']; ?></td>
    <td><?php echo $row['concatenated']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['shipped']; ?></td>
    <td><?php echo $row['received']; ?></td>
    <td><?php echo $row['fulfilled']; ?></td>
    <td><?php echo $row['first']; ?></td>
    <td><?php echo $row['last']; ?></td>
    <td><?php echo $row['street']; ?></td>
    <td><?php echo $row['city']; ?></td>
    <td><?php echo $row['zip']; ?></td>
    <td><?php echo $row['state']; ?></td>
    <td><?php echo $row['beginredemption']; ?></td>
    <td><?php echo $row['expiration']; ?></td>
    <td><?php echo $row['choice01']; ?></td>
    <td><?php echo $row['choice02']; ?></td>
    <td><?php echo $row['choice03']; ?></td>
    <td><?php echo $row['choice04']; ?></td>
    <td><?php echo $row['choice05']; ?></td>
    <td><?php echo $row['choice06']; ?></td>
  </tr> 
    <?php
	$count++;
}
echo "</table>";
?>