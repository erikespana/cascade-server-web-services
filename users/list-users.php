<?php
// A script that lists all Cascade users

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
    // Troubleshooting statement
    echo "<pre>count(\$users): " . count($users) . "</pre>\n";
    
    //  Iterate through the array of user objects
    foreach( $user as $users )
    {
        // Try to display something
        echo "<p>" . $user->getId() . "</p>\n";
    }
    // Troubleshooting statement
    echo "<pre>foreach executed.</pre>\n";
}
catch(Exception $e) {
    echo S_PRE . $e . E_PRE;
    throw $e;
}
