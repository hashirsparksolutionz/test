<?php 
session_start();
require_once('../includes/functions.php');
include('https.php');
if(isset($_SESSION['admin_id']))	{
	goUrl('admin_index.php');
	exit();			//for skip the below code
}
require_once('../includes/myconn.php');
if(isset($_POST['button']))	{
	$mes				=	'';
	$admin_username		=	mysqli_real_escape_string($con, $_POST['username']);
	$admin_password		=	mysqli_real_escape_string($con, $_POST['password']);
	if($admin_username 	== '')	{
		$mes	=	"Please enter the Username.";
	}
	else if($admin_password == '')	{
		$mes	=	"Please enter the Password.";
	}
	else
	{
		$admin_query		=	mysqli_query($con,"SELECT * FROM users WHERE name = '$admin_username' AND password ='$admin_password'");
		$admin_num_rows		=	mysqli_num_rows($admin_query);
		if($admin_num_rows > 0)	{
			$admin_rows					=	mysqli_fetch_array($admin_query);
			$_SESSION['admin_id']		=	$admin_rows['id'];
			goUrl('admin_index.php');
		}else{
			$mes	=	"Username or Password Incorrect! Please re-type.";
		}
	}
}		
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="generator" content="Administrator Panel" />
  <title>Admin</title>
  <link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  <link rel="stylesheet" href="../css/chosen.css" type="text/css" />
  <link rel="stylesheet" href="../css/template.css" type="text/css" />
  <style type="text/css">
html { display:none }
  </style>
  <script src="../js/mootools-core.js" type="text/javascript"></script>
  <script src="../js/core.js" type="text/javascript"></script>
  <script src="../js/jquery.min.js" type="text/javascript"></script>
  <script src="../js/jquery-noconflict.js" type="text/javascript"></script>
  <script src="../js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../js/chosen.jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
window.addEvent('domready', function () {if (top == self) {document.documentElement.style.display = 'block'; } else {top.location = self.location; }});
function keepAlive() {	var myAjax = new Request({method: "get", url: "index.php"}).send();} window.addEvent("domready", function(){ keepAlive.periodical(840000); });
jQuery(document).ready(function() {
					jQuery('.hasTooltip').tooltip({});
				});
				jQuery(document).ready(function (){
					jQuery('.advandedSelect').chosen({
						disable_search_threshold : 10,
						allow_single_deselect : true
					});
				});
			
  </script>
  
	<script type="text/javascript">
		window.addEvent('domready', function () {
			document.getElementById('form-login').username.select();
			document.getElementById('form-login').username.focus();
		});
	</script>
	<style type="text/css">
		/* Responsive Styles */
		@media (max-width: 480px) {
			.view-login .container{
				margin-top: -170px;
			}
			.btn{
				font-size: 13px;
				padding: 4px 10px 4px;
			}
		}
			</style>
	<!--[if lt IE 9]>
		<script src="../media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="site com_login view-login layout-default task- itemid- ">
	<!-- Container -->
	<div class="container">
		<div id="content">
			<!-- Begin Content -->
			<div id="element-box" class="login well">
				<img src="../images/logo.png" width="100%" height="50%" alt="Logo" />
				<hr />
                
<div id="system-message-container"><?php if($mes){?><div class="alert ">
<h4 class="alert-heading">Warning</h4>
<p><?php echo $mes; ?></p>
</div><?php }?>
</div>
	<form method="post" id="form-login" class="form-inline">
	<fieldset class="loginform">
		<div class="control-group">
			<div class="controls">
			  <div class="input-prepend input-append">
			    <span class="add-on"><i class="icon-user hasTooltip" data-placement="left" title="User Name"></i> <label for="mod-login-username" class="element-invisible">User Name</label></span><input name="username" tabindex="1" id="mod-login-username" type="text" class="input-medium" placeholder="User Name" size="15" /><a href="" class="btn width-auto hasTooltip" data-placement="right" title="Forgot your username?"><i class="icon-help" title="Forgot your username?"></i></a>
			  </div>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <div class="input-prepend input-append">
			    <span class="add-on"><i class="icon-lock hasTooltip" data-placement="left" title="Password" ></i> <label for="mod-login-password" class="element-invisible">Password</label></span><input name="password" tabindex="2" id="mod-login-password" type="password" class="input-medium"  placeholder="Password" size="15" /><a href="http://www.scripps-rewards.com/forgetPass.php" class="btn width-auto hasTooltip" data-placement="right" title="Forgot your password?"><i class="icon-help" title="Forgot your password?"></i></a>
			  </div>
			 </div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<div class="btn-group pull-left">
					<button name="button" type="submit" tabindex="3" class="btn btn-primary btn-large"><i class="icon-lock icon-white"></i> Log in</button>
				</div>
			</div>
		</div>
		<input type="hidden" name="option" value="com_login" />
		<input type="hidden" name="task" value="login" />
		<input type="hidden" name="return" value="aW5kZXgucGhw" />
		<input type="hidden" name="3d6bf409d908a334cd578afe1d901d9f" value="1" />	</fieldset>
</form>

			</div>
		</div>
	</div>
	<div class="navbar navbar-fixed-bottom hidden-phone">
		<p class="pull-right">&copy; Capitol Marketing Concepts </p>
		<a href="../" class="pull-left"><i class="icon-share icon-white"></i> View Your Website.</a>
	</div>
	
</body>
</html>
<?php mysqli_close($con); ?>