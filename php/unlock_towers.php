<?php
// unlock phonology, morphology and syntax towers
    include_once 'user_class.php';
    include_once 'session_check.php';
    
    $missing_name = '';
    $message1 = '';
    $message2 = '';
        
    $links_linguist_info = array(1 => '<a class="screen_link" href="http://en.wikipedia.org/wiki/Otto_Jespersen" target="_blank">Otto Jespersen</a>',
                                 2 => '<a class="screen_link" href="http://en.wikipedia.org/wiki/August_Schleicher" target="_blank">August Schleicher</a>',
                                 3 => '<a class="screen_link" href="http://en.wikipedia.org/wiki/Ray_Jackendoff" target="_blank">Ray Jackendoff</a>');
  
    $links_towers = array(1 => 'tower1.php',
                          2 => 'tower2.php',
                          3 => 'tower3.php');
    
    /**************************************************************************************************************************************************************/

    // according to which name the user is about to solve, load the corresponding messages:    
    if (isset($_POST['submit_name1'])) {
        
        if (strtolower($_POST['name1']) == "ula") { // correct answer
            
            $_SESSION['user']->setCollectedName('name1', 'Ula'); // update user object -> mark name as collected
            $_SESSION['user']->setUnlockedTower($_SESSION['user']->getCurrentTower()); // update user object -> store the current tower as unlocked as collected
            
            $message1 = '<p class="small_margin">Well done! You\'ve uncovered the first little piece. 
                        But as you can see, there\'s much more missing. 
                        For the next steps, it might help to know that the pronounciation of Toselasofali does not always work the same way as English pronunciation. 
                        For example, the sound of the letters "au" together is similar to the sound of "oy" in the "oyster", and the letter "h" is mute.</p>
                        <p><button id="continue_button">Continue</button></p>';
            $message2 = '<p>Now, come in and meet ' . $links_linguist_info[$_SESSION['user']->getCurrentTower()] . ', who might, if you can master the challenge he has prepared for you, provide you with some hints you\'ll need if you want to complete the family tree.
                        All language data that you collect will be saved in your notebook, you just have to click on it to see what you have collected already.</p>
                        <p><button id="access_button">Continue</button></p>';
            
        } // if (correct answer)
        else { // incorrect answer
            $missing_name = 'name1';
            $message1 = '<p class="small_margin">Nope, that\'s not quite right. Try again!</p>
                        <form class="display_inline" id="name1_form" name="name1_form" action="unlock_towers.php" method="post">
                            <p>
                                IPA: [j&#650;la] Orthography: 
                            
                                <input type="text" size="5" id="name1" name="name1" />
                                <input type="submit" name="submit_name1" value="Submit" />
                            </p>
                        </form>
                        <p>&nbsp;</p><p>&nbsp;</p>';
            
        } // else (incorrect answer)
    } // if (name1)
    
    /**************************************************************************************************************************************************************/
    
    else if (isset($_POST['submit_name2'])) {
        
        if (strtolower($_POST['name2']) == "austen") { // correct answer
            
            $_SESSION['user']->setCollectedName('name2', 'Austen'); // update user object -> mark name as collected
            $_SESSION['user']->setUnlockedTower($_SESSION['user']->getCurrentTower()); // update user object -> store the current tower as unlocked as collected
            
            $message1 = '<p class="small_margin">Perfect! Your family tree is getting more and more complete. And so is your knowledge of Toselasofali. 
                        Let me just tell you some more about pronunciation: The letter combination "sz" is pronounced as "sh", and the sound of the letters "oa" together is similar to the sound of "oa" in the word "oak".</p>
                        <p><button id="continue_button">Continue</button></p>';
            $message2 = '<p class="small_margin">Come in and see whether ' . $links_linguist_info[$_SESSION['user']->getCurrentTower()] . ' will have some further useful information for you. If you can\'t master his tasks, you may want to try to find the library 
                        - a visit there might help you with any linguistics problems you are having. </p>
                        <p><button id="access_button">Continue</button></p>';
            
        } // if (correct answer)
        else { // incorrect answer
            $missing_name = 'name2';
            $message1 = '<p class="small_margin">Sorry, that\'s not correct. Try again!</p>
                        <form class="display_inline" id="name2_form" name="name2_form" action="unlock_towers.php" method="post">
                            <p>
                                IPA: [oist&#601;n] Orthography: 
                                
                                    <input type="text" size="5" id="name2" name="name2"/>
                                    <input type="submit" name="submit_name2" value="Submit"/>
                            </p>
                        </form>
                        <p>&nbsp;</p><p>&nbsp;</p>';
            
        } // else (incorrect answer)
    } // if (name2)
    
    /**************************************************************************************************************************************************************/
    
    else if (isset($_POST['submit_name3'])) {
        
        if (strtolower($_POST['name3']) == "hoaman") { // correct answer
            
            $_SESSION['user']->setCollectedName('name3', 'Hoaman'); // update user object -> mark name as collected
            $_SESSION['user']->setUnlockedTower($_SESSION['user']->getCurrentTower()); // update user object -> store the current tower as unlocked as collected
            
            $message1 = '<p class="small_margin">Congratulations! You\'ve uncovered the third little piece of this riddle. Figuring out the four names which are still missing will be part of the task you\'ll have to solve to gain access to Master Chomsky\'s tower.</p>
                        <p><button id="continue_button">Continue</button></p>';
            $message2 = '<p class="small_margin">But before that can happen, you\'ll still have to tackle one more linguist and the challenge he has in store for you. 
                        So off you go and see what ' . $links_linguist_info[$_SESSION['user']->getCurrentTower()] . ' is up to.</p> 
                        <p><button id="access_button">Continue</button></p>';
            
        } // if (correct answer)
        else { // incorrect answer
            $missing_name = 'name3';
            $message1 = '<p class="small_margin">No, that\'s not the correct solution. Try again!</p>
                        <form class="display_inline" id="name3_form" name="name3_form" action="unlock_towers.php" method="post">
                            <p>
                                IPA: [o&#650;man] Orthography: 
                                
                                    <input type="text" size="5" id="name3" name="name3"/>
                                    <input type="submit" name="submit_name3" value="Submit"/>
                            </p>
                        </form>
                        <p>&nbsp;</p><p>&nbsp;</p>';
            
        } // else (incorrect answer)
    } // if (name2)
    
    $help_available = false;  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Unlock Tower</title>
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
                
                $(document).on('click', '#access_button', function() {
                   window.location.assign("<?php echo $links_towers[$_SESSION['user']->getCurrentTower()] ;?>"); // take user to correct tower
                });
                
            }); // document ready function
    
            var collected_names = {'name1' : false, 'name2' : false, 'name3' : false, 'name4' : false, 'name5' : false, 'name6' : false, 'name7' : false}; // holds names user has collected already -> needed for display of family tree
            
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
                        <div id="family_tree_container"></div>
                        <script>
                            drawFamilyTree('<?php echo $missing_name; ?>', collected_names);
                         </script>
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