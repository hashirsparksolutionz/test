<?php
$pid=$_GET['pid'];
//echo $pid;
$q=mysqli_query($con, "SELECT * FROM `capXlsx` WHERE `id`='".$pid."'") or mysqli_error($con);
$r=mysqli_fetch_array($q);
date('m-d-Y');
if(isset($_POST['submit']))
{		
if($_POST['ex'] < date('m-d-Y')){
	$status = 0;
	}else if($_POST['ex'] == date('m-d-Y')){
		$status = 0;
		}
$sql="UPDATE `capXlsx` SET `cname`='".$_POST['c_name']."', `job`='".$_POST['job']."', `certificate`='".$_POST['certi']."', `concatenated`='".$_POST['con']."', `amount`='".$_POST['amount']."', `shipCost`='".$_POST['shipCost']."', `received`='".$_POST['rec']."', `fulfilled`='".$_POST['full']."', `first`='".$_POST['fir']."', `last`='".$_POST['last']."', `street`='".$_POST['street']."', `city`='".$_POST['city']."',
 `state`='".$_POST['state']."', `zip`='".$_POST['zip']."', `beginredemption`='".$_POST['beg']."', `expiration`='".$_POST['ex']."', `choice01`='".$_POST['Choice01']."', `choice02`='".$_POST['Choice02']."', `choice03`='".$_POST['Choice03']."', `choice04`='".$_POST['Choice04']."', `choice05`='".$_POST['Choice05']."' , `choice06`='".$_POST['Choice06']."', `choice07`='".$_POST['Choice07']."', `choice08`='".$_POST['Choice08']."', `choice09`='".$_POST['Choice09']."', `choice10`='".$_POST['Choice10']."', `choice11`='".$_POST['Choice11']."', `choice12`='".$_POST['Choice12']."', `choice13`='".$_POST['Choice13']."', `choice14`='".$_POST['Choice14']."', `choice15`='".$_POST['Choice15']."' , `choice16`='".$_POST['Choice16']."', `choice17`='".$_POST['Choice17']."', `choice18`='".$_POST['Choice18']."', `choice19`='".$_POST['Choice19']."', `choice20`='".$_POST['Choice20']."', `choice21`='".$_POST['Choice21']."', `choice22`='".$_POST['Choice22']."', `choice23`='".$_POST['Choice23']."', `choice24`='".$_POST['Choice24']."', `choice25`='".$_POST['Choice25']."', `status` = '".$status."' WHERE `id` ='".$pid."'";
 
 
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
  <div>
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
      <td><strong>Amount :</strong></td>
      <td><input type="text" name="amount" id="amount" class="TextField" value="<?php echo $r['amount'];?>"  /></td>
    </tr>
    <tr>
      <td><strong>Shipped:</strong></td>
      <td><input type="text" name="shipCost" id="shipCost" value="<?php echo $r['shipCost'];?>" class="TextField" /></td>
    </tr>
    <tr>
      <td><strong>Received :</strong></td>
      <td><input type="text" name="rec" id="rec" class="TextField" value="<?php echo $r['received'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Fullfilled :</strong></td>
      <td><input type="text" name="full" id="full" class="TextField" value="<?php echo $r['fulfilled'];?>" /></td>
    </tr>
    <tr>
      <td><strong>First :</strong></td>
      <td><input type="text" name="fir" id="fir" class="TextField" value="<?php echo $r['first'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Last :</strong></td>
      <td><input type="text" name="last" id="last" class="TextField" value="<?php echo $r['last'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Street :</strong></td>
      <td><input type="text" name="street" id="street" class="TextField" value="<?php echo $r['street'];?>" /></td>
    </tr>
    <tr>
      <td><strong>city :</strong></td>
      <td><input type="text" name="city" id="city" class="TextField" value="<?php echo $r['city'];?>" /></td>
    </tr>
    <tr>
      <td><strong>state:</strong></td>
      <td><input type="text" name="state" id="state" class="TextField" value="<?php echo $r['zip'];?>" /></td>
    </tr>
    <tr>
      <td><strong>zip :</strong></td>
      <td><input type="text" name="zip" id="zip" class="TextField" value="<?php echo $r['state'];?>" /></td>
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
	  
	  
	    if($r['status']=='1'){echo "<div style='color:blue; font-size: 18px;'>Used</div>";} else if($ex=='1'){ echo "<div style='color:red; font-size: 18px;'>Expired</div>"; } else if($r['status']=='0'){echo "<div style='color:green; font-size:18px;'>Valid</div>";}?></td>
    </tr>
    <!--<tr>
      <td><strong>Change Certificate Status :</strong></td>
      <td><input name="certStatus" id="ValidRadio" <?php if($r['status']=='0'){?> checked="checked" <?php } ?> type="radio" value="0" />
        <label for="ValidRadio">Valid</label>
        <input name="certStatus" id="ExpireRadio" <?php if($r['status']=='1'){?> checked="checked" <?php } ?> type="radio" value="1" />
        <label for="ExpireRadio">Expired</label></td>
    </tr>-->
    <tr>
      <td><strong>Demonination: </strong></td>
      <td><input type="text" name="Choice01" id="Choice01" class="TextField" value="<?php echo $r['choice01'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice01 :</strong></td>
      <td><input type="text" name="Choice02" id="Choice02" class="TextField" value="<?php echo $r['choice02'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice02 :</strong></td>
      <td><input type="text" name="Choice03" id="Choice03" class="TextField" value="<?php echo $r['choice03'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice03 :</strong></td>
      <td><input type="text" name="Choice04" id="Choice04" class="TextField" value="<?php echo $r['choice04'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice04 :</strong></td>
      <td><input type="text" name="Choice05" id="Choice05" class="TextField" value="<?php echo $r['choice05'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice05 :</strong></td>
      <td><input type="text" name="Choice06" id="Choice06" class="TextField" value="<?php echo $r['choice06'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice06 :</strong></td>
      <td><input type="text" name="Choice07" id="Choice07" class="TextField" value="<?php echo $r['choice07'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice07 :</strong></td>
      <td><input type="text" name="Choice08" id="Choice08" class="TextField" value="<?php echo $r['choice08'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice08 :</strong></td>
      <td><input type="text" name="Choice09" id="Choice09" class="TextField" value="<?php echo $r['choice09'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice09 :</strong></td>
      <td><input type="text" name="Choice10" id="Choice10" class="TextField" value="<?php echo $r['choice10'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice10 :</strong></td>
      <td><input type="text" name="Choice11" id="Choice11" class="TextField" value="<?php echo $r['choice11'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice11 :</strong></td>
      <td><input type="text" name="Choice12" id="Choice12" class="TextField" value="<?php echo $r['choice12'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice12 :</strong></td>
      <td><input type="text" name="Choice13" id="Choice13" class="TextField" value="<?php echo $r['choice13'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice13 :</strong></td>
      <td><input type="text" name="Choice14" id="Choice14" class="TextField" value="<?php echo $r['choice14'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice14 :</strong></td>
      <td><input type="text" name="Choice15" id="Choice15" class="TextField" value="<?php echo $r['choice15'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice15 :</strong></td>
      <td><input type="text" name="Choice16" id="Choice16" class="TextField" value="<?php echo $r['choice16'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice16 :</strong></td>
      <td><input type="text" name="Choice17" id="Choice17" class="TextField" value="<?php echo $r['choice17'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice17 :</strong></td>
      <td><input type="text" name="Choice18" id="Choice18" class="TextField" value="<?php echo $r['choice18'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice18 :</strong></td>
      <td><input type="text" name="Choice19" id="Choice19" class="TextField" value="<?php echo $r['choice19'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice19 :</strong></td>
      <td><input type="text" name="Choice20" id="Choice20" class="TextField" value="<?php echo $r['choice20'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice20 :</strong></td>
      <td><input type="text" name="Choice21" id="Choice21" class="TextField" value="<?php echo $r['choice21'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice21 :</strong></td>
      <td><input type="text" name="Choice22" id="Choice22" class="TextField" value="<?php echo $r['choice22'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice22 :</strong></td>
      <td><input type="text" name="Choice23" id="Choice23" class="TextField" value="<?php echo $r['choice23'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice23 :</strong></td>
      <td><input type="text" name="Choice24" id="Choice24" class="TextField" value="<?php echo $r['choice24'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Choice24 :</strong></td>
      <td><input type="text" name="Choice25" id="Choice25" class="TextField" value="<?php echo $r['choice25'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="Update" class="btn"></td>
    </tr>
  </table>
</form>
