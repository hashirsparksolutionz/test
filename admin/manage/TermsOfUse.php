<?php
$mes  =	$_GET['mes'];
$sql1 = mysqli_query($con, "SELECT * FROM `tos` WHERE `id` = '1'");
$row  = mysqli_fetch_assoc($sql1);
if(isset($_POST['submit']))
{
$sql2="UPDATE `tos` SET `TermsOfUse` = '".mysqli_real_escape_string($con, $_POST['TermsOfUse'])."' WHERE `id`='1'";
$res2=mysqli_query($con, $sql2);
?>
<script language="javascript">
window.location.href = "?p=TermsOfUse&mes=upd";
</script>
<?php	
}
?>
<?php if($mes=='upd'){?>
<div class="alert alert-success"> <strong><?php echo "Record Has Been Updated Successfully"; ?></strong></div>
<?php } ?>
<h2 class="table table-striped">Manage Terms Of Use</h2>
<form method="post" name="update" action="" enctype="multipart/form-data">
  <table border="0" class="table table-striped">
    <tr>
      <td valign="middle"><strong>Text:</strong></td>
      <td><textarea name="TermsOfUse" id="TermsOfUse" cols="45" rows="5">
     <?php
     echo stripcslashes($row['TermsOfUse']);
	 ?>
      </textarea>
        <script type="text/javascript">CKEDITOR.replace("TermsOfUse");
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