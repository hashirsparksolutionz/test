
<script type="text/javascript" language="javascript">
window.location.href = window.location.hostname;
</script>
<?php  }

require_once('includes/paypal.inc.php'); 

$paypal['item_name'] = "Capitol Marketing Concepts Purchase";
$paypal['invoice']   = $orderId;
$paypal['amount']    = $_SESSION['TOTAL'];
//print_r($_SESSION['TOTAL']);
?>
<div align="center" style="font: Verdana, Arial, Helvetica, sans-serif; size: 8px; color:#000">Processing Your Transaction....</div>
<form action="<?php echo $paypal['url']; ?>" method="post" name="frmPaypal" id="frmPaypal">
<input type="hidden" name="amount" value="<?php echo $paypal['amount']; ?>">
<input type="hidden" name="invoice" value="<?php echo $paypal['invoice']; ?>">
<input type="hidden" name="item_name" value="<?php echo $paypal['item_name']; ?>">
<input type="hidden" name="business" value="<?php echo $paypal['business']; ?>"> 
<input type="hidden" name="cmd" value="<?php echo $paypal['cmd']; ?>"> 
<input type="hidden" name="return" value="<?php echo  $paypal['site_url'] . $paypal['success_url']; ?>">
<input type="hidden" name="cancel_return" value="<?php echo $paypal['site_url'] . $paypal['cancel_url']; ?>">
<?php /*?><input type="hidden" name="notify_url" value="<?php echo  $paypal['site_url'] . $paypal['notify_url']; ?>"><?php */?>
<input type="hidden" name="rm" value="<?php echo $paypal['return_method']; ?>">
<input type="hidden" name="currency_code" value="<?php echo $paypal['currency_code']; ?>">
<input type="hidden" name="lc" value="<?php echo $paypal['lc']; ?>">
<input type="hidden" name="bn" value="<?php echo $paypal['bn']; ?>">
<input type="hidden" name="no_shipping" value="<?php echo $paypal['display_shipping_address']; ?>">
</form>
<script language="javaScript" type="text/javascript">
window.onload=function() {window.document.frmPaypal.submit();}
</script>
