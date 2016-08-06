<?php
// script for displaying security system when user enters unlocked Chomsky tower

    include_once 'user_class.php';
    include_once 'session_check.php';
    
    $message1 = '';
    $message2 = '';
    
    if (!($_SESSION['user']->getLinguisticPower('phon')) || !($_SESSION['user']->getLinguisticPower('morph')) || !($_SESSION['user']->getLinguisticPower('syn'))) { //one or more of the linguistic powers is missing -> no access to Chomsky tower
        $message1 = '<p class="small_margin">Sorry, our security system has detected that you have not completed all the preliminary tasks which will give you access to this tower and Master Chomsky, who resides here. 
                    There might be some parts of your linguistic power missing, or maybe some information you will need to complete the family tree below. 
                    Visit the other towers first to complete the missing tasks.</p>
                    <div id="family_tree_container"></div>
                    <script>
                        drawFamilyTree("", collected_names);
                    </script>';
    }
    
    elseif ($_SESSION['user']->getTreeTaskCompleted()) { //user has already solved the entire family tree before -> take him directly to Chomsky
        include 'tower_chomsky.php';
        die;
    }
    
    else { //user has collected all info to complete family tree task, but has not solved it yet -> present task to him
        $message1 = '<p class="small_margin">You have come to the last tower, the tower where Master Chomsky has been hiding all along. But first you need to access the tower… 
                    So take your notes and crack the code! With the help of the sentences you have collected in your notebook and the diagram, solve the rest of the Toselasofali family tree task and you will be allowed to come in.
                    The sentences describe the family relations that you can see in the tree, and with a bit of deductive thinking, they should allow you to place the missing names correctly.</p>
                    <p><button id="continue_button">Continue</button></p>';
        $message2 = '<p class="small_margin">So here are the missing names in random order: <br>
                    Miszka, Hunan (<em>male</em>), Unan (<em>male</em>), Loasi (<em>female</em>)</p>
                    <div id="family_tree_container"></div>
                    <script>
                        drawFamilyTree("final", collected_names);
                    </script>
                    <p>Which of these names goes where?</p>
                    <form class="display_inline" id="final_tree_form1" name="final_tree_form1" action="unlock_tower_chomsky.php" method="post">
                        <p>
                            &nbsp1 = <input type="text" size="5" id="name4" name="name4"/> &nbsp;&nbsp;
                            2 = <input type="text" size="5" id="name5" name="name5"/> &nbsp;&nbsp;
                            3 = <input type="text" size="5" id="name6" name="name6"/> &nbsp;&nbsp;
                            4 = <input type="text" size="5" id="name7" name="name7"/>
                        </p>
                        <input type="submit" name="submit_final_tree_form1" value="Submit"/>
                                
                    </form>';
    }
    
    $help_available = false;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Access Tower</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/family_tree.js"></script>
        <script>
            $(document).ready(function() {
                $('#screen2').hide();
                $(document).on('click', '#continue_button', function() {
                   $('#screen1').hide();
                   $('#screen2').show();
                });
                
            });
            
            var collected_names = {'name1' : false, 'name2' : false, 'name3' : false, 'name4' : false, 'name5' : false, 'name6' : false, 'name7' : false}; //holds names user has collected already -> needed for display of family tree
            
/*<?php
            foreach ($_SESSION['user']->getCollectedNames() as $name => $value) {
                if ($value !== false) { // if name has been discovered -> append to js variable collected_names
?>*/
                    collected_names['<?php echo $name; ?>'] = '<?php echo $value; ?>';
/*<?php
                    
                } // if not $value !== false
            } // foreach getCollectedNames

?>*/
        </script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
                <div id="security_screen">
                    <div class="screen_content" id="screen1">
                        <?php echo $message1; ?>
                    </div>
                    <div class="screen_content" id="screen2">
                        <?php echo $message2; ?>
                    </div>
                </div>
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>
