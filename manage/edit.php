<?php
$pid=$_GET['pid'];
//echo $pid;
$q=mysqli_query($con, "SELECT * FROM `capXlsx` WHERE `id`='".$pid."'") or mysqli_error($con);
$r=mysqli_fetch_array($q);
//echo date('m-d-Y');
if(isset($_POST['submit']))
{		
if($_POST['ex'] < date('m-d-Y')){
	$status = 1;
	}else if($_POST['ex'] == date('m-d-Y')){
		$status = 0;
		}
$sql="UPDATE `capXlsx` SET `cname`='".$_POST['c_name']."', `job`='".$_POST['job']."', `certificate`='".$_POST['certi']."', `concatenated`='".$_POST['con']."',`shipCost`='".$_POST['shipCost']."', `amount`='".$_POST['amount']."', `shipped`='".$_POST['shipped']."', `received`='".$_POST['received']."', `fulfilled`='".$_POST['fulfilled']."', `first`='".$_POST['first']."', `last`='".$_POST['last']."', `street`='".$_POST['street']."', `address2`='".$_POST['address2']."', `city`='".$_POST['city']."',
 `state`='".$_POST['state']."', `zip`='".$_POST['zip']."', `beginredemption`='".$_POST['beg']."', `expiration`='".$_POST['ex']."',`choice02`='".$_POST['Choice02']."', `choice03`='".$_POST['Choice03']."',`status` = '".$status."' WHERE `id` ='".$pid."'";
 
 
//	 echo $sql; 	
mysqli_query($con, $sql) or mysqli_error($con);
?>
<script language="javascript">
window.location.href = "?p=show2&mes=update";
</script>
<?php	
} 
?>

<h2 class="table table-striped">Edit Your Voucher</h2>
<div class="navbar" style="
    float: right;
    margin-top: 15px;
">
  <div class="navbar-inner">
    <ul class="nav">
      <li class="active"><a href="javascript:history.go(-1)">« Go Back </a></li>
    </ul>
  </div>
</div>
<form method="post" name="add-product" action="" enctype="multipart/form-data">
  <table border="0" class="table table-striped">
    <tr>
      <td width="190"><strong>Campany Name:</strong></td>
      <td width="381"><input type="text" name="c_name" value="<?php echo stripslashes(html_entity_decode($r['cname']));?>" id="c_name" class="TextField" maxlength="50"></td>
    </tr>
    <tr>
      <td valign="middle"><strong><strong>Job:</strong></strong></td>
      <td><input type="text" name="job" id="job" value="<?php echo $r['job'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Certificate</strong></td>
      <td><input type="text" name="certi" id="certi" value="<?php echo $r['certificate'];?>" class="TextField" maxlength="50"></td>
    </tr>
    <tr>
      <td><strong>concatenated:</strong></td>
      <td><input type="text" name="con" id="con" value="<?php echo $r['concatenated'];?>" class="TextField" maxlength="50" /></td>
    </tr>
    <tr>
      <td><strong>Ship Cost :</strong></td>
      <td><input type="text" name="shipCost" id="shipCost" class="TextField" value="<?php echo $r['shipCost'];?>"  /></td>
    </tr>
    <tr>
      <td><strong>Amount:</strong></td>
      <td><input type="text" name="amount" id="amount" value="<?php echo $r['amount'];?>" class="TextField" /></td>
    </tr>
    <tr>
      <td><strong>Shipped:</strong></td>
      <td><input type="text" name="shipped" id="shipped" class="TextField" value="<?php echo $r['shipped'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Received :</strong></td>
      <td><input type="text" name="received" id="received" class="TextField" value="<?php echo $r['received'];?>" /></td>
    </tr>
    <tr>
      <td><strong>fulfilled:</strong></td>
      <td><input type="text" name="fulfilled" id="fulfilled" class="TextField" value="<?php echo $r['fulfilled'];?>" /></td>
    </tr>
    <tr>
      <td><strong>First Name :</strong></td>
      <td><input type="text" name="first" id="first" class="TextField" value="<?php echo $r['first'];?>" /></td>
    </tr>
    <tr>
      <td><strong>last Name:</strong></td>
      <td><input type="text" name="last" id="last" class="TextField" value="<?php echo $r['last'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Street :</strong></td>
      <td><input type="text" name="street" id="street" class="TextField" value="<?php echo $r['street'];?>" /></td>
    </tr>
    <tr>
      <td><strong>address2:</strong></td>
      <td><input type="text" name="address2" id="address2" class="TextField" value="<?php echo $r['address2'];?>" /></td>
    </tr>
    <tr>
      <td><strong>city :</strong></td>
      <td><input type="text" name="city" id="city" class="TextField" value="<?php echo $r['city'];?>" /></td>
    </tr>
     <tr>
      <td><strong>state :</strong></td>
      <td><input type="text" name="state" id="state" class="TextField" value="<?php echo $r['state'];?>" /></td>
    </tr>
     <tr>
      <td><strong>zip :</strong></td>
      <td><input type="text" name="zip" id="zip" class="TextField" value="<?php echo $r['zip'];?>" /></td>
    </tr>
     <tr>
      <td><strong>phone :</strong></td>
      <td><input type="text" name="phone" id="phone" class="TextField" value="<?php echo $r['phone'];?>" /></td>
    </tr>
     <tr>
      <td><strong>email :</strong></td>
      <td><input type="text" name="email" id="email" class="TextField" value="<?php echo $r['email'];?>" /></td>
    </tr>
  
    <tr>
      <td><strong>BeginRedemption :</strong></td>
      <td><input type="text" name="beg" id="beg" class="TextField" value="<?php echo $r['beginredemption'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Expiration :</strong></td>
      <td><input type="text" name="ex" id="ex" class="TextField" value="<?php echo $r['expiration'];?>" />
        <p style="color:#F70416">(MM-DD-YYYY) eg : 12-25-2014</p></td>
    </tr>
    <tr>
      <td><strong>Certificate Status :</strong></td>
      <td><?php 
	  
	  $exprydate = $r['expiration'];
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
	  
	  
	
	  if($r['status']=='1' || $ex=='1' ){echo "<div style='color:red; font-size: 18px;'>Expired</div>";
	  }else if($r['status']=='2'){
		  echo "<div style='color:green; font-size:18px;'>Reedem</div>";
	  }
	  else if($r['status']=='0'){echo "<div style='color:green; font-size:18px;'>Active</div>";
	  }?></td>
    </tr>
    <!--<tr>
      <td><strong>Change Certificate Status :</strong></td>
      <td><input name="certStatus" id="ValidRadio" <?php if($r['status']=='0'){?> checked="checked" <?php } ?> type="radio" value="0" />
        <label for="ValidRadio">Valid</label>
        <input name="certStatus" id="ExpireRadio" <?php if($r['status']=='1'){?> checked="checked" <?php } ?> type="radio" value="1" />
        <label for="ExpireRadio">Expired</label></td>
    </tr>-->
   
    <tr>
      <td><strong>Choice01 :</strong></td>
      <td><input type="text" name="Choice02" id="Choice02" class="TextField" value="<?php echo $r['choice02'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice02 :</strong></td>
      <td><input type="text" name="Choice03" id="Choice03" class="TextField" value="<?php echo $r['choice03'];?>" /></td>
    </tr>
  
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="Update" class="btn"></td>
    </tr>
  </table>
</form>
