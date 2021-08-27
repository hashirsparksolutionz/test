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
$pageLimit = '15';
if($_GET['page']) $page = $_GET['page']; else $page = 1;
$showpage = ($page -1) * $pageLimit;
if($_REQUEST[sort] == 'new')
{
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from capXlsx where `name` like '%".$search."%' order by id ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from capXlsx order by id ASC LIMIT $showpage,$pageLimit");
	}

}else if($_REQUEST[sort] 	== 'oldest'){
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from capXlsx where `name` like '%".$search."%' order by id ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from capXlsx order by id ASC LIMIT $showpage,$pageLimit");
	}
}else if($_REQUEST[sort] 	== 'navn'){
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from capXlsx where `name` like '%".$search."%' order by `name` ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from capXlsx order by `name` ASC LIMIT $showpage,$pageLimit");
	}
}else{
	if($search)
	{
		$query_Recordset1 = mysqli_query($con, "select * from capXlsx where `name` like '%".$search."%' order by id ASC LIMIT $showpage,$pageLimit");
	}
	else
	{
		$query_Recordset1 		= mysqli_query($con, "select * from capXlsx order by id ASC LIMIT $showpage,$pageLimit");
	}
}
if($search)
	{
		$Recordset2 = mysqli_query($con, "select * from capXlsx where `name` like '%".$search."%'");
	}
	else
	{
		$Recordset2 = mysqli_query($con, "select * from capXlsx");
	}

