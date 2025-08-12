<?php
date_default_timezone_set('America/Bogota');

$script_tz = date_default_timezone_get();

if(strcmp($script_tz, ini_get('date.timezone'))){
	$hoy = date("Y-m-d H:i:s"); 
    print_r($hoy);
}
else{
$hoy = date("Y-m-d H:i:s"); 
print_r($hoy);
}
?>