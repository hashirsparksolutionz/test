<?php

class authorize_gateway {

	var $my_trans_id;
	var $product_name;
	var $amount_now;
	var $pay_auth_only;
	var $name_on_card;
	var $card_number;
	var $card_validity;
	var $card_verification_code;
	var $use_sub;
	var $my_ref_id;
	var $sub_name;
	var $sub_length;
	var $sub_unit;
	var $sub_start_date;
	var $sub_total_occurances;
	var $sub_trial_occurances;
	var $sub_amount;
	var $sub_trial_amount;
	var $my_invoice_no;
	var $street;
	var $state;
	var $city;
	var $zip;
	var $fname;
	var $lname;
	var $vars_list_string='my_trans_id,product_name,amount_now,street,state,city,zip,pay_auth_only,name_on_card,card_number,card_validity,card_verification_code,use_sub,my_ref_id,fname,lname,sub_name,sub_length,sub_unit,sub_start_date,sub_total_occurances,sub_trial_occurances,sub_amount,sub_trial_amount,my_invoice_no';

	
	// gateway related details
	var $pay_now_response_string;
	var $pay_now_response_status;
	
	var $sub_reponse_string;
	var $sub_reponse_status;
	
	var $test_mode;

	// for test location
	var $gateway_api_login_test='';
	var $gateway_api_key_test='';

	// for live location
	var $gateway_api_login_live='';
	var $gateway_api_key_live='';
	
	var $final_status;
	var $final_response;
	
