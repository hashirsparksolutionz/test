<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
	
<link rel="stylesheet" href="http://capitolmarketingdeals.com/admin/manage/style.css" />

<script type="text/javascript">

function emptyt(){
	
	document.getElementById('query').innerHTML='';
	document.getElementById('query').value='';
	
	}
</script>

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
</head>

<?php
$mes=$_REQUEST['mes'];
$com=$_REQUEST['com'];
$id=$_REQUEST['id'];
$pageLimit=25;

$Recordset2 = mysqli_query($con, "select DISTINCT job from capXlsx");
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
<h2 class="table table-striped">Manage Your Jobs[<?php echo $totalRecords;?>]</h2>
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
<table width="102%"  cellpadding="0" cellspacing="0" border="0"  id="table" class="tinytable">

         <thead>
                <tr>
                    <th width="34%"><h3>No</h3></th>
                    <th><h3>Job Number</h3></th>
                   
                   
                </tr>
            </thead>
            <tbody>
             <?php
			 $count=1;
    while($cat_fetch_row=mysqli_fetch_array($Recordset2)){ 
	if($cat_fetch_row['job'] != ''){
	?>
    
		<tr>
			<td><?php echo $count++; ?></td>
            <td><a href="?p=jobCerti&job=<?php echo $cat_fetch_row['job']; ?>"/><?php  echo $cat_fetch_row['job']; ?></a></td>
			 
			
			<!--<td><button type="button" class="remove" title="Remove this row">XDelete</button></td>-->
            
		</tr>
		<?php }
		} ?>
  </tbody>
</table>
<!-----------------paging------------------------------------->

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




