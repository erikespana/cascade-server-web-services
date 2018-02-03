<?php
include ("connection-prod.php");


$identifier = array
(
	'path' => array('path' => '/alert/event/index','siteName' => 'TDI'),
	//OR
	//'id' => '2f1292900a2295fe23f760ba81b91e9e',
	'type' => 'page'
);

$readParams = array ('authentication' => $auth, 'identifier' => $identifier);
$reply = $client->read($readParams);

if ($reply->readReturn->success=='true') {
	//print_r($reply->readReturn->asset->page->pageConfigurations);
	foreach ($reply->readReturn->asset->page->pageConfigurations as $pConfiguration) {
		print_r ($pConfiguration['name']);
/*
		if ($pConfiguration->name == "HTML")
			foreach ($pConfiguration->pageRegions->pageRegion as $region) {
				echo $region->name . "\n";
			}
			*/
		echo "\n";
	}

	//echo "Success. Block's xml: " . $reply->readReturn->asset->xmlBlock->xml;
} else
	echo "Error occurred: " . $reply->readReturn->message;
?>
