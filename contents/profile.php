<?php 
if(!isset($_SESSION['userid']))
{
?>
<script type="text/javascript">
window.location.href = "?p=Login";
</script>
<?php } ?>
<script language="javascript">
$(document).ready(function(){
	$('#B1').attr('disabled','');
	var emailok = false;
	var usernameok = false;
	var boxes = $(".input_s1_normal");
	var myForm = $("#form1"),pass = $("#pass"),phone = $("#phone"),zip = $("#zip"),/*state = $("#state"),city = $("#city"),*/ paddress = $("#paddress"), /*taddress = $("#taddress"),*/fname = $("#fname"),lname = $("#lname"),midname = $("#midname"),/* email = $("#email"), userName = $("#userName"),*/ emailInfo = $("#emailInfo"),usernameInfo = $("#usernameInfo"),emailInfo1 = $("#emailInfo1");
	
	//give some effect on focus
	boxes.focus(function(){
		$(this).addClass("input_s1_focus");
	});
	//reset on blur
	boxes.blur(function(){
		$(this).removeClass("input_s1_focus");
	});
	
	//Form Validation
	myForm.submit(function(){
		if(fname.attr("value") == "")
		{
			
			
			emailInfo1.html("<font color='red'>Enter Frist Name</font>");
			fname.focus();
			return false;
		}
		if(lname.attr("value") == "")
		{
			
			emailInfo1.html("<font color='red'>Enter Last Name</font>");
			lname.focus();
			return false;
		}
		if(midname.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter Address 1</font>");
			midname.focus();
			return false;
		}
		if(paddress.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter Address 2</font>");
			paddress.focus();
			return false;
		}
		/*if(taddress.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter tempory address</font>");
			taddress.focus();
			return false;
		}*/
		if(zip.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter Zip</font>");
			zip.focus();
			return false;
		}
		/*	if(city.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter city</font>");
			city.focus();
			return false;
		}
			if(state.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter state</font>");
			state.focus();
			return false;
		}*/
			if(phone.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter Phone</font>");
			phone.focus();
			return false;
		}
		
		if(email.attr("value") == "")
		{
			
			email.focus();
			return false;
		}
			if(pass.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter Password</font>");
			pass.focus();
			return false;
		}
		
			if(userName.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter Username</font>");
			userName.focus();
			return false;
		}
		
	});
	
	//send ajax request to check email
	<?php /*?>email.blur(function(){
		$.ajax({
			type: "POST",
			data: "email="+$(this).attr("value"),
			url: "check.php",
			beforeSend: function()
			{
				emailInfo.html("<font color='blue'>Checking Email...</font>");
			},
			success: function(data)
			{
				if(data == "invalid")
				{
					emailok = false;
					emailInfo.html("<font color='red'>Inavlid Email</font>");
				}
				else if(data != "0")
				{
					emailok = false;
					emailInfo.html("<font color='red'>Email Already Exist</font>");
				}
				else
				{
					emailok = true;
					emailInfo.html("<font color='green'>Email OK</font>");
				}
			}
		});
	});
	
	userName.blur(function(){
		$.ajax({
			type: "POST",
			data: "username="+$(this).attr("value"),
			url: "contents/checkUserName.php",
			beforeSend: function()
			{
				usernameInfo.html("<font color='blue'>Checking Username...</font>");
			},
			success: function(data)
			{
				if(data == "invalid")
				{
					userNameok = false;
					usernameInfo.html("<font color='red'>Invalid Username</font>");
				}
				else if(data != "0")
				{
					userNameok = false;
					usernameInfo.html("<font color='red'>Username Already Exist</font>");
				}
				else
				{
					userNameok = true;
					usernameInfo.html("<font color='green'>Username OK</font>");
				}
			}
		});
	});<?php */?>
});
</script>
<script type="text/javascript">
function showHint(zip1)
{
	
if (window.XMLHttpRequest)
  {   
      xmlhttp=new XMLHttpRequest();
  }
  else
  {   
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {  
  	  document.getElementById("cty").innerHTML=xmlhttp.responseText;  
  }
	
  }
 
   xmlhttp.open("GET","data.php?q="+zip1, true);
   xmlhttp.send();
}
function showHint1(sta)
{
	
if (window.XMLHttpRequest)
  {    
      xmlhttp=new XMLHttpRequest();
  }
else
  {    
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {
		  document.getElementById("cty1").innerHTML=xmlhttp.responseText;  
   }
	
  } 
  xmlhttp.open("GET","data.php?p="+sta, true);
  xmlhttp.send();
}

</script>
<?php
$mes = $_GET['mes'];
if($mes == "upd"){$mes = 'Profile Has Been Updated Successfully';}
if($mes){?>

<div class="alert alert-success"><?php echo $mes;?></div>
<?php }

