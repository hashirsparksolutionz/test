<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
	
<link rel="stylesheet" href="https://capitolmarketingdeals.com/admin/manage/style.css" />

	
</head>

<?php
$mes=$_REQUEST['mes'];
$com=$_REQUEST['com'];
$id=$_REQUEST['id'];
$pageLimit=25;
$Recordset2 = mysqli_query($con, "select * from userinfo order by id desc;");
$totalRecords = mysqli_num_rows($Recordset2);
$totalpages = ceil($totalRecords/$pageLimit);
if($mes ==	'err') { $mes	=	'Users image not valid'; }
if($mes ==	'update') { $mes	=	'Users has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'Users has been added successfully'; }
else if($mes == 'del') {$mes	=	"Users has been deleted successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
if($com	==	'del')	{
mysqli_query($con, "DELETE FROM `userinfo` WHERE `id`=".$id);
goUrl('?p=viewuser&mes=del');
}
if($com	==	'empty'){
mysqli_query($con, "TRUNCATE TABLE `userinfo`");
goUrl('?p=viewuser&mes=empty');

}
?>
<?php if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } ?>
<h2 class="table table-striped">Manage Your Users[<?php echo $totalRecords;?>]</h2>
<div class="cat-heding"><a href='manage/users/user_xls.php'>To Export  As Excel Click here</a></div>
  <div align="right"><a href="?p=viewuser&com=empty" onClick= "return confirm('Do You Want To Delete All Users?')">Delete All Records</a></div>
<div align="right"><a href="javascript:history.go(-1)">« Go Back</a></div>

    <div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div>
<table width="102%"  cellpadding="0" cellspacing="0" border="0"  id="table" class="tinytable">

         <thead>
                <tr>
                    <th><h3>First Name</h3></th>
                    <th><h3>Last Name</h3></th>
                    <th><h3>Basic Info</h3></th>
                    <th><h3>Begin Redemption</h3></th>
                    <th><h3>Expiration</h3></th>
                    <th><h3>Voucher</h3></th>
                    <th><h3>Status</h3></th>
                    <th><h3>Action</h3></th>
                   
                </tr>
            </thead>
            <tbody>
             <?php
    while($cat_fetch_row=mysqli_fetch_array($Recordset2)){ ?>
		<tr>
			<td><?php echo html_entity_decode($cat_fetch_row['fname']); 
				
			
			?></td>
			 <td><?php echo stripslashes(html_entity_decode($cat_fetch_row['lname']));?></td>
			 <td  width="11%" valign="top">
         
          <strong>Address1:</strong><?php echo html_entity_decode($cat_fetch_row['address1']); ?><br />
          <strong>Address2:</strong><?php echo html_entity_decode($cat_fetch_row['address2']); ?><br />
          <strong>City:</strong><?php echo html_entity_decode($cat_fetch_row['city']); ?><br />
          <strong>State:</strong><?php echo html_entity_decode($cat_fetch_row['state']); ?><br />
          <strong>Zip:</strong><?php echo html_entity_decode($cat_fetch_row['zip']); ?><br />
          <strong>Phone:</strong><?php echo html_entity_decode($cat_fetch_row['phone']); ?><br />
           <strong>Email:</strong><?php echo html_entity_decode($cat_fetch_row['email']); ?><br />
          </td>
			 <td width="14%"><?php echo html_entity_decode($cat_fetch_row['beginredemption']); ?></td>
			 <td width="12%"><?php echo html_entity_decode($cat_fetch_row['expiration']); ?></td>
			 <td width="14%">
         	 <?php echo html_entity_decode($cat_fetch_row['vocher']); ?>
          
       
                               
                            </td>
			<td width="11%" align="left"><strong>Status:</strong>
          <?php
		  if($cat_fetch_row['s_check']==0){
		  $exprydate = $cat_fetch_row['expiration'];
		  if($exprydate!=''){
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
		  }
		  }
		  
  if($ex==1)
  {
	  ?>
          <div style="color:red; font-size: 18px;">Expired</div>
          <?php
  
  }
 else if($cat_fetch_row['s_check']==0){

	  echo "<div style='color:blue; font-size:18px;'>Valid</div>";
	  }
	  else if($cat_fetch_row['s_check']==1){

	  echo "<div style='color:Green; font-size:18px;'>Used</div>";
	  }
	 
  
    ?></td>
			<!--<td><button type="button" class="remove" title="Remove this row">XDelete</button></td>-->
            <td width="9%" align="left"> <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="?p=viewuser&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This User?')">Delete</a> </span></td>
		</tr>
		<?php } ?>
  </tbody>
</table>
<!-----------------paging------------------------------------->

<div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="https://capitolmarketingdeals.com/images/first.gif" style=" height: 16px;width: 16px;" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="https://capitolmarketingdeals.com/images/previous.gif" style=" height: 16px;width: 16px;" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="https://capitolmarketingdeals.com/images/next.gif" style=" height: 16px;width: 16px;" alt="First Page" onclick="sorter.move(1)" />
                    <img src="https://capitolmarketingdeals.com/images/last.gif" style=" height: 16px;width: 16px;" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
 </div>
 

<!--------------------------javascript---------------------------->
<script type="text/javascript" src="https://capitolmarketingdeals.com/admin/manage/script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:10,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		//sortcolumn:1,
		sortdir:1,
		//sum:[8],
		//avg:[6,7,8,9],
		//columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	});
  </script>


<!------------------------------------------------------->




