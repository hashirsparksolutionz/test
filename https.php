<?php
///////////////////////////////////////////// WEBSITE WILL ALWAYS FORCEFULLY RUN ON HTTPS  /////////////////////////////
if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on")
{  
	$url=$_SERVER["HTTP_HOST"];
	$url2=str_replace("www.","",$url);
	
   header(str_replace("www.","","Location: https://".$url2.$_SERVER["REQUEST_URI"]));

    exit();
}
///////////////////////////////////////////// WEBSITE WILL ALWAYS FORCEFULLY RUN ON HTTPS  /////////////////////////////
?>