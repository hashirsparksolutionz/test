<?php  

require_once('includes/myconn.php'); 
	
	$search 	   = mysqli_query($con, "SELECT * FROM `upload` WHERE `type`=2");

	
	 ?>
	
<table class="table table-hover td-paddding" width="100%" border="1">

  <tr>
    <th width="25%">Userid</th>
    <th width="25%">Name</th>
    <th width="25%">Action</th>
     <th width="35%">Date</th>
  </tr>

  <?php while($rowRecs=mysqli_fetch_array($search ))
  {
	  ?>
  <tr>
    <td ><?php echo $rowRecs['id']?></td>
    <td><?php echo stripslashes($rowRecs['userData']); ?></td>
    <td><?php echo stripslashes($rowRecs['userData']); ?></td>
  <td>  <?php echo stripslashes($rowRecs['date']); ?></td>
  </tr>
  <?php 
   } ?>

 </table>
