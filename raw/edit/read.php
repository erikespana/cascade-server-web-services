<?php
include ("connection-dev.php");


$identifier = array
(
	'path' => array('path' => '/help/401-6','siteName' => 'TDI'),
	//OR
	//'id' => '2f1292900a2295fe23f760ba81b91e9e',
	'type' => 'page'
);

$readParams = array ('authentication' => $auth, 'identifier' => $identifier);
$reply = $client->read($readParams);

if ($reply->readReturn->success=='true') {
	//print_r($reply->readReturn->asset->page->metadata->dynamicFields->dynamicField[5]);
	print_r($reply->readReturn->asset->page->metadata);
	//echo "Success. Block's xml: " . $reply->readReturn->asset->xmlBlock->xml;
} else
	echo "Error occurred: " . $reply->readReturn->message;
?>
