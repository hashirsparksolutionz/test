<?php
//.....................................FOR CHANGING PASSWORD................................//

$mes=$_REQUEST['mesg'];
if($_POST['pass'])	{
	

	$email		            =		mysqli_real_escape_string($con, $_POST['email']);
	
	
    if($email =='')	{
		$mes	=	"Please Enter the email";
	}
	
	else
	{
		
		$email		            =		mysqli_real_escape_string($con, $_POST['email']);
		
	
		
			//$id			=		;
		//echo "UPDATE  users SET  password = '$new_password',email='$email' WHERE  Id = '".$_SESSION['admin_id']."'";
		$r = mysqli_query($con, "select * from mail where email='".$email."'");
		if(mysqli_num_rows($r)>0){
			$_SESSION['dup']='This email already exist.';
			}else{
				mysqli_query($con, "insert into `mail` set  `email`='".$email."'");
			$_SESSION['ok']='The Email has been added.';
				}
		
		
		
			//$email  = '';
			
	
		
	}//end of else
	}
?>
<script type="text/javascript">
function reg_user()
{
	
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var address = document.userinfo.email.value;

if(document.userinfo.email.value=='')
	{
		document.userinfo.email.focus();
		document.getElementById('emailx').innerHTML='Please Enter Your Email Address!';
		return false;
	}
	else 
	if(reg.test(address) == false)
	{
		document.userinfo.email.focus();
		document.getElementById('emailx').innerHTML='Please Enter the Valid Email Address';
		return false;
	}
	else
	{
		document.getElementById('emailx').innerHTML='';	
	}
   }
    </script>
<h1>Add Email</h1>

<?php if(isset($_SESSION['ok']))	{ ?>
      <div class="alert alert-error" style="background-color: #e0f2cb;border: 1px solid #ccebac;color: #6da827;"><?php echo 'Email has been added successfully.'; ?>
      </div><?php }
	  unset($_SESSION['ok']);
	  
	  
	  if(isset($_SESSION['dup']))	{ ?>
      <div class="alert alert-error"><?php echo $_SESSION['dup']; ?>
      </div><?php }
	  unset($_SESSION['dup']);
	   ?>
  <form name="userinfo" id="userinfo" onSubmit="return reg_user();" method="post" enctype="multipart/form-data">
  <table border="0" align="center" cellpadding="0" cellspacing="5">
  
  
  
  
  <tr>
    <td><strong>Email&nbsp;</strong></td>
    <td><input name="email" type="email" id="email"  class="TextField" />
     <br />
          <span style="color:red" id="emailx" ></span>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="pass" id="pass" value="Save" class="btn btn-primary" />
</td>
  </tr>
</table>
</form>
