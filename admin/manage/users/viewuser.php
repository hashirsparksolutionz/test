<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
	
<link rel="stylesheet" href="http://capitolmarketingdeals.com/admin/manage/style.css" />
<style type="text/css">
    .span6{
		width: 980px !important;
		}
    
    </style>

	
</head>

<?php
$mes=$_REQUEST['mes'];
$com=$_REQUEST['com'];
$id=$_REQUEST['id'];
$pageLimit=25;
$Recordset2 = mysqli_query($con, "select * from userinfo order by id desc;");
$totalRecords = mysqli_num_rows($Recordset2);
$totalpages = ceil($totalRecords/$pageLimit);
if($mes ==	'err') { $mes	=	'Users image not valid'; }
if($mes ==	'update') { $mes	=	'Users has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'Users has been added successfully'; }
else if($mes == 'del') {$mes	=	"Users has been deleted successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
else if($mes == 'send') {$mes	=	"Email Have Been Send";}
if($com	==	'del')	{
mysqli_query($con, "DELETE FROM `userinfo` WHERE `id`=".$id);
goUrl('?p=viewuser&mes=del');
}
if($com	==	'empty'){
mysqli_query($con, "TRUNCATE TABLE `userinfo`");
goUrl('?p=viewuser&mes=empty');

}
//email
if($com	=='email'){

	$Recordset3 = mysqli_query($con, "select * from userinfo where id='".$id."'");
$fetch_r = mysqli_fetch_array($Recordset3);
$voucher=$fetch_r['vocher'];
$to=$fetch_r['email'];
$Demonination=$fetch_r['Demonination'];
$exp_date=$fetch_r['expiration'];

//////////////////////Email Send/////////////////////////////////////////
	$rslt1=mysqli_query($con, "SELECT * FROM `users` WHERE  id ='1'");



$title1=mysqli_fetch_array($rslt1);



$admin= $title1['email'];
	
	$bounce="bounce@pypvouchers.com";
	$subject = 'Furniture Row '; 

    $headers 	= "From: Furniture Row <".$admin.">".PHP_EOL;

	$headers .= "Return-Path: ".$bounce.PHP_EOL;

	$headers .= "MIME-Version: 1.0".PHP_EOL;

	$headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;

	//$body = " $head <br />";

	$body	='<div style="width: 960px; margin: auto;">

  <div style="background-image: url(http://www.pypvouchers.com/images/email_header.png); background-repeat: no-repeat; background-position: center top; height: 300px; border-left: 2px solid #B13427;
border-right: 2px solid #B13427;
border-top: 2px solid #B13427;"></div>

   <div style="background-image: url(http://www.pypvouchers.com/images/border.png); background-repeat: repeat-y; background-position: center center; border-left: 2px solid #B13427;
border-right: 2px solid #B13427;">

    <table width="820" border="0" align="center" cellpadding="0" cellspacing="0">

      <tbody>

        <tr>

          <td colspan="2"><div class="logo-div" style="text-align: center; line-height:0px;"> <a href="http://www.pypvouchers.com" target="_blank"></a></div>

            <table width="100%" cellpadding="0" cellspacing="0">

              

			  <tr>

                <td colspan="4" style="text-align:center"><div style="font-family:Verdana,Tahoma,Arial,sans-serif; color:#444444;font-weight: bold; font-size: 14px;">The Specialty Stores at</div>

    <div style="font-family:Verdana,Tahoma,Arial,sans-serif; color:#B13427;font-weight: bold;font-size:42px;">Furniture Row</div></td>

               

              </tr>

			  <tr>

                <td width="35%" align="right"><h3>Certificate #: </h3></td>

                <td width="12%"><div style="color:#B13427; font-size:24;"><h3>'.$voucher.'</h3></div></td>

                <td width="25%" align="right"><h3>Certificate Value:</h3></td>

                <td width="28%"><div style="color:#B13427; font-size:24;"><h3>$'.$Demonination.'</h3></div></td>

              </tr>

              <tr>

                <td><h1 style="color:#b0352b;font-size: 40px;">Home&nbsp;Depot&nbsp;</h1></td>

                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;Kohl&rsquo;s&nbsp;</h1></td>

                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;&nbsp;Target&nbsp;</h1></td>

                <td><h1 style="color:#b0352b;font-size: 40px;">&bull;&nbsp;Visa&nbsp;</h1></td>

              </tr>

            </table>

            <div class="clr" style="clear: both;"> </div>

            <div title="Page 1">

              <div>

                <div>

                  <div>

                    <h2 align="center">To redeem your gift card go to <a href="http://pypvouchers.com" style="color:#B13427; text-decoration:underline;" target="_blank">http://pypvouchers.com</a></h2>

                    <p style="margin-left:15px">Gift Card Terms &amp; Conditions: </p>

                    <ul>

                      <li> Capitol Marketing Concepts reserves the right to substitute a comparable gift card. </li>

                      <li> You have received this certificate as part of a business promotion. The business promoter who granted the certificate to you specifically conditions its redemption upon full payment to Capitol Marketing Concepts. </li>

                      <li> All taxes are the responsibility of the person receiving the redemption. </li>

                      <li> Certificates are completely transferable, but may not be resold under any circumstances. Notice of resell will void the certificate. </li>

                      <li> Once your certificate is received allow 2-4 weeks for processing and delivery. The package you selected will be sent to you via the US Postal Service. Failure to adhere to all Terms &amp; Conditions may hinder the processing of your certificate. </li>

                      <li> Offer not valid after expiration date under any circumstance. </li>

                    </ul>

                  </div>

                </div>

              </div>

            </div></td>

        </tr>

        <tr>

          <td colspan="2"><h3 align="center">For Questions related to gift cards please call 1-888-411-7447</h3></td>

        </tr>

        <tr>

          <td width="408" style="padding-left: 150px;">Florida Seller of Travel Numbers for<br />

            Capitol Marketing Concepts: ST36176 </td>

          <td width="444" style="padding-right: 150px;" align="right"><strong>Expiration Date:</strong>'.$exp_date.'</td>

        </tr>

      </tbody>

    </table>

  </div>

  <div style="background-image: url(http://www.pypvouchers.com/images/bottom.png); background-repeat: no-repeat; background-position: center top; height: 36px; width: 956px; border-left: 2px solid #B13427;
border-right: 2px solid #B13427;
border-bottom: 2px solid #B13427;"></div>

</div>'; 



	

//$body .= " $foot <br />";



	mail($to,$subject,$body,$headers);
















//////////////////////////END //////////////////////////////////////

goUrl('?p=viewuser&mes=send');

}


?>
<?php if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } ?>






<style type="text/css">
h2 {
font-size: 22px;
line-height: 24px;
}

.inner-table {
  border: none;
}

.inner-table td {
  border: none;
}
.flash {
	position: fixed;
	width: 100%;
	height: 100%;
	top: 0px;
	left: 0px;
	background: rgba(255, 255, 255, 0.76);
}
.flash img {
	margin: 0 auto;
	display: table;
	margin-top: 35vh;
}
div.paginationp {
padding: 3px;
margin: 3px;
text-align:center;
margin-top: 20px;
}

div.paginationp a {
padding: 2px 5px 2px 5px;
margin: 2px;
border: 1px solid #AAAADD;

text-decoration: none; /* no underline */
color: #000099;
}
div.paginationp a:hover, div.digg a:active {
border: 1px solid #000099;

color: #000;
}
div.paginationp span.currentp {
padding: 2px 5px 2px 5px;
margin: 2px;
border: 1px solid #000099;

font-weight: bold;
background-color: #000099;
color: #FFF;
}
div.paginationp span.disabled {
padding: 2px 5px 2px 5px;
margin: 2px;
border: 1px solid #EEE;

color: #DDD;
}
.nsearchbtn{
	
	height: 30px;
	width: 65px !important;
}
#xerror_msgn{
	color: red;
	text-align: center;
	font-size: 20px;

	display: block;
	margin-top: 20px;
	
	}

