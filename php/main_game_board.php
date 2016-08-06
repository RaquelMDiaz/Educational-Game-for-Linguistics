<?php
// displays the main game board
      include_once 'user_class.php';
      include_once 'session_check.php';
      $back_to_map = false; //back to map button should not be shown here
      $logout = true;
      $help_available = false; // help button should not be shown here
     
      // unset the counters of the single tasks, in case user left in middle of a task
      unset($_SESSION['syn_counter_all']);
      unset($_SESSION['morph_counter_all']);
      unset($_SESSION['counter_all']);
      unset($_SESSION['mcqs_counter_all']);
      unset($_SESSION['challenge_counter_all']);
      $_SESSION['user']->setCurrentTower(null);

      $towers = array(1 => "phon", 2 => "morph", 3 => "syn");

?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
      <link type="text/css" rel="stylesheet" href="../css/styles.css"/>
      <script src="../js/jquery-1.11.1.min.js"></script>
      <title>Main Game Board</title>
      <script>
            $(document).ready(function() {
                  $(document).on('click', '.tower_link', function() {
                        $('#tower_name').val($(this).attr('data')); //store name of tower in the form
                        $('#map_form').submit(); //submit form to access the towers
                  });
                  $(document).on('click', '#library_div', function() {
                        window.location.assign("library.php"); 
                  });
                  $(document).on('click', '#chomsky_div', function() {
                        window.location.assign("access_tower_chomsky.php"); 
                  });
/* <?php
                  if (isset($_SESSION['user'])) {
                        // set symbols & colors of the single towers, according to what user has achieved
                        for ($i = 1; $i <= sizeof($towers); $i++) {
                              if ($_SESSION['user']->getLinguisticPower($towers[$i])) { //tower has been completed
?>*/
                                    $('#tower' + '<?php echo $i; ?>' + '_div').css('background-color', '#c3be6c'); // change color to green
                                    $('#tower' + '<?php echo $i; ?>' + '_symbol').html('<img src="../images/yes_sign.png" width="15px" height="15px" />'); // change symbol
/*<?php       
                              } // if
                              if (in_array($i, $_SESSION['user']->getUnlockedTowers())) { //tower has been unlocked
?>*/
                                    $('.tower' + '<?php echo $i; ?>' + '_doors').html(''); // delete door
/*<?php       
                              } // else if
                        } // for
                        // set symbols & color of Chomsky tower:
                        if ($_SESSION['user']->getTreeTaskCompleted()) {
?> */
                                    $('#chomsky_door').html(''); // delete door                      
/* <?php
                        } // if
                        if ($_SESSION['user']->getLinguisticPower('phon') && $_SESSION['user']->getLinguisticPower('morph') && $_SESSION['user']->getLinguisticPower('syn')) {
?> */
                                    $('#lock').html(''); // delete lock
/* <?php
                        } // if
                        if ($_SESSION['user']->getEverythingCompleted()) {
?> */                               $('#chomsky_div').css('background-color', '#c3be6c'); // change color to green
                                    $('#chomsky_symbol').html('<img src="../images/yes_sign.png" width="15px" height="15px" />'); // change symbol

/* <?php     
                        } // if
                  } // if
?> */
            });
      </script>
</head>

<body>
      <div id="frame">
            <div class="allcontent">
            		
                  <div class="main_map">
                        <div id="tower1_div" class='tower_link' data="1"></div>
                        <div id="tower1_symbol"><img src="../images/no_sign.png" width="15px" height="15px" /></div>
                        <div id="tower1_door" class="tower1_doors"><img src="../images/door_C.png" width="24px" height="6px"></div>
                        <div id="tower2_div" class='tower_link' data="2"></div>
                        <div id="tower2_symbol"><img src="../images/no_sign.png" width="15px" height="15px" /></div>
                        <div id="tower2_door" class="tower2_doors"><img src="../images/door_B.png" width="6px" height="22px"></div>
                        <div id="tower3_div" class='tower_link' data="3"></div>
                        <div id="tower3_symbol"><img src="../images/no_sign.png" width="15px" height="15px" /></div>
                        <div id="tower3_door1" class="tower3_doors"><img src="../images/door_A_1.png" width="29px" height="6px"></div>
                        <div id="tower3_door2" class="tower3_doors"><img src="../images/door_A_2.png" width="6px" height="22px"></div>
                        <div id="library_div"></div>
                        <div id="chomsky_div"></div>
                        <div id="chomsky_symbol"><img src="../images/no_sign.png" width="15px" height="15px" /></div>
                        <div id="chomsky_door"><img src="../images/door_K.png" width="6px" height="20px"></div>
                        <div id="lock"><img src="../images/lock.png" width="15px" height="16px"></div>
                  </div>
                  <p class="right_aligned"><br>Click on the towers to enter them!</p>
                  <form id="map_form" name="map_form" action="access_towers.php" method="post">
                        <input type="hidden" id="tower_name" name="tower_name" value="">
                  </form>
            </div>
      <?php include 'page_elements/bottom_pane.php'; ?>
      </div>
</body>
</html>