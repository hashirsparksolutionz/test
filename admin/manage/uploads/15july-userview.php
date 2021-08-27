<link rel="stylesheet" href="http://capitolmarketingdeals.com/admin/manage/style.css" />
<?php
set_time_limit(90);
require_once "simplexlsx.class.php";
	
?><div><strong style="font-size: 20px;">Recently Uploaded Document</strong></div>
<div>
<?php 
if (isset($_REQUEST['id']))
 {
	$search 	   = mysqli_query($con, "SELECT * FROM `upload` WHERE `id`='".$_REQUEST['id']."' AND `type`='".$_REQUEST['type']."'");
	$rec = mysqli_fetch_array($search);
	
	//exit();
	$xlsx = new SimpleXLSX('uploads/'.$rec['userData']);
	 list($cols, $row) = $xlsx->dimension();
	?>
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
    <table width="102%"  cellpadding="0" cellspacing="0" border="0"  id="table" class="tinytable"/><?php
	 foreach( $xlsx->rows() as $k => $r)
	 {
		 if ($k == 0)
		 {?>
        
			         <thead>

  <tr>
    <th><h3><?php echo $r[0]; ?></h3></th>
   <th><h3><?php echo $r[1]; ?></h3></th>
   <th><h3><?php echo $r[2]; ?></h3></th>
    <th><h3><?php echo $r[3]; ?></h3></th>
    <th><h3><?php echo $r[4]; ?></h3></th>
    <th><h3><?php echo $r[5]; ?></h3></th>
    <th><h3><?php echo $r[6]; ?></h3></th>
   <th><h3><?php echo $r[7]; ?></h3></th>
    <th><h3><?php echo $r[8]; ?></h3></th>
   <th><h3><?php echo $r[9]; ?></h3></th>
     <th><h3><?php echo $r[10]; ?></h3></th>
      <th><h3><?php echo $r[11]; ?></h3></th>
           <th><h3><?php echo $r[12]; ?></h3></th>
      <th><h3><?php echo $r[13]; ?></h3></th>
           <th><h3><?php echo $r[14]; ?></h3></th>
      <th><h3><?php echo $r[15]; ?></h3></th>
           <th><h3><?php echo $r[16]; ?></h3></th>
      <th><h3><?php echo $r[17]; ?></h3></th>
      
            <th><h3><?php echo $r[18]; ?></h3></th>
           <th><h3><?php echo $r[19]; ?></h3></th>
      <th><h3><?php echo $r[20]; ?></h3></th>
           <th><h3><?php echo $r[21]; ?></h3></th>
      <th><h3><?php echo $r[22]; ?></h3></th>
           <th><h3><?php echo $r[23]; ?></h3></th>
      <th><h3><?php echo $r[24]; ?></h3></th>
      
            <th><h3><?php echo $r[25]; ?></h3></th>
           <th><h3><?php echo $r[26]; ?></h3></th>
      <th><h3><?php echo $r[27]; ?></h3></th>
           <th><h3><?php echo $r[28]; ?></h3></th>
      <th><h3><?php echo $r[29]; ?></h3></th>
           <th><h3><?php echo $r[30]; ?></h3></th>
   
   
  
  </tr>
  </thead>
            <tbody>
  <?php
		 continue;
		 }?>
		<tr>
    <td><?php echo $r[0]; ?></td>
    <td><?php echo $r[1]; ?></td>
    <td><?php echo $r[2]; ?></td>
    <td><?php echo $r[3]; ?></td>
    <td><?php echo $r[4]; ?></td>
    <td><?php echo $r[5]; ?></td>
    <td><?php if($r[6]!=''){  $sh=date('m-d-Y', mktime(0,0,0,1,$r[6]-1,1900)); echo $sh;} ?></td>
    <td><?php echo $r[7]; ?></td>
    <td><?php echo $r[8]; ?></td>
    <td><?php if($r[9]!=''){  $c=date('m-d-Y', mktime(0,0,0,1,$r[9]-1,1900)); echo $c;} ?></td>
      <td><?php if($r[10]!=''){  $b=date('m-d-Y', mktime(0,0,0,1,$r[10]-1,1900)); echo $b;} ?></td>
    <td><?php if($r[11]!=''){  $e=date('m-d-Y', mktime(0,0,0,1,$r[11]-1,1900)); echo $e;} ?></td>
      <td><?php echo $r[12]; ?></td>
    <td><?php echo $r[13]; ?></td>
      <td><?php echo $r[14]; ?></td>
    <td><?php echo $r[15]; ?></td>
      <td><?php echo $r[16]; ?></td>
    <td><?php echo $r[17]; ?></td>
    
      <td><?php echo $r[18]; ?></td>
    <td><?php echo $r[19]; ?></td>
      <td><?php echo $r[20]; ?></td>
    <td><?php echo $r[21]; ?></td>
      <td><?php echo $r[22]; ?></td>
    <td><?php echo $r[23]; ?></td>
      <td><?php echo $r[24]; ?></td>
    <td><?php echo $r[25]; ?></td>
    
         <td><?php echo $r[26]; ?></td>
    <td><?php echo $r[27]; ?></td>
      <td><?php echo $r[28]; ?></td>
    <td><?php echo $r[29]; ?></td>
      <td><?php echo $r[30]; ?></td>
 
   
    
  </tr>
<?php		
	 }
  
   ?> </tbody>
</table><?php
	 
}else
   {
	   $mes="File does not exist";
   }
?>
 
</div>

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

