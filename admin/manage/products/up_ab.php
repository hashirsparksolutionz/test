<?php
 require_once('../includes/myconn.php'); 
$mes=	$_REQUEST['mes'];

$sql1="select *from aboutUs where id = 1";
$res=mysqli_query($con, $sql1);
$row=mysqli_fetch_assoc($res);
if(isset($_POST['submit']))
{
$sql2="UPDATE  `cmattox_capitolmarketingdeals`.`aboutUs` SET  `aboutText` = '".$_POST['desc_en']."' WHERE  `aboutUs`.`id` =1;";
$res2=mysqli_query($con, $sql2);
?>

<script language="javascript">
window.location.href = "?p=updateAboutus&mes=Update";
</script>
<?php	
}

?>
<h2 class="table table-striped">Manage Your About Us</h2>
<?php if($_REQUEST['mes']== 'Update'){?>
<div class="alert alert-success">About Us Text Has Been Updated Successfully</div>
<?php } ?>
<form method="post" name="update" action="" enctype="multipart/form-data">
  <table border="0" class="table table-striped">
    <tr>
      <td valign="middle"><strong>Description:</strong></td>
      <td><textarea name="desc_en" id="desc_en" cols="45" rows="5">
     <?php
     echo $row['aboutText'];
	 ?>
      </textarea>
        <script type="text/javascript">CKEDITOR.replace("desc_en");
        </script>
        </td>
    </tr>
   
    <tr>
      <td colspan="2" align="right"><input type="submit" style="float:right;" name="submit" value="Update" class="btn"></td>
    </tr>
  </table>
</form>
</body>
</html>
