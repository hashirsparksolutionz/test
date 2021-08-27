<?php
$sql1="SELECT * FROM `tos` WHERE `id` = '1'";
$res=mysqli_query($con, $sql1);
$row=mysqli_fetch_assoc($res);
?>
<div class="shape-featured">
<div class="text-haead"><strong>TERMS</strong></div>
</div>
<?php
      echo stripcslashes($row['TermsOfUse']);
?>