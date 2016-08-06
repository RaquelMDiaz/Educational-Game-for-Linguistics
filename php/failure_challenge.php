<?php
// displays feedback by Chomsky if user failed in the final challenge, determines which power is lost & sends him back to main map

	include_once 'db.php';
	include_once 'user_class.php';
	include_once 'session_check.php';
	$errors = false;
	$content = '';
	
	if (isset($_SESSION['challenge_correct_phon_answers']) && isset($_SESSION['challenge_correct_morph_answers']) && isset($_SESSION['challenge_correct_syn_answers'])) {
		$val1 = $_SESSION['challenge_correct_phon_answers'];
		$val2 = $_SESSION['challenge_correct_morph_answers'];
		$val3 = $_SESSION['challenge_correct_syn_answers'];
		$array_towers = array('Phonology', 'Morphology', 'Syntax');
		shuffle($array_towers);
	
		if ($val1 < $val2 && $val1 < $val3) {
			$_SESSION['user']->setLinguisticPower('phon', false); //user loses phon linguistic power
			$content = '<p>
			<img class="left_image" src="../images/chomsky2.jpg" width="200px" height="200px" alt="Noam Chomsky" />
			"
			That\'s unfortunate! You were not able to tackle the last challenge. The phonology task seems to have been particularly 
			tricky for you. If you don\'t want your linguistic powers to vanish, you must go back to the Phonology Tower and regain a little strength.
			"
			<br></p><br><p><button id="continue_to_main_board">Continue</button></p>';
		} else if ($val2 < $val1 && $val2 < $val3) {
			$_SESSION['user']->setLinguisticPower('morph', false); //user loses morph linguistic power
			$content = '<p>
			<img class="left_image" src="../images/chomsky2.jpg" width="200px" height="200px" alt="Noam Chomsky" />
			"
			That\'s unfortunate! You were not able to tackle the last challenge. The morphology task seems to have been particularly 
			tricky for you. If you don\'t want your linguistic powers to vanish, you must go back to the Morphology Tower and regain a little strength.
			"
			<br></p><br><p><button id="continue_to_main_board">Continue</button></p>';
		} else if ($val3 < $val1 && $val3 < $val2) {
			$_SESSION['user']->setLinguisticPower('syn', false); //user loses syn linguistic power
			$content = '<p>
			<img class="left_image" src="../images/chomsky2.jpg" width="200px" height="200px" alt="Noam Chomsky" />
			"
			That\'s unfortunate! You were not able to tackle the last challenge. The syntax task seems to have been particularly 
			tricky for you. If you don\'t want your linguistic powers to vanish, you must go back to the Syntax Tower and regain a little strength.
			"
			<br></p><br><p><button id="continue_to_main_board">Continue</button></p>';
		} else if ($val1 == $val2 && $val1 < $val3 && $val2 < $val3) {
			if ($array_towers[0] == 'Phonology') {
				$_SESSION['user']->setLinguisticPower('phon', false); //user loses phon linguistic power
			} else if ($array_towers[0] == 'Morphology') {
				$_SESSION['user']->setLinguisticPower('morph', false); //user loses morph linguistic power
			} else {
				$_SESSION['user']->setLinguisticPower('syn', false); //user loses syn linguistic power
			}
			$content = '<p>
			<img class="left_image" src="../images/chomsky2.jpg" width="200px" height="200px" alt="Noam Chomsky" />
			"
			That\'s unfortunate! You were not able to tackle the last challenge. If you don\'t want your linguistic powers to vanish completely, you must go back and revisit some towers. 
			If you think you can prove yourself to be a true linguist, then lose no time and go to the ' . $array_towers[0] . ' Tower!
			"
			<br></p><br><p><button id="continue_to_main_board">Continue</button></p>';
		} else if ($val1 == $val3 && $val1 < $val2 && $val3 < $val2) {
			if ($array_towers[1] == 'Phonology') {
				$_SESSION['user']->setLinguisticPower('phon', false); //user loses phon linguistic power
			} else if ($array_towers[1] == 'Morphology') {
				$_SESSION['user']->setLinguisticPower('morph', false); //user loses morph linguistic power
			} else {
				$_SESSION['user']->setLinguisticPower('syn', false); //user loses syn linguistic power
			}
			$content = '<p>
			<img class="left_image" src="../images/chomsky2.jpg" width="200px" height="200px" alt="Noam Chomsky" />
			"
			That\'s unfortunate! You were not able to tackle the last challenge. If you don\'t want your linguistic powers to vanish completely, you must go back and revisit some towers. 
			If you think you can prove yourself to be a true linguist, then lose no time and go to the ' . $array_towers[1] . ' Tower!
			"
			<br></p><br><p><button id="continue_to_main_board">Continue</button></p>';
		} else if ($val2 == $val3 && $val2 < $val1 && $val3 < $val1) {
			if ($array_towers[2] == 'Phonology') {
				$_SESSION['user']->setLinguisticPower('phon', false); //user loses phon linguistic power
			} else if ($array_towers[2] == 'Morphology') {
				$_SESSION['user']->setLinguisticPower('morph', false); //user loses morph linguistic power
			} else {
				$_SESSION['user']->setLinguisticPower('syn', false); //user loses syn linguistic power
			}
			$content = '<p>
			<img class="left_image" src="../images/chomsky2.jpg" width="200px" height="200px" alt="Noam Chomsky" />
			"
			That\'s unfortunate! You were not able to tackle the last challenge. If you don\'t want your linguistic powers to vanish completely, you must go back and revisit some towers. 
			If you think you can prove yourself to be a true linguist, then lose no time and go to the ' . $array_towers[2] . ' Tower!
			"
			<br></p><br><p><button id="continue_to_main_board">Continue</button></p>';
		}
	} else {
		$content = '<p class="centered">You haven\'t completed the game yet.</p>
		<br><p><button id="continue_to_main_board">Continue</button></p>';
	}
		
	$my_db_object->close();
	
	$help_available = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Failure</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '#continue_to_main_board', function(e) {
					e.preventDefault();
					window.location.assign("main_game_board.php");
                });
			});
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
                <p> <?php echo $content; ?> </p>
                <p>&nbsp;<p>
                <p>&nbsp;<p>
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>