<?php
 if(isset($_SESSION['userid']))	{ //echo " asdasdas" ;?>
<script language="javascript">
window.location.href='?p=profile'
</script>
<?php	//exit();			//for skip the below code
} ?>
<script language="javascript">
$(document).ready(function(){
	$('#B1').attr('disabled','');
	var emailok = false;
	var usernameok = false;
	var boxes = $(".input_s1_normal");
	var myForm = $("#form1"),pass = $("#pass"),phone = $("#phone"),zip = $("#zip"),state = $("#state"),city = $("#city"), paddress = $("#paddress"), /*taddress = $("#taddress"),*/fname = $("#fname"),lname = $("#lname"),midname = $("#midname"), email = $("#email"), userName = $("#userName"), emailInfo = $("#emailInfo"),usernameInfo = $("#usernameInfo"),emailInfo1 = $("#emailInfo1");
	
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
		/*if(paddress.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter Address 2</font>");
			paddress.focus();
			return false;
		}*/
		/*if(taddress.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter tempory address</font>");
			taddress.focus();
			return false;
		}*/
			if(city.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter City</font>");
			city.focus();
			return false;
		}
			if(state.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter State</font>");
			state.focus();
			return false;
		}
		
		if(zip.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter Zip</font>");
			zip.focus();
			return false;
		}
		
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
		if(!emailok)
		{
			
			email.attr("value","");
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
		if(!userNameok)
		{
			
			userName.attr("value","");
			userName.focus();
			return false;
		}
		
	});
	
	//send ajax request to check email
	email.blur(function(){
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
	});
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
if($mes=="reg"){$mes = "You Has Been Registered Successfully"; }
if($mes){?>

<div class="alert alert-success"><?php echo $mes;?></div>
<?php }

if(isset($_POST['btnSbt']))
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
	$userName=mysqli_real_escape_string($con, htmlentities($_POST['userName']));
	
	//$sql="INSERT INTO `members`(`fname`, `lname`, `mid_initial_name`, `address`,`city`, `state`, `zip`, `phone`, `email`, `password`, `username`) VALUES ('".$fname."', '".$lname."', '".$midname."', '".$paddress."',  '".$city."', '".$state."', '".$zip."', '".$phone."', '".$email."', '".$pass."', '".$userName."')";
	
	$sql="INSERT INTO `members`(`fname`, `lname`, `address1`, `address2`,`city`, `state`, `zip`, `phone`, `email`, `password`, `username`) VALUES ('".$fname."', '".$lname."', '".$midname."', '".$paddress."',  '".$city."', '".$state."', '".$zip."', '".$phone."', '".$email."', '".$pass."', '".$userName."')";
	
	
	//echo "INSERT INTO `members`(`fname`, `lname`, `address`,`city`, `state`, `zip`, `phone`, `email`, `password`, `username`) VALUES ('".$fname."', '".$lname."', '".$midname.' '.$paddress."',  '".$city."', '".$state."', '".$zip."', '".$phone."', '".$email."', '".$pass."', '".$userName."')";
	
	$result = mysqli_query($con, $sql);
	
	$_SESSION['userid'] = mysqli_insert_id($con);
	
?>
<script type="text/javascript" language="javascript">
window.location.href = "?p=Products";
</script>
<?php }?>
<div class="shape-featured">
  <div class="text-haead">REGISTER</div>
