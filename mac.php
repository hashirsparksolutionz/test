<?php
ob_start(); 
system("ipconfig /all"); 
 $cominfo=ob_get_contents(); 
ob_clean(); 
$search = "Physical";
$primarymac = strpos($cominfo, $search); 
$mac=substr($cominfo,($primarymac+36),17);//MAC Address
echo $mac."mac address";
echo "*************************************************************************"."<br>";
$server		=	$_SERVER['SERVER_ADDR'];
echo $server."<br>";
$remote	= $_SERVER['REMOTE_ADDR'];
echo $remote;
?>
<?php
$mac = system('arp -an');
echo $mac;
?>