<?php
$search = $_GET['s'];
$sort	=	$_REQUEST['sort'];
if(isset($_POST['submit']))
{
	$search = $_POST['searchbox'];
}
?>
<?php

$com	=	$_GET['com'];
$mes	=	$_GET['mes'];
$id 	= 	$_GET['id'];
//$page	=	$_REQUEST['page'];

/////////////////////////////////START PAGING///////////////////////////////
$pageLimit = '2';
if($_GET['page']) $page = $_GET['page']; else $page = 1;
$showpage = ($page -1) * $pageLimit;
if($_REQUEST[sort] == 'new')
{
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from products where `name` like '%".$search."%' order by id DESC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from products order by id DESC LIMIT $showpage,$pageLimit");
	}

}else if($_REQUEST[sort] 	== 'oldest'){
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from products where `name` like '%".$search."%' order by id ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from products order by id ASC LIMIT $showpage,$pageLimit");
	}
}else if($_REQUEST[sort] 	== 'navn'){
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from products where `name` like '%".$search."%' order by `name` ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from products order by `name` ASC LIMIT $showpage,$pageLimit");
	}
}else{
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from products where `name` like '%".$search."%' order by id DESC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from products order by id DESC LIMIT $showpage,$pageLimit");
	}
}
if($search)
	{
		$Recordset2 = mysqli_query($con, "select * from products where `name` like '%".$search."%'");
	}
	else
	{
		$Recordset2 = mysqli_query($con, "select * from products");
	}

$totalRecords = mysqli_num_rows($Recordset2);

