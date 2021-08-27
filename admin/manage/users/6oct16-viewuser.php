<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
	
<link rel="stylesheet" href="http://capitolmarketingdeals.com/admin/manage/style.css" />
<style type="text/css">
    .span6{
		width: 980px !important;
		}
    
    </style>

	
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
else if($mes == 'send') {$mes	=	"Email Have Been Send";}
if($com	==	'del')	{
mysqli_query($con, "DELETE FROM `userinfo` WHERE `id`=".$id);
goUrl('?p=viewuser&mes=del');
}
if($com	==	'empty'){
mysqli_query($con, "TRUNCATE TABLE `userinfo`");
goUrl('?p=viewuser&mes=empty');

}
//email
if($com	=='email'){

	$Recordset3 = mysqli_query($con, "select * from userinfo where id='".$id."'");
$fetch_r = mysqli_fetch_array($Recordset3);
$voucher=$fetch_r['vocher'];
$to=$fetch_r['email'];
$Demonination=$fetch_r['Demonination'];
$exp_date=$fetch_r['expiration'];

//////////////////////Email Send/////////////////////////////////////////
	$rslt1=mysqli_query($con, "SELECT * FROM `users` WHERE  id ='1'");



$title1=mysqli_fetch_array($rslt1);



$admin= $title1['email'];
	
	$bounce="bounce@pypvouchers.com";
	$subject = 'Furniture Row '; 

    $headers 	= "From: Furniture Row <".$admin.">".PHP_EOL;

	$headers .= "Return-Path: ".$bounce.PHP_EOL;

	$headers .= "MIME-Version: 1.0".PHP_EOL;

	$headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;

	//$body = " $head <br />";

	$body	='<div style="width: 960px; margin: auto;">

  <div style="background-image: url(http://www.pypvouchers.com/images/email_header.png); background-repeat: no-repeat; background-position: center top; height: 300px; border-left: 2px solid #B13427;
border-right: 2px solid #B13427;
border-top: 2px solid #B13427;"></div>

   <div style="background-image: url(http://www.pypvouchers.com/images/border.png); background-repeat: repeat-y; background-position: center center; border-left: 2px solid #B13427;
border-right: 2px solid #B13427;">

    <table width="820" border="0" align="center" cellpadding="0" cellspacing="0">

      <tbody>

        <tr>

          <td colspan="2"><div class="logo-div" style="text-align: center; line-height:0px;"> <a href="http://www.pypvouchers.com" target="_blank"></a></div>

            <table width="100%" cellpadding="0" cellspacing="0">

              

			  <tr>

                <td colspan="4" style="text-align:center"><div style="font-family:Verdana,Tahoma,Arial,sans-serif; color:#444444;font-weight: bold; font-size: 14px;">The Specialty Stores at</div>

    <div style="font-family:Verdana,Tahoma,Arial,sans-serif; color:#B13427;font-weight: bold;font-size:42px;">Furniture Row</div></td>

               

              </tr>

			  <tr>

                <td width="35%" align="right"><h3>Certificate #: </h3></td>

                <td width="12%"><div style="color:#B13427; font-size:24;"><h3>'.$voucher.'</h3></div></td>

                <td width="25%" align="right"><h3>Certificate Value:</h3></td>

                <td width="28%"><div style="color:#B13427; font-size:24;"><h3>$'.$Demonination.'</h3></div></td>

              </tr>

              <tr>

                <td><h1 style="color:#b0352b;font-size: 40px;">Home&nbsp;Depot&nbsp;</h1></td>

                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;Kohl&rsquo;s&nbsp;</h1></td>

                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;&nbsp;Target&nbsp;</h1></td>

                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;&nbsp;Visa&nbsp;</h1></td>

              </tr>

            </table>

            <div class="clr" style="clear: both;"> </div>

            <div title="Page 1">

              <div>

                <div>

                  <div>

                    <h2 align="center">To redeem your gift card go to <a href="http://pypvouchers.com" style="color:#B13427; text-decoration:underline;" target="_blank">http://pypvouchers.com</a></h2>

                    <p style="margin-left:15px">Gift Card Terms &amp; Conditions: </p>

                    <ul>

                      <li> Capitol Marketing Concepts reserves the right to substitute a comparable gift card. </li>

                      <li> You have received this certificate as part of a business promotion. The business promoter who granted the certificate to you specifically conditions its redemption upon full payment to Capitol Marketing Concepts. </li>

                      <li> All taxes are the responsibility of the person receiving the redemption. </li>

                      <li> Certificates are completely transferable, but may not be resold under any circumstances. Notice of resell will void the certificate. </li>

                      <li> Once your certificate is received allow 2-4 weeks for processing and delivery. The package you selected will be sent to you via the US Postal Service. Failure to adhere to all Terms &amp; Conditions may hinder the processing of your certificate. </li>

                      <li> Offer not valid after expiration date under any circumstance. </li>

                    </ul>

                  </div>

                </div>

              </div>

            </div></td>

        </tr>

        <tr>

          <td colspan="2"><h3 align="center">For Questions related to gift cards please call 1-888-411-7447</h3></td>

        </tr>

        <tr>

          <td width="408" style="padding-left: 150px;">Florida Seller of Travel Numbers for<br />

            Capitol Marketing Concepts: ST36176 </td>

          <td width="444" style="padding-right: 150px;" align="right"><strong>Expiration Date:</strong>'.$exp_date.'</td>

        </tr>

      </tbody>

    </table>

  </div>

  <div style="background-image: url(http://www.pypvouchers.com/images/bottom.png); background-repeat: no-repeat; background-position: center top; height: 36px; width: 956px; border-left: 2px solid #B13427;
border-right: 2px solid #B13427;
border-bottom: 2px solid #B13427;"></div>

</div>'; 



	

//$body .= " $foot <br />";



	mail($to,$subject,$body,$headers);
















//////////////////////////END //////////////////////////////////////

goUrl('?p=viewuser&mes=send');

}


