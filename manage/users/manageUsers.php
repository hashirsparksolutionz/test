<?php
$search = $_GET['s'];
$sort	=	$_REQUEST['sort'];

$com	=	$_GET['com'];
echo $com;
$mes	=	$_GET['mes'];
$id 	= 	$_GET['id'];
//$page	=	$_REQUEST['page'];

/////////////////////////////////START PAGING///////////////////////////////
$pageLimit = '25';
if($_GET['page']) $page = $_GET['page']; else $page = 1;
$showpage = ($page -1) * $pageLimit;
if($_REQUEST[sort] == 'new')
{
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from userinfo where `fname` like '%".$search."%' order by id DESC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from userinfo order by id DESC LIMIT $showpage,$pageLimit");
	}

}else if($_REQUEST[sort] 	== 'oldest'){
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from userinfo where `fname` like '%".$search."%' order by id ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from userinfo order by id ASC LIMIT $showpage,$pageLimit");
	}
}else if($_REQUEST[sort] 	== 'navn'){
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from userinfo WHERE `check`='2' AND `fname` like '%".$search."%' order by `fname` ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from userinfo WHERE `check`='2' order by `fname` ASC LIMIT $showpage,$pageLimit");
	}
}else{
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from userinfo WHERE `check`='2' AND  `fname` like '%".$search."%' order by id DESC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from userinfo WHERE `check`='2' order by id DESC LIMIT $showpage,$pageLimit");
	}
}
if($search)
	{
		$Recordset2 = mysqli_query($con, "select * from userinfo where `fname` like '%".$search."%'");
	}
	else
	{
		$Recordset2 = mysqli_query($con, "select * from userinfo");
	}

$totalRecords = mysqli_num_rows($query_Recordset1);

$totalpages = ceil($totalRecords/$pageLimit);
/////////////////////////////////END PAGING///////////////////////////////
if($mes ==	'err') { $mes	=	'Certificate image not valid'; }
if($mes ==	'update') { $mes	=	'Certificate has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'Certificate has been added successfully'; }
else if($mes == 'del') {$mes	=	"Certificate has been deleted successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
if($com	==	'Del')	{
mysqli_query($con, "DELETE FROM `userinfo` WHERE `id`=".$id);
goUrl('?p=manageUsers&mes=del&page='.$page);
}
if($com	==	'empty')	{
//mysqli_query($con, "TRUNCATE TABLE `userinfo`");
mysqli_query($con, "DELETE FROM `userinfo` WHERE `check`='2'");
goUrl('?p=manageUsers&mes=empty&page='.$page);

}
?>
<h2 class="table table-striped"> Used Certificate[<?php echo $totalRecords;?>]</h2>
  <div align="right"><a href="?p=manageUsers&com=empty">Delete All Records</a></div>


<div class="span6" style="
    width: 100%;
"><!-------------------PAGING DIV START------------------>
<?php if($mes){?><div class="alert alert-success">
  <strong><?php echo $mes; ?></strong></div><?php } ?><!-------------------PAGING DIV END------------------>
<div class="navbar" style="
    float: right;
    margin-top: 15px;
"></div>
<div class="pagination pagination-right">
  
  <ul><li>Page</li></ul><?php echo "<ul><li>".$page."</li></ul>"; ?> <ul><li>of</li></ul> <?php echo "<ul><li>".$totalpages."</li></ul>"; ?>
  <?php if($page != 1){ ?>
  <ul>
  <li><a href="?p=<?php echo $p ?>&page=<?php echo ($page - 1); ?>&sort=<?php echo $sort;?>&s=<?php echo $search;?>"><ul><li>« Previous</li></ul></a></li></ul>
  <?php } 
	if($totalpages > 1){
		for($i = 1; $i <= $totalpages; $i++){
			if($page == $i){
				echo "<ul><li>".$i."</li></ul>";
			}else{
				echo "<ul><li><a href=\"?p=$p&class=list&page=$i&sort=$sort&s=$search\"><ul><li>".$i."</li></ul></a></li></ul>";
			}
		}
	}

if($page < $totalpages){ ?>
<ul> <li> <a href="?p=<?php echo $p; ?>&amp;page=<?php echo ($page + 1); ?>&sort=<?php echo $sort;?>&s=<?php echo $search;?>"><ul> <li>Next »</li></ul></a></li></ul>
  <?php } ?>
  </ul>
 
</div>

                <div class="btn-group" data-toggle="buttons-radio" style="float: right;">
                <a style="color:white" href="?p=manageUsers&sort=name&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='name'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Name</span></a>
             <a style="color:white" href="?p=manageUsers&sort=new&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='new'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Newest</span></a>
             <a style="color:white" href="?p=manageUsers&sort=oldest&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='oldest'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Oldest</span></a>
</div>
<br />

<div id="SampleListing">
 <h4><a href='manage/users/certi_xls.php'> Click To Export As Excel </a></h4
  ><table border="0" width="100%" class="TableHeader">
    <tr>
      <td width="44" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">No</font></strong></td>
      <td width="263"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Basic Info</font></strong></td>

        <td width="108" align="left" valign="middle" ><strong>Expire Date</strong></td>
         <td width="160" align="left" valign="middle" ><strong>Choice</strong></td>
      <td width="148" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Redemptiondate</font></strong></td>
      <td width="98" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Certificate</font></strong></td>
      <td width="107" align="right" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Action</font></strong></td>

    </tr>
  </table>
</div>
<div class="AltRowOne">
<?php
$i_c = $page*25-24;
//$page*2-1
   while($cat_fetch_row=mysqli_fetch_array($query_Recordset1)){?>
  <table width="100%" class="table table-striped" border="0">
    <tr class="AltRowOne ">
    <?php 
			$certi=$cat_fetch_row['vocher'];
			$Recordset2 = mysqli_query($con, "select * from capXlsx Where `certificate`='".$certi."'");
			$row1=mysqli_fetch_array($Recordset2)
		
	 ?>
      <td width="41" align="left" valign="top"><?php echo $i_c;?></td>
                  <td width="269" align="left" valign="top"><strong>First Name:</strong><?php echo stripslashes(html_entity_decode($cat_fetch_row['fname']));?><br/>
       <strong>Last Name:</strong><?php echo html_entity_decode($cat_fetch_row['lname']); ?><br />
     <strong>Address 1:</strong><?php echo html_entity_decode($cat_fetch_row['address1']); ?><br />
       <strong>Address 2:</strong><?php echo html_entity_decode($cat_fetch_row['address2']); ?><br />
    <strong>City:</strong><?php echo html_entity_decode($cat_fetch_row['city']); ?><br />
      <strong>State:</strong><?php echo html_entity_decode($cat_fetch_row['state']); ?><br />
      <strong>Zip:</strong><?php echo html_entity_decode($cat_fetch_row['zip']); ?><br />
      <strong>Phone:</strong><?php echo html_entity_decode($cat_fetch_row['phone']); ?><br />
      <strong>Email:</strong><?php echo html_entity_decode($cat_fetch_row['email']); ?><br />
      <strong>Company Name:</strong><?php echo html_entity_decode($row1['cname']); ?> <br />
      <strong>Job Number:</strong><?php echo html_entity_decode($row1['job']); ?> <br /></td>
    	<td width="107"  align="left" valign="top"><?php echo  $row1['expiration'];  ?></td>
        <td width="160" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['size']); ?></td>
        <td width="144" valign="top"><?php $Date =$cat_fetch_row['date']; $orderDate = explode('-',$Date); echo $orderDate[1].'-'.$orderDate[2].'-'.$orderDate[0]; ?></td>
        
      <td width="98" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['vocher']); ?></td>
      <td width="109" align="right" valign="top" ><a href="?p=manageUsers&com=Del&id=<?php echo $cat_fetch_row['id']?>" onClick="return confirm('Do You Want To Delete This Used Cetificate?')"><img src="../../images/cross.png" alt="Delete" width="16" height="16" border="0" />Delete</a></td>

    </tr>
  </table>
  <?php $i_c++;  } ?>