$totalpages = ceil($totalRecords/$pageLimit);
/////////////////////////////////END PAGING///////////////////////////////
if($mes ==	'err') { $mes	=	'Product image not valid'; }
if($mes ==	'update') { $mes	=	'Product has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'Product has been added successfully'; }
else if($mes == 'del') {$mes	=	"Product has been deleted successfully";}
if($com	==	'del')	{
mysqli_query($con, "DELETE FROM `products` WHERE `id`=".$id);
$q=mysqli_query($con, "SELECT * FROM `products` WHERE `id`=".$id);
$r=mysqli_fetch_array($q);
unlink("../images/thumb_".$r['image']);
unlink("../images/".$r['image']);
goUrl('?p=ManageProducts&mes=del&page='.$page);
}
?>

<h2 class="table table-striped"> Manage Your Products [<?php echo $totalRecords;?>]</h2>
<div class="span6" style="
    width: 100%;
"><!-------------------PAGING DIV START------------------>
  <?php if($mes){?>
  <div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
  <?php } ?>
  <!-------------------PAGING DIV END------------------>
  <div class="navbar" style="
    float: right;
    margin-top: 15px;
">
    <div class="navbar-inner">
      <ul class="nav">
        <li class="active"><a href="javascript:history.go(-1)">« Go Back </a></li>
        <li class="active"><a href="?p=AddProduct">Add Product »</a></li>
      </ul>
    </div>
  </div>
  <div class="pagination pagination-right">
    <ul>
      <li>Page</li>
    </ul>
    <?php echo "<ul><li>".$page."</li></ul>"; ?>
    <ul>
      <li>of</li>
    </ul>
    <?php echo "<ul><li>".$totalpages."</li></ul>"; ?>
    <?php if($page != 1){ ?>
    <ul>
      <li><a href="?p=<?php echo $p ?>&page=<?php echo ($page - 1); ?>&sort=<?php echo $sort;?>&s=<?php echo $search;?>">
        <ul>
          <li>« Previous</li>
        </ul>
        </a></li>
    </ul>
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
    <ul>
      <li> <a href="?p=<?php echo $p; ?>&amp;page=<?php echo ($page + 1); ?>&sort=<?php echo $sort;?>&s=<?php echo $search;?>">
        <ul>
          <li>Next »</li>
        </ul>
        </a></li>
    </ul>
    <?php } ?>
    </ul>
  </div>
  <div class="btn-group" data-toggle="buttons-radio" style="float: right;"> <a style="color:white" href="?p=ManageProducts&sort=name&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='name'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Name</span></a> <a style="color:white" href="?p=ManageProducts&sort=new&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='new'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Newest</span></a> <a style="color:white" href="?p=ManageProducts&sort=oldest&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='oldest'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Oldest</span></a> </div>
  <br />
  <div id="SampleListing">
    <table border="0" width="100%" class="TableHeader">
      <tr>
        <td width="41" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">No</font></strong></td>
        <td width="124" align="left" valign="middle" ><strong>Name</strong></td>
        <td width="152" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Price:</font></strong></td>
        <td width="140" align="left" valign="middle" ><strong>Description</strong></td>
        <td width="338" align="left" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Image</font></strong></td>
        <td width="175" align="right" valign="middle" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Action</font></strong></td>
      </tr>
    </table>
  </div>
  <div class="AltRowOne">
    <?php
$i_c = $page*10-9;
//$page*2-1
   while($cat_fetch_row=mysqli_fetch_array($query_Recordset1)){
	   if($cat_fetch_row['image']!=''){
	     $images = explode('@',html_entity_decode($cat_fetch_row['image'])); 
	   }
	   ?>
    <table width="100%" class="table table-striped" border="0">
      <tr class="AltRowOne ">
        <td width="44" align="left" valign="top">1.</td>
        <td width="120" align="left" valign="top"><?php echo stripslashes(html_entity_decode($cat_fetch_row['name']));?></td>
        <td width="150" align="left" valign="top">
		<?php
		 $w= html_entity_decode($cat_fetch_row['points']);
		 echo "$".$w; 
		 ?></td>
        <td width="145" align="left" valign="top"><?php echo html_entity_decode($cat_fetch_row['description']); ?></td>
        <td width="338" align="left" valign="top"><?php  if($cat_fetch_row['image']!=''){for($y=0;$y<count($images);$y++){ ?>
          <div style="float: left; width: 105px; padding: 2px;"><img src="../images/thumb_<?php echo $images[$y];?>" alt="<?php echo $images[$y]; ?>" width="105" height="90" border="0" /></div>
          <?php }}?></td>
        <td width="173" align="right" valign="top"><div class="btn-group" id="toolbar-delete" style="text-align: right;"> <span  style="display: none;"  href="#" class="btn btn-small"><i class="icon-unpublish"></i><a href="?p=ManageUsers&com=unblock&id=7&page=1" onClick="return confirm('Do You Want To Unblock This User?')">Blocked</a> </span> <span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=EditProducts&pid=<?php echo $cat_fetch_row['id']; ?>&page=<?php echo $page; ?>">Edit</a> </span>&nbsp;&nbsp;&nbsp; <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> 
        
        <a href="?p=<?php echo $p; ?>&com=del&id=<?php echo $cat_fetch_row['id']; ?>&page=<?php echo $page; ?>" onClick="return confirm('Do You Want To Delete This Product?')">Delete</a> </span> </div></td>
      </tr>
    </table>
    <?php $i_c++;  } ?>
  </div>
  <br />
  <br />
  <!-------------------PAGING DIV START------------------>
  <div class="pagination pagination-right">
    <ul>
      <li>Page</li>
    </ul>
    <?php echo "<ul><li>".$page."</li></ul>"; ?>
    <ul>
      <li>of</li>
    </ul>
    <?php echo "<ul><li>".$totalpages."</li></ul>"; ?>
    <?php if($page != 1){ ?>
    <ul>
      <li><a href="?p=<?php echo $p ?>&page=<?php echo ($page - 1); ?>&sort=<?php echo $sort;?>&s=<?php echo $search;?>">
        <ul>
          <li>« Previous</li>
        </ul>
        </a></li>
    </ul>
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
    <ul>
      <li> <a href="?p=<?php echo $p; ?>&amp;page=<?php echo ($page + 1); ?>&sort=<?php echo $sort;?>&s=<?php echo $search;?>">
        <ul>
          <li>Next »</li>
        </ul>
        </a></li>
    </ul>
    <?php } ?>
    </ul>
  </div>
  <div class="btn-group" data-toggle="buttons-radio" style="float: right;"> <a style="color:white" href="?p=ManageProducts&sort=name&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='name'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Name</span></a> <a style="color:white" href="?p=ManageProducts&sort=new&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='new'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Newest</span></a> <a style="color:white" href="?p=ManageProducts&sort=oldest&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='oldest'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Oldest</span></a> </div>
  <!-------------------PAGING DIV END------------------></div>
