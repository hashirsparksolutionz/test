<style>
.alert-success {
	background-color: #dff0d8;
	border-color: #d6e9c6;
	color: #468847;
	padding: 8px 35px 8px 14px;
margin-bottom: 18px;
text-shadow: 0 1px 0 rgba(255,255,255,0.5);
background-color: #fcf8e3;
border: 1px solid #fbeed5;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
color: #c09853;
}

</style>
<?php
	$msg = "";
	if($_POST['recov_btn']){
	$username			=	mysqli_real_escape_string($con, $_POST['username']);
	$userpass			=	mysqli_real_escape_string($con, $_POST['userpass']);
	
	$query 	=	mysqli_query($con, "Select * from members where email = '$username'");
	$totalRows 	= 	mysqli_num_rows($query);
			//echo $totalRows."</br>";				
	if($totalRows  > 0){
		$password = mysqli_query($con, "Select password from members where  email = '$username'");
		$password_rs = mysqli_fetch_array($password);
		//echo "Select password from users where  username = '$username' and email = '$email'";
		$body = "Please See Your Capitol Marketing Deals Login Information:\n\r";
		$body .="Email Address : ".$username. "\n\r";
		$body .="Password : ".$password_rs['password']. "\n\r";
				
		$to = "$username";
		$headers = 'From: admin@capitalmarketingdeals.com' . "\r\n";
 		$subject = "Forgot Password !";
		if (mail($to, $subject, $body, $headers)) {
		//$msg =   "Message successfully sent!";
		$username = "";
		$email  = "";
		echo "<div class='alert alert-success'>An Email has been sent to you, please check your email address.</div>";
				}
			} else if($totalRows == 0) {
				echo "<div class='alert alert-success'>You Are Not A Registered User </div>";
			}
		}
?>
<script language="javascript">
function check_signin(){
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var address = document.signin.username.value;
	if(document.signin.username.value==''){
		document.signin.username.focus();
		document.getElementById('username_msg').innerHTML='Please Enter Your Email Address!';
		return false;
	}else if(reg.test(address) == false){
		document.signin.username.focus();
		document.getElementById('username_msg').innerHTML='Invalid Email Address!';
		return false;
	}else{
		document.getElementById('username_msg').innerHTML='';	
	}
		
	}
</script>

<div class="shape-featured">
  <div class="text-haead">Password Recovery</div>
</div>
<div class="Login-Div">
  <form method="post" id="signin" name="signin" enctype="multipart/form-data" action="" onsubmit="return check_signin()">
    <table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="20%" rowspan="6" align="right"><img src="images/forgot_left_icon.png" alt="Image" style="margin-top:-40px;" width="97" /></td>
        <td align="right" valign="top">&nbsp;</td>
        <td><?php if($mes){?>
          <div class="alert"> <?php echo $mes; ?> </div>
          <?php }?></td>
      </tr>
      <tr>
        <td align="right" valign="middle"><span class="text-1">E-mail :</span></td>
        <td width="52%"><input type="text" class="Login_Field" name="username" id="username" style="
    height: 15px;
    width: 200px;
    border-radius: 2px;
"> <br />
        <span style="color:#F00" id="username_msg"></span></td>
      </tr>
      <tr>
        <td width="19%" valign="top">&nbsp;</td>
        <td><span class="text-1"><a class="link-a" href="?p=Login">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="link-a" href="?p=Register">Register</a></span></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td align="right"><input type="submit" class="btn-1" name="recov_btn" id="signin_submit" value="Recover" style="
    width: 65px;
"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td></td>
      </tr>
    </table>
  </form>
</div>
