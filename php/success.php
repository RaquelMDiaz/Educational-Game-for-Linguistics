<?php
// displays page if user succeeds
	include_once 'user_class.php';
	include_once 'session_check.php';

	$content = '';
	$errors = false;
	// collected sentences (Tosefali family tree task)
	$collected_sentences = array('Loasi Austenis rodena san.', 'Ula Miszkatis palauren san.', 'Mula Nojmanis purlauren san.', 'Mun Lihlatis losero san.', 
								 'Austen Unanis purfuertan san.', 'Hunan Majlatis pafuertan san.', 'Majla ut Unan loserorodena soni.', 
								 'Hunan ut Majla Hoamanis lameonvelia soni.', 'Nojman Majlatis lameon san.');
	  
	if ($_SESSION['user']->getCurrentTower() == 1) { // phonology tower
			$content = '<p>
						<img class="left_image" src="../images/jespersen.jpg" width="220px" height="275px" alt="Otto Jespersen" />
						Great performance! I knew I could trust your skills! You\'ve gained a new linguistic power: the phonetic power! If you go on like that, you\'ll probably also be 
						able to solve the Toselasofali analysis task. I\'ll give you some data which you will need for that. Here it is: 
						<ul><li>' . $collected_sentences[0] . '</li><li>' . $collected_sentences[1] . '</li><li>' . $collected_sentences[2] . '</li></ul>
						You might not understand these sentences yet, but once you\'ve collected all the data and names, you should be able to figure everything out. Now it\'s time 
						for your next test. As you know, things get difficult as we approach the great Master Chomsky. But I\'m sure you can do it! Just go on to the next tower.
						<br></p><br><p><button id="to_main_page">Continue</button></p>';
						
						// store the sentences in the user object, so that from there, they can be available in the notebook:
						if (!(in_array($collected_sentences[0], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[0]);
						}
						if (!(in_array($collected_sentences[1], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[1]);
						}
						if (!(in_array($collected_sentences[2], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[2]);
						}
						
		} elseif ($_SESSION['user']->getCurrentTower() == 2) { // morphology tower
			$content = '<p>
						<img class="left_image" src="../images/schleicher.jpg" width="220px" height="275px" alt="August Schleicher" />
						Amazing! As you seem to be an expert on morphology, you\'ve hereby earned morphological power and you\'ll probably have no difficulties solving our little 
						family tree analysis task. Which reminds me of the fact that I have something for you here: 
						<ul><li>' . $collected_sentences[3] . '</li><li>' . $collected_sentences[4] . '</li><li>' . $collected_sentences[5] . '</li></ul>
						Got that in your notebook? Good! So keep going and show that old chap Chomsky what you are worth.
						<br></p><br><p><button id="to_main_page">Continue</button></p>';
						
						// store the sentences in the user object, so that from there, they can be available in the notebook:
						if (!(in_array($collected_sentences[3], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[3]);
						}
						if (!(in_array($collected_sentences[4], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[4]);
						}
						if (!(in_array($collected_sentences[5], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[5]);
						}
						
		} elseif ($_SESSION['user']->getCurrentTower() == 3) { // syntax tower
			$content = '<p>
						<img class="left_image" src="../images/jackendoff1.jpg" width="220px" height="275px" alt="Ray Jackendoff" />
						Amazing! You\'ve proved yourself to be a great student. And so you\'ve been rewarded with linguistic powers in syntax! 
						Since you\'ve won this challenge, you can now collect some clues that will help you on your last battle! Here\'s your bonus: 
						<ul><li>' . $collected_sentences[6] . '</li><li>' . $collected_sentences[7] . '</li><li>' . $collected_sentences[8] . '</li></ul>
						I know it might look confusing, but don\'t worry if you don\'t understand too much of it. All of this will become clear when you face your last challenge. And now it\'s time to go on!
						<br></p><br><p><button id="to_main_page">Continue</button></p>';
						
						// store the sentences in the user object, so that from there, they can be available in the notebook:
						if (!(in_array($collected_sentences[6], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[6]);
						}
						if (!(in_array($collected_sentences[7], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[7]);
						}
						if (!(in_array($collected_sentences[8], $_SESSION['user']->getCollectedSentences()))) {
							$_SESSION['user']->setCollectedSentence($collected_sentences[8]);
						}
	} else {
		$errors = true;
		die('Error!');
	}
	
	$_SESSION['user']->saveCurrentState(); // save the user's progress
	$help_available = false;
	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Success</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '#to_main_page', function(e) {
					window.location.assign("main_game_board.php");
                });
			});
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
		        <?php echo $content; ?>
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>