<?php
// first page - phonology tower
    include_once 'user_class.php';
    include_once 'session_check.php';
    $_SESSION['user']->setCurrentTower(1);
    $help_available = false;
	$message = '';
	
	if ($_SESSION['user']->getLinguisticPower('phon')) {
		// user repeats task
		$message = '
		<img class="left_image" src="../images/jespersen.jpg" width="220px" height="275px" alt="Otto Jespersen" />
                <p>"Welcome back, aspiring linguist. As you know, my name is Otto Jespersen and I\'ll guide you through this task. Pay close attention and use your talent. 
                    </p><p>You\'ll see English words displayed on the screen and some IPA symbols to choose from. 
                    Click on the IPA symbols in the correct order to provide the transcription of the word which is displayed. 
                    Remember: you\'ll have to get at least 70% of the words right to complete this challenge. Good luck!"</p>
		        <p><button id="continue_button">Continue</button></p>';
	} else {
		// user does task for first time
		$message = '
		<img class="left_image" src="../images/jespersen.jpg" width="220px" height="275px" alt="Otto Jespersen" />
                <p>"Welcome to the Phonology Quest. My name is Otto Jespersen and I\'ll guide you through this task. Pay close attention and use your talent. 
                    </p><p>You\'ll see English words displayed on the screen and some IPA symbols to choose from. 
                    Click on the IPA symbols in the correct order to provide the transcription of the word which is displayed. 
                    You\'ll have to get at least 70% of the words right to complete this challenge. Good luck!"</p>
		        <p><button id="continue_button">Continue</button></p>';
	}
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Phonetics Tower</title>
        <link type="text/css" rel="stylesheet" href="../css/styles.css" />
        <script src="../js/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function() {
    			$(document).on('click', '#continue_button', function(e) {
                     window.location.assign("phon_task.php"); 
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
