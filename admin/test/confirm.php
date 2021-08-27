<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Payment Confirmation</title>
<style TYPE="text/css"> 
#document {
    width: 700px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    margin-top: 30px;
}
 
body {
font: 1.25em arial,helvetica,sans-serif;
color:#999;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<SCRIPT LANGUAGE="JavaScript"><!--
setTimeout('document.confirm.submit()',1);
//--></SCRIPT>
</head>
<body>
<div id="document">
<form name="confirm" id="confirm" action="https://checkout.globalgatewaye4.firstdata.com/payment">
<?php $x_login = "HCO-PIXID-12"; //  Hosted Payment Page ID. 
$transaction_key = "PWropt7DZG3IlSZprAtw"; // 
$x_amount = $_POST['amount']; 
$x_invoice_num = $_POST['invoice'];
$x_first_name = $_POST['x_first_name'];
$x_email = $_POST['x_email'];
$CardHoldersName= $_POST['CardHoldersName'];
$x_currency_code = "USD"; // Needs to agree with the currency of the payment page
srand(time()); // initialize random generator for x_fp_sequence
$x_fp_sequence = rand(1000, 100000) + 123456;
$x_fp_timestamp = time(); // needs to be in UTC. Make sure webserver produces UTC
  
// The values that contribute to x_fp_hash 
$hmac_data = $x_login . "^" . $x_fp_sequence . "^" . $x_fp_timestamp . "^" . $x_amount . "^" . $x_currency_code;
$x_fp_hash = hash_hmac('MD5', $hmac_data, $transaction_key);
  
echo ('<input type="hidden" name="x_login" value="' . $x_login . '">' );
echo ('<input type="hidden" name="x_amount" value="' . $x_amount . '">' );
echo ('<input type="hidden" name="x_fp_sequence" value="' . $x_fp_sequence . '">' );
echo ('<input type="hidden" name="x_fp_timestamp" value="' . $x_fp_timestamp . '">' );
echo ('<input type="hidden" name="x_fp_hash" value="' . $x_fp_hash . '" size="50">' );
echo ('<input type="hidden" name="x_currency_code" value="' . $x_currency_code . '">');
echo ('<input type="hidden" name="x_invoice_num" value="' . $x_invoice_num . '">');
echo ('<input type="hidden" name="x_first_name" value="' . $x_first_name . '">');
echo ('<input type="hidden" name="x_email" value="' . $x_email . '">');
?>
<input type="hidden" name="x_show_form" value="PAYMENT_FORM"/>
 
</form>
Processing Your $<?php echo $x_amount ?> Payment <?php echo $x_first_name ?>, Please Wait...
</div>
</body>
</html>