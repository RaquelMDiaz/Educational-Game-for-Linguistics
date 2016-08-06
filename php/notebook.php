<?php
// displays notebook - linguistic powers gained by user + user's performance in access task (Toselasofali family tree)
    include_once 'user_class.php';
    include_once 'session_check.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Notebook</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>    
        <script src="../js/family_tree.js"></script> 
        <script>
            
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
    	<div id="notebook">
            <div id="notebook_title">
                <h3>Personal Notebook of: <?php echo $_SESSION['user']->getUserName(); ?></h3>
            </div>
            <div id="tree_in_notebook">
        		<div id="family_tree_container"></div>
                <script>
                    drawFamilyTree('', collected_names);
                </script>
            </div>
            <div id="sentences_in_notebook">
                <p>
                    <h3>Collected Language Data :</h3>
                    <ul>
<?php
                    foreach ($_SESSION['user']->getCollectedSentences() as $sentence) {
?>
                        <li><?php echo $sentence;?></li>
<?php
                    }
?>
                    </ul>
                </p>
            </div>
            <div id="powers_in_notebook">
                <p>
                   <h3>Your Linguistic Powers :</h3> 
                   <div class="display_table">
                        <div class="table_row">
<?php
                        foreach (['phon', 'morph', 'syn'] as $category) {
?>
                            <div class="table_cell centered">
<?php
                                if ($_SESSION['user']->getLinguisticPower($category) === true) { // linguistic power gained is marked with green icon
?>
                                    <img src="../images/yes_sign.png" width="20px" height="20px" alt="Checked"> 
<?php
                                } // if
                                else { // linguistic power not gained is marked with red icon
?> 
                                    <img src="../images/no_sign.png" width="20px" height="20px" alt="Unchecked">
<?php
                                } // else
?>

                            </div>
<?php

                        } // foreach
?>

                        </div>
                        <div class="table_row">
                            <div class="table_cell centered">Phonetic Power</div>
                            <div class="table_cell centered">&nbsp;&nbsp;Morphological Power&nbsp;&nbsp;</div>
                            <div class="table_cell centered">Syntactic Power</div>
                        </div>
                   </div>
                </p>
            </div>
       	</div>
    </body>
</html>