</style>

<script type="text/javascript">
function changePagination(pageId){
    var search_data = $('#query').val();
	 //var sorting_col = $('#columns').val();
	 var sclname = $('#columns').val();
	 if(search_data){
		if(sclname == ""){
			$("#srchfx").html("Please select column for search.");
			return false;
		}	 
	 }
	 
	 if(sclname){
		if(search_data == ""){
			$("#srchfx").html("Please enter something for search.");
			return false;
		}	 
	 }
	
	 //alert(search_data);
	 
	 $(".flash").show();
     $(".flash").fadeIn(400).html('<img src="manage/ajax-loader1.gif" style="text-align:center"	 />');
	
     var dataString = 'pageId='+pageId+'&scol='+sclname+'&searchdata='+search_data;
    $("#srchfx").html("");
	 $.ajax({
           type: "POST",
            url: "manage/users/loadusers.php",
           data: dataString,
           cache: false,
           success: function(result){
           	   $(".flash").hide();
               $("#pageData").html(result);
			   
			  
			   var total_rec = $("#pageData").find('.total_rec').text();
			   
			   
			   $('#show_total').html(total_rec);
			   
			   $('#startrecord').html($("#pageData").find('.start_rec').text());
			   $('#endrecord').html($("#pageData").find('.end_rec').text());
			   $('#totalrecords').html(total_rec);
			   $('#xerror_msgn').html($('#pageData').find('#error_msg').text());
			   
           }
      });
}

