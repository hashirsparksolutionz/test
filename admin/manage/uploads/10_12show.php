<?php  
$com	=	$_GET['com'];
$id 	= 	$_GET['id'];
$search 	   = mysqli_query($con, "SELECT * FROM `upload` WHERE `type`=2 ORDER BY id desc");
if($mes == 'del'){$mes = "Your File Has Been Deleted Successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
if($com	==	'del'){
	$img_unlink = mysqli_query($con, "SELECT * FROM `upload` WHERE `id` = ".$id);
	$unlink_img = mysqli_fetch_array($img_unlink);
	$row_unlink  = $unlink_img['userData'];
	unlink("uploads/".$row_unlink);
	mysqli_query($con, "DELETE FROM `upload` WHERE `id` = ".$id);
	
	goUrl('?p=VoucherUploads&mes=del&page='.$page);
}
if($com	==	'empty')	{
mysqli_query($con, "DELETE FROM `upload` WHERE `type`='2'");
goUrl('?p=VoucherUploads&mes=empty');

}
 ?>

  <div align="right"><a href="?p=VoucherUploads&com=empty" onClick= "return confirm('Do You Want To Delete All Vouchers?')">Delete All Records</a></div>
<div align="right"><a href="javascript:history.go(-1)">« Go Back</a></div>
	
<table class="table table-hover td-paddding" width="100%" border="1">

  <tr>
   
    <th width="25%">Name</th>
    <th width="35%">Date</th>
    <th width="29%">Action</th>
     
  </tr>

  <?php while($rowRecs=mysqli_fetch_array($search ))
  {
	  ?>
  <tr>
    
    <td><?php echo stripslashes($rowRecs['userData']); ?></td>
    
 	<td><?php echo stripslashes($rowRecs['date']); ?></td> <td align="center"><a href="uploads/<?php echo stripslashes($rowRecs['userData']); ?>" target="_new"><img src="http://cmc-ftp.com/images/attachment.png" alt="Edit" width="16" height="16" border="0" style="width: 18px; height: 18px;" />Show Attachment</a>&nbsp;&nbsp;&nbsp;<a href="?p=<?php echo $p; ?>&com=del&id=<?php echo $rowRecs['id']; ?>&page=<?php echo $page; ?>" onClick="return confirm('Do You Want To Delete This Record?')"><img src="http://cmc-ftp.com/images/cross.png" style="height: 16px;" alt="Delete" width="16" height="16" border="0" />Delete</a>&nbsp;&nbsp;&nbsp;<a href="?p=view&id=<?php echo $rowRecs['id']; ?>&page=<?php echo $page; ?>&type=2"><img src="../../images/view33.png" style="height: 16px;" alt="Delete" width="16" height="16" border="0" />View</a></td></td> 
  </tr>
  <?php 
   } ?>

 </table>
