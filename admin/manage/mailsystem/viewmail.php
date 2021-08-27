<link rel="stylesheet" href="http://capitolmarketingdeals.com/admin/manage/style.css" />
<style type="text/css">
    .span6{
		width: 979px !important;
		}
    
    </style>

<?php  
$com	=	$_GET['com'];
$id 	= 	$_GET['id'];
$mes=$_REQUEST['mes'];
$search 	   = mysqli_query($con, "SELECT * FROM `mail` ORDER BY id DESC");
$totalRecords=mysqli_num_rows($search);
if($mes == 'del'){$mes1 = "Your Email Has Been Deleted Successfully";}
else if($mes == 'empty') {$mes1	=	"You Have Deleted All The Records Of This Table";}
else if($mes == 'update') {$_SESSION['update']='Your Email Has Been Updated Successfully';}

if($com	==	'del'){
	
	mysqli_query($con, "DELETE FROM `mail` WHERE `id` = ".$id);
	
	goUrl('?p=viewmail&mes=del');
}
if($com	==	'empty')	{
//mysqli_query($con, "DELETE FROM `upload` WHERE `type`='1'");
mysqli_query($con, "TRUNCATE table `mail`");
goUrl('?p=viewmail&mes=empty');

}
 ?><script type="text/javascript">

function emptyt(){
	
	document.getElementById('query').innerHTML='';
	document.getElementById('query').value='';
	
	}
</script>
 <h2 class="table table-striped">Manage Email[<?php echo $totalRecords;?>]</h2>
 <?php
 if (isset($_SESSION['update']))
      {

      ?>
        <div class="alert alert-success" style="width: auto;height: auto;padding: 5px;background-color: #e0f2cb;border: 1px solid #ccebac;color: #6da827;font-family: Arial, Helvetica, sans-serif;font-size: 12px;"> <strong><?php echo $_SESSION['update']; ?></strong></div>
    <?php 
	unset($_SESSION['update']);
      } 
 else 
  if($mes1!= '')	{ ?>
      <div class="alert alert-error"><?php echo $mes1; ?>
      </div><?php } ?>
 <div align="right"><a href="?p=viewmail&com=empty" onClick= "return confirm('Do You Want To Delete All Emails?')">Delete All Records</a></div>
<div align="right"><a href="javascript:history.go(-1)">« Go Back</a></div>
	
 <div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()" onclick="emptyt()">Reset</a></div>
        	</span>
        </div>	
<table width="102%"  cellpadding="0" cellspacing="0" border="0"  id="table" class="tinytable"/>

         <thead>

  <tr>
   
    <th><h3>No</h3></th>
    <th><h3>Email</h3></th>
    <th><h3>Action</h3></th>
     
  </tr>
            </thead>
            <tbody>

  <?php 
  $counter=1;
  while($rowRecs=mysqli_fetch_array($search ))
  {
	  ?>
  <tr>
    
    <td><?php echo $counter++; ?></td>
    
 	<td><?php echo stripslashes($rowRecs['email']); ?></td> 
    <td align="center"><a href="?p=<?php echo $p; ?>&com=del&id=<?php echo $rowRecs['id']; ?>" onClick="return confirm('Do You Want To Delete This Record?')"><img src="http://cmc-ftp.com/images/cross.png" style="height: 16px;" alt="Delete" width="16" height="16" border="0" />Delete</a>&nbsp;&nbsp;&nbsp;<a href="?p=eidtmail&id=<?php echo $rowRecs['id']; ?>"><img src="../../images/view33.png" style="height: 16px;" alt="Delete" width="16" height="16" border="0" />Edit</a></td> 
  </tr>
  <?php 
   } ?>
 </tbody>
</table
><!-----------------paging------------------------------------->

<div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="http://capitolmarketingdeals.com/images/first.gif" style=" height: 16px;width: 16px;" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="http://capitolmarketingdeals.com/images/previous.gif" style=" height: 16px;width: 16px;" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="http://capitolmarketingdeals.com/images/next.gif" style=" height: 16px;width: 16px;" alt="First Page" onclick="sorter.move(1)" />
                    <img src="http://capitolmarketingdeals.com/images/last.gif" style=" height: 16px;width: 16px;" alt="Last Page" onclick="sorter.move(1,true)" />
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
<script type="text/javascript" src="http://capitolmarketingdeals.com/admin/manage/script.js"></script>
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
