<?php
//.....................................FOR CHANGING PASSWORD................................//
$mes	=	'';
$sql3="select * from users where id='".$_SESSION['admin_id']."'";
$res=mysqli_query($con, $sql3);
//echo $sql3;
$row2= mysqli_fetch_assoc($res);
$email1=$row2['email'];
$name=$row2['name'];


if($_POST['pass'])	{
	
	$userName       = mysqli_real_escape_string(htmlentities($con, $_POST['userName']));	
	$old_pass1 				=		mysqli_real_escape_string($con, $_POST['old_pass']);
	$new_password1 			=		mysqli_real_escape_string($con, $_POST['new_password']);
	$confrim_password		=		mysqli_real_escape_string($con, $_POST['confrim_password']);
	$email		            =		mysqli_real_escape_string($con, $_POST['email']);
	
	if($old_pass1 ==	'')	
	{
		$mes	=	"Please Enter the old Password";
	}
	else 
	if($new_password1 ==	'')	
	{
		$mes	=	"Please Enter the new Password";
	}
	else
    if($email ==	'')	{
		$mes	=	"Please Enter the email";
	}
	 if($confrim_password != $new_password1)
	 {
		$mes	=	"Confirm Password does not match with new password.";
	 }
	else
	{
		$userName           =       mysqli_real_escape_string(htmlentities($con, $_POST['userName']));	
		$old_pass 			=		mysqli_real_escape_string($con, $_POST['old_pass']);
		$new_password 		=		mysqli_real_escape_string($con, $_POST['new_password']);
		$email		        =	    mysqli_real_escape_string($con, $_POST['email']);
		
		$pas_query 		= 		mysqli_query($con, "SELECT * FROM users WHERE password = '$old_pass'");
		$pss_row 		= 		mysqli_num_rows($pas_query);
		//$id			=		;
		//echo "UPDATE  users SET  password = '$new_password',email='$email' WHERE  Id = '".$_SESSION['admin_id']."'";
		mysqli_query($con, "UPDATE  users SET name='$userName',email='$email' WHERE  Id = '".$_SESSION['admin_id']."'");
			$mes	=	"The password has been updated.";
					$confrim_password	=		mysqli_real_escape_string($con, $_POST['confrim_password']);
                     if($pss_row > 0 && $new_password!='')	{
			mysqli_query($con, "UPDATE  users SET password = '$new_password' WHERE  Id = '".$_SESSION['admin_id']."'");
			$mes	=	"The password has been updated.";
		
			$old_pass = '';
			$new_password  = '';
			$email  = '';
			
		}//end of if
		else	
		{
			$mes	=	"Invalid old password!";
		}
	}//end of else
	?>
   <script language="javascript">
    window.location.href = "?p=EditAccount";
    </script>
<?php }
?>

<h1>Change Password</h1>
<strong>We stongly suggest to use a Strong Password</strong> for you Administration Panel. A <strong>strong Password contains</strong> at least <strong>2 Capital Characters</strong><em> (A-Z)</em>, <strong>2 Small Characters</strong><em> (a-z)</em>, <strong>2 Alphanumeric Characters</strong><em> (0-9)</em> and <strong>2 Special Characters</strong> <em>(!, @, #, $, %, ^, &amp;, *, (, ), _, +, =, -).</em><br />
    <br />
    e.g. XyYx#@99 is a Strong Password as it fulfills above requirements.<br /><br />
<?php if($mes != '')	{ ?>
      <div class="alert alert-error"><?php echo $mes; ?>
      <?php } ?></div>
  <form action="" method="post" name="admin_login">
  <table border="0" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td><strong>User Name</strong></td>
    <td><input type="text" name="userName" id="userName" value="<?php echo $name; ?>"  class="TextField" /></td>
  </tr>
  <tr>
    <td><strong>Old Password</strong></td>
    <td><input type="password" name="old_pass" id="old_pass" value="<?php echo $old_pass1; ?>"  class="TextField" /></td>
  </tr>
  <tr>
    <td><strong>New Password</strong></td>
    <td><input name="new_password" type="password" id="new_password" value="<?php echo $new_password1; ?>"  class="TextField" /></td>
  </tr>
  <tr>
    <td><strong>Confirm Password</strong></td>
    <td><input name="confrim_password" type="password" id="confrim_password" value="<?php echo $confrim_password; ?>"  class="TextField" /></td>
  </tr>
  <tr>
    <td><strong>Email</strong></td>
    <td><input name="email" type="email" id="email" value="<?php echo $email1; ?>"  class="TextField" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="pass" id="pass" value="Change Password" class="btn btn-primary" />
</td>
  </tr>
</table>
</form>
