
<script type="text/javascript" language="javascript">
window.location.href = window.location.hostname;
</script>
<?php  } ?>
<script type="text/javascript" language="javascript">
function validateTrans()
{
	
	if(document.myform.card_number.value=='')
	{
		document.myform.card_number.focus();
		document.getElementById('cardNum_msg').innerHTML='Please Enter Your Credit Card Number';
		return false;
	}
	else
	{
		document.getElementById('cardNum_msg').innerHTML='';
	}	
	
	if(document.myform.card_validity.value=='')
	{
		document.myform.card_validity.focus();
		document.getElementById('cvalidity_msg').innerHTML='Please Enter Your Card Validity';
		return false;
	}
	else
	{
		document.getElementById('cvalidity_msg').innerHTML='';
	}	
	
	if(document.myform.card_verification_code.value=='')
	{
		document.myform.card_verification_code.focus();
		document.getElementById('cverification_msg').innerHTML='Please Enter Your Card Verification Code';
		return false;
	}
	else
	{
		document.getElementById('cverification_msg').innerHTML='';
	}
	
	if(document.myform.creditCardType.checked==false)
	{
		document.myform.creditCardType.focus();
		document.getElementById('ctype_msg').innerHTML='Please Enter Your Credit Card Type';
		return false;
	}
	else
	{
		document.getElementById('ctype_msg').innerHTML='';
	}
	
	if(document.myform.card_number.value!='' && document.myform.card_validity.value!='' && document.myform.card_verification_code.value!='' && document.myform.creditCardType.value!=''){
		//alert('sdsdsd');
		document.getElementById('myform').submit();
	//window.location.href = 'indexLanding.php?p=Confirmation';
	return true;
	}
} 
</script>
<?php
$UsersPoints	 = mysqli_query($con, "select * from userinfo where id='".$_SESSION['userid']."'");
$UsersPointsrow  = mysqli_fetch_assoc($UsersPoints);

$firstName 	= 	$UsersPointsrow['fname'];
$lastName  	= 	$UsersPointsrow['lname'];
$street	   	= 	$UsersPointsrow['address1'].' & '.$UsersPointsrow['address2'];
$state 	 	= 	$UsersPointsrow['state'];
$city 	 	= 	$UsersPointsrow['city'];
$zip 		= 	$UsersPointsrow['zip'];
$email	 	= 	$UsersPointsrow['email'];
$address1   =   $UsersPointsrow['address1'];
$address2   =    $UsersPointsrow['address2'];

$cartquery1 		= 	mysqli_query($con, "select * from cart where session_id='".session_id()."'");
$TotalCartItems		=  	mysqli_num_rows($cartquery1);

?>
 <!-- <form name="payment_frm" action="#" method="post">
   		
        
        <input type="hidden" name="total" id="total" value="<?php// echo $_SESSION['TOTAL']?>"/>
   </form>-->
<form action="?p=process" onsubmit="return validateTrans()" method="post" name="myform" id="myform">
  <div class="shape-featured" style="color: #fff; font-family: Arial, Helvetica, sans-serif;
font-size: 18px; padding-top: 10px; padding-left: 15px; height: 30px; margin-left: 0px; width: 671px;">Enter Your Credit Card Details For Confirming Order</div>
  <div style="width:180px; margin-left: 265px; background-color: #F0F2EF; border: 1px solid #666; border-style: dotted; border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; margin-top: 20px;">
    <?php if($TotalCartItems != '0'){?>
   
    <table width="100%"  border="0">
      <tr>
        <td width="60%"><span class="header-text">Total Price :</span></td>
        <td width="40%"><span class="cont-a"> <?php echo "$"; echo $_SESSION['SUBTOTAL'];  ?> </span></td>
        <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $_SESSION['SUBTOTAL']?>"/>
      </tr>
      <tr>
        <td width="60%"><span class="header-text">Shipped:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+</strong> </span></td>
        <td width="40%"><span class="cont-a"><?php echo "$"; echo $_SESSION['abc'];  ?></span></td>
        <input type="hidden" name="shipped" id="shipped" value="<?php echo $_SESSION['abc'] ?>"/>
      </tr>
      <tr>
        <td width="60%"><span class="header-text"><strong></strong> </span></td>
        <td width="40%"><span class="cont-a">___</span></td>
      </tr>
      <tr>
        <td width="60%"><span class="header-text"><strong>Total:</strong> </span></td>
        <td width="40%"><span class="cont-a"><?php echo "$"; echo $_SESSION['TOTAL']; ?></span></td>
        <input name="amount_now" type="hidden" id="amount_now" value="<?php echo $_SESSION['TOTAL'];?>" />
        <input type="hidden" name="oid" id="oid" value="<?php echo $_SESSION['userid'] ?>"/>
      </tr>
    </table>
    <?php }else{ ?>
    <table width="100%">
      <tr>
        <td width="60%"><span class="header-text"><strong>Shipping Price:</strong></span></td>
        <td width="40%"><span class="cont-a"><?php echo "$"; echo $_SESSION['abc'];  ?></span></td>
        <input name="amount_now" type="hidden" id="amount_now" value="<?php echo $_SESSION['abc'];?>" />
        <input type="hidden" name="oid" id="oid" value="<?php echo $_SESSION['userid'] ?>"/>
      </tr>
    </table>
    <?php } ?>
  </div>
  <br />
  <br />
  <table width="100%" border="1" align="center" cellpadding="5" cellspacing="2" class="order-table">
    <tr>
      <td colspan="2"><div class="shape-featured" style="color: #fff; font-family: Arial, Helvetica, sans-serif;