?>
<?php if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } ?>
<script type="text/javascript">

function emptyt(){
	
	document.getElementById('query').innerHTML='';
	document.getElementById('query').value='';
	
	}
</script>
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
        			<div><a href="javascript:sorter.reset()"  onclick="emptyt()">Reset</a></div>
        	</span>
        </div>
<table width="1072"  cellpadding="0" cellspacing="0" border="0"  id="table" class="tinytable">

         <thead>
                <tr>
                    <th width="4%"><h3>First Name</h3></th>
                    <th width="4%"><h3>Last Name</h3></th>
                    <th><h3>Basic Info</h3></th>
               
                    
                    <th><h3>Certificate</h3></th>
                   
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
			 <td  width="8%" valign="top">
  
          <strong>Address:</strong><?php echo html_entity_decode($cat_fetch_row['address1']); ?><br />
       
          <strong>City:</strong><?php echo html_entity_decode($cat_fetch_row['city']); ?><br />
          <strong>State:</strong><?php echo html_entity_decode($cat_fetch_row['state']); ?><br />
          <strong>Zip:</strong><?php echo html_entity_decode($cat_fetch_row['zip']); ?><br />
          <strong>Phone:</strong><?php echo html_entity_decode($cat_fetch_row['phone']); ?><br />
           <strong>Email:</strong><?php echo html_entity_decode($cat_fetch_row['email']); ?><br />
          </td>
			 
			 
              
			 <td width="11%">
         	 <?php echo html_entity_decode($cat_fetch_row['vocher']); ?>
              
          
       
                               
                            </td>
                             
                             
                            
                             
			<td width="9%" align="left"><strong>Status:</strong>
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
            <td width="15%" align="left"> <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="?p=viewuser&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This User?')">Delete</a></span>  | <span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=edituser2&id=<?php echo $cat_fetch_row['id']; ?>">Edit</a> </span></td>
		</tr>
		<?php } ?>
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




