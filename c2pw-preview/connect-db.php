<?php

$alamat = $_SERVER['SERVER_NAME'];
if ( $alamat == 'www.npl-net.com' ) {
	// server info
	$server = '10.1.49.16';
	$user = 'nplnet';
	$pass = 'nplnet01';
	$db = 'smsc';
} else {
	// server testing
	$server = '10.1.49.8';
	$user = 'nplnet';
	$pass = 'nplnet01';
	$db = 'smsc'; 
}	
// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);

// show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);

?>
