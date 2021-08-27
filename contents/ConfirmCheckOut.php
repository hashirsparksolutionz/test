
<script type="text/javascript" language="javascript">
window.location.href = window.location.hostname;
</script>
<?php }

$requiredField = array('txtShippingFirstName', 'txtShippingLastName', 'txtShippingAddress1', 'txtShippingAddress2', 'txtShippingPhone', 'txtShippingState',  'txtShippingCity', 'txtShippingPostalCode',
                       'txtPaymentFirstName', 'txtPaymentLastName', 'txtPaymentAddress1', 'txtPaymentAddress2', 'txtPaymentPhone', 'txtPaymentState', 'txtPaymentCity', 'txtPaymentPostalCode');
?>
<table width="650" border="0" align="center" cellpadding="10" cellspacing="0">
    <tr> 
        <td><div class="shape-featured" style="color: #fff; font-family: Arial, Helvetica, sans-serif;
font-size: 18px; padding-top: 10px; padding-left: 15px; height: 30px; margin-left: -3px;">Step 2 Of 3 : Confirm Order </div></td>
    </tr>
</table>
<form action="?p=payment" method="post" name="frmCheckout" id="frmCheckout">
    <div style="width:180px; margin-left: 265px; background-color: #F0F2EF; border: 1px solid #666; border-style: dotted; border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;">
    <table width="100%">
      <tr>
        <td width="60%"><span class="header-text"><strong>Total Price :</strong> </span></td>
        <td width="40%"><span class="cont-a">
          <?php print_r($_SESSION['SUBTOTAL']);echo " $";  ?>
          </span></td>
      </tr>
       <tr>
        <td width="60%"><span class="header-text"><strong>Shipped:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+</strong> </span></td>
        <td width="40%"><span class="cont-a"><?php print_r($_SESSION['abc']);echo " $";  ?></span></td>
      </tr>
      <tr>
        <td width="60%"><span class="header-text"><strong></strong> </span></td>
        <td width="40%"><span class="cont-a">___</span></td>
      </tr>
      <tr>
        <td width="60%"><span class="header-text"><strong>Total:</strong> </span></td>
        <td width="40%"><span class="cont-a"><?php print_r($_SESSION['TOTAL']);echo " $"; ?></span></td>
      </tr>
    </table>
  </div>
   <br />
    <table width="650" border="0" align="center" cellpadding="5" cellspacing="1">
        <tr class="infoTableHeader"> 
            <td colspan="4"><div class="shape-featured" style="color: #fff; font-family: Arial, Helvetica, sans-serif;
font-size: 18px; padding-top: 10px; padding-left: 15px; height: 30px;">Shipping Information</div></td>
        </tr>
        <tr> 
            <td width="150" class="label"><strong>First Name:</strong></td>
            <td class="content"><?php echo $_POST['txtShippingFirstName']; ?>
                <input name="hidShippingFirstName" type="hidden" id="hidShippingFirstName" value="<?php echo $_POST['txtShippingFirstName']; ?>"></td>
            <td width="150" class="label"><strong>Last Name:</strong></td>
            <td class="content"><?php echo $_POST['txtShippingLastName']; ?>
                <input name="hidShippingLastName" type="hidden" id="hidShippingLastName" value="<?php echo $_POST['txtShippingLastName']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label"><strong>Address1:</strong></td>
            <td class="content"><?php echo $_POST['txtShippingAddress1']; ?>
                <input name="hidShippingAddress1" type="hidden" id="hidShippingAddress1" value="<?php echo $_POST['txtShippingAddress1']; ?>"></td>
            <td width="150" class="label"><strong>Address2:</strong></td>
            <td class="content"><?php echo $_POST['txtShippingAddress2']; ?>
                <input name="hidShippingAddress2" type="hidden" id="hidShippingAddress2" value="<?php echo $_POST['txtShippingAddress2']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label"><strong>Phone Number:</strong></td>
            <td class="content"><?php echo $_POST['txtShippingPhone'];  ?>
                <input name="hidShippingPhone" type="hidden" id="hidShippingPhone" value="<?php echo $_POST['txtShippingPhone']; ?>"></td>
            <td width="150" class="label"><strong>Province / State:</strong></td>
            <td class="content"><?php echo $_POST['txtShippingState']; ?> <input name="hidShippingState" type="hidden" id="hidShippingState" value="<?php echo $_POST['txtShippingState']; ?>" ></td>
        </tr>
        <tr> 
            <td width="150" class="label"><strong>City:</strong></td>
            <td class="content"><?php echo $_POST['txtShippingCity']; ?>
                <input name="hidShippingCity" type="hidden" id="hidShippingCity" value="<?php echo $_POST['txtShippingCity']; ?>" ></td> 
            <td width="150" class="label"><strong>Postal Code:</strong></td>
            <td class="content"><?php echo $_POST['txtShippingPostalCode']; ?>
                <input name="hidShippingPostalCode" type="hidden" id="hidShippingPostalCode" value="<?php echo $_POST['txtShippingPostalCode']; ?>"></td>
        </tr>
    </table>
    <br /><br />
    <table width="650" border="0" align="center" cellpadding="5" cellspacing="1">
        <tr class="infoTableHeader"> 
            <td colspan="4"><div class="shape-featured" style="color: #fff; font-family: Arial, Helvetica, sans-serif;
