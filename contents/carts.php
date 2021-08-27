<script language="javascript">
$(document).ready(function(){
	$('#B1').attr('disabled','');
	var emailok = false;
	var boxes = $(".input_s1_normal");
	var myForm = $("#form1"),pass = $("#pass"),phone = $("#phone"),zip = $("#zip"),state = $("#state"),city = $("#city"), paddress = $("#paddress"), taddress = $("#taddress"),fname = $("#fname"),lname = $("#lname"),midname = $("#midname"), email = $("#email"), emailInfo = $("#emailInfo"),emailInfo1 = $("#emailInfo1");
	
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
			
			
			emailInfo1.html("<font color='red'>please enter frist nmae</font>");
			fname.focus();
			return false;
		}
		if(lname.attr("value") == "")
		{
			
			emailInfo1.html("<font color='red'>Enter lastname</font>");
			lname.focus();
			return false;
		}
		if(midname.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter midname</font>");
			midname.focus();
			return false;
		}
		if(paddress.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter permanent address</font>");
			paddress.focus();
			return false;
		}
		if(taddress.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter tempory address</font>");
			taddress.focus();
			return false;
		}
			if(city.attr("value") == "")
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
		}
			if(zip.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter zip code</font>");
			zip.focus();
			return false;
		}
		
		
			if(phone.attr("value") == "")
		{
			
				emailInfo1.html("<font color='red'>Enter phone</font>");
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
			
				emailInfo1.html("<font color='red'>Enter password</font>");
			pass.focus();
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
});
</script><script type="text/javascript">
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
if(isset($_POST['submit']))
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
	
	$sql="INSERT INTO `members1`(`fname`, `lname`, `mid_initial_name`, `address`,`city`, `state`, `zip`, `phone`, `email`, `password`) VALUES ('".$fname."', '".$lname."', '".$midname."', '".$paddress."',  '".$city."', '".$state."', '".$zip."', '".$phone."', '".$email."', '".$pass."')";
	
	$result = mysqli_query($con, $sql);
	
	
}
?>
<div class="shape-featured">
  	<div class="text-haead"><strong>SHOPING CART DETAILS</strong></div>
</div>
<form>
<table border="0" width="100%" style="margin-top:22px;" cellpadding="0" cellspacing="0">
	<tr >
    	<Td width="16%" >
			<span class="des-text"><strong>Item No</strong></span>       	
        </Td>
        <Td width="14%" >
			<span class="des-text"><strong>Image</strong>    </span>      	
        </Td>
        <Td width="16%">
			<span class="des-text"><strong>Item Name</strong> </span>         	
        </Td>
        <Td width="14%">
			<span class="des-text"><strong>Price</strong>     </span>     	
        </Td>
        <Td width="18%">
			<span class="des-text"><strong>Item Quantity</strong></span>          	
        </Td>
        <Td width="10%">
			<span class="des-text"><strong>Total</strong>     </span>     	
        </Td>
        <Td width="12%">
			<span class="des-text"><strong>Action</strong></span>     	
        </Td>
    </tr>
    <tr>
    	<td colspan="7"><hr style="margin-top:0px;"/></td>
    </tr>
    <tr>
    	<Td>
			<span class="des-text" bgcolor="#f3f4f5">01 STW-E096</span>       	
        </Td>
        <Td class="td-padding">
			<img src="images/facebook-credit-card.png" width="45" height="55" style="border:1px solid #999; border-style:dotted"/>      	
        </Td>
        <Td >
			<span class="des-text">Bags study lays</span>       	
        </Td>
        <Td>
			<span class="des-text">$ 450</span>       	
        </Td>
        <Td>
			<input name="zip" id="zip" type="Text"   onKeyUp="showHint(this.value)" size="20" maxlength="5" class="textBox-2"/>
        </Td>
        <Td>
			<span class="des-text">$ 450</span>       	
        </Td>
        <Td>
			<a href="#" class="cont-a"><img src="../images/cross.png" border="0"  /> <span class="des-text">Delete</span></a>       	
        </Td>
      
    </tr>
    <tr>
    	<Td>
			<span class="des-text">01 STW-E096</span>       	
        </Td>
        <Td class="td-padding">
			<img src="images/facebook-credit-card.png" width="45" height="55" style="border:1px solid #999; border-style:dotted"/>      	
        </Td>
        <Td>
			<span class="des-text">Bags study lays</span>       	
        </Td>
        <Td>
			<span class="des-text">$ 450</span>       	
        </Td>
        <Td>
			<input name="zip" id="zip" type="Text"   onKeyUp="showHint(this.value)" size="20" maxlength="5" class="textBox-2"/>
        </Td>
        <Td>
			<span class="des-text">$ 450</span>       	
        </Td>
        <Td>
			<a href="#" class="cont-a"><img src="../images/cross.png" border="0"  /> <span class="des-text">Delete</span></a>       	
        </Td>
    </tr>
    <tr>
		<td colspan="7"><hr style="margin-top:12px;"/></td>
    </tr>
    <tr>
    	<td>
        </td>
        <td>
        </td>
        <td>
        </td>
        <td>
        </td>
         
        <td align="right">
        	<span class="des-text" style="padding-right:5px;"><strong>Sub Total : </strong></span>
        </td>
        <td>
        	<span class="des-text"><strong>$450</strong></span>
        </td>
        <td>
        </td>
    </tr>
</table>
<table width="100%" border="0">
  	<tr>
    <td width="16%">
  	<input type="submit" class="btn-11" onclick="window.location.href='?p=ProductDetail&amp;id=19'" name="button" id="button" value="update">  
    </td>
    <td width="">
	<input type="submit" class="btn-11" onclick="window.location.href='?p=ProductDetail&amp;id=19'" name="button" id="button" value="empty cart">
    </td>
    <td width="" align="right">
    <input type="submit" class="btn-11" onclick="window.location.href='?p=ProductDetail&amp;id=19'" name="button" id="button" value="countinue shoping" style="width:137px;">
    
    </td>
    <td width="16%">
     <input type="submit" class="btn-11" onclick="window.location.href='?p=ProductDetail&amp;id=19'" name="button" id="button" value="countinue order" style="width:137px;" >    
    </td>
    
    </tr>
  </table>
</form>

                          