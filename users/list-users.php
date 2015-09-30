<?php
// The quest build a "Users, Groups and Roles" diagram has begun by trying to list all Cascade users.

/* This script is based on the following documentation:

    - Lesson 7: User, Group, Role, and Access Rights
      http://www.upstate.edu/cascade-admin/projects/web-services/courses/introductory-course/introductory-lesson-7.php
  
    - Cascade class
      http://www.upstate.edu/cascade-admin/projects/web-services/oop/classes/cascade.php
*/
require_once( '../auth_espanae_dev.php' );

try {
    // Get all Cascade users
    $users = $cascade->getUsersByName( "*" );
    echo "<pre>count(\$users): " . count($users) . "</pre>\n";
    // count($users) = 1
    
    //  Iterate through the array of user objects
    foreach( $user as $users )
    {
        // Try to display something
        echo "<p>" . $user->getId() . "</p>\n";
        
        echo "<p>I'm feeling loopy.</p>\n";
        // Nothing's happening in the for loop.
    }
    
    var_dump($users);
    /*
    This got dumped:
    array(1)
    { [0]=> object(Identifier)#7 (4)
        { ["id":"Child":private]=> string(8) "persicol" ["path":"Child":private]=> object(Path)#13 (3)
            { ["path":"Path":private]=> string(0) "" ["site_id":"Path":private]=> NULL ["site_name":"Path":private]=> NULL
            } ["type":"Child":private]=> string(4) "user" ["recycled":"Child":private]=> bool(false)
        }
    }
    */
    
}
catch(Exception $e) {
    echo S_PRE . $e . E_PRE;
    throw $e;
}
