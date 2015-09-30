<?php
// A script that lists all Cascade users

require_once( '../auth_espanae_dev.php' );


/* This script is based on the following documentation:

    - Lesson 7: User, Group, Role, and Access Rights
      http://www.upstate.edu/cascade-admin/projects/web-services/courses/introductory-course/introductory-lesson-7.php
  
    - Cascade class
      http://www.upstate.edu/cascade-admin/projects/web-services/oop/classes/cascade.php
*/

try {
    // Get all Cascade users ()
    $users = $cascade->getUsersByName( "*es" );
    // 
    echo "<pre>\$users = \$cascade->getUsersByName( '*es' );</pre>\n";
    echo "<pre>count(\$users): " . count($users) . "</pre>\n";
    
    foreach( $user as $users )
    {
        echo "<p>" . $user->getId() . "</p>\n";
    }
    echo "<pre>foreach ( \$user as \$users )</pre>\n";
}
catch(Exception $e) {
    echo S_PRE . $e . E_PRE;
    throw $e;
}