font-size: 18px; padding-top: 10px; padding-left: 15px; height: 30px;">Payment Information</div></td>
        </tr>
        <tr> 
            <td width="150" class="label"><strong>First Name:</strong></td>
            <td class="content"><?php echo $_POST['txtPaymentFirstName']; ?>
                <input name="hidPaymentFirstName" type="hidden" id="hidPaymentFirstName" value="<?php echo $_POST['txtPaymentFirstName']; ?>"></td>
            <td width="150" class="label"><strong>Last Name:</strong></td>
            <td class="content"><?php echo $_POST['txtPaymentLastName']; ?>
                <input name="hidPaymentLastName" type="hidden" id="hidPaymentLastName" value="<?php echo $_POST['txtPaymentLastName']; ?>"></td>
        </tr>
        <tr> 
            <td width="150" class="label"><strong>Address1:</strong></td>
            <td class="content"><?php echo $_POST['txtPaymentAddress1']; ?>
                <input name="hidPaymentAddress1" type="hidden" id="hidPaymentAddress1" value="<?php echo $_POST['txtPaymentAddress1']; ?>"></td>
            <td width="150" class="label"><strong>Address2:</strong></td>
            <td class="content"><?php echo $_POST['txtPaymentAddress2']; ?> <input name="hidPaymentAddress2" type="hidden" id="hidPaymentAddress2" value="<?php echo $_POST['txtPaymentAddress2']; ?>"> 
            </td>
    </tr>
        <tr> 
            <td width="150" class="label"><strong>Phone Number:</strong></td>
            <td class="content"><?php echo $_POST['txtPaymentPhone'];  ?> <input name="hidPaymentPhone" type="hidden" id="hidPaymentPhone" value="<?php echo $_POST['txtPaymentPhone']; ?>"></td>
            <td width="150" class="label"><strong>Province / State:</strong></td>
            <td class="content"><?php echo $_POST['txtPaymentState']; ?> <input name="hidPaymentState" type="hidden" id="hidPaymentState" value="<?php echo $_POST['txtPaymentState']; ?>" ></td>
    </tr>
        <tr> 
            <td width="150" class="label"><strong>City:</strong></td>
            <td class="content"><?php echo $_POST['txtPaymentCity']; ?>
                <input name="hidPaymentCity" type="hidden" id="hidPaymentCity" value="<?php echo $_POST['txtPaymentCity']; ?>"></td>
            <td width="150" class="label"><strong>Postal Code:</strong></td>
            <td class="content"><?php echo $_POST['txtPaymentPostalCode']; ?>
                <input name="hidPaymentPostalCode" type="hidden" id="hidPaymentPostalCode" value="<?php echo $_POST['txtPaymentPostalCode']; ?>"></td>
        </tr>
    </table>
    <br />
    <table width="400" border="0" align="center" cellpadding="5" cellspacing="1">
      <tr>
        <td width="133" class="infoTableHeader"><strong>Payment Method:</strong></td>
        <td width="244" class="content"><strong><?php $_POST['optPayment'] == 'paypal'; echo 'Paypal' ;?></strong>
<input name="hidPaymentMethod" type="hidden" id="hidPaymentMethod" value="<?php echo $_POST['optPayment']; ?>" />
        </tr>
    </table>
    <br />
    <div align="center" style="margin-top: 25px;"> 
        <input name="btnBack" style="width: 225px;" type="button" id="btnBack" value="&lt;&lt; Modify Shipping/Payment Info" onClick="window.location.href='?p=PlaceOrder';" class="btn-11">&nbsp;&nbsp;&nbsp;<input name="btnConfirm" type="submit" style="width: 125px;" id="btnConfirm" value="Confirm Order &gt;&gt;" class="btn-11"></div>
</form>