</div>
<br />
<br />
<!-------------------PAGING DIV START------------------>
<div class="pagination pagination-right">
  
  <ul><li>Page</li></ul><?php echo "<ul><li>".$page."</li></ul>"; ?> <ul><li>of</li></ul> <?php echo "<ul><li>".$totalpages."</li></ul>"; ?>
  <?php if($page != 1){ ?>
  <ul>
  <li><a href="?p=<?php echo $p ?>&page=<?php echo ($page - 1); ?>&sort=<?php echo $sort;?>&s=<?php echo $search;?>"><ul><li>« Previous</li></ul></a></li></ul>
  <?php } 
	if($totalpages > 1){
		for($i = 1; $i <= $totalpages; $i++){
			if($page == $i){
				echo "<ul><li>".$i."</li></ul>";
			}else{
				echo "<ul><li><a href=\"?p=$p&class=list&page=$i&sort=$sort&s=$search\"><ul><li>".$i."</li></ul></a></li></ul>";
			}
		}
	}

if($page < $totalpages){ ?>
<ul> <li> <a href="?p=<?php echo $p; ?>&amp;page=<?php echo ($page + 1); ?>&sort=<?php echo $sort;?>&s=<?php echo $search;?>"><ul> <li>Next »</li></ul></a></li></ul>
  <?php } ?>
  </ul>
 
</div>

                <div class="btn-group" data-toggle="buttons-radio" style="float: right;">
                <a style="color:white" href="?p=manageUsers&sort=name&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='name'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Name</span></a>
             <a style="color:white" href="?p=manageUsers&sort=new&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='new'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Newest</span></a>
             <a style="color:white" href="?p=manageUsers&sort=oldest&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='oldest'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Oldest</span></a>

</div>


