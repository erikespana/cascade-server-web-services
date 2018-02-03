<?php
include ("connection-dev.php");

$identifier = array
(
		// Content Types/Take Five Post
	'id' => 'eaae46540a2295fe23f760ba9dd839fb',
	'type' => 'contenttype'
);

$listSubscribersParams = array ('authentication' => $auth, 'identifier' => $identifier);
$reply = $client->listSubscribers($listSubscribersParams);

if ($reply->listSubscribersReturn->success=='true')
{
	echo "Subscribers:\r\n";
	$subscribers = $reply->listSubscribersReturn->subscribers->assetIdentifier;
	if (sizeof($subscribers)==0)
	{
		echo "NONE\r\n";
		exit;
	}
	else if (!is_array($subscribers)) // For less than 2 elements, the returned object isn't an array
		$subscribers=array($subscribers);

	foreach($subscribers as $identifier) {
		echo print_r($identifier) . "\n\n";
/*
		echo "[" . $identifier->type . "] site://"
			. $identifier->path->siteName
			. "/"
			. $identifier->path->path
			. "\r\n";
		*/
	}
}
else
	echo "Error occurred: " . $reply->listSubscribersReturn->message;
?>
