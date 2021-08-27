<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
	
<link rel="stylesheet" href="http://capitolmarketingdeals.com/admin/manage/style.css" />

	<style type="text/css">
    .span6{
		width: 1108px !important;
		}
    
    </style>

	

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
	
	  $(".flash").show();
     $(".flash").fadeIn(400).html('<img src="manage/ajax-loader1.gif" style="text-align:center"	 />');
	
	 
     var dataString = 'pageId='+pageId+'&scol='+sclname+'&searchdata='+search_data;
    $("#srchfx").html("");
	 $.ajax({
           type: "POST",
           url: "manage/loadused.php",
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
</script>


</head>
<script type="text/javascript">
function resetbox(){
		$("#srchfx").html("");
		$('#query').val('');
		$("#empty_column").attr("selected","selected");
		
		changePagination('0');	
		
		}
</script>
<?php
$mes=$_REQUEST['mes'];
$com=$_REQUEST['com'];
$id=$_REQUEST['id'];
$pageLimit=25;
$Recordset2 = mysqli_query($con, "select * from capXlsx where status='1'");
$totalRecords = mysqli_num_rows($Recordset2);
$totalpages = ceil($totalRecords/$pageLimit);
if($mes ==	'err') { $mes	=	'Certificates image not valid'; }
if($mes ==	'update') { $mes	=	'Certificates has been updated successfully'; }
else if($mes ==	'add') { $mes	=	'Certificates has been added successfully'; }
else if($mes == 'del') {$mes	=	"Certificates has been deleted successfully";}
else if($mes == 'empty') {$mes	=	"You Have Deleted All The Records Of This Table";}
if($com	==	'del')	{
mysqli_query($con, "DELETE FROM `capXlsx` WHERE `id`=".$id);
goUrl('?p=showUsedvoch&mes=del');
}
if($com	==	'empty')	{
mysqli_query($con, "DELETE FROM `capXlsx` WHERE `status`='1' ORDER BY id DESC");
goUrl('?p=showUsedvoch&mes=empty');

}
?>
<?php if($mes){?>
<div class="alert alert-success"> <strong><?php echo $mes; ?></strong></div>
<?php } ?>
<h2 class="table table-striped">Used Certificates[<?php echo $totalRecords;?>]</h2>
  <!-- <div align="right"><a href="?p=showUsedvoch&com=empty" onClick= "return confirm('Do You Want To Delete All Certificates?')">Delete All Records</a></div>  -->
<div class="cat-heding"><a href='manage/usedcerti.php'>To Export  As Excel Click here</a></div>
<div align="right"><a href="javascript:history.go(-1)">« Go Back</a></div>





<div id="tableheader">
        	<div class="search">
                <select id="columns"  style="width: 200px;">
                	<option value="" id="empty_column">Search By Column</option>
                    <option value="c.cname"> Company</option>
                    <option value="c.job"> Job Number</option>
                    <option value="c.certificate"> Certificate</option>
                    <option value="u.fname"> First Name</option>
                    <option value="u.lname"> Last Name</option>
                    <option value="u.address1"> Address</option>
                    <option value="u.city"> City</option>
                    <option value="u.state"> State</option>
                    <option value="u.zip"> Zip</option>
                    <option value="u.phone"> Phone</option>
                    <option value="u.email"> Email</option>
                    <option value="c.createdon"> Created On</option>
                    <option value="c.expiration"> Expiration</option>
                </select>
				
				 <!-- <select id="columns" onchange="changePagination('0')" style="width: 200px;">
                	<option value="" id="empty_column"> Sort By Column</option>
                    <option value="voucher"> Voucher</option>
                    <option value="first"> First Name</option>
                    <option value="last"> Lat Name</option>
                    <option value="job"> Job</option>
                    <option value="createdon"> Created On</option>
                    <option value="expiration"> Expiration</option>
                </select>  -->
               
                <input type="text" id="query" placeholder="search....."/>
                <input type="button" value="Search" onClick="changePagination('0')" class="btn2 nsearchbtn" />
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
        



