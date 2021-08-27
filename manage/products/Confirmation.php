<?php if(!isset($_SESSION['abc'])){?>
<script type="text/javascript" language="javascript">
window.location.href = window.location.hostname;
</script>
<?php  }
//print_r($_POST);
include_once("Authpayment.class.php");

$pay =  new authorize_gateway();

// SET AUTHORIZE.NET VALUES HERE
$pay->gateway_api_login_test='84H3xcUs3';
$pay->gateway_api_key_test='6Z8XD37kj4q6PvCp';
 
//$pay->gateway_api_login_live='23Uw6ZW2z9';
//$pay->gateway_api_key_live='9qbDcU62k293W3Dn';

$pay->test_mode = "Y";

$pay->process_now();

//print_r($pay);

mysqli_query($con,"UPDATE capXlsx SET status = '1' WHERE certificate = '".$_SESSION['xyz']."'");
mysqli_query($con,"DELETE FROM cart where session_id = '".session_id()."'");

	$query_Recordset1 = mysqli_query($con,"select * from users where id = 1");
	$email				=	mysqli_fetch_array($query_Recordset1);
	echo $email['email'];
  $to      = "nadeemehsan9@pixiders.com"; 
  $headers = "From: Capitol Marketing Concepts <sales@capitolmarketingdeals.com>".PHP_EOL;
  $headers .= "MIME-Version: 1.0".PHP_EOL;
  $headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
  $subject = 'Order Information'; 
  
  $body = "<table width='583' border='0' height='20' cellpadding='0' cellspacing='0'> 
   <tbody>
   <tr>
     <td style='padding-left:10px; padding-top:4px;'></td>
   </tr>
   <tr>
     <td style='padding:10px;'><table width='100%'>
      <tbody>
     <tr>
       <td style='padding:7px;'><div>
        <p>
  A new order has been placed in admin. Please Go in the admin side to review this Order. 
  Thank you,<br />
  </p></div>
   </td>
     </tr>
      </tbody>
    </table></td>
   </tr>
    </tbody>
  </table>";
  
  mail($to, $subject, $body, $headers);


?>
<script type="text/javascript" language="javascript">
window.location.href = "?p=Thankyou";
</script>