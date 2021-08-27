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

	case "demo_loadsheetupload":
	$include_page	=	'manage/demo_loadsheetupload.php';
	break;
	
	case "form":
	$include_page	=	'manage/form.php';
	break;
	case "form":
	$include_page	=	'manage/Thankyou.php';
	break;
	
	case "check":
	$include_page	=	'manage/check.php';
	break;
	
	
	case "manageEVoucher":
	$include_page	=	'manage/newsletter.php';
	break;
	
	case "loadsheetuploadw":
	$include_page	=	'manage/loadsheetuploadw.php';
	break;
	
	
	case "xlsx":
	$include_page	=	'manage/xlsx.php';
	break;
	
		case "adduser":
	$include_page	=	'manage/adduser.php';
	break;
		case "edituser2":
	$include_page	=	'manage/users/edituser2.php';
	break;
	
	case "viewuser2":
	$include_page	=	'manage/viewuser2.php';
	break;
	
	
	case "show2":
	$include_page	=	'manage/show2.php';
	break;
	
	case "job":
	$include_page	=	'manage/job.php';
	break;
	case "addjob":
	$include_page	=	'manage/addjob.php';
	break;
	
		case "jobCerti":
	$include_page	=	'manage/jobCerti.php';
	break;
	
	
	case "edit":
	$include_page	=	'manage/edit.php';
	break;
	
	case "VoucherUploads":
	$include_page	=	'manage/uploads/show.php';
	break;
	
	case "UsersUploads":
	$include_page	=	'manage/uploads/show12.php';
	break;
	
	case "view":
	$include_page	=	'manage/uploads/view.php';
	break;
	
	case "userview":
	$include_page	=	'manage/uploads/userview.php';
	break;
	
	case "viewuser":
	$include_page	=	'manage/users/viewuser.php';
	break;
	case "userNOmail":
	$include_page	=	'manage/users/userNOmail.php';
	break;
	
	case "viewmail":
	$include_page	=	'manage/mailsystem/viewmail.php';
	break;
	
	case "addmail":
	$include_page	=	'manage/mailsystem/addmail.php';
	break;
	
	case "eidtmail":
	$include_page	=	'manage/mailsystem/eidtmail.php';
	break;
	
	case "edituser":
	$include_page	=	'manage/users/edituser.php';
	break;
	case "usermail":
	$include_page	=	'manage/users/usermail.php';
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
	
	case "ManageProductsPages":
	$include_page	=	'manage/products/productpages.php';
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

	case 'loadsheetupload':
	$include_page 	= 'manage/loadsheetupload.php';
	break;
	
	case 'loadsheetupload1':
	$include_page 	= 'manage/loadsheetupload1.php';
	break;
	case 'loadsheetupload2':
	$include_page 	= 'manage/loadsheetupload2.php';
	break;
	
	case 'showUnAssigned':
	$include_page 	= 'manage/showUnAssigned.php';
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
	case "archOrder":
	$include_page	=	'manage/orders/archOrder.php';
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
	
	case "showUsedvoch":
	$include_page	=	'manage/showUsedvoch.php';
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