$totalRecords = mysqli_num_rows($Recordset2);
$totalpages = ceil($totalRecords/$pageLimit);
/////////////////////////////////END PAGING///////////////////////////////
if($mes ==	'err') { $mes	=	'Product image not valid'; }
if($mes ==	'update') { $mes	=	'Vouchers has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'Vouchers has been added successfully'; }
else if($mes == 'del') {$mes	=	"Vouchers has been deleted successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
if($com	==	'del')	{
mysqli_query($con, "DELETE FROM `capXlsx` WHERE `id`=".$id);
goUrl('?p=show2&mes=del&page='.$page);
}
if($com	==	'empty')	{
mysqli_query($con, "TRUNCATE TABLE `capXlsx`");
goUrl('?p=show2&mes=empty&page='.$page);

}
?>
<?php if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } ?>
<h2 class="table table-striped">Manage Your Vouchers[<?php echo $totalRecords;?>]</h2>
  <div align="right"><a href="?p=show2&com=empty">Delete All Records</a></div>
<div class="span6" style="
    width: auto;
"><!-------------------PAGING DIV START------------------> 
  
  <!-------------------PAGING DIV END------------------>
  <div class="navbar" style="
    float: right;
    margin-top: 15px;">
    <div class="navbar-inner">
      <ul class="nav">
        <li class="active"><a href="javascript:history.go(-1)">« Go Back </a></li>
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
      <li> <a href="?p=<?php echo $p ?>&page=<?php echo ($page - 1); ?>&sort=<?php echo $sort;?>&s=<?php               echo $search;?>">
        <ul>
          <li>« Previous</li>
        </ul>
        </a></li>
    </ul>
    <?php } 
	if($totalpages > 1)
	{
		for($i = 1; $i <= $totalpages; $i++)
		{
			if($page == $i){
				echo "<ul><li>".$i."</li></ul>";
			}
			else
			{
				echo "<ul><li><a href=\"?p=$p&class=list&page=$i&sort=$sort&s=$search\"><ul><li>".$i."                 </li></ul></a></li></ul>";
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

  <div class="btn-group" data-toggle="buttons-radio" style="float: right;"> <a style="color:white; margin-right:3px;" href="?p=show2&sort=name&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='name'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Name</span></a> <a style="color:white; margin-right:3px;" href="?p=show2&sort=new&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='new'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Newest</span></a> <a style="color:white; margin-right:3px;" href="?p=show2&sort=oldest&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='oldest'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Oldest</span></a> </div>
  <br />
  <div id="SampleListing">
    <table border="0" width="100%" class="TableHeader">
      <tr>
        <td width="19%"><strong>CompanyInfo</strong></td>
        <td width="11%"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Basic Info</font></strong></td>
        <td width="14%"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Beg.Redemption</font></strong></td>
        <td width="12%"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Expiration</font></strong></td>
        <td width="14%"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Choices</font></strong></td>
        <td width="11%" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Status</font></strong></td>
        <td width="19%" colspan="2" align="center"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Action</font></strong></td>
      </tr>
    </table>
  </div>
  <div class="AltRowOne">
    <?php
/*$i_c = $page*10-9;
$conut=1;
$Q="SELECT * FROM capXlsx";
$r=mysqli_query($con, $Q);*/
//$page*2-1
   while($cat_fetch_row=mysqli_fetch_array($query_Recordset1)){
	   
	   ?>
    <table width="100%" class="table table-striped" border="0">
      <tr class="AltRowOne ">
        <td width="19%" valign="top"><strong>Company Name:</strong><?php echo stripslashes(html_entity_decode($cat_fetch_row['cname']));?><br />
          <strong>Job Number:<?php echo html_entity_decode($cat_fetch_row['job']); ?></strong><br />
          <strong>Certificate Number:</strong><?php echo html_entity_decode($cat_fetch_row['certificate']); ?> <br />
          <strong>Concatenated:</strong><?php echo html_entity_decode($cat_fetch_row['concatenated']); ?><br />          <br /></td>
        <td  width="11%" valign="top"><strong>First Name:</strong> <?php echo html_entity_decode($cat_fetch_row['first']); ?><br />
          <strong>Last Name:</strong><?php echo html_entity_decode($cat_fetch_row['last']); ?><br />
          <strong>Street:</strong><?php echo html_entity_decode($cat_fetch_row['street']); ?><br />
          <strong>City:</strong><?php echo html_entity_decode($cat_fetch_row['city']); ?><br />
          <strong>State:</strong><?php echo html_entity_decode($cat_fetch_row['state']); ?><br />
          <strong>Zip:</strong><?php echo html_entity_decode($cat_fetch_row['zip']); ?><br /></td>
        <td width="14%" valign="top"><?php echo html_entity_decode($cat_fetch_row['beginredemption']); ?></td>
        <td width="12%" valign="top"><?php echo html_entity_decode($cat_fetch_row['expiration']); ?></td>
        <td width="14%" valign="top"><strong>Choice 1:</strong> <?php echo html_entity_decode($cat_fetch_row['choice02']); ?><br />
<strong>Choice 2: </strong><?php echo html_entity_decode($cat_fetch_row['choice03']); ?><br />
                               
                            </td>
        <td width="11%" align="left" valign="top"><strong>Status:</strong>
          <?php
		  //$exp_date = $cat_fetch_row['expiration'];
		  	  $exprydate = $cat_fetch_row['expiration'];
		  	  $exdate=explode('-',$exprydate);
		  $date=$exdate['2']."-".$exdate['0']."-".$exdate['1'];
		  //echo $date."<br/>";
		  //echo date("Y-m-d");
		  
		   
		   $days = (strtotime($date) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);;
		   
		//echo $days;
		 //exit();
			 if($days<0){
			 $ex =1;
		 }else{
			  $ex =0;
		 }
			$todays_date = date("m-d-Y");

$today = strtotime($todays_date);
$expiration_date = strtotime($exp_date);



//echo $today."<br/>";
//echo $expiration_date;
	 if($cat_fetch_row['status']==2)
  {
	  ?>
          <div style="color:green; font-size: 18px;">Reedem</div>
 <?php }  else if($ex=='1'){?>
	<div style="color:red; font-size:18px;">Expired</div>
<?php 	 
	}
		else
		 {
	  ?>
          <div style="color:blue; font-size:18px;">Active</div>
          <?php 
  } ?>
	 
	 
	 
	 
	 
	 
	 

    </td>
        <td width="9%" align="left" valign="top"><span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=edit&pid=<?php echo $cat_fetch_row['id']; ?>">Edit</a> </span></td>
        <td width="10%" align="left" valign="top"><span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="?p=show2&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This Certificate?')">Delete</a> </span></td>
      </tr>
    </table>
    <?php 
	 $i_c++;
	 $conut++; 
	 } 
	 ?>
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
  <div class="btn-group" data-toggle="buttons-radio" style="float: right;"> <a style="color:white; margin-right:3px;" href="?p=show2&sort=name&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='name'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Name</span></a> <a style="color:white; margin-right:3px;" href="?p=show2&sort=new&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='new'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Newest</span></a> <a style="color:white; margin-right:3px;" href="?p=show2&sort=oldest&s=<?php echo $search;?>"><span <?php if($_REQUEST['sort']=='oldest'){?> class="btn btn-primary active" <?php }else{?>class="btn btn-primary" <?php } ?>>Oldest</span></a> </div>
  <!-------------------PAGING DIV END------------------></div>
