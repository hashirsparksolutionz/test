<?php 
session_start();
if(!isset($_SESSION['admin_id']))
{
$_SESSION['url']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
}
  
	require_once('../includes/myconn.php');
	require_once('../includes/functions.php'); 
//	require_once('../includes/https.php');
	//require_once('classes/upload.php');
	require_once('mod/ascheck.php');
	require_once('mod/navigator.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Admin</title>
<link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
<link rel="stylesheet" href="../css/template.css" type="text/css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-noconflict.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<script src="../js/template.js" type="text/javascript"></script>
  <script type="text/javascript">
jQuery(document).ready(function() {
					jQuery('.hasTooltip').tooltip({});
				});
var plg_quickicon_joomlaupdate_ajax_url = 'http://localhost/administrator/index.php?option=com_installer&view=update&task=update.ajax';
var plg_quickicon_jupdatecheck_jversion = "3.0.2";
var plg_quickicon_joomlaupdate_text = {"UPTODATE" : "Joomla! is up-to-date", "UPDATEFOUND": "Joomla! <span class=\'label label-important\'>%s</span>, Update now!", "ERROR": "Unknown Joomla!..."};
var plg_quickicon_joomlaupdate_img = {"UPTODATE" : "/administrator/templates/isis/images/header/icon-48-jupdate-uptodate.png", "ERROR": "/administrator/templates/isis/images/header/icon-48-deny.png", "UPDATEFOUND": "/administrator/templates/isis/images/header/icon-48-jupdate-updatefound.png"};

var plg_quickicon_extensionupdate_ajax_url = 'http://localhost/administrator/index.php?option=com_installer&view=update&task=update.ajax';
var plg_quickicon_extensionupdate_text = {"UPTODATE" : "All extensions are up-to-date", "UPDATEFOUND": "Updates are available! <span class=\'label label-important\'>%s</span>", "ERROR": "Unknown extensions..."};

  </script>
  		<script>
		(function($){
			// fix sub nav on scroll
			var $win = $(window)
			  , $nav = $('.subhead')
			  , navTop = $('.subhead').length && $('.subhead').offset().top - 40			  , isFixed = 0

			processScroll()

			// hack sad times - holdover until rewrite for 2.1
			$nav.on('click', function () {
				if (!isFixed) setTimeout(function () {  $win.scrollTop($win.scrollTop() - 47) }, 10)
			})

			$win.on('scroll', processScroll)

			function processScroll() {
				var i, scrollTop = $win.scrollTop()
				if (scrollTop >= navTop && !isFixed) {
					isFixed = 1
					$nav.addClass('subhead-fixed')
				} else if (scrollTop <= navTop && isFixed) {
					isFixed = 0
					$nav.removeClass('subhead-fixed')
				}
			}
		})(jQuery);
	</script>
    <script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/cycle-plugin.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#fade_wep').cycle();
});
</script>

    <script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="../js/jquery.form.js" type="text/javascript"></script>
    <script type="text/javascript">
 $(document).ready(function(){ 
            $('#bannerImg').live('change', function(){ 
			$("#preview").html('<img src="../images/loader.gif" alt="Uploading...."/>');
			$('#banner').ajaxForm({
			complete: function(){
			window.location.reload();
			}
		}).submit();
	});
}); 
</script>

			<!--[if lt IE 9]>
		<script src="../media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="admin com_admin view-profile layout-edit task- itemid- " data-spy="scroll" data-target=".subhead" data-offset="87">
	<!-- Top Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
									<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
								<a class="brand" href="../" title="Launch Website" target="_blank">Launch Website <i class="icon-out-2 small"></i></a>
								<div class="nav-collapse">
<ul id="menu" class="nav ">
  <li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" href="#">Manage Document<span class="caret"></span></a>
  <ul class="dropdown-menu">
<!--<li><a  href="?p=importCsv1">Import CSV File For Certificates</a></li>-->
<!--<li><a  href="?p=loadsheetupload">Import CSV File For User</a></li>-->
<li><a  href="?p=loadsheetupload1">Import File (.XLSX )</a></li>
</ul>
</li>
								  </ul>
                                  
                                  
                                  <ul id="menu" class="nav ">
  <li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" href="#">Uploaded Document History<span class="caret"></span></a>
    <ul class="dropdown-menu">
