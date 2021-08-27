<?php
	/*==================================================================
	 Payflow Direct Payment Call
	 ===================================================================
	*/
require_once ("paypalfunctions.php");


	/*
	'------------------------------------
	' The paymentAmount is the total value of 
	' the shopping cart, that was set 
	' earlier in a session variable 
	' by the shopping cart page
	'------------------------------------
	*/
	
	$finalPaymentAmount =  $_SESSION["TOTAL"];
	
	 $creditCardType 	= $_POST['creditCardType']; //' Set this to one of the acceptable values (Visa/MasterCard/Amex/Discover) match it to what was selected on your Billing page
	 $creditCardNumber 	= $_POST['creditCardNumber']; // ' Set this to the string entered as the credit card number on the Billing page
	 $expDate 			= $_POST['expDate']; // ' Set this to the credit card expiry date entered on the Billing page
	 $cvv2 				= $_POST['cvv2']; // ' Set this to the CVV2 string entered on the Billing page 
	 $firstName 		= $_POST['firstName']; // ' Set this to the customer's first name that was entered on the Billing page 
	 $lastName 			= $_POST['lastName']; // ' Set this to the customer's last name that was entered on the Billing page 
	 $street 			= $_POST['street']; // ' Set this to the customer's street address that was entered on the Billing page 
	 $city 				= $_POST['city']; // ' Set this to the customer's city that was entered on the Billing page 
	 $state 			= $_POST['state']; // ' Set this to the customer's state that was entered on the Billing page 
	 $zip 				= $_POST['zip']; // ' Set this to the zip code of the customer's address that was entered on the Billing page 
	 $countryCode 		= $_POST['countryCode']; // ' Set this to the PayPal code for the Country of the customer's address that was entered on the Billing page 
	 $currencyCode 		= $_POST['currencyCode']; // ' Set this to the PayPal code for the Currency used by the customer
	 $orderDescription 	= $_POST['orderDescription']; // ' Set this to the textual description of this order 
	 $paymentType		= "Sale";
	
	/*
	'------------------------------------
	'
	' The DirectPayment function is defined in the file PayPalFunctions.php,
	' that is included at the top of this file.
	'-------------------------------------------------
	*/

	$resArray = DirectPayment ( $paymentType, $finalPaymentAmount, $creditCardType, $creditCardNumber, $expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip);
	
	$ack = $resArray["RESULT"];
	if( $ack != "0" ) 
	{
		// See pages 50 through 65 in https://cms.paypal.com/cms_content/US/en_US/files/developer/PP_PayflowPro_Guide.pdf for a list of RESULT values (error codes)
		//Display a user friendly Error on the page using any of the following error information returned by Payflow
		$ErrorCode = $ack;
		$ErrorMsg = $resArray["RESPMSG"];

		echo "Credit Card transaction failed. ";
		echo "Error Message: " . $ErrorMsg;
		echo "Error Code: " . $ErrorCode;
	}
	
		
		
?>
<script type="text/javascript" language="javascript">
//window.location.href = "?p=Thankyou";
</script>