	var $card_year;
	var $card_month;
	

	
function authorize_gateway()
	{
		require_once("authorizenet.class.php");
		require_once("AuthnetARB.class.php");
		
		// initialize all the post vars
		$vars_list_array=explode(",",$this->vars_list_string);
		foreach($vars_list_array as $var_name)
		{
			$this->$var_name=$_POST[$var_name];
		}
		
		// split the name on card into first name and last name
		$names_array=explode(" ",$this->name_on_card);
		if (count($names_array)==1)
		{
			$this->fname=$names_array[0];
			$this->lname='';
		}
		elseif(count($names_array)>1)
		{
			$lname_index=count($names_array)-1;
			$this->lname=$names_array[$lname_index];
			$my_aray=array_pop($names_array);
			$this->fname=implode(" ",$names_array);
		}
		else 
		{
			$this->fname="";
			$this->lname="";
		}
		
		// get year and month of the card
		$this->card_year=substr($this->card_validity,2,2);
		$this->card_month=substr($this->card_validity,0,2);
		
	}
 
function pay_now()
	{
		$a = new authorizenet_class;
		
		if ($this->test_mode == "Y")
			{
				$a->add_field('x_login', $this->gateway_api_login_test);
				$a->add_field('x_tran_key', $this->gateway_api_key_test);
				$a->gateway_url='https://test.authorize.net/gateway/transact.dll';
			}
		else 
			{
				$a->add_field('x_login', $this->gateway_api_login_live);
				$a->add_field('x_tran_key', $this->gateway_api_key_live);
			}
		
		//$a->add_field('x_password', 'CHANGE THIS TO YOUR PASSWORD');
		$a->add_field('x_version', '3.1');
		if ($this->pay_auth_only == "Y")
			{
				$a->add_field('x_type', 'AUTH_ONLY');
			}
		else
			{
				$a->add_field('x_type', 'AUTH_CAPTURE');
			}
			 
		if ($this->test_mode == "Y")
			{
				$a->add_field('x_test_request', 'TRUE');    // Just a test transaction
			}
			
		$a->add_field('x_relay_response', 'FALSE');
		
		$a->add_field('x_delim_data', 'TRUE');
		$a->add_field('x_delim_char', '|');     
		$a->add_field('x_encap_char', '');
		
		
		// Setup fields for customer information.  This would typically come from an
		// array of POST values froma secure HTTPS form.
		
		$a->add_field('x_first_name', $this->fname);
		$a->add_field('x_last_name', $this->lname);
		$a->add_field('x_address', $this->street);
		$a->add_field('x_city', $this->city);
		$a->add_field('x_state', $this->state);
		$a->add_field('x_zip', $this->zip);
		//$a->add_field('x_country', 'US');
		$a->add_field('x_email', $this->email);
		//$a->add_field('x_phone', '555-555-5555');

		$a->add_field('x_invoice_num', $this->my_invoice_no);
		
		//  Setup fields for payment information
		$a->add_field('x_method', 'CC');
		$a->add_field('x_card_num', $this->card_number);  // test successful visa
		//$a->add_field('x_card_num', $this->card_number);  // test successful american express
		//$a->add_field('x_card_num', $this->card_number);  // test successful discover
		//$a->add_field('x_card_num', $this->card_number);  // test successful mastercard
		// $a->add_field('x_card_num', '4222222222222');    // test failure card number
		$a->add_field('x_amount', $this->amount_now);
		$a->add_field('x_exp_date', $this->card_validity);    // march of 2008
		$a->add_field('x_card_code', $this->card_verification_code);    // Card CAVV Security code
		
		// Process the payment and output the results
		switch ($a->process()) {
		
		   case 1:  // Successs
		      //echo "<b>Success:</b><br>";
		      //echo $a->get_response_reason_text();
		      //echo "<br><br>Details of the transaction are shown below...<br><br>";
		      
		      $this->pay_now_response_status = true;
		      
		      $this->pay_now_response_string = "Payment / Authorization Successful - Transaction ID:". $a->response['Transaction ID'];
			  
			  //$this->pay_now_response_string = "Payment / Authorization Successful";		      
		   	  //print_r($a);
		      break;
		      
		   case 2:  // Declined
		      echo "<div align='right'><a href='javascript:history.go(-1)' style='text-decoration: none;'>« Go Back </a></div><div class='shape-featured'><div class='text-haead'>Payment Declined:</div></div>";
		      //echo $a->get_response_reason_text();
		      //echo "<br><br>Details of the transaction are shown below...<br><br>";
		      $this->pay_now_response_status = false;
		      $this->pay_now_response_string = $a->get_response_reason_text();
		      break;
		      
		   case 3:  // Error
		   	  echo "<div align='right'><a href='javascript:history.go(-1)' style='text-decoration: none;'>« Go Back </a></div><div class='shape-featured'><div class='text-haead'>Error With Transaction:</div></div>";
		      //echo $a->get_response_reason_text();
		      //echo "<br><br>Details of the transaction are shown below...<br><br>";
		      $this->pay_now_response_status = false;
		      $this->pay_now_response_string = $a->get_response_reason_text();
		      break;
		}		

		
	}
	
function pay_sub()
{
	if ($this->test_mode == "Y")
			{
				$login=$this->gateway_api_login_test;
				$transkey=$this->gateway_api_key_test;
				$test = TRUE;
			}
	else 
			{
				$login=$this->gateway_api_login_live;
				$transkey=$this->gateway_api_key_live;
				$test = FALSE;
			}
	
	 $arb = new AuthnetARB($login, $transkey, $test);

  $arb->setParameter('interval_length', $this->sub_length);
  $arb->setParameter('interval_unit', $this->sub_unit);
  $arb->setParameter('startDate', $this->sub_start_date);
  $arb->setParameter('totalOccurrences', $this->sub_total_occurances);
  $arb->setParameter('trialOccurrences', $this->sub_trial_occurances);
  $arb->setParameter('trialAmount', $this->sub_trial_amount);

  $arb->setParameter('amount', $this->sub_amount);
  $arb->setParameter('refId', $this->my_ref_id);
  $arb->setParameter('cardNumber', $this->card_number);
  $card_valid="20".$this->card_year."-".$this->card_month;
  $arb->setParameter('expirationDate', $card_valid);

  $arb->setParameter('firstName', $this->fname);
  $arb->setParameter('lastName', $this->lname);
//  $arb->setParameter('address', 'Casa 1872');
//  $arb->setParameter('city', 'City');
//  $arb->setParameter('state', 'FL');
//  $arb->setParameter('zip', '33619');
//  $arb->setParameter('country', 'us');
  $arb->setParameter('email', $this->email);

  $arb->setParameter('subscrName', $this->sub_name);
  $arb->createAccount();

 // echo 'isSuccessful: ' .$arb->isSuccessful() . '<br />';

  if ($arb->isSuccessful()) {
   // echo 'cool, it worked! <br />';
   $this->sub_reponse_status = true;
   $this->sub_reponse_string = "Subscription Successful with ID : " . $arb->getSubscriberID();
   
   
  } else {
    //echo 'error in payment <br />';
    
   $this->sub_reponse_status = false;
   $this->sub_reponse_string = "Subscription Failed because of the reason below : <br>" . $arb->getResponse();

    
	//echo 'isError: ' .$arb->isError() . '<br />';
	//echo 'getSubscriberID: ' .$arb->getSubscriberID() . '<br />';
	//echo 'getResponse: ' .$arb->getResponse() . '<br />';
	//echo 'getResultCode:' .$arb->getResultCode() . '<br />';
	//echo 'getString: ' .$arb->getString() . '<br />';
	//echo 'getRawResponse: ' .$arb->getRawResponse() . '<br />';
    
    
  }
}

	
	
function process_now()
{
	
		$this->pay_now();
		if (!$this->pay_now_response_status)
		{
			$this->final_status = false;
			$this->final_response = "<h3 style='text-align: center;'>There Is An Error In Processing Your Transaction, Details Are :</h3>" . $this->pay_now_response_string;
		}
		else 
		{
			$this->final_status = true;
			$this->final_response = $this->pay_now_response_string;
			
						 
			// now check if there was subscription request anywhere.
			if ($this->use_sub == "Y")
			{
				// run the subscription routines also.
				$this->pay_sub();
			}
			
			if (!$this->sub_reponse_status)
			{
				$this->final_status = false;
				$this->final_response = $this->final_response."<br>" . $this->sub_reponse_string;
			}
			else 
			{
				$this->final_status = true;
				$this->final_response = $this->final_response."<br>" . $this->sub_reponse_string;
			}
		}
		return $this->final_response;
}
	 
}

