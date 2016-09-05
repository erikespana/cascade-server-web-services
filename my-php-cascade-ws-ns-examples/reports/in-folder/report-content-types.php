<?php 
$sourceFolder = "7ea4de81956aa078018c26d71019c758";	// /admissions/school-counselor
$url = "http://cascade.union.edu:8080/entity/open.act?type=page&id=";



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
	echo "<table>\n<tr><td>Page</td><td>Content Type</td></tr>";

	// Get the target folder
	$cascade->getAsset( a\Folder::TYPE, $sourceFolder)->

		// Traverse the asset tree
		getAssetTree()->traverse(
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
        // Get the next page to be processed
        $page = $child->getAsset( $service );
        
        echo "<tr>\n";
		// get the full Page asset
    	echo "<td><a href='" . $GLOBALS['url'] . $child->getId(). "'>".$child->getPathPath() . "</a></td>\n<td>"
    		 . $page->getContentTypePath() . "</td>\n";

    	echo "</tr>\n";
    }
?>