$(document).ready(function(){
	changePagination('0');	
});

function resetbox(){
		
		$('#query').val('');
		//$('#nil').selected=selected;
		$("#empty_column").attr("selected","selected");
		$("#srchfx").html("");
		changePagination('0');	
		
		}
		
		function validation(){
			var search_data = $('#query').val();
			var sclname = $('#columns').val();
			//alert(search_data);
			//alert(sclname);
			if(sclname){
				if(search_data == ""){
				//	alert("empty");
					$("#srchfx").html("Please enter something for search.");
					return false;
				}	 
			}
		}

</script>






















<h2 class="table table-striped">Manage Your Users[<?php echo $totalRecords;?>]</h2>
<div class="cat-heding"><a href='manage/users/user_xls.php'>To Export  As Excel Click here</a></div>
  <!-- <div align="right"><a href="?p=viewuser&com=empty" onClick= "return confirm('Do You Want To Delete All Users?')">Delete All Records</a></div> -->
<div align="right"><a href="javascript:history.go(-1)">« Go Back</a></div>

    <div id="tableheader">
        	<div class="search">
               
				
				 <select id="columns"  style="width: 200px;">
                	<option value="" id="empty_column"> Search By Column</option>
                    <option value="vocher"> Certificate</option>
                    <option value="fname"> First Name</option>
                    <option value="lname"> Last Name</option>
                    <option value="address1"> Address</option>
                    <option value="city"> City</option>
                    <option value="state"> State</option>
                    <option value="zip"> Zip</option>
                    <option value="phone"> Phone</option>
                    <option value="email"> Email</option>
                </select> 
               
                <input type="text" id="query" placeholder="search....."/>
                <input type="button" value="Search" onClick="changePagination('0')" class="btn2 nsearchbtn" />
                <!--<input type="button" value="Search" onClick="validation()" class="btn2 nsearchbtn" /> -->
            </div>
			
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()" onClick="resetbox()">Reset</a></div>
        	</span>
			
			
        </div>
        
		<div class="clear"></div>
			<span id="srchfx" style="color:red"></span>
		
<div id="pageData"></div>
<span id="xerror_msgn"></span>


<span class="flash"></span>
        
	