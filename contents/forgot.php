<?php
 if(isset($_SESSION['userid']))	{ //echo " asdasdas" ;?>
<script language="javascript">
window.location.href='?p=profile'
</script>
<?php	//exit();			//for skip the below code
} ?>

<div class="shape-featured">
  <div class="text-haead">LOGIN</div>
</div>
<div class="Login-Div">
  <form action="" method="post" enctype="application/x-www-form-urlencoded" name="LoginForm">
    <table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="20%" rowspan="6" align="right"><img src="images/forgot_left_icon.png" alt="Image" style="margin-top:-40px;" width="97" /></td>
        <td align="right" valign="top">&nbsp;</td>
        <td><?php if($mes){?>
          <div class="alert "> <?php echo $mes; ?> </div>
          <?php }?></td>
      </tr>
      <tr>
        <td align="right" valign="middle"><span class="text-1">E-mail :</span></td>
        <td width="52%"><input type="text" class="Login_Field" name="username" id="username" style="
    height: 15px;
    width: 200px;
    border-radius: 2px;
"></td>
      </tr>
      <tr>
        <td width="19%" valign="top">&nbsp;</td>
        <td><span class="text-1"><a class="link-a" href="?p=Login">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="link-a" href="?p=Register">Register</a></span></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td align="right"><input type="submit" class="btn-1" name="signin_submit" id="signin_submit" value="Login" style="
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
