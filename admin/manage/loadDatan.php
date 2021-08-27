<?php
session_start();
require_once('../../includes/myconn.php');

if(isset($_POST['searchdata']) && !empty($_POST['searchdata'])){
	
	
	$search_col = $_POST['scol'];
	$search = "'%".$_POST['searchdata']."%'";
	$s =  $search_col .' LIKE '. trim($search);
	$q = "SELECT c.certificate	FROM capXlsx c, userinfo u WHERE c.status='0' AND c.certificate = u.vocher AND ".$s;
	
	}else{
		$q="SELECT 	c.*,u.*	FROM capXlsx c, userinfo u where c.status='0' AND c.certificate = u.vocher ";

		}

$res    = mysqli_query($con, $q) or die(mysqli_error($con));
$count  = mysqli_num_rows($res);
$page = (int) (!isset($_REQUEST['pageId']) ? 1 :$_REQUEST['pageId']);
$page = ($page == 0 ? 1 : $page);
$recordsPerPage = 25;
$start = ($page-1) * $recordsPerPage;
$adjacents = "5";
$_SESSION['countertt']=$count;

$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($count/$recordsPerPage);
$lpm1 = $lastpage - 1;   
$pagination = "";
if($lastpage > 1)
    {   
        $pagination .= "<div class='paginationp'>";
        if ($page > 1)
            $pagination.= "<a href=\"#Page=".($prev)."\" onClick='changePagination(".($prev).");'>&laquo; Previous&nbsp;&nbsp;</a>";
        else
            $pagination.= "<span class='disabled'>&laquo; Previous&nbsp;&nbsp;</span>";   
        if ($lastpage < 7 + ($adjacents * 2))
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class='currentp'>$counter</span>";
                else
                    $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     

            }
        }   

        elseif($lastpage > 5 + ($adjacents * 2))
        {
            if($page < 1 + ($adjacents * 2))
            {
                for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if($counter == $page)
                        $pagination.= "<span class='currentp'>$counter</span>";
                    else
                        $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
                }
                $pagination.= "...";
                $pagination.= "<a href=\"#Page=".($lpm1)."\" onClick='changePagination(".($lpm1).");'>$lpm1</a>";
                $pagination.= "<a href=\"#Page=".($lastpage)."\" onClick='changePagination(".($lastpage).");'>$lastpage</a>";   

           }
           elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
           {
               $pagination.= "<a href=\"#Page=\"1\"\" onClick='changePagination(1);'>1</a>";
               $pagination.= "<a href=\"#Page=\"2\"\" onClick='changePagination(2);'>2</a>";
               $pagination.= "...";
               for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
               {
                   if($counter == $page)
                       $pagination.= "<span class='currentp'>$counter</span>";
                   else
                       $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
               }
               $pagination.= "..";
               $pagination.= "<a href=\"#Page=".($lpm1)."\" onClick='changePagination(".($lpm1).");'>$lpm1</a>";
               $pagination.= "<a href=\"#Page=".($lastpage)."\" onClick='changePagination(".($lastpage).");'>$lastpage</a>";   
           }
           else
           {
               $pagination.= "<a href=\"#Page=\"1\"\" onClick='changePagination(1);'>1</a>";
               $pagination.= "<a href=\"#Page=\"2\"\" onClick='changePagination(2);'>2</a>";
               $pagination.= "..";
               for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
               {
                   if($counter == $page)
                        $pagination.= "<span class='currentp'>$counter</span>";
                   else
                        $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
               }
           }
        }
        if($page < $counter - 1)
            $pagination.= "<a href=\"#Page=".($next)."\" onClick='changePagination(".($next).");'>Next &raquo;</a>";
        else
            $pagination.= "<span class='disabled'>Next &raquo;</span>";

        $pagination.= "</div>";       
    }










if(isset($_SESSION['sorting']))
{
  if($_SESSION['sorting']=='ASC')
  {
  $sort='DESC';
  }
  else
  {
    $sort='ASC';
	$_SESSION['sorting'] =  'ASC';
  }
}else{
	 $sort='ASC';
	 $_SESSION['sorting'] =  'ASC';
	}
	
if(isset($_POST['sortcol']) && !empty($_POST['sortcol'])){
	$field = $_POST['sortcol'];
}else{
	$field='c.id';
	}



if(isset($_POST['searchdata']) && !empty($_POST['searchdata'])){
	
	$search_col = $_POST['scol'];
	$search = "'%".$_POST['searchdata']."%'";
	
	
	if($search_col == "c.certificate"){
		$search = str_replace(" ","",$search);
	}
	$s =  $search_col .' LIKE '. trim($search);
	$field='c.id';
	$query = "SELECT 
	c.cname,
	c.id,
	c.job,
	c.certificate ,
	c.concatenated,
	c.voucherNumber,
	
	c.beginredemption,
	c.expiration,
	c.choice01,
	c.choice02,
	c.choice03,
	c.choice04,
	c.choice05,
	c.choice06,
	c.choice07,
	c.choice08,
	c.choice09,
	c.choice10,
	c.choice11,
	c.choice12,
	c.choice13,
	c.choice14,
	c.choice15,
	u.fname,
	u.lname,
	u.address1,
	u.city,
	u.state,
	u.zip,
	u.phone,
	u.email
	
	FROM capXlsx c, userinfo u WHERE c.status='0' AND c.certificate = u.vocher AND ".$s."
	 ORDER BY $field $sort limit $start,$recordsPerPage";
	//echo $query;die;
	}else{
		//$query="select id,redemption_code,job,denomination,createdon,beginredemption,expiration,choice01 from capXlsxn where status=0 ORDER BY $field $sort limit $start,$recordsPerPage";
		$query="select c.cname,
	c.id,
	c.job,
	c.certificate ,
	c.concatenated,
	c.voucherNumber,
	
	c.beginredemption,
	c.expiration,
	c.choice01,
	c.choice02,
	c.choice03,
	c.choice04,
	c.choice05,
	c.choice06,
	c.choice07,
	c.choice08,
	c.choice09,
	c.choice10,
	c.choice11,
	c.choice12,
	c.choice13,
	c.choice14,
	c.choice15,
	u.fname,
	u.lname,
	u.address1,
	u.city,
	u.state,
	u.zip,
	u.phone,
	u.email from capXlsx c,userinfo u where c.status='0' AND c.certificate = u.vocher  ORDER BY $field $sort limit $start,$recordsPerPage";

		}


