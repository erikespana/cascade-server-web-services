<?php
// Original library
//require_once('/Applications/MAMP/htdocs/cascade/auth_espanae.php'); // prod instance

// Namespace version of library
//require_once('/Applications/MAMP/htdocs/cascade/auth_ns_espanae_cascade.php'); // prod instance
require_once('/Applications/MAMP/htdocs/cascade/auth_ns_espanae_oceania.php'); // test instance


// Use reboot:/_scripts folder for testing
//$folderID = '68250e75956aa078003f6ca45ac13246';

// Use /news/images/homepage/ folder for testing
$folderID = '3a06b928956aa05200c85bbb843d7299';

$results = array();

Asset::getAsset( 
    $service, Folder::TYPE, $folderID )->
    getAssetTree()->
    traverse( 
        array( File::TYPE => array( F::REPORT_ORPHANS ) ), 
        NULL, 
        $results );
        

if( count( $results[ F::REPORT_ORPHANS ] ) > 0 )
{
    //echo S_UL;
    print_r( $results );
} else {
    echo "<p>else</p>\n";
}
?>
