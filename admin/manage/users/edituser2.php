<script type="text/javascript" language="javascript">
function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 30 && (charCode < 40 || charCode > 57))
	return false;
else
	return true;
}
</script>
<script type="text/javascript">
function checks(){
	//alert('testt');
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; 
	var email =document.f1.email.value;
	
	
		
				 
				 if(document.f1.fname.value==""){
			
			document.f1.fname.focus();
			document.getElementById('fname').innerHTML=" Please Enter First Name ";
			
			return false;
		}
			else{
				document.getElementById('fname').innerHTML="";
				 }
				 
				 	 if(document.f1.lname.value==""){
			
			document.f1.lname.focus();
			document.getElementById('lname').innerHTML=" Please Enter Last Name ";
			
			return false;
		}
			else{
				document.getElementById('lname').innerHTML="";
				 }
			 if(document.f1.address1.value==""){
			
			document.f1.address1.focus();
			document.getElementById('address1').innerHTML=" Please Enter Address ";
			
			return false;
		}
			else{
				document.getElementById('address1').innerHTML="";
				 }
				 
				 if(document.f1.email.value==""){
			
			
			document.getElementById('email').innerHTML="";
			
			
			}
			else if(!reg.test(email)){
			
			document.f1.email.focus();
			document.getElementById('email').innerHTML="Invalid Email Address";	  
			
			return false;
			}
			else{
				document.getElementById('email').innerHTML="";
				 }
				 
				  if(document.f1.city.value==""){
			
			document.f1.city.focus();
			document.getElementById('city').innerHTML=" Please Enter City ";
			
			return false;
		}
			else{
				document.getElementById('city').innerHTML="";
				 }
				 	  if(document.f1.state.value==""){
			
			document.f1.state.focus();
			document.getElementById('state').innerHTML=" Please Enter State ";
			
			return false;
		}
			else{
				document.getElementById('state').innerHTML="";
				 }
				 	  if(document.f1.zip.value==""){
			
			document.f1.zip.focus();
			document.getElementById('zip').innerHTML=" Please Enter Zip Code ";
			
			return false;
		}
			else{
				document.getElementById('zip').innerHTML="";
				 }
				 
				 	 	
				 	 	
			
				 
			
}

</script>
<style type="text/css">
.enrol-table {
	margin-top:10px;
	margin-bottom:10px;
}
.enrol-table td {
	padding-bottom:7px;
	padding-top:7px;
	border-bottom:1px solid #CCC;
	border-bottom-style:dotted;
	padding-left:20px;
}
.enrol-txtBox {
	width:252px;
	height:25px;
	border:1px solid #105ea6;
	padding-left:5px;
	padding-right:5px;
}
.enrol-txtBox1 {
	width:100px;
	height:25px;
	border:1px solid #105ea6;
	padding-left:5px;
	padding-right:5px;
}
.enrol-txtBox2 {
	width:46px;
	height:25px;
	border:1px solid #105ea6;
	padding-left:5px;
	padding-right:5px;
}
.enrol-txtBox3 {
	width:100px;
	height:25px;
	border:1px solid #105ea6;
	padding-left:5px;
	padding-right:5px;
}
.enrol-txtBox4 {
	width:91px;
	height:25px;
	border:1px solid #105ea6;
	padding-left:5px;
	padding-right:5px;
}
.btn2 {
	padding-left:12px;
	padding-right:12px;
	height:28px;
	color:#FFF;
	background-color:#a9be4d;
	cursor:pointer;
	border:none
}
.btn2:hover {
	background-color:#94a936
}
</style>
<?php 
$id=$_REQUEST['id'];

$Recordset2 = mysqli_query($con, "select * from userinfo where id='".$id."'");
$row=mysqli_fetch_array($Recordset2);
$rslt=mysqli_query($con, "SELECT * FROM  `web_info` WHERE id ='1'");
$title=mysqli_fetch_array($rslt);
$web= $title['name'];
$link= $title['link'];
$color= $title['color'];
$rslt1=mysqli_query($con, "SELECT * FROM `users` WHERE  id ='1'");
$title1=mysqli_fetch_array($rslt1);
$admin= $title1['email'];














