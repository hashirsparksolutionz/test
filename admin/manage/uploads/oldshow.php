<?php  
$com	=	$_GET['com'];
$id 	= 	$_GET['id'];
$search 	   = mysqli_query($con, "SELECT * FROM `upload` WHERE `type`=2 ORDER BY id desc");
if($mes == 'del'){$mes = "Your File Has Been Deleted Successfully";}
if($com	==	'del'){
	$img_unlink = mysqli_query($con, "SELECT * FROM `upload` WHERE `id` = ".$id);
	$unlink_img = mysqli_fetch_array($img_unlink);
	$row_unlink  = $unlink_img['userData'];
	unlink("uploads/".$row_unlink);
	mysqli_query($con, "DELETE FROM `upload` WHERE `id` = ".$id);
	
	goUrl('?p=VoucherUploads&mes=del&page='.$page);
}
 ?>
	
<table class="table table-hover td-paddding" width="100%" border="1">

  <tr>
   
    <th width="25%">Name</th>
    <th width="35%">Date</th>
    <th width="25%">Action</th>
     
  </tr>

  <?php while($rowRecs=mysqli_fetch_array($search ))
  {
	  ?>
  <tr>
    
    <td><?php echo stripslashes($rowRecs['userData']); ?></td>
    
 	<td><?php echo stripslashes($rowRecs['date']); ?></td> <td align="center"><a href="uploads/<?php echo stripslashes($rowRecs['userData']); ?>" target="_new"><img src="http://cmc-ftp.com/images/attachment.png" alt="Edit" width="16" height="16" border="0" style="width: 18px; height: 18px;" />Show Attachment</a>&nbsp;&nbsp;&nbsp;<a href="?p=<?php echo $p; ?>&com=del&id=<?php echo $rowRecs['id']; ?>&page=<?php echo $page; ?>" onClick="return confirm('Do You Want To Delete This Record?')"><img src="http://cmc-ftp.com/images/cross.png" style="height: 16px;" alt="Delete" width="16" height="16" border="0" />Delete</a></td></td> 
  </tr>
  <?php 
   } ?>

 </table>
