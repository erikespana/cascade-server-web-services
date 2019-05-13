<pre>
<?php

include ("../connection-dev.php");

$site = 'TDI';
$path = 'commissioner/legal/disciplinary-orders';

$identifier = array(
	'path' => array('path' => $path, 'siteName' => $site ),
	'type' => 'page'
);
$readParams = array ('authentication' => $auth, 'identifier' => $identifier);
$reply = $client->read($readParams);
	
if ($reply->readReturn->success=='true') {

	// get page object
	$page = $reply->readReturn->asset->page;
} else
	echo "Error occurred: " . $reply->readReturn->message;
	
print_r( $page );
?>
</pre>
