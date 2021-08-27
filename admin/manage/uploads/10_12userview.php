<?php
set_time_limit(90);
require_once "simplexlsx.class.php";
	
?><div><strong style="font-size: 20px;">You Can Import CSV OR XLSX File</strong></div>
<div style="margin-top: 85px; width: 375px; margin-left: 245px; background-color: #EDEDED; margin-bottom: 85px;">
<?php 
if (isset($_REQUEST['id']))
 {
	$search 	   = mysqli_query($con, "SELECT * FROM `upload` WHERE `id`='".$_REQUEST['id']."' AND `type`='".$_REQUEST['type']."'");
	$rec = mysqli_fetch_array($search);
	
	//exit();
	$xlsx = new SimpleXLSX('uploads/'.$rec['userData']);
	 list($cols, $row) = $xlsx->dimension();
	?><table align="left" border="1"><?php
	 foreach( $xlsx->rows() as $k => $r)
	 {
		 if ($k == 0)
		 {?>
        
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
   
  
  </tr><?php
		 continue;
		 }?>
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
   
    
  </tr>
<?php		
	 }
  
   ?></table><?php
	 
}else
   {
	   $mes="FIle Does Not Exist";
   }
?>
 
</div>
