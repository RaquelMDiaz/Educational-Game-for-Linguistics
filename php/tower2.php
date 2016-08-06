<?php
// first page - morphology tower
    include_once 'user_class.php';
    include_once 'session_check.php';
    $_SESSION['user']->setCurrentTower(2);
    $help_available = false;
	$message = '';
	
	if ($_SESSION['user']->getLinguisticPower('morph')) {
		// user repeats task
		$message = '
		<img class="left_image" src="../images/schleicher.jpg" width="220px" height="275px" alt="August Schleicher" />
                <p>"Well it\'s good to see you here again. As you might remember, my name is August Schleicher. This tower\'s challenge is morphology.</p>
                <p>
                For this quest, you\'ll have to identify different types of morphemes in words. You\'ll see a word displayed and you will be 
                told which type of morpheme you have to identify in that word. Click on the morpheme in the word, which you think can be classified 
                as this kind of morpheme, and press “Ready” to see if you were right. For example, if you were given the word \'morphemes\' and asked 
                for an inflectional morpheme, you would have to click on \'s\'. Go ahead and try it again!"
               	</p><p><button id="continue_button">Continue</button></p>
		';
	} else {
		// user does task for first time
		$message = '
		<img class="left_image" src="../images/schleicher.jpg" width="220px" height="275px" alt="August Schleicher" />
                <p>"Well well well... Hello and welcome to this tower\'s challenge. My name is August Schleicher and now it\'s the moment to test your morphology skills...
                </p>
                <p>
                For this quest, you\'ll have to identify different types of morphemes in words. You\'ll see a word displayed and and you will be 
                told which type of morpheme you have to identify in that word. Click on the morpheme in the word, which you think can be classified 
                as this kind of morpheme, and press “Ready” to see if you were right. For example, if you were given the word \'morphemes\' and asked 
                for an inflectional morpheme, you would have to click on \'s\'. Go ahead and try it!"
               	</p><p><button id="continue_button">Continue</button></p>
		';
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Syntax Tower</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '#continue_button', function(e) {
                     window.location.assign("morphology_task.php"); 
    			});
            });
		</script>
    </head>
    <body>
        <div id="frame">
            <div class="allcontent">
		        <?php echo $message; ?>
                <p>&nbsp;<p>
                <p>&nbsp;<p>
            </div>
            <?php include 'page_elements/bottom_pane.php'; ?>
        </div>
    </body>
</html>