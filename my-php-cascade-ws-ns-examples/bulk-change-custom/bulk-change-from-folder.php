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
	echo "<table>\n<tr><td>Page</td><td>Old Content Type</td><td>New Content Type</td></tr>";

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
	echo "</table>\n";

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}

// For each page, display its path and associated Content Type
function processPage(
	aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
    {
    	$contentType = "9fb82b39956aa0783236eb66c57479a3";   // Content Types/Bootstrap/Standard Bootstrap
    	$newContentType = $cascade->getAsset( a\ContentType::TYPE, $contentType );

        // Get the next page to be processed
        $page = $child->getAsset( $service );
    	
    	echo "<tr>\n";
		// get the full Page asset
    	echo "<td>" . $child->getPathPath() . "</td>\n<td>"
    		 . $page->getContentTypePath() . "</td>\n";
        /*
            Assumes old and new content types are associated with the same data definition.
            http://www.upstate.edu/cascade-admin/projects/web-services/oop/classes/asset-classes/page.php
        */
        $page->setContentType( $newContentType, true )->edit();

        // Recheck the page's current content type
        echo "<td>". $page->getContentTypeId() ."</td>\n";
    	echo "</tr>\n";
    }
?>