<?php
/* Creates a copy of the current content type
    and assigns it to a copy of the current configuration set.
*/

// Content Types/Human Resources/Job Posting - Faculty
$contentTypeId = "0734f49e956aa0520099d297d878c8a5";
// reboot:/Configuration Sets/Bootstrap/Office subpage - Becker Events
$oldConfigSetId = "8144ed8a956aa0787c5eb17eb5e2e7e9";
$fileExtension = " - Bootstrap";
ini_set('display_errors', "On");
error_reporting( E_ALL );

require_once('auth_ns_espanae_cascade.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    // Get the current content type
    $oldCt  = $cascade->getAsset( a\ContentType::TYPE, $contentTypeId );

    // Copy the current content type (passing the parent container and content type's name)
    $newCt = $oldCt->
        copy($oldCt->getParentContainer(), $oldCt->getName().$fileExtension);
    //$newCt->display();
    

    // Step 3: Get a similar configuration set
    $oldCSet = $cascade->getAsset( a\PageConfigurationSet::TYPE, $oldConfigSetId );
    
    // Step 4: Copy the configuration set
    $newCSet = $oldCSet->
        copy($oldCSet->getParentContainer(), $newCt->getName() );


    // Step 5: Assign the new configuration set to the new content type
    // sets pageConfigurationSetId and pageConfigurationSetPath, and returns the object.
    $newCt->setPageConfigurationSet( $newCSet )->edit();
    $newCt->display();
    //echo "\$old Data Definition ID: " . $oldDDId;
    //echo "<p>" . $newCt->getId(). "</p>\n";



    
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