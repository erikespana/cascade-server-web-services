<?php
/* Creates a copy of the current content type
    and assigns it to a copy of the current configuration set.
*/
ini_set('display_errors', "On");
error_reporting( E_ALL );

// Content Types/Offices/Contact Information
$contentTypeId = "fa18384c956aa07801f685724c863479";
// Configuration Sets/offices/Contact Information
$oldConfigSetId = "0d188e17956aa0780099ee0bb9e58b30";
$fileExtension = " - Clone";

require_once('auth_ns_espanae_cascade.php');
use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

echo "<h1>Clone Content Type</h1>";
try
{
    // Get the current content type
    $oldCt  = $cascade->getAsset( a\ContentType::TYPE, $contentTypeId );

    // Copy the current content type (passing the parent container and content type's name)
    $newCt = $oldCt->
        copy($oldCt->getParentContainer(), $oldCt->getName().$fileExtension);
    echo "<p>Copied content type ID ". $contentTypeId ."</p>"; 

    // Step 3: Get a similar configuration set
    $oldCSet = $cascade->getAsset( a\PageConfigurationSet::TYPE, $oldConfigSetId );
    
    // Step 4: Copy the configuration set
    $newCSet = $oldCSet->copy($oldCSet->getParentContainer(), $newCt->getName() );
    echo "<p>Copied configuration set ID ". $oldConfigSetId ."</p>"; 

    // Step 5: Assign the new configuration set to the new content type
    // sets pageConfigurationSetId and pageConfigurationSetPath, and returns the object.
    $newCt->setPageConfigurationSet( $newCSet )->edit();
    echo "<p>Linked the new content type to the new configuration set.</p>";
    echo "<p>New content type ID: " . $newCt->getId() . "</p>";

    // Display information about the new content type
    //$newCt->display();
    
    // Data definition stuff (old)
    //echo "\$old Data Definition ID: " . $oldDDId;
    
    //$ct->setDataDefinition( $newDataDefinitionId )->edit();
    /*
    $ct->setDataDefinition(
        $cascade->getAsset( a\DataDefinition::TYPE, $newDataDefinitionId )
        )->edit();
    */
    // Step 4: Display the currently assigned data definition
    //$newDDId = $ct->getDataDefinitionId();
    //echo "\$newDDId: " . $newDDId;
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>
