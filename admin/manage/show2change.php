<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
	
<link rel="stylesheet" href="https://capitolmarketingdeals.com/admin/manage/style.css" />
	<!-- jQuery -->
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>-->

	<!-- Demo stuff -->
	<?php /*?><link rel="stylesheet" href="csspag/jq.css">
	<link href="csspag/prettify.css" rel="stylesheet">
	<script src="jspag/prettify.js"></script>
	<script src="jspag/docs.js"></script>

	<!-- Tablesorter: required -->
	<link rel="stylesheet" href="../csspag/theme.blue.css">
	<script src="../jspag/jquery.tablesorter.js"></script>

	<!-- Tablesorter: optional -->
	<link rel="stylesheet" href="../addons/pager/jquery.tablesorter.pager.css">
	<script src="../addons/pager/jquery.tablesorter.pager.js"></script>
	<script src="../jspag/jquery.tablesorter.widgets.js"></script><?php */?>

	<script id="js">$(function(){

	// define pager options
	var pagerOptions = {
		// target the pager markup - see the HTML block below
		container: $(".pager"),
		// output string - default is '{page}/{totalPages}'; possible variables: {page}, {totalPages}, {startRow}, {endRow} and {totalRows}
		output: '{startRow} - {endRow} / {filteredRows} ({totalRows})',
		// if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
		// table row set to a height to compensate; default is false
		fixedHeight: true,
		// remove rows from the table to speed up the sort of large tables.
		// setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
		removeRows: false,
		// go to page selector - select dropdown that sets the current page
		cssGoto:	 '.gotoPage'
	};

	// Initialize tablesorter
	// ***********************
	$("table")
		.tablesorter({
			theme: 'blue',
			headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
			widthFixed: true,
			widgets: ['zebra', 'filter']
		})

		// initialize the pager plugin
		// ****************************
		.tablesorterPager(pagerOptions);

		// Add two new rows using the "addRows" method
		// the "update" method doesn't work here because not all rows are
		// present in the table when the pager is applied ("removeRows" is false)
		// ***********************************************************************
		var r, $row, num = 50,
			row = '<tr><td>Student{i}</td><td>{m}</td><td>{g}</td><td>{r}</td><td>{r}</td><td>{r}</td><td>{r}</td><td><button type="button" class="remove" title="Remove this row">X</button></td></tr>' +
				'<tr><td>Student{j}</td><td>{m}</td><td>{g}</td><td>{r}</td><td>{r}</td><td>{r}</td><td>{r}</td><td><button type="button" class="remove" title="Remove this row">X</button></td></tr>';
		$('button:contains(Add)').click(function(){
			// add two rows of random data!
			r = row.replace(/\{[gijmr]\}/g, function(m){
				return {
					'{i}' : num + 1,
					'{j}' : num + 2,
					'{r}' : Math.round(Math.random() * 100),
					'{g}' : Math.random() > 0.5 ? 'male' : 'female',
					'{m}' : Math.random() > 0.5 ? 'Mathematics' : 'Languages'
				}[m];
			});
			num = num + 2;
			$row = $(r);
			$('table')
				.find('tbody').append($row)
				.trigger('addRows', [$row]);
			return false;
		});

		// Delete a row
		// *************
		$('table').delegate('button.remove', 'click' ,function(){
			var t = $('table');
			// disabling the pager will restore all table rows
			t.trigger('disable.pager');
			// remove chosen row
			$(this).closest('tr').remove();
			// restore pager
			t.trigger('enable.pager');
		});

		// Destroy pager / Restore pager
		// **************
		$('button:contains(Destroy)').click(function(){
			// Exterminate, annhilate, destroy! http://www.youtube.com/watch?v=LOqn8FxuyFs
			var $t = $(this);
			if (/Destroy/.test( $t.text() )){
				$('table').trigger('destroy.pager');
				$t.text('Restore Pager');
			} else {
				$('table').tablesorterPager(pagerOptions);
				$t.text('Destroy Pager');
			}
			return false;
		});

		// Disable / Enable
		// **************
		$('.toggle').click(function(){
			var mode = /Disable/.test( $(this).text() );
			$('table').trigger( (mode ? 'disable' : 'enable') + '.pager');
			$(this).text( (mode ? 'Enable' : 'Disable') + 'Pager');
			return false;
		});
		$('table').bind('pagerChange', function(){
			// pager automatically enables when table is sorted.
			$('.toggle').text('Disable');
		});

});</script>