</div>
<div class="cont-a" style="float:right; font-size:12px; font-weight:bold;margin-top: 5px;margin-right: 5px;">Please feel free to shop and add items to the cart.  Once you submit the order we will confirm the point amount you currently have and release this order.</div>
<br />
<br />
<div class="Login-Div">
  <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data"  >
    <table border="0">
      <tr>
        <td width="167"><div id="emailInfo1" align="left"></div></td>
      </tr>
      <tr>
        <td><label class="des-text">First Name:</label></td>
        <td width="246"><input type="text" name="fname" id="fname" class="textBox"/>
          <br />
          <span style="color:#F00" id="fname1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Last Name:</label></td>
        <td><input type="text" name="lname" id="lname" class="textBox" />
          <br />
          <span style="color:#F00" id="lname1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text"> Address 1 
            :</label></td>
        <td><input type="text" name="midname" id="midname" class="textBox" />
          <br />
          <span style="color:#F00" id="midname1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Address 2:</label></td>
        <td><input type="text" name="paddress" id="paddress" class="textBox"/></td>
      </tr>
      <!--<tr><td> <label>Tempory Address:</label></td>
    <td><input type="text" name="taddress" id="taddress" />
    <br />
    <span style="color:#F00" id="taddress1"></span> </td>
  </tr>-->
      <tr>
        <td><label class="des-text">City:</label></td>
        <td><input type="text" name="city" id="city" class="textBox"/>
          <br />
          <span style="color:#F00" id="city1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">State:</label></td>
        <td><select name="state" id="state" style="border: 1px solid #999;;width:212px; height:30px; padding:4px; border-radius:3px;">
            <option value="">Select State</option>
            <option value="Alabama">Alabama</option>
            <option value="Alaska">Alaska</option>
            <option value="Arizona">Arizona</option>
            <option value="Arkansas">Arkansas</option>
            <option value="California">California</option>
            <option value="Colorado">Colorado</option>
            <option value="Connecticut">Connecticut</option>
            <option value="Delaware">Delaware</option>
            <option value="Florida">Florida</option>
            <option value="Georgia">Georgia</option>
            <option value="Hawaii">Hawaii</option>
            <option value="Idaho">Idaho</option>
            <option value="Illinois">Illinois</option>
            <option value="Indiana">Indiana</option>
            <option value="Iowa">Iowa</option>
            <option value="Kansas">Kansas</option>
            <option value="Kentucky">Kentucky</option>
            <option value="Louisiana">Louisiana</option>
            <option value="Maine">Maine</option>
            <option value="Maryland">Maryland</option>
            <option value="Massachusetts">Massachusetts</option>
            <option value="Michigan">Michigan</option>
            <option value="Minnesota">Minnesota</option>
            <option value="Mississippi">Mississippi</option>
            <option value="Missouri">Missouri</option>
            <option value="Montana">Montana</option>
            <option value="Nebraska">Nebraska</option>
            <option value="Nevada">Nevada</option>
            <option value="New Hampshire">New Hampshire</option>
            <option value="New Jersey">New Jersey</option>
            <option value="New Mexico">New Mexico</option>
            <option value="New York">New York</option>
            <option value="North Carolina">North Carolina</option>
            <option value="North Dakota">North Dakota</option>
            <option value="Ohio">Ohio</option>
            <option value="Oklahoma">Oklahoma</option>
            <option value="Oregon">Oregon</option>
            <option value="Pennsylvania">Pennsylvania</option>
            <option value="Rhode Island">Rhode Island</option>
            <option value="South Carolina">South Carolina</option>
            <option value="South Dakota">South Dakota</option>
            <option value="Tennessee">Tennessee</option>
            <option value="Texas">Texas</option>
            <option value="Utah">Utah</option>
            <option value="Vermont">Vermont</option>
            <option value="Virginia">Virginia</option>
            <option value="Washington">Washington</option>
            <option value="West Virginia">West Virginia</option>
            <option value="Wisconsin">Wisconsin</option>
            <option value="Wyoming">Wyoming</option>
          </select></td>
      </tr>
      <tr>
        <td><label class="des-text">Zip:</label></td>
        <td><!--<input name="zip" id="zip" type="Text"   onKeyUp="showHint(this.value)" size="20" maxlength="5" class="textBox"/>-->
          
          <input name="zip" id="zip" type="Text" size="20" maxlength="5" class="textBox"/>
          <br />
          <span style="color:#F00" id="zip1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Phone:</label></td>
        <td><input type="text" name="phone" id="phone" class="textBox"/>
          <br />
          <span style="color:#F00" id="phone1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Email:</label></td>
        <td><input type="text" name="email" id="email" class="textBox"/>
          <br />
          <span style="color:#F00" id="email1"></span>
          <div id="emailInfo" align="left"></div></td>
      </tr>
      <tr>
        <td><label class="des-text">Password:</label></td>
        <td><input type="password" name="pass" id="pass" class="textBox"/>
          <br />
          <span style="color:#F00" id="pass1"></span></td>
      </tr>
      <tr>
        <td><label class="des-text">Point Program Username</label></td>
        <td><input type="text" name="userName" id="userName" class="textBox" />
          <br />
          <span style="color:#F00" id="userName1"></span>
          <div id="usernameInfo" align="left"></div></td>
      </tr>
      <tr>
        <td></td>
        <td align="right"><input type="submit" name="btnSbt" class="btn" value="Register Now" style="float:right; margin-right:33px;"></td>
      </tr>
    </table>
  </form>
</div>