<!--<li><a  href="?p=VoucherUploads">View Certificates Uploads</a></li>-->
<li><a  href="?p=UsersUploads">View Uploaded Files</a></li>
</ul>
</li>
								  </ul>
<!--<ul id="menu" class="nav ">
<li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" href="#">Users<span class="caret"></span></a>
  <ul class="dropdown-menu">
 <li><a  href="?p=manageUsers">Manage Users</a></li></ul>
</li>
								  </ul>-->
                                  
                                  <ul id="menu" class="nav ">
<li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" href="">View Certificates <span class="caret"></span></a>


 <ul class="dropdown-menu">
 
  <li><a  href="?p=show2">Show Assigned Certificates</a></li>
  <li><a  href="?p=showUsedvoch">Show Used Certificates</a></li>
  <!--<li><a  href="?p=showUnAssigned">Show UnAssigned Certificates</a></li>-->
 </ul>
 
 <!--<ul class="dropdown-menu">
 <li><a  href="?p=show2">Show Vouchers</a></li></ul>

</li>-->
			</ul>
            <!-------Users-------->
            <ul id="menu" class="nav ">
<li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" href="">Manage Users <span class="caret"></span></a>


 <ul class="dropdown-menu">
 
  <li><a  href="?p=viewuser">View All Users</a></li>
 <!-- <li><a  href="?p=userNOmail">Users Received Email</a></li>
  <li><a  href="?p=usermail">Users Not Received Email</a></li>-->
 </ul>
 
 <!--<ul class="dropdown-menu">
 <li><a  href="?p=show2">Show Vouchers</a></li></ul>

</li>-->
			</ul>
            
            
            <!-------end-------->
                <!-------job-------->
            <ul id="menu" class="nav ">
<li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" href="">Jobs<span class="caret"></span></a>


 <ul class="dropdown-menu">
 
  <li><a  href="?p=job">View All jobs</a></li>
 
 </ul>
 
 
                 <!-------job-------->

 
 <!--<ul class="dropdown-menu">
 <li><a  href="?p=show2">Show Vouchers</a></li></ul>

</li>-->
			</ul>
                        <ul id="menu" class="nav ">
<li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" href="">eVoucher<span class="caret"></span></a>


 <ul class="dropdown-menu">
 
  <li><a  href="?p=manageEVoucher">Manage eVoucher</a></li>
 
 </ul>
 </ul>
            
            <!-------end-------->
            
            
                       <!-------Email attechted-------->
            <ul id="menu" class="nav ">
<li class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" href="">Manage Email<span class="caret"></span></a>


 <ul class="dropdown-menu">
 
  <li><a  href="?p=viewmail">View All Email</a></li>
  <li><a  href="?p=addmail">Add New email</a></li>
 
 </ul>
 
 <!--<ul class="dropdown-menu">
 <li><a  href="?p=show2">Show Vouchers</a></li></ul>

</li>-->
			</ul>
            
            
            <!-------end-------->
            
            
            
            
            
            
            
            
<ul class="nav pull-right">
<li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class=""><a href="?p=EditAccount">Edit Account</a></li>
								<li class="divider"></li>
								<li class=""><a href="?p=logout">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
	</nav>
	<!-- Header -->
		<header class="header">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="">
					<a class="logo" href=""><img src="../images/logo.png" width="200px" height="100px" alt="Logo" /></a>
                    <a class="logo" href=""><img src="../images/logo2.png" width="200px" height="100px" alt="Logo" /></a>
			  </div>
              
				<div class="span10">
				</div>
			</div>
		</div>
	</header>
				<div style="margin-bottom: 20px"></div>
                
                		<!-- container-fluid -->
	<div class="container-fluid container-main">
		<section id="content">
			<!-- Begin Content -->
			
			<div class="row-fluid">
									<div class="span12">
										
<div id="system-message-container">
</div>
												<div class="row-fluid">
	<!--<div class="span2">
		<div class="sidebar-nav">&nbsp;</div>
	</div>-->
    <div class="span6">