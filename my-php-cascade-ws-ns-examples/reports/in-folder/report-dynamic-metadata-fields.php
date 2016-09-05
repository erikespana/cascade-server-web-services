<?php 
$sourceFolder = "7ea4de81956aa078018c26d71019c758";	// /admissions/school-counselor

// cascade web services library

require_once('cascade_ws_ns/auth_chanw.php');
use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;


try
{
	// Get the target folder
	$cascade->getAsset( a\Folder::TYPE, $sourceFolder)->

		// Get the asset tree
		getAssetTree()->

			// Traverse the asset tree
			traverse(
				array(
					// select all Page assets
					a\Page::TYPE =>
					// for each Page, apply processPage() to the Page
					array( "processPage")
				)
			);

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}

// For each page, print the value of a particular dynamic metadata field
function processPage(
	aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
    {
        // Get the next page to be processed
        $page = $child->getAsset( $service );
        
        // name of dynamic metadata field
    	$dynField = "columnLayout";

    	var_dump( $page->getMetadata()->getDynamicFieldValues( $dynField ) );
    }
?>