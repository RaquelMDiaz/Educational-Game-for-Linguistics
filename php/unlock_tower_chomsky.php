<?php
// unlock challenge
    include_once 'user_class.php';
    include_once 'session_check.php';
    
    $message1 = '';
    $message2 = '';
    
    if (isset($_POST['submit_final_tree_form1'])) { // the four names have been submitted
        if ((strtolower($_POST['name4']) == 'loasi') && (strtolower($_POST['name5']) == 'unan') && (strtolower($_POST['name6']) == 'hunan') && (strtolower($_POST['name7']) == 'miszka')) { // all names are correct
            $_SESSION['user']->setCollectedName('name4', 'Loasi'); 
            $_SESSION['user']->setCollectedName('name5', 'Unan');
            $_SESSION['user']->setCollectedName('name6', 'Hunan');
            $_SESSION['user']->setCollectedName('name7', 'Miszka');
            $message1 = '<p class="small_margin">Impressive! You got all the names right! 
                        But in order to proof that you have not been only guessing, we have some more questions for you. 
                        On the next screen, you will have to answer some questions about the tree correctly and there will also be some sentences in Toselasofali for you to complete.
                        These sentences describe some more of the relationships in the family tree and use only the vocabulary that you know from the sentences you have collected.
                        So if you\'ve really understood how the Toselasofali system works, this should be a piece of cake. Let\'s go!</p>
                        <p><button id="continue_button">Continue</button></p>';
            $message2 = '<div id="family_tree_container"></div>
                        <script>
                            drawFamilyTree("", collected_names);
                        </script><form class="display_inline" id="final_tree_form2" name="final_tree_form2" action="unlock_tower_chomsky.php" method="post">
                            <p>
                                Is Miszka male or female? <input type="radio" name="gender" value="male">male&nbsp;&nbsp<input type="radio" name="gender" value="female">female
                            </p>
                            <div class="display_table" id="family_task_table">
                                <div class="table_row">
                                    <div class="table_cell">                                     
                                        1) Miszka <input type="text" size="5" id="phrase1" name="phrase1"/> palauren san
                                    </div>
                                    <div class="table_cell">                                     
                                        4) Nojman Mulatis <input type="text" size="5" id="phrase4" name="phrase4"/>
                                    </div>
                                </div>
                                <div class="table_row">
                                    <div class="table_cell">                                     
                                        2) Mula ut Nojman Majlatis <input type="text" size="5" id="phrase2" name="phrase2"/>
                                    </div>
                                    <div class="table_cell">                                     
                                        5) Miszka Austenis <input type="text" size="5" id="phrase5" name="phrase5"/>
                                    </div>
                                </div>
                                <div class="table_row">
                                    <div class="table_cell">                                     
                                        3) Majla Hunanis <input type="text" size="5" id="phrase3" name="phrase3"/>
                                    </div>
                                    <div class="table_cell">                                     
                                        6) Hoaman Mauratis <input type="text" size="5" id="phrase6" name="phrase6"/>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="small_margin"><input type="submit" name="submit_final_tree_form2" value="Submit"/></p>
                                    
                        </form>';
        } // if names correct
        else { // mistake in the submitted names
            $message1 = '<p class="small_margin">Sorry, it seems like you didn\'t get all those family relations quite right yet.
                        Take another look at your notes and try again!</p>
                        Miszka, Hunan (<em>male</em>), Unan (<em>male</em>), Loasi (<em>female</em>)</p>
                        <div id="family_tree_container"></div>
                        <script>
                            drawFamilyTree("final", collected_names);
                        </script>
                        <form class="display_inline" id="final_tree_form1" name="final_tree_form1" action="unlock_tower_chomsky.php" method="post">
                            <p>
                                &nbsp1 = <input type="text" size="5" id="name4" name="name4"/> &nbsp;&nbsp;
                                2 = <input type="text" size="5" id="name5" name="name5"/> &nbsp;&nbsp;
                                3 = <input type="text" size="5" id="name6" name="name6"/> &nbsp;&nbsp;
                                4 = <input type="text" size="5" id="name7" name="name7"/>
                            </p>
                            <input type="submit" name="submit_final_tree_form1" value="Submit"/>
                                    
                        </form>';
        } // else names not correct
        
    } // if isset($_POST['submit_final_tree_form1'])
    
    else if (isset($_POST['submit_final_tree_form2'])) { // second task (gender of Miszka & sentences) has been submitted
        if (($_POST['gender'] == 'female') && 
            (strtolower($_POST['phrase1']) == 'ulatis') &&
            (strtolower($_POST['phrase2']) == 'lameon-velia soni') &&
            (strtolower($_POST['phrase3']) == 'purlauren san') &&
            (strtolower($_POST['phrase4']) == 'pafuertan san') &&
            (strtolower($_POST['phrase5']) == 'velia san') &&
            (strtolower($_POST['phrase6']) == 'losero san')) { // all solutions correct
            
            $message1 = '<p class="small_margin">Well done! You\'ve collected all the pieces of the puzzle! Great job. And now it’s time for the ultimate challenge, the moment you’ve been waiting for. 
                         It\’s time to show how strong your linguistic powers are. It\’s time to meet <a href="chomsky_info.php">Noam Chomsky</a>.</p>
                         <p><button id="access_button">Continue</button></p>';
            
        } // if solutions correct
        else {
           $message1 = '<div id="family_tree_container"></div>
                        <script>
                            drawFamilyTree("", collected_names);
                        </script><form class="display_inline" id="final_tree_form2" name="final_tree_form2" action="unlock_tower_chomsky.php" method="post">
                            <p>
                                Is Miszka male or female? <input type="radio" name="gender" value="male">male&nbsp;&nbsp<input type="radio" name="gender" value="female">female
                            </p>
                            <div class="display_table">
                                <div class="table_row">
                                    <div class="table_cell">                                     
                                        1) Miszka <input type="text" size="5" id="phrase1" name="phrase1"/> palauren san
                                    </div>
                                    <div class="table_cell">                                     
                                        4) Nojman Mulatis <input type="text" size="5" id="phrase4" name="phrase4"/>
                                    </div>
                                </div>
                                <div class="table_row">
                                    <div class="table_cell">                                     
                                        2) Mula ut Nojman Majlatis <input type="text" size="5" id="phrase2" name="phrase2"/>
                                    </div>
                                    <div class="table_cell">                                     
                                        5) Miszka Austenis <input type="text" size="5" id="phrase5" name="phrase5"/>
                                    </div>
                                </div>
                                <div class="table_row">
                                    <div class="table_cell">                                     
                                        3) Majla Hunanis <input type="text" size="5" id="phrase3" name="phrase3"/>
                                    </div>
                                    <div class="table_cell">                                     
                                        6) Hoaman Mauratis <input type="text" size="5" id="phrase6" name="phrase6"/>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="small_margin"><input type="submit" name="submit_final_tree_form2" value="Submit"/> That was not all correct. Try again!</p>
                                    
                        </form>'; 
        } // else solutions incorrect
    } // else if isset($_POST['submit_final_tree_form2'])
    
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
                $(document).on('click', '#back_button', function() {
                   window.location.assign("main_game_board.php"); // take user back to main map
                });
                $(document).on('click', '#access_button', function() {
                   window.location.assign("tower_chomsky.php"); // take user to tower
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
