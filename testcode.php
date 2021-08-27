<?php 

for ($i = 1; $i <= 12; $i++) {
    $months[] = date("Y-m%", strtotime( date( 'Y-m-01' )." -$i months"));
}

echo "<pre>";
print_r($months);
echo "</pre>";
	 
	 
?>