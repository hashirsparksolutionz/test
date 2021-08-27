<link rel="stylesheet" href="https://capitolmarketingdeals.com/admin/manage/style.css" />
<?php
$mes=$_REQUEST['mes'];
$com=$_REQUEST['com'];
$id=$_REQUEST['id'];
$job=$_REQUEST['job'];
$pageLimit=25;
$Recordset2 = mysqli_query($con,"select * from capXlsx where job='".$job."'");
$totalRecords = mysqli_num_rows($Recordset2);
$totalpages = ceil($totalRecords/$pageLimit);
if($mes ==	'err') { $mes		=	'Vouchers image not valid'; }
if($mes ==	'update') { $mes	=	'Vouchers has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'Vouchers has been added successfully'; }
else if($mes == 'del') {$mes	=	"Vouchers has been deleted successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
else if($mes == 'empty1') {$mes	=	"You Have Deleted All Used Vouchers  Of This Table";}
else if($mes == 'empty2') {$mes	=	"You Have Deleted All Valid Vouchers  Of This Table";}
if($com	==	'del')	{
mysqli_query($con,"DELETE FROM `capXlsx` WHERE `id`=".$id);
goUrl('?p=jobCerti&mes=del');
}
if($com	==	'empty')	{
//mysqli_query($con,"TRUNCATE TABLE `capXlsx`");
mysqli_query($con,"DELETE FROM `capXlsx` WHERE `job`='".$job."'");
goUrl('?p=jobCerti&job='.$job.'&mes=empty');

}
if($com	==	'empty1'){
//mysqli_query($con,"TRUNCATE TABLE `capXlsx`");
mysqli_query($con,"DELETE FROM `capXlsx` WHERE `job`='".$job."' and status='1'");
goUrl('?p=jobCerti&job='.$job.'&mes=empty1');

}
if($com	==	'empty2'){
//mysqli_query($con,"TRUNCATE TABLE `capXlsx`");
mysqli_query($con,"DELETE FROM `capXlsx` WHERE `job`='".$job."' and status='0'");
goUrl('?p=jobCerti&job='.$job.'&mes=empty2');

}
?>
<?php if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } ?>
<h2 class="table table-striped">Manage Your Vouchers [<?php echo $totalRecords;?>]</h2>
  <div align="right"><a href="?p=jobCerti&job=<?php  echo $job;  ?>&com=empty" onClick= "return confirm('Do You Want To Delete All Vouchers For Job Number <?php  echo $job; ?>?')">Delete All Records</a></div>
   <div align="right"><a href="?p=jobCerti&job=<?php  echo $job;  ?>&com=empty1" onClick= "return confirm('Do You Want To Delete All Used Vouchers For Job Number <?php  echo $job; ?>?')">Delete Used Vouchers</a></div>
  <div align="right"><a href="?p=jobCerti&job=<?php  echo $job;  ?>&com=empty2" onClick= "return confirm('Do You Want To Delete All Valid Vouchers For Job Number <?php  echo $job; ?>?')">Delete Valid Vouchers</a></div>
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
		  //$exprydate = $cat_fetch_row['expiration'];
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
  if($cat_fetch_row['status']==1)
  {
	  ?>
          <div style="color:blue; font-size: 18px;">Used</div>
          <?php
  
  }
 else if($ex=='1'){
	  echo "<div style='color:red; font-size:18px;'>Expired</div>";
	  } else
  {
	  ?>
          <div style="color:green; font-size:18px;">Valid</div>
          <?php 
  }
  
    ?></td>
			<!--<td><button type="button" class="remove" title="Remove this row">XDelete</button></td>-->
            <td width="9%" align="left" valign="top"><span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=edit&pid=<?php echo $cat_fetch_row['id']; ?>">Edit</a> </span> | <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="?p=jobCerti&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This Vouchers?')">Delete</a> </span></td>
		</tr>
		<?php } ?>
  </tbody>
</table>
<!-----------------paging------------------------------------->

<div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="https://capitolmarketingdeals.com/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="https://capitolmarketingdeals.com/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="https://capitolmarketingdeals.com/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="https://capitolmarketingdeals.com/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
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




