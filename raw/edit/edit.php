<?php
include ("connection-dev.php");
include ("function-edit.php");

// Settings

$path = '/takefive/boatinsurance';
$site = 'TDI';
$newValue = 'wide';


// Set target asset

$identifier = array
(
    'path' => array('path' => $path,'siteName' => $site),
    // or 'id' => '2f1292900a2295fe23f760ba81b91e9e',
    'type' => 'page'
);


edit( $auth, $identifier, $client, $newValue);


?>