$res    =   mysqli_query($con, $query) or die(mysqli_error($con));
$count  =   mysqli_num_rows($res);


$endrec = $start+$recordsPerPage;
if( $endrec > $_SESSION['countertt'] )
	$endrec = $_SESSION['countertt'];
?>
<p style="display:none" class='start_rec'><?php echo $start; ?></p>

<p style="display:none" class='end_rec'><?php echo $endrec; ?></p>

<p style="display:none" class='total_rec'><?php echo $_SESSION['countertt']; ?></p>
        
       <?php  if(!$count){?>
	 <span id="error_msg" style="display:none"> Sorry, No record found.</span>
	<?php  } ?>
	
<table width="102%"  cellpadding="0" cellspacing="0" border="0"  id="table" class="tinytable" style="width: 1036px;">
	
         <thead>
                <tr>
                	<th><h3>job Number</h3></th>
                    <th><h3>Voucher Number</h3></th>
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
             <?php $counter=(($page-1)*$recordsPerPage)+1;



 

    while($cat_fetch_row=mysqli_fetch_assoc($res)){ ?>
    
   <tr>
			<td><?php echo html_entity_decode($cat_fetch_row['job']); 	?></td>
            <td><?php echo html_entity_decode($cat_fetch_row['voucherNumber']);?> </td>
			 <td width="19%" valign="top">
				<strong>Company Name:</strong><?php echo stripslashes(html_entity_decode($cat_fetch_row['cname']));?><br />
         
				<strong>Certificate Number: </strong><?php echo trim(html_entity_decode($cat_fetch_row['certificate'])); ?> <br />
         
		  </td>
			 
			 <td  width="11%" valign="top">
             <strong>First Name:  </strong> <?php echo html_entity_decode($cat_fetch_row['fname']); ?><br />
          <strong>Last Name:</strong><?php echo html_entity_decode($cat_fetch_row['lname']); ?><br />
          <strong>Address: </strong><?php echo html_entity_decode($cat_fetch_row['address1']); ?><br />
          
          <strong>City: </strong><?php echo html_entity_decode($cat_fetch_row['city']); ?><br />
          <strong>State: </strong><?php echo html_entity_decode($cat_fetch_row['state']); ?><br />
          <strong>Zip: </strong><?php echo html_entity_decode($cat_fetch_row['zip']); ?><br />
          <strong>Phone: </strong><?php echo html_entity_decode($cat_fetch_row['phone']); ?><br />
           <strong>Email: </strong><?php echo html_entity_decode($cat_fetch_row['email']); ?><br />
          </td>
			 <td width="14%" valign="top"><?php echo html_entity_decode($cat_fetch_row['beginredemption']); ?></td>
			 <td width="12%" valign="top"><?php echo html_entity_decode($cat_fetch_row['expiration']); ?></td>
			 <td width="14%" valign="top">
   
    
          <?php 
		  
		  for($i=1;$i<26;$i++){
			  if($i<10)
				  $ch = 'choice0'.$i;
			  else
				  $ch = 'choice'.$i;
			  
			  if(!empty($cat_fetch_row[$ch])){ ?>
				 	
					<strong>Trip<?php echo $i; ?>:</strong><?php echo html_entity_decode($cat_fetch_row[$ch]); ?><br />
 
			  <?php }
			  
		  }
		  
		 ?> 
		  
		 

       
                               
                            </td>
			<td width="11%" align="left" valign="top"><strong>Status:</strong>
          <?php
		  $exprydate = $cat_fetch_row['expiration'];
		  if($exprydate!=''){
		  	  $exdate=explode('-',$exprydate);
		  $date=$exdate['2']."-".$exdate['0']."-".$exdate['1'];
		  
		  
		   
		   $days = (strtotime($date) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
		   
		
			 if($days<0){
			 $ex =1;
		 }else{
			  $ex =0;
		 }
		  }
  if($ex==1)
  {
	  ?>
          <div style="color:red; font-size: 18px;">Expired</div>
          <?php
  
  }
 else if($cat_fetch_row['status']==0){
// else if($exprydate >= date("m-d-Y")){
	  //echo explode('-'.$exprydate);
	  echo "<div style='color:blue; font-size:18px;'>Assigned</div>";
	  }
	 
  
    ?></td>
			<!--<td><button type="button" class="remove" title="Remove this row">XDelete</button></td>-->
            <td width="20%" align="left" valign="top"><a href="?p=edit&pid=<?php echo $cat_fetch_row['id']; ?>"><span class="btn btn-small"> <i class="icon-edit "> </i> Edit </span></a> |
			<a href="?p=show2&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This Certificate?')"><span href="#" class="btn btn-small"> <i class="icon-delete "> </i> Delete</span></a> </td>
		</tr>
		<?php }

?>
</tbody>
</table>
<?php
echo $pagination;
?>
