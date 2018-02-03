<?php
include ("connection-prod.php");
include ("function-edit.php");

// Settings
// Content Type source
   $idContentType = "ec1048990a2295fe671af70c1e6123a6"; // Portal Page
// $idContentType = "eaae46540a2295fe23f760ba9dd839fb"; // Take Five Posts

// new value to set to
//$newValue = 'nomenu';
$newValue = 'wide';

// Get content type relationships

$identifier = array
(		// Content Types/Take Five Post
	'id' => $idContentType, 'type' => 'contenttype'
);
$listSubscribersParams = array ('authentication' => $auth, 'identifier' => $identifier);
$reply = $client->listSubscribers($listSubscribersParams);

/* If got content type relationships */

if ($reply->listSubscribersReturn->success=='true')
{
	$subscribers = $reply->listSubscribersReturn->subscribers->assetIdentifier;
	echo "Subscribers: (" . count($subscribers) . ")\r\n";
	if (sizeof($subscribers)==0)
	{
		echo "NONE\r\n"; exit;
	}
	else if (!is_array($subscribers)) // For less than 2 elements, the returned object isn't an array
		$subscribers = array($subscribers);

	foreach($subscribers as $subscriber) {
		//echo print_r($subscriber) . "\n\n";
		// read status
		echo "[" . $subscriber->type . "] site://"
			. $subscriber->path->siteName
			. "/"
			. $subscriber->path->path
			. "\r\n";

		// edit
		$identifier = array	(
		    //'path' => array('path' => $path,'siteName' => $subscriber->path->siteName),
		    // or
				'id' => $subscriber->id,
		    'type' => $subscriber->type
		);

		edit( $auth, $identifier, $client, $newValue);

		echo "-\r\n";

	}
}
else
	echo "Error occurred: " . $reply->listSubscribersReturn->message;
?>
