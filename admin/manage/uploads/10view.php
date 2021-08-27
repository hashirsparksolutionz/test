<?php
set_time_limit(90);
require_once "simplexlsx.class.php";
	
?><div><strong style="font-size: 20px;">You Can Import CSV OR XLSX File</strong></div>
<div style="margin-top: 85px; width: 375px; margin-left: 245px; background-color: #EDEDED; margin-bottom: 85px;">
<?php 
if (isset($_REQUEST['id']))
 {
	$search 	   = mysqli_query($con, "SELECT * FROM `upload` WHERE `id`='".$_REQUEST['id']."' AND `type`='".$_REQUEST['tpye']."'");
	$rec = mysqli_fetch_array($search);
	//echo $rec['userData'];
	//exit();
	$xlsx = new SimpleXLSX('uploads/'.$rec['userData']);
	 list($cols, $row) = $xlsx->dimension();
	?><table align="left" border="1"><?php
	 foreach( $xlsx->rows() as $k => $r)
	 {
		 if ($k == 0)
		 {?>
         <?php if($_REQUEST['tpye']=='1'){ ?>
         
          <tr>
    <th scope="col"><?php echo $r[0]; ?></th>
    <th scope="col"><?php echo $r[1]; ?></th>
    <th scope="col"><?php echo $r[2]; ?></th>
    <th scope="col"><?php echo $r[3]; ?></th>
    <th scope="col"><?php echo $r[4]; ?></th>
    <th scope="col"><?php echo $r[5]; ?></th>
    <th scope="col"><?php echo $r[6]; ?></th>
    <th scope="col"><?php echo $r[7]; ?></th>
    <th scope="col"><?php echo $r[8]; ?></th>
    <th scope="col"><?php echo $r[9]; ?></th>
    <th scope="col"><?php echo $r[10]; ?></th>
    <th scope="col"><?php echo $r[11]; ?></th>
    <th scope="col"><?php echo $r[12]; ?></th>
     <th scope="col"><?php echo $r[13]; ?></th>
    <th scope="col"><?php echo $r[14]; ?></th>
    <th scope="col"><?php echo $r[15]; ?></th>
    <th scope="col"><?php echo $r[16]; ?></th>
    <th scope="col"><?php echo $r[17]; ?></th>
    <th scope="col"><?php echo $r[18]; ?></th>
    <th scope="col"><?php echo $r[19]; ?></th>
    <th scope="col"><?php echo $r[20]; ?></th>
         
         
         <?php } else { ?>
         
			 <tr>
    <th scope="col"><?php echo $r[0]; ?></th>
    <th scope="col"><?php echo $r[1]; ?></th>
    <th scope="col"><?php echo $r[2]; ?></th>
    <th scope="col"><?php echo $r[3]; ?></th>
    <th scope="col"><?php echo $r[4]; ?></th>
    <th scope="col"><?php echo $r[5]; ?></th>
    <th scope="col"><?php echo $r[6]; ?></th>
    <th scope="col"><?php echo $r[7]; ?></th>
    <th scope="col"><?php echo $r[8]; ?></th>
    <th scope="col"><?php echo $r[9]; ?></th>
   
   <?php } ?>
  </tr><?php
		 continue;
		 } if($_REQUEST['tpye']=='1'){?>
		<tr>
    <td><?php echo $r[0]; ?></td>
    <td><?php echo $r[1]; ?></td>
    <td><?php echo $r[2]; ?></td>
    <td><?php echo $r[3]; ?></td>
    <td><?php echo $r[4]; ?></td>
    <td><?php echo $r[5]; ?></td>
    <td><?php echo $r[6]; ?></td>
    <td><?php echo $r[7]; ?></td>
    <td><?php echo $r[8]; ?></td>
    <td><?php echo $r[9]; ?></td>
    <td><?php echo $r[10]; ?></td>
     <td><?php echo $r[11]; ?></td>
    <td><?php echo $r[12]; ?></td>
    <td><?php echo $r[13]; ?></td>
    <td><?php echo $r[14]; ?></td>
    <td><?php echo $r[15]; ?></td>
    <td><?php echo $r[16]; ?></td>
    <td><?php echo $r[17]; ?></td>
    <td><?php echo $r[18]; ?></td>
    <td><?php echo $r[19]; ?></td>
    <td><?php echo $r[20]; ?></td>
    
  </tr>
<?php	
		 }else{?>
			 <tr>
    <td><?php echo $r[0]; ?></td>
    <td><?php echo $r[1]; ?></td>
    <td><?php echo $r[2]; ?></td>
    <td><?php echo $r[3]; ?></td>
    <td><?php echo $r[4]; ?></td>
    <td><?php echo $r[5]; ?></td>
    <td><?php echo $r[6]; ?></td>
    <td><?php echo $r[7]; ?></td>
    <td><?php echo $r[8]; ?></td>
    <td><?php echo $r[9]; ?></td>
  
    
  </tr>
			 
	<?php	 }
	 }
  
   ?></table><?php
	 
}else
   {
	   $mes="FIle Does Not Exist";
   }
?>
 
</div>
