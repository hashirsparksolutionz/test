<?php
//.....................................FOR CHANGING PASSWORD................................//

$mes=$_REQUEST['mesg'];
$id =$_REQUEST['id'];
$q=mysqli_query($con, "select * from `mail` where id='".$id."'");
$rw=mysqli_fetch_array($q);
if($_POST['pass'])	{
	

	$email		            =		mysqli_real_escape_string($con, $_POST['email']);
	
	
    if($email =='')	{
		$mes	=	"Please Enter the email";
	}
	
	else
	{
		
		
			//$id			=		;
		//echo "UPDATE  users SET  password = '$new_password',email='$email' WHERE  Id = '".$_SESSION['admin_id']."'";
		mysqli_query($con, "update `mail` set  `email`='".$email."' where id='".$id."'");
			
		
			$email		            =		mysqli_real_escape_string($con, $_POST['email']);
		
	
		
			//$id			=		;
		//echo "UPDATE  users SET  password = '$new_password',email='$email' WHERE  Id = '".$_SESSION['admin_id']."'";
		$r = mysqli_query($con, "select * from mail where email='".$email."' and id != '".$id."'");
		if(mysqli_num_rows($r)>0){
			$_SESSION['dup']='This email already exist.';
			}else{
			mysqli_query($con, "update `mail` set  `email`='".$email."' where id='".$id."'");
			//$_SESSION['ok']='The Email has been added.';
				}
			
	
		

	?>
   <script language="javascript">
    window.location.href = "?p=viewmail&mes=update";
    </script>
<?php  	}//end of else
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
<h1>Manage Email</h1>

<?php if($mes != '')	{ ?>
      <div class="alert alert-error"><?php echo $mes; ?>
      </div><?php } ?>
  <form name="userinfo" id="userinfo" onSubmit="return reg_user();" method="post" enctype="multipart/form-data">
  <table border="0" align="center" cellpadding="0" cellspacing="5">
  
  
  
  
  <tr>
    <td><strong>Email&nbsp;</strong></td>
    <td><input name="email" type="email" id="email" value="<?php echo $rw['email']; ?>"  class="TextField" />
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