font-size: 18px; padding-top: 10px; padding-left: 15px; height: 30px; width: 671px; margin-left: -7px;">Credit Card Details, Fields Marked With (*) Are Mandatory</div></td>
    </tr>
    <tr>
      <td align="right"><strong>First Name : </strong></td>
      <td><input name="fname" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" type="text" id="fname" size="40" value="<?php echo $firstName; ?>"></td>
    </tr>
    <tr>
      <td align="right"><strong>Last Name : </strong></td>
      <td><input name="lname" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" type="text" id="lname" size="40" value="<?php echo $lastName; ?>"></td>
    </tr>
    <tr>
      <td align="right"><strong>* Credit Card Number : </strong></td>
      <td><input name="card_number" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" type="text" id="card_number" size="20" maxlength="25"><br /><span style="color:red" id="cardNum_msg" ></span></td>
    </tr>
    <tr>
      <td align="right"><strong>* Card Expiration Date : </strong></td>
      <td><input name="card_validity" type="text" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" id="card_validity" size="7" maxlength="7"><br /><span style="color:red" id="cvalidity_msg" ></span>
        e.g, format, MM/YY</td>
    </tr>
    <tr>
      <td align="right"><strong>* Card Verification Code : </strong></td>
      <td><input name="card_verification_code" type="text" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" id="card_verification_code" size="4" maxlength="4"><br /><span style="color:red" id="cverification_msg" ></span></td>
    </tr>
    <tr>
   
    <tr>
      <td align="right"><strong>State : </strong></td>
      <td><input name="state" type="text" value="<?php echo $state; ?>" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" id="state" /></td>
    </tr>
    <tr>
      <td align="right"><strong>City : </strong></td>
      <td><input name="city" type="text" value="<?php echo $city; ?>" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" id="city" /></td>
    </tr>
    <tr>
      <td align="right"><strong>Zip : </strong></td>
      <td><input name="zip" type="text" value="<?php echo $zip; ?>" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" id="zip" /></td>
    </tr>
    
    <tr>
      <td align="right"><strong>Address1  : </strong></td>
      <td><input name="address1" type="text" value="<?php echo $address1; ?>" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" id="address1" /></td>
    </tr>
    <tr>
      <td align="right"><strong>Address2  : </strong></td>
      <td><input name="address2" type="text" value="<?php echo $address2; ?>" style="border-radius: 5px; border: 0.1em solid; height: 25px; width: 180px;" id="address2" /></td>
    </tr>
    <tr>
      <td align="right"><strong>* Credit Card Type : </strong></td>
      <td><input type="radio" name="creditCardType" id="VisaChk" value="Visa" />
        <label for="VisaChk">Visa</label>
        <input type="radio" name="creditCardType" id="MasterCardChk" value="MasterCard" />
        <label for="MasterCardChk">MasterCard</label>
        <input type="radio" name="creditCardType" id="AmexChk" value="Amex" />
        <label for="AmexChk">Amex</label>
        <input type="radio" name="creditCardType" id="DiscoverChk" value="Discover" />
        <label for="DiscoverChk">Discover</label><br /><span style="color:red" id="ctype_msg" ></span></td>
      </td>
    </tr>
    <td>&nbsp;</td>
      <td><input type="submit" class="btn-11" name="Submit" value="Process" /></td>
    </tr>
  </table>
</form>
