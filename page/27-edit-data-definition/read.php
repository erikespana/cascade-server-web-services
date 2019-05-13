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
	
	print_r( $reply );
?>
</pre>
