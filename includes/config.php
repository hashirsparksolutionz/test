<?php

	$p	=	$_GET['p'];
	$includepage	= 'contents/home.php';
	
	if($_GET['p'])
	{ 
		$p = $_GET['p'];
	}
	else
	{
		$p = 'home';
	}
	

switch($p){
		case 'home':
		$includepage = 'contents/home.php';
		$title = 'Home';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'process':
		$includepage = 'firstData/PHP_FORM_MAX.php';
		$title = 'Home';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'AboutUs':
		$includepage = 'contents/AboutUs.php';
		$title = 'Home';
		$pagedescription = '';
		$pagekeywords =  '';
		break;


        case 'test1':
		$includepage = 'contents/test1.php';
		$title = 'test1';
		$pagedescription = '';
		$pagekeywords =  '';
		break;


		case 'Faq':
		$includepage = 'contents/Faq.php';
		$title = 'Home';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'forgot':
		$includepage = 'contents/forgot.php';
		$title = 'Forgot Password';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'Order':
		$includepage = 'contents/Order.php';
		$title = 'Forgot Password';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'Cart':
		$includepage = 'contents/Cart.php';
		$title = 'Home';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'Thankyou':
		$includepage = 'contents/Thankyou.php';
		$title = 'Home';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'PlaceOrder':
		$includepage = 'contents/PlaceOrder.php';
		$title = 'Home';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'aboutUs':
		$includepage = 'contents/aboutUs.php';
		$title = 'About Us';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'Products':
		$includepage = 'contents/Products.php';
		$title = 'Products';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'Login':
		$includepage = 'contents/Login.php';
		$title = 'Login';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'Register':
		$includepage = 'contents/Register.php';
		$title = 'Register';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'profile':
		$includepage = 'contents/profile.php';
		$title = 'Register';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		case 'TOS':
		$includepage = 'contents/TOS.php';
		$title = 'Register';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		case 'Logout':
		$includepage = 'contents/logout.php';
		$title = 'Register';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'ProductDetail':
		$includepage = 'contents/ProductDetail.php';
		$title = 'Register';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'forgetPass':
		$includepage = 'contents/forgetPass.php';
		$title = 'Forget Password';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'ConfirmCheckOut':
		$includepage = 'contents/ConfirmCheckOut.php';
		$title = 'Confirm CheckOut';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'payment':
		$includepage = 'contents/payment.php';
		$title = 'Payment';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'PaymentError':
		$includepage = 'contents/PaymentError.php';
		$title = 'Payment Error';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		case 'Confirmation':
		$includepage = 'contents/Confirmation.php';
		$title = 'Confirmation';
		$pagedescription = '';
		$pagekeywords =  '';
		break;
		
		default:
      	$includepage = 'contents/error.php';
		$title = 'Error: Sorry, the page you requested cannot be found.';
		$pagedescription = '';
		$pagekeywords =  '';
	   	break;
	}
?>