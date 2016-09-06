<!-- Created by Akshay S. Kashyap -->
<?php /* --- INITIAL SETUP ---*/
    require_once('../auth_espanae.php');
    $groups = $cascade->getGroups();
    $count = count($groups);
            
    // Do not display these Groups.
    $excludeGroups = array("LINKABLE", "ldapsync");
            
    // Do not display these Users.
    $excludeUsers = array("slaterj@union.edu", "espanae@union.edu", 
        "georgek@union.edu", "capaldix@union.edu", "kashyapa@union.edu",
        "shopmyes@union.edu");
?>
<html>
    <head>
        <style>
            html, body {
                border: 0;
                margin: 0;
                font-family: Helvetica, sans-serif;
            }
            a {
                text-decoration: none;
                color: #fff;
                font-weight: 800;
            }
            #title {
                width: 600px;
                height: 30px;
                margin: 0 auto;
                font-size: 25px;
                margin-top: 20px;
            }
            #control {
                width: 600px;
                height: 30px;
                margin: 0 auto;
                margin-top: 20px;
            }
            #control #filter {
                width: 300px;
                height: inherit;
                float: left;
                display: block;
            }
            #control #search {
                width: 300px;
                height: inherit;
                float: left;
                display: block;
            }
            #wrapper {
                width: 600px;
                margin: 0 auto;
                margin-top: 0px;
                color: #fff;
            }
            #wrapper div {
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
            }
            
            .group {
                width: 200px;
                margin-top: 20px;
                display: block;
                float: left;
            }
            .group .group-name {
                width: inherit;
                padding: 2.5px 5px;
                text-align: left;
                font-size: 20px;
                text-decoration: underline;
                background-color: #f16745;
            }
            .group .user {
                width: 169px;
                height: 34px;
                margin-top: 10px;
                padding: 5px;
                padding-bottom: 7px;
                background-color: #4CC3D9;
                text-align: left;
            }
            .group .user .user-name {
                width: inherit;
                height: 20px;
                float: left;
            }
            .group .user .user-email {
                width: inherit;
                height: 20px;
                float: left;
            }
            .group .approver, .exception {
                background-color: #ffc65d;
            }
        </style>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                // Refresh list when a group is selected
                $('#group-list').on('change', function() {
                    var group = $(this).val();
                    
                    $('.group').hide();
                    
                    // Show all
                    if(group == "all") {
                        $('.group').show();
                    } 
                    else { // Or selected    
                        $('.'+group).siblings().hide();
                        $('.'+group).show();
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="title">
            Cascade Groups
        </div>
        <div id="control">
            <div id="filter">
                Group:
                <select id="group-list">
                    <option value="all">-- ALL --</option>
                    <?php 
                        foreach($groups as $group) {
                            $groupName = $group->getId();
                            
                            if(!in_array($groupName, $excludeGroups))
                                echo 
                                "
                    <option value=". str_replace(' ', '_', $groupName) .">". 
                                    $groupName 
                                ."</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <?php
        try {
            if($count > 0) {
                echo "
        <div id='wrapper'>";
                
                foreach($groups as $group) {
                    $groupName = $group->getId();
                    
                    // Don't proceed if the group is in the exclude list
                    if(in_array($groupName, $excludeGroups))
                        continue;
                        
                    echo "
            <div class='group ". str_replace(' ', '_', $groupName) ."'>";
                    echo "
                <span class='group-name'>". $groupName ."</span>";
                    
                    try {
                        // Get users in the group
                        $groupAsset = $cascade->getAsset(Group::TYPE, $group->getId());
                        $userNames = explode(';', $groupAsset->getUsers());
                        
                        if(count($userNames) > 0) {
                            foreach($userNames as $userName) {
                                
                                try {
                                    $user = $cascade->getAsset(User::TYPE, $userName);
                                    $userFullName = $user->getFullName();
                                    $userEmail = $user->getEmail();
                                    
                                    if(!in_array($userEmail, $excludeUsers)) {
                                        if(strpos($user->getRole(), "Approver") == false) {
                                            echo "
                <div class='user'>";
                                        }
                                        else {
                                            echo "
                    <div class='user approver'>";
                                        }
                                        
                                        echo "
                        <span class='user-name'>". $userFullName ."</span>";
                                        echo "
                        <span class='user-email'>[
                            <a href='mailto:". $userEmail ."' target='_top'>". $userEmail ."</a>]
                        </span>";
                                        echo "
                    </div>";
                                    }
                                }
                                catch(Exception $e) {
                                    echo "
                    <div class='user exception'>";
                                    echo "
                        <span class='exception-message'>Oops! Could not fetch users. Contact: cms@union.edu</span>";
                                    echo "
                    </div>";
                                }
                            }
                        }
                    }
                    catch(Exception $e) {
                        echo "
                    <span class='exception-message'>Oops! There was a problem. Contact: cms@union.edu</span>";
                    }
                    
                    echo "
                </div>";
                }
                
                echo "
            </div>";
            }
        }
        catch(Exception $e) {
            echo S_PRE . $e . E_PRE;
            throw $e;
        }
    ?>
        </body>
    </html>
