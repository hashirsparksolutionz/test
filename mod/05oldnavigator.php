<?php
$include_page	=	"dashbord.php";
if($_GET['p']){ 
	$p = $_GET['p'];
}else{
	$p = 'admin-home';
}

switch($p)
{

	case "dashboard":
	$include_page	=	'dashboard.php';
	break;

	case "test":
	$include_page	=	'manage/test.php';
	break;
	
	case "form":
	$include_page	=	'manage/form.php';
	break;
	
	
	case "check":
	$include_page	=	'manage/check.php';
	break;
	
	
	case "xlsx":
	$include_page	=	'manage/xlsx.php';
	break;
	
	
	case "show2":
	$include_page	=	'manage/show2.php';
	break;
	
	
	
	case "edit":
	$include_page	=	'manage/edit.php';
	break;
	
	
	
	case "EditAccount":
	$include_page	=	'mod/change_pass.php';
	break;
	
	
	case "updateAboutus":
	$include_page	=	'manage/products/up_ab.php';
	break;
	
	case "faq":
	$include_page	=	'manage/faq.php';
	break;
	
	
	case "ManageProducts":
	$include_page	=	'manage/products/manage_product.php';
	break;

	case 'importCsv':
	$include_page 	= 'manage/importCsv.php';
	break;
	
	
	case 'importCsv1':
	$include_page 	= 'manage/importCsv1.php';
	break;


	case "manageBanners":
	$include_page	=	'manage/bannerImages/manageBanners.php';
	break;
	
	case "export":
	$include_page	=	'manage/orders/export.php';
	break;
	
	case "ex":
	$include_page	=	'manage/orders/exx.php';
	break;
	
	case "bannerUploading":
	$include_page	=	'manage/bannerImages/bannerUploading.php';
	break;
	
	case "AddProduct":
	$include_page	=	'manage/products/add_product.php';
	break;
	
	case "check":
	$include_page	=	'manage/products/waqas.php';
	break;
	
	
	case "EditProducts":
	$include_page	=	'manage/products/edit_product.php';
	break;
	
	case "orders":
	$include_page	=	'manage/orders/orders.php';
	break;
	
	case "orders_a":
	$include_page	=	'manage/orders/order_a.php';
	break;
	
	case "orders_d":
	$include_page	=	'manage/orders/order_d.php';
	break;
	
	case "download":
	$include_page	=	'manage/orders/download.php';
	break;
	
	case "manageUsers":
	$include_page	=	'manage/users/manageUsers.php';
	break;
	
	case "TermsOfUse":
	$include_page	=	'manage/TermsOfUse.php';
	break;
	
	case "logout":
	$include_page	=	'mod/logout.php';
	break;

	default:
	$include_page	=	'dashboard.php';
	$title = 'Error: We are sorry, the page you requested cannot be found.';
	break;
}
?>