<script type="text/javascript" language="javascript">

function activate(id){
	
		fieldset_id =id;
	$.post("contents/upaction.php?id="+fieldset_id, {
		
			}, function(response){
			
			//	alert(response);
			if(response!=0)
			{	$('#actions'+id).html(response);
				/*$("#"+id).after('<label  style="color:#105ea6" id="after_submit">Record Updated .</label>');
				$('#after_submit').fadeOut(1500);*/
			}
			else if(response==0)
			{
				$("#"+id).after('<label class="error" id="after_submit">Record Can Be Deleted .</label>');
			}
			
			
		});
		//bigMap();
       // return false;

	
}
		  
		  
		  
		  
</script>
</head>

<?php
$mes=$_REQUEST['mes'];
$com=$_REQUEST['com'];
$id=$_REQUEST['id'];
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
goUrl('?p=show2&mes=del');
}
if($com	==	'empty')	{
mysqli_query($con, "TRUNCATE TABLE `capXlsx`");
goUrl('?p=show2&mes=empty');

}
?>
<?php if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } ?>
<h2 class="table table-striped">Manage Your Vouchers[<?php echo $totalRecords;?>]</h2>
  <div align="right"><a href="?p=show2&com=empty" onClick= "return confirm('Do You Want To Delete All Vouchers?')">Delete All Records</a></div>
<div align="right"><a href="javascript:history.go(-1)">« Go Back</a></div>
<?php /*?><div class="pager">
		Page: <select class="gotoPage"></select>
		<img src="../addons/pager/icons/first.png" class="first" alt="First" title="First page" />
		<img src="../addons/pager/icons/prev.png" class="prev" alt="Prev" title="Previous page" />
		<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
		<img src="../addons/pager/icons/next.png" class="next" alt="Next" title="Next page" />
		<img src="../addons/pager/icons/last.png" class="last" alt="Last" title= "Last page" />
<select class="pagesize">
			<option selected="selected" value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
		</select>
</div><?php */?>

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
	<?php /*?><thead>
		<tr>
        <td  width="19%"><strong>job Number</strong></td>
		<td width="19%"><strong>CompanyInfo</strong></td>
      <td width="11%"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Basic Info</font></strong></td>
        <td width="14%"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Begin Redemption</font></strong></td>
        <td width="12%"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Expiration</font></strong></td>
        <td width="14%"><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Choices</font></strong></td>
      <td width="11%" ><strong><font style="font-family:Arial, Helvetica, sans-serif; ">Status</font></strong></td>
			<th class="filter-false remove sorter-false">Action</th>
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
			<td><button type="button" class="remove" title="Remove this row">XDelete</button></td>
            <td width="9%" align="left" valign="top"><span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=edit&pid=<?php echo $cat_fetch_row['id']; ?>">Edit</a> </span> | <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="?p=show2&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This Vouchers?')">Delete</a> </span></td>
		</tr>
		<?php } ?><?php */?>
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
            <td width="9%" align="left" valign="top"><span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=edit&pid=<?php echo $cat_fetch_row['id']; ?>">Edit</a> </span> | <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="#" id="actions<?php echo $cat_fetch_row['id']; ?>"  onclick="activate('<?php echo $cat_fetch_row['id']; ?>')">Delete</a> </span></td>
           
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



<?php /*?><div class="pager">
		Page: <select class="gotoPage"></select>
		<img src="../addons/pager/icons/first.png" class="first" alt="First" title="First page" />
		<img src="../addons/pager/icons/prev.png" class="prev" alt="Prev" title="Previous page" />
		<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
		<img src="../addons/pager/icons/next.png" class="next" alt="Next" title="Next page" />
		<img src="../addons/pager/icons/last.png" class="last" alt="Last" title= "Last page" />
<select class="pagesize">
			<option selected="selected" value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
		</select>
</div><?php */?>
