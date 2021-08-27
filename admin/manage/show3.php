<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">


	<!-- jQuery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

	<!-- Demo stuff -->
	
    <link rel="stylesheet" href="css/sortTables.css" type="text/css">
	<script src="js/jquery.tablesorter.min.js"></script>
<script src="js/jquery.tablesorter.widgets.min.js"></script>
<script src="js/jquery.tablesorter.pager.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function() { 
     $(".tablesorter") 
    .tablesorter({widthFixed: true, widgets: ['zebra']}) 
    .tablesorterPager({container: $("#pager")}); 
}); 

</script>
</head>
<?php
require('includes/myconn.php');
$mes=$_REQUEST['mes'];
$com=$_REQUEST['com'];
$pageLimit=25;
$Recordset2 = mysqli_query($con, "select * from capXlsx");
$totalRecords = mysqli_num_rows($Recordset2);
$totalpages = ceil($totalRecords/$pageLimit);
if($mes ==	'err') { $mes	=	'Vouchers image not valid'; }
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
  <div align="right"><a href="?p=show2&com=empty" onClick= "return confirm('Do You Want To Delete All Vouchers?')">Delete All Records</a></div>
<div align="right"><a href="javascript:history.go(-1)">« Go Back</a></div>

<!--<div id="main">-->




  <!--<button type="button" class="match" data-filter-column="0" data-filter-text="Denni">Match</button>
  <br>
	<button type="button" class="reset">Reset Search</button>-->

	<div id="pager" class="pager" style="margin-top:10px; margin-bottom:10px; width:auto; margin:0 auto; text-align:center;">
	<form>
		<img src="images/first.png" class="first" title="  First  "/>
		<img src="images/prev.png" class="prev" title="  Previous  "/>
		<input type="text" class="pagedisplay" style="width:130px; padding:3px; border:1px solid #105ea6;"/>
		<img src="images/next.png" class="next" title="  Next  "/>
		<img src="images/last.png" class="last" title="  Last  "/>
		<select class="pagesize" style="width:130px; padding:3px; border:1px solid #105ea6;">
			<option value="25">25 per page</option>
			<option value="50">50 per page</option>
			<option value="75">75 per page</option>
            <option value="100">100 per page</option>
			
		</select>
	</form>
