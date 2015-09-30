<?php
require_once( '../auth_espanae_dev.php' );


/* List all Cascade users using the following documentation:

    - Lesson 7: User, Group, Role, and Access Rights
      http://www.upstate.edu/cascade-admin/projects/web-services/courses/introductory-course/introductory-lesson-7.php
  
  
*/

try {

    $users = $cascade->getUsersByName( "*" );
    // 
    echo "<pre>\$users = \$cascade->getUsersByName( '*' );</pre>\n";
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