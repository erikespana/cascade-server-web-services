<?php 
$sourceFolder = "7ea4de81956aa078018c26d71019c758";	// /admissions/school-counselor
$contentType = "9fb82b39956aa0783236eb66c57479a3";   // Content Types/Bootstrap/Standard Bootstrap

// cascade web services library

require_once('cascade_ws_ns/auth_chanw.php');
//require_once('auth_ns_espanae_cascade.php');
use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$newContentType = $cascade->getAsset( a\ContentType::TYPE, $contentType);

try
{

	//echo "<table>\n<tr><td>Page</td><td>Old Content Type</td><td>New Content Type</td></tr>";

	// Get the target folder
	$cascade->getAsset( a\Page::TYPE, "800982df956aa07800f45ec3e59e9b3d")->edit();
    //$cascade->getAsset( a\Folder::TYPE, $sourceFolder)->
    /*$child = new p\Child( $service->createId( a\Page::TYPE, "800982df956aa07800f45ec3e59e9b3d" ) );
                changeContentType( 
                    $service, $child, NULL );*/
		// Get the asset tree
	/*	getAssetTree()->

			// Traverse the asset tree
			traverse(
				array(
					// for each Page, apply changeContentType() to the Page
					a\Page::TYPE =>	array( "changeContentType")
				)
			);

	echo "</table>\n";*/

}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}

// For each page, display its path and associated Content Type
function changeContentType(
	aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
    {
    	
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
        $page->setContentType( $GLOBALS[ 'newContentType' ], true )->edit();
    	
    }
function submitPage(
	aohs\AssetOperationHandlerService $service, 
    p\Child $child, $params=NULL, &$results=NULL )
    {
    	
        // submit page (and remove phantom nodes)
        $page = $child->getAsset( $service );
        $page->edit();
        // Recheck the page's current content type
        echo "<td>". $page->getContentTypeId() ."</td>\n";
    	echo "</tr>\n";
	}    	
?>