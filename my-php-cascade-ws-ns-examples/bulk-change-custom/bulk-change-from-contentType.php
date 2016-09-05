<?php $start_time = time();

/* Migrate pages, related to a content type, and converts them to a new content type. */

// Settings

$contentTypeSource = "0734f49e956aa0520099d297d878c8a5";        // Content Types/Human Resources/Job Posting - Faculty
$contentTypeDestination = "e713ed19956aa0780f3cae57fcc69e24";   // Content Types/Human Resources/Job Posting - Faculty - Bootstrap

// Flags

$submit                     = false;     // get rid of phantom nodes
$changebannerBankComponent  = false;    // Remove the page's banner bank
$changeColumnLayout         = false;    // Change columnWidth to 'wide'
$changeContentType          = false;
$publishPages               = false;    // publish each page (requires $changeContentType = true)
$publishSubscribers         = true;     // publish each page


$destinationId = "c4a73b71956aa0520003c37ef4b29f37"; // "WWW" destination

// Data definition field: header/bannerBankComponent
$ddField = "header;bannerBankComponent";

// Metadata
$dynField = "columnLayout";
$dynValue = "Wide";

// Web Services

require_once('auth_ns_espanae_cascade.php');
use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

// Get pages related to old content type

$ct = $cascade->getAsset( a\ContentType::TYPE, $contentTypeSource ); // get source content type
echo "<pre>".$ct->getPath() . ":</pre>\n";                          // display the content type's path
$pages = $ct->getSubscribers();                                     // get related pages

// And reassign them to the new content type

$newContentType = $cascade->getAsset( a\ContentType::TYPE, $contentTypeDestination );

// Traverse related pages

echo "<ol>\n";
foreach ($pages as $page) {
    ini_set('max_execution_time', 300); //300 seconds = 5 minutes
    
    try {
        echo "<li>";
        // Get the next page to be processed
        $p  = $page->getAsset( $service );
        
        // Check if it's a page
        if ($p->getType() == "page") {

            // submit changes and remove any phantom nodes
            //if ($submit) $p->edit(); // doesn't work

            // remove the page's banner bank
            if ($changebannerBankComponent) {
            
                // check if the page is associated with a data definition
                if ( $p->hasStructuredData() ) {
                
                    //$StructuredData = $p->getStructuredData()->getStructuredDataNode( $ddField );
                    //var_dump( $p->getStructuredData()->getIdentifiers() );
                    
                    // check the id of the banner bank attached to the page's data definition
                    // upstate.edu/cascade-admin/web-services/api/asset-classes/data-definition.php
                    $node = $p->getStructuredData()->getStructuredDataNode( $ddField );
                    if ( $node->getAssetType() == a\Page::TYPE ) {
                        //echo "Page ID: " . $node->getPageId() . BR .
                        //      "Page path: " . $node->getPagePath() . BR;

                        // if it's attached...
                        if ($node->getPagePath() == "_Site Support/Banks/Banners/Becker Bank") {
                            // detach it.
                            $p->setPage( $ddField, NULL )->edit();
                            echo $p->getPath() . ": detached $ddField";
                        }
                    } else
                        echo $p->getPath() . ": " . $node->getAssetType();
                }
            } // if ($changebannerBankComponent)


            // Change columnWidth to 'wide'

            if ($changeColumnLayout) {
                $p->getMetadata()->setDynamicFieldValue($dynField, $dynValue);
                $p->edit();
                //var_dump( $p->getMetadata()->getDynamicFieldValues( $dynField ) );
            }

            // Assign new content type to page

            if ($changeContentType) {
                /*
                    Assumes old and new content types are associated with the same data definition.
                    http://www.upstate.edu/cascade-admin/projects/web-services/oop/classes/asset-classes/page.php
                */
                $p->setContentType( $newContentType, true )->edit();
                // echo "\$p->setContentType($contentTypeDestination, true)->edit();\n"; // debugging

                // Recheck the page's current content type
                echo $p->getPath() . "; content Type <- " . $p->getContentTypeId();
            } // if ($changeColumnLayout)

            // Publish the page

            if ($publishPages) {
                if ( $p->isPublishable() )
                    $www  = $cascade->getAsset( a\Destination::TYPE, $destinationId );
                    $p->publish($www);
                    //$service->publish( $page->toStdClass() );
                echo "; publishing";
            }

        } else {
            echo "Not a page.";
        } // if ( $p->getType() == "page" )
        echo "</li>\n";


    } catch( \Exception $e ) {
        echo S_PRE . $e . E_PRE;
    } // try

} // foreach

if ($publishSubscribers) {
    $www  = $cascade->getAsset( a\Destination::TYPE, $destinationId );
    $newContentType->publishSubscribers( $www );
}

echo "</ol>\n";
$end_time = time();
echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n"; 
?>