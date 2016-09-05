<?php
//require_once('auth_ns_espanae_cascade.php');
require_once('auth_ns_espanae_oceania.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

echo S_PRE;

// Assign this content type
// reboot/Content Types/Bootstrap/Standard Bootstrap - Office subpages
$newContentTypeId = "04dd5144956aa07820d97acda6b3c0f1";
// reboot/Content Types/Bootstrap/Magazine
//$newContentTypeId = "190bccb0956aa0780cb659a31cc913e5";

// (get Content Type object)
$newContentType =
    $cascade->getAsset( a\ContentType::TYPE, $newContentTypeId );

// to these pages:
$page_ids = array(
    "07c1fb77956aa0520018ab9417770e90" // 2011 fall
    //"fdc37535956aa07800e6ace73718c2ed" // 2012 fall
    //"1271b322956aa078009fb1520a2a2698" // 2013 fall
    //"8ecf8d56956aa07864ca8735c063b8ad" // 2014 fall
    //"42dfdc1e956aa07843a6b049c9509a8f" // 2015 fall
    //"c82fefc7956aa0780141bcbc9ea2d728" // 2012 spring
    //"f0d2b6c3956aa0780139c789d0ba8ad8" // 2013 spring
    //"2525da7d956aa07871c3d5148ee1c3eb" // 2014 spring
    //"b9e2677b956aa0783236eb66099be1de" // 2015 spring
    //"cbb26251956aa07801db3f6cf77cdb26" // summer 2011
    //"6368a277956aa078003f6ca4e91e3ba5" // winter 13
    //"920e213e956aa0783005604294be2efb" // winter 14
    //"09158e3e956aa07813ccf13772c9769d" // winter 15
    //"eafa5954956aa0783e94a219adb3ac8b" // winter 16
    //"fdc37535956aa07800e6ace73718c2ed" // Fall-2012
);
        $dynField = "columnLayout";
        $dynValue = "Thin, Wide, Thin";
foreach ($page_ids as $id) {
    try
    { 
        // Step 1: Get the next page to be processed
        $p  = $cascade->getAsset( a\Page::TYPE, $id );
        echo "Processing " . $p->getPath() . ": ";
        //$p->display();

        // Step 2: Assign the $newContentType to the page
        /*
        Sets the content type for the page, calls edit, and returns the object.
        This method only takes care of blocks and formats attached to regions at the page level of the default configuration.
        When no flag is passed for $exception, the default value true is passed in.
        This should be the case if the old content type and new content type both are associated with the same data definition.
        If the new content type is associated with a different data definition, then a false should be passed in.
        In this case, after the content type has been set, the structured data should be dealt with properly to maintain consistency.
        Normally this means the method Page::setStructuredData should be called as well.
        http://www.upstate.edu/cascade-admin/projects/web-services/oop/classes/asset-classes/page.php
        */
        $p->setContentType( $newContentType, true );
        //echo "\$p->setContentType($newContentTypeId, true)->edit();\n";

        // Step 4: Recheck the page's current content type
        echo "Content Type <- " . $p->getContentTypeId() . "\n";
/*
        $p->getMetadata()->setDynamicFieldValue($dynField, $dynValue);
        $p->edit();
        var_dump( $p->getMetadata()->getDynamicFieldValues( $dynField ) );
*/
    } catch( \Exception $e ) {
        echo $e;
    }
} // foreach

echo E_PRE;
?>