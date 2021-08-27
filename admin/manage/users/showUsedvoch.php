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
$Recordset2 = mysqli_query($con, "select * from capXlsx where status='1'");
$totalRecords = mysqli_num_rows($Recordset2);
$totalpages = ceil($totalRecords/$pageLimit);
if($mes ==	'err') { $mes	=	'Certificates image not valid'; }
if($mes ==	'update') { $mes	=	'Certificates has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'Certificates has been added successfully'; }
else if($mes == 'del') {$mes	=	"Certificates has been deleted successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
if($com	==	'del')	{
mysqli_query($con, "DELETE FROM `capXlsx` WHERE `id`=".$id);
goUrl('?p=showUsedvoch&mes=del');
}
if($com	==	'empty')	{
mysqli_query($con, "DELETE FROM `capXlsx` WHERE `status`='1' ORDER BY id DESC");
goUrl('?p=showUsedvoch&mes=empty');

}
?>
<?php if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } ?>
<h2 class="table table-striped">Used Certificates[<?php echo $totalRecords;?>]</h2>
  <div align="right"><a href="?p=showUsedvoch&com=empty" onClick= "return confirm('Do You Want To Delete All Certificates?')">Delete All Records</a></div>
<div class="cat-heding"><a href='manage/usedcerti.php'>To Export  As Excel Click here</a></div>
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
                    <th><h3>job Number</h3></th>
                     <th><h3>Certificate Number</h3></th>
                    <th><h3>CompanyInfo</h3></th>
                    <th><h3>Basic Info</h3></th>
                    <th><h3>Begin Redemption</h3></th>
                    <th><h3>Expiration</h3></th>
                    <th><h3>Choices</h3></th>
                    <th><h3>Status</h3></th>
                    <th><h3>Action</h3></th>
                   
                </tr>
            </thead>
            <tbody>
             <?php
    while($cat_fetch_row=mysqli_fetch_array($Recordset2)){ ?>
		<tr>
			<td><?php echo html_entity_decode($cat_fetch_row['job']); 
            			$query_Recordset1 = mysqli_query($con, "select * from `userinfo`  WHERE vocher='".$cat_fetch_row['certificate']."'");
				$userData=mysqli_fetch_array($query_Recordset1); ?>
            </td>
                  <td><?php echo html_entity_decode($cat_fetch_row['voucherNumber']);?> </td>
			 <td width="19%" valign="top"><strong>Company Name: </strong><?php echo stripslashes(html_entity_decode($cat_fetch_row['cname']));?><br />
         
          <strong>Certificate Number: </strong><?php echo html_entity_decode($cat_fetch_row['certificate']); ?> <br />
          <strong>Concatenated: </strong><?php echo html_entity_decode($cat_fetch_row['concatenated']); ?><br />
          <strong>Demonination: </strong><?php echo html_entity_decode($cat_fetch_row['choice01']); ?><br />
          <strong>Amount: </strong><?php echo html_entity_decode($cat_fetch_row['amount']); ?><br />
          <strong>Shipped: </strong><?php echo html_entity_decode($cat_fetch_row['shipCost']); ?><br />
          <strong>Received: </strong><?php echo html_entity_decode($cat_fetch_row['received']); ?><br />
          <strong>Fulfilled: </strong><?php echo html_entity_decode($cat_fetch_row['fulfilled']); ?><br /></td>
			 <td  width="11%" valign="top">
           <strong>First Name:  </strong> <?php echo html_entity_decode($userData['fname']); ?><br />
          <strong>Last Name:</strong><?php echo html_entity_decode($userData['lname']); ?><br />
          <strong>Address: </strong><?php echo html_entity_decode($userData['address1']); ?><br />
          
          <strong>City: </strong><?php echo html_entity_decode($userData['city']); ?><br />
          <strong>State: </strong><?php echo html_entity_decode($userData['state']); ?><br />
          <strong>Zip: </strong><?php echo html_entity_decode($userData['zip']); ?><br />
          <strong>Phone: </strong><?php echo html_entity_decode($userData['phone']); ?><br />
           <strong>Email: </strong><?php echo html_entity_decode($userData['email']); ?><br />
            <strong>Demonination: </strong><?php echo html_entity_decode($userData['Demonination']); ?><br />
          
          </td>
			 <td width="14%" valign="top"><?php echo html_entity_decode($cat_fetch_row['beginredemption']); ?></td>
			 <td width="12%" valign="top"><?php echo html_entity_decode($cat_fetch_row['expiration']); ?></td>
			 <td width="14%" valign="top">
    
     
          <?php if ($cat_fetch_row['choice02']!='' && $cat_fetch_row['choice02']!=' '){  ?>

<strong>Trip 1 :</strong><?php echo html_entity_decode($cat_fetch_row['choice02']); ?><br />

<?php } ?>
<?php if ($cat_fetch_row['choice03']!='' && $cat_fetch_row['choice03']!=' '){  ?>

<strong>Trip 2:</strong><?php echo html_entity_decode($cat_fetch_row['choice03']); ?><br />

<?php } ?>



       
                  
                               
                            </td>
			<td width="11%" align="left" valign="top"><strong>Status:</strong>
          <?php
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
  if($cat_fetch_row['status']==1)
  {
	  ?>
          <div style="color:green; font-size: 18px;">Used</div>
          <?php
  
  }

  
    ?></td>
			<!--<td><button type="button" class="remove" title="Remove this row">XDelete</button></td>-->
            <td width="9%" align="left" valign="top"><span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=edit&pid=<?php echo $cat_fetch_row['id']; ?>">Edit</a> </span> | <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="?p=show2&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This Certificates?')">Delete</a> </span></td>
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




