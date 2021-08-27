<?php
session_start();
require_once('../../../includes/myconn.php');

if(isset($_POST['searchdata']) && !empty($_POST['searchdata'])){
	
	
	$search_col = $_POST['scol'];
	$search = "'%".$_POST['searchdata']."%'";
	$s =  $search_col .' LIKE '. trim($search);
	$q = "SELECT 	*	FROM  userinfo  WHERE ".$s;
	
	}else{
		$q="SELECT 	*	FROM  userinfo ";

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
	$field='id';
	}



if(isset($_POST['searchdata']) && !empty($_POST['searchdata'])){
	
	$search_col = $_POST['scol'];
	$search = "'%".$_POST['searchdata']."%'";
	
	
	
	$s =  $search_col .' LIKE '. trim($search);
	$query = "SELECT 
	
	id,
	fname,
	lname,
	address1,
	city,
	state,
	zip,
	phone,s_check,
	vocher,
	email
	
	FROM  userinfo  WHERE  ".$s."
	 ORDER BY $field $sort limit $start,$recordsPerPage";
	//echo $query;die;
	}else{
		//$query="select id,redemption_code,job,denomination,createdon,beginredemption,expiration,choice01 from capXlsxn where status=0 ORDER BY $field $sort limit $start,$recordsPerPage";
		$query="select 
	
	id,
	fname,
	lname,
	address1,
	city,
	state,
	zip,
	phone,s_check,
	vocher,
	email from userinfo  ORDER BY $field $sort limit $start,$recordsPerPage";

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
                	<th width="4%"><h3>First Name</h3></th>
                    <th width="4%"><h3>Last Name</h3></th>
                    <th><h3>Basic Info</h3></th>
               
                    
                    <th><h3>Certificate</h3></th>
                   
                    <th><h3>Status</h3></th>
                    <th><h3>Action</h3></th>   
                </tr>
            </thead>
            <tbody>
             <?php $counter=(($page-1)*$recordsPerPage)+1;



 

    while($cat_fetch_row=mysqli_fetch_assoc($res)){
/* echo "<pre>";
print_r($cat_fetch_row);
echo "</pre>"; */
	
	?>
    
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
		  if($cat_fetch_row['s_check']=='0'){
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
 else if($cat_fetch_row['s_check']=='0'){

	  echo "<div style='color:blue; font-size:18px;'>Valid</div>";
	  }
	  else if($cat_fetch_row['s_check']=='1'){

	  echo "<div style='color:Green; font-size:18px;'>Used</div>";
	  }
	 
  
    ?></td>
			<!--<td><button type="button" class="remove" title="Remove this row">XDelete</button></td>-->
            <td width="15%" align="left"> <span href="#" class="btn btn-small"> <i class="icon-delete "> </i> <a href="?p=viewuser&com=del&page=<?php echo $page;?>&id=<?php echo $cat_fetch_row['id']; ?>" onClick= "return confirm('Do You Want To Delete This User?')">Delete</a></span>  | <span class="btn btn-small"> <i class="icon-edit "> </i> <a href="?p=edituser2&id=<?php echo $cat_fetch_row['id']; ?>">Edit</a> </span></td>
		</tr>
		<?php }

?>
</tbody>
</table>
<?php
echo $pagination;
?>
