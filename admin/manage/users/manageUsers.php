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
		$query_Recordset1 = mysqli_query($con, "select * from userinfo where `fname` like '%".$search."%' order by `fname` ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from userinfo order by `fname` ASC LIMIT $showpage,$pageLimit");
	}
}else{
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from userinfo where `fname` like '%".$search."%' order by id DESC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from userinfo order by id DESC LIMIT $showpage,$pageLimit");
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

$totalRecords = mysqli_num_rows($Recordset2);

$totalpages = ceil($totalRecords/$pageLimit);
/////////////////////////////////END PAGING///////////////////////////////
if($mes ==	'err') { $mes	=	'User image not valid'; }
if($mes ==	'update') { $mes	=	'User has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'User has been added successfully'; }
else if($mes == 'del') {$mes	=	"User has been deleted successfully";}
if($com	==	'Del')	{
mysqli_query($con, "DELETE FROM `userinfo` WHERE `id`=".$id);
goUrl('?p=manageUsers&mes=del&page='.$page);
}
?>
<h2 class="table table-striped"> Users[<?php echo $totalRecords;?>]</h2>

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
  <table border="0" width="100%" class="TableHeader">
    <tr>
      <td width="44" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">No</font></strong></td>
      <td width="170" align="left" valign="middle" ><strong>First Name</strong></td>
      <td width="210" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Last Name</font></strong></td>
      <td width="175" align="left" valign="middle" ><strong>Address</strong></td>
      <td width="200" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">City</font></strong></td>
      <td width="200" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">State</font></strong></td>
      <td width="200" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Zip</font></strong></td>
      <td width="291" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Phone</font></strong></td>
      <td width="300" align="left" valign="middle" ><strong>Email</strong></td>
      <td width="70" align="right" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Price</font></strong></td>
      <td width="70" align="right" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Action</font></strong></td>

    </tr>
  </table>
</div>
<div class="AltRowOne">
<?php
$i_c = $page*10-9;
//$page*2-1
   while($cat_fetch_row=mysqli_fetch_array($query_Recordset1)){?>
  <table width="100%" class="table table-striped" border="0">
    <tr class="AltRowOne ">
      <td width="28" align="left" valign="top">1.</td>
                  <td width="94" align="left" valign="top"><?php echo stripslashes(html_entity_decode($cat_fetch_row['fname']));?></td>
      <td width="115" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['lname']); ?></td>
      <td width="97" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['address']); ?></td>
      <td width="109" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['city']); ?></td>
      <td width="109" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['state']); ?></td>
      <td width="109" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['zip']); ?></td>
      <td width="156" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['phone']); ?></td>
      <td width="201" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['email']); ?></td>
      <td width="23" align="right" valign="top"><?php echo html_entity_decode($cat_fetch_row['points']); ?></td>
      <td width="70" align="right" valign="middle" ><a href="?p=manageUsers&com=Del&id=<?php echo $cat_fetch_row['id']?>" onClick="return confirm('Do You Want To Delete This User?')"><img src="../../images/cross.png" alt="Delete" width="16" height="16" border="0" />Delete</a></td>

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
<!-------------------PAGING DIV END------------------></div>