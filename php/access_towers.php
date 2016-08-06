<?php
// script for displaying security system when user enters unlocked sub-quest towers

    include_once 'user_class.php';
    include_once 'session_check.php';
    
    $missing_name = '';
    $message1 = '';
    $message2 = '';
    
    $links_towers = array(1 => 'tower1.php',
                          2 => 'tower2.php',
                          3 => 'tower3.php');
    $links_linguist_info = array(1 => '<a class="screen_link" href="http://en.wikipedia.org/wiki/Otto_Jespersen" target="_blank">Otto Jespersen</a>',
                                 2 => '<a class="screen_link" href="http://en.wikipedia.org/wiki/August_Schleicher" target="_blank">August Schleicher</a>',
                                 3 => '<a class="screen_link" href="http://en.wikipedia.org/wiki/Ray_Jackendoff" target="_blank">Ray Jackendoff</a>');

    //detect which tower is to be accessed:
    if (isset($_POST['tower_name'])) {
        $tower_number = intval($_POST['tower_name']);
        $_SESSION['user']->setCurrentTower($tower_number);
    }
    
    //if the user is accessing a tower which he already has unlocked -> take him straight to tower without displaying security system
    if (in_array($_SESSION['user']->getCurrentTower(), $_SESSION['user']->getUnlockedTowers())) {
        include $links_towers[$_SESSION['user']->getCurrentTower()];
        die;
    } // if accessing unlocked tower
    
    //according to which names the user has collected already, load the corresponding messages:    
    else if (!$_SESSION['user']->getCollectedName('name1')) { // no name collected yet
        $missing_name = 'name1';
        $message1 = '<p class="small_margin">Welcome aspiring linguist! You thought you\'ll be allowed to meet one of the most famous linguists in this world just like that? Silly sausage! 
                First, there will have to be a little demonstration of your skills. For that reason, we have set up this security system, which locks each tower until you solve a small task. 
                And what could be better suited for this than confronting you with Toselasofali, the top-secret language of the Society of Famous Linguists? 
                Yes, you\'ve read correctly, of course we have our own language. And if you want to meet Chomsky, you\'ll have to figure out quite a bit of it. 
                But let\'s start with something simple.</p>
                <p><button id="continue_button">Continue</button></p>';
        $message2 = '<p class="small_margin">The task you\'ll have to solve in order to meet our master involves completing the family tree you see below, and here, you\'ll figure out the first missing name in this tree. 
                You can see it below in IPA transcription. To include it in the tree and gain access to this tower, type the correct orthography which corresponds to this transcription into the input box:</p>
                <form class="display_inline" id="name1_form" name="name1_form" action="unlock_towers.php" method="post">
                    <p>
                        IPA: [j&#650;la] Orthography: 
                        
                            <input type="text" size="5" id="name1" name="name1"/>
                            <input type="submit" name="submit_name1" value="Submit"/>
                    </p>
                </form>
                <div id="family_tree_container"></div>
                <script>
                    drawFamilyTree("' . $missing_name . '", collected_names);
                </script>';
    } // else if name1
    
    else if (!$_SESSION['user']->getCollectedName('name2')) { // only first name collected
        $missing_name = 'name2';
        $message1 = '<p class="small_margin">So you want to try your luck with yet another challenge? Well, before you\'ll be able to meet ' . $links_linguist_info[$_SESSION['user']->getCurrentTower()] . ', 
                    you have to show that you\'ve already learned some more about Toselasofali, so here is another name from the family tree in IPA. 
                    Again, type the correct orthography below and you\'ll be welcome in this tower:</p>
                    
                    <form class="display_inline" id="name2_form" name="name2_form" action="unlock_towers.php" method="post">
                        <p>
                            IPA: [oist&#601;n] Orthography: 
                            
                                <input type="text" size="5" id="name2" name="name2"/>
                                <input type="submit" name="submit_name2" value="Submit"/>
                        </p>
                    </form>
                    <div id="family_tree_container"></div>
                    <script>
                        drawFamilyTree("' . $missing_name . '", collected_names);
                    </script>';
        
    } // else if name2
    
    else if (!$_SESSION['user']->getCollectedName('name3')) { // first & second name collected
        $missing_name = 'name3';
        $message1 = '<p class="small_margin">Yet another challenge? That’s good, but not so fast! Before I take you to ' . $links_linguist_info[$_SESSION['user']->getCurrentTower()] . '’s tower, you have to show your skills in Toselasofali, which by now should be quite developed. 
                    So here you see one more name from the family tree in IPA. 
                    Just like before, remember the hints collected so far, type the correct orthography below and you\'ll be allowed to come in:</p>
                    
                    <form class="display_inline" id="name3_form" name="name3_form" action="unlock_towers.php" method="post">
                        <p>
                            IPA: [o&#650;man] Orthography: 
                            
                                <input type="text" size="5" id="name3" name="name3"/>
                                <input type="submit" name="submit_name3" value="Submit"/>
                        </p>
                    </form>
                    <div id="family_tree_container"></div>
                    <script>
                        drawFamilyTree("' . $missing_name . '", collected_names);
                    </script>';
        
    } // else if name3
    
    else { //should not be necessary, as the user if he has all names also should have unlocked all towers, but just in case
        include $links_towers[$_SESSION['user']->getCurrentTower()];
        die;
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