$showProf = mysqli_query($con, "SELECT * FROM members WHERE id = '".$_SESSION['userid']."'");
$proRec   = mysqli_fetch_array($showProf);
if(isset($_POST['btnUpd']))
{
  
	$fname= mysqli_real_escape_string($con, htmlentities($_POST['fname']));
	$lname=mysqli_real_escape_string($con, htmlentities($_POST['lname']));
	$midname=mysqli_real_escape_string($con, htmlentities($_POST['midname']));
	$paddress=mysqli_real_escape_string($con, htmlentities($_POST['paddress']));
	//$taddress=mysqli_real_escape_string($con, htmlentities($_POST['taddress']));
	$city=mysqli_real_escape_string($con, htmlentities($_POST['city']));
	$state=mysqli_real_escape_string($con, htmlentities($_POST['state']));
	$zip=$_POST['zip'];
	$phone=$_POST['phone'];
	$email=mysqli_real_escape_string($con, htmlentities($_POST['email']));
	$pass=mysqli_real_escape_string($con, htmlentities($_POST['pass']));
	$username=mysqli_real_escape_string($con, htmlentities($_POST['userName']));
	
	$sql="UPDATE `members` SET `fname` = '".$fname."', `lname` = '".$lname."', `address1` = '".$midname."', `address2` = '".$paddress."', `city` = '".$city."', `state` = '".$state."', `zip` = '".$zip."', `phone` = '".$phone."', `email` = '".$email."', `password` = '".$pass."', `username` = '".$username."' WHERE id = '".$_SESSION['userid']."'";
	//echo "UPDATE `members` SET `fname` = '".$fname."', `lname` = '".$lname."', `address1` = '".$midname."', `address2` = '".$paddress."', `city` = '".$city."', `state` = '".$state."', `zip` = '".$zip."', `phone` = '".$phone."', `email` = '".$email."', `password` = '".$pass."', `username` = '".$username."' WHERE id = '".$_SESSION['userid']."'";
	
	$result = mysqli_query($con, $sql);
	
	
?>
<script type="text/javascript" language="javascript">
window.location.href = "?p=profile&mes=upd";
</script>
<?php }?>
<div class="shape-featured">
  <div class="text-haead">Profile </div>
</div>
<div class="Login-Div">
  <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data"  >
    <table border="0">
      <tr>
        <td width="167"><div id="emailInfo1" align="left"></div></td>
      </tr>
      <tr>
        <td><label class="des-text">First Name:</label></td>
        <td width="246"><input type="text" value="<?php echo $proRec['fname'];?>" name="fname" id="fname" class="textBox"/>
          <br />
          <span style="color:#F00" id="fname1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Last Name:</label></td>
        <td><input type="text" value="<?php echo $proRec['lname'];?>" name="lname" id="lname" class="textBox" />
          <br />
          <span style="color:#F00" id="lname1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text"> Address 1 
            :</label></td>
        <td><input type="text" value="<?php echo $proRec['address1'];?>" name="midname" id="midname" class="textBox" />
          <br />
          <span style="color:#F00" id="midname1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Address 2:</label></td>
        <td><input type="text" value="<?php echo $proRec['address2'];?>" name="paddress" id="paddress" class="textBox"/>
          <br />
          <span style="color:#F00" id="paddress1"></span></td>
      </tr>
      <!--<tr><td> <label>Tempory Address:</label></td>
    <td><input type="text" name="taddress" id="taddress" />
    <br />
    <span style="color:#F00" id="taddress1"></span> </td>
  </tr>-->
      <tr>
        <td><label class="des-text">Zip:</label></td>
        <td><input name="zip" value="<?php echo $proRec['zip'];?>" id="zip" type="Text"   onKeyUp="showHint(this.value)" size="20" maxlength="5" class="textBox"/></td>
      </tr>
      <tr>
        <td>City:</td>
        <td><div style="width:207px; background-color:#FFF; border:1px solid #999; border-radius:3px; padding:2px;">
            <div id="cty">
              <select value="" id="city" name="city" class="select-width" style="border:none;">
                <option value="<?php echo $proRec['city'];?>"><?php echo $proRec['city'];?></option>
              </select>
            </div>
          </div></td>
      </tr>
      <tr>
        <td><label class="des-text">State:</label></td>
        <td><div id="cty1">
            <input value="<?php echo $proRec['state'];?>" name="state" class="textBox"/>
          </div></td>
      </tr>
      <tr>
        <td><label class="des-text">Phone:</label></td>
        <td><input type="text" value="<?php echo $proRec['phone'];?>" name="phone" id="phone" class="textBox"/>
          <br />
          <span style="color:#F00" id="phone1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Email:</label></td>
        <td><input type="text" readonly="readonly" value="<?php echo $proRec['email'];?>" name="email" id="email" class="textBox"/></td>
      </tr>
      <tr>
        <td><label class="des-text">Password:</label></td>
        <td><input type="text" value="<?php echo $proRec['password'];?>"  name="pass" id="pass" class="textBox"/>
          <br />
          <span style="color:#F00" id="pass1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Point Program Username</label></td>
        <td><input type="text" readonly="readonly" value="<?php echo $proRec['username'];?>" name="userName" id="userName" class="textBox" /></td>
      </tr>
      <tr>
        <td></td>
        <td align="right"><input type="submit" name="btnUpd" class="btn" value="Update" style="float:right; margin-right:33px;"></td>
      </tr>
    </table>
  </form>
</div>
