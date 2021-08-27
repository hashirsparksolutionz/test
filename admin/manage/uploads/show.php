<link rel="stylesheet" href="https://capitolmarketingdeals.com/admin/manage/style.css" />
<?php  
$com	=	$_GET['com'];
$id 	= 	$_GET['id'];
$search 	   = mysqli_query($con, "SELECT * FROM `upload` WHERE `type`=2 ORDER BY id desc");
$totalRecords=mysqli_num_rows($search);
if($mes == 'del'){$mes = "Your File Has Been Deleted Successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
if($com	==	'del'){
	$img_unlink = mysqli_query($con, "SELECT * FROM `upload` WHERE `id` = ".$id);
	$unlink_img = mysqli_fetch_array($img_unlink);
	$row_unlink  = $unlink_img['userData'];
	unlink("uploads/".$row_unlink);
	mysqli_query($con, "DELETE FROM `upload` WHERE `id` = ".$id);
	
	goUrl('?p=VoucherUploads&mes=del&page='.$page);
}
if($com	==	'empty')	{
mysqli_query($con, "DELETE FROM `upload` WHERE `type`='2'");
goUrl('?p=VoucherUploads&mes=empty');

}
 ?>
<h2 class="table table-striped">Uploaded Certificates Files[<?php echo $totalRecords;?>]</h2>
  <div align="right"><a href="?p=VoucherUploads&com=empty" onClick= "return confirm('Do You Want To Delete All Vouchers?')">Delete All Records</a></div>
<div align="right"><a href="javascript:history.go(-1)"/>« Go Back</a></div>
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
<table width="102%"  cellpadding="0" cellspacing="0" border="0"  id="table" class="tinytable"/>

         <thead>

  <tr>
   
    <th><h3>Name</h3></th>
    <th><h3>Date</h3></th>
    <th><h3>Action</h3></th>
     
  </tr>
            </thead>
            <tbody>

  <?php while($rowRecs=mysqli_fetch_array($search ))
  {
	  ?>
  <tr>
    
    <td><?php echo stripslashes($rowRecs['userData']); ?></td>
    
	<td><?php echo stripslashes($rowRecs['date']); ?></td> <td align="center"><a href="uploads/<?php echo stripslashes($rowRecs['userData']); ?>" target="_new"><img src="http://cmc-ftp.com/images/attachment.png" alt="Edit" width="16" height="16" border="0" style="width: 18px; height: 18px;" />Show Attachment</a>&nbsp;&nbsp;&nbsp;<a href="?p=<?php echo $p; ?>&com=del&id=<?php echo $rowRecs['id']; ?>&page=<?php echo $page; ?>" onClick="return confirm('Do You Want To Delete This Record?')"><img src="http://cmc-ftp.com/images/cross.png" style="height: 16px;" alt="Delete" width="16" height="16" border="0" />Delete</a>&nbsp;&nbsp;&nbsp;<a href="?p=view&id=<?php echo $rowRecs['id']; ?>&page=<?php echo $page; ?>&type=2"><img src="../../images/view33.png" style="height: 16px;" alt="Delete" width="16" height="16" border="0" />View</a></td>
 </tr>
  <?php 
   } ?>

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