if($_GET['mes']=='add'){$mes = 'New User Has Been Added In A System';}
	if($mes){?><div class="alert alert-success" align="left"><?php echo $mes; ?></div><?php }?>
    
  
    
<?php
if(isset($_POST['btn_sbt']))
{
	
	
		
	
	$fname          = mysqli_real_escape_string($con, $_POST['fname']);	
	$lname          = mysqli_real_escape_string($con, $_POST['lname']);
	$address1       = mysqli_real_escape_string($con, $_POST['address1']);

	$city           = mysqli_real_escape_string($con, $_POST['city']);
	$state          = mysqli_real_escape_string($con, $_POST['state']);
	$zip            = $_POST['zip'];
	$phone          = $_POST['phone']; 
	$email          = mysqli_real_escape_string($con, $_POST['email']);



	$today=date("m-d-Y");

	
		 
		
	
	$EnrollQuery =	mysqli_query($con, "UPDATE `userinfo` set `fname`='".$fname ."',`lname`='".$lname."',`address1`='".$address1."',`city`='".$city."',`state`='".$state."',`zip`='".$zip."',`phone`='".$phone."',`email`='".$email."' where id='".$id."'");
	
				
	
?>
<script type="text/javascript" language="javascript">
window.location.href = "?p=viewuser&mes=update";
</script>
<?php } ?><div class="clr"></div>
<div style="width:auto; height:auto; padding:10px;"> 
<div class="cat-heding"> <h1>Edit User </h1></div>
 
  <font color="#F00"> * All fields are required. </font>
  
  <form action="" method="post" name="f1" onsubmit="return checks()" enctype="multipart/form-data" >
    <table class="enrol-table" border="0" width="70%" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">
      
      <tr>
        <td width="50%"><strong>First Name: <font color="#F00">*</font></strong><br />
          <input type="text" name="fname" value="<?php echo $row['fname']; ?>" class="enrol-txtBox" /><br/>
           <span style="color:#C00" id="fname"></span></td>
        <td width="50%"> <strong>Last Name: <font color="#F00">*</font></strong><br />
          <input type="text" name="lname"  value="<?php echo $row['lname']; ?>" class="enrol-txtBox" /><br/>
           <span style="color:#C00" id="lname"></span></td>
      </tr>
      <tr>
        <td> <strong>Address: <font color="#F00">*</font></strong><br />
          <input type="text" name="address1"  value="<?php echo $row['address1']; ?>" class="enrol-txtBox" /><br/>
          <span style="color:#C00" id="address1"></span></td>
       <td> <strong>Email: <font color="#F00"></font></strong><br />
        <input type="text" name="email"  value="<?php echo $row['email']; ?>"   class="enrol-txtBox" /><br/>
         <span style="color:#C00" id="email"></span></td>
      </tr>
      <tr>
        <td><strong>City: <font color="#F00">*</font></strong><br />
          <input type="text" name="city"  value="<?php echo $row['city']; ?>" class="enrol-txtBox" /><br/>
          <span style="color:#C00" id="city"></span></td>
          
        <td> <strong>State</strong><strong>: <font color="#F00">*</font></strong><br />
          <input type="text" name="state"  value="<?php echo $row['state']; ?>" class="enrol-txtBox" /><br/>
          <span style="color:#C00" id="state"></span></td>
      </tr>
      <tr>
        <td> <strong>Zip: <font color="#F00">*</font></strong><br />
          <input type="text" name="zip"    value="<?php echo $row['zip']; ?>"onKeyPress="return isNumberKey(event)" class="enrol-txtBox" /><br/>
          <span style="color:#C00" id="zip"></span></td>
        <td> <strong>Phone: <font color="#F00"></font></strong><br />
          <input type="text" name="phone"  value="<?php echo $row['phone']; ?>" onKeyPress="return isNumberKey(event)" class="enrol-txtBox" /><br/>
          <span style="color:#C00" id="phone"></span></td>
      </tr>
      
      
      <tr>
        <td align="center" colspan="2"><input type="submit" name="btn_sbt" value="Update" class="btn2" style="width:250px;"></td>
      </tr>
    </table>
  </form>
</div>