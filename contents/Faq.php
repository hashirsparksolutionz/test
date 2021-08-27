<?php
$sql1="select *from aboutUs where id = 2";
$res=mysqli_query($con, $sql1);
$row=mysqli_fetch_assoc($res);



?><div class="shape-featured">
   	<div class="text-haead">FAQ</div>
    </div><?php
     echo $row['aboutText'];
	 ?>