</div>
    
    <div id="demo"><table class="tablesorter">
	<thead>
		<tr>
			<!-- add "filter-select" class or filter_functions : { 0: true } -->
			<!-- add "filter-match" class to just match the content, so selecting "Denni" will also show "Dennis" -->
			<th>job Number</th>
			<th>CompanyInfo</th>
			<th>Basic Info</th>
			<th>Begin Redemption</th>
			<th >Expiration</th>
			<th>Choices</th>
			<th>Status</th>
            <th>Action</th>
		</tr>
	</thead>
	<tbody>
		 <?php
    while($cat_fetch_row=mysqli_fetch_array($Recordset2)){ ?>
		<tr>
			<td><?php echo html_entity_decode($cat_fetch_row['job']); ?></td>
			 <td width="19%" valign="top"><strong>Company Name:</strong><?php echo stripslashes(html_entity_decode($cat_fetch_row['cname']));?><br />
         
          <strong>Voucher Number:</strong><?php echo html_entity_decode($cat_fetch_row['certificate']); ?> <br />
          <strong>Concatenated:</strong><?php echo html_entity_decode($cat_fetch_row['concatenated']); ?><br />
          <strong>Amount:</strong><?php echo html_entity_decode($cat_fetch_row['amount']); ?><br />
          <strong>Shipped:</strong><?php echo html_entity_decode($cat_fetch_row['shipCost']); ?><br />
          <strong>Received:</strong><?php echo html_entity_decode($cat_fetch_row['received']); ?><br />
          <strong>Fulfilled:</strong><?php echo html_entity_decode($cat_fetch_row['fulfilled']); ?><br /></td>
			 <td  width="11%" valign="top"><strong>First Name:</strong> <?php echo html_entity_decode($cat_fetch_row['first']); ?><br />
          <strong>Last Name:</strong><?php echo html_entity_decode($cat_fetch_row['last']); ?><br />
          <strong>Street:</strong><?php echo html_entity_decode($cat_fetch_row['street']); ?><br />
          <strong>City:</strong><?php echo html_entity_decode($cat_fetch_row['city']); ?><br />
          <strong>State:</strong><?php echo html_entity_decode($cat_fetch_row['state']); ?><br />
          <strong>Zip:</strong><?php echo html_entity_decode($cat_fetch_row['zip']); ?><br /></td>
			 <td width="14%" valign="top"><?php echo html_entity_decode($cat_fetch_row['beginredemption']); ?></td>
			 <td width="12%" valign="top"><?php echo html_entity_decode($cat_fetch_row['expiration']); ?></td>
			 <td width="14%" valign="top"><strong>Choice 1:</strong> <?php echo html_entity_decode($cat_fetch_row['choice01']); ?><br />
          <strong>Choice 2:</strong> <?php echo html_entity_decode($cat_fetch_row['choice02']); ?><br />
          <strong>Choice 3:</strong> <?php echo html_entity_decode($cat_fetch_row['choice03']); ?><br />
          <strong>Choice 4:</strong> <?php echo html_entity_decode($cat_fetch_row['choice04']); ?><br />
          <strong>Choice 5:</strong> <?php echo html_entity_decode($cat_fetch_row['choice05']); ?><br />
          <strong>Choice 6:</strong> <?php echo html_entity_decode($cat_fetch_row['choice06']); ?><br />
          <strong>Choice 7:</strong> <?php echo html_entity_decode($cat_fetch_row['choice07']); ?><br />
           <strong>Choice 8:</strong> <?php echo html_entity_decode($cat_fetch_row['choice08']); ?><br />
           <strong>Choice 9:</strong> <?php echo html_entity_decode($cat_fetch_row['choice09']); ?><br />
           <strong>Choice 10:</strong> <?php echo html_entity_decode($cat_fetch_row['choice10']); ?><br />
                 <strong>Choice 11:</strong> <?php echo html_entity_decode($cat_fetch_row['choice11']); ?><br />
                  <strong>Choice 12:</strong> <?php echo html_entity_decode($cat_fetch_row['choice12']); ?><br />
                   <strong>Choice 13:</strong> <?php echo html_entity_decode($cat_fetch_row['choice13']); ?><br />
                    <strong>Choice 14:</strong> <?php echo html_entity_decode($cat_fetch_row['choice14']); ?><br />
                     <strong>Choice 15:</strong> <?php echo html_entity_decode($cat_fetch_row['choice15']); ?><br />
                      <strong>Choice 16:</strong> <?php echo html_entity_decode($cat_fetch_row['choice16']); ?><br />
                       <strong>Choice 17:</strong> <?php echo html_entity_decode($cat_fetch_row['choice17']); ?><br />
                        <strong>Choice 18:</strong> <?php echo html_entity_decode($cat_fetch_row['choice18']); ?><br />
                         <strong>Choice 19:</strong> <?php echo html_entity_decode($cat_fetch_row['choice19']); ?><br />
                          <strong>Choice 20:</strong> <?php echo html_entity_decode($cat_fetch_row['choice20']); ?><br />
                           <strong>Choice 21:</strong> <?php echo html_entity_decode($cat_fetch_row['choice21']); ?><br />
                            <strong>Choice 22:</strong> <?php echo html_entity_decode($cat_fetch_row['choice22']); ?><br />
                             <strong>Choice 23:</strong> <?php echo html_entity_decode($cat_fetch_row['choice23']); ?><br />
                              <strong>Choice 24:</strong> <?php echo html_entity_decode($cat_fetch_row['choice24']); ?><br />
                               <strong>Choice 25:</strong> <?php echo html_entity_decode($cat_fetch_row['choice25']); ?><br />
                               
                            </td>
			<td width="11%" align="left" valign="top"><strong>Status:</strong>
          <?php
		  $exprydate = $cat_fetch_row['expiration'];
  if($cat_fetch_row['status']==1)
  {
	  ?>
          <div style="color:blue; font-size: 18px;">Used</div>
          <?php
  
  }
 else if($exprydate <= date("m-d-Y")){
	  echo "<div style='color:red; font-size:18px;'>Expired</div>";
	  } else
  {
	  ?>
          <div style="color:green; font-size:18px;">Valid</div>
          <?php 
  }
  
    ?></td>
			<!--<td><button type="button" class="remove" title="Remove this row">XDelete</button></td>-->
            <td width="9%" align="left" valign="top"><span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=edit&pid=<?php echo $cat_fetch_row['id']; ?>">Edit</a> </span> | <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="?p=show2&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This Vouchers?')">Delete</a> </span></td>
		</tr>
		<?php } ?>
	</tbody>
</table></div>
<div id="pager" class="pager" style="margin-top:10px; margin-bottom:10px; width:auto; margin:0 auto; text-align:center;">
	<form>
		<img src="images/first.png" class="first" title="  First  "/>
		<img src="images/prev.png" class="prev" title="  Previous  "/>
		<input type="text" class="pagedisplay" style="width:130px; padding:3px; border:1px solid #105ea6;"/>
		<img src="images/next.png" class="next" title="  Next  "/>
		<img src="images/last.png" class="last" title="  Last  "/>
		<select class="pagesize" style="width:130px; padding:3px; border:1px solid #105ea6;">
			<option value="25">25 per page</option>
			<option value="50">50 per page</option>
			<option value="75">75 per page</option>
            <option value="100">100 per page</option>
			
		</select>
	</form>
</div>

	
	


	










